<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
    public function index()
    {
        $journals = DB::table('journal_details')
            ->select(
                'journal_master.journal_reference_id',
                DB::raw('MIN(journal_details.transaction_code) AS sample_transaction_code'),
                DB::raw('MIN(journal_details.itn_response) AS sample_itn_response'),
                DB::raw('MIN(journal_details.local_journal_id) AS sample_local_journal_id'),
                DB::raw('MIN(journal_master.posting_date) AS posting_date')
            )
            ->join('journal_master', 'journal_master.id', '=', 'journal_details.local_journal_id')
            ->whereBetween('journal_master.posting_date', ['2025-01-01', '2025-01-31'])
            ->whereIn('journal_master.event_type', [6, 22, 18])
            ->where('journal_details.itn_status', 2)
            ->whereIn('journal_details.transaction_code', ['DNV', 'CCN', 'RCN', 'RCC'])
            ->groupBy('journal_master.journal_reference_id')
            ->limit(1000)
            ->get();
        // return view('journal.journal');
        return view('journal.journal', compact('journals'));
    }

    public function journalDetails()
    {
        $journalDetails = DB::table('journal_details')
            ->limit(1000)
            ->get();

        return view('journal.journal_details', compact('journalDetails'));
    }

    public function journalMaster()
    {
        $journalMasters = DB::table('journal_master')
            ->limit(1000)
            ->get();
        return view('journal.journal_master', compact('journalMasters'));
    }

    // public function paymentReports(Request $request)
    // {
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');


    //     $results = DB::table('bpv_applied_clcs')
    //         ->selectRaw("
    //         DISTINCT DATE_FORMAT(bpv_applied_clcs.paymentDate, '%d/%m/%Y') AS paymentDate,
    //         bpv_applied_clcs.bpvJournalId AS journal_reference_id,
    //         bpv_applied_clcs.clcJournalId,
    //         bpv_applied_clcs.clcDate,
    //         bpv_applied_clcs.amount AS paidAmount,
    //         bpv_applied_clcs.paymentId,
    //         bpv_applied_clcs.transferNumber,
    //         bpv_applied_clcs.itn_status,
    //         bpv_applied_clcs.itn_response,
    //         journal_details.transaction_code
    //     ")
    //         ->leftJoin('journal_master', 'journal_master.journal_reference_id', '=', 'bpv_applied_clcs.clcJournalId')
    //         ->leftJoin('journal_details', 'journal_details.local_journal_id', '=', 'journal_master.id')
    //         ->whereBetween('bpv_applied_clcs.paymentDate', ['2025-05-16', '2025-05-16'])
    //         // ->whereBetween('bpv_applied_clcs.paymentDate', [$startDate, $endDate])
    //         ->whereIn('bpv_applied_clcs.itn_status', [0, 1, 2])
    //         ->orderBy('bpv_applied_clcs.clcDate')
    //         ->orderBy('bpv_applied_clcs.bpvJournalId')
    //         ->get();

    //     return view('journal.payment_reports', compact('results', 'startDate', 'endDate'));
    // }

    public function paymentReports(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');

        $query = DB::table('bpv_applied_clcs')
            ->selectRaw("DISTINCT DATE_FORMAT(paymentDate, '%d/%m/%Y') AS paymentDate, 
                  bpvJournalId AS journal_reference_id, 
                  clcJournalId, 
                  clcDate, 
                  amount AS paidAmount, 
                  paymentId, 
                  transferNumber, 
                  itn_status, 
                  itn_response
                ");

        // Apply date filters
        if ($startDate && $endDate) {
            $query->whereBetween('paymentDate', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->whereDate('paymentDate', '>=', $startDate);
        } elseif ($endDate) {
            $query->whereDate('paymentDate', '<=', $endDate);
        }

        // Apply status filter
        if ($status !== null && $status !== '') {
            $query->where('itn_status', $status);
        }

        // Order and limit
        $results = $query
            ->orderBy('clcDate', 'desc')
            ->orderBy('bpvJournalId')
            ->limit(1000)
            ->get();
        // ->whereBetween('paymentDate', ['2025-05-16', '2025-05-16'])
        // ->whereIn('itn_status', [0, 1, 2])
        // ->orderBy('clcDate')
        // ->orderBy('bpvJournalId')
        // ->limit(100)
        // ->get();

        // return view('journal.payment_report', compact('results', 'startDate', 'endDate'));
        return view('journal.payment_reports', compact('results'));
    }

    public function paymentReports1(Request $request)
    {
        
        $startDate = $request->input('start_date', '2025-05-16');
        $endDate = $request->input('end_date', '2025-05-16');

        // Step 1: Get bpv_applied_clcs records
        $bpvRecords = DB::table('bpv_applied_clcs')
        ->select(
            'paymentDate',
            'bpvJournalId',
            'clcJournalId',
            'clcDate',
            'amount',
            'paymentId',
            'transferNumber',
            'itn_status',
            'itn_response'
        )
        ->whereBetween('paymentDate', [$startDate, $endDate])
        ->whereIn('itn_status', [0, 1, 2])
        ->orderBy('clcDate')
        ->orderBy('bpvJournalId')
        ->limit(1000)
        ->distinct()
        ->get();
        // dd($bpvRecords);

        // Step 2: Extract clcJournalIds
        $clcJournalIds = $bpvRecords->pluck('clcJournalId')->unique()->toArray();
        // dd($clcJournalIds);

        // Step 3: Get journal + claims info
        $details = DB::table('journal_master')
            ->join('journal_details', 'journal_master.id', '=', 'journal_details.local_journal_id')
            ->join('claims_payment_details', 'claims_payment_details.journal_reference_id', '=', 'journal_master.journal_reference_id')
            ->whereIn('journal_master.journal_reference_id', $clcJournalIds)
            // ->whereIn('journal_master.journal_reference_id', [14881503])
            ->select(
                'journal_master.journal_reference_id',
                'journal_details.transaction_code',
                'claims_payment_details.payee',
                'claims_payment_details.payee_entity_id'
            )
        ->distinct()
        ->limit(100)
        ->get();

        // Step 4: Build structured lookup
        $structured = [];
        foreach ($details as $row) {
            $structured[$row->journal_reference_id] = [
                'transaction_code' => $row->transaction_code,
                'payee' => $row->payee,
                'payee_entity_id' => $row->payee_entity_id,
            ];
        }

        // Step 5: Merge into final results
        $finalResults = [];

        foreach ($bpvRecords as $record) {
            $clcId = $record->clcJournalId;

            $finalResults[] = [
                'paymentDate' => $record->paymentDate,
                'bpvJournalId' => $record->bpvJournalId,
                'clcJournalId' => $clcId,
                'clcDate' => $record->clcDate,
                'amount' => $record->amount,
                'paymentId' => $record->paymentId,
                'transferNumber' => $record->transferNumber,
                'itn_status' => $record->itn_status,
                'itn_response' => $record->itn_response,
                'extra_info' => $structured[$clcId] ?? null
            ];
        }

        return view('journal.payment_reports', compact('finalResults', 'startDate', 'endDate'));
    }
}

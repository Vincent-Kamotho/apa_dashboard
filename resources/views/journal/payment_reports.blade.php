<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.tableheader')
</head>

<body>

    <div class="theme-loader">
        <div class="ball-scale">
            <div class="contain">
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('layouts.navbar')
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        @include('layouts.sidebar')
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-header">
                                        <div class="row align-items-end">
                                            <div class="col-lg-8">
                                                <div class="page-header-title">
                                                    <div class="d-inline">
                                                        <h4>Payment Reports</h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="page-body">
                                        <div class="card">
                                            <div class="card-block">

                                                <form method="GET" action="">
                                                    <div class="row align-items-end">
                                                        <!-- Date Filter -->

                                                        <div class="col-md-3">
                                                            <label for="start_date">From:</label>
                                                            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="end_date">To:</label>
                                                            <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="status">Status:</label>
                                                            <select id="status" name="status" class="form-control">
                                                                <option value="">Select Status</option>
                                                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Pending</option>
                                                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Success</option>
                                                                <option value="2" {{ request('status') === '2' ? 'selected' : '' }}>Failed</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <button type="submit" class="btn btn-primary" style="margin-top: 24px;">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            {{-- <div class="alert alert-primary mt-3">
                                                <strong>Total Amount:</strong> KES {{ number_format($totalAmount, 2) }}
                                        </div> --}}


                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="card">

                                                <div class="card-block">
                                                    <div class="dt-responsive table-responsive">
                                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>Payment Date</th>
                                                                    <th>Journal Reference ID</th>
                                                                    <th>CLC Journal ID</th>
                                                                    <th>CLC Date</th>
                                                                    <th>Paid Amount</th>
                                                                    <th>Payment ID</th>
                                                                    <th>Transfer Number</th>
                                                                    <th>ITN Status</th>
                                                                    <th>ITN Response</th>
                                                                    {{-- <th>Transaction Code</th> --}}
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($results as $row)
                                                                <tr>
                                                                    <td>{{ $row->paymentDate }}</td>
                                                                    <td>{{ $row->journal_reference_id }}</td>
                                                                    <td>{{ $row->clcJournalId }}</td>
                                                                    <td>{{ $row->clcDate }}</td>
                                                                    <td>{{ $row->paidAmount }}</td>
                                                                    <td>{{ $row->paymentId }}</td>
                                                                    <td>{{ $row->transferNumber }}</td>
                                                                    <td>
                                                                        @if ($row->itn_status == 0)
                                                                        Pending
                                                                        @elseif ($row->itn_status == 1)
                                                                        Success
                                                                        @elseif ($row->itn_status == 2)
                                                                        Failed
                                                                        @else
                                                                        Unknown
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $row->itn_response }}</td>

                                                                </tr>
                                                                @endforeach
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.remove();
                }, 3000);
            }

            var currentUrl = window.location.pathname;
            if (currentUrl.startsWith('/payment-reports')) {
                var paymentReportMenu = document.getElementById('journal-details-menu')
                var createPaymentReportSubmenu = paymentReportMenu.querySelector('.pcoded-submenu');

                paymentReportMenu.classList.add('pcoded-trigger');
                createPaymentReportSubmenu.style.display = 'block';

                if (currentUrl.includes('/payment-reports')) {
                    document.getElementById('payment-reports').classList.add('active');
                }
            }
        });
    </script>
    <script type="text/javascript" src="{{asset('assets/files/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/files/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/files/bower_components/popper.js/dist/umd/popper.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/files/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/files/bower_components/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/files/bower_components/modernizr/modernizr.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/files/bower_components/modernizr/feature-detects/css-scrollbars.js')}}"></script>

    <script src="{{asset('assets/files/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/files/assets/pages/data-table/js/jszip.min.js')}}"></script>
    <script src="{{asset('assets/files/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/files/assets/pages/data-table/js/vfs_fonts.js')}}"></script>

    <script src="{{asset('assets/files/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/files/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>

    <script src="{{asset('assets/files/assets/pages/data-table/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>

    <script src="{{asset('assets/files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/files/bower_components/i18next/i18next.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/files/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/files/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/files/bower_components/jquery-i18next/jquery-i18next.min.js')}}"></script>

    <script src="{{asset('assets/files/assets/pages/data-table/js/data-table-custom.js')}}"></script>

    <script src="{{asset('assets/files/assets/js/pcoded.min.js')}}"></script>
    <script src="{{asset('assets/files/assets/js/vartical-layout.min.js')}}"></script>
    <script src="{{asset('assets/files/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/files/assets/js/script.js')}}"></script>
</body>


</html>
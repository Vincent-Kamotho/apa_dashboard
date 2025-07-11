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
                                                        <h4>Basic Table Sizes</h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">

                                                <div class="card">

                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Local Reference ID</th>
                                                                        <th>Local Description</th>
                                                                        <th>Event Description</th>
                                                                        <th>Posting Date</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($journalMasters as $journalMaster)
                                                                    <tr>
                                                                        <td>{{ $journalMaster->journal_reference_id }}</td>
                                                                        <td>{{ $journalMaster->journal_description }}</td>
                                                                        <td>{{ $journalMaster->event_description }}</td>
                                                                        <td>{{ $journalMaster->posting_date }}</td>
                                                                        
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
            if(currentUrl.startsWith('/journal-master')) {
                var journalMastersMenu = document.getElementById('journal-details-menu')
                var createJournalMastersSubmenu = journalMastersMenu.querySelector('.pcoded-submenu');

                journalMastersMenu.classList.add('pcoded-trigger');
                createJournalMastersSubmenu.style.display = 'block';

                if (currentUrl.includes('/journal-master')) {
                    document.getElementById('journal-master').classList.add('active');
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
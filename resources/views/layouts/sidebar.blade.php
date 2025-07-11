<div class="pcoded-inner-navbar main-menu">
    <div class="pcoded-navigatio-lavel">APA</div>
    <ul class="pcoded-item pcoded-left-item">
        <!-- <li class="pcoded-hasmenu active pcoded-trigger"> -->
        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)">
                <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                <span class="pcoded-mtext">Dashboard</span>
            </a>
            <ul class="pcoded-submenu">
                <!-- <li class="active"> -->
                <li class="">
                    <a href="default/index.html">
                        <span class="pcoded-mtext">Default</span>
                    </a>
                </li>
            </ul>
        </li>    
    </ul>
    <ul class="pcoded-item pcoded-left-item">
        <li id="journal-details-menu" class="pcoded-hasmenu">
            <a href="javascript:void(0)">
                <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                <span class="pcoded-mtext">Journal</span>
            </a>
            <ul class="pcoded-submenu">
                <li id="journal-list" class=" ">
                    <a href="{{route('journal')}}">
                        <span class="pcoded-mtext">Failed Transaction Report</span>
                    </a>
                </li>
                <li id="payment-reports" class=" ">
                    <a href="{{route('payment-reports')}}">
                        <span class="pcoded-mtext">Payment Reports (BPV)</span>
                    </a>
                </li>
                <li id="journal-details" class=" ">
                    <a href="{{route('journal-details')}}">
                        <span class="pcoded-mtext">Journal Details</span>
                    </a>
                </li>
                <li id="journal-master" class=" ">
                    <a href="{{route('journal-master')}}">
                        <span class="pcoded-mtext">Journal Master</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="false" data-slide-speed="200">
    <li class="nav-item start {{ request()->segment(1) == '' ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fa fa-home"></i>
            <span class="title">Dasbor</span>
        </a>
    </li>
    <li class="nav-item {{ request()->segment(1) == 'schedule' ? 'active' : '' }}">
        <a class="nav-link" href="/schedule">
            <i class="fa fa-ship"></i>
            <span class="title">Schedule</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fa fa-calendar"></i>
            <span class="title">Asset</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('transaction.index')}}">
            <i class="fa fa-ticket"></i>
            <span class="title">Transaction</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/operational">
            <i class="fa fa-ship"></i>
            <span class="title">Operational</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fa fa-user"></i>
            <span class="title">Customer</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fa fa-line-chart"></i>
            <span class="title">Report</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fa fa-users"></i>
            <span class="title">User</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-docs"></i>
            <span class="title">Master Data</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item {{ request()->segment(1) == 'port' ? 'active' : '' }}">
                <a class="nav-link" href="/port">
                    <span class="title">Port</span>
                </a>
            </li>
            <li class="nav-item {{ request()->segment(1) == 'area' ? 'active' : '' }}">
                <a class="nav-link" href="/area">
                    <span class="title">Area</span>
                </a>
            </li>                     
        </ul>
    </li>
</ul>
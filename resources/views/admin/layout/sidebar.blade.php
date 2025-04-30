{{-- sidebar --}}
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
<div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
    <img src="{{ asset('style/TheEvent/assets/img/logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
    {{-- <img class="w-50 mx-auto" src="../assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration"> --}}

    {{-- <span class="ms-1 font-weight-bold">Argon Dashboard 2</span> --}}
    </a>
</div>
<hr class="horizontal dark mt-0">
<div class="collapse navbar-collapse w-auto h-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
    <li class="nav-item">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Registration</h6>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($title === "dashboard") ? 'active' : '' }}" href="{{ route('dashboard') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-desktop text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($title === "classes") ? 'active' : '' }}" href="{{ route('classes') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-clone text-warning text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Classes</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($title === "teams") ? 'active' : '' }}" href="{{ route('teams') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-users text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Teams</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($title === "athletes") ? 'active' : '' }}" href="{{ route('athletes') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-user text-info text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Athletes</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($title === "payments") ? 'active' : '' }}" href="{{ route('payments') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-wallet text-danger text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Payments</span>
        </a>
    </li>
    <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Admin</h6>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($title === "Messages") ? 'active' : '' }}" href="{{ route('admin.messages') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-envelope text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Messages</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($title === "News") ? 'active' : '' }}" href="{{ route('admin.news') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-newspaper-o text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">News</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.schedules') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-list text-warning text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Schedule</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.venue') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-compass  text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Venues</span>
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link " href="{{ route('payments') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-map text-info text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Hotels</span>
        </a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.galleries') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-images text-danger text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Galleries</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.sponsors') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-link text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Sponsors</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.faqs') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-comments text-warning text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">FAQs</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.transactions') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-file-invoice-dollar text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Transactions</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.systems') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-gear text-danger text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Systems</span>
        </a>
    </li>
    {{-- <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Results</h6>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('payments') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-chart-line text-info text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Teams Ranking</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('payments') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-medal text-danger text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">List of Winners</span>
        </a>
    </li> --}}
    </ul>
</div>
{{-- <div class="sidenav-footer mx-3 ">
</div> --}}
</aside>
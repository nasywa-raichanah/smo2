{{-- sidebar --}}
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
<div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
    <img src="{{ asset('style/TheEvent/assets/img/logo_panjang.png') }}" class="navbar-brand-img h-100" alt="main_logo">
    {{-- <img class="w-50 mx-auto" src="../assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration"> --}}

    {{-- <span class="ms-1 font-weight-bold">Argon Dashboard 2</span> --}}
    </a>
</div>
<hr class="horizontal dark mt-0">
<div class="collapse navbar-collapse w-auto h-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ ($title === "My Board") ? 'active' : '' }}" href="{{ route('my-dashboard') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-desktop text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">My Board</span>
        </a>
    </li>
    <li class="nav-item">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Registration</h6>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($title === "My Team" || $title === "Edit Team" ) ? 'active' : '' }}" href="{{ route('my-team') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-users text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">My Team</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($title === "My Athletes") ? 'active' : '' }}" href="{{ route('my-athletes') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-user text-info text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">My Athletes</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($title === "Classes") ? 'active' : '' }}" href="{{ route('my-classes') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-clone text-warning text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Classes</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($title === "Payment") ? 'active' : '' }}" href="{{ route('my-payment') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-wallet text-danger text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Payment</span>
        </a>
    </li>
    <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Results</h6>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link " href="#">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-chart-line text-info text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Teams Ranking</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="#">
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
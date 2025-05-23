<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
          <li class="breadcrumb-item text-sm text-white text-capitalize active" aria-current="page">{{ $title }}</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0 text-capitalize">{{ $title }}</h6>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          @if ($title == 'teams' or $title == 'athletes' or $title == 'payments')
          <form action="{{ route($title) }}">
          <div class="input-group">
              <input type="text" class="form-control" placeholder="Type here..." name="search" value="{{ request('search') }}">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
            </div>
          </form>
          @endif
        </div>
        <ul class="navbar-nav  justify-content-end">
          
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
              </div>
            </a>
          </li>
          <li class="nav-item px-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white p-0">
              <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
            </a>
          </li>
          <li class="nav-item dropdown pe-2 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white font-weight-bold px-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-sign-out cursor-pointer"></i>
              <span class="d-sm-inline d-none">Logout</span>
            </a>
            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
              <li class="mb-2">
                Are you sure you want to log out?
                <div class="d-flex justify-content-center">
                  <form action="/logout" method="POST" id="logout">
                    @csrf
                    <a class="dropdown-item gradient text-white border-radius-md" href="#" onclick="document.getElementById('logout').submit()">
                      Yes, logout now
                    </a>
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
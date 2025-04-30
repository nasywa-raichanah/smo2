@extends('admin.layout.app')
@section('content')    
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Countdown</p>
                <h5 class="font-weight-bolder">
                  {{ \Carbon\Carbon::parse($event_date)->diffInDays() }} Days
                </h5>
                <p class="mb-0">
                  <span class="text-sm">competition date: {{ date('d M Y', strtotime($event_date)) }}</span>
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="fas fa-hourglass-half text-lg opacity-10"aria-hidden="true"></i>
                {{-- <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Teams</p>
                <h5 class="font-weight-bolder">
                  {{ $teams->count() - $total_invalid_teams }}<span class="text-sm">/{{ $teams->count() }}</span>
                </h5>
                <p class="mb-0">
                  <span class="text-sm">unvalidated yet:
                  <br> {{ $total_invalid_teams }}
                </span>
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Athletes</p>
                <h5 class="font-weight-bolder">
                  {{ $athletes->count() - $invalid_athletes->count() }}<span class="text-sm">/{{ $athletes->count() }}</span>
                </h5>
                <p class="mb-0">
                  <span class="text-sm">unvalidated yet:
                  <br> {{ $invalid_athletes->count() }}
                </span>
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                <i class="fas fa-user text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Paid Income</p>
                <h5 class="font-weight-bolder">
                  @rupiah($invoices_all->where('status','=','1')->sum('total'))
                </h5>
                <p class="mb-0">
                  <span class="text-sm">unpaid:
                  <br> @rupiah($invoices_all->where('status','!=','1')->sum('total'))
                </span>
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                <i class="fas fa-wallet text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-12">
      <div class="card mb-2">
        @if ($invalid_teams->count())    
        <div class="card-header pb-0">
          <div class="row justify-content-between">
              <div class="col">
                <h6>Teams List</h6>
                <p>has not been validated</p>
              </div>
              <div class="col text-right">
                <button class="btn btn-link text-secondary mb-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-v text-xs"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('teams') }}"><i class="fas fa-arrow-right"></i> See More</a>
                </div>
              </div>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  {{-- <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 5%">#</th> --}}
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 25%">Team</th>
                  {{-- <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Address</th> --}}
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 5%">Total Athletes</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Manager</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Cost</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 10%">Status</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 15%">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($invalid_teams as $team)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset('images/teams/'. $team->logo)}}" class="avatar avatar-sm me-3" alt="{{ $team->username }}">
                      </div>
                      <div class="justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $team->username }}</h6>
                        <p class="text-xs text-secondary mb-0">{{ $team->address }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs text-secondary mb-0">{{ $athletes->where('user_id',$team->id)->count() }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <h6 class="mb-0 text-xs">{{ $managers->where('id','=',$team->manager_id)->first()->manager_name }}</h6>
                    <a href="https://wa.me/{{ $managers->where('id','=',$team->manager_id)->first()->whatsapp_num }}"><p class="text-xs text-secondary mb-0 txt-gradient-success">WhatsApp</p></a>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">@rupiah($payments->where('user_id',$team->id)->sum('total_cost'))</span>
                  </td>
                  <td class="align-middle text-center">
                    @switch($team->status)
                        @case(0)
                            <span class="fa-stack fa-xs" title="New" data-bs-toggle="tooltip" data-bs-placement="top">
                              <i class="fa fa-users fa-xs text-gray-300 fa-stack-2x"></i>
                              <i class="fa fa-circle fa-stack-1x fa-inverse text-info end-badge"></i>
                            </span>
                            @break
                        @case(1)
                            <span class="fa-stack fa-xs" title="Waiting" data-bs-toggle="tooltip" data-bs-placement="top">
                              <i class="fa fa-users fa-xs text-gray-300 fa-stack-2x"></i>
                              <i class="fa fa-exclamation fa-lg fa-stack-1x fa-inverse text-warning end-badge"></i>
                            </span>
                            @break
                        @case(2)
                            <span class="fa-stack fa-xs" title="Valid" data-bs-toggle="tooltip" data-bs-placement="top">
                              <i class="fa fa-users fa-xs text-gray-300 fa-stack-2x"></i>
                              <i class="fa fa-check fa-lg fa-stack-1x fa-inverse text-success end-badge"></i>
                            </span>
                            @break
                        @default
                        <span class="fa-stack fa-xs" title="Invalid" data-bs-toggle="tooltip" data-bs-placement="top">
                          <i class="fa fa-users fa-xs text-gray-300 fa-stack-2x"></i>
                          <i class="fa fa-times fa-lg fa-stack-1x fa-inverse text-danger end-badge"></i>
                        </span>
                    @endswitch
                  </td>
                  <td class="align-middle text-center text-sm">
                    <div class="btn-group">
                      <button class="btn gradient text-white btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu text-secondary">
                        <a class="dropdown-item" href="{{ route('detail-team', $team->id) }}"><i class="fas fa-eye"></i> Detail</a>
                        <a class="dropdown-item" href="{{ route('teams') }}"><i class="fas fa-arrow-right"></i> See More</a>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $invalid_teams->links() }}
          </div>
        </div>
        @else
        <div class="card-header pb-0">
          <div class="row justify-content-between">
              <div class="col">
                <h6>Teams List</h6>
                <p>has not been validated</p>
              </div>
              <div class="col text-right">
                <button class="btn btn-link text-secondary mb-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-v text-xs"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('teams') }}"><i class="fas fa-arrow-right"></i> See More</a>
                </div>
              </div>
          </div>
        </div>
        <div class="card-body my-8 px-0 pt-0 pb-2 text-center">
          <h3 class="align-middle text-center txt-gradient-success"><i class="fas fa-check-circle fa-4x"></i><br> there isn't any invalid teams</h3>
        </div>
          <tr>
          </tr>
        @endif
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-5 mt-3">
      <div class="card">
        @if ($classes->count())
        <div class="card-header pb-0 p-3">
          <div class="row justify-content-between">
              <div class="col">
                <h6>Classes</h6>
              </div>
              <div class="col text-right">
                <button class="btn btn-link text-secondary mb-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-v text-xs"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('classes') }}"><i class="fas fa-arrow-right"></i> See More</a>
                </div>
              </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center ">
            <tbody>
              @foreach ($classes as $class)
              <tr>
                <td class="w-30" style="width: 90%">
                  <div class="ms-4">
                    <h6 class="text-sm mb-0">
                      {{ $class->class_name }}
                    </h6>
                    <p class="text-xs font-weight-bold mb-0">{{ $athleteClass->where('classes_id', $class->id)->count() }} athletes</p>
                  </div>
                </td>
                <td class="text-sm" style="width: 10%">
                  <div class="d-flex">
                    <a href="{{ route('detail-class', $class->id) }}"><button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button></a>
                  </div>
                </td>
              </tr>  
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="card-header pb-0 p-3">
          <div class="row justify-content-between">
              <div class="col">
                <h6>Classes</h6>
              </div>
              <div class="col text-right">
                <button class="btn btn-link text-secondary mb-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-v text-xs"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('classes') }}"><i class="fas fa-arrow-right"></i> See More</a>
                </div>
              </div>
          </div>
        </div>
        <div class="card-body my-8 px-0 pt-0 pb-2 text-center">
          <h3 class="align-middle text-center text-secondary"><i class="fas fa-exclamation-triangle fa-4x"></i><br> there isn't any Class yet</h3>
        </div>
          <tr>
          </tr>
        @endif
      </div>
    </div>
    <div class="col-lg-7 mb-lg-0 mb-4 mt-3">
      <div class="card">
        @if ($invoices->count())
        <div class="card-header pb-0 p-3">
          <div class="row justify-content-between">
            <div class="col">
              <h6>Payment History</h6>
            </div>
            <div class="col text-right">
              <button class="btn btn-link text-secondary mb-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v text-xs"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('payments') }}"><i class="fas fa-arrow-right"></i> See More</a>
              </div>
            </div>
        </div>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center ">
            <tbody>
              @foreach ($invoices as $invoice) 
              <tr>
                <td>
                  <div class="text-center">
                    <h6 class="text-sm mb-0">{{ date('d M Y h:i:s', strtotime($invoice->updated_at)) }}</h6>
                  </div>
                </td>
                <td class="w-30">
                  <div class="ms-4">
                    <p class="text-xs font-weight-bold mb-0">{{ $invoice->user->username }}</p>
                    <h6 class="text-sm mb-0">@rupiah($payments->where('user_id',$invoice->user_id)->sum('total_cost'))</h6>
                  </div>
                </td>
                <td class="align-middle align-items-center justify-content-center">
                  <div class="text-center">
                    @switch($invoice->status)
                        @case(0)
                        <span class="fas fa-exclamation text-warning" title="Unpaid" data-bs-toggle="tooltip" data-bs-placement="top"></span>
                        @break
                        @case(1)
                        <span class="fas fa-check text-success" title="Paid" data-bs-toggle="tooltip" data-bs-placement="top"></span>
                            @break
                        @default
                            error
                    @endswitch
                  </div>
                  {{-- <div class="col text-center">
                    <p class="text-xs font-weight-bold mb-0">Status:</p>
                  </div> --}}
                </td>
                <td class="align-middle text-sm">
                  <div class="d-flex">
                    <a href="{{ route('detail-payment', $invoice->user_id) }}"><button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button></a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="card-header pb-0 p-3">
          <div class="row justify-content-between">
            <div class="col">
              <h6>Payment History</h6>
            </div>
            <div class="col text-right">
              <button class="btn btn-link text-secondary mb-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v text-xs"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('payments') }}"><i class="fas fa-arrow-right"></i> See More</a>
              </div>
            </div>
        </div>
        </div>
        <div class="card-body my-8 px-0 pt-0 pb-2 text-center">
          <h3 class="align-middle text-center text-secondary"><i class="fas fa-exclamation-triangle fa-4x"></i><br> there isn't any Payment yet</h3>
        </div>
          <tr>
          </tr>
        @endif
      </div>
    </div>
  </div>
  
  <footer class="footer pt-3  ">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6 mb-lg-0 mb-4">
          <div class="copyright text-center text-sm text-muted text-lg-start">
              Presented by <b>ORMAWA INKAI UNS</b>
            © <script>
              document.write(new Date().getFullYear())
            </script>. Theme <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link text-muted">Home</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</div>
@endsection

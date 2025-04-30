@extends('admin.layout.app')
@section('content')
<div class="container-fluid py-4">
    <div class="row mb-3">
    <div class="col-sm-4">
    <div class="card">
    <div class="card-body p-3 position-relative">
    <div class="row">
    <div class="col-7 text-start">
    <p class="text-sm mb-1 text-uppercase font-weight-bold">Paid Incomes</p>
    <h5 class="font-weight-bolder mb-0">
      @rupiah($invoices_all->where('status','=','1')->sum('total'))
    </h5>
    <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0">{{ $invoices_all->where('status','=','1')->count() }} team(s)</span>
    </div>
    </div>
    </div>
        </div>
    </div>
    <div class="col-sm-4 mt-sm-0 mt-4">
    <div class="card">
    <div class="card-body p-3 position-relative">
    <div class="row">
    <div class="col-7 text-start">
    <p class="text-sm mb-1 text-uppercase font-weight-bold">To be validated</p>
    <h5 class="font-weight-bolder mb-0">
    @rupiah($invoices_all->where('status','!=','1')->sum('total'))
    </h5>
    <span class="font-weight-bolder text-secondary text-sm">{{ $invoices_all->where('status','!=','1')->count() }} team(s)</span>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-sm-4 mt-sm-0 mt-4">
      <div class="card">
          <div class="card-body p-3 position-relative">
              <div class="row">
                  <div class="col-7 text-start">
                      <p class="text-sm mb-1 text-uppercase font-weight-bold">Total Incomes</p>
                      <h5 class="font-weight-bolder mb-0">
                       @rupiah($invoices_all->sum('total'))
                      </h5>
                      <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0">{{ $invoices_all->count() }} team(s)</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            {{-- @if ($athletes->count())     --}}
            <div class="card-header pb-0">
              <div class="row justify-content-between">
                  <div class="col">
                    <h6>Payments List</h6>
                  </div>
                  <div class="col text-right">
                    <button class="btn btn-link text-secondary mb-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-xs"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('payments-print') }}" target="_blank"><i class="fas fa-print"></i> Print</a>
                    </div>
                  </div>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                        {{-- id invoice, date, status, name, cost, action --}}
                      <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 25%">Name</th>
                      <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Date</th>
                      <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Cost</th>
                      <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 10%">Status</th>
                      <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 15%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($invoices as $invoice)
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="{{ asset('images/teams/'. $invoice->user->logo)}}" class="avatar avatar-sm me-3" alt="{{ $invoice->user->username }}">
                            </div>
                            <div class="justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $invoice->user->username }}</h6>
                              <a class="text-xs text-secondary mb-0" href="{{ route('detail-payment', $invoice->user_id) }}">{{ $invoice->invoice_code }}</a>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <p class="text-xs text-secondary mb-0">{{ date('d M Y h:i:s', strtotime($invoice->updated_at)) }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <p class="text-xs text-secondary mb-0">
                            @rupiah($payments->where('user_id',$invoice->user_id)->sum('total_cost'))
                          </p>
                        </td>
                        <td class="text-xs text-center font-weight-bold">
                            <div class="d-flex align-items-center justify-content-center">
                              @switch($invoice->status)
                                  @case(0)
                                  <button class="btn btn-icon-only btn-rounded btn-outline-warning mb-0 me-2 btn-sm d-flex justify-content-center align-items-center btn-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Unpaid"><i class="fas fa-exclamation" aria-hidden="true"></i></button>
                                      @break
                                  @case(1)
                                  <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center btn-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Paid"><i class="fas fa-check" aria-hidden="true"></i></button>
                                      @break
                                  @default
                                      error
                              @endswitch
                            </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <div class="btn-group">
                            <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </button>
                            <div class="dropdown-menu text-secondary">
                              <a class="dropdown-item" href="{{ route('detail-payment', $invoice->user_id) }}"><i class="fas fa-eye"></i> Detail</a>
                            </div>
                          </div>
                        </td>
                      </tr> 
                    @endforeach
                  </tbody>
                </table>
                {{ $invoices->links() }}
              </div>
            </div>
            {{-- @else
            <div class="card-header pb-0">
              <h6>Payments List</h6>
            </div>
            <div class="card-body my-8 px-0 pt-0 pb-2 text-center">
              <h3 class="align-middle text-center text-secondary"><i class="fas fa-exclamation-triangle fa-4x"></i><br> Payment(s) not found</h3>
            </div>
              <tr>
              </tr>
            @endif --}}
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
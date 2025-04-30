@extends('participant.layout.app')
@section('content')    
<div class="container-fluid py-4">
  <div class="row justify-content-center">
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
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Team Status</p>
                <h5 class="font-weight-bolder">
                  @switch($team->status)
                    @case(0)
                        New
                        @break
                    @case(1)
                        Waiting
                        @break
                    @case(2)
                        Valid
                        @break
                    @default
                    Invalid
                  @endswitch
                </h5>
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
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Athletes Status</p>
                <h5 class="font-weight-bolder">
                  @if ($invalid_athletes->count())
                      Invalid
                  @else
                  @if ($waiting_athletes->count())
                      Waiting
                  @else
                  @if ($new_athletes->count())
                      New
                  @else
                  @if ($valid_athletes->count())
                      Valid
                  @else
                  -
                  @endif
                  @endif
                  @endif
                  @endif
                </h5>
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
  </div>
  <div class="row">
    <div class="col-lg-4 mt-3">
      <div class="card">
        <div class="card-body pb-0">
            <div class="text-center">
              <img src="{{ asset('images/teams/'. $team->logo) }}" class="mt-2 border-radius-lg shadow-sm" alt="" style="width: 12rem">
                <h4 class="card-widget__title text-dark mt-3">{{ auth()->user()->username }} <img class="border" alt="{{ $team->nationality }}" style="width: 25px" src="{{ asset('images/systems/flags/'. $team->nationality . '.svg')}}"></h4>
                {{-- <div class="row">
                  <div class="col">
                  </div>
                  <div class="col">
                  </div>
                </div> --}}
                <p class="text-muted">Manager: {{ $manager->manager_name }}</p>
                <div class="d-flex flex-row justify-content-center">
                  <div class="p-2">
                      <a class="btn bg-gradient-danger" href="{{ route('my-team-print') }}" target="_blank" role="button"><i class="fa fa-lg fa-print" onclick="#" aria-hidden="true"></i></a>
                  </div>
                  <div class="p-2">
                      <a class="btn bg-gradient-danger px-5" href="{{ route('my-team') }}">My Team</a>
                      {{-- <button class="btn bg-gradient-danger" onClick="window.print()" type="button" name="button">Print</button> --}}
                  </div>
                </div>
                {{-- <div class="row">
                  <div class="col-3">
                    <a class="btn bg-gradient-danger border-0 btn-rounded px-5" href="{{ route('my-team') }}"></a>
                  </div>
                  <div class="col-9">
                    <a class="btn bg-gradient-danger border-0 btn-rounded px-5" href="{{ route('my-team') }}">My Team</a>
                  </div>
                </div> --}}
                <hr>
            </div>
        </div>
        <div class="card-footer border-0 bg-transparent py-0">
            <div class="row">
                <div class="col-4 border-right-1">
                    <a class="text-center d-block text-muted" href="{{ route('my-athletes') }}">
                        <span class="badge bg-gradient-danger text-white">{{ $total_athletes }}</span>
                        <p class="">Athletes</p>
                    </a>
                </div>
                <div class="col-4 border-right-1">
                    <a class="text-center d-block text-muted" href="{{ route('my-classes') }}">
                        <span class="badge bg-gradient-danger text-white">{{ $classtotal }}</span>
                        <p class="">Classes</p>
                    </a>
                </div>
                <div class="col-4">
                    <a class="text-center d-block text-muted" href="#">
                        <span class="badge bg-gradient-danger text-white">-</span>
                        <p class="">Rank</p>
                    </a>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8 mb-lg-0 mb-4 mt-3">
      <div class="card">
        <div class="card-body px-0 pt-2">
            <h5 class="text-center">MESSAGES</h5>
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php $i = 1; @endphp
                      @foreach ($messages as $message)
                      <tr>
                          <td class="text-center">{{ $i++ }}</td>
                          <td>{{ $message->title }}</td>
                          <td>{{ $message->created_at->format('d M Y H:i:s') }}</td>
                          <td class="text-center"><span><a href="" data-bs-toggle="modal" data-bs-target="#modal-detail{{ $message->id }}"><i class="fa fa-eye text-warning m-r-5"></i> </a></span>
                          </td>
                      </tr>
                      <!-- Modal -->
                      <div class="modal fade" id="modal-detail{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-detail" aria-hidden="true">
                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h6 class="modal-title" id="modal-title-add">{{ $message->title }}</h6>
                              <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p>{!! $message->message !!}</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

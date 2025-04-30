@extends('admin.layout.app')
@section('content')    
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        @if ($athletes->count())    
        <div class="card-header pb-0">
          <div class="row justify-content-between">
              <div class="col">
                <h6>Athletes List</h6>
                <p>number of athletes: {{ $total }}</p>
              </div>
              <div class="col text-right">
                <button class="btn btn-link text-secondary mb-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-v text-xs"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('athletes-print') }}" target="_blank"><i class="fas fa-print"></i> Print</a>
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
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 25%">Name</th>
                  {{-- <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Address</th> --}}
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Place & Date of Birth</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 5%"><i class="fa fa-intersex"></i></th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Class</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 10%">Req Status</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 15%">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($athletes as $athlete)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset('images/teams/athletes/' . $athlete->photo) }}" class="avatar avatar-sm me-3" alt="{{ $athlete->athlete_name }}">
                      </div>
                      <div class="justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $athlete->athlete_name }}</h6>
                        <p class="text-xs text-secondary mb-0">{{ $athlete->user->username }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs text-secondary mb-0">{{ $athlete->birth_place }}, {{ date('d M Y', strtotime($athlete->birth_date)) }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    @if ($athlete->sex == 0)
                      <i class="fa fa-mars text-primary"></i>
                    @else
                    @if ($athlete->sex == 1)
                      <i class="fa fa-venus text-danger"></i>
                    @endif
                    @endif
                  </td>
                  <td class="align-middle text-center text-sm">
                    @foreach ($athleteClass as $class)
                      @if ($class->athletes_id == $athlete->id)
                      <a href="{{ route('detail-my-class', $class->classes->id) }}"><span class="badge badge-info">{{ $class->classes->class_name }}</span></a><br>                        
                      @endif
                    @endforeach
                  </td>
                  <td class="align-middle text-center">
                    @switch($athlete->status)
                    @case(0)
                      <span class="badge badge-sm bg-gradient-primary">new</span>
                      @break
                    @case(1)
                      <span class="badge badge-sm bg-gradient-warning">waiting</span>
                      @break
                    @case(2)
                      <span class="badge badge-sm bg-gradient-success">valid</span>
                      @break
                    @default
                      <span class="badge badge-sm bg-gradient-danger">invalid</span>  
                    @endswitch
                  </td>
                  <td class="align-middle text-center text-sm">
                    <div class="btn-group">
                      <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu text-secondary">
                        <a class="dropdown-item" href="{{ route('detail-athlete', $athlete->id) }}"><i class="fas fa-eye"></i> Detail</a>
                        <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-valid{{ $athlete->id }}"><i class="fas fa-check-double"></i> Validation</a>
                        {{-- <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $athlete->id }}"><i class="fas fa-trash"></i> Delete</a> --}}
                      </div>
                    </div>
                  </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="modal-valid{{ $athlete->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-valid" aria-hidden="true">
                  <div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-valid">Documents Validate: {{ $athlete->athlete_name }}</h6>
                        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form role="form text-left" method="POST" action="{{ route('athlete-validation', $athlete->id) }}" enctype="multipart/form-data">
                          @method('patch')
                          @csrf
                          <div class="row justify-content-center gx-0">
                            <div class="col-lg-3">
                              <label>National Identity Card</label>
                              <br class="py-0">
                              @if ($athlete->nic)
                              <iframe src="{{ asset('images/teams/athletes/documents/' . $athlete->nic) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 11rem"></iframe>
                              <button type="button" class="btn bg-gradient-primary"><a href="{{ asset('images/teams/athletes/documents/' . $athlete->nic) }}" download><i class="fas fa-file-download"></i></a></button>
                              @else
                              <img src="{{ asset('images/teams/athletes/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 11rem">
                              @endif
                            </div>
                            <div class="col-lg-3">
                              <label>Campus Card</label>
                              <br class="py-0">
                              @if ($athlete->campus_card)
                              <iframe src="{{ asset('images/teams/athletes/documents/' . $athlete->campus_card) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 11rem"></iframe>
                              <button type="button" class="btn bg-gradient-primary"><a href="{{ asset('images/teams/athletes/documents/' . $athlete->campus_card) }}" download><i class="fas fa-file-download"></i></a></button>
                              @else
                              <img src="{{ asset('images/teams/athletes/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 11rem">
                              @endif
                            </div>
                            <div class="col-lg-3">
                              <label>Karate Belt Certificate</label>
                              <br class="py-0">
                              @if ($athlete->belt_certificate)
                              <iframe src="{{ asset('images/teams/athletes/documents/' . $athlete->belt_certificate) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 11rem"></iframe>
                              <button type="button" class="btn bg-gradient-primary"><a href="{{ asset('images/teams/athletes/documents/' . $athlete->belt_certificate) }}" download><i class="fas fa-file-download"></i></a></button>
                              @else
                              <img src="{{ asset('images/teams/athletes/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 11rem">
                              @endif
                            </div>
                            <div class="col-lg-3">
                              <label>College Proof of Payment</label>
                              <br class="py-0">
                              @if ($athlete->college_payment)
                                <iframe src="{{ asset('images/teams/athletes/documents/' . $athlete->college_payment) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 11rem"></iframe>
                                <button type="button" class="btn bg-gradient-primary"><a href="{{ asset('images/teams/athletes/documents/' . $athlete->college_payment) }}" download><i class="fas fa-file-download"></i></a></button>
                                @else
                              <img src="{{ asset('images/teams/athletes/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 11rem">
                              @endif
                            </div>
                          </div>
                          <div class="row mx-auto">
                            <div class="col">
                              <p>Athlete Status:</p>
                              <div class="form-check form-check-inline">
                                <input  class="form-check-input" type="radio" name="status" value="0" id="status0" {{$athlete->status == '0'? 'checked' : ''}} ><label class="form-check-label" for="status0"> New </label>
                                <br>
                                <input  class="form-check-input" type="radio" name="status" value="1" id="status1" {{$athlete->status == '1'? 'checked' : ''}} ><label class="form-check-label" for="status1"> Waiting </label>
                                <br>
                                <input  class="form-check-input" type="radio" name="status" value="2" id="status2" {{$athlete->status == '2'? 'checked' : ''}} ><label class="form-check-label" for="status2"> Valid </label>
                                <br>
                                <input  class="form-check-input" type="radio" name="status" value="3" id="status3" {{$athlete->status == '3'? 'checked' : ''}} ><label class="form-check-label" for="status3"> Invalid </label>
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer d-flex justify-content-end">
                            <button type="submit" class="btn gradient text-white my-0">Update</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </tbody>
            </table>
            {{ $athletes->links() }}
          </div>
        </div>
        @else
        <div class="card-header pb-0">
          <h6>Athletes List</h6>
        </div>
        <div class="card-body my-8 px-0 pt-0 pb-2 text-center">
          <h3 class="align-middle text-center text-secondary"><i class="fas fa-exclamation-triangle fa-4x"></i><br> Athlete(s) not found</h3>
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

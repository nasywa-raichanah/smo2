@extends('admin.layout.app')
@section('content')    
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        @if ($teams->count())    
        <div class="card-header pb-0">
          <div class="row justify-content-between">
              <div class="col">
                <h6>Teams List</h6>
                <p>number of teams: {{ $total }}</p>
              </div>
              <div class="col text-right">
                <button class="btn btn-link text-secondary mb-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-v text-xs"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('teams-print') }}" target="_blank"><i class="fas fa-print"></i> Print</a>
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
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 5%">Athletes</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Manager</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Cost</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 10%">Status</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 10%">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($teams as $team)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset('images/teams/'. $team->logo)}}" class="avatar avatar-sm me-3" alt="{{ $team->username }}">
                      </div>
                      <div class="justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $team->username }}</h6>
                        <p class="text-xs text-wrap text-secondary mb-0">{{ $team->address }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs text-secondary mb-0">{{ $athletes->where('user_id',$team->id)->count() }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    @if ($managers->where('id',$team->manager_id)->first())
                    <h6 class="mb-0 text-xs">{{ $managers->where('id',$team->manager_id)->first()->manager_name }}</h6>
                    <a href="https://wa.me/{{ $managers->where('id',$team->manager_id)->first()->whatsapp_num }}"><p class="text-xs text-secondary mb-0 txt-gradient-success">WhatsApp</p></a>
                    @endif
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
                      <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu text-secondary">
                        <a class="dropdown-item" href="{{ route('detail-team', $team->id) }}"><i class="fas fa-eye"></i> Detail</a>
                        {{-- <a class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a> --}}
                        <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-valid{{ $team->id }}"><i class="fas fa-check-double"></i> Validation</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $team->id }}"><i class="fas fa-trash"></i> Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="modal-valid{{ $team->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-valid" aria-hidden="true">
                  <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-valid">Validation Team</h6>
                        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form role="form text-left" method="POST" action="{{ route('teams-validation', $team->id) }}" enctype="multipart/form-data">
                          @method('patch')
                          @csrf
                          <div class="row mx-auto">
                            <div class="col align-self-center text-center">
                              @if ($team->mandate_letter)
                                {{-- <embed type="application/pdf" src="{{ asset('images/teams/documents/' . $team->mandate_letter) }}" width="600" height="400"></embed> --}}
                                {{-- <object data="{{ asset('images/teams/documents/' . $team->mandate_letter) }}" width="600" height="400"></object> --}}
                                {{-- <iframe src="{{ asset('images/teams/documents/' . $team->mandate_letter) }}#toolbar=0" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem"></iframe> --}}
                                <button type="button" class="btn bg-gradient-primary text-white my-0"><a href="{{ asset('images/teams/documents/' . $team->mandate_letter) }}" target="_blank"><i class="fas fa-eye"></i> Preview</a></button>
                                {{-- <a href="{{ asset('images/teams/documents/' . $team->mandate_letter) }}" target="_BLANK">Preview</a> --}}
                              @else
                                <img src="{{ asset('images/teams/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem" scrolling="auto">
                              @endif
                            </div>
                            <div class="col">
                              <p>Team Status:</p>
                              <div class="form-check form-check-inline">
                                <input  class="form-check-input" type="radio" name="status" value="0" id="status0" {{$team->status == '0'? 'checked' : ''}} ><label class="form-check-label" for="status0"> New </label>
                                <br>
                                <input  class="form-check-input" type="radio" name="status" value="1" id="status1" {{$team->status == '1'? 'checked' : ''}} ><label class="form-check-label" for="status1"> Waiting </label>
                                <br>
                                <input  class="form-check-input" type="radio" name="status" value="2" id="status2" {{$team->status == '2'? 'checked' : ''}} ><label class="form-check-label" for="status2"> Valid </label>
                                <br>
                                <input  class="form-check-input" type="radio" name="status" value="3" id="status3" {{$team->status == '3'? 'checked' : ''}} ><label class="form-check-label" for="status3"> Invalid </label>
                                </div>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-3">
                              <p>Lock Data:</p>
                            </div>
                            <div class="col-8">
                              <div class="form-check form-check-inline">
                                <input  class="form-check-input" type="radio" name="is_confirm" value="0" id="is_confirm0" {{$team->is_confirm == '0'? 'checked' : ''}} ><label class="form-check-label" for="is_confirm0"> No </label>
                                <br>
                                <input  class="form-check-input" type="radio" name="is_confirm" value="1" id="is_confirm1" {{$team->is_confirm == '1'? 'checked' : ''}} ><label class="form-check-label" for="is_confirm1"> Yes </label>
                              </div>
                            </div>
                            <p class="text-sm text-secondary">locked data teams are only teams confirmed by that teams</p>
                          </div>
                          <div class="modal-footer d-flex justify-content-end">
                            @if ($team->mandate_letter)
                                <button type="button" class="btn bg-gradient-primary text-white my-0"><a href="{{ asset('images/teams/documents/' . $team->mandate_letter) }}" download><i class="fas fa-file-download"></i></a></button>
                            @endif
                            <button type="submit" class="btn gradient text-white my-0">Update</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-delete{{ $team->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
                  <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-add">Delete Team</h6>
                        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure to delete {{ $team->username }}?</p>
                      </div>
                      <div class="modal-footer">
                        <form role="form text-left" action="{{ route('teams-delete', $team->id) }}" method="POST">
                          @method('delete')
                          @csrf
                          <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </tbody>
            </table>
            {{ $teams->links() }}
          </div>
        </div>
        @else
        <div class="card-header pb-0">
          <div class="row justify-content-between">
              <div class="col">
                <h6>Teams List</h6>
                <p>number of teams: {{ $total }}</p>
              </div>
              <div class="col text-right">
                <button class="btn btn-link text-secondary mb-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-v text-xs"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#"><i class="fas fa-arrow-circle-up"></i> Export</a>
                  <a class="dropdown-item" href="#"><i class="fas fa-arrow-circle-down"></i> Import</a>
                </div>
              </div>
          </div>
        </div>
        <div class="card-body my-8 px-0 pt-0 pb-2 text-center">
          <h3 class="align-middle text-center text-secondary"><i class="fas fa-exclamation-triangle fa-4x"></i><br> Teams not found</h3>
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

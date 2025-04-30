@extends('admin.layout.app')
@section('content')    
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg">
      @if(session()->has('success'))
        <div class="alert alert-success text-white alert-dismissible fade show" role="alert">{{ session('success') }}
        </div>
      @endif
      @if(session()->has('fail'))
        <div class="alert alert-danger text-white alert-dismissible fade show" role="alert">{{ session('fail') }}
        </div>
      @endif
      @if(count($errors) > 0)
      @foreach ($errors->all() as $error)
          <div class="alert alert-danger text-white alert-dismissible fade show" role="alert">{{ $error }}</div>
      @endforeach
      @endif
  </div>
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="row justify-content-between">
              <div class="col">
                <h6>{{ $class->class_name }}</h6>
                <p>Total athletes: {{ $athleteClass->count() }}</p>
              </div>
              <div class="col text-right">
                {{-- <a class="btn bg-gradient-primary my-auto" href="{{ route('class-print', $class->id) }}" target="_blank"><i class="fa fa-lg fa-print"></i></a> --}}
                <a class="btn bg-gradient-primary my-auto" href="{{ route('detail-class-export', $class->id) }}" target="_blank"><i class="fa fa-lg fa-file-export"></i></a>
                <a class="btn bg-gradient-warning my-auto" href="" data-bs-toggle="modal" data-bs-target="#modal-edit{{ $class->id }}"><i class="fas fa-pencil-alt"></i></a>
                <a class="btn btn-warning my-auto" href="" data-bs-toggle="modal" data-bs-target="#modal-deleteclass{{ $class->id }}"><i class="fas fa-trash"></i></a>
                <a class="btn bg-gradient-danger my-auto" href="{{ url()->previous() }}">Back</a>
              </div>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  @if ($class->type == 1 || $class->type == 3)
                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 5%">#</th>
                  @endif
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 25%">Name</th>
                  {{-- <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Address</th> --}}
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Place & Date of Birth</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 5%"><i class="fa fa-intersex"></i></th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 10%">Weight</th>
                  {{-- <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Class</th> --}}
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 15%">Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($athleteClass->count())
                @if ($class->type == 1 || $class->type == 3)
                  <?php $i = 0; $j = 0; ?>
                @endif
                @foreach ($athleteClass as $athlete)
                  <tr>
                    @if ($class->type == 1 || $class->type == 3)
                      <td class="align-middle text-center text-sm">
                        <?php 
                        $i = $i - $athlete->group;
                        if ($i != 0) {
                          $j++;
                        }
                        $i = $athlete->group;
                        ?>
                        <p class="text-xs text-secondary mb-0">Group {{ $j }}</p>
                      </td>
                    @endif
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="{{ asset('images/teams/athletes/'. $athlete->athletes->photo) }}" class="avatar avatar-sm me-3" alt="{{ $athlete->athletes->athlete_name }}">
                        </div>
                        <div class="justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $athlete->athletes->athlete_name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $athlete->user->university }}</p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-xs text-secondary mb-0">{{ $athlete->athletes->birth_place }}, {{ date('d M Y', strtotime($athlete->athletes->birth_date)) }}</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      @if ($athlete->athletes->sex == 0)
                      <i class="fa fa-mars text-primary"></i>
                      @else
                      @if ($athlete->athletes->sex == 1)
                      <i class="fa fa-venus text-danger"></i>
                      @endif
                      @endif
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-xs text-secondary mb-0">{{ $athlete->athletes->weight }} Kg</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <div class="btn-group">
                        <button class="btn bg-gradient-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu text-secondary">
                          <a class="dropdown-item" href="{{ route('detail-athlete', $athlete->athletes->id) }}"><i class="fas fa-eye"></i> Detail</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $athlete->id }}"><i class="fas fa-trash"></i> 
                            @if ($class->type == 1 || $class->type == 3)
                            Delete Group
                            @else
                            Delete From Class
                            @endif
                          </a>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <!-- Modal -->
                  <div class="modal fade" id="modal-delete{{ $athlete->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h6 class="modal-title" id="modal-title-add">Delete @if ($class->type == 1 || $class->type == 3)
                              Team
                          @else
                              Athlete
                          @endif</h6>
                          <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure to delete  
                            @switch($class->type)
                                @case(0)
                                @case(2)
                                  <b>{{ $athlete->athletes->athlete_name }}</b> from <b>{{ $class->class_name }}</b> Class?
                                @break
                                @case(1)
                                @case(3)
                                  <b>Group {{ $j }}</b> from <b>{{ $class->class_name }}</b> Class?
                                @break
                                @default
                            @endswitch
                          </p>
                        </div>
                        <div class="modal-footer">
                            @if ($class->type == 1 || $class->type == 3)
                              <form role="form text-left" action="{{ route('team_class-delete', [$class->id, $athlete->athletes->user_id, $athlete->group]) }}" method="POST">
                            @else
                              <form role="form text-left" action="{{ route('athlete_class-delete', [$class->id, $athlete->id]) }}" method="POST">
                            @endif
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
                @else
                  <tr>
                    <td colspan="5">
                      <div class="card-body my-8 px-0 pt-0 pb-2 text-center">
                        <h3 class="align-middle text-center text-secondary"><i class="fas fa-exclamation-triangle fa-4x"></i><br> Athlete(s) not found</h3>
                      </div>
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-add" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-add">Add Athlete to Class</h6>
          <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form text-left" action="{{ route('athlete-class-store', $class->id) }}" method="POST">
            @csrf
            <input class="form-control" type="text" name="type" id="type" hidden value="{{ $class->type+1 }}"/>
            @if ($class->type == 1 || $class->type == 3)
            <input class="form-control" type="text" name="group" id="group" hidden value="{{ $group+1 }}"/>
            @else
              <input class="form-control" type="text" name="group" id="group" required hidden value="0"/>
            @endif
            @for ($i = 1; $i <= $class->max_athlete; $i++)
            <div class="row">
              <div class="col-2">
                <label>Athlete {{ $i }}</label>
              </div>
              <div class="col-10">
                <div class="input-group mb-1">
                  <select class="form-select" name="athlete_id{{ $i }}" id="athlete_id{{ $i }}">
                    <option selected hidden value="">Choose Your Athlete</option>
                    @foreach ($athletes as $athlete)
                    @if ($athlete->sex == $class->sex)
                        @if ($class->min_weight == 0)
                          <option value="{{ $athlete->id }}">{{ $athlete->athlete_name }}</option>                 
                          @else
                          @if ($athlete->weight >= $class->min_weight)
                              @if ($athlete->weight <= $class->max_weight)
                              <option value="{{ $athlete->id }}">{{ $athlete->athlete_name }}</option>
                              @endif
                          @endif
                        @endif
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            @endfor
            @if ($class->min_athlete != $class->max_athlete)
                <p class="text-secondary text-xs mt-1">* Choose {{ $class->min_athlete }} - {{ $class->max_athlete }} Athletes</p>
            @endif
            <div class="modal-footer d-flex justify-content-end">
              <button type="submit" class="btn gradient text-white">Add Athlete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modal-edit{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-edit">Edit Class</h6>
          <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form text-left" action="{{ route('class.edit', $class->id) }}" method="POST">
            @method('patch')
            @csrf
            <label>Type</label>
            <div class="input-group mb-1">
              <select class="form-select" id="type" name="type">
                <option selected hidden value="{{ $class->type }}">{{ $type }}</option>
                <option value="0">Individual Kata</option>
                <option value="1">Team Kata</option>
                <option value="2">Individual Kumite</option>
                <option value="3">Team Kumite</option>
              </select>
            </div>
            <label>Class Name</label>
            <div class="input-group mb-1">
              <input type="text" name="class_name" id="class_name" class="form-control" value="{{ $class->class_name }}">
            </div>
            <label>Gender</label>
                <div class="input-group mb-1">
                  <select name="sex" id="sex" class="form-select">
                    <option selected hidden value="{{ $class->sex }}">{{ $sex }}</option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                  </select>
                </div>
            <div class="row mb-1">
              <div class="col-3">
                <label>Min Weight</label>
                <input type="number" name="min_weight" id="min_weight" class="form-control mb-1" value="{{ $class->min_weight }}">
              </div>
              <div class="col-3">
                <label>Max Weight</label>
                <input type="number" name="max_weight" id="max_weight" class="form-control mb-1" value="{{ $class->max_weight }}">
              </div>
              <div class="col-3">
                <label>Min Athlete</label>
                <input type="number" name="min_athlete" id="min_athlete" class="form-control mb-1" value="{{ $class->min_athlete }}">
              </div>
              <div class="col-3">
                <label>Max Athlete</label>
                <input type="number" name="max_athlete" id="max_athlete" class="form-control mb-1" value="{{ $class->max_athlete }}">
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center py-0">
              <small class="text-secondary text-sm mt-0 mb-1">Weight can be filled with 0 if it doesn't require conditions.<br>Minimum Athlete can be filled with 1 (if Individual); 3 or 5 (if Team).<br>Maximum Athlete can be filled with 1 (if Individual); 3, 5, or 7 (if Team).
              </small>
              <button type="submit" class="btn gradient text-white my-auto">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modal-deleteclass{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-deleteclass" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-add">Delete Class</h6>
          <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure to delete {{ $class->class_name }} Class?
          </p>
        </div>
        <div class="modal-footer">
          <form role="form text-left" action="{{ route('class-delete', $class->id) }}" method="POST">
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
@endsection
@section('footnote')
<script type="text/javascript">

  $(document).ready(function () {
   
  window.setTimeout(function() {
      $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
          $(this).remove(); 
      });
  }, 5000);
   
  });
  </script>
@endsection
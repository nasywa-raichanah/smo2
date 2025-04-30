@extends('participant.layout.app')
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
                <p>{{ auth()->user()->username }}'s athletes: {{ $athleteClass->count() }}</p>
              </div>
              <div class="col text-right">
                @if ($team->is_confirm == 0)
                <a class="btn bg-gradient-success btn-sm my-auto" href="" data-bs-toggle="modal" data-bs-target="#modal-add"><i class="fas fa-plus"></i> Add</a>
                @endif
                <a class="btn bg-gradient-danger btn-sm my-auto" href="{{ route('my-classes') }}">Back</a>
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
                        <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu text-secondary">
                          <a class="dropdown-item" href="{{ route('athlete', $athlete->athletes->id) }}"><i class="fas fa-eye"></i> Detail</a>
                          @if ($team->is_confirm == 0)
                          <div class="dropdown-divider"></div>
                          @if ($class->type == 1 || $class->type == 3)
                            <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $athlete->group }}"><i class="fas fa-trash"></i> Delete Group</a>
                          @else
                            <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $athlete->id }}"><i class="fas fa-trash"></i> Delete From Class</a>
                          @endif
                          @endif
                        </div>
                      </div>
                    </td>
                  </tr>

                  <!-- Modal -->
                <div class="modal fade" @if ($class->type == 1 || $class->type == 3)
                  id="modal-delete{{ $athlete->group }}"
                @else
                  id="modal-delete{{ $athlete->id }}"
                @endif tabindex="-1" role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
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
                            <form role="form text-left" action="{{ route('team-class-delete', [$class->id, $athlete->group]) }}" method="POST">
                          @else
                            <form role="form text-left" action="{{ route('athlete-class-delete', $athlete->id) }}" method="POST">
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

  {{-- <!-- Modal -->
  <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-add" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-add">Add Group to Class</h6>
          <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form text-left" action="{{ route('athlete-class-store', $class->id) }}" method="POST">
            @csrf
            <label>Group</label>
            <label>Athletes</label>
            <div class="input-group mb-1">
              <select class="form-select" name="athlete_id" id="athlete_id">
                <option selected hidden value="">Choose Your Athlete</option>
                @foreach ($athletes as $athlete)
                @if ($athlete->sex == $class->sex)
                <option value="{{ $athlete->id }}">{{ $athlete->athlete_name }}</option>                 
                @endif
                @endforeach
              </select>
            </div>
            <div class="input-group mb-1">
              <select class="form-select" name="athlete_id" id="athlete_id">
                <option selected hidden value="">Choose Your Athlete</option>
                @foreach ($athletes as $athlete)
                @if ($athlete->sex == $class->sex)
                <option value="{{ $athlete->id }}">{{ $athlete->athlete_name }}</option>                 
                @endif
                @endforeach
              </select>
            </div>
            <div class="input-group mb-1">
              <select class="form-select" name="athlete_id" id="athlete_id">
                <option selected hidden value="">Choose Your Athlete</option>
                @foreach ($athletes as $athlete)
                @if ($athlete->sex == $class->sex)
                <option value="{{ $athlete->id }}">{{ $athlete->athlete_name }}</option>                 
                @endif
                @endforeach
              </select>
            </div>
            <div class="modal-footer d-flex justify-content-end">
              <button type="submit" class="btn gradient text-white">Add Athlete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> --}}
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
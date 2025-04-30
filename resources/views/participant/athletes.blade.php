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
        @if ($athletes->count())    
        <div class="card-header pb-0">
          <div class="row justify-content-between">
              <div class="col">
                <h6>Athletes List</h6>
                <p>number of athletes: {{ $total }}</p>
              </div>
              @if ($team->is_confirm == 0)
              <div class="col text-right">
                <button class="btn btn-link text-secondary mb-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-v text-xs"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-add"><i class="fas fa-plus"></i> Add</a>
                </div>
              </div>
              @endif
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0 pb-5">
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
                  <td class="align-middle text-center pt-0">
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
                        <a class="dropdown-item" href="{{ route('athlete', $athlete->id) }}"><i class="fas fa-eye"></i> Detail</a>
                        @if ($team->is_confirm == 0)
                        <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-edit{{ $athlete->id }}"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $athlete->id }}"><i class="fas fa-trash"></i> Delete</a>
                        @endif
                      </div>
                    </div>
                  </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="modal-edit{{ $athlete->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
                  <div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-add">Edit Athlete</h6>
                        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form role="form text-left" method="POST" action="{{ route('athlete-edit', $athlete->id) }}" enctype="multipart/form-data">
                          @method('patch')
                          @csrf
                          <div class="row">
                            <div class="col-6">
                              <h6>Athlete Identity</h6>
                              <hr>
                              <label>Name</label>
                              <div class="input-group mb-1">
                                <input type="text" name="athlete_name" id="athlete_name" class="form-control" value="{{ $athlete->athlete_name }}" required>
                              </div>
                              <label>Place and Date of Birth</label>
                              <div class="row">
                                <div class="col">
                                  <div class="input-group mb-1">
                                    <input type="text" name="birth_place" id="birth_place" class="form-control" value="{{ $athlete->birth_place }}" required>
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="input-group mb-1">
                                    <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ $athlete->birth_date }}" required>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <label>Gender</label>
                                  <div class="input-group mb-1">
                                    <select class="form-select" name="sex" id="sex">
                                      <option selected hidden value="{{ $athlete->sex }}">
                                        @if ($athlete->sex == 0)
                                          Male
                                        @else
                                          Female
                                        @endif
                                      </option>
                                      <option value="0">Male</option>
                                      <option value="1">Female</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col">
                                  <label>Weight</label>
                                  <div class="input-group mb-1">
                                    <input type="number" name="weight" id="weight" class="form-control" value="{{ $athlete->weight }}" required>
                                  </div>
                                </div>
                              </div>                              
                            </div>
                            <div class="col-6">

                              <h6>Contact</h6>
                              <hr>
                              <div class="row">
                                <div class="col-4">
                                  <label>Email</label>
                                </div>
                                <div class="col-8">
                                  <div class="input-group mb-1">
                                    <input type="email" name="athlete_email" id="athlete_email" class="form-control" value="{{ $athlete->athlete_email }}" required>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-4">
                                  <label>WhatsApp Number</label>
                                </div>
                                <div class="col-8">
                                  <div class="input-group mb-1">
                                    <input type="number" name="athlete_whatsapp" id="athlete_whatsapp" class="form-control" value="{{ $athlete->athlete_whatsapp }}" required>
                                  </div>
                                </div>
                              </div>

                            </div>
                          </div>
                          <div class="row">
                            <h6 class="mt-3">Documents</h6>
                              <hr>
                              <div class="row justify-content-center">
                                <div class="col-lg-4">
                                  <label>Photo</label>
                                  <div class="col">
                                  @if ($athlete->photo)
                                    <img src="{{ asset('images/teams/athletes/' . $athlete->photo) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem">
                                    @endif
                                    <div class="input-group mb-2">
                                      <input type="file" accept="image/*" name="photo" id="photo" class="form-control">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <label>National Identity Card</label>
                                  <div class="col">
                                  @if ($athlete->nic)
                                    <iframe src="{{ asset('images/teams/athletes/documents/' . $athlete->nic) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem"></iframe>
                                    @endif
                                    <div class="input-group mb-2">
                                      <input type="file" accept="image/*" name="nic" id="nic" class="form-control">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <label>Campus Card</label>
                                  <div class="col">
                                  @if ($athlete->campus_card)
                                    <iframe src="{{ asset('images/teams/athletes/documents/' . $athlete->campus_card) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem"></iframe>
                                    @endif
                                    <div class="input-group mb-2">
                                      <input type="file" accept="image/*" name="campus_card" id="campus_card" class="form-control">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <label>Karate Belt Certificate</label>
                                  <div class="col">
                                  @if ($athlete->belt_certificate)
                                    <iframe src="{{ asset('images/teams/athletes/documents/' . $athlete->belt_certificate) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem"></iframe>
                                    @endif
                                    <div class="input-group mb-2">
                                      <input type="file" accept="image/*" name="belt_certificate" id="belt_certificate" class="form-control">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <label>College Proof of Payment</label>
                                  <div class="col">
                                  @if ($athlete->college_payment)
                                    <iframe src="{{ asset('images/teams/athletes/documents/' . $athlete->college_payment) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem"></iframe>
                                    @endif
                                    <div class="input-group mb-2">
                                      <input type="file" accept="image/*" name="college_payment" id="college_payment" class="form-control">
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer d-flex justify-content-end">
                            <button type="submit" class="btn gradient text-white">Update</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-delete{{ $athlete->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
                  <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-add">Delete Athlete</h6>
                        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure to delete {{ $athlete->athlete_name }}?</p>
                      </div>
                      <div class="modal-footer">
                        <form role="form text-left" action="{{ route('athlete-delete', $athlete->id) }}" method="POST">
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
            {{ $athletes->links() }}
          </div>
        </div>
        @else
        <div class="card-header pb-0">
            <div class="row justify-content-between">
                <div class="col">
                  <h6>Athletes List</h6>
                </div>
                @if ($team->is_confirm == 0)
                <div class="col text-right">
                  <button class="btn btn-link text-secondary mb-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-v text-xs"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-add"><i class="fas fa-plus"></i> Add</a>
                  </div>
                </div>
                @endif
            </div>
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
  
  <!-- Modal -->
  <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-add" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-add">Add Athlete</h6>
          <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" role="form text-left" action="{{ route('athlete-store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-7">
                <h6>Athlete Identity</h6>
                <hr class="my-1">
                <label>Name</label>
                <div class="input-group mb-1">
                  <input type="text" name="athlete_name" id="athlete_name" class="form-control" placeholder="Full Name" required>
                </div>
                <label>Place and Date of Birth</label>
                <div class="row">
                  <div class="col">
                    <div class="input-group mb-1">
                      <input type="text" name="birth_place" id="birth_place" class="form-control" placeholder="Place" required>
                    </div>
                  </div>
                  <div class="col">
                    <div class="input-group mb-1">
                      <input type="date" name="birth_date" id="birth_date" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <label>Gender</label>
                    <div class="input-group mb-1">
                      <select class="form-select" name="sex" id="sex" required>
                        <option selected hidden value="">Choose Gender</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="col">
                    <label>Weight</label>
                    <div class="input-group mb-1">
                      <input type="number" name="weight" id="weight" class="form-control" placeholder=".. Kilograms" required>
                    </div>
                  </div>
                </div>
                <h6 class="mt-3">Contact</h6>
                <hr>
                <div class="row">
                  <div class="col-4">
                    <label>Email</label>
                  </div>
                  <div class="col-8">
                    <div class="input-group mb-1">
                      <input type="email" name="athlete_email" id="athlete_email" class="form-control" placeholder="Athlete Email" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <label>WhatsApp Number</label>
                  </div>
                  <div class="col-8">
                    <div class="input-group mb-1">
                      <input type="number" name="athlete_whatsapp" id="athlete_whatsapp" class="form-control" placeholder="example: +628123456789" required>
                    </div>
                  </div>
                  <small class="text-secondary text-right mx-auto">* Type with country code first (ex: +6281...)</small>
                </div>
              </div>
              <div class="col-5">
                <h6>Documents</h6>
                <hr class="my-1">
                <small class="text-secondary mx-auto py-0">* File must be an image (jpg/png/jpeg)</small>
                <div class="row">
                  <label>Photo</label>
                  <div class="input-group mb-2">
                    <input type="file" accept="image/*" name="photo" id="photo" class="form-control">
                  </div>
                </div>
                <label>National Identity Card</label>
                <div class="input-group mb-2">
                  <input type="file" accept="image/*" name="nic" id="nic" class="form-control">
                </div>
                <label>Campus Card</label>
                <div class="input-group mb-2">
                  <input type="file" accept="image/*" name="campus_card" id="campus_card" class="form-control">
                </div>
                <label>Karate Belt Certificate</label>
                <div class="input-group mb-2">
                  <input type="file" accept="image/*" name="belt_certificate" id="belt_certificate" class="form-control">
                </div>
                <label>College Proof of Payment</label>
                <div class="input-group mb-2">
                  <input type="file" accept="image/*" name="college_payment" id="college_payment" class="form-control">
                </div>
                
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-end pb-0">
              <button type="submit" class="btn gradient text-white my-0">Add Athlete</button>
            </div>
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
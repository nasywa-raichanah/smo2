@extends('participant.layout.app')
@section('headnote')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')    
<div class="container-fluid py-4">
    <div class="row justify-content-center pb-4">
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
        <div class="card">
            <div class="card-body px-0 py-0">
                <div class="row gx-4 border-radius-lg" style="background-image: url('{{ asset('images/systems/flags/'. $team->nationality . '.svg')}}'); background-size:cover; background-blend-mode:lighten; background-position:right">
                    <div class="col-auto my-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset('images/teams/'. $team->logo)}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ $team->username }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ $team->university }}, {{ $country->name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="card">
    <div class="card-header pb-0">
    <div class="d-flex align-items-center">
    <h5>Team Detail</h5>
    @if ($team->is_confirm == 0)
      <a class="btn bg-gradient-danger btn-sm ms-auto" href="{{ route('edit-my-team') }}">Edit</a>
    @endif
    </div>
    </div>
    <div class="card-body">
    <p class="text-uppercase text-sm">Team Information</p>
    <div class="row">
    <div class="col-md-4">
        <p class="text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ $team->email }}</p>
    </div>
    <div class="col-md-4">
        <p class="text-sm"><strong class="text-dark">Team Name:</strong> &nbsp; {{ $team->username }}</p>
    </div>
    <div class="col-md-4">
        <p class="text-sm"><strong class="text-dark">University:</strong> &nbsp; {{ $team->university }}</p>
    </div>
    <div class="col-md-12">
        <p class="text-sm"><strong class="text-dark">Address:</strong> &nbsp; {{ $team->address }}, {{ $country->name }} {{ $team->postal_code }}</p>
    </div>
    </div>
    <hr class="horizontal dark">
    <p class="text-uppercase text-sm">Manager Team</p>
    <div class="row gx-4">
      <div class="col-lg-4">
        <div class="row">
          <div class="col-3">
            <div class="avatar avatar-xl position-relative">
              <img src="{{ asset('images/teams/managers/'.$manager->coach_photo)}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-9 my-auto">
            <div class="h-100">
              <h5 class="mb-1 text-sm">
                {{ $manager->manager_name }} 
                {{-- <small>(ID: {{ $manager->coach_num }})</small> --}}
              </h5>
              <div class="row mx-auto text-center">
                <div class="col">
                  <a href="https://wa.me/{{ $manager->whatsapp_num }}"><p class="text-xs text-secondary mb-0 txt-gradient-success">WhatsApp</p></a>
                </div>
                <div class="col">
                  @if ($team->is_confirm == 0)
                  <a href="{{ route('edit-my-team') }}#manager_info"><p class="text-xs text-secondary mb-0 text-warning">Edit</p></a>
                  @endif
                </div>
                <div class="col">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @foreach ($alt_managers as $alt_manager)
      <div class="col-lg-4">
        <div class="row">
          <div class="col-3">
            <div class="avatar avatar-xl position-relative">
              <img src="{{ asset('images/teams/managers/'.$alt_manager->coach_photo)}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-9 my-auto">
            <div class="h-100">
              <h5 class="mb-1 text-sm">
                {{ $alt_manager->manager_name }} 
                {{-- <small>(ID: {{ $alt_manager->coach_num }})</small> --}}
              </h5>
              <div class="row mx-auto text-center">
                <div class="col">
                  <a href="https://wa.me/{{ $alt_manager->whatsapp_num }}"><p class="text-xs text-secondary mb-0 txt-gradient-success">WhatsApp</p></a>
                </div>
                <div class="col">
                  @if ($team->is_confirm == 0)
                  <a href="" data-bs-toggle="modal" data-bs-target="#modal-edit{{ $alt_manager->id }}"><p class="text-xs text-secondary mb-0 text-warning">Edit</p></a>
                  @endif
                </div>
                <div class="col">
                  @if ($team->is_confirm == 0)
                  <a href="" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $alt_manager->id }}"><p class="text-xs text-secondary mb-0 text-danger">Delete</p></a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modal-edit{{ $alt_manager->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="modal-title-add">Edit Manager</h6>
              <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('team-edit', $alt_manager->id) }}" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="row mx-auto">
                  <div class="col-lg-4">
                      <label class="form-label" for="coach_photo">Photo</label>
                      <div class="col">
                          <img src="{{ asset('images/teams/managers/' . $alt_manager->coach_photo) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem">
                          <div class="input-group">
                              <input class="form-control" type="file" accept="image/*" name="coach_photo" id="coach_photo"/>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-8">
                      <div class="col-lg-12 mt-2">
                        <label class="form-label" for="manager_name">Name</label>
                        <div class="input-group">
                          <input class="form-control" type="text" name="manager_name" id="manager_name" required value="{{ $alt_manager->manager_name }}"/>
                        </div>
                      </div>
                      <div class="col-lg-12 mt-2">
                          <label class="form-label" for="whatsapp_num">Whatsapp Number</label>
                          <input type="number" class="form-control" name="whatsapp_num" id="whatsapp_num" value="{{ $alt_manager->whatsapp_num }}" required>
                          <p class="text-secondary text-left text-sm ml-2"><small>* type by starting with the phone code (ex. 62...)</small></p>
                        </div>
                      {{-- <div class="col-lg-12 mt-2">
                        <label class="form-label">Coach Number ID</label>
                        <div class="input-group">
                          <input id="coach_num" name="coach_num" class="form-control" type="text" value="{{ $alt_manager->coach_num }}" required>
                        </div>
                      </div> --}}
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
      <div class="modal fade" id="modal-delete{{ $alt_manager->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="modal-title-add">Delete Manager</h6>
              <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure to delete {{ $alt_manager->manager_name }}?</p>
            </div>
            <div class="modal-footer">
              <form role="form text-left" action="{{ route('team-delete', $alt_manager->id) }}" method="POST">
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
      @if ($alt_managers->count() < 2)
        <div class="col-auto my-auto">
          @if ($team->is_confirm == 0)
          <a class="btn bg-gradient-danger btn-xs" href="" data-bs-toggle="modal" data-bs-target="#modal-add"><span class="fas fa-plus"></span> Add</a>
          @endif
        </div> 
        <!-- Modal -->
        <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-add" aria-hidden="true">
          <div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="modal-title-add">Add Manager</h6>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('team-store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="row mx-auto">
                    <div class="col-lg-4">
                        <label class="form-label" for="coach_photo">Photo</label>
                        <div class="col">
                            <img src="{{ asset('images/teams/managers/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem">
                            <div class="input-group">
                                <input class="form-control" type="file" accept="image/*" name="coach_photo" id="coach_photo"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="col-lg-12 mt-2">
                          <label class="form-label" for="manager_name">Name</label>
                          <div class="input-group">
                            <input class="form-control" type="text" name="manager_name" id="manager_name" required placeholder="Type Manager Name"/>
                          </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label class="form-label" for="whatsapp_num">Whatsapp Number</label>
                            <input type="number" class="form-control" name="whatsapp_num" id="whatsapp_num" required>
                            <p class="text-secondary text-left text-sm ml-2"><small>* type by starting with the phone code (ex. 62...)</small></p>
                          </div>
                        {{-- <div class="col-lg-12 mt-2">
                          <label class="form-label">Coach Number ID</label>
                          <div class="input-group">
                            <input id="coach_num" name="coach_num" class="form-control" type="text" required>
                          </div>
                        </div> --}}
                    </div>
                  </div>
                  <div class="modal-footer d-flex justify-content-end">
                    <button type="submit" class="btn gradient text-white">Add Manager</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endif
    </div>
    <hr class="horizontal dark">
    <p class="text-uppercase text-sm">Team Document</p>
    <div class="row">
    <div class="col-md-12">
    <div class="form-group">
        <p class="text-sm"><strong class="text-dark">Mandate Letter</strong> &nbsp; 
          @if ($team->mandate_letter == "")
            <small>Not Uploaded Yet</small>
            @else
            <small>Uploaded</small>
          @endif
        </p>
    </div>
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
@extends('admin.layout.app')
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
    </div>
<div class="card">
  <div class="card-header pb-0">
    <div class="d-flex flex-row justify-content-between">
      <div class="p-2">
        <h5>Team Detail</h5>
      </div>
      <div class="p-2">
        <a class="btn bg-gradient-warning" href="{{ route('verificate-team', $team->id) }}" target="_blank"><i class="fas fa-lg fa-user-check"></i></a>
        <a class="btn bg-gradient-light" href="{{ route('card-team', $team->id) }}" target="_blank"><i class="fas fa-lg fa-id-card-alt"></i></a>
        <a class="btn bg-gradient-primary" href="{{ route('detail-team-print', $team->id) }}" target="_blank"><i class="fa fa-lg fa-print"></i></a>
        <a class="btn bg-gradient-danger" href="{{ url()->previous() }}">Back</a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row mx-auto">
      <div class="col-3">
        <img src="{{ asset('images/teams/'. $team->logo) }}" class="border-radius-lg shadow-sm" alt="{{ $team->username }}" style="width: 12rem">
      </div>
      <div class="col-9">
        <div class="row mx-auto text-left">
          <div class="col-4">
            <p class="my-1">Email</p>
          </div>
          <div class="col-8">
            <p class="my-1">: {{ $team->email }}</p>
          </div>
        </div>
        <div class="row mx-auto text-left">
          <div class="col-4">
            <p class="my-1">Team Name</p>
          </div>
          <div class="col-8">
            <p class="my-1">: {{ $team->username }}</p>
          </div>
        </div>
        <div class="row mx-auto text-left">
          <div class="col-4">
            <p class="my-1">University</p>
          </div>
          <div class="col-8">
            <p class="my-1">: {{ $team->university }}</p>
          </div>
        </div>
        <div class="row mx-auto text-left">
          <div class="col-4">
            <p class="my-1">Address</p>
          </div>
          <div class="col-8">
            <p class="my-1">: {{ $team->address }}, {{ $country->name }} {{ $team->postal_code }}</p>
          </div>
        </div>
        <div class="row mx-auto text-center">
          <div class="col">
            <div class="row">
              <div class="col-5">
                <p class="my-1">Team Status</p>
              </div>
              <div class="col-7">
                <p class="my-1">: 
                  @switch($team->status)
                  @case(0)
                  <span class="badge bg-gradient-primary badge-sm">New</span>
                  @break
                  @case(1)
                  <span class="badge bg-gradient-warning badge-sm">Waiting</span>
                      @break
                  @case(2)
                  <span class="badge bg-gradient-success badge-sm">Valid</span>
                      @break
                  @case(3)
                  <span class="badge bg-gradient-danger badge-sm">Invalid</span>
                      @break
                  @default
                  error
                  @endswitch  
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="row">
              <div class="col-5">
                <p class="my-1">Payment Status</p>
              </div>
              <div class="col-7">
                <p class="my-1">: 
                  @switch($invoices->status)
                  @case(0)
                    <span class="badge bg-gradient-danger badge-sm">UNPAID</span>
                      @break
                  @case(1)
                    <span class="badge bg-gradient-success badge-sm">PAID</span>
                      @break
                  @default
                      error
                  @endswitch  
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="horizontal dark">
    <p class="text-uppercase text-sm">Manager Team</p>
    <div class="row gx-4">
      <div class="col-4">
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
              <div class="row">
                <a href="https://wa.me/{{ $manager->whatsapp_num }}"><p class="text-xs text-secondary mb-0 txt-gradient-success">WhatsApp</p></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      @foreach ($alt_managers as $alt_manager)
      <div class="col-4">
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
              <div class="row">
                <a href="https://wa.me/{{ $alt_manager->whatsapp_num }}"><p class="text-xs text-secondary mb-0 txt-gradient-success">WhatsApp</p></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
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
    <hr class="horizontal dark">
    <div class="row">
      <h5>Athletes List</h5>
      <p class="text-uppercase text-sm">number of athletes: {{ $total }}</p>
      <div class="table-responsive p-0 pb-5">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 25%">Name</th>
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
                <p class="text-xs text-secondary mb-0">{{ $athlete->birth_place }}, {{ $athlete->birth_date }}</p>
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
              <td class="align-middle text-center">
                <button class="btn btn-icon btn-2 bg-gradient-success" type="button"><a href="{{ route('detail-athlete', $athlete->id) }}">
                  <span class="btn-inner--icon"><i class="fas fa-eye"></i></span></a>
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $athletes->links() }}
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
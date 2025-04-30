@extends('participant.layout.app')
@section('content') 
<div class="container-fluid py-4">
    <div class="row justify-content-center mt-0">
      <div class="col-12 col-sm-9 col-md-7 col-lg-11 text-center p-0 mt-3 mb-2">
        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
            <div class="d-flex align-items-center px-4">
                <h5>Profile</h5>
                <a class="btn bg-gradient-danger btn-sm ms-auto" href="{{ url()->previous() }}">Back</a>
            </div>
          <div class="card-body px-0 pt-3 pb-2">
            <div class="row">
              <div class="col-lg-4">
                <img src="{{ asset('images/teams/athletes/'. $athlete->photo) }}" class="mt-2 border-radius-lg shadow-sm" alt="" style="width: 12rem">
                <h6 class="card-widget__title text-dark mt-3">{{ $athlete->athlete_name }}</h6>
                <p class="text-muted text-sm">ID: 12{{ $athlete->user->id }}{{ $athlete->id }}</p>
              </div>
              <div class="col-lg-8">
                <div class="row mx-auto text-left">
                  <div class="col-lg-4">
                    <p class="my-1">Full Name</p>
                  </div>
                  <div class="col-lg-8">
                    <p class="my-1">: {{ $athlete->athlete_name }}</p>
                  </div>
                </div>
                <div class="row mx-auto text-left">
                  <div class="col-lg-4">
                    <p class="my-1">Team / University</p>
                  </div>
                  <div class="col-lg-8">
                    <p class="my-1">: {{ $athlete->user->username }} / {{ $athlete->user->university }}</p>
                  </div>
                </div>
                <div class="row mx-auto text-left">
                  <div class="col-lg-4">
                    <p class="my-1">Place, Date of Birth</p>
                  </div>
                  <div class="col-lg-8">
                    <p class="my-1">: {{ $athlete->birth_place }} / {{ date('d M Y', strtotime($athlete->birth_date)) }}</p>
                  </div>
                </div>
                <div class="row mx-auto text-left">
                  <div class="col-lg-4">
                    <p class="my-1">Gender / Weight</p>
                  </div>
                  <div class="col-lg-8">
                    <p class="my-1">: @if ($athlete->sex == 0)
                      <i class="fa fa-mars text-primary"></i>
                    @else
                    @if ($athlete->sex == 1)
                      <i class="fa fa-venus text-danger"></i>
                    @endif
                    @endif / {{ $athlete->weight }} Kg</p>
                  </div>
                </div>
                <div class="row mx-auto text-left">
                  <div class="col-lg-4">
                    <p class="my-1">Email</p>
                  </div>
                  <div class="col-lg-8">
                    <p class="my-1">: {{ $athlete->athlete_email }}</p>
                  </div>
                </div>
                <div class="row mx-auto text-left">
                  <div class="col-lg-4">
                    <p class="my-1">Whatsapp Number</p>
                  </div>
                  <div class="col-lg-8">
                    <p class="my-1">: +{{ $athlete->athlete_whatsapp }}</p>
                  </div>
                </div>
                <div class="row mx-auto text-left">
                  <div class="col-lg-4">
                    <p class="my-1">Class</p>
                  </div>
                  <div class="col-lg-8">
                    @foreach ($athleteClass as $class)
                        @if ($class->athletes_id == $athlete->id)
                          <p class="my-1">- {{ $class->classes->class_name }}</p>                          
                        @endif
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <div class="row justify-content-center gx-0">
              <div class="col-lg-3">
                <label>National Identity Card</label>
                <br class="py-0">
                @if ($athlete->nic)
                <iframe src="{{ asset('images/teams/athletes/documents/' . $athlete->nic) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem"></iframe>
                @else
                <img src="{{ asset('images/teams/athletes/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem">
                @endif
              </div>
              <div class="col-lg-3">
                <label>Campus Card</label>
                <br class="py-0">
                @if ($athlete->campus_card)
                <iframe src="{{ asset('images/teams/athletes/documents/' . $athlete->campus_card) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem"></iframe>
                @else
                <img src="{{ asset('images/teams/athletes/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem">
                @endif
              </div>
              <div class="col-lg-3">
                <label>Karate Belt Certificate</label>
                <br class="py-0">
                @if ($athlete->belt_certificate)
                <iframe src="{{ asset('images/teams/athletes/documents/' . $athlete->belt_certificate) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem"></iframe>
                @else
                <img src="{{ asset('images/teams/athletes/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem">
                @endif
              </div>
              <div class="col-lg-3">
                <label>College Proof of Payment</label>
                <br class="py-0">
                @if ($athlete->college_payment)
                  <iframe src="{{ asset('images/teams/athletes/documents/' . $athlete->college_payment) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem"></iframe>
                  @else
                <img src="{{ asset('images/teams/athletes/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem">
                @endif
              </div>
            </div>
            <div class="row mt-2 mx-auto">
              <div class="col-lg-2 text-right">
                <h6>Athlete Status: </h6>
              </div>
              <div class="col-lg-10 text-left">
                @switch($athlete->status)
                @case(0)
                  <span class="badge badge-sm bg-gradient-primary">new</span>
                  <p class="text-sm">This athlete has just been registered, please upload documents to change status</p>
                  @break
                @case(1)
                  <span class="badge badge-sm bg-gradient-warning">waiting</span>
                  <p class="text-sm">Wait for the documents to be checked by the admin, if the check is successful then the status will change to valid</p>
                  @break
                @case(2)
                  <span class="badge badge-sm bg-gradient-success">valid</span>
                  <p class="text-sm">The athlete documents has been considered valid by the admin</p>
                  @break
                @default
                  <span class="badge badge-sm bg-gradient-danger">invalid</span>  
                  <p class="text-sm">There is an invalid athlete document, please re-upload it with valid documents or contact the admin</p>
                @endswitch
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
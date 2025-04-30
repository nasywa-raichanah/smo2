<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <link rel="icon" type="image/png" href="{{ asset('style/TheEvent/assets/img/logo.png') }}">
  <title class="text-uppercase">
    SMC XII - {{ $title }}
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('style/board/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('style/board/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('style/board/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('style/board/css/argon-dashboard.css?v=2.0.2') }}" rel="stylesheet" />

</head>

<body class="g-sidenav-show bg-gray-100">

  <div class="min-height-300 gradient position-absolute w-100"></div>


  <main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex flex-row justify-content-between">
          <div class="p-2">
            <h5 class="mb-0">{{ $team->username }} <p class="p-0 my-0 text-sm">ID: {{ $team->id }}</p></h5>
            <small>accessed at: {{ date('d-M-Y H:i:s') }}</small>
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
                    {{ $manager->manager_name }} <br>
                    <small>(WA: {{ $manager->whatsapp_num }})</small>
                  </h5>
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
                    {{ $alt_manager->manager_name }} <br>
                    <small>(WA: {{ $manager->whatsapp_num }})</small>
                  </h5>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <hr class="horizontal dark">
        <p class="text-uppercase text-sm">Team Document & Payment Information</p>
        <div class="row">
        <div class="col-8">
          <div class="card">
            <div class="card-header pt-0 pb-1 text-center">
              <div class="row justify-content-between">
                <div class="col">
                  <img class="mb-2 w-75 p-2" src="{{ asset('images/systems/big-logo.png') }}" alt="Logo">
                </div>
                <div class="col mt-3 text-end">
                  <h5 class="mb-0">PAYMENT RECEIPT</h5>
                </div>
              </div>
              <div class="row justify-content-between">
                <div class="col-5 text-start">
                    <h6 class="mb-0">
                        {{ $contact_name }}
                    </h6>
                    <p class="d-block text-secondary mb-0">{{ $contact_address }}</p>
                    <p class="d-block text-secondary">tel: {{ $contact_phone }}</p>
                </div>
                <div class="col-6 text-end text-start">
                    <h6 class="d-block mb-0">Billed to: {{ $team->username }}</h6>
                    <p class="text-secondary">{{ $team->address }}</p>
                </div>
              </div>
              <div class="row justify-content-between">
                <div class="col-4 mt-auto">
                  <h6 class="mb-0 text-start text-secondary">
                  Invoice no
                  </h6>
                  <h5 class="text-start mb-0">
                      #{{ $invoices->invoice_code }}
                  </h5>
                </div>
                <div class="col-5 mt-auto">
                  <div class="row mb-4 text-end text-start">
                    <div class="col-8 justify-content-between">
                      <h6 class="text-secondary mb-0">Invoice Status:</h6>
                    </div>
                    <div class="col-2">
                        @switch($invoices->status)
                                      @case(0)
                                        <span class="badge bg-danger badge-sm">UNPAID</span>
                                        @break
                                      @case(1)
                                        <span class="badge bg-success badge-sm">PAID</span>
                                        @break
                                      @default
                                          error
                                  @endswitch
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body pt-0 pb-0">
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive border-radius-lg">
                    <table class="table text-right">
                      <thead>
                        <tr>
                          <th scope="col" class="pe-2 text-start ps-2">Detail</th>
                          <th scope="col" class="pe-2">Qty</th>
                          <th scope="col" class="pe-2" colspan="2">Rate</th>
                          <th scope="col" class="pe-2">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td class="text-start">Team Registration</td>
                            <td class="ps-4" colspan="3">{{ $registration_payment->cost }}</td>
                            <td class="ps-4">{{ $registration_payment->total_cost }}</td>
                            @php
                                $total = $registration_payment->total_cost;
                                $class = 0;
                            @endphp
                        </tr>
                        <tr>
                            @foreach ($payments as $payment)
                            @if ($payment->item != 0)
                            @php
                                $class++;
                            @endphp
                            @if ($class==1)
                            <tr>
                                <td class="text-start text-sm">Class to Participate:</td>
                                <td class="ps-4" colspan="4"></td>
                            </tr>
                            @endif
                            <tr>
                                @switch($payment->item)
                                    @case(1)
                                        <td class="text-start">- Individual Kata</td>
                                        @break
                                    @case(2)
                                        <td class="text-start">- Team Kata</td>
                                        @break
                                    @case(3)
                                        <td class="text-start">- Individual Kumite</td>
                                        @break
                                    @case(4)
                                        <td class="text-start">- Team Kumite</td>
                                        @break
                                    @default
                                @endswitch
                                <td class="ps-4">{{ $payment->qty }}</td>
                                <td class="ps-4" colspan="2">{{ $payment->cost }}</td>
                                <td class="ps-4">{{ $payment->total_cost }}</td>
                                @php
                                    $total = $total + $payment->total_cost;
                                @endphp
                            </tr>
                            @endif
                            @endforeach
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th></th>
                          <th></th>
                          <th class="h5 ps-4" colspan="2">Total</th>
                          <th colspan="1" class="text-right h5 ps-4">@rupiah($total)</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer pt-0 pb-0">
              <div class="row">
                <div class="col-8 text-left">
                  <p class="text-secondary text-sm">this receipt is legitimate proof of transaction from <b>Sebelas Maret Cup Committee</b> if it has been signed and stamped.</p>
                </div>
                <div class="col-4 justify-content-end">
                  <p class="text-dark">
                    Surakarta, {{ date('d M Y') }} <br>
                    Committee,<br><br><br>
                    (_______________________)
                  </p>
                </div>
              </div>
              </div>
          </div>
        </div>
        <div class="col-md"></div>
        <div class="col-md-3">
        <div class="form-group">
            <p class="text-sm"><strong class="text-dark">Mandate Letter</strong> &nbsp; 
              @if ($team->mandate_letter == "")
                <small>Not Uploaded Yet</small>
                @else
                <small>Uploaded</small> <br>
                <a class="btn btn-xs bg-gradient-primary" href="{{ asset('images/teams/documents/' . $team->mandate_letter) }}" target="_blank"><i class="fas fa-lg fa-eye"></i> Preview</a>
              @endif
            </p>
        </div>
        <div class="row">
          <div class="col-5">
            <p class="my-1">Team Status</p>
          </div>
          <div class="col-7">
            <p class="my-1">: 
              @switch($team->status)
              @case(0)
              <a href="" data-bs-toggle="modal" data-bs-target="#modal-team-valid{{ $team->id }}"><span class="badge bg-gradient-primary badge-sm">New</span></a>
              
              @break
              @case(1)
              <a href="" data-bs-toggle="modal" data-bs-target="#modal-team-valid{{ $team->id }}"><span class="badge bg-gradient-warning badge-sm">Waiting</span></a>
                  @break
              @case(2)
              <a href="" data-bs-toggle="modal" data-bs-target="#modal-team-valid{{ $team->id }}"><span class="badge bg-gradient-success badge-sm">Valid</span></a>
                  @break
              @case(3)
              <a href="" data-bs-toggle="modal" data-bs-target="#modal-team-valid{{ $team->id }}"><span class="badge bg-gradient-danger badge-sm">Invalid</span></a>
                  @break
              @default
              error
              @endswitch  
            </p>
            <!-- Modal -->
            <div class="modal fade" id="modal-team-valid{{ $team->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-valid" aria-hidden="true">
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
                            <button type="button" class="btn bg-gradient-primary text-white my-0"><a href="{{ asset('images/teams/documents/' . $team->mandate_letter) }}" target="_blank"><i class="fas fa-eye"></i> Preview</a></button>
                          @else
                            <img src="{{ asset('images/teams/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem" scrolling="auto">
                          @endif
                        </div>
                        <input type="text" name="redirect" value="1" hidden>
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
          </div>
        </div>
        <div class="row">
          <div class="col-5">
            <p class="my-1">Athletes Status</p>
          </div>
          <div class="col-7">
            <p class="my-1">: 
              @if ($invalid_athletes->count())
                <span class="badge bg-gradient-danger badge-sm">Invalid</span>
              @else
              @if ($waiting_athletes->count())
                <span class="badge bg-gradient-warning badge-sm">Waiting</span>
              @else
              @if ($new_athletes->count())
                <span class="badge bg-gradient-primary badge-sm">New</span>
              @else
              @if ($valid_athletes->count())
                <span class="badge bg-gradient-success badge-sm">Valid</span>
              @else
                -
              @endif
              @endif
              @endif
              @endif
            </p>
          </div>
        </div>
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
        <p class="text-center">__________________________________________________________</p>
        <div class="row">
          <h5>Athletes Detail</h5>
          <p class="text-uppercase text-sm">number of athletes: {{ $total_athletes }}</p>
          @php
              $i = 1;
          @endphp
          @foreach ($athletes as $athlete)
          @if ($i %2 == 0)
                <div class="card-body px-0 pt-3 pb-2 pagebreak">
            @else
                <div class="card-body px-0 pt-3 pb-2">
          @endif
          @php
              $i++;
          @endphp
          <div class="card-body px-0 pt-3 pb-2">
            <div class="row">
              <div class="col-4">
                <div class="row mx-auto text-center justify-content-center">
                  <div class="col">
                    <img src="{{ asset('images/teams/athletes/'. $athlete->photo) }}" class="mt-2 border-radius-lg shadow-sm" alt="" style="width: 12rem">
                    <h6 class="card-widget__title text-dark mt-3">{{ $athlete->athlete_name }}</h6>
                    <p class="text-muted text-sm">ID: {{ $athlete->user->id }}{{ $athlete->id }}</p>
                  </div>
                </div>
              </div>
              <div class="col-8">
                <div class="row mx-auto text-left">
                  <div class="col-4">
                    <p class="my-1">Full Name</p>
                  </div>
                  <div class="col-8">
                    <p class="my-1">: {{ $athlete->athlete_name }}</p>
                  </div>
                </div>
                <div class="row mx-auto text-left">
                  <div class="col-4">
                    <p class="my-1">Team / University</p>
                  </div>
                  <div class="col-8">
                    <p class="my-1">: {{ $athlete->user->username }} / {{ $athlete->user->university }}</p>
                  </div>
                </div>
                <div class="row mx-auto text-left">
                  <div class="col-4">
                    <p class="my-1">Place, Date of Birth</p>
                  </div>
                  <div class="col-8">
                    <p class="my-1">: {{ $athlete->birth_place }} / {{ date('d M Y', strtotime($athlete->birth_date)) }}</p>
                  </div>
                </div>
                <div class="row mx-auto text-left">
                  <div class="col-4">
                    <p class="my-1">Gender / Weight</p>
                  </div>
                  <div class="col-8">
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
                  <div class="col-4">
                    <p class="my-1">Email</p>
                  </div>
                  <div class="col-8">
                    <p class="my-1">: {{ $athlete->athlete_email }}</p>
                  </div>
                </div>
                <div class="row mx-auto text-left">
                  <div class="col-4">
                    <p class="my-1">Whatsapp Number</p>
                  </div>
                  <div class="col-8">
                    <p class="my-1">: +{{ $athlete->athlete_whatsapp }}</p>
                  </div>
                </div>
                <div class="row mx-auto text-left">
                  <div class="col-4">
                    <p class="my-1">Class</p>
                  </div>
                  <div class="col-8">
                    @foreach ($athleteClass as $class)
                        @if ($class->athletes_id == $athlete->id)
                          <p class="my-1">- {{ $class->classes->class_name }}</p>                          
                        @endif
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-2">
                <label>National Identity Card</label>
              </div>
              <div class="col-9">
                @if ($athlete->nic)
                <img src="{{ asset('images/teams/athletes/documents/' . $athlete->nic) }}" class="img-fluid img-thumbnail" alt="{{ $athlete->nic }}">
                @else
                <img src="{{ asset('images/teams/athletes/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem">
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-2">
                <label>Campus Card</label>
              </div>
              <div class="col-9">
                @if ($athlete->campus_card)
                <img src="{{ asset('images/teams/athletes/documents/' . $athlete->campus_card) }}" class="img-fluid img-thumbnail" alt="{{ $athlete->campus_card }}">
                @else
                <img src="{{ asset('images/teams/athletes/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem">
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-2">
                <label>Karate Belt Certificate</label>
              </div>
              <div class="col-10">
                @if ($athlete->belt_certificate)
                <img src="{{ asset('images/teams/athletes/documents/' . $athlete->belt_certificate) }}" class="img-fluid img-thumbnail" alt="{{ $athlete->belt_certificate }}">
                @else
                <img src="{{ asset('images/teams/athletes/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem">
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-2">
                <label>College Proof of Payment</label>
              </div>
              <div class="col-10">
                @if ($athlete->college_payment)
                <img src="{{ asset('images/teams/athletes/documents/' . $athlete->college_payment) }}" class="img-fluid img-thumbnail" alt="{{ $athlete->college_payment }}">
                @else
                <img src="{{ asset('images/teams/athletes/not-available.png') }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem">
                @endif
              </div>
            </div>
            <div class="row mt-2 mx-auto">
              <div class="col-2 text-right">
                <h6>{{ $athlete->athlete_name }}'s Status: </h6>
              </div>
              <div class="col-10 text-left">
                @switch($athlete->status)
                @case(0)
                <a href="" data-bs-toggle="modal" data-bs-target="#modal-athlete-valid{{ $athlete->id }}"><span class="badge badge-sm bg-gradient-primary">new</span></a>
                  @break
                @case(1)
                  <a href="" data-bs-toggle="modal" data-bs-target="#modal-athlete-valid{{ $athlete->id }}"><span class="badge badge-sm bg-gradient-warning">waiting</span></a>
                  @break
                @case(2)
                  <a href="" data-bs-toggle="modal" data-bs-target="#modal-athlete-valid{{ $athlete->id }}"><span class="badge badge-sm bg-gradient-success">valid</span></a>
                  @break
                @default
                  <a href="" data-bs-toggle="modal" data-bs-target="#modal-athlete-valid{{ $athlete->id }}"><span class="badge badge-sm bg-gradient-danger">invalid</span></a>  
                @endswitch
                
              </div>
            </div>
          </div>
          <p class="text-center">------------------------------------------------------</p>
          <!-- Modal -->
          <div class="modal fade" id="modal-athlete-valid{{ $athlete->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-valid" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title" id="modal-title-valid">Athlete Validate: {{ $athlete->athlete_name }}</h6>
                  <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form role="form text-left" method="POST" action="{{ route('athlete-validation', $athlete->id) }}" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <input type="text" name="redirect" value="1" hidden>
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
        </div>
        </div>
    </div>
</main>

<!--   Core JS Files   -->
<script src="{{ asset('style/board/js/core/popper.min.js') }}"></script>
<script src="{{ asset('style/board/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('style/board/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('style/board/js/plugins/smooth-scrollbar.min.js') }}"></script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('style/board/js/argon-dashboard.min.js?v=2.0.2') }}"></script>
</body>
</html>
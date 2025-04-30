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
            <small>printed at: {{ date('d-M-Y H:i:s') }}</small>
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
        
        <p class="text-center">__________________________________________________________</p>
        <div class="row">
          <h5>Athletes Detail</h5>
          <p class="text-uppercase text-sm">number of athletes: {{ $total }}</p>
          @php
              $i = 1;
          @endphp
          @foreach ($athletes as $athlete)
          @if ($i %2 == 0)
                <div class="card-body px-0 pt-3 pb-2" style="page-break-before: always">
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
                <div class="row mx-auto text-left">
                  <div class="col-4">
                    <p class="my-1">Document Uploaded</p>
                  </div>
                  <div class="col-8">
                    <p class="my-1">National Identity Card @if($athlete->nic)<i class="fa fa-check text-success"></i>@else<i class="fa fa-times text-danger"></i>@endif</p>                          
                    <p class="my-1">Campus Card @if($athlete->campus_card)<i class="fa fa-check text-success"></i>@else<i class="fa fa-times text-danger"></i>@endif</p>                          
                    <p class="my-1">Karate Belt Certificate @if($athlete->belt_certificate)<i class="fa fa-check text-success"></i>@else<i class="fa fa-times text-danger"></i>@endif</p>                          
                    <p class="my-1">College Proof of Payment @if($athlete->college_payment)<i class="fa fa-check text-success"></i>@else<i class="fa fa-times text-danger"></i>@endif</p>                          
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-2 mx-auto">
              <div class="col-2 text-right">
                <h6>Athlete Status: </h6>
              </div>
              <div class="col-10 text-left">
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
          <p class="text-center">------------------------------------------------------</p>
          @endforeach
        </div>
        </div>
    </div>
    <div class="card-body card-body px-0 pt-3 pb-2" style="page-break-before: always">
      <p class="text-center">__________________________________________________________</p>
          <div class="row">
            <h5>Classes List</h5>
            @php
              $num = 1;
          @endphp
          @foreach ($classes as $class)
              <h6 class="mb-0">{{ $num++ }}. {{ $class->class_name }}</h6>
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        @if ($class->type == 1 || $class->type == 3)
                          <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 5%">#</th>
                        @endif
                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 25%">Name</th>
                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Place & Date of Birth</th>
                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 5%"><i class="fa fa-intersex"></i></th>
                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 10%">Weight</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if ($class->type == 1 || $class->type == 3)
                        <?php $i = 0; $j = 0; ?>
                      @endif
                      @foreach ($athleteClass as $athlete)
                        @if ($athlete->classes_id == $class->id)
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
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
          @endforeach
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
<script>
    window.print();
</script>
</body>
</html>
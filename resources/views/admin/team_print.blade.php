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
            <h5 class="mb-0">{{ $team->username }} / {{ $team->university }} <p class="p-0 my-0 text-sm">ID: {{ $team->id }}</p></h5>
            <small>printed at: {{ date('d-M-Y H:i:s') }}</small>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row mx-auto">
          <div class="col-6">
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
                <p class="my-1">Address</p>
              </div>
              <div class="col-8">
                <p class="my-1">: {{ $team->address }}, {{ $country->name }} {{ $team->postal_code }}</p>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="row mx-auto text-left">
              <div class="col-4">
                <p class="my-1">Manager Team</p>
              </div>
              <div class="col-8">
                <p class="my-1">: {{ $manager->manager_name }}
                  @foreach ($alt_managers as $alt_manager)
                      , {{ $alt_manager->manager_name }}
                  @endforeach </p>
              </div>
            </div>
          </div>
        </div>
        <hr class="horizontal dark">
        <div class="row">
          <h5>Athletes Detail</h5>
          <p class="text-uppercase text-sm">number of athletes: {{ $total }}</p>
          @php
              $i = 1;
          @endphp
          <div class="col-12">
              <div class="table-responsive border-radius-lg">
                <table class="table text-center justify-content-center">
                  <thead>
                    <tr>
                      <th style="width: 5%">#</th>
                      <th style="width: 40%" class="text-left">Name</th>
                      <th style="width: 5%"><i class="fa fa-intersex"></i></th>
                      <th style="width: 40%">Class</th>
                      <th style="width: 5%">Weight</th>
                      <th style="width: 5%"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach ($athletes as $athlete)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td class="text-left">{{ $athlete->athlete_name }} <br><small>{{ $athlete->birth_place }} / {{ date('d M Y', strtotime($athlete->birth_date)) }}</small></td>
                      <td>
                        @if ($athlete->sex == 0)
                          <i class="fa fa-mars text-primary"></i>
                        @else
                        @if ($athlete->sex == 1)
                          <i class="fa fa-venus text-danger"></i>
                        @endif
                        @endif</td>
                      <td>
                        @foreach ($athleteClass as $class)
                          @if ($class->athletes_id == $athlete->id)
                            - {{ $class->classes->class_name }}                          
                          @endif
                        @endforeach
                      </td>
                      <td>{{ $athlete->weight }} Kg</td>
                      <td></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
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
<script>
    window.print();
</script>
</body>
</html>
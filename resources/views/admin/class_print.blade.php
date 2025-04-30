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
            <h5 class="mb-0">{{ $class->class_name }}</h5>
            <small>printed at: {{ date('d-M-Y H:i:s') }}</small>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
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
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 15%"></th>
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
                    </td>
                  </tr>
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
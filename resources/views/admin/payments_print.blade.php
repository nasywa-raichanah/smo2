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
        <div class="text-center">
          <div class="p-2">
            <h5 class="mb-0">PAYMENTS LIST</h5>
            <small>printed at: {{ date('d M Y H:i:s') }}</small>
          </div>
        </div>
        <small>number of payments: {{ $invoices->count() }}</small>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 5%">#</th>
                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 25%">Name</th>
                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Date</th>
                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 10%">Status</th>
                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Cost</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $num = 1;
              @endphp
              @foreach ($invoices as $invoice)
              <tr>
                <td class="align-middle text-center text-sm">
                  <p class="text-xs text-secondary mb-0">{{ $num++ }}</p>
                </td>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="{{ asset('style/quixlab-master/images/avatar/1.jpg') }}" class="avatar avatar-sm me-3" alt="image">
                    </div>
                    <div class="justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $invoice->user->username }}</h6>
                      <a class="text-xs text-secondary mb-0" href="#">{{ $invoice->invoice_code }}</a>
                    </div>
                  </div>
                </td>
                <td class="align-middle text-center text-sm">
                  <p class="text-xs text-secondary mb-0">{{ date('d M Y h:i:s', strtotime($invoice->updated_at)) }}</p>
                </td>
                <td class="align-middle text-center">
                  @switch($invoice->status)
                  @case(0)
                    <span class="badge badge-sm bg-gradient-warning">unpaid</span>
                    @break
                  @case(1)
                    <span class="badge badge-sm bg-gradient-success">paid</span>
                    @break
                  @default
                    error
                  @endswitch
                </td>
                <td class="align-middle text-center text-sm">
                  <p class="text-xs text-secondary mb-0">
                    @rupiah($payments->where('user_id',$invoice->user_id)->sum('total_cost'))
                  </p>
                </td>
              </tr>
              @endforeach
              <tr>
                <td class="align-middle" colspan="4">
                  <div class="d-flex px-4 justify-content-end">
                    <span class="text-sm text-success mb-0">Paid Total :</span>
                  </div>
                </td>
                <td class="align-middle">
                  <div class="d-flex px-4 justify-content-end">
                    <span class="text-sm text-success mb-0">@rupiah($invoices->where('status','=','1')->sum('total'))</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="align-middle" colspan="4">
                  <div class="d-flex px-4 justify-content-end">
                    <span class="text-sm text-warning mb-0">Unpaid Total :</span>
                  </div>
                </td>
                <td class="align-middle">
                  <div class="d-flex px-4 justify-content-end">
                    <span class="text-sm text-warning mb-0">@rupiah($invoices->where('status','!=','1')->sum('total'))</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="align-middle" colspan="4">
                  <div class="d-flex px-4 justify-content-end">
                    <span class="text-lg text-secondary mb-0">TOTAL :</span>
                  </div>
                </td>
                <td class="align-middle">
                  <div class="d-flex px-4 justify-content-end">
                    <span class="text-lg text-secondary mb-0">@rupiah($invoices->sum('total'))</span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
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
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

<body>
  <main>
    <div class="col-8">
      <div class="card">
        <div class="card-header pt-0 pb-1 text-center">
          <div class="row justify-content-between">
            <div class="col">
              <img class="mb-2 w-75 p-2" src="{{ asset('images/systems/big-logo.png') }}" alt="Logo">
            </div>
            <div class="col mt-3 text-end">
              <h5 class="mb-0">PAYMENT RECEIPT</h5>
              <small>printed at: {{ date('d-M-Y H:i:s') }}</small>
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
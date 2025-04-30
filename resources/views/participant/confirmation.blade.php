@extends('participant.layout.app')
@section('content')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid my-3 py-2">
                <div class="row">
                <div class="col-md-8 col-sm-10 mx-auto">
                <div class="card my-sm-5 my-lg-0">
                <div class="card-header text-center">
                    <div class="col-lg text-left">
                        <h5>Confirmation</h5>
                        <p class="text-sm mb-0">Confirm that all the data is correct before making the payment, and <b>{{ $team->username }}</b> agrees to all the terms and conditions.</p>
                        <p class="text-secondary pt-0 text-sm">After confirmation, you cannot make any changes to your data.</p>
                    </div>
                    <a class="btn bg-gradient-danger btn-xs" href="" data-bs-toggle="modal" data-bs-target="#modal-confirm"><span class="fas fa-check"></span> Confirm</a>
                </div>
                <hr>
                <div class="card-body pt-0">
                <h6>Cost Estimation:</h6>
                <div class="row">
                <div class="col-12">
                <div class="table-responsive border-radius-lg">
                <table class="table text-right">
                <thead class="bg-default">
                <tr>
                <th scope="col" class="pe-2 text-start ps-2 text-white">Detail</th>
                <th scope="col" class="pe-2 text-white">Qty</th>
                <th scope="col" class="pe-2 text-white" colspan="2">Rate</th>
                <th scope="col" class="pe-2 text-white">Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-start">Team Registration</td>
                    {{-- <td class="ps-4">1</td> --}}
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
                </div>
                </div>
                </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        <!-- Modal -->
        <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="modal-confirm" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title" id="modal-title-confirm">CONFIRM DATA</h6>
                  <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('is-confirm', $team->id) }}" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="row mx-auto">
                        <h6>If you are sure that the data entered is correct, type the password and then click Confirm.</h6>
                        <span>Once again, after confirmation you cannot make any changes to your data.</span>
                        <div class="row mb-2">
                            <div class="col-2 mt-auto">
                                <label class="form-label">Password</label>
                            </div>
                            <div class="col-10">
                                <div class="input-group">
                                    <input id="password" name="password" class="form-control" type="password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end pb-0">
                      <button type="submit" class="btn btn-xs bg-gradient-danger mb-0">Confirm</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
@endsection
@extends('admin.layout.app')
@section('content')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid my-3 py-2">
                <div class="row">
                <div class="col-md-8 col-sm-10 mx-auto">
                <form class="" action="index.html" method="post">
                <div class="card my-sm-5 my-lg-0">
                <div class="card-header text-center">
                    <div class="row justify-content-between">
                        <div class="col-md-5 text-start">
                            <img class="mb-2 w-75 p-2" src="{{ asset('images/systems/big-logo.png') }}" alt="Logo">
                            <h6 class="mb-0">
                                {{ $contact_name }}
                            </h6>
                            <p class="d-block text-secondary mb-0">{{ $contact_address }}</p>
                            <p class="d-block text-secondary">tel: {{ $contact_phone }}</p>
                        </div>
                        <div class="col-lg-4 col-md-6 text-md-end text-start mt-5">
                            <h6 class="d-block mt-2 mb-0">Billed to: {{ $team->username }}</h6>
                            <p class="text-secondary">{{ $team->address }}</p>
                        </div>
                    </div>
                <br>
                <div class="row justify-content-md-between">
                <div class="col-md-4 mt-auto">
                <h6 class="mb-0 text-start text-secondary">
                Invoice no
                </h6>
                <h5 class="text-start mb-0">
                    #{{ $invoices->invoice_code }}
                </h5>
                </div>
                <div class="col-lg-5 col-md-7 mt-auto">
                <div class="row mt-md-3 mt-2 text-md-end text-start">
                <div class="col-md-6 justify-content-between">
                <h6 class="text-secondary mb-0">Invoice Status:</h6>
                </div>
                <div class="col-md-6">
                    @switch($invoices->status)
                                  @case(0)
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modal-valid{{ $invoices->id }}"><span class="badge bg-gradient-danger badge-sm">UNPAID</span></a>
                                      @break
                                  @case(1)
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modal-valid{{ $invoices->id }}"><span class="badge bg-gradient-success badge-sm">PAID</span></a>
                                      @break
                                  @default
                                      error
                              @endswitch
                </div>
                </div>
                </div>
                </div>
                </div>
                <div class="card-body">
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
                <div class="card-footer mt-md-3 mt-2">
                <div class="row">
                <div class="col-lg-9 text-left">
                <h5>Payment Via:</h5>
                <div class="row gx-4">
                    <div class="col-auto">
                      <div class="avatar avatar-xl position-relative">
                        <img src="{{ asset('images/systems/'.$bank_logo)}}" class="w-100">
                      </div>
                    </div>
                    <div class="col-auto my-auto">
                      <div class="h-100">
                        <h5 class="mb-1">{{ $bank_name }}</h5>
                        <p class="mb-0 font-weight-bold text-sm">
                          {{ $bank_number }} ({{ $bank_name_of }})
                        </p>
                      </div>
                    </div>
                  </div>
                <p class="text-secondary text-sm">After making payment, please confirm by WhatsApp button below</p>
                </div>
                <div class="d-flex flex-row justify-content-end">
                    <div class="p-2">
                        <a class="btn bg-gradient-success" href="https://api.whatsapp.com/send?phone={{ $trans_confirm_contact }}&text=Hi%20SMC%2C%20we%20want%20to%20confirm%20payment%20with%20code%20%23{{ $invoices->invoice_code }}.%20Here%20we%20send%20proof%20of%20payment." target="_blank" role="button"><i class="fa fa-lg fa-whatsapp" onclick="#" aria-hidden="true"></i></a>
                    </div>
                    <div class="p-2">
                      <a class="btn bg-gradient-danger" href="{{ route('payment-print', $team->id) }}" target="_blank"><i class="fa fa-lg fa-print"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 text-md-end mt-md-0 mt-3">
                </div>
                </div>
                </div>
                </div>
                </form>
                </div>
                </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!-- Modal -->
        <div class="modal fade" id="modal-valid{{ $invoices->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-valid" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title" id="modal-title-valid">Invoice Validation</h6>
                  <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form role="form text-left" method="POST" action="{{ route('invoice-validation', $invoices->id) }}" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-check form-check-inline mb-2">
                        <input  class="form-check-input" type="radio" name="status" value="0" id="status0" {{$invoices->status == '0'? 'checked' : ''}} ><label class="form-check-label" for="status0"> Unpaid </label>
                        <br>
                        <input  class="form-check-input" type="radio" name="status" value="1" id="status1" {{$invoices->status == '1'? 'checked' : ''}} ><label class="form-check-label" for="status1"> Paid </label>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                      <button type="submit" class="btn gradient text-white my-0">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
@endsection
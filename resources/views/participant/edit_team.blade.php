@extends('participant.layout.app')
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
    <div class="row justify-content-center mt-0">
      <div class="col-12 col-sm-9 col-md-7 col-lg-11 text-center p-0 mt-3 mb-2">
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
        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
            <div class="d-flex align-items-center px-4">
                <h2><strong>Team Data</strong></h2>
                <a class="btn bg-gradient-danger btn-sm ms-auto" href="{{ route('my-team') }}">Back</a>
            </div>
          <div class="card-body px-0 pt-3 pb-2">
          <form method="POST" action="{{ route('edit-my-team-process') }}" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <hr>
            <div class="row mx-auto justify-content-between">
              <div class="col">
                <h6>Team Information</h6>
              </div>
            </div>
            <div class="row mx-auto">
                <div class="col-lg-4">
                  <label class="form-label" for="logo">Team Logo</label>
                  <div class="col">
                      <img src="{{ asset('images/teams/'. $team->logo) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem">
                      <div class="input-group">
                          <input class="form-control" type="file" accept="image/*" name="logo" id="logo"/>
                      </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="row">
                    <div class="col-lg-6 mt-2">
                      <label class="form-label" for="username">Team Name</label>
                      <div class="input-group">
                          <input class="form-control" type="text" @error('username') is-invalid @enderror name="username" id="username" required value="{{ $team->username }}"/>
                          @error('username')
                              <div class="invalid-feedback">
                              {{ $message }}
                              </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-lg-6 mt-2">
                      <label class="form-label" for="university">University</label>
                      <div class="input-group">
                          <input class="form-control" type="text" @error('university') is-invalid @enderror name="university" id="university" required value="{{ $team->university }}"/>
                          @error('university')
                              <div class="invalid-feedback">
                              {{ $message }}
                              </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <label class="form-label" for="address">Address</label>
                        <div class="input-group">
                            <textarea class="form-control" @error('address') is-invalid @enderror name="address" id="address" required rows="3">{{ $team->address }}</textarea>
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                              @enderror
                          </div>
                      </div>
                      <div class="col-lg-4 mt-2">
                        <label class="form-label" for="postal_code">Postal Code</label>
                        <div class="input-group">
                            <input class="form-control text-center" type="number" @error('postal_code') is-invalid @enderror name="postal_code" id="postal_code" required value="{{ $team->postal_code }}"/>
                            @error('postal_code')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                      </div>
                    <div class="col-lg-8 mt-2">
                      <label class="form-label" for="nationality">Country</label>
                      <div class="input-group">
                          <select class="form-control text-center" @error('nationality') is-invalid @enderror name="nationality" id="nationality">
                              <option selected hidden value="{{ $team->nationality }}">{{ $country->name }}</option>
                              @foreach ($countries as $country)
                                  <option value="{{ $country->code }}">{{ $country->name }}</option>
                              @endforeach
                          </select>
                          @error('nationality')
                              <div class="invalid-feedback">
                              {{ $message }}
                              </div>
                          @enderror
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row mx-auto justify-content-center text-center">
          </div>
            <div class="row mx-auto">
          </div>
          <hr>
          <div id="manager_info" class="row mx-auto justify-content-between">
            <div class="col">
              <h6>Manager Information</h6>
            </div>
          </div>
          <div class="row mx-auto">
            <div class="col-lg-4">
                <label class="form-label" for="coach_photo">Photo</label>
                <div class="col">
                    <img src="{{ asset('images/teams/managers/'. $manager->coach_photo) }}" class="mb-2 border-radius-lg shadow-sm" alt="" style="width: 13rem">
                    <div class="input-group">
                        <input class="form-control" type="file" accept="image/*" name="coach_photo" id="coach_photo"/>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="col-lg-12 mt-2">
                  <label class="form-label" for="manager_name">Name</label>
                  <div class="input-group">
                    <input class="form-control" type="text" @error('manager_name') is-invalid @enderror name="manager_name" id="manager_name" required value="{{ $manager->manager_name }}"/>
                    @error('manager_name')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <label class="form-label" for="whatsapp_num">Whatsapp Number</label>
                    <input type="number" @error('whatsapp_num') is-invalid @enderror class="form-control" name="whatsapp_num" id="whatsapp_num" required value="{{ $manager->whatsapp_num }}">
                    <p class="text-secondary text-left text-sm ml-2"><small>* type by starting with the phone code (ex. 62...)</small></p>
                    @error('whatsapp_num')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                    @enderror
                </div>
                {{-- <div class="col-lg-12 mt-2">
                  <label class="form-label">Coach Number ID</label>
                  <div class="input-group">
                    <input id="coach_num" name="coach_num" class="form-control" type="text" value="{{ $manager->coach_num }}" required>
                  </div>
                </div> --}}
            </div>
          </div>
          <hr>
          <div class="row mx-auto justify-content-between">
            <div class="col">
              <h6>Team Documents</h6>
            </div>
          </div>
          <div class="row mx-auto justify-content-center">
            <div class="col-lg-6 mt-2">
              <label class="form-label" for="mandate_letter">Mandate Letter</label>
              <div class="input-group">
                <input class="form-control" type="file" accept="image/*, application/pdf" id="mandate_letter" name="mandate_letter"/>
              </div>
            </div>
          </div>
          <hr>
          <div class="row mx-auto mb-3">
            <div class="d-flex justify-content-end">
              @if ($team->is_confirm == 0)
              <button type="submit" class="btn bg-gradient-danger m-0 ms-2">Update</button>
              @endif
            </div>
          </div>
          </form>
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
@extends('admin.layout.app')
@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
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
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="row justify-content-between">
            <div class="col">
              <h5>Transactions Setting</h5>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pt-3 pb-2">
          <form method="POST" action="{{ route('transactions.edit') }}" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <hr>
            <div class="row mx-auto justify-content-between">
              <div class="col">
                <h6>Transactions Cost</h6>
              </div>
            </div>
            <div class="row mx-auto">
              <div class="col-lg-6 mt-2">
                <label class="form-label">Individual Kata</label>
                <div class="input-group">
                  <input id="ind_kata_cost" name="ind_kata_cost" class="form-control" type="number" value="{{ $ind_kata_cost }}" required>
                </div>
              </div>
              <div class="col-lg-6 mt-2">
                <label class="form-label">Team Kata</label>
                <div class="input-group">
                  <input id="team_kata_cost" name="team_kata_cost" class="form-control" type="number" value="{{ $team_kata_cost }}" required>
                </div>
              </div>
              <div class="col-lg-6 mt-2">
                <label class="form-label">Individual Kumite</label>
                <div class="input-group">
                  <input id="ind_kumite_cost" name="ind_kumite_cost" class="form-control" type="number" value="{{ $ind_kumite_cost }}" required>
                </div>
              </div>
              <div class="col-lg-6 mt-2">
                <label class="form-label">Team Kumite</label>
                <div class="input-group">
                  <input id="team_kumite_cost" name="team_kumite_cost" class="form-control" type="number" value="{{ $team_kumite_cost }}" required>
                </div>
              </div>
              <div class="col-lg-6 mt-2">
                <label class="form-label">Registration</label>
                <div class="input-group">
                  <input id="regist_cost" name="regist_cost" class="form-control" type="number" value="{{ $regist_cost }}" required>
                </div>
              </div>
            </div>
            <hr>
            <div class="row mx-auto justify-content-between">
              <div class="col">
                <h6>Bank Detail</h6>
              </div>
            </div>
            <div class="row mx-auto">
            <div class="row mx-auto justify-content-center text-center">
              <div class="col-lg-3 col-md-4 mt-3">
                <label class="form-label">Bank Logo</label>
                <img src="{{ asset('images/systems/'. $bank_logo) }}" class="mb-2" alt="" style="width: 14rem">
                <div class="input-group">
                  <input id="bank_logo" name="bank_logo" class="form-control" type="file">
                </div>
              </div>
              <div class="col-lg-6 mt-3">
                <label class="form-label">Bank Name</label>
                <div class="input-group">
                  <input id="bank_name" name="bank_name" class="form-control" type="text" value="{{ $bank_name }}" required>
                </div>
              </div>
            </div>
              <div class="col-lg-6 mt-2">
                <label class="form-label">Bank Number</label>
                <div class="input-group">
                  <input id="bank_number" name="bank_number" class="form-control" type="text" value="{{ $bank_number }}" required>
                </div>
              </div>
              <div class="col-lg-6 mt-2">
                <label class="form-label">In the Name of</label>
                <div class="input-group">
                  <input id="bank_name_of" name="bank_name_of" class="form-control" type="text" value="{{ $bank_name_of }}" required>
                </div>
              </div>
            </div>
            <hr>
            <div class="row mx-auto justify-content-between">
              <div class="col">
                <h6>Confirmation Setting</h6>
              </div>
            </div>
            <div class="row mx-auto">
              <div class="col-lg-3 mt-2">
                <label class="form-label">Whatsapp Number</label>
                <div class="input-group">
                  <input id="trans_confirm_contact" name="trans_confirm_contact" class="form-control" type="text" value="{{ $trans_confirm_contact }}" required>
                </div>
              </div>
            </div>
            <div class="row mx-auto">
              <div class="col-lg-3 mt-2">
                <a class="btn btn-sm bg-gradient-warning" href="https://api.whatsapp.com/send?phone={{ $trans_confirm_contact }}&text=Hi%20SMC%2C%20we%20want%20to%20confirm%20payment%20with%20code%20%23XXXXX.%20Here%20we%20send%20proof%20of%20payment." target="_blank" role="button">WA Test</a>
              </div>
            </div>
            <hr>
            <div class="row mx-auto mb-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn bg-gradient-danger m-0 ms-2">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer pt-3  ">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6 mb-lg-0 mb-4">
          <div class="copyright text-center text-sm text-muted text-lg-start">
            Presented by <b>ORMAWA INKAI UNS</b>
            © <script>
              document.write(new Date().getFullYear())
            </script>. Theme <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link text-muted">Home</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</div>
@endsection

@section('footnote')
<script type="text/javascript">
  $(document).ready(function() {

    window.setTimeout(function() {
      $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
        $(this).remove();
      });
    }, 5000);

  });
</script>
@endsection
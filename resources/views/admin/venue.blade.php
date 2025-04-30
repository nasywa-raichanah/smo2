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
              <h5>Venue Setting</h5>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pt-3 pb-2">
        <form method="POST" action="{{ route('venue.edit') }}" enctype="multipart/form-data">
          @method('patch')
          @csrf
          <div class="row mx-auto">
            <div class="col-lg-4 mt-2">
            <label class="form-label">Venue Name</label>
            <div class="input-group">
              <input id="venue_name" name="venue_name" class="form-control" type="text" value="{{ $venue_name }}" required autofocus>
            </div>
          </div>
            <div class="col-lg-8 mt-2">
              <label class="form-label">Venue Address</label>
              <div class="input-group">
                <input id="venue_address" name="venue_address" class="form-control" type="text" value="{{ $venue_address }}" required>
              </div>
            </div>
            <div class="col-lg-12 mt-2">
              <label class="form-label">Google Maps Embed Location</label>
              <div class="input-group">
                <input id="venue_embed" name="venue_embed" class="form-control" type="text" value="{{ $venue_embed }}" required>
              </div>
            </div>
        </div>
          <div class="row mx-auto justify-content-center text-center">
            <div class="col-lg-3 col-md-4 mt-3">
            <label class="form-label">Venue Image 1</label>
            <img src="{{ asset('images/systems/'. $venue_img1) }}" class="mb-2" alt="" style="width: 14rem">
            <div class="input-group">
              <input id="venue_img1" name="venue_img1" class="form-control" type="file">
            </div>
          </div>
            <div class="col-lg-3 col-md-4 mt-3">
              <label class="form-label">Venue Image 2</label>
            <img src="{{ asset('images/systems/'. $venue_img2) }}" class="mb-2" alt="" style="width: 14rem">
              <div class="input-group">
                <input id="venue_img2" name="venue_img2" class="form-control" type="file">
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-3">
            <label class="form-label">Venue Image 3</label>
            <img src="{{ asset('images/systems/'. $venue_img3) }}" class="mb-2" alt="" style="width: 14rem">
            <div class="input-group">
              <input id="venue_img3" name="venue_img3" class="form-control" type="file">
            </div>
          </div>
            <div class="col-lg-3 col-md-4 mt-3">
              <label class="form-label">Venue Image 4</label>
            <img src="{{ asset('images/systems/'. $venue_img4) }}" class="mb-2" alt="" style="width: 14rem">
              <div class="input-group">
                <input id="venue_img4" name="venue_img4" class="form-control" type="file">
              </div>
            </div>
        </div>
        <div class="row mx-auto mb-3">
          <div class="d-flex justify-content-end mt-4">
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

  $(document).ready(function () {
   
  window.setTimeout(function() {
      $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
          $(this).remove(); 
      });
  }, 5000);
   
  });
  </script>
@endsection
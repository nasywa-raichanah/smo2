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
              <h5>Systems</h5>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pt-3 pb-2">
        <form method="POST" action="{{ route('systems.edit') }}" enctype="multipart/form-data">
          @method('patch')
          @csrf
          <hr>
          <div class="row mx-auto justify-content-between">
            <div class="col">
              <h6>Event Detail</h6>
            </div>
          </div>
          <div class="row mx-auto justify-content-center text-center">
            <div class="col-lg-3 col-md-4 mt-3">
              <label class="form-label">Header</label>
              <img src="{{ asset('images/systems/'. $event_big_logo) }}" class="mb-2" alt="" style="width: 14rem">
              <div class="input-group">
                <input id="event_big_logo" name="event_big_logo" class="form-control" type="file">
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-3">
              <label class="form-label">Logo</label>
              <img src="{{ asset('images/systems/'. $event_sm_logo) }}" class="mb-2" alt="" style="width: 14rem">
              <div class="input-group">
                <input id="event_sm_logo" name="event_sm_logo" class="form-control" type="file">
              </div>
            </div>
        </div>
          <div class="row mx-auto">
            <div class="col-lg-6">
              <div class="row">
                <div class="col-lg-8 mt-2">
                  <label class="form-label">Event Name</label>
                  <div class="input-group">
                    <input id="event_name" name="event_name" class="form-control" type="text" value="{{ $event_name }}" required autofocus>
                  </div>
                </div>
                <div class="col-lg-4 mt-2">
                  <label class="form-label">Abbreviation</label>
                  <div class="input-group">
                    <input id="event_short_name" name="event_short_name" class="form-control" type="text" value="{{ $event_short_name }}" required>
                  </div>
                </div>
                <div class="col-lg-12 mt-2">
                  <label class="form-label">Proposal Link</label>
                  <div class="input-group">
                    <input id="proposal_link" name="proposal_link" class="form-control" type="text" value="{{ $proposal_link }}" required>
                  </div>
                </div>
                <div class="col-lg-12 mt-2">
                  <label class="form-label">Short Description</label>
                  <div class="input-group">
                    <textarea id="about_desc" name="about_desc" class="form-control" type="text" rows="4" required>{{ $about_desc }}</textarea>
                  </div>
                </div>
                <div class="col-lg-12 mt-2">
                  <label class="form-label">Countdown to Event</label>
                  <div class="input-group">
                    <input type="date" name="countdown" id="countdown" class="form-control" value="{{ $countdown }}" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 mt-2">
              <label class="form-label">Long Description</label>
              <div class="input-group">
                <textarea id="contact_desc" name="contact_desc" class="form-control" type="text" rows="14" required>{{ $contact_desc }}</textarea>
              </div>
            </div>
        </div>
        <hr>
        <div class="row mx-auto justify-content-between">
          <div class="col">
            <h6>Contact Info</h6>
          </div>
        </div>
        <div class="row mx-auto">
          <div class="col-lg-6 mt-2">
            <label class="form-label">Presented By</label>
            <div class="input-group">
              <input id="contact_name" name="contact_name" class="form-control" type="text" value="{{ $contact_name }}" required>
            </div>
          </div>
          <div class="col-lg-6 mt-2">
            <label class="form-label">Address</label>
            <div class="input-group">
              <textarea id="contact_address" name="contact_address" class="form-control" type="text" rows="3" required>{{ $contact_address }}</textarea>
            </div>
          </div>
          <div class="col-lg-6 mt-2">
            <label class="form-label">Phone</label>
            <div class="input-group">
              <input id="contact_phone" name="contact_phone" class="form-control" type="text" value="{{ $contact_phone }}" required>
            </div>
          </div>
          <div class="col-lg-6 mt-2">
            <label class="form-label">E-mail</label>
            <div class="input-group">
              <input id="contact_email" name="contact_email" class="form-control" type="text" value="{{ $contact_email }}" required>
            </div>
          </div>
          <div class="col-lg-6 mt-2">
            <label class="form-label">Facebook Link</label>
            <div class="input-group">
              <input id="contact_fb" name="contact_fb" class="form-control" type="text" value="{{ $contact_fb }}" required>
            </div>
          </div>
          <div class="col-lg-6 mt-2">
            <label class="form-label">Instagram Link</label>
            <div class="input-group">
              <input id="contact_ig" name="contact_ig" class="form-control" type="text" value="{{ $contact_ig }}" required>
            </div>
          </div>
          <div class="col-lg-6 mt-2">
            <label class="form-label">Twitter Link</label>
            <div class="input-group">
              <input id="contact_tw" name="contact_tw" class="form-control" type="text" value="{{ $contact_tw }}" required>
            </div>
          </div>
          <div class="col-lg-6 mt-2">
            <label class="form-label">Whatsapp Link</label>
            <div class="input-group">
              <input id="contact_wa" name="contact_wa" class="form-control" type="text" value="{{ $contact_wa }}" required>
            </div>
          </div>
          <div class="col-lg-6 mt-2">
            <label class="form-label">Youtube Link</label>
            <div class="input-group">
              <input id="contact_yt" name="contact_yt" class="form-control" type="text" value="{{ $contact_yt }}" required>
            </div>
          </div>
        </div>
        <hr>
        <div class="row mx-auto justify-content-between">
          <div class="col">
            <h6>Homepage Setting</h6>
          </div>
        </div>
        <div class="row mx-auto">
          <div class="col-lg-6 mt-2">
            <label class="form-label">Home Description</label>
            <div class="input-group">
              <input id="home_desc" name="home_desc" class="form-control" type="text" value="{{ $home_desc }}" required>
            </div>
          </div>
          <div class="col-lg-6 mt-2">
            <label class="form-label">Teaser Video Link</label>
            <div class="input-group">
              <input id="home_yt_teaser" name="home_yt_teaser" class="form-control" type="text" value="{{ $home_yt_teaser }}" required>
            </div>
          </div>
          <div class="col-lg-2 mt-2">
            <label class="form-label">About: Date (day)</label>
            <div class="input-group">
              <input id="date_day" name="date_day" class="form-control" type="text" value="{{ $date_day }}" required>
            </div>
          </div>
          <div class="col-lg-2 mt-2">
            <label class="form-label">About: Date (date)</label>
            <div class="input-group">
              <input id="date_date" name="date_date" class="form-control" type="text" value="{{ $date_date }}" required>
            </div>
          </div>
          <div class="col-lg-2 mt-2">
            <label class="form-label">About: Date (year)</label>
            <div class="input-group">
              <input id="date_year" name="date_year" class="form-control" type="text" value="{{ $date_year }}" required>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-3">
            <label class="form-label">Home Background</label>
            <img src="{{ asset('style/TheEvent/assets/img/'. $home_bg) }}" class="mb-2" alt="" style="width: 14rem">
            <div class="input-group">
              <input id="home_bg" name="home_bg" class="form-control" type="file">
            </div>
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

  $(document).ready(function () {
   
  window.setTimeout(function() {
      $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
          $(this).remove(); 
      });
  }, 5000);
   
  });
  </script>
@endsection
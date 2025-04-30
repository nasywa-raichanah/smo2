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
    </div>
      <div class="card mb-4">
          <div class="card-header pb-0 text-center">
              <h5>NEWS LIST</h5>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
              <div class="row mx-auto mb-3 justify-content-center">
                  <div class="col-lg-3 col-md-12 mt-3">
                    <div class="card h-100 card-plain border" style="width: 15rem">
                      <div class="card-body d-flex flex-column justify-content-center text-center">
                        <a href="{{ route('news.create') }}">
                          <i class="fa fa-plus text-secondary mb-3"></i>
                          <h5 class=" text-secondary"> Add News</h5>
                        </a>
                      </div>
                    </div>
                  </div>
                  @if ($news->count())
                  @foreach ($news as $post)
                  <div class="col-lg-3 col-md-12 mt-3">
                      <div class="card h-100 card-plain border" style="width: 15rem">
                          <img src="{{ asset('images/news/'. $post->image) }}" class="card-img-top" alt="{{ $post->image }}">
                          <div class="card-body">
                          <h6 class="card-title">{{ $post->title }}</h6>
                          <p class="card-text text-sm">{{ $post->excerpt }}</p>
                          <a href="{{ route('post', $post->slug) }}" class="card-link text-sm text-danger">READ MORE</a>
                          </div>
                      </div>
                  </div> 
                  @endforeach
                  @else
                  @endif
              </div>
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
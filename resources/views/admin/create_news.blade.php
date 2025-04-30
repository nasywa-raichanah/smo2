@extends('admin.layout.app')
@section('headnote')
  <link rel="stylesheet" type="text/css" href="{{ asset('style/board/css/trix.css') }}">
  <script type="text/javascript" src="{{ asset('style/board/js/trix.js') }}"></script>

  <style>
    trix-toolbar [data-trix-button-group="file-tools"] {
      display: none;
    }
  </style>
@endsection
@section('content')    
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-9 col-12 mx-auto">
      <div class="card card-body mt-4">
        <h6 class="mb-0">Create a News</h6>
        <hr class="horizontal dark my-3">
        <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="row mt-2">
            <div class="col">
              <label for="title" class="form-label">Title</label>
              <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Type a title" required autofocus value="{{ old('title') }}">
              @error('title')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-6">
              <label class="form-label">Author</label>
              <input id="author" name="author" class="form-control @error('author') is-invalid @enderror" type="text" placeholder="Type your name" required value="{{ old('author') }}">
              @error('author')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-6">
              <label class="form-label">Image</label>
              <input id="image" name="image" class="form-control" type="file" required>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col">
              <label class="form-label">Content</label>
              <input id="content" type="hidden" name="content" value="{{ old('content') }}">
              <trix-editor input="content"></trix-editor>
              @error('content')
                <p class="text-danger text-sm">{{ $message }}</p>
              @enderror
            </div>
          </div>
          <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn bg-gradient-danger m-0 ms-2">Create News</button>
          </div>
        </form>
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
    <script>
      document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
      })
    </script>
@endsection
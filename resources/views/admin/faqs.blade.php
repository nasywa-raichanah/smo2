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
              <h6>FAQs List</h6>
            </div>
            <div class="col text-right">
              <a class="btn bg-gradient-danger btn-sm border-0 btn-rounded px-5" href="" data-bs-toggle="modal" data-bs-target="#modal-add">Add</a>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 5%">#</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 40%">Question</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 45%">Answer</th>
                  <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 10%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0; ?>
                @foreach ($faqs as $faq)
                <?php $i++; ?>
                <tr>
                  <td class="align-middle text-center text-sm">
                    <p class="text-secondary mb-0">{{ $i }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-secondary mb-0 text-sm">{{ $faq->question }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-secondary mb-0 text-sm">{{ $faq->answer }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <a href="" data-bs-toggle="modal" data-bs-target="#modal-edit{{ $faq->id }}"><i class="fas fa-edit text-warning"></i></a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $faq->id }}"><i class="fas fa-trash text-danger"></i></a>
                  </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="modal-edit{{ $faq->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
                  <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-add">Edit FAQ</h6>
                        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form role="form text-left" action="{{ route('faqs.edit', $faq->id) }}" method="POST">
                          @method('patch')
                          @csrf
                          <label>Question</label>
                          <div class="input-group mb-3">
                            <input type="text" name="question" id="question" class="form-control" value="{{ $faq->question }}">
                          </div>
                          <label>Answer</label>
                          <div class="input-group mb-3">
                            <input type="text" name="answer" id="answer" class="form-control" value="{{ $faq->answer }}">
                          </div>
                          <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn gradient text-white">Update</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="modal-delete{{ $faq->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
                  <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-add">Delete FAQ</h6>
                        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure to delete "{{ $faq->question }}" FAQ?</p>
                      </div>
                      <div class="modal-footer">
                        <form role="form text-left" action="{{ route('faqs.delete', $faq->id) }}" method="POST">
                          @method('delete')
                          @csrf
                          <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <!-- Modal -->
  <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-add" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-add">Add FAQ</h6>
          <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form text-left" action="{{ route('faqs.store') }}" method="POST">
            @csrf
            <label>Question</label>
            <div class="input-group mb-3">
              <input type="text" name="question" id="question" class="form-control" placeholder="Type the Question" required>
            </div>
            <label>Answer</label>
            <div class="input-group mb-3">
              <input type="text" name="answer" id="answer" class="form-control" placeholder="Type the Answer" required>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button type="submit" class="btn gradient text-white">Create</button>
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
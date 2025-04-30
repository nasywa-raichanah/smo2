@extends('participant.layout.app')
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
        <div class="card-header pb-0 text-center">
          <h5>CLASSES</h5>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="row mx-auto mb-3 justify-content-center">
              @if ($classes->count())
              @foreach ($classes as $class)
              <div class="col-lg-3 col-md-12 mt-3 mx-auto">
                  <div class="card h-100 card-plain border mx-auto" style="width: 15rem">
                    <a href="{{ route('detail-my-class', $class->id) }}">
                      <img
                      @switch($class->type)
                          @case(0)
                              @if ($class->sex == 0)
                              src="{{ asset('images/systems/classes/1.JPG') }}"
                              @else
                              @if ($class->sex == 1)
                              src="{{ asset('images/systems/classes/2.JPG') }}"
                              @endif
                              @endif
                              @break
                          @case(1)
                              @if ($class->sex == 0)
                              src="{{ asset('images/systems/classes/3.JPG') }}"
                              @else
                              @if ($class->sex == 1)
                              src="{{ asset('images/systems/classes/4.JPG') }}"
                              @endif
                              @endif
                              @break
                          @case(2)
                              @if ($class->sex == 0)
                              src="{{ asset('images/systems/classes/5.JPG') }}"
                              @else
                              @if ($class->sex == 1)
                              src="{{ asset('images/systems/classes/6.JPG') }}"
                              @endif
                              @endif
                              @break
                          @case(3)
                              @if ($class->sex == 0)
                              src="{{ asset('images/systems/classes/7.JPG') }}"
                              @else
                              @if ($class->sex == 1)
                              src="{{ asset('images/systems/classes/8.JPG') }}"
                              @endif
                              @endif
                              @break
                          @default
                      @endswitch class="card-img-top" alt="">
                      <div class="card-body py-1">
                      <h6 class="card-title text-center">
                        {{ $class->class_name }}
                      </h6>
                    </div>
                    <div class="row justify-content-between text-end mx-auto">
                      <div class="col-9">
                        <p class="card-text text-sm">
                          @switch($class->type)
                              @case(0)
                              @case(2)
                                Your Athletes: {{ $athleteClass->where('classes_id', $class->id)->count() }}
                              @break
                              @case(1)
                              @case(3)
                                {{-- Your Teams: {{ $athleteClass->where('classes_id', $class->id)->count('DISTINCT','group') }} --}}
                                Your Athletes: {{ $athleteClass->where('classes_id', $class->id)->count() }}
                              @break
                              @default
                          @endswitch</p>
                      </div>
                      <div class="col-3">
                        <span><i class="fas fa-angle-right text-danger m-r-5"></i></span>
                      </div>
                    </div>
                  </a>
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
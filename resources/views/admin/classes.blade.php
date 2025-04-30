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
      <div class="row mb-0 pb-0">
        <div class="col-7">
          <p class="text-white text-sm">
            <i class="fa fa-mars text-primary"></i> : 
            {{ $classes->where('sex','=','0')->where('type','=','0')->count() + $classes->where('sex','=','0')->where('type','=','1')->count() }} Kata
            {{ $classes->where('sex','=','0')->where('type','=','2')->count() + $classes->where('sex','=','0')->where('type','=','3')->count() }} Kumite<br>
            <i class="fa fa-venus text-danger"></i> : 
            {{ $classes->where('sex','=','1')->where('type','=','0')->count() + $classes->where('sex','=','1')->where('type','=','1')->count() }} Kata 
            {{ $classes->where('sex','=','1')->where('type','=','2')->count() + $classes->where('sex','=','1')->where('type','=','3')->count() }} Kumite
          </p>
        </div>
        <div class="col-5">
          <p class="text-white text-right text-sm">
            <br>
            Total: {{ $classes->count() }} Classes
          </p>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h5>CLASSES</h5>
          <div class="row justify-content-between">
            <div class="col">
              <h6>Classes List</h6>
            </div>
            <div class="col text-right">
              <button class="btn btn-link text-secondary mb-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v text-xs"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-add"><i class="fas fa-plus"></i> Add</a>
                <a class="dropdown-item" href="{{ route('classes-print') }}" target="_blank"><i class="fas fa-print"></i> Print All</a>
              </div>
            </div>
          </div>
        </div>
        
        <div class="card-body px-0 pt-0 pb-2">
          <div class="row mx-auto mb-3 justify-content-center">
            @if ($classes->count())
            @foreach ($classes as $class)
            <div class="col-lg-3 col-md-12 mt-3 mx-auto">
              <div class="card h-100 card-plain border mx-auto" style="width: 15rem">
                <a href="{{ route('detail-class', $class->id) }}">
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
                            Total Athletes: {{ $athleteClass->where('classes_id', $class->id)->count() }}
                          @break
                          @case(1)
                          @case(3)
                            {{-- Your Teams: {{ $athleteClass->where('classes_id', $class->id)->count('DISTINCT','group') }} --}}
                            Total Athletes: {{ $athleteClass->where('classes_id', $class->id)->count() }}
                          @break
                          @default
                      @endswitch</p>
                  </div>
                  {{-- <div class="col-6 text-right mx-auto">
                    <span><a href="{{ route('detail-my-class', $class->id) }}"><i class="fas fa-eye fa-xs text-success m-r-5"></i> </a></span>
                    <span><a href="{{ route('detail-my-class', $class->id) }}"><i class="fas fa-pencil-alt fa-xs text-warning m-r-5"></i> </a></span>
                    <span><a href="{{ route('detail-my-class', $class->id) }}"><i class="fas fa-print fa-xs text-primary m-r-5"></i> </a></span>
                    <span><a href="{{ route('detail-my-class', $class->id) }}"><i class="fas fa-trash fa-xs text-danger m-r-5"></i> </a></span>
                  </div> --}}
                  <div class="col-3">
                    <span><i class="fas fa-angle-right text-danger m-r-5"></i></span>
                  </div>
                </div>
                </a>
              </div>
          </div> 
            @endforeach
            {{-- <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 50%">Class</th>
                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 20%">Total Athletes</th>
                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7" style="width: 30%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr><th colspan="3" class="text-center">INDIVIDUAL KATA</th></tr>
                  @if ($ind_m_kata->count())
                  <tr><th colspan="3">MALE CLASS</th></tr>
                  @foreach ($ind_m_kata as $class)
                  <tr>
                    <td class="align-middle">
                      <p class="text-secondary mb-0">Kata Perorangan {{ $class->class_name }} Putra</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-secondary">15</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <div class="btn-group">
                        <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu text-secondary">
                          <a class="dropdown-item" href="#"><i class="fas fa-eye"></i> Detail</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-print"></i> Print</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                  @if ($ind_f_kata->count())
                  <tr><th colspan="3">FEMALE CLASS</th></tr>
                  @foreach ($ind_f_kata as $class)
                  <tr>
                    <td class="align-middle">
                      <p class="text-secondary mb-0">Kata Perorangan {{ $class->class_name }} Putri</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-secondary">15</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <div class="btn-group">
                        <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu text-secondary">
                          <a class="dropdown-item" href="#"><i class="fas fa-eye"></i> Detail</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-print"></i> Print</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                  <tr><th colspan="3" class="text-center">GROUP KATA</th></tr>
                  @if ($group_m_kata->count())
                  <tr><th colspan="3">MALE CLASS</th></tr>
                  @foreach ($group_m_kata as $class)
                  <tr>
                    <td class="align-middle">
                      <p class="text-secondary mb-0">Kata Beregu {{ $class->class_name }} Putra</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-secondary">15</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <div class="btn-group">
                        <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu text-secondary">
                          <a class="dropdown-item" href="#"><i class="fas fa-eye"></i> Detail</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-print"></i> Print</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                  @if ($group_f_kata->count())
                  <tr><th colspan="3">FEMALE CLASS</th></tr>
                  @foreach ($group_f_kata as $class)
                  <tr>
                    <td class="align-middle">
                      <p class="text-secondary mb-0">Kata Beregu {{ $class->class_name }} Putri</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-secondary">15</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <div class="btn-group">
                        <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu text-secondary">
                          <a class="dropdown-item" href="#"><i class="fas fa-eye"></i> Detail</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-print"></i> Print</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                  @if ($ind_m_kumite->count())
                  <tr><th colspan="3" class="text-center">INDIVIDUAL KUMITE</th></tr>
                  <tr><th colspan="3">MALE CLASS</th></tr>
                  @foreach ($ind_m_kumite as $class)
                  <tr>
                    <td class="align-middle">
                      <p class="text-secondary">Kumite Perorangan {{ $class->class_name }}
                        @if ($class->max_weight) {{ $weight = '-' . $class->max_weight . 'Kg' }}
                        @else
                        @if ($class->min_weight) {{ $weight = '+' . $class->min_weight . 'Kg' }}
                        @endif
                        @endif
                        Putra</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-secondary">15</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <div class="btn-group">
                        <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu text-secondary">
                          <a class="dropdown-item" href="#"><i class="fas fa-eye"></i> Detail</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-print"></i> Print</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                  @if ($ind_f_kumite->count())
                  <tr><th colspan="3">FEMALE CLASS</th></tr>
                  @foreach ($ind_f_kumite as $class)
                  <tr>
                    <td class="align-middle">
                      <p class="text-secondary mb-0">Kumite Perorangan {{ $class->class_name }}
                        @if ($class->max_weight) {{ $weight = '-' . $class->max_weight . 'Kg' }}
                        @else
                        @if ($class->min_weight) {{ $weight = '+' . $class->min_weight . 'Kg' }}
                        @endif
                        @endif
                        Putri</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-secondary">15</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <div class="btn-group">
                        <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu text-secondary">
                          <a class="dropdown-item" href="#"><i class="fas fa-eye"></i> Detail</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-print"></i> Print</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                  <tr><th colspan="3" class="text-center">GROUP KUMITE</th></tr>
                  @if ($group_m_kumite->count())
                  <tr><th colspan="3">MALE CLASS</th></tr>
                  @foreach ($group_m_kumite as $class)
                  <tr>
                    <td class="align-middle text-sm">
                      <p class="text-secondary mb-0">Kumite Beregu {{ $class->class_name }}
                        @if ($class->max_weight) {{ $weight = '-' . $class->max_weight . 'Kg' }}
                        @else
                        @if ($class->min_weight) {{ $weight = '+' . $class->min_weight . 'Kg' }}
                        @endif
                        @endif
                        Putra</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-secondary">15</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <div class="btn-group">
                        <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu text-secondary">
                          <a class="dropdown-item" href="#"><i class="fas fa-eye"></i> Detail</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-print"></i> Print</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                  @if ($group_f_kumite->count())
                  <tr><th colspan="3">FEMALE CLASS</th></tr>
                  @foreach ($group_f_kumite as $class)
                  <tr>
                    <td class="align-middle">
                      <p class="text-secondary mb-0">Kumite Beregu {{ $class->class_name }}
                        @if ($class->max_weight) {{ $weight = '-' . $class->max_weight . 'Kg' }}
                        @else
                        @if ($class->min_weight) {{ $weight = '+' . $class->min_weight . 'Kg' }}
                        @endif
                        @endif
                        Putri</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-secondary">15</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <div class="btn-group">
                        <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu text-secondary">
                          <a class="dropdown-item" href="#"><i class="fas fa-eye"></i> Detail</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-print"></i> Print</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div> --}}
            @else
            <h3 class="align-middle text-center text-secondary"><i class="fas fa-exclamation-triangle fa-4x"></i><br> Class(es) not found</h3>
            @endif
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
          <h6 class="modal-title" id="modal-title-add">Add Class</h6>
          <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        {{-- <div class="modal-body">
          <form role="form text-left" action="{{ route('classes.store') }}" method="POST">
            @csrf
            <label>Type</label>
            <div class="input-group mb-3">
              <select class="form-select" id="selectType" name="selectType" onchange="myFunction();kataOrKumite(this);">
                <option selected hidden value="">Choose type</option>
                <option value="Kata Perorangan">Individual Kata</option>
                <option value="Kata Beregu">Team Kata</option>
                <option value="Kumite Perorangan">Individual Kumite</option>
                <option value="Kumite Beregu">Team Kumite</option>
              </select>
            </div>
            <label>Name</label>
            <div class="input-group mb-3">
              <input type="text" name="name" id="name" class="form-control" placeholder="Name" oninput="myFunction()">
            </div>
            <div class="row">
              <div id="ifKumite" style="display: none;" class="col">
                <label>Weight</label>
                <div class="input-group mb-3">
                  <div class="row">
                    <div class="col">
                      <select name="minOrMax" id="selectMinOrMax" class="form-select" onchange="myFunction()">
                        <option selected hidden value="">-/+</option>
                        <option value="-">-</option>
                        <option value="+">+</option>
                      </select>
                    </div>
                    <div class="col">
                      <input type="number" name="weight" id="weight" class="form-control" placeholder=".. Kgs" oninput="myFunction()">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col">
                <label>Gender</label>
                <div class="input-group mb-3">
                  <select name="sex" id="sex" class="form-select" onchange="myFunction()">
                    <option selected hidden value="">Choose Gender</option>
                    <option value="Putra">Male</option>
                    <option value="Putri">Female</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <div class="input-group">
                <input type="text" id="demo" class="form-control" readonly>
              </div>
              <button type="submit" class="btn gradient text-white">Create Class</button>
            </div>
          </form>
        </div> --}}
        <div class="modal-body">
          <form role="form text-left" action="{{ route('classes.store') }}" method="POST">
            @csrf
            <label>Type</label>
            <div class="input-group mb-1">
              <select class="form-select" id="type" name="type">
                <option selected hidden value="">Choose type</option>
                <option value="0">Individual Kata</option>
                <option value="1">Team Kata</option>
                <option value="2">Individual Kumite</option>
                <option value="3">Team Kumite</option>
              </select>
            </div>
            <label>Class Name</label>
            <div class="input-group mb-1">
              <input type="text" name="class_name" id="class_name" class="form-control" placeholder="Name">
            </div>
            <label>Gender</label>
                <div class="input-group mb-1">
                  <select name="sex" id="sex" class="form-select">
                    <option selected hidden value="">Choose Gender</option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                  </select>
                </div>
            <div class="row mb-1">
              <div class="col-3">
                <label>Min Weight</label>
                <input type="number" name="min_weight" id="min_weight" class="form-control mb-1" placeholder=".. Kg">
              </div>
              <div class="col-3">
                <label>Max Weight</label>
                <input type="number" name="max_weight" id="max_weight" class="form-control mb-1" placeholder=".. Kg">
              </div>
              <div class="col-3">
                <label>Min Athlete</label>
                <input type="number" name="min_athlete" id="min_athlete" class="form-control mb-1" placeholder="Min">
              </div>
              <div class="col-3">
                <label>Max Athlete</label>
                <input type="number" name="max_athlete" id="max_athlete" class="form-control mb-1" placeholder="Max">
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center py-0">
              <small class="text-secondary text-sm mt-0 mb-1">Weight can be filled with 0 if it doesn't require conditions.<br>Minimum Athlete can be filled with 1 (if Individual); 3 or 5 (if Team).<br>Maximum Athlete can be filled with 1 (if Individual); 3, 5, or 7 (if Team).
              </small>
              <button type="submit" class="btn gradient text-white my-auto">Create Class</button>
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
{{-- <script>
  function kataOrKumite(that){
    if (that.value == "Kumite Perorangan" || that.value == "Kumite Beregu"){
      document.getElementById("ifKumite").style.display = "block";
    } else {
      document.getElementById("ifKumite").style.display = "none";
    }
  }
</script>
<script type="text/javascript">
  function myFunction() {
  var selectType = document.getElementById("selectType").value;
  var name = document.getElementById("name").value;
  var minOrMax = document.getElementById("selectMinOrMax").value;
  var weight = document.getElementById("weight").value + "Kg";
  var sex = document.getElementById("sex").value;
  if (selectType == "Kumite Perorangan" || selectType == "Kumite Beregu"){
    document.getElementById("demo").value = selectType + " " + name + " " + minOrMax + weight + " " + sex;
  } else {
    document.getElementById("demo").value = selectType + " " + name + " " + sex;
  }
}
</script> --}}
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
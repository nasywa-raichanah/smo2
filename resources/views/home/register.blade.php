<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('style/quixlab-master/assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('style/quixlab-master/css/style.css') }}">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

</head>
<body class="h-100">
    <!-- Preloader start -->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0" >
                            <div class="card-body pt-3">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <a href="/"><img src="{{ asset('style/TheEvent/assets/img/logo_panjang.png') }}" class="img-fluid" alt=""></a>
                                        <h5 class="text-center font-weight-bold text-warning">REGISTRATION FORM</h5>
                                    </div>
                                </div>
                                <form action="{{ route('register.store') }}" method="POST" class="mt-4 mb-4 login-input">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" autofocus>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="username" name="username" class="form-control" placeholder="Team Name" value="{{ old('username') }}">
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="university" name="university" class="form-control" placeholder="University" value="{{ old('university') }}">
                                        @error('university')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="nationality" id="nationality">
                                            <option selected hidden value="">Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->code }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('nationality')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="password" id="re_type_password" name="re_type_password" class="form-control" placeholder="Re-type Your Password">
                                                @error('re_type_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn login-form__btn submit w-100" type="submit">Register</button>
                                </form>
                                <p class="text-center">Have account? <a href="/login" class="text-primary">Login </a> now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('style/quixlab-master/plugins/common/common.min.js') }}') }}"></script>
    <script src="{{ asset('style/quixlab-master/js/custom.min.js') }}"></script>
    <script src="{{ asset('style/quixlab-master/js/settings.js') }}"></script>
    <script src="{{ asset('style/quixlab-master/js/gleek.js') }}"></script>
    <script src="{{ asset('style/quixlab-master/js/styleSwitcher.js') }}"></script>

</body>
</html>
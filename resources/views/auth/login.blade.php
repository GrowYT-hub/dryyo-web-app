@extends('layouts.beforeLogin')

@section('content')
    <div class="container-login100">
        <div class="wrap-login100 p-6">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" class="login100-form validate-form" action="{{ route('login') }}">
                @csrf
                <span class="login100-form-title pb-1">
                    <img src="{{ asset('assets/images/brand/logo_2_107x70.png') }}" alt="">
                </span>
                <span class="login100-form-title pb-2">
                    {{ __('Login') }}
                </span>
                <div class="panel-body tabs-menu-body p-0 pt-5">

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab5">
                            <label><strong>Mobile Number</strong></label>
                            <div class="wrap-input100 validate-input input-group">
                                <a href="#" class="input-group-text bg-white text-muted">
                                    <i class="fa fa-phone icon_color" aria-label="fa fa-phone"></i>
                                </a>
                                <input class="input100 border-start-0 form-control ms-0" name="email" type="email"
                                    placeholder="Email">
                            </div>
                            <label><strong>Password</strong></label>
                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                <a href="#" class="input-group-text bg-white text-muted">
                                    <i class="fa fa-eye icon_color"aria-label="fa fa-eye"></i>
                                </a>
                                <input class="input100 border-start-0 form-control ms-0" name="password" type="password"
                                    placeholder="Password">
                            </div>

                            <div class="login100-form-title pb-2">
                                <button type="submit" class="btn btn-warning btn-pill">{{ __('Login') }}</button>
                            </div>

                        </div>
                    </div>
                </div>
        </div>

        </form>
    </div>
    </div>
    <!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
    <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
@endsection

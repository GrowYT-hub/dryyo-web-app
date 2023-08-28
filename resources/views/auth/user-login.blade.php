@extends('layouts.beforeLogin')

@section('content')
    <div class="container-login100">
        <div class="wrap-login100 p-6">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" class="login100-form validate-form" action="{{ route('user.sendOtp') }}">
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
                                <input class="input100 border-start-0 form-control ms-0" name="mobile" type="mobile"
                                    placeholder="Mobile Number" value="{{ old('mobile') }}">
                            </div>

                            <div class="login100-form-title pb-2">
                                <button type="submit" class="btn btn-warning btn-pill">{{ __('Login') }}</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

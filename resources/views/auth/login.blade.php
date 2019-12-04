@extends('layouts.auth')

@section('content')
    <!--begin::Head-->
    <div class="kt-login__head">
        <span class="kt-login__signup-label">Welcome. Please login to begin.</span>&nbsp;&nbsp;
    </div>

    <!--end::Head-->

    <!--begin::Body-->
    <div class="kt-login__body">

        <!--begin::Signin-->
        <div class="kt-login__form">
            <div class="kt-login__title">
                <h3>{{ __('Login') }}</h3>
            </div>

            <!--begin::Form-->
            <form class="kt-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} form-control-pill" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} form-control-pill" name="password" placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                    @endif
                </div>
                <div class="form-group mt-5">
                    <label class="kt-checkbox kt-checkbox--state-brand">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        {{ __('Remember Me') }}
                        <span></span>
                    </label>
                </div>

                <!--begin::Action-->
                <div class="kt-login__actions">
                    <button id="kt_login_signin_submit" type="submit" class="btn btn-primary btn-sm btn-elevate kt-login__btn-primary btn-pill btn-elevate"><i class="la la-unlock-alt"></i> {{ __('Login') }}</button>
                </div>

                <!--end::Action-->
            </form>

            <!--end::Form-->
        </div>

        <!--end::Signin-->
    </div>

    <!--end::Body-->
@endsection

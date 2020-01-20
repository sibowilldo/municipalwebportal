@extends('layouts.auth')

@section('content')

    <!--begin::Body-->
    <div class="m-login__body">

        <!--begin::Signin-->
        <div class="m-login__signin">
            <div class="m-login__title">
                <h3>{{ __('Login') }}</h3>
            </div>
            <!--begin::Form-->
            <form class="m-login__form m-form" method="POST" action="{{ route('login') }}">
                @csrf

                @if ($errors->has('password') || $errors->has('email'))
                    <span class="invalid-feedback" role="alert" style="display: block; text-align: center">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <div class="form-group m-form__group">
                    <div class="m-input-icon m-input-icon--left">
                        <input style="padding-left: 40px" id="email" type="email" class="form-control m-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail Address" required autofocus>
                        <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-user"></i></span></span>
                    </div>
                </div>
                <div class="form-group m-form__group">
                    <div class="m-input-icon m-input-icon--left ">
                        <input style="padding-left: 40px" id="password" type="password" class="form-control m-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                        <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-key"></i></span></span>
                    </div>
                </div>
                <div class="form-group m-form__group mt-5">
                    <label class="m-checkbox m-checkbox--state-brand">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        {{ __('Remember Me') }}
                        <span></span>
                    </label>
                </div>
                <div class="m-login__action">
                   <button id="m_login_signin_submit" type="submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">{{ __('Login') }}</button>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Signin-->
    </div>

@endsection

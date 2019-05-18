@extends('layouts.auth')

@section('content')
    <!--begin::Body-->
    <div class="m-login__body">

        <!--begin::Signin-->
        <div class="m-login__signin">
            <div class="m-login__title">
                <h3>{{ __('Reset Password') }}</h3>
            </div>

            <!--begin::Form-->


            <form class="m-login__form m-form" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group m-form__group">
                    {{--<label for="email" class="">{{ __('E-Mail Address') }}</label>--}}
                    <input id="email" type="email" class="form-control m-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="E-Mail Address">

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group m-form__group">
                    {{--<label for="password" class="">{{ __('Password') }}</label>--}}

                    <input id="password" type="password" class="form-control m-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group m-form__group">
                    {{--<label for="password" class="">{{ __('Password Confirmation') }}</label>--}}

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Password Confirmation">

                </div>


                <div class="m-login__action">
                    <button id="m_login_signin_submit" type="submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">{{ __('Reset Password') }}</button>
                </div>
            </form>
            <!--end::Form-->
        </div>

        <!--end::Signin-->
    </div>
@endsection

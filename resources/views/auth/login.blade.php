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

                <div class="form-group m-form__group">
                    {{--<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}
                    <input id="email" type="email" class="form-control m-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group m-form__group">
                    {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                    <input id="password" type="password" class="form-control m-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                    @endif
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

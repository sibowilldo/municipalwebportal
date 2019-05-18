@extends('layouts.auth')

@section('content')

    <!--begin::Body-->
    <div class="m-login__body">

        <!--begin::Signin-->
        <div class="m-login__signin">
            <div class="m-login__title">
                <i class="flaticon-lock m--font-metal" style="font-size: 5em"></i>
                <h3 class="mt-5">{{ __('Reset Password') }}</h3>
            </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group text-center">
                            <label for="email">{{ __('E-Mail Address') }}</label>

                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <button type="submit" class="btn btn-primary mt-5 m-btn--pill m-btn--air">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
@endsection

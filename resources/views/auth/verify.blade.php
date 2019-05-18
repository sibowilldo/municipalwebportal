@extends('layouts.auth')

@section('content')
    <!--begin::Body-->
    <div class="m-login__body">

        <!--begin::Signin-->
        <div class="m-login__signin">
            <div class="m-login__title">
                <i class="flaticon-email-black-circular-button m--font-metal" style="font-size: 5em"></i>
                <h3 class="mt-5">{{ __('Verify Your Email Address') }}</h3>
            </div>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
           <p class="text-center">
               {{ __('Before proceeding, please check your email for a verification link.') }}

               {{ __('If you did not receive the email, ') }}<br><a href="{{ route('verification.resend') }}" class="btn m-btn--pill m-btn--air btn-primary btn-lg m-btn m-btn--custom mt-5">{{ __('Request another') }}</a>
           </p>
        </div>
    </div>
@endsection

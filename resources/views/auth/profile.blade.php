@extends('layouts.master')

@section('title', 'Profile')
@section('breadcrumbs', Breadcrumbs::render('profile.edit', $user))

@section('content')
<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="m-portlet m-portlet--full-height  ">
            <div class="m-portlet__body">
                <div class="m-card-profile">
                    <div class="m-card-profile__title m--hide">
                        Your Profile
                    </div>
                    <div class="m-card-profile__pic">
                        <div class="m-card-profile__pic-wrapper">
                            <img src="{{ Avatar::create(Auth::user()->email)->toGravatar(['d' => 'mp', 'r' => 'pg', 's' => 200])}}" />
                        </div>
                    </div>
                    <div class="m-card-profile__details">
                        <span class="m-card-profile__name">{{ $user->fullname }}</span>
                        <a href="" class="m-card-profile__email m-link">{{ $user->email }}</a>
                    </div>
                </div>
                <div class="m-portlet__body-separator"></div>
                <div class="m-widget1 m-widget1--paddingless">
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">Logged Incidents</h3>
                                <span class="m-widget1__desc">To date</span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-brand">{{ $user->incidents()->count()}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">Closed Incidents</h3>
                                <span class="m-widget1__desc">To Date</span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-danger">{{ $user->incidents()->where('name', 'closed')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8">
        <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-tools">
                    <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#user_profile_tab" role="tab">
                                <i class="flaticon-share m--hide"></i>
                                Update Profile
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#activity_tab" role="tab">
                                Activity
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="user_profile_tab">
                    <div class="form-group m-form__group row">
                        <div class="col-9 offset-1">
                            <div class="m-form__seperator m-form__seperator--solid m-form__seperator--space-2x"></div>
                            <div class="row m-row--col-separator-lg m-row--no-padding">
                                <div class="col">
                                    <label class="m-option border-0">
                                                <span class="m-option__label">
                                                    <span class="m-option__head">
                                                        <span class="m-option__title">
                                                           Profile Created at
                                                        </span>
                                                    </span>
                                                    <span class="m-option__body">
                                                         {{ $user->created_at->format('d M Y j:s') }}
                                                    </span>
                                                </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="m-option border-0 ">
                                                <span class="m-option__label">
                                                    <span class="m-option__head">
                                                        <span class="m-option__title">
                                                           Last Updated
                                                        </span>
                                                        <span class="m-option__focus">
                                                            {{$user->updated_at ? $user->updated_at->diffForHumans() : 'Never'}}
                                                        </span>
                                                    </span>
                                                    <span class="m-option__body">
                                                         {{ $user->updated_at ? $user->updated_at->format('d M Y j:s') : '' }}
                                                    </span>
                                                </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="m-option border-0">
                                                <span class="m-option__label">
                                                    <span class="m-option__head">
                                                        <span class="m-option__title">
                                                           Current Status
                                                        </span>
                                                    </span>
                                                    <span class="m-option__body">
                                                        {{ ucfirst($user->status_is) }}
                                                    </span>
                                                </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                    {{ Form::model($user, array('route' => array('profile.update', $user->uuid), 'method' => 'PUT', 'class'=>'m-form m-form--fit m-form--label-align-right')) }}
                    @include('layouts.form-errors')
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <div class="col-10 ml-auto">
                                    <h3 class="m-form__section">{{ __('1. Personal Details') }}</h3>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="firstname" class="col-2 col-form-label">First Name</label>
                                <div class="col-7">
                                    <input class="form-control m-input" name="firstname" type="text" value="{{ $user->firstname }}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="lastname" class="col-2 col-form-label">Last Name</label>
                                <div class="col-7">
                                    <input class="form-control m-input" name="lastname" type="text" value="{{ $user->lastname }}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="email" class="col-2 col-form-label">Email</label>
                                <div class="col-7">
                                    <input class="form-control m-input" name="email" type="text" value="{{ $user->email }}" disabled>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="contactnumber" class="col-2 col-form-label">Contact Number</label>
                                <div class="col-7">
                                    <input class="form-control m-input" name="contactnumber" type="text" value="{{ $user->contactnumber }}">
                                </div>
                            </div>
                            <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                            <div class="form-group m-form__group row">
                                <div class="col-10 ml-auto">
                                    <h3 class="m-form__section">{{ __('2. Roles and Permissions') }}</h3>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-7 offset-2">
                                    <h6>Assigned Roles</h6>
                                    <div class="m-row--no-padding row">
                                    @foreach($user->roles as $role)
                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">{{  ucwords(str_replace('-', ' ', $role->name)) }}</div>
                                    @endforeach
                                    </div>
                                </div>
                                <div class="col-7 offset-2">
                                    <h6>Permissions</h6>
                                    <div class="m-row--no-padding row">
                                    @foreach($user->getAllPermissions() as $permission)
                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">{{  ucwords(str_replace('-', ' ', $permission->name)) }}</div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid">
                                <div class="row">
                                    <div class="col-2">
                                    </div>
                                    <div class="col-7">
                                        <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom m-btn--pill">Save changes</button>&nbsp;&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
                <div class="tab-pane " id="activity_tab">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
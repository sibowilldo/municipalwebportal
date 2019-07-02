@extends('layouts.master')

@section('title', 'Users')
@section('breadcrumbs', Breadcrumbs::render('users.edit', $user))

@section('content')
<div class="row">
    <div class="col-xl-6 col-md-12">
        <div class="m-portlet m-portlet--mobile  m-portlet--rounded">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('Edit: ').$user->fullname}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT', 'class'=>'m-form m-form--fit m-form--label-align-right')) }}{{-- Form model binding to automatically populate our fields with user data --}}
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group">
                            {{ Form::label('firstname', 'First Name') }}
                            {{ Form::text('firstname', null, array('class' => 'form-control m-input m-input--square')) }}
                        </div>

                        <div class="form-group m-form__group">
                            {{ Form::label('lastname', 'Last Name') }}
                            {{ Form::text('lastname', null, array('class' => 'form-control m-input m-input--square')) }}
                        </div>

                        <div class="form-group m-form__group">
                            {{ Form::label('contactnumber', 'Contact Number') }}
                            {{ Form::tel('contactnumber', null, array('class' => 'form-control m-input m-input--square')) }}
                        </div>

                        <div class="form-group m-form__group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', null, array('class' => 'form-control m-input m-input--square')) }}
                        </div>

                        <div class='form-group m-form__group'>
                                <label>Roles</label>
                                <div class="m-checkbox-list">
                                    @foreach ($roles as $role)
                                        <label class="m-checkbox m-checkbox--primary">
                                            {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
                                            {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                                            <span></span>
                                        </label>
                                    @endforeach
                                </div>
                        </div>

                        <div class='form-group m-form__group'>
                            {{ Form::label('status_is', 'Status') }}
                            {{ Form::select('status_is', $statuses, $user->status_is, ['class' => 'form-control m-input m-input--square']) }}
                        </div>
                        {{-- <div class="form-group m-form__group">
                            {{ Form::label('password', 'Password') }}<br>
                            {{ Form::password('password', array('class' => 'form-control m-input m-input--square')) }}

                        </div>

                        <div class="form-group m-form__group">
                            {{ Form::label('password', 'Confirm Password') }}<br>
                            {{ Form::password('password_confirmation', array('class' => 'form-control m-input m-input--square')) }}

                        </div> --}}
                    </div>

                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            {{ Form::submit('Update', array('class' => 'btn btn m-btn--pill btn-accent m-btn m-btn--custom m-btn--label-primary')) }}
                            <button type="reset" class="btn btn-secondary m-btn--pill">Cancel</button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<!--End::Section-->
@stop

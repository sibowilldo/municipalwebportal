@extends('layouts.master')

@section('title', 'Users')
@section('breadcrumbs', Breadcrumbs::render('users.edit', $user))

@section('content')
<div class="row">
    <div class="col-xl-6 col-md-12 offset-xl-3">
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
            @include('layouts.form-errors')
            {{ Form::model($user, array('route' => array('users.update', $user->uuid), 'method' => 'PUT', 'class'=>'m-form m-form--fit m-form--label-align-right')) }}{{-- Form model binding to automatically populate our fields with user data --}}
                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                        {{ Form::label('firstname', 'First Name') }}
                        {{ Form::text('firstname', null, array('class' =>
                                        'form-control m-input m-input--square',
                                        'data-validation'=>'required')) }}
                    </div>

                    <div class="form-group m-form__group">
                        {{ Form::label('lastname', 'Last Name') }}
                        {{ Form::text('lastname', null, array(
                                        'class' => 'form-control m-input m-input--square',
                                        'data-validation'=>'length,required',
                                        'data-validation-length' => 'min2')) }}
                    </div>

                    <div class="form-group m-form__group">
                        {{ Form::label('contactnumber', 'Contact Number') }}
                        {{ Form::tel('contactnumber', null, array(
                                        'class' => 'form-control m-input m-input--square',
                                        'data-validation'=>'custom',
                                        'data-validation-error-msg'=>'You have not given a correct phone number',
                                        'data-validation-regexp' => '^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$')) }}
                    </div>

                    <div class="form-group m-form__group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::email('email', null, array('class' => 'form-control m-input m-input--square', 'disabled')) }}
                    </div>

                    <div class='form-group m-form__group'>
                            <label>Roles</label>
                        {{ Form::select('roles[]', $roles,  $user->roles, ['class' => 'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker', 'multiple'=>'multiple']) }}
                    </div>

                    <div class='form-group m-form__group'>
                        {{ Form::label('status_id', 'Status') }}
                        {{ Form::select('status_id', $statuses, $user->status_id, ['class' => 'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker']) }}
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
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-success m-btn--pill m-btn--air">Update Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!--End::Section-->
@stop

@section('js')
    <script>
        $(document).ready(function(){
            //Handle Form Validation
            $.validate({
                modules : 'security'
            });
        });
    </script>
@stop

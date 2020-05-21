@extends('layouts.master')

@section('title', 'Users')
@section('breadcrumbs', Breadcrumbs::render('users.create'))

@section('content')
    <!--Begin::Section-->
    <div class="row">
        <div class="col-xl-6 col-md-12 offset-xl-3">
            <div class="m-portlet m-portlet--mobile  m-portlet--rounded">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Create User') }}
                            </h3>
                        </div>
                    </div>
                </div>
                    <!--begin::Form-->
                    <form class="m-form m-form--fit m-form--label-align-right m-form--state" method="post" action="{{ route('users.store') }}">
                        {{ csrf_field() }}
                        @include('layouts.form-errors')
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row{{ $errors->has('firstname') ? ' has-danger' : '' }}">
                                    {{ Form::label('firstname', 'First Name', ['class'=> 'col-3']) }}
                                <div class="col-9">
                                    {{ Form::text('firstname', '', [
                                        'class' => 'form-control m-input',
                                        'data-validation'=>'required']) }}

                                </div>
                            </div>
                            <div class="form-group m-form__group row{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                                    {{ Form::label('lastname', 'Last Name', ['class'=> 'col-3']) }}
                                <div class="col-9">
                                    {{ Form::text('lastname', '', [
                                        'class' => 'form-control m-input',
                                        'data-validation'=>'length,required',
                                        'data-validation-length' => 'min2']) }}

                                </div>
                            </div>
                            <div class="form-group m-form__group row{{ $errors->has('contactnumber') ? ' has-danger' : '' }}">
                                    {{ Form::label('contactnumber', 'Contact Number', ['class'=> 'col-3']) }}
                                <div class="col-9">
                                    {{ Form::tel('contactnumber', '', [
                                        'class' => 'form-control m-input',
                                        'data-validation'=>'custom',
                                        'data-validation-error-msg'=>'You have not given a correct phone number',
                                        'data-validation-regexp' => '^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$']) }}

                                </div>
                            </div>
                            <div class="form-group m-form__group row{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    {{ Form::label('email', 'Email', ['class'=> 'col-3']) }}
                                <div class="col-9">
                                    {{ Form::email('email', '', [
                                        'class' => 'form-control m-input',
                                        'data-validation'=>'email,required']) }}

                                </div>
                            </div>
                            <div class="form-group m-form__group row{{ $errors->has('status_id') ? ' has-danger' : '' }}">
                                    {{ Form::label('status_id', 'Status', ['class'=> 'col-3']) }}
                                <div class="col-9">
                                    {{ Form::select('status_id', $statuses, '', ['class' => 'form-control m-bootstrap-select m_selectpicker selectpicker']) }}

                                </div>
                            </div>
                            <div class="m-form__group m-form__group--last form-group row {{ $errors->has('roles') ? ' has-danger' : '' }}">
                                    {{ Form::label('rolea', 'Roles', ['class'=> 'col-3']) }}
                                    <div class="col-9">
                                        {{ Form::select('roles[]', $roles->pluck('name', 'id'), '', [
                                            'class' => 'form-control m-bootstrap-select m_selectpicker selectpicker',
                                            'multiple' => 'multiple',
                                            'data-validation'=>'required']) }}
                                    </div>
                            </div>
                        </div>
                        @include('layouts.portlets.footer._footer', ['type'=> 'create', 'name' => 'User'])
                    </form>
                    <!--end::Form-->
            </div>
        </div>
    </div>
    <!--End::Section-->
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/custom/users/create.css') }}">
@stop

@section('js')
    <script>
        jQuery(document).ready(function(){
            $('input[type=tel]').inputmask('(999) 999-9999');
            //Handle Form Validation
            $.validate({
                modules : 'security'
            });
        });
    </script>
@stop

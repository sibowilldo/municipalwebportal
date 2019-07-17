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
                                {{ __('Add New User') }}
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
                                    {{ Form::text('firstname', '', ['class' => 'form-control m-input m-input--square']) }}

                                </div>
                            </div>
                            <div class="form-group m-form__group row{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                                    {{ Form::label('lastname', 'Last Name', ['class'=> 'col-3']) }}
                                <div class="col-9">
                                    {{ Form::text('lastname', '', ['class' => 'form-control m-input m-input--square']) }}

                                </div>
                            </div>
                            <div class="form-group m-form__group row{{ $errors->has('contactnumber') ? ' has-danger' : '' }}">
                                    {{ Form::label('contactnumber', 'Contact Number', ['class'=> 'col-3']) }}
                                <div class="col-9">
                                    {{ Form::tel('contactnumber', '', ['class' => 'form-control m-input m-input--square']) }}

                                </div>
                            </div>
                            <div class="form-group m-form__group row{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    {{ Form::label('email', 'Email', ['class'=> 'col-3']) }}
                                <div class="col-9">
                                    {{ Form::email('email', '', ['class' => 'form-control m-input m-input--square']) }}

                                </div>
                            </div>
                            <div class="form-group m-form__group row{{ $errors->has('status_is') ? ' has-danger' : '' }}">
                                    {{ Form::label('status_is', 'Status', ['class'=> 'col-3']) }}
                                <div class="col-9">
                                    {{ Form::select('status_is', $statuses, '', ['class' => 'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker']) }}

                                </div>
                            </div>
                            <div class="m-form__group m-form__group--last form-group row {{ $errors->has('roles') ? ' has-danger' : '' }}">
                                    {{ Form::label('rolea', 'Roles', ['class'=> 'col-3']) }}
                                    <div class="col-9">
                                        {{ Form::select('roles[]', $roles->pluck('name', 'id'), '', ['class' => 'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker', 'multiple' => 'multiple']) }}
                                    </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid">
                                <div class="row">
                                    <div class="col-md-10 offset-md-2">
                                        <button type="submit" class="btn btn-success m-btn--pill m-btn--air">Add User</button>
                                        <button type="reset" class="btn btn-secondary m-btn--pill m-btn--air">Reset Form</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
            </div>
        </div>
    </div>
    <!--End::Section-->
@stop

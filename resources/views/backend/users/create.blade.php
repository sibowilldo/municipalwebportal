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
                <div class="m-portlet__body">
                    <!--begin::Form-->
                    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post" action="{{ route('users.store') }}">
                        {{ csrf_field() }}
                        <div class="m-portlet__body">
                            @include('layouts.form-errors')
                            <div class="form-group m-form__group">
                                    {{ Form::label('firstname', 'First Name') }}
                                    {{ Form::text('firstname', '', ['class' => 'form-control m-input m-input--square']) }}
                            </div>
                            <div class="form-group m-form__group">
                                    {{ Form::label('lastname', 'Last Name') }}
                                    {{ Form::text('lastname', '', ['class' => 'form-control m-input m-input--square']) }}
                            </div>
                            <div class="form-group m-form__group">
                                    {{ Form::label('contactnumber', 'Contact Number') }}
                                    {{ Form::tel('contactnumber', '', ['class' => 'form-control m-input m-input--square']) }}
                            </div>
                            <div class="form-group m-form__group">
                                    {{ Form::label('email', 'Email') }}
                                    {{ Form::email('email', '', ['class' => 'form-control m-input m-input--square']) }}
                            </div>
                            <div class="form-group m-form__group">
                                    {{ Form::label('status_is', 'Status') }}
                                    {{ Form::select('status_is', $statuses, '', ['class' => 'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker']) }}
                            </div>
                            <div class="m-form__group m-form__group--last form-group row">
                                <div class="col">
                                    <label>{{ __('Roles') }}</label>
                                    <div class="m-checkbox-list ">
                                        @foreach($roles as $role)
                                            <label class="m-checkbox m-checkbox--primary">{{ Form::checkbox('roles[]', $role->id)}} {{ ucfirst($role->name) }}<span></span></label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
    <!--End::Section-->
@stop


@extends('layouts.master')

@section('title', 'Permissions')
@section('breadcrumbs', Breadcrumbs::render('permissions.create'))

@section('content')

    <div class="row">
        <div class="col-xl-6 offset-xl-3">
            <div class="m-portlet m-portlet--mobile  m-portlet--rounded">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Add Permission') }}
                            </h3>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill m-btn btn-outline-dark m-btn--hover-dark">
                                    Quick Actions
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__section m-nav__section--first">
                                                        <span class="m-nav__section-text">Available Actions</span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('permissions.index') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-safe-shield-protection"></i>
                                                            <span class="m-nav__link-text">Available Permissions</span>
                                                        </a>
                                                    </li>

                                                    <li class="m-nav__item">
                                                        <a href="{{ route('roles.index') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-shield"></i>
                                                            <span class="m-nav__link-text">All Roles</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('users.index') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-users"></i>
                                                            <span class="m-nav__link-text">Users</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                @include('layouts.form-errors')
                {{ Form::open(array('route' => 'permissions.store', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--state')) }}
                <div class="m-portlet__body">

                    <div class="form-group m-form__group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                        {{ Form::label('name', 'Name', ['class' => 'col-3 col-form-label']) }}
                        <div class="col-9">
                            {{ Form::text('name', null, array('class' => 'form-control m-input')) }}
                        </div>
                    </div>

                    @if(!$roles->isEmpty())
                        <div class="form-group m-form__group row {{ $errors->has('roles') ? ' has-danger' : '' }}">
                            {{ Form::label('roles', 'Select Roles to assign', ['class' => 'col-3 col-form-label']) }}
                            <div class="col-9">
                                {{ Form::select('roles[]', $roles->pluck('name', 'id'), '', ['class' => 'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker', 'multiple' => 'multiple']) }}
                            </div>
                        </div>
                    @endif
                </div>

                @include('layouts.portlets.footer._footer', ['type'=> 'create', 'name' => 'Permission'])
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection

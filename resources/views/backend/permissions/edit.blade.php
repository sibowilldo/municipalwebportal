@extends('layouts.master')

@section('title', 'Permissions')
@section('breadcrumbs', Breadcrumbs::render('permissions.edit', $permission))

@section('content')

    <div class="row">
        <div class="col-xl-6 offset-xl-3">
            <div class="m-portlet m-portlet--mobile  m-portlet--rounded">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Edit Role: ') }} {{ ucfirst($permission->name) }}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
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
                                                                <span class="m-nav__link-text">All Permissions</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('roles.index') }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-users-1"></i>
                                                                <span class="m-nav__link-text">Available Roles</span>
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
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--state')) }}
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                        {{ Form::label('name', 'Permission Name', ['class' => 'col-3 col-form-label']) }}
                        <div class="col-9">
                            {{ Form::text('name', null, array('class' => 'form-control m-input')) }}
                        </div>
                    </div>
                    <div class="form-group m-form__group row {{ $errors->has('guard_name') ? ' has-danger' : '' }}">
                        {{ Form::label('guard_name', 'Guard', ['class' => 'col-3 col-form-label']) }}
                        <div class="col-9">
                            {{ Form::select('guard_name', ['web'=>'web','api'=>'api'] ,$permission->guard_name, array('class' => 'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker')) }}
                        </div>
                    </div>
                </div>
                @include('layouts.portlets.footer._footer', ['type'=> 'edit', 'name' => 'Permission'])

                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection

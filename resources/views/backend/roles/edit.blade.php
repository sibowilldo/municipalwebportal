@extends('layouts.master')

@section('title', 'Roles')
@section('breadcrumbs', Breadcrumbs::render('roles.edit', $role))

@section('content')

    <div class="row">
        <div class="col-xl-8 offset-2">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Edit Role: ') }} {{$role->name}}
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
                                                            <a href="{{ route('roles.index') }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-users-1"></i>
                                                                <span class="m-nav__link-text">All Roles</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('permissions.index') }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-safe-shield-protection"></i>
                                                                <span class="m-nav__link-text">Available Permissions</span>
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
                {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--state')) }}
                @include('layouts.form-errors')
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                        {{ Form::label('name', 'Name', ['class'=> 'col-3 col-form-label']) }}
                        <div class="col-9">
                            {{ Form::text('name', null, array('class' => 'form-control')) }}

                        </div>
                    </div>
                    <div class="form-group m-form__group row {{ $errors->has('guard_name') ? ' has-danger' : '' }}">
                        {{ Form::label('guard_name', 'Guard', ['class' => 'col-3 col-form-label']) }}
                        <div class="col-9">
                            {{ Form::select('guard_name', ['web'=>'web','api'=>'api'] ,$role->guard_name, array('class' => 'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker')) }}
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-xl-3 col-form-label">
                            Permissions
                        </label>
                        <div class="col-xl-9">
                            <span class="text-muted">{{ ucfirst($role->name) }} has <strong>{{ $role->permissions->count() }} active </strong> {{ $role->permissions->count() == 1 ? 'Permission' : 'Permissions' }}.</span>
                            <div class="m-scrollable" data-scrollable="true" style="height: 320px; margin: 30px 0;">
                                <div class="m-form__group form-group">
                                    <div class='m-row--col-separator-lg row'>
                                        @foreach ($permissions as $permission)
                                            <div class="col-4">
                                                <label class="m-checkbox m-checkbox--primary {{ ucfirst($permission->guard_name) }}">{{ Form::checkbox('permissions[]',  $permission->id) }}{{ ucfirst($permission->name) }}<span></span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('layouts.portlets.footer._footer', ['type'=> 'edit', 'name' => 'Role'])
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        jQuery(document).ready(function() {

        });
    </script>
@endsection

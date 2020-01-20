@extends('layouts.master')

@section('title', 'Dashboard')
@section('breadcrumbs', Breadcrumbs::render('dashboard'))

@section('content')
    @include('widgets.dashboard.incidents-at-a-glance')
    <dashboard></dashboard>
@stop

@section('modals')
    @include('modals._incident-form')
@stop

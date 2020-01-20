@extends('layouts.master')

@section('title', 'Incidents')
@section('breadcrumbs', Breadcrumbs::render('incidents.create'))

@section('content')
    <incident-create></incident-create>
@endsection


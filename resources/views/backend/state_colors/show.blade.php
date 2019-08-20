@extends('layouts.master')


@section('title', 'State Color')
@section('breadcrumbs', Breadcrumbs::render('state-colors.show', $state_color))

@section('content')

    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="m-portlet m-portlet--mobile ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('State Color Details') }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget13">
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                 #
                            </span>
                            <span class="m-widget13__text m-widget13__text-bolder">
                                {{ $state_color->id }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Name:
                            </span>
                            <span class="m-widget13__text m-widget13__text-bolder">
                                {{ $state_color->name }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                CSS Class:
                            </span>
                            <span class="m-widget13__text">
                                {{ $state_color->css_class }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                CSS Color:
                            </span>
                            <span class="m-widget13__text">
                                {{ $state_color->css_color }}
                            </span>
                        </div>
                        <div class="m-widget13__action m--align-right">
                            <a href="{{ route('state-colors.edit', $state_color->id) }}" class="m-widget__details  btn m-btn--pill  btn-accent">Edit Color</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@extends('apps::dashboard.layouts.app')
@section('title', __('families::dashboard.families.routes.update'))
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ url(route('dashboard.home')) }}">{{ __('apps::dashboard.index.title') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ url(route('dashboard.families.index')) }}">
                        {{__('families::dashboard.families.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('families::dashboard.families.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            {!! Form::model($family,[
                           'url'=> route('dashboard.families.update',$family->id),
                           'id'=>'updateForm',
                           'role'=>'form',
                           'page'=>'form',
                           'class'=>'form-horizontal form-row-seperated',
                           'method'=>'PUT',
                           'files' => true
                           ])!!}
                <div class="col-md-12">

                    {{-- RIGHT SIDE --}}
                    @include('families::dashboard.families.panel-group')
                    {{-- PAGE CONTENT --}}

                    <div class="col-md-9">
                        <div class="tab-content">

                            {{-- CREATE FORM --}}
                            @include('families::dashboard.families.form')
                            {{-- PAGE ACTION --}}
                            <div class="col-md-12">
                                <div class="form-actions">
                                    @include('apps::dashboard.layouts._ajax-msg')
                                    <div class="form-group">
                                        <button type="submit" id="submit" class="btn btn-lg green">
                                            {{__('apps::dashboard.buttons.edit')}}
                                        </button>
                                        <a href="{{url(route('dashboard.families.index')) }}" class="btn btn-lg red">
                                            {{__('apps::dashboard.buttons.back')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>
@stop

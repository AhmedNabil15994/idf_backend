@extends('apps::charities.layouts.app')
@section('title', __('families::charities.families.routes.show'))
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('charities.home')) }}">{{ __('apps::charities.index.title') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ url(route('charities.families.index')) }}">
                            {{__('families::charities.families.routes.index')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('families::charities.families.routes.show')}}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                <div class="col-md-12">

                    {{-- RIGHT SIDE --}}
                    @include('families::charities.families.panel-group')
                    {{-- PAGE CONTENT --}}
                    <div class="col-md-9">
                        <div class="tab-content">


                            <div class="tab-pane active fade in" id="general">

                                <h3 class="page-title">{{__('families::charities.families.form.tabs.general')}}</h3>

                                <div class="col-md-10">

                                    @include('families::charities.families.fields.general')

                                </div>
                            </div>

                            <div class="tab-pane fade in" id="family_members">

                                <h3 class="page-title">{{__('families::charities.families.form.tabs.family_members')}}</h3>

                                <div class="col-md-10">

                                    @include('families::charities.families.fields.members')

                                </div>
                            </div>

                            <div class="tab-pane fade in" id="address">

                                <h3 class="page-title">{{__('families::charities.families.form.tabs.address')}}</h3>

                                <div class="col-md-10">

                                    @include('families::charities.families.fields.address')

                                </div>
                            </div>

                            <div class="tab-pane fade in" id="attachments">

                                <h3 class="page-title">{{__('families::charities.families.form.tabs.attachments')}}</h3>

                                <div class="col-md-10">

                                    @include('families::charities.families.fields.attachments')

                                </div>
                            </div>

                            <div class="tab-pane fade in" id="baskets">

                                <h3 class="page-title">
                                    {{__('families::charities.families.form.tabs.baskets')}}
                                </h3>

                                <div class="col-md-10">

                                    @include('families::charities.families.fields.baskets')

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@extends('apps::frontend.layouts.app')
@section('title', __('donations::frontend.donate_resources.title'))
@push('styles')
@endpush
@section('content')
    @include('apps::frontend.layouts.page-banner',['title' =>__('authentication::frontend.login.title')])

    <div class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="login-form">
                        <h5 class="title-login"> {{__('authentication::frontend.login.donor_login')}}</h5>
                        <p class="p-title-login">{{__('authentication::frontend.login.donor_login_welcome')}}</p>
                        @include('authentication::frontend.auth.login-form')
                    </div>
                </div>
                <div class="col-md-2">
                    <span class="se-vert"></span>
                </div>
                <div class="col-md-5">
                    <div class="login-form signin-block">
                        <h5 class="title-login">{{__('authentication::frontend.login.donor_register')}}</h5>
                        <p class="p-title-login">{{__('authentication::frontend.login.donor_welcome')}}</p>
                        @include('authentication::frontend.auth.register-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

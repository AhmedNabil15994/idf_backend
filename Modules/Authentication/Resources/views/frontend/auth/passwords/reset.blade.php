@extends('apps::frontend.layouts.app')
@section('title', __('donations::frontend.donate_resources.title'))
@push('styles')
@endpush
@section('content')
    @include('apps::frontend.layouts.page-banner',['title' =>__('authentication::frontend.reset.title')])

    <div class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-form">
                        <h5 class="title-login"> {{__('authentication::frontend.reset.title')}}</h5>
                        {!! Form::open([
                            'method' => 'post',
                            'id' => 'form',
                            "class"=>"form-contact login mt-30",
                            'url' => url(route('frontend.password.email')),
                        ]) !!}

                        {!! field('frontend_no_label')->email('email',__('authentication::frontend.login.form.email'),null,[
                        'required' => true
                        ]) !!}

                        {!! field('frontend_no_label')->password('register_password',__('authentication::frontend.register.form.password'),[
                        'required' => true
                        ]) !!}

                        {!! field('frontend_no_label')->password('register_password_confirmation',__('authentication::frontend.register.form.password_confirmation'),[
                        'required' => true
                        ]) !!}

                        <button type="submit" class="btn theme-btn btn-block">
                            {{__('authentication::frontend.reset.reset')}}
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                  id="btn_spinner" style="display: none;    margin: 5px;"></span>
                        </button>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

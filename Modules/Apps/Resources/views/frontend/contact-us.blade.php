@extends('apps::frontend.layouts.app')
@section('title', __('apps::frontend.contact_us.title'))
@section('content')

    @include('apps::frontend.layouts.page-banner',['title' => __('apps::frontend.contact_us.header_title')])

    <div class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="main-title mb-30">{{__('apps::frontend.contact_us.send_message')}}</h2>
                    {!! Form::open([
                        'method' => 'post',
                        'id' => 'form',
                        "class"=>"form-contact",
                        'url' => url(route('frontend.contact-us.store')),
                    ]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="contact-info">
                                    {!! field('frontend')->text('username',__('apps::frontend.contact_us.name'),null,['required' => true]) !!}
                                    {!! field('frontend')->email('email',__('apps::frontend.contact_us.email'),null,['required' => true]) !!}
                                    {!! field('frontend')->number('mobile',__('apps::frontend.contact_us.phone'),null,['required' => true]) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! field('frontend')->textarea('message',__('apps::frontend.contact_us.message'),null,['required' => true,'class' => 'form-control']) !!}
                                <p class="form-row">
                                    <button class="btn theme-btn btn-block" type="submit" id="submit">
                                        <span id="btn_title">{{__('apps::frontend.contact_us.send')}}</span>
                                        <span class="spinner-border spinner-border-md" role="status" aria-hidden="true" id="btn_spinner" style="display: none"></span>
                                    </button>
                                </p>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-4 contact-details">
                    <h2 class="main-title mb-30">{{__('apps::frontend.contact_us.call_us')}}</h2>
                    <ul>
                        <li><i class="ti-mobile"></i> <strong>{{__('apps::frontend.contact_us.phone')}}</strong> <span> {{setting('contact_us','call_number')}} </span></li>
                        <li><i class="ti-headphone-alt"></i> <strong>{{__('apps::frontend.contact_us.technical_support')}}</strong> <span>{{setting('contact_us','technical_support')}} </span></li>
                        <li><i class="ti-location-pin"></i> <strong>{{__('apps::frontend.contact_us.our_address')}}</strong> <span>{{setting('contact_us','address')}}4</span></li>
                        <li><i class="ti-email"></i> <strong>{{__('apps::frontend.contact_us.email')}}</strong> <span><a  href="mailto:{{setting('contact_us','email')}}">{{setting('contact_us','email')}}</a></span></li>
                    </ul>
                    <div class="footer-social mt-30 pt-30">
                        @if (setting('social','facebook'))
					    
                            <a href="{{setting('social','facebook')}}" class="social-icon"><i class="ti-facebook"></i></a>
                        @endif
                        @if (setting('social','instagram'))
                            
                            <a href="{{setting('social','instagram')}}" class="social-icon"><i class="ti-instagram"></i></a>
                        @endif
                        @if (setting('social','linkedin'))
                            
                            <a href="{{setting('social','linkedin')}}" class="social-icon"><i class="ti-linkedin"></i></a>
                        @endif
                        @if (setting('social','twitter'))
                            
                            <a href="{{setting('social','twitter')}}" class="social-icon"><i class="ti-twitter-alt"></i></a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@extends('apps::frontend.layouts.app')
@section('title', __('donations::frontend.donate_resources.title'))
@push('styles')
    <style>
        .form-row-wide {
            margin-bottom: 13px;
        }

        form #submit {
            width: 262px;
            height: 48px;
            border-radius: 24px;
        }

        .nice-select {
            margin-bottom: 0px !important;
        }
    </style>
@endpush
@section('content')
    @include('apps::frontend.layouts.page-banner',['title' =>__('donations::frontend.donate_resources.title') ,'background' => asset('frontend/images/donate-resource.png')])

    <div class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="title-page"> {{__('donations::frontend.donate_resources.form.categories')}}</h2>

                    {!! Form::open([
                        'method' => 'post',
                        'id' => 'form',
                        "class"=>"form-contact",
                        'url' => url(route('frontend.donate-resources.store')),
                    ]) !!}
                    <div id="form_content">
                        @include('donations::frontend.donate-resources.components.form')
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn plus-btn theme-btn" onclick="addItem()">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn theme-btn" type="submit" id="submit">

                            <span>{{__('donations::frontend.donate_resources.btn.send_request')}}</span>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                  id="btn_spinner" style="display: none;    margin: 5px;"></span>
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-4 img-left">
                    <img class="img-fluid" src="{{asset('frontend/'.locale().'/images/bg-2.png')}}" alt=""/>
                </div>
            </div>
        </div>
    </div>
    <div id="form_ex" style="display: none">
        @include('donations::frontend.donate-resources.components.form',['sub_item' => true])
    </div>
@stop
@push('scripts')
    <script>
        function addItem() {
            var rand = Math.floor(Math.random() * 9000000000) + 1000000000;
            var html = replaceAll($('#form_ex').html(), ':rand', rand);
            $('#form_content').append(html);
        }

        // DELETE member BUTTON
        $("#form_content").on("click", ".trash-btn", function (e) {
            e.preventDefault();
            $(this).closest('.single_item').remove();
        });
    </script>
@endpush

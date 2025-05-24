@extends('apps::frontend.layouts.app')
@section('title', __('apps::frontend.index.title'))
@push('styles')
    <style>
        .form-row-wide {
            margin-bottom: 0px !important;
        }
    </style>
@endpush
@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    @if(!empty($categories) && count($categories))
                        {!! Form::open([
                            'method' => 'post',
                            'id' => 'filter_form',
                            'url' => url(route('frontend.projects.filter')),
                        ]) !!}
                        <div class="category-filter">
                            <h3>@lang("Sort by")</h3>

                            <div class="filter-block">
                                @foreach($categories as $category)
                                    @if(count($category['children']))
                                        <h4>{{$category['title']}}</h4>
                                        <ul>
                                            @foreach($category['children'] as $child)
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="{{$child['id']}}"
                                                               value="{{$child['id']}}"
                                                               name="category[{{$category['id']}}]"
                                                               class="custom-control-input">
                                                        <label class="custom-control-label"
                                                               for="{{$child['id']}}">{{$child['title']}}</label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif

                                @endforeach
                                <button class="btn theme-btn btn-block" type="submit">
                                    <span id="btn_title">@lang("Sort")</span>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                          id="btn_spinner" style="display: none"></span>
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    @endif
                </div>
                <div class="col-md-10">
                    <div class="projects-list projects-page">
                        <h2 class="main-title mb-30"> @lang("Show projects")</h2>

                        <div class="row project-data" id="project-data">
                        </div>
                        <div class="ajax-load" style="display: none">
                            <div class="loader" id="project_loader" style="font-size: 6px;">@lang("Loading")...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('projects::frontend.projects.components.guest-modal')
@stop
@push('scripts')

    @include('projects::frontend.projects.components.direct-donation-script')
    <script>

        var page = 1;
        var flag = parseInt('{{!empty($last_page) ? $last_page : 0}}');

        $(document).ready(function () {
            getProjects();
        });
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $("#project-data").offset().top + $("#project-data").height() && page < flag) {
                page++;
                getProjects();
            }
        });

        function getProjects() {
            $.ajax({
                url: '{{url(route('frontend.projects.index'))}}?page=' + page,
                type: "get",
                beforeSend: function () {
                    $('.ajax-load').show();
                },
                success: function (data) {
                    $("#project-data").append(data.html);
                    $('.ajax-load').hide();
                },
            });
        }

        // ADD FORM
        $('#filter_form').on('submit', function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            var content = $("#project-data");
            content.text('');
            $('.ajax-load').show();
            page = 1;

            $.ajax({

                url: url,
                type: method,
                dataType: 'JSON',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,

                beforeSend: function () {
                    $('#submit').prop('disabled', true);
                    spinnerToggle();
                },
                success: function (data) {

                    $('#submit').prop('disabled', false);
                    spinnerToggle();
                    $('.ajax-load').hide();
                    $("#project-data").append(data.html);
                },
                error: function (data) {
                    $('#submit').prop('disabled', false);
                    spinnerToggle();
                },
            });

        });
    </script>
@endpush


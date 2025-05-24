@extends('apps::frontend.layouts.app')
@section('title', __('donations::frontend.recurring_donations.title'))

@push('styles')
    <style>
        .remove-btn{
            padding: 4px 13px;
            border-radius: 4px;
        }
        .form-control{
            border-radius: 4px;
        }
        .hidden{
            display: none !important;
        }
    </style>
@endpush
@section('content')

    <div class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    @if(Request::route('project_slug'))
                        @if($project['id'] == 7)
                            <h2 class="title-page"> @lang('Daily Deduction (a quarter of a dinar)')</h2>
                        @else
                            <h2 class="title-page"> @lang('Recurring Donations Day')</h2>
                        @endif
                    @else
                        <h2 class="title-page">  @lang("Recurring Donations")</h2>
                    @endif



                    @include('apps::dashboard.layouts._ajax-msg')
                    {!! Form::open([
                        'method' => 'post',
                        'id' => 'donation_model_form',
                        "class"=>"form-contact login mt-30 donate-form",
                        'url' => route("frontend.recurring-donations.donait"),
                    ]) !!}
                        <div>

                            @if(Request::route('project_slug'))

                                {!! field('frontend')->text('project',$project['title'],strip_tags($project['description']),[
                                    'required' => true,
                                    'class' => 'form-control',
                                    'readonly' => Request::route('price') != null ? true :false,
                                    ]
                                ) !!}
                                <input type="hidden" name="project_id" value="{{$project['id']}}">

                            @else
                                {!! field('frontend')->select('project_id',__('Project'),$projects,[
                                'required' => true,
                                ]) !!}
                            @endif




                        </div>
                        <div class="{{$project['id'] == 7 ? 'hidden' : ''}}">
                            @php
                                $typesArr = [
                                    'weekly' => __("Weekly"),
                                    'monthly' => __("Monthly"),
                                ];
                                if($project['id'] != 7){
                                    $typesArr['undefined'] = __("undefined");
                                }else{
                                    $typesArr['daily'] = __("Daily");
                                }
                            @endphp
                            @if(Request::route('time_period'))
                                {!! field('frontend')->select('time_period',__('Time period'),[
                               'daily' => __("Daily"),

                           ],[
                               'required' => true,
                               'selected' => Request::route('time_period')
                           ]) !!}
                            @else
                                {!! field('frontend')->select('time_period',__('Time period'),$typesArr,[
                             'required' => true,
                         ]) !!}
                            @endif
                        </div>

                        <div>
                            {!! field('frontend')->date('end_at',__('Deduction expiration date'),null,[
                                'min' => Carbon\Carbon::now()->addDay()->toDateString(),
                            ]) !!}
                        </div>

                        @if($project['id'] == 7)
                            <div class="d-flex justify-content-end">
                                <button class="btn theme-btn continue-ordering-btn" type="submit" id="check-out" style="margin-top:0px;width: 100%;">
                            <span>
                                @lang("Donate know")
                            </span>
                                    <span class="spinner-border spinner-border-sm btn_spinner" role="status" aria-hidden="true"
                                          id="btn_spinner"
                                          style="display: none;    margin: 5px;"></span>
                                </button>
                            </div>
                        @endif

                        <div class="d-flex justify-content-end card-submit-donation {{$project['id'] == 7 ? '' : 'hidden'}}">
                            <button  class="btn theme-btn continue-ordering-btn donate-btn" type="button" id="disableEndAtBtn" style="margin-top:0;width: 100%">
                                <span>
                                    @if($project['id'] == 7)
                                        @lang("Undefined (Click Here)")
                                    @else
                                        @lang("undefined")
                                    @endif
                                </span>
                                <span class="spinner-border spinner-border-sm btn_spinner" role="status" aria-hidden="true"
                                      id="btn_spinner"
                                      style="display: none;    margin: 5px;"></span>
                            </button>
                        </div>

                    <br>

                        <div class="{{$project['id'] == 7 ? 'hidden' : ''}}">
                            {!! field('frontend')->number('amount',__('projects::frontend.projects.alerts.enter_donation_request'), Request::route('price') != null ? '0.250' : "",[
                                'required' => true,
                                'class' => 'amount form-control',
                                'step' => "0.01",
                                'id' => 'donation_model_form_amount' ,
                                'readonly' => Request::route('price') != null ? true :false

                                ]
                            ) !!}
                        </div>

                        @if(!Request::route('price'))


                        <div class="prices_content">
                            @inject('prices','Modules\Donations\Entities\DonationPrice')
                            @foreach($prices->active()->orderBy('sort','desc')->get() as $price)
                                <label class="label label-default price-label"
                                    onclick="selectPrice(this,'{{$price->price}}')">{{$price->price}}</label>
                            @endforeach
                        </div>
                        @endif

                        @if($project['id'] != 7)
                        <div class="d-flex justify-content-end">
                            <button class="btn theme-btn continue-ordering-btn" type="submit" id="check-out" style="margin-top:0px">
                            <span>
                                @lang("Donate know")
                            </span>
                                <span class="spinner-border spinner-border-sm btn_spinner" role="status" aria-hidden="true"
                                    id="btn_spinner"
                                    style="display: none;    margin: 5px;"></span>
                            </button>
                        </div>
                        @endif
                    {!! Form::close() !!}
                </div>



{{--            <div class="col-md-8">--}}
{{--                <table class="table">--}}
{{--                    <thead class="thead-dark">--}}
{{--                      <tr>--}}
{{--                        <th scope="col">#ID</th>--}}
{{--                        <th scope="col">@lang("Project")</th>--}}
{{--                        <th scope="col">@lang("Time period")</th>--}}
{{--                        <th scope="col">@lang("Amount (KWD)")</th>--}}
{{--                        <th scope="col">@lang("Retry Count")</th>--}}
{{--                        <th scope="col">@lang("Created at")</th>--}}
{{--                        <th scope="col">@lang("Stop at")</th>--}}
{{--                        <th scope="col">@lang("Remove")</th>--}}
{{--                      </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                        @forelse(auth()->user()->recurringDonations()->Paid()->get() as $donation)--}}
{{--                            <tr id="donation_{{$donation->id}}">--}}
{{--                                <th scope="row">{{$donation->RecurringId}}</th>--}}
{{--                                <td>--}}
{{--                                    <a href="{{$donation->project ? route('frontend.projects.show',optional($donation->project->translate(locale()))->slug) : '#'}}">--}}
{{--                                        {{optional(optional($donation->project)->translate(locale()))->title}}--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                                <td>@lang(ucfirst($donation->time_period))</td>--}}
{{--                                <td>{{number_format($donation->total,2)}}</td>--}}
{{--                                <td>{{$donation->retry_count}}</td>--}}
{{--                                <td>{{Carbon\Carbon::parse($donation->created_at)->format('M d Y g:i A')}}</td>--}}
{{--                                <td>{{$donation->end_at ? Carbon\Carbon::parse($donation->end_at)->format('M d Y g:i A') : __("Unlimited")}}</td>--}}
{{--                                <td>--}}
{{--                                    <a--}}
{{--                                        href="javascript:;"--}}
{{--                                        onclick="deleteRow('{{route('frontend.recurring-donations.delete', $donation->id)}}','donation_{{$donation->id}}')"--}}
{{--                                        class="remove-btn btn-danger"--}}
{{--                                    >--}}
{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                            <tr>--}}
{{--                                <th colspan="4">--}}
{{--                                    <div class="alert alert-danger text-center" role="alert">--}}
{{--                                        @lang("No data found")--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                            </tr>--}}
{{--                        @endforelse--}}

{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function () {
            // Disable end_at input field initially
            $('#end_at').prop('readonly', false);

            // Handle button click event
            $('#disableEndAtBtn').on('click', function () {
                // Disable end_at input field
                $('#end_at').prop('readonly', true);
                @if($project['id'] == 7)
                $('#check-out').trigger('click')
                @endif
            });

            $('[name="time_period"]').on('change',function (){
                if($(this).val() == 'undefined'){
                    $('#disableEndAtBtn').trigger('click')
                }
            })
        });
    </script>
    <script>


        function selectPrice(label,price) {
            $('.price-label').removeClass('label-success').addClass('label-default');
            $(label).removeClass('label-default').addClass('label-success');
            $(label).parent().parent().find('#donation_model_form_amount').val(price);
        }

        $('#donation_model_form').on('submit', function (e) {
            e.preventDefault();

            var btn = $("#check-out");
            var spinner = btn.find('.btn_spinner');
            var input = $("#donation_model_form_amount");
            var form = btn.closest('form');
            var method = form.attr('method');
            var helpBlock = input.parent().find('.help-block');
            var action = btn.attr('action');

            if(input.val() <= 0){

                $('#donation_model_form_amount').focus();

                return '';
            }else{
                $.ajax({
                    url: action,
                    type: method,
                    dataType: 'JSON',
                    data: form.serialize(),
                    cache: false,
                    processData: true,

                    beforeSend: function () {
                        btn.prop('disabled', true);
                        spinner.toggle();
                        resetErrors();
                    },
                    success: function (data) {
                        spinner.toggle();
                        btn.prop('disabled', false);
                        if (data[0] == true) {
                            redirect(data);
                            successfully(data);
                            resetForm();
                            resetErrors();
                        } else {
                            displayMissing(data);
                        }
                    },
                    error: function (data) {

                        btn.prop('disabled', false);
                        spinner.toggle();

                        var getJSON = $.parseJSON(data.responseText);
                        var output= "<div class='alert alert-danger'><ul>";
                        for (var error in getJSON.errors){
                            output += "<li>" + getJSON.errors[error] + "</li>";
                        }
                        output += "</ul></div>";

                        $('#result').slideDown('fast', function(){
                            $('#result').html(output);
                            $('.progress-info').hide();
                            $('.progress-bar').width('0%');
                        }).delay(5000).slideUp('slow');

                    },
                });
            }
        });
    </script>
@endpush

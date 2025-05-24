@extends('apps::frontend.layouts.app')
@section('title', __('projects::frontend.projects.index.title'))
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
            <div class="row project-page">
                <div class="col-lg-6 col-md-12">
                    <img class="img-fluid" style="width: 100%;" src="{{$model['image']}}" alt=""/>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="project-content">
                        <div class="project-title">
                            <h3 href="index.php?page=project">{{$model['title']}}</h3>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar"
                                 style="width: {{$model['percent']}}%"
                                 aria-valuenow="50"
                                 aria-valuemin="0"
                                 aria-valuemax="100"
                            >
                                <span style="{{$model['percent'] > 0 ? 'left:0px':''}}">{{$model['total_donation']}} {{__('projects::frontend.projects.card.kwd')}}</span>
                            </div>
                            <span class="total-amount">{{$model['amount_to_collect']}} {{__('projects::frontend.projects.card.kwd')}}</span>
                        </div>

                        @if($model['type'] == 'project')
                        {!! Form::open([
                            'method' => 'post',
                            "class"=>"project-form align-items-center donate-form",
                            'url' => url(route('frontend.donation.direct.donate', $model['id'])),
                        ]) !!}

                        @inject('prices','Modules\Donations\Entities\DonationPrice')
                        <div class="prices_content">
                            @foreach($prices->active()->orderBy('sort','desc')->get() as $price)
                                <label class="label label-default price-label" onclick="selectPrice(this,'{{$price->price}}')">{{$price->price}}</label>
                            @endforeach
                        </div>
                        {!! field('frontend_no_label')->text('amount',__('projects::frontend.projects.alerts.enter_donation_request'),null,[
                            'required' => true,
                            'class' => 'amount form-control',
                            'id' => 'normal_amount'
                        ]) !!}
                        <div class="card-submit-donation">
                            <button type="button" onclick="submitForm(this)" style="" class="btn theme-btn donate-btn submit"
                                    action="donate">
                                {{__('projects::frontend.projects.btn.big_donate')}}
                                <span class="spinner-border spinner-border-sm btn_spinner" role="status" aria-hidden="true"
                                      style="display: none; "></span>
                            </button>
                            <button type="button" onclick="submitForm(this)" style=""
                                    class="btn theme-btn add-to-cart submit" action="add_to_cart"
                                    url="{{url(route('frontend.cart.add', $model['id']))}}">
                                {{__('projects::frontend.projects.btn.add_to_cart')}}
        
                                <span class="spinner-border spinner-border-sm btn_spinner" role="status" aria-hidden="true"
                                      style="display: none;"></span>
                            </button>
                        </div>
                        {!! Form::close() !!}

                        @else
                            <a href="{{$model['link']}}" class="btn theme-btn donate-btn" style="    width: 100%;">
                                {{__('projects::frontend.projects.btn.big_donate')}}
                                <span class="spinner-border spinner-border-sm btn_spinner" role="status" aria-hidden="true"
                                      style="display: none; "></span>
                            </a>
                        @endif
                        <p class="project-desc">
                            {!! $model['description'] !!}
                        </p>
                        <div class="project-option">
                            @if(count($model['categories']))
                                @foreach($model['categories'] as $cat)
                                    <span class="btn theme-btn3">
                                        {!! $cat['title'] !!}
                                    </span>
                                @endforeach
                            @endif
                            <span class="btn theme-btn">{!! $model['country'] !!}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if(!empty($projects)&&count($projects))
                <section class="related-section">
                    <h2 class="main-title mb-30"> @lang("Related projects")</h2>
                    <div class="row projects-list">
                        @include('projects::frontend.projects.components.data',compact('projects'))
                    </div>
                </section>
            @endif
        </div>
    </div>
    @include('projects::frontend.projects.components.guest-modal')
@stop

@push('scripts')
    @include('projects::frontend.projects.components.direct-donation-script')
    <script>
        function selectPrice(label,price) {
            $('.price-label').removeClass('label-success').addClass('label-default');
            $(label).removeClass('label-default').addClass('label-success');
            $('#normal_amount').val(price);
        }
    </script>
@endpush
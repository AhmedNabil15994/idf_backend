@extends('apps::frontend.layouts.app')
@section('title', __('apps::frontend.home._header.home'))
@push('styles')
    <style>
        .form-row-wide {
            margin-bottom: 0px !important;
        }

      @if(app()->getLocale() == "en")
       @media only screen and (max-width: 600px){
          .tomediaquery{
              position: relative;
              left: 125px;

          }
      }
      @endif

          @media only screen and (max-width: 600px){
          a#towidth{
             width: auto;

          }
      }

    </style>
@endpush
@section('content')

    @if(!empty($sliders) && count($sliders))
        <div class="home-slider-container">
            <div class="owl-carousel home-slides">

                @foreach($sliders as $slider)
                    <div class="item">
                        <img src="{{$slider['image']}}" alt=""/>
                        <div class="slide-description">
                            <div class="container tomediaquery">
                                <h2> {{$slider['title']}}</h2>
                                <p>
                                    {!! $slider['description'] !!}
                                </p>
                                {!! Form::open([
                                    'method' => 'post',
                                    "class"=>"project-form align-items-center donate-form",
                                    'url' => url(route('frontend.donation.direct.donate', null)),
                                ]) !!}
                                    <input type="hidden" name="amount" class="amount">


                                <div class="card-submit-donation">
                                    <button type="button" onclick="submitForm(this)" style="" class="btn theme-btn submit"
                                            action="donate">
                                            @lang("Donate know")
                                            <span class="spinner-border spinner-border-sm btn_spinner" role="status" aria-hidden="true"
                                            style="display: none; "></span>
                                    </button>

                                </div>
                                {!! Form::close() !!}
                                <div class="card-submit-donation">
                                    <a href="{{route("frontend.recurring-donations.index")}}" class="btn theme-btn donate-btn submit">
                                        @lang("Recurring Monthly")
                                    </a>
                                </div>


                               @if($project['slug'])
                                    <div class="card-submit-donation ">
                                        <a id="towidth"
                                            style="height: auto;" href="{{route("frontend.recurring-donations.index" , ['project_slug' => $project['slug'] , 'time_period' => 'daily' , 'price' => '25'])}}" class="btn theme-btn donate-btn submit">
                                            {{__('apps::frontend.home._header.Calamity payment')}}
                                            <br>
                                        </a>
                                    </div>
                               @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    @if(!empty($homeCards) && count($homeCards))
        <section class="section">
            <div class="container text-center">
                <div class="row">

                    @foreach($homeCards as $card)
                        <div class="col-lg-4">
                            <a href="{{$card['link']}}">
                                <div class="home_card" style="background-color: {{$card['color']}}">
                                    <h3>{{$card['title']}}</h3>
                                    <p>{{$card['sub_title']}}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    <section class="section">
        <div class="container text-center">
            <h2 class="main-title mb-30">{{isset($about_us_page['title'])?$about_us_page['title']:''}}</h2>
            <p class="content">
                {!! isset($about_us_page['description']) ? $about_us_page['description']: '' !!}
            </p>
            <a Class="btn theme-btn2"
               href="{{url(route('front.pages.show',isset($about_us_page['slug']) ? $about_us_page['slug']: ''))}}">
                @lang("Show More")
            </a>
        </div>
    </section>

    @if(!empty($projects) && count($projects))
        <section id="projects" class="section gey-sec">
            <div class="container">
                <h2 class="main-title mb-50 text-center">  @lang("Contribute to the good") </h2>
                <div class="row">
                    @include('projects::frontend.projects.components.data',compact('projects'))
                </div>
                <div class="text-center">
                    <a class="seemore btn" href="{{url(route('frontend.projects.index'))}}">@lang("All charitable projects")</a>
                </div>
            </div>
        </section>
    @endif

    @if(!empty($statistics) && count($statistics))
        <section class="section facts">
            <div class="container">
                <div class="facts-list d-flex align-items-center justify-content-between text-center">
                    @foreach($statistics as $item)
                        <div class="fact">
                            <h4> {{$item['title']}}</h4>
                            <span class='numscroller' data-slno='1' data-min='0' data-max='{{$item['value']}}'
                                  data-delay='5'
                                  data-increment="10">{{$item['value']}}</span>
                            <p>{{$item['sub_title']}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if(!empty($partners) && count($partners))
        <section class="section">
            <div class="container">
                <h2 class="main-title mb-50 text-center"> @lang("Success Partners")</h2>
                <div class="list-partners owl-carousel">
                    @foreach($partners as $partner)
                        <div class="item">
                            <a class="d-block" href="#"><img
                                        src="{{$partner['image']}}"
                                        alt=""/></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('projects::frontend.projects.components.guest-modal')
@stop

@push('scripts')
    <script>
        @if(session()->get('success'))
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '{{session('success')}}',
            showConfirmButton: false,
            timer: 1500
        });
        @elseif(session()->get('error'))
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: '{{session('error')}}',
            showConfirmButton: true,
        });
        @endif
    </script>
    @include('projects::frontend.projects.components.direct-donation-script')
@endpush

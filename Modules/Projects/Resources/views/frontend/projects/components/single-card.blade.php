<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="project-block">
        <a class="flex-1"
           href="{{url(route('frontend.projects.show',$project['slug']))}}">
            <div class="img-block">
                <img class="img-fluid"
                     src="{{$project['image']}}"
                     alt=""/>
            </div>
        </a>
        <div class="project-content">
            <div class="project-title d-flex align-items-center">
                <a class="flex-1"
                   href="{{url(route('frontend.projects.show',$project['slug']))}}">{{$project['title']}}
                    <span class="country"><i class="lnr lnr-map-marker"></i>  {{$project['country']}} </span>
                </a>
            </div>
            <div class="progress">
                <div class="progress-bar" role="progressbar"
                     style="width: {{$project['percent']}}%"
                     aria-valuenow="50"
                     aria-valuemin="0" aria-valuemax="100">
                    <span
                            style="{{$project['percent'] > 0 ? 'left:0px;right: 0px;':''}}">
                                                {{__('projects::frontend.projects.card.kwd')}}
                        {{$project['total_donation']}}
                                             </span>
                </div>
                <span class="total-amount">
                                            {{__('projects::frontend.projects.card.kwd')}}
                    {{$project['amount_to_collect']}}
                                        </span>
            </div>
            @if($project['type'] == 'project')
                {!! Form::open([
                               'method' => 'post',
                               "class"=>"project-form align-items-center donate-form",
                               'url' => url(route('frontend.donation.direct.donate', $project['id'])),
                           ]) !!}
                {!! field('frontend_no_label')->text('amount',__('projects::frontend.projects.alerts.enter_donation_request'),null,[
                'required' => true,
                'class' => 'amount form-control'
                ]) !!}
                <br>
                <div class="prices_content">
                    @foreach($prices->active()->orderBy('sort','desc')->get() as $price)
                        <label class="label label-default price-label"
                               onclick="selectPrice(this,'{{$price->price}}')">{{$price->price}}</label>
                    @endforeach
                </div>
                <div class="card-submit-donation">
                    <button type="button" onclick="submitForm(this)" style="" class="btn theme-btn donate-btn submit"
                            action="donate">
                        {{__('projects::frontend.projects.btn.big_donate')}}
                        <span class="spinner-border spinner-border-sm btn_spinner" role="status" aria-hidden="true"
                              style="display: none; "></span>
                    </button>
                    <button type="button" onclick="submitForm(this)" style=""
                            class="btn theme-btn add-to-cart submit" action="add_to_cart"
                            url="{{url(route('frontend.cart.add', $project['id']))}}">
                        {{__('projects::frontend.projects.btn.add_to_cart')}}

                        <span class="spinner-border spinner-border-sm btn_spinner" role="status" aria-hidden="true"
                              style="display: none;"></span>
                    </button>
                </div>
                {!! Form::close() !!}
            @else
                <a href="{{$project['link']}}" class="btn theme-btn donate-btn" style="    width: 100%;">
                    {{__('projects::frontend.projects.btn.big_donate')}}
                    <span class="spinner-border spinner-border-sm btn_spinner" role="status" aria-hidden="true"
                          style="display: none; "></span>
                </a>
            @endif
        </div>
    </div>
</div>

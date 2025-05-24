<style>
    .prices_content {
        position: relative;
        margin: 0 auto;
        padding: 0px;
        right: 23px;
    }

    .price-label {
        display: inline-block;
        margin: 5px;
        padding: 5px 10px;
        background-color: #ccc;
        cursor: pointer;
    }

    @media (max-width: 300px) {
        .price-label {
            display: block;
            margin: 10px auto;
        }
    }
</style>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="gust_donation_model"
     id="gust_donation_model"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:none">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open([
                'method' => 'post',
                'id' => 'donation_model_form',
                "class"=>"form-contact login mt-30 donate-form",
                'url' => '',
            ]) !!}
            <div class="modal-body">
                <div id="donation_model_form_amount_contan" style="display:none">

                    {!! field('frontend_modal')->number('amount',__('projects::frontend.projects.alerts.enter_donation_request'),null,[
                        'required' => true,
                        'class' => 'amount form-control',
                        'id' => 'donation_model_form_amount'
                        ]) !!}
                </div>

                <div class="prices_content" >

                    @inject('prices','Modules\Donations\Entities\DonationPrice')
                    @foreach($prices->active()->orderBy('sort','desc')->get() as $price)
                        <label class="label label-default price-label"
                               onclick="selectPriceModel(this,'{{$price->price}}')">{{$price->price}}</label>
                    @endforeach
                </div>
<br>
<br>
                <div class="form-group">

                    <div class="col-md-12">
                        <div class="md-radio-inline">
                            <label class="mt-radio">
                                <input type="radio" name="donor_type" id="quick_donation" value="quick_donation"
                                       checked="checked">
                            <span class="checkmark"></span>
                           <span class="title">{{__('projects::frontend.projects.form.quick_donation')}}</span>
                            </label>
                            <label class="mt-radio">
                                <input type="radio" name="donor_type" id="helpful" value="helpful">
                            <span class="checkmark"></span>
                           <span class="title">{{__('projects::frontend.projects.form.helpful')}}</span>
                            </label>
                        </div>
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="col-md-10 hide-inputs" id="helpful_scope" style="display: none"></div>
                <div class="col-md-12 hide-inputs" id="quick_donation_scope">

                    {!! field('frontend_modal')->text('register_name',__('authentication::frontend.register.form.name'), $donorCheck ? auth()->user()->name : null) !!}

                    {!! field('frontend_modal')->number('register_phone',__('authentication::frontend.register.form.phone'), $donorCheck ? auth()->user()->mobile : null) !!}

                    @if(!$donorCheck)
                        <label class="mt-radio">
                            <input type="radio" onclick="toggleAllRegisterFields(this)">
                            <span class="checkmark"></span>
                           <span class="title">{{__('projects::frontend.projects.form.register_model')}}</span>
                        </label>
                        <div id="all_register_fields" style="display: none;">
                            <br>
                            {!! field('frontend_modal')->password('register_password',__('authentication::frontend.register.form.password'),['autocomplete' => 'chrome-off']) !!}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-submit-donation">
                <div class="modal-footer" style="border-top:none">
                    <button type="button"  onclick="submitForm(this)" style="width: 100%; !important;" action="register-donate"
                            class="btn theme-btn donate-btn submit">
                        {{__('projects::frontend.projects.btn.big_donate')}}
                        <span class="spinner-border spinner-border-sm btn_spinner" role="status" aria-hidden="true"
                              style="display: none; "></span>
                    </button>

                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@push('scripts')

    <script>

        function selectPriceModel(label,price) {
            $('.price-label').removeClass('label-success').addClass('label-default');
            $(label).removeClass('label-default').addClass('label-success');
            $(label).parent().parent().find('#donation_model_form_amount').val(price);
        }
    </script>
@endpush

@extends('apps::frontend.layouts.app')
@section('title', __('donations::frontend.donate_resources.title'))

@section('content')

    <div class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title-page">  @lang("Cart")</h2>
                </div>
            </div>
            @if($cart_count > 0)
                <div class="row">
                    @foreach($items as $rowId => $item)
                        <div class="col-md-12 img-right item-container">
                            <button class="trash-btn theme-btn cart-trash-btn"
                                    onclick="removeCartItem(this,'{{$rowId}}','{{$item['price']}}')">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            <img class="img-fluid item-image" src="{{$item['project']['image']}}"
                                 alt=""/>
                            <div class="cart-item-titles">
                            <span>
                                {{$item['project']['title']}}
                            </span>
                                <br>
                                <span class="cart-item-sm-title">
                               {{__('order::frontend.cart.amount')}} {{$item['price']}}
                            </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-end cart-total-price">
                <span>
                       {{__('order::frontend.cart.total_kwd')}} <span id="total">{{$total}}</span>
                </span>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn theme-btn continue-ordering-btn" type="button" id="check-out" action="donate"
                            onclick="checkOut(this)">
                    <span>
                        {{__('order::frontend.cart.send_order')}}
                    </span>
                        <span class="spinner-border spinner-border-sm btn_spinner" role="status" aria-hidden="true"
                              id="btn_spinner"
                              style="display: none;    margin: 5px;"></span>
                    </button>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12" style="text-align: center;">
                        <img src="{{asset('frontend/images/emptycart.png')}}" class="empty-cat-img">
                    </div>
                </div>
            @endif
        </div>
    </div>
    @include('projects::frontend.projects.components.guest-modal')
@stop

@push('scripts')
    <script>
        function removeCartItem(btn, rowId) {
            var url = '{{url(route('frontend.cart.remove.item',':id'))}}';
            url = url.replace(':id', rowId);
            $(btn).parent().remove();

            $.ajax({

                url: url,
                type: 'POST',
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                cache: false,
                processData: false,

                success: function (data) {
                    $('#total').text('').append(data['total']);

                    if (data['cart_count'] > 0) {
                        $('#cart_counter').text('').append(data['cart_count']).show();
                    } else {

                        $('#cart_counter').text('').append(data['cart_count']).hide();
                    }
                    if (data['is_final']) {

                    }
                },
            });
        }

        $('.donate-form').on('submit', function (e) {
            e.preventDefault();
            var btn = $(document.activeElement);
            checkOut(btn , this)
        });

        function checkOut(btn , form = null) {
            var url = '{{url(route('frontend.cart.checkout'))}}';
            var spinner = $(btn).find('.btn_spinner');
            var action = $(btn).attr('action');

            if (typeof action !== 'undefined' && action !== false) {
                switch (action) {
                    case 'donate' :
                        $('#gust_donation_model').modal('show');
                        $('#donation_model_form').attr('action', url);
                        $('#donation_model_form_amount').val('{{$total}}');
                        break;
                    case 'register-donate' :

                        $.ajax({

                            url: url,
                            type: 'POST',
                            dataType: 'JSON',
                            data: new FormData(form),
                            contentType: false,
                            cache: false,
                            processData: false,

                            beforeSend: function () {
                                $(btn).prop('disabled', true);
                                spinner.toggle();
                                resetErrors();
                            },
                            success: function (data) {
                                spinner.toggle();
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
                                $(btn).prop('disabled', false);
                                spinner.toggle();
                                displayErrors(data)
                            },
                        });
                        break;
                }
            }
        }


        $('input[name=donor_type]').change(function () {
            $('.hide-inputs').hide();
            $('#' + this.value + '_scope').show();
        })

        function toggleAllRegisterFields() {
            $('#all_register_fields').toggle();
        }
    </script>
    @include('projects::frontend.projects.components.direct-donation-script')
@endpush

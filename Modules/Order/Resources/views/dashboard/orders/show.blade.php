@extends('apps::dashboard.layouts.app')
@section('title', __('order::dashboard.orders.show.title'))
@section('content')
    <style type="text/css" media="print">
        @page {
            size: auto;
            margin: 0;
        }

        @media print {
            a[href]:after {
                content: none !important;
            }

            .contentPrint {
                width: 100%;
                /* font-family: tahoma; */
                font-size: 16px;
            }

            .invoice-body td.notbold {
                padding: 2px;
            }

            h2.invoice-title.uppercase {
                margin-top: 0px;
            }

            .invoice-content-2 {
                background-color: #fff;
                padding: 5px 20px;
            }

            .invoice-content-2 .invoice-cust-add, .invoice-content-2 .invoice-head {
                margin-bottom: 0px;
            }

            .no-print, .no-print * {
                display: none !important;
            }

        }
    </style>

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('dashboard.home')) }}">{{ __('apps::dashboard.index.title') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ url(route('dashboard.orders.index')) }}">
                            {{__('order::dashboard.orders.routes.index')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('order::dashboard.orders.show.title')}}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                <div class="col-md-12">
                    <div class="no-print">
                        <div class="col-md-3">
                            <ul class="ver-inline-menu tabbable margin-bottom-10">

                                <li class="active">
                                    <a data-toggle="tab" href="#family_data">
                                        <i class="fa fa-cog"></i> {{__('order::dashboard.orders.show.family_data')}}
                                    </a>
                                    <span class="after"></span>
                                </li>

                                @can('edit_orders')
                                    <li>
                                        <a data-toggle="tab" href="#order_details">
                                            <i class="fa fa-cog"></i> {{__('order::dashboard.orders.show.order')}}
                                        </a>
                                        <span class="after"></span>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 contentPrint">
                        <div class="tab-content">

                            <div class="tab-pane active" id="family_data">
                                <div class="invoice-content-2 bordered">
                                    <div class="row invoice-head">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="invoice-logo">
                                                <center>
                                                    <span
                                                            style="background-color: {{ $order->status == 'pending'? '#F1C40F' : '#36c6d3' }}; color: #000000; border-radius: 25px; padding: 2px 14px; float: left;">
                                                        @if ($order->status == 'pending')
                                                            {{__('order::dashboard.orders.datatable.status_name.pending')}}
                                                        @else
                                                            {{__('order::dashboard.orders.datatable.status_name.delivered')}}
                                                        @endif
                                                    </span>
                                                </center>
                                            </div>
                                        </div>

                                        @if($order->family)
                                            <div class="col-md-3 col-xs-6">
                                                    <span class="bold uppercase">
                                                        {{__('order::dashboard.orders.show.family.family_info')}}
                                                    </span>
                                                <br/>
                                                @if($order->family->head_info)
                                                    <span class="bold">{{__('order::dashboard.orders.show.family.head_name')}} : </span>
                                                    {{ $order->family->head_info->name }}
                                                    <br/>
                                                    <span class="bold">{{__('order::dashboard.orders.show.family.mobile')}} : </span>
                                                    {{ $order->family->head_info->mobile }}
                                                    <br/>
                                                    <span class="bold">{{__('order::dashboard.orders.show.family.members_count')}} : </span>
                                                    {{ $order->family->members_count }}
                                                    <br/>
                                                @endif
                                            </div>
                                        @endif


                                        @if($order->family->address)

                                            <div class="col-md-3 col-xs-6">
                                                @if($order->family->address->governorate)
                                                    <span class="bold">{{__('order::dashboard.orders.show.address.governorate')}} : </span>
                                                    {{ $order->family->address->governorate->translate(locale())->title }}
                                                    <br/>
                                                @endif

                                                @if($order->family->address->city)
                                                    <span class="bold">{{__('order::dashboard.orders.show.address.city')}} : </span>
                                                    {{ $order->family->address->city->translate(locale())->title }}
                                                    <br/>
                                                @endif

                                                @if($order->family->address->region)
                                                    <span class="bold">{{__('order::dashboard.orders.show.address.region')}} : </span>
                                                    {{ $order->family->address->region }}
                                                    <br/>
                                                @endif

                                                @if($order->family->address->street)
                                                    <span class="bold">{{__('order::dashboard.orders.show.address.street')}} : </span>
                                                    {{ $order->family->address->street }}
                                                    <br/>
                                                @endif

                                                @if($order->family->address->building_number)
                                                    <span class="bold">{{__('order::dashboard.orders.show.address.building_number')}} : </span>
                                                    {{ $order->family->address->building_number }}
                                                    <br/>
                                                @endif

                                                @if($order->family->address->floor_number)
                                                    <span class="bold">{{__('order::dashboard.orders.show.address.floor_number')}} : </span>
                                                    {{ $order->family->address->floor_number }}
                                                    <br/>
                                                @endif

                                                @if($order->family->address->apartment)
                                                    <span class="bold">{{__('order::dashboard.orders.show.address.apartment')}} : </span>
                                                    {{ $order->family->address->apartment }}
                                                    <br/>
                                                @endif

                                                @if($order->family->address->gada_number)
                                                    <span class="bold">{{__('order::dashboard.orders.show.address.gada_number')}} : </span>
                                                    {{ $order->family->address->gada_number }}
                                                    <br/>
                                                @endif

                                                @if($order->family->address->ale_number)
                                                    <span class="bold">{{__('order::dashboard.orders.show.address.ale_number')}} : </span>
                                                    {{ $order->family->address->ale_number }}
                                                    <br/>
                                                @endif
                                            </div>
                                        @endif

                                        @if($order->family && $order->family->charity)
                                            <div class="col-md-3 col-xs-6">

                                                <span class="bold uppercase">
                                                  {{ $order->family->charity->translate(locale())->title }}
                                                </span>

                                                <br/>
                                                <span class="bold">{{__('order::dashboard.orders.show.charity.mobile')}} : </span>
                                                {{ $order->family->charity->phone }}
                                                <br/>
                                                <span class="bold">{{__('order::dashboard.orders.show.charity.address')}} : </span>
                                                {{ $order->family->charity->address }}

                                            </div>
                                        @endif

                                        <div class="col-md-3 col-xs-6">
                                            <div class="company-address">
                                                <h6 class="uppercase">#{{ $order['id'] }}</h6>
                                                <h6 class="uppercase">{{date('Y-m-d / H:i:s' , strtotime($order->created_at))}}</h6>
                                                <span class="bold">
                                                  {{__('order::dashboard.orders.show.volunteer')}} :
                                                </span>
                                                {{ $order->volunteer->username ?? '---' }}
                                                <br/>
                                                <span class="bold">
                                                  {{__('order::dashboard.orders.show.period')}} :
                                                </span>
                                                {{ $order->period . ' ' .__('order::dashboard.orders.datatable.days')}}
                                                <br/>
                                                <br/>
                                            </div>
                                        </div>
                                        <div class="row invoice-body">
                                            <div class="col-xs-12 table-responsive">
                                                <br>
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="invoice-title uppercase text-center">
                                                            {{__('order::dashboard.orders.show.basket.title')}}
                                                        </th>
                                                        <th class="invoice-title uppercase text-center">
                                                            {{__('order::dashboard.orders.show.basket.qty')}}
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($order->baskets as $basket)

                                                        <tr>
                                                            <td class="notbold text-center">
                                                                <a href="{{ route('dashboard.baskets.edit', $basket->id) }}">
                                                                    {{ $basket->translate(locale())->title }}
                                                                </a>
                                                            </td>
                                                            <td class="text-center notbold"> {{ $basket->pivot->quantity }} </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center bold">
                                                            {{__('order::dashboard.orders.show.total')}}
                                                        </th>
                                                        <th class="text-center bold"></th>
                                                        <th class="text-center bold"> {{ $order->baskets->sum('food_basket_order.quantity') }}</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <span class="h4">{{__('order::dashboard.orders.show.volunteer_note')}} : </span>
                                            {!! $order->volunteer_note ? $order->volunteer_note : '---' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @can('edit_orders')
                                <div class="tab-pane" id="order_details">
                                    <div class="no-print">
                                        <div class="row">

                                            <div class="col-md-12">

                                                {!! Form::model($order,[
                                                     'url'=> route('dashboard.orders.update',$order->id),
                                                     'id'=>'updateForm',
                                                     'role'=>'form',
                                                     'page'=>'form',
                                                     'class'=>'form-horizontal form-row-seperated',
                                                     'method'=>'PUT',
                                                     'files' => true
                                                     ])!!}

                                                @inject('volunteers','Modules\Volunteers\Entities\Volunteer')

                                                {!! field()->select('status' , __('order::dashboard.orders.form.status') ,[
                                                    'pending' => __('order::dashboard.orders.form.pending'),
                                                    'delivered' => __('order::dashboard.orders.form.delivered'),
                                                ]) !!}
                                                {!! field()->select('volunteer_id' , __('order::dashboard.orders.form.volunteer') ,
                                                $volunteers->active()->get()->pluck('user.name','id')->toArray()) !!}

                                                {!! field()->number('period' , __('order::dashboard.orders.form.period')) !!}
                                                {!! field()->textarea('volunteer_note' , __('order::dashboard.orders.form.volunteer_note')) !!}

                                                @if ($order->trashed())
                                                    {!! field()->checkBox('trash_restore', __('order::dashboard.orders.form.restore')) !!}
                                                @endif

                                                <div class="col-md-12">
                                                    <div class="form-actions">
                                                        @include('apps::dashboard.layouts._ajax-msg')
                                                        <div class="form-group">
                                                            <button type="submit" id="submit" class="btn btn-lg green">
                                                                {{__('apps::dashboard.buttons.edit')}}
                                                            </button>
                                                            <a href="{{url(route('dashboard.orders.index')) }}"
                                                               class="btn btn-lg red">
                                                                {{__('apps::dashboard.buttons.back')}}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                {!! Form::close()!!}

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endcan

                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">
                            {{__('apps::dashboard.buttons.print')}}
                            <i class="fa fa-print"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop

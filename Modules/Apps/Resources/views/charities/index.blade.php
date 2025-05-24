@extends('apps::charities.layouts.app')
@section('title', __('apps::charities.index.title'))
@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('charities.home')) }}">
                            {{ __('apps::charities.index.title') }}
                        </a>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> {{ __('apps::charities.index.welcome') }} ,
                <small><b style="color:red">{{ Auth::user()->name }} </b></small>
            </h1>


            {{-- DATATABLE FILTER --}}
            <div class="portlet light bordered">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-bubbles font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">
                                {{__('apps::charities.datatable.form.date_range')}}
                            </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="filter_data_table">
                        <div class="panel-body">
                            <form class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <div id="reportrange" class="btn default form-control">
                                                    <i class="fa fa-calendar"></i> &nbsp;
                                                    <span> </span>
                                                    <b class="fa fa-angle-down"></b>
                                                    <input type="hidden" name="from">
                                                    <input type="hidden" name="to">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions col-md-3">

                                            <button class="btn btn-sm green btn-outline filter-submit margin-bottom"
                                                    type="submit">
                                                <i class="fa fa-search"></i>
                                                {{__('apps::charities.datatable.search')}}
                                            </button>
                                            <a class="btn btn-sm red btn-outline filter-cancel"
                                               href="{{url(route('charities.home'))}}">
                                                <i class="fa fa-times"></i>
                                                {{__('apps::charities.datatable.reset')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- END DATATABLE FILTER --}}

            <div class="row">
                <div class="portlet light bordered col-lg-12">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 blue"
                           href="{{url(route('charities.families.index'))}}">

                            <div class="visual">
                                <i class="fa fa-child"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="{{$countFamilies}}">0</span>
                                </div>
                                <div class="desc">{{ __('apps::charities.index.statistics.families') }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 orange"
                           href="{{url(route('charities.volunteers.index'))}}">

                            <div class="visual">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="{{$countVolunteers}}">0</span>
                                </div>
                                <div class="desc">{{ __('apps::charities.index.statistics.volunteers') }}</div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="portlet light bordered col-lg-12">
                    <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-bubbles font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">
                                {{__('apps::charities.index.statistics.titles.orders')}}
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <a class="dashboard-stat dashboard-stat-v2 label-warning"
                           href="{{url(route('charities.orders.index'))}}" style="color: white">

                            <div class="visual">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="{{$countPendingOrders}}">0</span>
                                </div>
                                <div class="desc">{{ __('apps::charities.index.statistics.pending_orders') }}</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4">
                        <a class="dashboard-stat dashboard-stat-v2 green-dark"
                           href="{{url(route('charities.orders.index'))}}" style="color: white">

                            <div class="visual">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="{{$countDeliveredOrders}}">0</span>
                                </div>
                                <div class="desc">{{ __('apps::charities.index.statistics.delivered_orders') }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a class="dashboard-stat dashboard-stat-v2 label-primary"
                           href="{{url(route('charities.orders.index'))}}" style="color: white">

                            <div class="visual">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="{{$countTotalOrders}}">0</span>
                                </div>
                                <div class="desc">{{ __('apps::charities.index.statistics.total_orders') }}</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

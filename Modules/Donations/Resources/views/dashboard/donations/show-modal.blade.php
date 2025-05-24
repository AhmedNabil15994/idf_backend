@php
    $record = (object)$record;
@endphp
<a class="btn btn-sm green" title="Edit" style="padding: 4px 5px;" data-toggle="modal"
   data-target="#show-donation-{{$record->id}}">
    <i class="fa fa-eye"></i>
</a>

<div id="show-donation-{{$record->id}}" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">{{__('donations::dashboard.donations.modal.show_donation')}}</h4>
            </div>
            <div class="modal-body " style="padding-bottom: 0px;">
                <div class="row">
                    <div class="col-md-12 col-sm-12">

                        <div class="portlet green-meadow box">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs"></i>
                                    {{__('donations::dashboard.donations.modal.donation_data')}}
                                </div>
                            </div>
                            <div class="portlet-body" style="    padding: 27px 12px 27px;">
                                <div class="row static-info">
                                    <div class="col-md-5 name"> {{__('donations::dashboard.donations.modal.donation')}}
                                        #:
                                    </div>
                                    <div class="col-md-7 value">
                                        {{$record->id}}
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> {{__('donations::dashboard.donations.modal.created_at')}}
                                        :
                                    </div>
                                    <div class="col-md-7 value">{{$record->created_at}}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> {{__('donations::dashboard.donations.modal.status')}}:
                                    </div>
                                    <div class="col-md-7 value">
                                        {!!$record->status!!}
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> {{__('donations::dashboard.donations.modal.total')}}:
                                    </div>
                                    <div class="col-md-7 value"> {{$record->total}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="portlet blue-hoki box">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs"></i>
                                    {{__('donations::dashboard.donations.modal.donor_info')}}
                                </div>
                            </div>
                            <div class="portlet-body" style="    padding: 27px 12px 27px;">
                                <div class="row static-info">
                                    <div class="col-md-5 name"> {{__('donations::dashboard.donations.modal.status')}}
                                        :
                                    </div>
                                    <div class="col-md-7 value">
                                        @if (optional($record->donor)->status == 1)
                                            <span class="badge badge-success"> {{__('apps::dashboard.datatable.active')}} </span>
                                        @else
                                            <span class="badge badge-danger"> {{__('apps::dashboard.datatable.unactive')}} </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> {{__('donations::dashboard.donations.modal.name')}}
                                        :
                                    </div>
                                    <div class="col-md-7 value"> {{$record->name}}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> {{__('donations::dashboard.donations.modal.email')}}
                                        :
                                    </div>
                                    <div class="col-md-7 value"> {{$record->email}}</div>
                                </div>

                                <div class="row static-info">
                                    <div class="col-md-5 name"> {{__('donations::dashboard.donations.modal.phone')}}
                                        :
                                    </div>
                                    <div class="col-md-7 value"> {{$record->mobile}}</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="portlet grey-cascade box">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs"></i>
                                    {{__('donations::dashboard.donations.modal.projects')}}
                                </div>
                            </div>
                            {!! $record->projects !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 0px;">
                <button type="button" class="btn grey-salsa btn-outline"
                        data-dismiss="modal">{{__('apps::dashboard.buttons.cancel')}}</button>
            </div>
        </div>
    </div>
</div>
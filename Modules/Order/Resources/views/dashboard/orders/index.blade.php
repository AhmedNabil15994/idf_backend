@extends('apps::dashboard.layouts.app')
@section('title', __('order::dashboard.orders.routes.index'))

@inject('volunteers','Modules\Volunteers\Entities\Volunteer')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('dashboard.home')) }}">{{ __('apps::dashboard.index.title') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('order::dashboard.orders.routes.index')}}</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        @can('add_orders')
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a href="{{ url(route('dashboard.orders.create')) }}"
                                               class="btn sbold green">
                                                <i class="fa fa-plus"></i> {{__('apps::dashboard.buttons.add_new')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan


                        {{-- DATATABLE FILTER --}}
                        <div class="row">
                            <div class="portlet box grey-cascade">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>
                                        {{__('apps::dashboard.datatable.search')}}
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="filter_data_table">
                                        <div class="panel-body">
                                            <form id="formFilter" class="horizontal-form">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    {{__('apps::dashboard.datatable.form.date_range')}}
                                                                </label>
                                                                <div id="reportrange" class="btn default form-control">
                                                                    <i class="fa fa-calendar"></i> &nbsp;
                                                                    <span> </span>
                                                                    <b class="fa fa-angle-down"></b>
                                                                    <input type="hidden" name="from">
                                                                    <input type="hidden" name="to">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    {{__('apps::dashboard.datatable.form.soft_deleted')}}
                                                                </label>
                                                                <div class="mt-radio-list">
                                                                    <label class="mt-radio">
                                                                        {{__('apps::dashboard.datatable.form.delete_only')}}
                                                                        <input type="radio" value="only"
                                                                               name="deleted"/>
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    {{__('apps::dashboard.datatable.form.status')}}
                                                                </label>
                                                                <div class="mt-radio-list">
                                                                    <label class="mt-radio">
                                                                        {{__('apps::dashboard.datatable.form.active')}}
                                                                        <input type="radio" value="1" name="status"/>
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio">
                                                                        {{__('apps::dashboard.datatable.form.unactive')}}
                                                                        <input type="radio" value="0" name="status"/>
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="clearfix"></div>
                                                        <div class="col-md-3">
                                                            @inject('governorates','Modules\Areas\Entities\Governorate')

                                                            {!! field('dashboard_search')->select('governorates', __('order::dashboard.orders.datatable.governorate') ,
                                                            pluckModelsCols($governorates->get() , 'title','id',true)) !!}
                                                            <br>
                                                        </div>
                                                        <div class="col-md-3">
                                                            {!! field('dashboard_search')->select('city_id', __('order::dashboard.orders.datatable.city') , []) !!}

                                                            @push('scripts')
                                                                <script>
                                                                    $('#governorates').change(function () {
                                                                        var id = $('#governorates').val();
                                                                        var url = '{{ route("dashboard.governorates.get-cities", ":id") }}';
                                                                        url = url.replace(':id', id);
                                                                        requestForSelectValue(url, 'city_id')
                                                                    });

                                                                    function requestForSelectValue(url, append_name) {

                                                                        $.ajax({
                                                                            url: url,
                                                                            type: 'get',
                                                                            success: function (data) {
                                                                                var builtSelectCategory = '<option value="">select</option>';
                                                                                $.each(data, function (index, item) {
                                                                                    var option = '<option value="' + item.id + '">' + item.title + '</option>';
                                                                                    builtSelectCategory += option;
                                                                                });

                                                                                $('#' + append_name).text('').append(builtSelectCategory);
                                                                            },
                                                                            error: function (data) {
                                                                                $('#' + append_name).text('').append('<option value="">{{__('families::dashboard.families.form.no_data')}}</option>');
                                                                            }
                                                                        });
                                                                    }
                                                                </script>
                                                            @endpush
                                                            <br>
                                                        </div>
                                                        <div class="col-md-3">
                                                            @inject('volunteers','Modules\Volunteers\Entities\Volunteer')

                                                            {!! field('dashboard_search')->select('volunteer_id', __('order::dashboard.orders.datatable.volunteers') ,
                                                            $volunteers->get()->pluck('Username','id')->toArray()) !!}
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <br>
                                            <div class="form-actions">
                                                <button class="btn btn-sm green btn-outline filter-submit margin-bottom"
                                                        id="search">
                                                    <i class="fa fa-search"></i>
                                                    {{__('apps::dashboard.datatable.search')}}
                                                </button>
                                                <button class="btn btn-sm red btn-outline filter-cancel">
                                                    <i class="fa fa-times"></i>
                                                    {{__('apps::dashboard.datatable.reset')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END DATATABLE FILTER --}}


                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">
                                {{__('order::dashboard.orders.routes.index')}}
                            </span>
                            </div>
                        </div>

                        {{-- DATATABLE CONTENT --}}
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTable">
                                <thead>
                                <tr>
                                    <th>
                                        <a href="javascript:;" onclick="CheckAll()">
                                            {{__('apps::dashboard.buttons.select_all')}}
                                        </a>
                                    </th>
                                    <th>#</th>
                                    <th>{{__('order::dashboard.orders.datatable.volunteer_name')}}</th>
                                    <th>{{__('order::dashboard.orders.datatable.family_leader_name')}}</th>
                                    <th>{{__('order::dashboard.orders.datatable.family_members_count')}}</th>
                                    <th>{{__('order::dashboard.orders.datatable.status')}}</th>
                                    <th>{{__('order::dashboard.orders.datatable.baskets_count')}}</th>
                                    <th>{{__('order::dashboard.orders.datatable.created_at')}}</th>
                                    <th>{{__('order::dashboard.orders.datatable.options')}}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                {!! field()->select('bulk_action' , __('apps::dashboard.datatable.chose_action') ,[
                                    'delete' => __('apps::dashboard.datatable.delete_all_btn'),
                                    'assign_volunteer' => __('order::dashboard.orders.datatable.assign_volunteer'),
                                    'print' => __('apps::dashboard.datatable.printing'),
                                ]) !!}
                            </div>
                            <div id="assign_volunteer_content" style="display: none;" class="bulk_actions">
                                <div class="col-lg-3">
                                    {!! field()->select('volunteer_id' , __('order::dashboard.orders.form.volunteer') ,
                                    $volunteers->active()->get()->pluck('user.name','id')->toArray()) !!}
                                </div>
                                <div class="form-group">
                                    <button type="button" id="assignChecked" class="btn btn-primary btn-sm"
                                            onclick="assignChecked()">
                                        {{__('order::dashboard.orders.datatable.assign_volunteer')}}
                                    </button>
                                </div>
                            </div>
                            <div id="delete_content" style="display: none;" class="bulk_actions">
                                <div class="form-group">
                                    <button type="submit" id="deleteChecked" class="btn red btn-sm"
                                            onclick="deleteAllChecked('{{ url(route('dashboard.orders.deletes')) }}')">
                                        {{__('apps::dashboard.datatable.delete_all_btn')}}
                                    </button>
                                </div>
                            </div>
                            <div id="print_content" style="display: none;" class="bulk_actions">
                                <div class="form-group">
                                    <button type="submit" id="deleteChecked" class="btn btn-primary btn-sm"
                                            onclick="printAllChecked('{{route('dashboard.orders.export','print')}}')">
                                        {{ __('apps::dashboard.datatable.printing') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')

    <script>

        function getTableIds() {
            var someObj = {};
            someObj.fruitsGranted = [];

            $("input:checkbox").each(function () {
                var $this = $(this);

                if ($this.is(":checked")) {
                    someObj.fruitsGranted.push($this.attr("value"));
                }
            });

            return someObj.fruitsGranted;
        }

        $('#bulk_action').change(function () {
            $('.bulk_actions').hide();
            $('#' + $(this).val() + '_content').show();
        });

        function printAllChecked(url) {
            var ids = getTableIds();

            if (ids.length == 0) {

                toastr["error"]('{{__('order::dashboard.orders.messages.please_select_orders_you_need_to_print')}}');
            } else {

                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        ids: ids,
                    },
                    success: function (msg) {

                        window.location = url;

                    },
                    error: function (msg) {
                        toastr["error"](msg[1]);
                        $('#dataTable').DataTable().ajax.reload();
                    }
                });
            }
        }

        function assignChecked() {
            var volunteer = $('#volunteer_id');

            if (volunteer.val() == '') {
                volunteer.focus();
                toastr["error"]('{{__('order::dashboard.orders.messages.please_select_volunteer')}}');
            } else {

                var ids = getTableIds();

                if (ids.length == 0) {

                    toastr["error"]('{{__('order::dashboard.orders.messages.please_select_orders_you_need_to_assign')}}');
                } else {

                    var url = '{{ route('dashboard.orders.assign.volunteer',':volunteer') }}';
                    url = url.replace(':volunteer', volunteer.val());
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {
                            ids: ids,
                        },
                        success: function (msg) {

                            if (msg[0] == true) {
                                toastr["success"](msg[1]);
                                $('#dataTable').DataTable().ajax.reload();
                            } else {
                                toastr["error"](msg[1]);
                            }

                        },
                        error: function (msg) {
                            toastr["error"](msg[1]);
                            $('#dataTable').DataTable().ajax.reload();
                        }
                    });
                }
            }
        }

        function tableGenerate(data = '') {

            var dataTable =
                $('#dataTable').DataTable({
                    "createdRow": function (row, data, dataIndex) {
                        if (data["deleted_at"] != null) {
                            $(row).addClass('danger');
                        }
                    },
                    ajax: {
                        url: "{{ url(route('dashboard.orders.datatable')) }}",
                        type: "GET",
                        data: {
                            req: data,
                        },
                    },
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
                    },
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    responsive: !0,
                    order: [[1, "desc"]],
                    columns: [
                        {data: 'id', className: 'dt-center'},
                        {data: 'id', className: 'dt-center'},
                        {data: 'volunteer_id', className: 'dt-center'},
                        {data: 'family_leader_name', orderable: false, className: 'dt-center'},
                        {data: 'family_members_count', orderable: false, className: 'dt-center'},
                        {data: 'status', className: 'dt-center'},
                        {data: 'baskets_count', orderable: false, className: 'dt-center'},
                        {data: 'created_at', className: 'dt-center'},
                        {data: 'id', responsivePriority: 1},
                    ],
                    columnDefs: [
                        {
                            targets: 0,
                            width: '30px',
                            className: 'dt-center',
                            orderable: false,
                            render: function (data, type, full, meta) {
                                return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                          <input type="checkbox" value="` + data + `" class="group-checkable" name="ids">
                          <span></span>
                        </label>
                      `;
                            },
                        },
                        {
                            targets: 5,
                            width: '30px',
                            className: 'dt-center',
                            render: function (data, type, full, meta) {
                                if (data == 'pending') {
                                    return '<span class="badge badge-warning"> {{__('order::dashboard.orders.datatable.status_name.pending')}} </span>';
                                } else {
                                    return '<span class="badge badge-success"> {{__('order::dashboard.orders.datatable.status_name.delivered')}} </span>';
                                }
                            },
                        },
                        {
                            targets: -1,
                            width: '13%',
                            title: '{{__('order::dashboard.orders.datatable.options')}}',
                            className: 'dt-center',
                            orderable: false,
                            render: function (data, type, full, meta) {

                                // Edit
                                var showUrl = '{{ route("dashboard.orders.show", ":id") }}';
                                showUrl = showUrl.replace(':id', data);

                                // Delete
                                var deleteUrl = '{{ route("dashboard.orders.destroy", ":id") }}';
                                deleteUrl = deleteUrl.replace(':id', data);

                                return `

                        @can('show_orders')
                                    <a href="` + showUrl + `" class="btn btn-sm green" title="Edit">
                                  <i class="fa fa-eye"></i>
                                </a>

                        @endcan

                                        @can('delete_orders')
                                    <a href="javascript:;" onclick="deleteRow('` + deleteUrl + `')" class="btn btn-sm red">
                                    <i class="fa fa-trash"></i>
                                  </a>

                        @endcan
                                    `;
                            },
                        },
                    ],
                    dom: 'Bfrtip',
                    lengthMenu: [
                        [10, 25, 50, 100, 500],
                        ['10', '25', '50', '100', '500']
                    ],
                    buttons: [
                        {
                            extend: "pageLength",
                            className: "btn blue btn-outline",
                            text: "{{__('apps::dashboard.datatable.pageLength')}}",
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible'
                            }
                        },
                        {
                            extend: "print",
                            className: "btn blue btn-outline",
                            text: "{{__('apps::dashboard.datatable.print')}}",
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible'
                            }
                        },
                        {
                            extend: "pdf",
                            className: "btn blue btn-outline",
                            text: "{{__('apps::dashboard.datatable.pdf')}}",
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible'
                            }
                        },
                        {
                            extend: "excel",
                            className: "btn blue btn-outline ",
                            text: "{{__('apps::dashboard.datatable.excel')}}",
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible'
                            }
                        },
                        {
                            extend: "colvis",
                            className: "btn blue btn-outline",
                            text: "{{__('apps::dashboard.datatable.colvis')}}",
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible'
                            }
                        }
                    ]
                });
        }

        jQuery(document).ready(function () {
            tableGenerate();
        });
    </script>

@stop

@inject('families','Modules\Families\Entities\Family')
@inject('volunteers','Modules\Volunteers\Entities\Volunteer')

{!! field()->select('families_type' , __('order::dashboard.orders.form.families') , [
    'all' => __('order::dashboard.orders.form.all'),
    'select_families' => __('order::dashboard.orders.form.select_families'),
],'all') !!}

<div id="families_content" style="display: none;">
    {!! field()->multiSelect('families' , __('order::dashboard.orders.form.select_families') ,
    $families->has('baskets')->get()->pluck('head_info.name','id')->toArray()) !!}
</div>

{!! field()->select('volunteer_id' , __('order::dashboard.orders.form.volunteer') ,
$volunteers->active()->get()->pluck('user.name','id')->toArray()) !!}


{!! field()->textarea('volunteer_note' , __('order::dashboard.orders.form.volunteer_note')) !!}

@push('scripts')
    <script>
        $('#families_type').change(function () {
            var value = $('#families_type').val();
            var families_content = $('#families_content');
            if(value === 'all') {
                families_content.hide();
            }else{
                families_content.show();
            }
        });
    </script>
@endpush

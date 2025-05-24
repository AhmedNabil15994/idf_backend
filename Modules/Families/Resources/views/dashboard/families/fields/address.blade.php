@inject('governorates','Modules\Areas\Entities\Governorate')
@php
    $cities = $family->address ? pluckModelsCols(optional(optional($family->address->governorate)->cities())->get(),'title','id',true) : [];
@endphp

{!! field()->select('governorates', __('families::dashboard.families.form.governorate') ,
pluckModelsCols($governorates->get() , 'title','id',true) , optional(optional($family->address)->governorate)->id) !!}

{!! field()->select('city_id', __('families::dashboard.families.form.city') , $cities , optional(optional($family->address)->city)->id) !!}
{!! field()->text('region', __('families::dashboard.families.form.region') , optional($family->address)->region) !!}
{!! field()->number('gada_number', __('families::dashboard.families.form.gada_number') , optional($family->address)->gada_number) !!}
{!! field()->number('ale_number', __('families::dashboard.families.form.ale_number') , optional($family->address)->ale_number) !!}
{!! field()->text('street', __('families::dashboard.families.form.street') , optional($family->address)->street) !!}
{!! field()->number('building_number', __('families::dashboard.families.form.building_number') , optional($family->address)->building_number) !!}
{!! field()->number('floor_number', __('families::dashboard.families.form.floor_number') , optional($family->address)->floor_number) !!}
{!! field()->text('apartment', __('families::dashboard.families.form.apartment') , optional($family->address)->apartment) !!}


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
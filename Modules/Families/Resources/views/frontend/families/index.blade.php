@extends('apps::frontend.layouts.app')
@section('title', '')
@push('styles')
    <style>
        .add-member {
            width: 100%;
        }

        .tirms {
            width: 359px;
            height: 426px;
            border-radius: 7px;
            background-color: #eff0f2;
            text-align: center;
            padding-top: 23px;
            margin-top: 42px;
        }

        .tirms h3 {
            color: #0e723a;
        }

        .progress{display: none}
    </style>
@endpush
@section('content')

    <div class="inner-page">
        <div class="container">
            <div class="row">

                {!! Form::open([
                               'url'=> route('frontend.families.store'),
                               'id'=>'form',
                               'role'=>'form',
                               'method'=>'POST',
                               'class'=>'form-horizontal form-row-seperated',
                               'files' => true
                               ])!!}
                    <div class="col-md-12">
                        <div class="form-block">
                            <h2 class="title-page"> {{__('families::frontend.families.titles.add_family')}}</h2>
                            <div class="row">
                                <div class="col-md-8">

                                    {!! field('frontend_no_label')->text('head_name',__('families::frontend.families.form.head_name'),null,[
                                    //'required' => true
                                    ]) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! field('frontend_no_label')->select('head_gender',__('families::frontend.families.form.head_gender'),[
                                        'male' => __('families::frontend.families.form.male'),
                                        'female' => __('families::frontend.families.form.female'),
                                    ],null,['class' => 'nice-select form-control']) !!}
                                </div>
                                <div class="col-md-8">
                                    {!! field('frontend_no_label')->text('head_national_id',__('families::frontend.families.form.national_id'),null,[
                                    //'required' => true
                                    ]) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! field('frontend_no_label')->text('head_phone',__('families::frontend.families.form.phone'),null,[
                                    //'required' => true
                                    ]) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    {!! field('frontend_no_label')->text('head_nationality_id',__('families::frontend.families.form.nationality_id'),null,[
                                    //'required' => true
                                    ]) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! field('frontend_no_label')->text('head_current_salary',__('families::frontend.families.form.current_salary'),null,[
                                    //'required' => true
                                    ]) !!}
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $members_count = [];
                                        for($i = 3; $i <= 12; $i++){
                                            $members_count += [$i => $i];
                                        }
                                    @endphp
                                    {!! field('frontend_no_label')->select('members_count',__('families::frontend.families.form.members_count'),$members_count,null,[
                                    'class' => 'nice-select form-control'
                                    ]) !!}
                                </div>
                                <div class="col-md-8">
                                    {!! field('frontend_no_label')->text('family_breadwinner',__('families::frontend.families.form.family_breadwinner'),null,[
                                    //'required' => true
                                    ]) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! field('frontend_no_label')->text('breadwinner_Relationship',__('families::frontend.families.form.breadwinner_Relationship'),null,[
                                    //'required' => true
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-block">
                            <h2 class="title-page">{{__('families::frontend.families.titles.members')}}</h2>
                            <div class="family-members">
                                <div class="row new-member">
                                    <div class="col-md-2">
                                        {!! field('frontend_no_label')->text('members_names[0]',__('families::frontend.families.form.name'),null,[
                                            ////'required' => true,
                                            'data-name' => 'members_names.0'
                                        ]) !!}
                                    </div>
                                    <div class="col-md-2">

                                        {!! field('frontend_no_label')->select('members_genders[0]',__('families::frontend.families.form.gender'),[
                                            'male' => __('families::frontend.families.form.male'),
                                            'female' => __('families::frontend.families.form.female'),
                                        ],null,['data-name' => 'members_genders.0','class' => 'nice-select form-control']) !!}
                                    </div>
                                    <div class="col-md-2">
                                        {!! field('frontend_no_label')->text('members_national_ids[0]',__('families::frontend.families.form.national_id'),null,[
                                            ////'required' => true,
                                            'data-name' => 'members_national_ids.0'
                                        ]) !!}
                                    </div>
                                    <div class="col-md-2">
                                        {!! field('frontend_no_label')->text('members_jobs[0]',__('families::frontend.families.form.job'),null,[
                                            ////'required' => true,
                                            'data-name' => 'members_jobs.0'
                                        ]) !!}
                                    </div>
                                    <div class="col-md-2">
                                        {!! field('frontend_no_label')->text('members_current_salary[0]',__('families::frontend.families.form.current_salary'),null,[
                                            ////'required' => true,
                                            'data-name' => 'members_current_salary.0'
                                        ]) !!}
                                    </div>
                                    <div class="col-md-2">
                                        {!! field('frontend_no_label')->text('members__phone[0]',__('families::frontend.families.form.phone'),null,[
                                            ////'required' => true,
                                            'data-name' => 'members_hone.0'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>

                            <button class="btn add-member"><i class="ti-plus"></i>{{__('families::frontend.families.titles.add_member')}}</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-block">
                                <h2 class="title-page">{{__('families::frontend.families.titles.address')}} </h2>
                                <div class="row">
                                    <div class="col-md-4">
                                        @inject('govs','Modules\Areas\Entities\Governorate')
                                        {!! field('frontend_no_label')->select('governorates',__('families::frontend.families.form.governorate'),
                                        pluckModelsCols($govs->get(),'title','id',1),null,['class' => 'nice-select form-control']) !!}
                                    </div>
                                    <div class="col-md-4">
                                        {!! field('frontend_no_label')->select('cities',__('families::frontend.families.form.city'),[],null,['class' => 'nice-select form-control']) !!}
                                    </div>
                                    <div class="col-md-4">
                                        {!! field('frontend_no_label')->select('region_id',__('families::frontend.families.form.region'),[],null,['class' => 'nice-select form-control']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        {!! field('frontend_no_label')->text('gada_number',__('families::frontend.families.form.gada_number')) !!}
                                    </div>
                                    <div class="col-md-8">
                                        {!! field('frontend_no_label')->text('street',__('families::frontend.families.form.street')) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        {!! field('frontend_no_label')->text('building_number',__('families::frontend.families.form.building_number')) !!}
                                    </div>
                                    <div class="col-md-4">
                                        {!! field('frontend_no_label')->text('floor_number',__('families::frontend.families.form.floor_number')) !!}
                                    </div>
                                    <div class="col-md-4">
                                        {!! field('frontend_no_label')->text('apartment',__('families::frontend.families.form.apartment')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">

                            <div class="form-block">
                                <h2 class="title-page">{{__('families::frontend.families.titles.other')}}</h2>
                                <h6>{{__('families::frontend.families.titles.charity_header')}}</h6>
                                @inject('charities','Modules\Charities\Entities\Charity')
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! field('frontend_no_label')->select('charities[0]',__('families::frontend.families.form.charities'),
                                        pluckModelsCols($charities->get(),'title','id',1),null,['class' => 'nice-select form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! field('frontend_no_label')->text('support_type[0]',__('families::frontend.families.form.support_type')) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! field('frontend_no_label')->select('charities[1]',__('families::frontend.families.form.charities'),
                                        pluckModelsCols($charities->get(),'title','id',1),null,['class' => 'nice-select form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! field('frontend_no_label')->text('support_type[1]',__('families::frontend.families.form.support_type')) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! field('frontend_no_label')->select('charities[2]',__('families::frontend.families.form.charities'),
                                        pluckModelsCols($charities->get(),'title','id',1),null,['class' => 'nice-select form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! field('frontend_no_label')->text('support_type[2]',__('families::frontend.families.form.support_type')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-block">
                                {!! field()->multiFileUpload('attachments' , __('families::dashboard.families.form.attachments')) !!}
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn theme-btn" style="width: 100%;">
                                    {{__('families::frontend.families.btn.send_request')}}
                                </button>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="tirms">
                                <h3>{{__('families::frontend.families.titles.acknowledgment')}}</h3>
                                <p>
                                    {{__('families::frontend.families.titles.acknowledgment_dec')}}
                                </p>
                            </div>
                        </div>
                    </div>

                {!! Form::close()!!}
                <div class="col-md-5 img-left">
                    <img class="img-fluid" src="images/bg-2.png" alt=""/>
                </div>
            </div>
        </div>


        <div id="new-member-temp" style="display: none">

            <div class="row new-member">
                <span class="btn remove-member"><i class="ti-close"></i></span>
                <div class="col-md-2">
                    {!! field('frontend_no_label')->text('members_names[:index]',__('families::frontend.families.form.name'),null,[
                        ////'required' => true,
                        'data-name' => 'members_names.0'
                    ]) !!}
                </div>
                <div class="col-md-2">

                    {!! field('frontend_no_label')->select('members_genders[:index]',__('families::frontend.families.form.gender'),[
                        'male' => __('families::frontend.families.form.male'),
                        'female' => __('families::frontend.families.form.female'),
                    ],null,['data-name' => 'gender.0','class' => 'nice-select form-control']) !!}
                </div>
                <div class="col-md-2">
                    {!! field('frontend_no_label')->text('members_national_ids[:index]',__('families::frontend.families.form.national_id'),null,[
                        ////'required' => true,
                        'data-name' => 'members_genders.0'
                    ]) !!}
                </div>
                <div class="col-md-2">
                    {!! field('frontend_no_label')->text('members_jobs[:index]',__('families::frontend.families.form.job'),null,[
                        ////'required' => true,
                        'data-name' => 'members_national_ids.0'
                    ]) !!}
                </div>
                <div class="col-md-2">
                    {!! field('frontend_no_label')->text('members_current_salary[:index]',__('families::frontend.families.form.current_salary'),null,[
                        ////'required' => true,
                        'data-name' => 'members_jobs.0'
                    ]) !!}
                </div>
                <div class="col-md-2">
                    {!! field('frontend_no_label')->text('members__phone[:index]',__('families::frontend.families.form.phone'),null,[
                        ////'required' => true,
                        'data-name' => 'members_current_salary.0'
                    ]) !!}
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $('.add-member').on('click', function (e) {
            e.preventDefault();
            var newElem = $('#new-member-temp').html();
            var rand = Math.floor(Math.random() * 9000000000) + 1000000000;
            newElem = replaceAll(newElem, '::index', rand);

            $('.family-members').append(newElem);
        });


        function escapeRegExp(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
        }

        /* Define functin to find and replace specified term with replacement string */
        function replaceAll(str, term, replacement) {
            return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);
        }
    </script>

    <script>
        $('#governorates').change(function () {
            var id = $('#governorates').val();
            var url = '{{ route("dashboard.governorates.get-cities", ":id") }}';
            url = url.replace(':id', id);
            requestForSelectValue(url, 'cities')
        });
        $('#cities').change(function () {
            var id = $('#cities').val();
            var url = '{{ route("dashboard.cities.get-regions", ":id") }}';
            url = url.replace(':id', id);
            requestForSelectValue(url, 'region_id')
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
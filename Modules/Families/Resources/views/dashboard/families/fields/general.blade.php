@inject('nationalities','Modules\Catalog\Entities\Nationality')
@inject('charities','Modules\Charities\Entities\Charity')
@inject('religions','Modules\Catalog\Entities\Religion')
@php
    function basketBuildArray($max) {
        $response = [];
        for($i = 1; $i <= $max; $i++) {
            $response[$i] = $i;
        }
        return $response;
    }
@endphp
{!! field()->text('head_name', __('families::dashboard.families.form.head_name') , optional($family->head_info)->name) !!}
{!! field()->number('head_phone', __('families::dashboard.families.form.phone') , optional($family->head_info)->phone) !!}
{!! field()->number('head_national_id', __('families::dashboard.families.form.national_id') , optional($family->head_info)->national_id) !!}
{!! field()->select('head_nationality_id', __('families::dashboard.families.form.nationality'),
pluckModelsCols($nationalities->get() , 'title','id',true) , optional($family->head_info)->nationality_id ) !!}
{!! field()->select('head_religion_id', __('families::dashboard.families.form.religion') ,
pluckModelsCols($religions->get() , 'title','id',true) , optional($family->head_info)->religion_id ) !!}
{!! field()->number('head_current_salary', __('families::dashboard.families.form.current_salary') , optional($family->head_info)->current_salary) !!}
{!! field()->select('head_gender', __('families::dashboard.families.form.gender'),[
'male' => __('families::dashboard.families.form.male'),
'female' => __('families::dashboard.families.form.female'),
] , optional($family->head_info)->gender) !!}
{!! field()->select('head_marital_status', __('families::dashboard.families.form.marital_status'),[
'married' => __('families::dashboard.families.form.married'),
'single' => __('families::dashboard.families.form.single'),
'widower' => __('families::dashboard.families.form.widower'),
'divorce' => __('families::dashboard.families.form.divorce'),
] , optional($family->head_info)->marital_status) !!}
{!! field()->number('members_count', __('families::dashboard.families.form.members_count')) !!}

{!! field()->select('charity_id' , __('families::dashboard.families.form.charities'),
pluckModelsCols($charities->get(),'title','id',true)) !!}


@if ($family->trashed())
    {!! field()->checkBox('trash_restore', __('families::dashboard.families.form.restore')) !!}
@endif
<script>
    import Input
        from "../../../../../../../public/admin/tinymce/modules/tinymce/src/themes/silver/test/ts/phantom/components/input/InputTest";

    export default {
        components: {Input}
    }
</script>

{!! field()->text('head_name', __('families::charities.families.form.head_name') , optional($family->head_info)->name ,['readonly' => 'readonly']) !!}
{!! field()->text('head_phone', __('families::charities.families.form.phone') , optional($family->head_info)->phone ,['readonly' => 'readonly']) !!}
{!! field()->text('head_national_id', __('families::charities.families.form.national_id') , optional($family->head_info)->national_id ,['readonly' => 'readonly']) !!}

@if($family->head_info)
    @if($family->head_info->religion)
        {!! field()->text('head_nationality_id', __('families::charities.families.form.nationality'),optional($family->head_info->nationality->translateOrDefault(locale()))->title ,['readonly' => 'readonly'] ) !!}
    @endif
    @if($family->head_info->religion)
        {!! field()->text('head_religion_id', __('families::charities.families.form.religion') , optional($family->head_info->religion->translateOrDefault(locale()))->title,['readonly' => 'readonly']) !!}
    @endif

    {!! field()->text('head_current_salary', __('families::charities.families.form.current_salary') , optional($family->head_info)->current_salary,['readonly' => 'readonly']) !!}
    {!! field()->text('head_gender', __('families::charities.families.form.gender') , __('families::charities.families.form.'.optional($family->head_info)->gender)
    ,['readonly' => 'readonly']) !!}
    {!! field()->text('head_marital_status', __('families::charities.families.form.marital_status') , __('families::charities.families.form.'.optional($family->head_info)->marital_status)
    ,['readonly' => 'readonly']) !!}
    {!! field()->text('members_count', __('families::charities.families.form.members_count') , $family->members_count,['readonly' => 'readonly']) !!}
@endif

<script>
    import Input
        from "../../../../../../../public/admin/tinymce/modules/tinymce/src/themes/silver/test/ts/phantom/components/input/InputTest";

    export default {
        components: {Input}
    }
</script>
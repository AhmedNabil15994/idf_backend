@if($family->address)
    {!! field()->text('governorate', __('families::charities.families.form.governorate') ,
    optional(optional($family->address)->governorate)->translateOrDefault(locale())->title,['readonly' => 'readonly']) !!}

    {!! field()->text('cities', __('families::charities.families.form.city') ,
    optional(optional($family->address)->city)->translateOrDefault(locale())->title,['readonly' => 'readonly']) !!}

    {!! field()->text('region', __('families::charities.families.form.region') ,
    optional($family->address)->region,['readonly' => 'readonly']) !!}
@endif

{!! field()->text('gada_number', __('families::charities.families.form.gada_number') , optional($family->address)->gada_number,['readonly' => 'readonly']) !!}
{!! field()->text('ale_number', __('families::charities.families.form.ale_number') , optional($family->address)->ale_number,['readonly' => 'readonly']) !!}
{!! field()->text('street', __('families::charities.families.form.street') , optional($family->address)->street,['readonly' => 'readonly']) !!}
{!! field()->text('building_number', __('families::charities.families.form.building_number') , optional($family->address)->building_number,['readonly' => 'readonly']) !!}
{!! field()->text('floor_number', __('families::charities.families.form.floor_number') , optional($family->address)->floor_number,['readonly' => 'readonly']) !!}
{!! field()->text('apartment', __('families::charities.families.form.apartment') , optional($family->address)->apartment,['readonly' => 'readonly']) !!}
@inject('charities','Modules\Charities\Entities\Charity')

{!! field()->select('charity_id' , __('families::dashboard.families.form.charities'),
pluckModelsCols($charities->get(),'title','id',true)) !!}
{!! field()->text('name', __('volunteers::dashboard.volunteers.form.name'),optional($volunteer->user)->name) !!}
{!! field()->email('email', __('volunteers::dashboard.volunteers.form.email'), optional($volunteer->user)->email) !!}
{!! field()->text('phone', __('volunteers::dashboard.volunteers.form.phone'),optional($volunteer->user)->mobile) !!}
{!! field()->password('password', __('volunteers::dashboard.volunteers.form.password')) !!}
{!! field()->file('image', __('volunteers::dashboard.volunteers.form.image'), $volunteer->getFirstMediaUrl('images')) !!}
{!! field()->checkBox('status', __('volunteers::dashboard.volunteers.form.status')) !!}
@if ($volunteer->trashed())
    {!! field()->checkBox('trash_restore', __('volunteers::dashboard.volunteers.form.restore')) !!}
@endif


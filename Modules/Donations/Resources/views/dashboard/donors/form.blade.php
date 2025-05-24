
{!! field()->text('name', __('donations::dashboard.donors.form.name') , optional($donor->user)->name) !!}
{!! field()->email('email', __('donations::dashboard.donors.form.email') , optional($donor->user)->email) !!}
{!! field()->number('phone', __('donations::dashboard.donors.form.phone') , optional($donor->user)->mobile) !!}
{!! field()->password('password', __('donations::dashboard.donors.form.password')) !!}
{!! field()->checkBox('status', __('donations::dashboard.donors.form.status')) !!}

@if ($donor->trashed())
    {!! field()->checkBox('trash_restore', __('donations::dashboard.donors.form.restore')) !!}
@endif

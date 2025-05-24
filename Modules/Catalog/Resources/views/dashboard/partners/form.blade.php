{!! field()->text('link', __('catalog::dashboard.partners.form.link') ) !!}
{!! field()->file('image', __('catalog::dashboard.partners.form.image'), $partner->getFirstMediaUrl('images')) !!}

{!! field()->checkBox('status', __('catalog::dashboard.partners.form.status')) !!}
@if ($partner->trashed())
    {!! field()->checkBox('trash_restore', __('catalog::dashboard.partners.form.restore')) !!}
@endif
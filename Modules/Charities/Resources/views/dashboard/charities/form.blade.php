{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('charities::dashboard.charities.form.title').'-'.$code ,
             optional($charity->translate($code))->title,
                  ['data-name' => 'title.'.$code]
             ) !!}
            {!! field()->textarea('description['.$code.']',
            __('charities::dashboard.charities.form.description').'-'.$code ,
             optional($charity->translate($code))->description,
                  ['data-name' => 'description.'.$code]
             ) !!}
        </div>
    @endforeach
</div>
{!! field()->text('address', __('charities::dashboard.charities.form.address')) !!}
{!! field()->email('email', __('charities::dashboard.charities.form.email'), optional($charity->user)->email) !!}
{!! field()->password('password', __('charities::dashboard.charities.form.password')) !!}
{!! field()->text('whats_app', __('charities::dashboard.charities.form.whats_app')) !!}
{!! field()->text('facebook', __('charities::dashboard.charities.form.facebook')) !!}
{!! field()->text('phone', __('charities::dashboard.charities.form.phone')) !!}
{!! field()->file('logo', __('charities::dashboard.charities.form.logo'), $charity->getFirstMediaUrl('images')) !!}
{!! field()->checkBox('status', __('charities::dashboard.charities.form.status')) !!}
@if ($charity->trashed())
    {!! field()->checkBox('trash_restore', __('charities::dashboard.charities.form.restore')) !!}
@endif


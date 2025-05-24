{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('areas::dashboard.countries.form.title').'-'.$code ,
            optional($country->translate($code))->title,
                  ['data-name' => 'title.'.$code]
            ) !!}
        </div>
    @endforeach
</div>

{!! field()->checkBox('status', __('areas::dashboard.countries.form.status')) !!}
@if ($country->trashed())
    {!! field()->checkBox('trash_restore', __('areas::dashboard.countries.form.restore')) !!}
@endif
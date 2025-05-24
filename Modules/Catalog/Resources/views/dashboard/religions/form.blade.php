{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('catalog::dashboard.religions.form.title').'-'.$code ,
             optional($religion->translate($code))->title,
                  ['data-name' => 'title.'.$code]
             ) !!}
        </div>
    @endforeach
</div>

{!! field()->checkBox('status', __('catalog::dashboard.religions.form.status')) !!}
@if ($religion->trashed())
    {!! field()->checkBox('trash_restore', __('catalog::dashboard.religions.form.restore')) !!}
@endif
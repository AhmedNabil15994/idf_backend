{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('catalog::dashboard.nationalities.form.title').'-'.$code ,
             optional($nationality->translate($code))->title,
                  ['data-name' => 'title.'.$code]
             ) !!}
        </div>
    @endforeach
</div>

{!! field()->checkBox('status', __('catalog::dashboard.nationalities.form.status')) !!}
@if ($nationality->trashed())
    {!! field()->checkBox('trash_restore', __('catalog::dashboard.nationalities.form.restore')) !!}
@endif
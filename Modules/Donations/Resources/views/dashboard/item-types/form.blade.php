{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('donations::dashboard.item_types.form.title').'-'.$code ,
            optional($item_type->translate($code))->title,
                  ['data-name' => 'title.'.$code]
            ) !!}
        </div>
    @endforeach
</div>

{!! field()->checkBox('status', __('donations::dashboard.item_types.form.status')) !!}
@if ($item_type->trashed())
    {!! field()->checkBox('trash_restore', __('donations::dashboard.item_types.form.restore')) !!}
@endif
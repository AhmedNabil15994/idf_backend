{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('areas::dashboard.governorates.form.title').'-'.$code ,
             optional($governorate->translate($code))->title,
                  ['data-name' => 'title.'.$code]
             ) !!}
        </div>
    @endforeach
</div>

{!! field()->checkBox('status', __('areas::dashboard.governorates.form.status')) !!}
@if ($governorate->trashed())
    {!! field()->checkBox('trash_restore', __('areas::dashboard.governorates.form.restore')) !!}
@endif
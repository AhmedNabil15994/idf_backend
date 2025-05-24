{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('catalog::dashboard.statistics.form.title').'-'.$code ,
             $statistics->getTranslation('title' , $code),
                  ['data-name' => 'title.'.$code]
             ) !!}
            {!! field()->text('sub_title['.$code.']',
            __('catalog::dashboard.statistics.form.sub_title').'-'.$code ,
             $statistics->getTranslation('sub_title' , $code),
                  ['data-name' => 'sub_title.'.$code]
             ) !!}
        </div>
    @endforeach
</div>
{!! field()->text('value', __('catalog::dashboard.statistics.form.value') ) !!}
{!! field()->checkBox('status', __('catalog::dashboard.statistics.form.status')) !!}
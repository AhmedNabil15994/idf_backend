{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('btn_title['.$code.']',
            __('catalog::dashboard.charters.form.btn_title').'-'.$code ,
             $model->getTranslation('btn_title' , $code),
                  ['data-name' => 'btn_title.'.$code]
             ) !!}
            {!! field()->text('title['.$code.']',
            __('catalog::dashboard.charters.form.title').'-'.$code ,
             $model->getTranslation('title' , $code),
                  ['data-name' => 'title.'.$code]
             ) !!}
            {!! field()->textarea('description['.$code.']',
            __('catalog::dashboard.charters.form.description').'-'.$code ,
             $model->getTranslation('description' , $code),
                  ['data-name' => 'description.'.$code]
             ) !!}
        </div>
    @endforeach
</div>

{!! field()->checkBox('status', __('catalog::dashboard.charters.form.status')) !!}
{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('catalog::dashboard.home-cards.form.title').'-'.$code ,
             $card->getTranslation('title' , $code),
                  ['data-name' => 'title.'.$code]
             ) !!}
            {!! field()->text('sub_title['.$code.']',
            __('catalog::dashboard.home-cards.form.sub_title').'-'.$code ,
             $card->getTranslation('sub_title' , $code),
                  ['data-name' => 'sub_title.'.$code]
             ) !!}
        </div>
    @endforeach
</div>

{!! field()->text('color', __('catalog::dashboard.home-cards.form.color') , $card->color ?? '#ff6161' , ['class' => 'form-control demo']) !!}
{!! field()->text('link', __('catalog::dashboard.home-cards.form.link')) !!}
{!! field()->checkBox('status', __('catalog::dashboard.home-cards.form.status')) !!}
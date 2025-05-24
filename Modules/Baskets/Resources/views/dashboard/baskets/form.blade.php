{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('baskets::dashboard.baskets.form.title').'-'.$code ,
             optional($basket->translate($code))->title,
                  ['data-name' => 'title.'.$code]
             ) !!}
            {!! field()->textarea('description['.$code.']',
            __('baskets::dashboard.baskets.form.description').'-'.$code ,
             optional($basket->translate($code))->description,
                  ['data-name' => 'description.'.$code]
             ) !!}
        </div>
    @endforeach
</div>

{!! field()->number('price', __('baskets::dashboard.baskets.form.price')) !!}
{!! field()->number('quantity', __('baskets::dashboard.baskets.form.quantity')) !!}
{!! field()->file('image', __('baskets::dashboard.baskets.form.image'), $basket->getFirstMediaUrl('images')) !!}
{!! field()->checkBox('status', __('baskets::dashboard.baskets.form.status')) !!}
@if ($basket->trashed())
    {!! field()->checkBox('trash_restore', __('baskets::dashboard.baskets.form.restore')) !!}
@endif
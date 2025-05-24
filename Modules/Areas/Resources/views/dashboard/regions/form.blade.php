@inject('cities','Modules\Areas\Entities\City')
{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text(
            'title['.$code.']',
            __('areas::dashboard.regions.form.title').'-'.$code ,
             optional($region->translate($code))->title,
             ['data-name' => 'title.'.$code]
             ) !!}
        </div>
    @endforeach
</div>
{!! field()->select('city_id',__('areas::dashboard.regions.form.city') , pluckModelsCols($cities->get(),'title','id',true)) !!}
{!! field()->checkBox('status', __('areas::dashboard.regions.form.status')) !!}
@if ($region->trashed())
    {!! field()->checkBox('trash_restore', __('areas::dashboard.regions.form.restore')) !!}
@endif
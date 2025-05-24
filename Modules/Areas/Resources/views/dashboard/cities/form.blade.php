@inject('governorates','Modules\Areas\Entities\Governorate')
{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text(
                 'title['.$code.']',
                 __('areas::dashboard.regions.form.title').'-'.$code ,
                  optional($city->translate($code))->title,
                  ['data-name' => 'title.'.$code]
                  ) !!}
        </div>
    @endforeach
</div>

{!! field()->select('governorate_id',__('areas::dashboard.cities.form.governorate') , pluckModelsCols($governorates->get(),'title','id',true)) !!}
{!! field()->checkBox('status', __('areas::dashboard.cities.form.status')) !!}
@if ($city->trashed())
    {!! field()->checkBox('trash_restore', __('areas::dashboard.cities.form.restore')) !!}
@endif
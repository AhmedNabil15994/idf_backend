@inject('categories','Modules\Category\Entities\Category')
@inject('countries','Modules\Areas\Entities\Country')
{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('projects::dashboard.projects.form.title').'-'.$code ,
             optional($project->translate($code))->title,
                  ['data-name' => 'title.'.$code]
             ) !!}
            {!! field()->textarea('description['.$code.']',
            __('projects::dashboard.projects.form.description').'-'.$code ,
             optional($project->translate($code))->description,
                  ['data-name' => 'description.'.$code]
             ) !!}
        </div>
    @endforeach
</div>


<div class="form-group">
    <label class="col-md-2">
        {{__('slider::dashboard.sliders.form.link_type')}}
    </label>

    <div class="col-md-9">
        <div class="md-radio-inline">
            <label class="mt-radio">
                <input type="radio" name="type" id="type" value="project"
                        {{$project->type == 'project' ? 'checked="checked"' : ''}}>
                {{__('slider::dashboard.sliders.form.project')}}
                <span></span>
            </label>
            <label class="mt-radio">
                <input type="radio" name="type" id="type" value="link"
                        {{!$project->type || $project->type == 'link' ? 'checked="checked"' : ''}}>
                {{__('slider::dashboard.sliders.form.external_link')}}
                <span></span>
            </label>

        </div>
        <div class="help-block"></div>
    </div>
</div>


<div class=" hide-inputs" id="project-input" style="display: {{$project->type == 'project' ? 'block' : 'none'}}">
</div>

<div class=" hide-inputs" id="link-input"
     style="display: {{!$project->type || $project->type == 'link' ? 'block' : 'none'}}">
    {!! field()->text('link', __('slider::dashboard.sliders.form.link'), null,['autocomplete' => 'off']) !!}
</div>
<div class="clearfix"></div>

{!! field()->select('country_id',__('projects::dashboard.projects.form.country') , pluckModelsCols($countries->get(),'title','id',true)) !!}
{!! field()->multiSelect('categories',__('projects::dashboard.projects.form.categories') , pluckModelsCols($categories->get(),'title','id',true)) !!}
{!! field()->number('amount_to_collect', __('projects::dashboard.projects.form.amount_to_collect')) !!}
{!! field()->file('image', __('projects::dashboard.projects.form.image'), $project->getFirstMediaUrl('images')) !!}
{!! field()->checkBox('status', __('projects::dashboard.projects.form.status')) !!}
@if ($project->trashed())
    {!! field()->checkBox('trash_restore', __('projects::dashboard.projects.form.restore')) !!}
@endif



@push('scripts')
    <script>
        $('input[name=type]').change(function () {
            $('.hide-inputs').hide();
            $('#' + this.value + '-input').show();
        });
        $('#add_dates').change(function () {
            if (this.checked) {
                $('#dates_container').show();
            }else{

                $('#dates_container').hide();
            }
        });
    </script>
@endpush
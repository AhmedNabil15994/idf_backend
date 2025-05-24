{!! Form::open([
    'method' => 'post',
    'id' => 'form',
    "class"=>"form-contact",
    'url' => url(route('frontend.charity.store')),
]) !!}

{!! field('frontend_no_label')->text('name',__('charities::frontend.charities.form.contact_name'),null,[
'required' => true
]) !!}
{!! field('frontend_no_label')->text('charity_name',__('charities::frontend.charities.form.charity_name'),null,[
'required' => true
]) !!}
{!! field('frontend_no_label')->email('email',__('charities::frontend.charities.form.email'),null,[
'required' => true
]) !!}
{!! field('frontend_no_label')->number('phone',__('charities::frontend.charities.form.phone'),null,[
'required' => true
]) !!}
<div class="form-group">
    <p> {{__('charities::frontend.charities.by_registering_you_agree_to')}} <a
                href="index.php?page=methak"> {{__('charities::frontend.charities.btn.project_charter')}} </a></p>
</div>
<button type="submit" class="btn theme-btn btn-block">
    {{__('charities::frontend.charities.btn.ask_join')}}
    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
          id="btn_spinner" style="display: none;    margin: 5px;"></span>
</button>

{!! Form::close() !!}
{!! Form::open([
    'method' => 'post',
    'id' => 'form',
    "class"=>"form-contact",
    'url' => url(route('frontend.volunteers.store')),
]) !!}

{!! field('frontend_no_label')->text('name',__('volunteers::frontend.volunteers.form.name'),null,[
'required' => true
]) !!}
{!! field('frontend_no_label')->email('email',__('volunteers::frontend.volunteers.form.email'),null,[
'required' => true
]) !!}
{!! field('frontend_no_label')->number('phone',__('volunteers::frontend.volunteers.form.phone'),null,[
'required' => true
]) !!}

<div class="form-group input-withicon">
    <i class="lnr lnr-calendar-full input-icon"></i>
    {!! field('frontend_no_label')->text('d_o_b',__('volunteers::frontend.volunteers.form.d_o_b'),null,[
    'class' => 'form-control date',
    'data-lock' => 'date',
    'data-init-set' => 'false',
    'data-lang' => 'en',
    'data-large-mode' => 'true',
    'data-large-default' => 'true',
    'required' => true
    ]) !!}
</div>

<div class="form-group">
    <p> {{__('volunteers::frontend.volunteers.by_registering_you_agree_to')}} <a
                href="{{$charters ? url(route('front.pages.show',$charters['slug'])) : '#'}}"> {{__('volunteers::frontend.volunteers.btn.project_charter')}} </a></p>
</div>
<button type="submit" class="btn theme-btn btn-block">
    {{__('volunteers::frontend.volunteers.btn.ask_join')}}
    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
          id="btn_spinner" style="display: none;    margin: 5px;"></span>
</button>

{!! Form::close() !!}
{!! Form::open([
    'method' => 'post',
    'id' => 'form',
    "class"=>"form-contact login mt-30",
    'url' => url(route('frontend.auth.login')),
]) !!}

{!! field('frontend_no_label')->number('email',__('authentication::frontend.register.form.phone'),null,[
'required' => true
]) !!}

{!! field('frontend_no_label')->password('password',__('authentication::frontend.login.form.password'),[
'required' => true
]) !!}

<div class="d-flex form-group align-items-center">
    <div class="custom-control custom-checkbox flex-1">
        <input type="checkbox" id="11" name="price" class="custom-control-input">
        <label class="custom-control-label" for="11">
            {{__('authentication::frontend.login.form.remember_me')}}
        </label>
    </div>
    <div class="forgot-password">
        <a href="{{route('frontend.password.request')}}" class="">
            {{__('authentication::frontend.login.form.btn.forget_password')}}
        </a>
    </div>
</div>
<button type="submit" class="btn theme-btn btn-block">
    {{__('authentication::frontend.login.form.btn.login')}}
    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
          id="btn_spinner" style="display: none;    margin: 5px;"></span>
</button>

{!! Form::close() !!}
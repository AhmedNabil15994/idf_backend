{!! Form::open([
    'method' => 'post',
    'id' => 'register_form',
    "class"=>"form-contact login mt-30",
    'url' => url(route('frontend.auth.register')),
]) !!}

{!! field('frontend_no_label')->text('register_name',__('authentication::frontend.register.form.name'),null,[
'required' => true
]) !!}
{!! field('frontend_no_label')->number('register_phone',__('authentication::frontend.register.form.phone'),null,[
'required' => true
]) !!}

{!! field('frontend_no_label')->password('register_password',__('authentication::frontend.register.form.password'),[
'required' => true
]) !!}

{!! field('frontend_no_label')->password('register_password_confirmation',__('authentication::frontend.register.form.password_confirmation'),[
'required' => true
]) !!}

<div class="form-group">
    @lang("By registering you agree to the") <a href="{{$privacy_policy ? url(route('front.pages.show',$privacy_policy['slug'])) : '#'}}">{{__('apps::frontend.home._header.terms')}}</a>
</div>

<button type="submit" class="btn theme-btn btn-block" id="register_submit">
    {{__('authentication::frontend.register.form.btn.register')}}
    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
          id="register_btn_spinner" style="display: none;    margin: 5px;"></span>
</button>

{!! Form::close() !!}

@push('scripts')
    <script>
            $('#register_form').on('submit', function (e) {

                e.preventDefault();

                var url = $(this).attr('action');
                var method = $(this).attr('method');
                var loading = $('#register_btn_spinner');

                $.ajax({
                    url: url,
                    type: method,
                    dataType: 'JSON',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,

                    beforeSend: function () {
                        $('#register_submit').prop('disabled', true);
                        loading.show();
                        resetErrors();
                    },
                    success: function (data) {

                        $('#register_submit').prop('disabled', false);
                        $('#register_submit').text();
                        loading.hide();

                        if (data[0] == true) {
                            redirect(data);
                            successfully(data);
                            resetErrors();
                        } else {
                            displayMissing(data);
                        }
                    },
                    error: function (data) {

                        $('#register_submit').prop('disabled', false);
                        displayErrors(data);
                        loading.hide();
                    },
                });

            });
    </script>
@endpush
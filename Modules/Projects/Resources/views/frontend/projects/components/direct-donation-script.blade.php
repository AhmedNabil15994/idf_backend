<script>
    function submitForm(button){
        var btn = $(button);
        var form = btn.closest('form');
        var method = form.attr('method');
        var spinner = btn.find('.btn_spinner');
        var input = form.find('.amount');
        var helpBlock = input.parent().find('.help-block');
        var action = btn.attr('action');
        var is_cart = false;
        if(input.val() <= 0){
            
            $('#donation_model_form_amount_contan').show();
            $('#donation_model_form_amount').focus();
            if (typeof action !== 'undefined' && action !== false && action != 'donate') {
                return '';
            }
        }else{

            $('#donation_model_form_amount_contan').hide();
        }


        if (typeof action !== 'undefined' && action !== false) {
            switch (action) {
                case 'add_to_cart' :
                    var url = btn.attr('url');
                    method = 'POST';
                    is_cart = true;
                    ajaxRequest(url, method, form, btn, input, is_cart, helpBlock, spinner);
                    break;
                case 'donate' :
                    var url = $(form).attr('action');
                    $('#gust_donation_model').modal('show');
                    $('#donation_model_form').attr('action', url);
                    $('#donation_model_form_amount').val(input.val());
                    break;
                case 'register-donate' :
                    var url = $(form).attr('action');
                    ajaxRequest(url, method, form, btn, input, is_cart, helpBlock, spinner);
                    break;
            }
        }
    }
    // $('.donate-form').on('submit', function (e) {
    //     e.preventDefault();
    //
    //     var method = $(this).attr('method');
    //     var form = $(this);
    //     var btn = $(document.activeElement);
    //     var spinner = btn.find('.btn_spinner');
    //     var input = form.find('.amount');
    //     var helpBlock = input.parent().find('.help-block');
    //     var action = btn.attr('action');
    //     var is_cart = false;
    //
    //     if (typeof action !== 'undefined' && action !== false) {
    //         switch (action) {
    //             case 'add_to_cart' :
    //                 var url = btn.attr('url');
    //                 method = 'POST';
    //                 is_cart = true;
    //                 ajaxRequest(url, method, this, btn, input, is_cart, helpBlock, spinner);
    //                 break;
    //             case 'donate' :
    //                 var url = $(this).attr('action');
    //                 $('#gust_donation_model').modal('show');
    //                 $('#donation_model_form').attr('action', url);
    //                 $('#donation_model_form_amount').val(input.val());
    //                 break;
    //             case 'register-donate' :
    //                 var url = $(this).attr('action');
    //                 ajaxRequest(url, method, this, btn, input, is_cart, helpBlock, spinner);
    //                 break;
    //         }
    //     }
    // });

    function ajaxRequest(url, method, form, btn, input, is_cart, helpBlock, spinner) {
        
        $.ajax({
            url: url,
            type: method,
            dataType: 'JSON',
            data: form.serialize(),
            cache: false,
            processData: true,

            beforeSend: function () {
                btn.prop('disabled', true);
                spinner.toggle();
                resetErrors();
            },
            success: function (data) {
                spinner.toggle();
                btn.prop('disabled', false);
                if (data[0] == true) {
                    if (is_cart) {
                        $('#cart_counter').text('').append(data['cart_count']).show();
                    }
                    redirect(data);
                    successfully(data);
                    resetForm();
                    resetErrors();
                } else {
                    displayMissing(data);
                }
            },
            error: function (data) {

                btn.prop('disabled', false);

                var getJSON = $.parseJSON(data.responseText);
                jQuery.each(getJSON.errors, function (index, value) {
                    spinner.toggle();
                    input.parent().addClass('has-error');
                    helpBlock.html(value);
                    displayErrors(data)
                });

            },
        });
    }

    $('input[name=donor_type]').change(function () {
        $('.hide-inputs').hide();
        $('#' + this.value + '_scope').show();
    })

    function toggleAllRegisterFields(radio) {
        $('#all_register_fields').toggle();

        if ($('#all_register_fields').is(":hidden") == true) {
            $(radio).prop('checked', false);
        } else {

            $(radio).prop('checked', true);
        }
    }

    function selectPrice(label,price) {
        $('.price-label').removeClass('label-success').addClass('label-default');
        $(label).removeClass('label-default').addClass('label-success');
        $(label).parent().parent().find('#amount').val(price);
    }
</script>
function spinnerToggle() {
    $('#btn_title').toggle();
    $('#btn_spinner').toggle();
}

// ADD FORM
$('#form').on('submit', function (e) {
    e.preventDefault();

    var url = $(this).attr('action');
    var method = $(this).attr('method');

    $.ajax({

        url: url,
        type: method,
        dataType: 'JSON',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,

        beforeSend: function () {
            $('#submit').prop('disabled', true);
            spinnerToggle();
            resetErrors();
        },
        success: function (data) {

            $('#submit').prop('disabled', false);
            spinnerToggle();
            $('#submit').text();

            if (data[0] == true) {
                redirect(data);
                successfully(data);
                resetForm();
                resetErrors();
            } else {
                displayMissing(data);
            }
        },
        error: function (data) {

            $('#submit').prop('disabled', false);
            spinnerToggle();
            displayErrors(data);

        },
    });

});

// Update
$('#updateForm').on('submit', function (e) {

    e.preventDefault();
    tinyMCE.triggerSave();

    var url = $(this).attr('action');
    var method = $(this).attr('method');

    $.ajax({

        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    $('.progress-bar').width(percentComplete + '%');
                    $('#progress-status').html(percentComplete + '%');
                }
            }, false);
            return xhr;
        },

        url: url,
        type: method,
        dataType: 'JSON',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,

        beforeSend: function () {
            $('#submit').prop('disabled', true);
            $('.progress-info').show();
            $('.progress-bar').width('0%');
            resetErrors();
        },
        success: function (data) {
            $('#submit').prop('disabled', false);
            $('#submit').text();

            if (data[0] == true) {
                redirect(data);
                successfully(data);
            } else {
                displayMissing(data);
            }
            ;
        },
        error: function (data) {
            $('#submit').prop('disabled', false);
            displayErrors(data);
        },
    });

});

// Alerts & Others
function displayErrors(data) {

    var getJSON = $.parseJSON(data.responseText);

    jQuery.each(getJSON.errors, function (index, value) {
        if (value.length !== 0) {
            $('[data-name="' + index + '"]').parent().addClass('has-error');
            $('[data-name="' + index + '"]').parent().find('.help-block').html(value);
        }
    });

    var output = "<div class='alert alert-danger'><ul>";
    for (var error in getJSON.errors) {
        output += "<li>" + getJSON.errors[error] + "</li>";
    }
    output += "</ul></div>";

    $('#result').slideDown('fast', function () {
        $('#result').html(output);
    }).delay(5000).slideUp('slow');
}

function displayMissing(data) {

    Swal.fire({
        position: 'center',
        icon: 'error',
        title: data[1],
        showConfirmButton: true
    });
}

function successfully(data) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: data[1],
        showConfirmButton: false,
        timer: 2000
    });

}

function redirect(data) {
    if (data['url']) {
        var url = data['url'];

        if (url) {
            if (data['blank'] && data['blank'] == true) {

                window.open(url, '_blank');
            } else {
                window.location.replace(url);
            }
        }
    }
}

function resetForm() {
    // Clear Inputs
    $('.form-control').each(function () {
        $(this).val('');
    });

    // Clear tinyMCE Editor
    $('textarea').each(function (k, v) {
        tinyMCE.get(k).setContent('');
    });

    // Clear Select2
    $(".select2").select2();
}

function resetErrors() {
    $('.has-error').each(function () {
        $(this).removeClass('has-error');
    });

    $('.help-block').each(function () {
        $(this).text('');
    });
}


function escapeRegExp(string) {
    return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
}


/* Define functin to find and replace specified term with replacement string */
function replaceAll(str, term, replacement) {
    return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);
}
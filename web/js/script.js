$(document).ready(function(){
    $('#registration_form_password').on('change', validateConfirmPassword);
    $('#registration_form_confirm_password').on('keyup', validateConfirmPassword);

    $(document).on('submit', 'form', sendForm);
});

function sendForm() {
    event.preventDefault();
    var _this = $(this),
        form = _this.closest('form'),
        formId = form.attr('id'),
        action = form.attr('action') || location.href,
        method = form.attr('method') || 'post',
        resetForm = form.data('reset') == true ? 1 : 0;

    $.ajax({
        url: action,
        method: method,
        data: form.serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('#'+formId + ' .error').hide();
            $('#'+formId + ' .success').hide();
        },
        success: function(answ){
            var isSuccess = true;
            $.each(answ, function(i, val){
                var _fieldId = val[0],
                    _valid = val[1],
                    _message = val[2],
                    _class = _valid ? 'success' : 'error';

                $('#' + _fieldId).closest('.field').find('.'+_class).html(_message).show();

                if (!_valid) {
                    isSuccess = false;
                }
            });

            if (isSuccess) {
                if (resetForm) {
                    $('#' + formId).trigger('reset');
                }
                if (formId == 'login_form') {
                    location.href = '/';
                }
            }
        },
        error: function() {
            alert("Ошибка выполнения");
        },
        statusCode: {
            404: function() {
                alert("Page Not Found");
            }
        }
    });
}

function validateConfirmPassword() {
    var password = $('#registration_form_password'),
        confirmPassword = $('#registration_form_confirm_password');

    if(password.val() != confirmPassword.val()) {
        confirmPassword[0].setCustomValidity('Entered passwords do not match');
    } else {
        confirmPassword[0].setCustomValidity('');
    }
}

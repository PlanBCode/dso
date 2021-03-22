$(function () { // jQuery ready
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    $('form[novalidate].needs-validation:not([data-tabbed-form])').each(function () {
        this.addEventListener('submit', function (event) {
            // validate every input and trigger tab validation
            $(this).find('input:not([type="hidden"]), select, textarea').each(function () {
                $(this).addClass('touched');
                $(this).trigger('validate');
            });
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();

            }
        }, false);

        // validate every input and trigger tab validation
        $(this).find('input, select, textarea').each(function () {
            // bind function to validate input
            $(this).on('validate', function () {
                let valid = this.checkValidity();
                if (valid) {
                    $(this).addClass('touched');
                }
                $(this).removeClass('is-valid is-invalid');
                if (valid && $(this).val() || $(this).hasClass('touched') && !valid) {
                    $(this).addClass(valid ? 'is-valid' : 'is-invalid');
                }
                $(this).data('valid', valid);
            });

            // on focus out, trigger tab validation
            $(this).on('focusout', function () {
                $(this).addClass('touched');
                $(this).trigger('validate');
            });

            // on focus out, trigger tab validation
            $(this).on('keyup', function () {
                $(this).trigger('validate');
            });
        });
    });
});

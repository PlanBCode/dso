$(function () { // jQuery ready
    'use strict'

    // iterate over all tabs
    $('[role="tablist"][data-tabbed-form]').each(function () {
        let $tabList = $(this);
        let tabs = {};

        $tabList.find('[role="presentation"]').each(function () {
            let $tabPresentation = $(this);
            let $tab = $tabPresentation.find('[role="tab"]');
            let index = $(this).index();
            let $tabContent = $($tab.attr('href'));
            tabs[index] = {valid: false, tab: $tabPresentation};

            // bind function to enable/disable the tab
            $tabPresentation.on('enable', function(e, enable = true) {
                // enable/disable tab itself
                $tab.toggleClass('disabled', !enable);

                for (let i in tabs) {
                    tabs[i].tab.trigger('enableSwitch', [index, enable]);
                }
            });

            // bind function to enable/disable tab-button-switches
            $tabPresentation.on('enableSwitch', function(e, index, enable = true) {
                $tabContent.find('[data-switch-tab="' + index + '"]').each(function () {
                    $(this).toggleClass('disabled', !enable);
                    $(this).attr('disabled', !enable);
                });
            });

            // bind function to switch to tab
            $tabPresentation.on('switch', function() {
                $tab.tab('show');
            });

            // bind function to validate the fields on this tab
            $tabPresentation.on('validate', function () {
                let isValid = true;
                $tabContent.find('input, select, textarea').each(function () {
                    if (!$(this).trigger('validate').data('valid')) {
                        isValid = false;
                    }
                });

                tabs[index].valid = isValid;

                let setValid = true;
                for (let i in tabs) {
                    if (!tabs[i].valid) {
                        setValid = false;
                    }

                    // if this tab is valid, enable the next tab
                    let nextIndex = parseInt(i) + 1;
                    if (tabs[nextIndex]) {
                        tabs[nextIndex].tab.trigger('enable', setValid);
                    }
                }
            });

            // validate every input and trigger tab validation
            $tabContent.find('input, select, textarea').each(function () {
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
                });

                // on focus out, trigger tab validation
                $(this).on('keyup', function () {
                    $tabPresentation.trigger('validate');
                });
            });

            // listen to tab-button-switch
            $tabContent.find('[data-switch-tab]').on('click', function (e) {
                e.preventDefault();
                let index = $(this).data('switch-tab');
                tabs[index].tab.trigger('switch');
            });
        });

        // initially disable links all tabs except for the first
        $tabList.find('[role="presentation"]').each(function () {
            $(this).trigger('validate', [false]);
        });
    });
});

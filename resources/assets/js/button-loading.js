"use strict";

jQuery(document).ready(function() {
    let btnSubmit = $('#saveBtn');
    let form = btnSubmit.closest('form');
    btnSubmit.on('click', function (e) {
        e.preventDefault();
        btnSubmit.addClass('m-loader m-loader--light m-loader--right').attr('disabled', true);
        setTimeout(function () {
            form.submit();
            btnSubmit.removeClass('m-loader m-loader--light m-loader--right').attr('disabled', false);
        }, 800)
    });
});

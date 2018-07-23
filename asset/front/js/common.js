$(document).ready(function () {
    $(".toggle_menu").click(function () {
        $(".nav_menu").toggleClass("open");
        $(".overlay").toggleClass("active");
        $("body").toggleClass("nav_open");
    });
    $(".overlay").click(function () {
        $(".nav_menu").removeClass("open");
        $(".overlay").removeClass("active");
        $("body").removeClass("nav_open");
    });
    $('.login_register_menu').on('click', function () {
        $(".overlay").trigger('click');
    });
    $('.open-modal-tab').click(function (e) {
        var tab = e.target.hash;
        $('li > a[href="' + tab + '"]').tab("show");
    });


    $('#login-form').submit(function (e) {
        var _this = $(this);
        _this.find("[type='submit']").prop('disabled', true);
        $('.form-group .help-block').remove();
        $('.form-group').removeClass('has-error');
        e.preventDefault();
        $.ajax({
            url: _this.attr('action'),
            type: "POST",
            data: _this.serialize(),
            success: function (res)
            {
                _this.find("[type='submit']").prop('disabled', false);
                if (res.validation_error) {
                    $.each(res.validation_error, function (index, value) {
                        var elem = _this.find('[name="' + index + '"]');
                        var error = '<div class="help-block">' + value + '</div>';
                        elem.closest('.form-group').append(error);
                        elem.closest('.form-group').addClass('has-error');
                    });
                } else if (res.success && res.msg && res.data) {
                    showMessage('success', {message: res.msg});
                    $('#modal-manage').modal('hide');
                } else if (res.error) {
                    showMessage('error', {message: res.error});
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                _this.find("[type='submit']").prop('disabled', false);
                showMessage('error', 'Internal error: ' + jqXHR.responseText);
            }
        });
    });

    if (SUCCESS_NOTIFICATION != "" && SUCCESS_NOTIFICATION != null) {
        showMessage('success', {message: SUCCESS_NOTIFICATION});
    } else if (ERROR_NOTIFICATION != "" && ERROR_NOTIFICATION != null) {
        showMessage('error', {message: ERROR_NOTIFICATION});
    } else if (WARNING_NOTIFICATION != "" && WARNING_NOTIFICATION != null) {
        showMessage('warning', {message: WARNING_NOTIFICATION});
    } else if (INFO_NOTIFICATION != "" && INFO_NOTIFICATION != null) {
        showMessage('info', {message: INFO_NOTIFICATION});
    }
    var Time_Interval = null;
    function hideAllMessages() {
        var messagesHeights = new Array(); /* this array will store height for each */
        var myMessages = ['info', 'warning', 'error', 'success'];
        for (i = 0; i < myMessages.length; i++) {
            messagesHeights[i] = $('#notification_pop > .' + myMessages[i]).outerHeight(); /* fill array */
            $('#notification_pop > .' + myMessages[i]).animate({top: -messagesHeights[i]}, 500);
        }
        if (Time_Interval !== null) {
            clearInterval(Time_Interval);
        }
    }
    function showMessage(type, params) {
        toastr.remove()
        if (type == 'success') {
            toastr.success(params.message);
        } else if (type == 'error') {
            toastr.error(params.message);
        } else if (type == 'warning') {
            toastr.warning(params.message);
        } else if (type == 'info') {
            toastr.info(params.message);
        }
    }

    $('.testimonial-carousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    $('.trending-carousel').owlCarousel({
        loop: false,
        margin: 0,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
});
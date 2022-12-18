// let j = jQuery.noConflict();

jQuery(document).ready(function ($) {
    $('#add_form_sentence').on('submit', function (e) {
        e.preventDefault();
        let text = $('#sentence').val();
        let nonce= wp_nonce.nonce
        if (text == "") {
            $.toast({
                heading: 'فیلد مورد نظر بدون مقدار است',
                showHideTransition: 'slide',
                closest: false,
                loaderBg: '#fff',
                allowToastClose: false,
                hideAfter: 2000
            })
            return;
        }
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'post',
            data: {
                action: 'save_sentence',
                text: text,
                nonce:nonce
            },
            beforeSend: function () {
                $('.load_add i').addClass('fa-spinner fa-spin')
                $('#add_sentence').attr('disabled', 'disabled')
            },
            success: function (response) {
                if (response.success) {
                    $.toast({
                        heading: 'موفقیت آمیز',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'success',
                        closest: false,
                        loaderBg: '#fff',
                        allowToastClose: false,
                    })


                }
            },
            complete: function (response) {
                $('#sentence').val("");
                $('.load_add i').removeClass('fa-spinner fa-spin')
                $('#add_sentence').removeAttr('disabled')
            },
            error: function (error) {
                if (error.error) {
                    $.toast({
                        heading: 'خطا',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'error',
                        closest: false,
                        loaderBg: '#fff',
                        allowToastClose: false,
                    })
                }
            },
        })
    })
    $('.delete_sentence').on('click', function () {
        let el = $(this);
        let id = el.data('id');
        let nonce= wp_nonce.nonce;
        if (confirm('جمله مورد نظر حذف شود ؟')) {
            $.ajax({
                url: "/wp-admin/admin-ajax.php",
                type: "post",
                data: {
                    action: "remove_sentence",
                    id: id,
                    nonce:nonce,
                },
                beforeSend: function () {
                    el.removeClass('fa-trash').addClass('fa-sync fa-spin')
                },
                success: function (response) {
                    if (response.success) {
                        $.toast({
                            heading: 'موفقیت آمیز',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success',
                            closest: false,
                            loaderBg: '#fff',
                            allowToastClose: false,
                        })
                        el.parents('tr').remove();
                    }
                },
                error: function (error) {
                    if (error.error) {
                        $.toast({
                            heading: 'خطا',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'error',
                            closest: false,
                            loaderBg: '#fff',
                            allowToastClose: false,
                        })
                    }
                }
            })
        }


    })
    $('.edit_sentence').on('click', function () {
        let el = $(this);
        let id = el.data('id');
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            data: {
                action: "fetch_sentence",
                id: id
            },
            beforeSend: function () {
                $('.load i').show();
                $('.load textarea').css('opacity', "0")
            },
            success: function (response) {
                let data = JSON.parse(response);
                $('#sentence').val(data.text)
                $('#id').val(data.id)
                $('.load i').hide();
                $('.load textarea').css('opacity', "1")
            }
        })
    })
    $('#form_update_sentence').on('submit', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let text = $('#sentence').val();
        let nonce= wp_nonce.nonce
        if (text == "") {
            $.toast({
                heading: 'فیلد مورد نظر بدون مقدار است',
                showHideTransition: 'slide',
                closest: false,
                loaderBg: '#fff',
                allowToastClose: false,
                hideAfter: 2000
            })
            return;
        }
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: "post",
            data: {
                action: "update_sentence",
                id: id,
                text: text,
                nonce:nonce
            },

            success: function (response) {
                if (response) {
                    $.toast({
                        heading: 'موفقیت آمیز',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'success',
                        closest: false,
                        loaderBg: '#fff',
                        allowToastClose: false,
                    })
                    location.reload();
                }
            }
        })
    })
    var check_transparent = "off";
    $('#rs_form_setting').on('submit', function (e) {
        e.preventDefault();
        let rs_fontsize = $('#rs_fontsize').val()
        let rs_color = $('#rs_color').val()
        let rs_bgcolor = $('#rs_bgcolor').val()
        let nonce= wp_nonce.nonce


        $("#check_transparent").change("click", function () {

            if (this.checked) {
                check_transparent = "on"
            }
            if (!this.checked) {
                check_transparent = "off"

            }

        });


        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: "post",
            data: {
                action: "save_setting",
                nonce:nonce,
                rs_fontsize: rs_fontsize,
                rs_color: rs_color,
                rs_bgcolor: rs_bgcolor,
                check_transparent: check_transparent
            },
            beforeSend: function () {
                $('.load_add i').addClass('fa-spinner fa-spin')
                $('#add_setting_sentence').attr('disabled', 'disabled')
            },
            success: function (response) {
                $.toast({
                    heading: 'موفقیت آمیز',
                    text: response.message,
                    showHideTransition: 'slide',
                    icon: 'success',
                    closest: false,
                    loaderBg: '#fff',
                    allowToastClose: false,
                })
            },
            complete: function () {
                $('.load_add i').removeClass('fa-spinner fa-spin')
                $('#add_setting_sentence').removeAttr('disabled')
            }
        })
    })
})
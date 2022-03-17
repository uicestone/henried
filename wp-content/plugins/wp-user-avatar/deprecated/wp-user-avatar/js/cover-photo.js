jQuery(function ($) {
    $('body').on('click', '.ppress-remove-cover-photo', function (e) {
        e.preventDefault();

        var button_text = $(this).text(), this_obj = $(this);

        if (confirm(wpua_custom.confirm_delete)) {

            this_obj.text(wpua_custom.deleting_text);

            $.post(ajaxurl, {
                action: 'pp_del_cover_image',
                nonce: wpua_custom.nonce
            }).done(function (data) {
                if ('error' in data && data.error === 'nonce_failed') {
                    this_obj.val(button_text);
                    alert(wpua_custom.deleting_error);
                }

                if ('success' in data) {
                    if (data.default !== '') {
                        $(".ppress-cover-photo-wrap img").attr('src', data.default);
                    } else {
                        $(".ppress-cover-photo-wrap").remove();
                    }

                    this_obj.remove();
                }
            });

        }
    })
});
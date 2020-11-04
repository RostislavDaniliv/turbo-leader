jQuery(document).ready(function () {
    jQuery('[name=easy_404_redirect_page]').prop('disabled', true);

    if (jQuery('#easy_404_redirect_enable').prop('checked')) {
        jQuery('[name=easy_404_redirect_page]').prop('disabled', function () {
            return !jQuery('#radio_easy_404_redirect_page').prop('checked');
        });
    }

    jQuery('[name=easy_404_redirect_home]').click(function () {
        jQuery('[name=easy_404_redirect_page]').prop('disabled', function () {
            return !jQuery('#radio_easy_404_redirect_page').prop('checked');
        });
    });

    jQuery('#easy_404_redirect_enable').click(function () {
        jQuery('[name=easy_404_redirect_home]').prop('disabled', function () {
            return !jQuery(this).prop('disabled');
        });

        jQuery('[name=easy_404_redirect_page]').prop('disabled', function () {
            if (jQuery('#easy_404_redirect_enable').prop('checked')) {
                return !jQuery('#radio_easy_404_redirect_page').prop('checked');
            } else {
                return true;
            }
        });
    });
});
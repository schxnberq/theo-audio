jQuery(document).ready(function () {

    /* If there are required actions, add an icon with the number of required actions in the About coup-lite-about-page page -> Actions required tab */
    var coup_lite_about_page_nr_actions_required = coupAboutPageObject.nr_actions_required;

    if ( (typeof coup_lite_about_page_nr_actions_required !== 'undefined') && (coup_lite_about_page_nr_actions_required != '0') ) {
        jQuery('li.coup-lite-about-page-w-red-tab a').append('<span class="coup-lite-about-page-actions-count">' + coup_lite_about_page_nr_actions_required + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".coup-lite-about-page-required-action-button").click(function() {

        var id = jQuery(this).attr('id'),
            action = jQuery(this).attr('data-action');

        jQuery.ajax({
            type      : "GET",
            data      : { action: 'coup_lite_about_page_dismiss_required_action', id: id, todo: action },
            dataType  : "html",
            url       : coupAboutPageObject.ajaxurl,
            beforeSend: function (data, settings) {
                jQuery('.coup-lite-about-page-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + coupAboutPageObject.template_directory + '/about-page/images/ajax-loader.gif" /></div>');
            },
            success   : function (data) {
                location.reload();
                jQuery("#temp_load").remove();
                /* Remove loading gif */
            },
            error     : function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });
    // Remove activate button and replace with activation in progress button.
    jQuery('.activate-now').live('DOMNodeInserted', function () {
        var activateButton = jQuery(this);
        if (activateButton.length) {
            var url = jQuery(activateButton).attr('href');
            if (typeof url !== 'undefined') {
                //Request plugin activation.
                jQuery.ajax({
                    beforeSend: function () {
                        jQuery(activateButton).replaceWith('<a class="button updating-message">' + coupAboutPageObject.activating_string + '...</a>');
                    },
                    async: true,
                    type: 'GET',
                    url: url,
                    success: function (data) {
                        //Reload the page.
                        location.reload();
                    }
                });
            }
        }
    });
});

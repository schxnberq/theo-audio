jQuery(document).ready(function() {

	/* If there are required actions, add an icon with the number of required actions in the About coup page -> Actions required tab */
    var coup_nr_actions_required = coupLiteWelcomeScreenObject.nr_actions_required;

    if ( (typeof coup_nr_actions_required !== 'undefined') && (coup_nr_actions_required != '0') ) {
        jQuery('li.coup-w-red-tab a').append('<span class="coup-actions-count">' + coup_nr_actions_required + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".coup-dismiss-required-action").click(function(){

        var id= jQuery(this).attr('id');
        console.log(id);
        jQuery.ajax({
            type       : "GET",
            data       : { action: 'coup_lite_dismiss_required_action',dismiss_id : id },
            dataType   : "html",
            url        : coupLiteWelcomeScreenObject.ajaxurl,
            beforeSend : function(data,settings){
				jQuery('.coup-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + coupLiteWelcomeScreenObject.template_directory + '/inc/admin/welcome-screen/img/ajax-loader.gif" /></div>');
            },
            success    : function(data){
				jQuery("#temp_load").remove(); /* Remove loading gif */
                jQuery('#'+ data).parent().remove(); /* Remove required action box */

                var coup_lite_actions_count = jQuery('.coup-actions-count').text(); /* Decrease or remove the counter for required actions */
                if( typeof coup_lite_actions_count !== 'undefined' ) {
                    if( coup_lite_actions_count == '1' ) {
                        jQuery('.coup-actions-count').remove();
                        jQuery('.coup-tab-pane#actions_required').append('<p>' + coupLiteWelcomeScreenObject.no_required_actions_text + '</p>');
                    }
                    else {
                        jQuery('.coup-actions-count').text(parseInt(coup_lite_actions_count) - 1);
                    }
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });

	/* Tabs in welcome page */
	function coup_welcome_page_tabs(event) {
		jQuery(event).parent().addClass("active");
        jQuery(event).parent().siblings().removeClass("active");
        var tab = jQuery(event).attr("href");
        jQuery(".coup-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
	}

	var coup_actions_anchor = location.hash;

	if( (typeof coup_actions_anchor !== 'undefined') && (coup_actions_anchor != '') ) {
		coup_welcome_page_tabs('a[href="'+ coup_actions_anchor +'"]');
	}

    jQuery(".coup-nav-tabs a").click(function(event) {
        event.preventDefault();
		coup_welcome_page_tabs(this);
    });

		/* Tab Content height matches admin menu height for scrolling purpouses */
	 $tab = jQuery('.coup-tab-content > div');
	 $admin_menu_height = jQuery('#adminmenu').height();
	 if( (typeof $tab !== 'undefined') && (typeof $admin_menu_height !== 'undefined') )
	 {
		 $newheight = $admin_menu_height - 180;
		 $tab.css('min-height',$newheight);
	 }

});

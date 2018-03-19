jQuery(document).ready(function() {
    var coup_aboutpage = coupLiteWelcomeScreenCustomizerObject.aboutpage;
    var coup_nr_actions_required = coupLiteWelcomeScreenCustomizerObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof coup_aboutpage !== 'undefined') && (typeof coup_nr_actions_required !== 'undefined') && (coup_nr_actions_required != '0')) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + coup_aboutpage + '"><span class="coup-actions-count">' + coup_nr_actions_required + '</span></a>');
    }

});

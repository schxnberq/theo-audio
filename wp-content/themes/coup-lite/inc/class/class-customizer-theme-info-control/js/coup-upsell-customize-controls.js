( function( api ) {

    // Extends our custom "coup-theme-info" section.
    api.sectionConstructor['coup-theme-info'] = api.Section.extend( {

        // No events for this type of section.
        attachEvents: function () {},

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );

    // Extends our custom "coup-upsell-frontpage-sections" section.
    api.sectionConstructor['coup-upsell-frontpage-sections'] = api.Section.extend( {

        // No events for this type of section.
        attachEvents: function () {},

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );

} )( wp.customize );

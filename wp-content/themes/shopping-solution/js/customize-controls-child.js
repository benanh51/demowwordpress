( function( api ) {
	// Extends our custom "shopping-solution" section.
	api.sectionConstructor['shopping-solution'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );


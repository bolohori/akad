/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 */
jQuery(document).ready(function(){

	jQuery('#site-navigation ul:first-child').clone().appendTo('.responsive-mainnav');

	jQuery('#main-nav-button').click(function(event){
		event.preventDefault();
		jQuery('.responsive-mainnav').slideToggle();
		jQuery('ul.sub-menu').show();
	});
	
});

jQuery('.main-navigation ul.sub-menu').hide();
jQuery('.main-navigation li').hover( 
	function() {
		jQuery(this).children('ul.sub-menu').slideDown('fast');
	}, 
	function() {
		jQuery(this).children('ul.sub-menu').hide();
	}
);

/**
 * Sticky nav bar fix for admin menu
 */
jQuery(document).ready(function( $ ) {
    var myWindow = $( window ),
		imageBgHeader = $( ".image-bg-header" ),
		adminBar = $( "#wpadminbar" ),
		abHeight = $( "#wpadminbar" ).outerHeight();

	if(adminBar.length) {
		imageBgHeader.css("top", abHeight);
	}

});


/**
 * Sticky navigation
 */

(function( $ ) {
	
    var myWindow = $( window ),
		siteHeader = $( ".site-header" ),
		normalHeader = $( ".normal-header" ),
		headerWrapper = $( ".header-wrapper" );

		normalHeader.wrap('<div class="header-wrapper"></div>');
		$( ".header-wrapper" ).height(normalHeader.outerHeight());

		myWindow.scroll( function() {
			if ( myWindow.scrollTop() == 0 ) {
				siteHeader.removeClass( "sticky-nav" );
			} else {
				siteHeader.addClass( "sticky-nav" );
			}
		} );

})( jQuery );

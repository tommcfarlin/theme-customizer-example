(function( $ ) {
	"use strict";

	wp.customize( 'tcx_link_color', function( value ) {
		value.bind( function( to ) {
			$( 'a' ).css( 'color', to );
		} );
	});

	wp.customize( 'tcx_display_header', function( value ) {
		value.bind( function( to ) {
			false === to ? $( '#header' ).hide() : $( '#header' ).show();
		} );
	});

})( jQuery );

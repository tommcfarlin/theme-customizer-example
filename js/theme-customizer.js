(function( $ ) {
	"use strict";

	var sFont;

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

	wp.customize( 'tcx_color_scheme', function( value ) {
		value.bind( function( to ) {

			if ( 'inverse' === to ) {

				$( 'body' ).css({
					background: '#000',
					color:      '#fff'
				});

			} else {

				$( 'body' ).css({
					background: '#fff',
					color:      '#000'
				});

			} // end if/else

		});
	});

	wp.customize( 'tcx_font', function( value ) {
		value.bind( function( to ) {

			switch( to.toString().toLowerCase() ) {

				case 'times':
					sFont = 'Times New Roman';
					break;

				case 'arial':
					sFont = 'Arial';
					break;

				case 'courier':
					sFont = 'Courier New, Courier';
					break;

				case 'helvetica':
					sFont = 'Helvetica';
					break;

				default:
					sFont = 'Times New Roman';
					break;

			} // end switch/case

			$( 'body' ).css({
				fontFamily: sFont
			});

		});

	});

	wp.customize( 'tcx_footer_copyright_text', function( value ) {
		value.bind( function( to ) {
			$( '#copyright-message' ).text( to );
		});
	});

})( jQuery );

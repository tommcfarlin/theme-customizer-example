<?php

/**
 * Registers options with the Theme Customizer
 *
 * @param      object    $wp_customize    The WordPress Theme Customizer
 * @package    tcx
 * @since      0.2.0
 * @version    0.2.0
 */
function tcx_register_theme_customizer( $wp_customize ) {

	$wp_customize->add_setting(
		'tcx_link_color',
		array(
			'default'     => '#000000',
			'transport'   => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
			    'label'      => __( 'Link Color', 'tcx' ),
			    'section'    => 'colors',
			    'settings'   => 'tcx_link_color'
			)
		)
	);

	/*-----------------------------------------------------------*
	 * Defining our own section
	 *-----------------------------------------------------------*/

	$wp_customize->add_section(
		'tcx_display_options',
		array(
			'title'     => 'Display Options',
			'priority'  => 200
		)
	);

	/* Display Header */
	$wp_customize->add_setting(
		'tcx_display_header',
		array(
			'default'    =>  'true',
			'transport'  =>  'postMessage'
		)
	);

	$wp_customize->add_control(
		'tcx_display_header',
		array(
			'section'   => 'tcx_display_options',
			'label'     => 'Display Header?',
			'type'      => 'checkbox'
		)
	);

	/* Change Color Scheme */
	$wp_customize->add_setting(
		'tcx_color_scheme',
		array(
			'default'   => 'normal',
			'type'      => 'option',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		'tcx_color_scheme',
		array(
			'section'  => 'tcx_display_options',
			'label'    => 'Color Scheme',
			'type'     => 'radio',
			'choices'  => array(
				'normal'    => 'Normal',
				'inverse'   => 'Inverse'
			)
		)
	);

	/* Change Font */
	$wp_customize->add_setting(
		'tcx_font',
		array(
			'default'   => 'times',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		'tcx_font',
		array(
			'section'  => 'tcx_display_options',
			'label'    => 'Theme Font',
			'type'     => 'select',
			'choices'  => array(
				'times'     => 'Times New Roman',
				'arial'     => 'Arial',
				'courier'   => 'Courier New'
			)
		)
	);

	/* Display Copyright */
	$wp_customize->add_setting(
		'tcx_footer_copyright_text',
		array(
			'default'            => 'All Rights Reserved',
			'sanitize_callback'  => 'tcx_sanitize_copyright',
			'transport'          => 'postMessage'
		)
	);

	$wp_customize->add_control(
		'tcx_footer_copyright_text',
		array(
			'section'  => 'tcx_display_options',
			'label'    => 'Copyright Message',
			'type'     => 'text'
		)
	);

} // end tcx_register_theme_customizer
add_action( 'customize_register', 'tcx_register_theme_customizer' );

/**
 * Sanitizes the incoming input and returns it prior to serialization.
 *
 * @param      string    $input    The string to sanitize
 * @return     string              The sanitized string
 * @package    tcx
 * @since      0.5.0
 * @version    0.1.0
 */
function tcx_sanitize_copyright( $input ) {
	return strip_tags( stripslashes( $input ) );
} // end tcx_sanitize_copyright

function tcx_customizer_css() {
?>
	 <style type="text/css">

		 body {

		 	font-family: <?php echo get_theme_mod( 'tcx_font' ); ?>

		 	<?php if ( 'normal' === get_theme_mod( 'tcx_color_scheme' ) ) { ?>

			 	background: #000;
			 	color:      #fff;

		 	<?php } else { ?>

			 	background: #fff;
			 	color:      #000;

		 	<?php } // end if/else ?>
		 }

	     a { color: <?php echo get_theme_mod( 'tcx_link_color' ); ?>; }

		<?php if( false === get_theme_mod( 'tcx_display_header' ) ) { ?>
			#header { display: none; }
		<?php } // end if ?>

	 </style>
<?php
}
add_action( 'wp_head', 'tcx_customizer_css' );

/**
 * Registers the Theme Customizer Preview with WordPress.
 *
 * @package    tcx
 * @since      0.3.0
 * @version    0.3.0
 */
function tcx_customizer_live_preview() {

	wp_enqueue_script(
		'tcx-theme-customizer',
		get_template_directory_uri() . '/js/theme-customizer.js',
		array( 'jquery', 'customize-preview' ),
		'0.5.0'
		true
	);

} // end tcx_customizer_live_preview
add_action( 'customize_preview_init', 'tcx_customizer_live_preview' );
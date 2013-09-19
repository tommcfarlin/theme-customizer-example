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
			'default'     => '#000000'
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

} // end tcx_register_theme_customizer
add_action( 'customize_register', 'tcx_register_theme_customizer' );

/**
 * Writes the anchor color style out to the `head` element of the document
 * by reading the value from the theme mod value in the options table.
 *
 * @package    tcx
 * @since      0.2.0
 * @version    0.2.0
 */
function tcx_customizer_css() {
?>
	 <style type="text/css">
	     a { color: <?php echo get_theme_mod( 'tcx_link_color' ); ?>; }
	 </style>
<?php
} // end tcx_customizer_css
add_action( 'wp_head', 'tcx_customizer_css');
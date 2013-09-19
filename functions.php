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

} // end tcx_register_theme_customizer
add_action( 'customize_register', 'tcx_register_theme_customizer' );

function tcx_customizer_css() {
?>
	 <style type="text/css">
	     a { color: <?php echo get_theme_mod( 'tcx_link_color' ); ?>; }
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
		'0.3.0',
		true
	);

} // end tcx_customizer_live_preview
add_action( 'customize_preview_init', 'tcx_customizer_live_preview' );
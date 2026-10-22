<?php
/**
 * SIBCO Theme Customizer Configurations
 *
 * Provides controls for adjusting background overlay opacity for Hero & Contact CTA sections.
 *
 * @package SIBCO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer Settings & Controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sibco_customize_register( $wp_customize ) {

	// -------------------------------------------------------------
	// 1. SECTION: OVERLAY OPACITY SETTINGS
	// -------------------------------------------------------------
	$wp_customize->add_section(
		'sibco_overlay_settings',
		array(
			'title'       => __( 'Section Overlay Opacity', 'sibco' ),
			'priority'    => 30,
			'description' => __( 'Customize the darkness / opacity of background overlays for the Hero sections and Contact CTA section (0% = transparent, 100% = fully dark).', 'sibco' ),
		)
	);

	// -------------------------------------------------------------
	// 2. SETTING & CONTROL: HERO SECTION OVERLAY OPACITY
	// -------------------------------------------------------------
	$wp_customize->add_setting(
		'sibco_hero_overlay_opacity',
		array(
			'default'           => 80,
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sibco_sanitize_opacity_range',
		)
	);

	$wp_customize->add_control(
		'sibco_hero_overlay_opacity',
		array(
			'label'       => __( 'Hero Section Overlay Opacity (%)', 'sibco' ),
			'description' => __( 'Controls darkness for homepage hero slider and all subpage hero headers.', 'sibco' ),
			'section'     => 'sibco_overlay_settings',
			'type'        => 'range',
			'input_attrs' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
				'class' => 'sibco-opacity-slider',
			),
		)
	);

	// -------------------------------------------------------------
	// 3. SETTING & CONTROL: CONTACT CTA OVERLAY OPACITY
	// -------------------------------------------------------------
	$wp_customize->add_setting(
		'sibco_contact_cta_overlay_opacity',
		array(
			'default'           => 85,
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sibco_sanitize_opacity_range',
		)
	);

	$wp_customize->add_control(
		'sibco_contact_cta_overlay_opacity',
		array(
			'label'       => __( 'Contact CTA Overlay Opacity (%)', 'sibco' ),
			'description' => __( 'Controls darkness for the bottom Contact CTA banner across all pages.', 'sibco' ),
			'section'     => 'sibco_overlay_settings',
			'type'        => 'range',
			'input_attrs' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
				'class' => 'sibco-opacity-slider',
			),
		)
	);
}
add_action( 'customize_register', 'sibco_customize_register' );

/**
 * Sanitize opacity range (integer between 0 and 100).
 *
 * @param mixed $value Input value.
 * @return int Sanitized percentage.
 */
function sibco_sanitize_opacity_range( $value ) {
	$intval = intval( $value );
	if ( $intval < 0 ) {
		return 0;
	}
	if ( $intval > 100 ) {
		return 100;
	}
	return $intval;
}

/**
 * Output dynamic CSS variables in head based on Customizer settings.
 */
function sibco_customizer_css() {
	$hero_opacity = get_theme_mod( 'sibco_hero_overlay_opacity', 80 );
	$cta_opacity  = get_theme_mod( 'sibco_contact_cta_overlay_opacity', 85 );

	$hero_alpha = max( 0, min( 100, intval( $hero_opacity ) ) ) / 100;
	$cta_alpha  = max( 0, min( 100, intval( $cta_opacity ) ) ) / 100;
	?>
	<style id="sibco-customizer-overlay-css">
		:root {
			--sibco-hero-overlay-opacity: <?php echo esc_attr( $hero_alpha ); ?>;
			--sibco-contact-cta-overlay-opacity: <?php echo esc_attr( $cta_alpha ); ?>;
		}
		.hero-section .hero-overlay,
		#hero .hero-overlay {
			opacity: var(--sibco-hero-overlay-opacity) !important;
		}
		#contact-cta .contact-cta-overlay,
		.contact-cta-overlay {
			opacity: var(--sibco-contact-cta-overlay-opacity) !important;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'sibco_customizer_css', 100 );

/**
 * Enqueue Customizer live preview script (iframe side).
 */
function sibco_customizer_preview_js() {
	$file_path = SIBCO_DIR . '/assets/js/customizer-preview.js';
	$version   = file_exists( $file_path ) ? filemtime( $file_path ) : SIBCO_VERSION;

	wp_enqueue_script(
		'sibco-customizer-preview',
		SIBCO_URI . '/assets/js/customizer-preview.js',
		array( 'customize-preview', 'jquery' ),
		$version,
		true
	);
}
add_action( 'customize_preview_init', 'sibco_customizer_preview_js' );

/**
 * Enqueue Customizer control helper script (controls panel side) to display live percentage badges.
 */
function sibco_customizer_controls_js() {
	$file_path = SIBCO_DIR . '/assets/js/customizer-controls.js';
	$version   = file_exists( $file_path ) ? filemtime( $file_path ) : SIBCO_VERSION;

	wp_enqueue_script(
		'sibco-customizer-controls',
		SIBCO_URI . '/assets/js/customizer-controls.js',
		array( 'jquery', 'customize-controls' ),
		$version,
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'sibco_customizer_controls_js' );

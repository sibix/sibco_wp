<?php
/**
 * SIBCO Theme Functions and Definitions
 *
 * @package SIBCO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SIBCO_VERSION', '1.0.0' );
define( 'SIBCO_DIR', get_template_directory() );
define( 'SIBCO_URI', get_template_directory_uri() );

// Include Helpers and ACF configuration
require_once SIBCO_DIR . '/inc/template-tags.php';
require_once SIBCO_DIR . '/inc/acf-fields.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function sibco_theme_setup() {
	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Custom Logo support.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// HTML5 markup support.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Responsive embeds support.
	add_theme_support( 'responsive-embeds' );

	// Register Navigation Menus.
	register_nav_menus(
		array(
			'primary'         => __( 'Primary Navigation', 'sibco' ),
			'footer_company'  => __( 'Footer Company Menu', 'sibco' ),
			'footer_products' => __( 'Footer Products Menu', 'sibco' ),
		)
	);
}
add_action( 'after_setup_theme', 'sibco_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function sibco_enqueue_scripts() {
	// Google Fonts
	wp_enqueue_style(
		'sibco-google-fonts',
		'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	// Tailwind CDN
	wp_enqueue_script(
		'sibco-tailwindcss',
		'https://cdn.tailwindcss.com',
		array(),
		'3.4.0',
		false
	);

	// Tailwind Configuration Inline Script
	$tailwind_config = "
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						cream: { 50: '#FDFCFA', 100: '#FAF8F4', 200: '#F5F0EB', 300: '#EDE5DA', 400: '#E5DDD3', 500: '#D4C8B8' },
						coir: { 50: '#F9F5EF', 100: '#F0E8D8', 200: '#E0CFB0', 300: '#CCAE7E', 400: '#B8934E', 500: '#A67C2E', 600: '#8B6914', 700: '#6E5310', 800: '#54400D', 900: '#3D2F0A' },
						charcoal: { 50: '#F5F5F4', 100: '#E7E5E4', 200: '#D6D3E1', 300: '#A8A29E', 400: '#78716C', 500: '#57534E', 600: '#44403C', 700: '#2C2825', 800: '#1C1917', 900: '#0F0E0D' }
					},
					fontFamily: {
						sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
						serif: ['Playfair Display', 'Georgia', 'serif']
					}
				}
			}
		};
	";
	wp_add_inline_script( 'sibco-tailwindcss', $tailwind_config );

	// Theme Stylesheet
	wp_enqueue_style(
		'sibco-main-style',
		get_stylesheet_uri(),
		array(),
		SIBCO_VERSION
	);

	// Main JavaScript
	wp_enqueue_script(
		'sibco-main-js',
		SIBCO_URI . '/assets/js/main.js',
		array(),
		SIBCO_VERSION,
		true
	);

	// Localize script for AJAX Contact Form
	wp_localize_script(
		'sibco-main-js',
		'sibco_vars',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'sibco_contact_nonce' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'sibco_enqueue_scripts' );

/**
 * Configure ACF JSON save and load paths
 */
add_filter( 'acf/settings/save_json', function( $path ) {
	return SIBCO_DIR . '/acf-json';
} );

add_filter( 'acf/settings/load_json', function( $paths ) {
	$paths[] = SIBCO_DIR . '/acf-json';
	return $paths;
} );

/**
 * Handle AJAX Contact Form Submissions
 */
function sibco_handle_contact_form() {
	// Sanitize form inputs
	$name     = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email    = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$company  = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
	$country  = isset( $_POST['country'] ) ? sanitize_text_field( wp_unslash( $_POST['country'] ) ) : '';
	$product  = isset( $_POST['product'] ) ? sanitize_text_field( wp_unslash( $_POST['product'] ) ) : '';
	$quantity = isset( $_POST['quantity'] ) ? sanitize_text_field( wp_unslash( $_POST['quantity'] ) ) : '';
	$message  = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( empty( $name ) || empty( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please fill in required fields (Name and Email).', 'sibco' ) ) );
	}

	$to      = sibco_get_field( 'contact_email', 'export@sibco.in', 'option' );
	$subject = "SIBCO Export Enquiry from {$name} ({$company})";
	$body    = "New B2B Coir Mat Export Enquiry:\n\n" .
				"Full Name: {$name}\n" .
				"Work Email: {$email}\n" .
				"Company: {$company}\n" .
				"Destination Country: {$country}\n" .
				"Product of Interest: {$product}\n" .
				"Estimated Quantity: {$quantity}\n\n" .
				"Message / Specifications:\n{$message}\n\n" .
				"---\nSent from SIBCO Official Website";

	$headers = array(
		'From: SIBCO Website <' . get_option( 'admin_email' ) . '>',
		'Reply-To: ' . $name . ' <' . $email . '>',
	);

	$mail_sent = wp_mail( $to, $subject, $body, $headers );

	wp_send_json_success( array(
		'message' => __( 'Thank you for your enquiry. Our international export team will review your requirements and respond within 24 hours.', 'sibco' ),
	) );
}
add_action( 'wp_ajax_sibco_contact_form', 'sibco_handle_contact_form' );
add_action( 'wp_ajax_nopriv_sibco_contact_form', 'sibco_handle_contact_form' );

/**
 * Filter primary menu items to add template's custom styling
 */
function sibco_nav_menu_link_attributes( $atts, $item, $args ) {
	if ( isset( $args->theme_location ) && 'primary' === $args->theme_location ) {
		$existing_class = isset( $atts['class'] ) ? $atts['class'] : '';
		$atts['class']  = trim( $existing_class . ' nav-link text-white/80 text-sm font-medium tracking-wide hover:text-white transition-colors duration-200' );
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'sibco_nav_menu_link_attributes', 10, 3 );

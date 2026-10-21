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
require_once SIBCO_DIR . '/inc/cpt-products.php';
require_once SIBCO_DIR . '/inc/cpt-quotes.php';
require_once SIBCO_DIR . '/inc/smtp.php';
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
	$style_ver = file_exists( SIBCO_DIR . '/style.css' ) ? filemtime( SIBCO_DIR . '/style.css' ) : SIBCO_VERSION;
	wp_enqueue_style(
		'sibco-main-style',
		get_stylesheet_uri(),
		array(),
		$style_ver
	);

	// Main JavaScript
	$js_ver = file_exists( SIBCO_DIR . '/assets/js/main.js' ) ? filemtime( SIBCO_DIR . '/assets/js/main.js' ) : SIBCO_VERSION;
	wp_enqueue_script(
		'sibco-main-js',
		SIBCO_URI . '/assets/js/main.js',
		array(),
		$js_ver,
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
 * Handle AJAX Contact & Product Quote Form Submissions
 */
function sibco_handle_contact_form() {
	// Verify nonce if submitted
	if ( ! empty( $_POST['nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'sibco_contact_nonce' ) ) {
		wp_send_json_error( array( 'message' => __( 'Security verification failed. Please reload the page and try again.', 'sibco' ) ) );
	}

	// Sanitize form inputs
	$name     = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email    = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone    = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$company  = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
	$country  = isset( $_POST['country'] ) ? sanitize_text_field( wp_unslash( $_POST['country'] ) ) : '';
	$product  = ! empty( $_POST['product_name'] ) ? sanitize_text_field( wp_unslash( $_POST['product_name'] ) ) : ( isset( $_POST['product'] ) ? sanitize_text_field( wp_unslash( $_POST['product'] ) ) : '' );
	$category = isset( $_POST['product_category'] ) ? sanitize_text_field( wp_unslash( $_POST['product_category'] ) ) : '';
	$quantity = isset( $_POST['quantity'] ) ? sanitize_text_field( wp_unslash( $_POST['quantity'] ) ) : '';
	$message  = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	// Validation: Name and Email are strictly required
	if ( empty( $name ) || empty( $email ) || ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please provide your name and a valid business email address.', 'sibco' ) ) );
	}

	// Determine if this is a specific product quote or general inquiry
	$is_quote_request = ! empty( $product );
	$site_name        = get_bloginfo( 'name' );
	$site_url         = home_url();
	$site_host        = wp_parse_url( $site_url, PHP_URL_HOST );

	if ( $is_quote_request ) {
		$subject_badge = __( 'Product Quote Request', 'sibco' );
		$subject       = "[Product Quote Request] {$product} - " . ( ! empty( $company ) ? "{$company} ({$name})" : $name );
	} else {
		$subject_badge = __( 'Export Wholesale Enquiry', 'sibco' );
		$subject       = "[Export Enquiry] " . ( ! empty( $company ) ? "{$company} ({$name})" : $name );
	}

	// Resolve Recipients (ACF Quote Email -> ACF Contact Email -> WP Admin Email -> Fallback export@sibco.in)
	$recipients_raw = array();
	$opt_quote_email = function_exists( 'sibco_get_field' ) ? sibco_get_field( 'quote_notification_email', '', 'option' ) : '';
	if ( ! empty( $opt_quote_email ) ) {
		$recipients_raw = array_merge( $recipients_raw, explode( ',', $opt_quote_email ) );
	}

	$opt_contact_email = function_exists( 'sibco_get_field' ) ? sibco_get_field( 'contact_email', '', 'option' ) : '';
	if ( ! empty( $opt_contact_email ) ) {
		$recipients_raw = array_merge( $recipients_raw, explode( ',', $opt_contact_email ) );
	}

	$admin_email = get_option( 'admin_email' );
	if ( ! empty( $admin_email ) ) {
		$recipients_raw[] = $admin_email;
	}

	// Default business export address
	$recipients_raw[] = 'export@sibco.in';

	// Clean, validate and deduplicate recipient list
	$recipients = array();
	foreach ( $recipients_raw as $raw ) {
		$clean_r = sanitize_email( trim( $raw ) );
		if ( ! empty( $clean_r ) && is_email( $clean_r ) && ! in_array( $clean_r, $recipients, true ) ) {
			$recipients[] = $clean_r;
		}
	}

	// Allow filtering recipients
	$recipients = apply_filters( 'sibco_quote_recipients', $recipients, compact( 'name', 'email', 'product', 'company' ) );

	// Prepare data array for saving and notifications
	$quote_data = array(
		'name'       => $name,
		'email'      => $email,
		'phone'      => $phone,
		'company'    => $company,
		'country'    => $country,
		'product'    => $product,
		'category'   => $category,
		'quantity'   => $quantity,
		'message'    => $message,
		'recipients' => $recipients,
	);

	// Safe From email (must be valid RFC email)
	$from_email = ! empty( $admin_email ) && is_email( $admin_email ) && false === strpos( $admin_email, '@localhost' ) ? $admin_email : 'export@sibco.in';

	// Construct HTML Email Template
	$html_content = '<!DOCTYPE html>' . "\n";
	$html_content .= '<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>' . esc_html( $subject ) . '</title></head>';
	$html_content .= '<body style="margin:0;padding:0;background-color:#F5F3EC;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif;color:#2B2621;-webkit-font-smoothing:antialiased;">';
	$html_content .= '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#F5F3EC;padding:32px 16px;"><tr><td align="center">';
	
	// Card Container
	$html_content .= '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;background-color:#FFFFFF;border-radius:16px;overflow:hidden;border:1px solid #E4DFD3;box-shadow:0 4px 14px rgba(0,0,0,0.06);">';
	
	// Banner Header
	$html_content .= '<tr><td style="background-color:#1F3025;padding:32px 36px;border-bottom:3px solid #C88A58;text-align:left;">';
	$html_content .= '<span style="display:inline-block;background-color:rgba(200,138,88,0.25);color:#F4D0AA;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 10px;border-radius:6px;margin-bottom:10px;">' . esc_html( $subject_badge ) . '</span>';
	$html_content .= '<h1 style="color:#FFFFFF;font-size:24px;font-family:Georgia,serif;font-weight:700;margin:0 0 6px 0;line-height:1.25;">' . esc_html( $site_name ) . '</h1>';
	$html_content .= '<p style="color:#A6B8AC;font-size:13px;margin:0;">' . esc_html__( 'New B2B Wholesale Export Quote Request', 'sibco' ) . '</p>';
	$html_content .= '</td></tr>';

	// Product Highlight Box (if product present)
	if ( ! empty( $product ) ) {
		$html_content .= '<tr><td style="padding:26px 36px 10px 36px;">';
		$html_content .= '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#FAF7F0;border-left:4px solid #C88A58;border-radius:0 10px 10px 0;padding:16px 20px;">';
		$html_content .= '<tr><td>';
		$html_content .= '<div style="font-size:11px;font-weight:700;color:#8F5F36;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">' . esc_html__( 'Product Requested', 'sibco' ) . '</div>';
		$html_content .= '<div style="font-size:18px;font-weight:700;color:#1F3025;margin-bottom:4px;">' . esc_html( $product ) . '</div>';
		if ( ! empty( $category ) ) {
			$html_content .= '<div style="font-size:13px;color:#6A645C;margin-bottom:4px;">' . esc_html__( 'Category: ', 'sibco' ) . '<strong>' . esc_html( $category ) . '</strong></div>';
		}
		if ( ! empty( $quantity ) ) {
			$html_content .= '<div style="font-size:13px;color:#1F3025;font-weight:600;">' . esc_html__( 'Estimated Quantity: ', 'sibco' ) . '<span style="color:#C88A58;">' . esc_html( $quantity ) . '</span></div>';
		}
		$html_content .= '</td></tr></table>';
		$html_content .= '</td></tr>';
	}

	// Buyer Information Table
	$html_content .= '<tr><td style="padding:16px 36px 20px 36px;">';
	$html_content .= '<h2 style="font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#78726A;border-bottom:1px solid #ECE7DE;padding-bottom:8px;margin:12px 0 14px 0;">' . esc_html__( 'Buyer & Shipment Details', 'sibco' ) . '</h2>';
	$html_content .= '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;line-height:1.6;">';
	$html_content .= '<tr><td width="38%" style="padding:6px 0;color:#857E77;font-weight:600;">' . esc_html__( 'Full Name:', 'sibco' ) . '</td><td width="62%" style="padding:6px 0;color:#2B2621;font-weight:700;">' . esc_html( $name ) . '</td></tr>';
	$html_content .= '<tr><td style="padding:6px 0;color:#857E77;font-weight:600;">' . esc_html__( 'Business Email:', 'sibco' ) . '</td><td style="padding:6px 0;"><a href="mailto:' . esc_attr( $email ) . '" style="color:#C88A58;text-decoration:underline;font-weight:600;">' . esc_html( $email ) . '</a></td></tr>';

	if ( ! empty( $phone ) ) {
		$html_content .= '<tr><td style="padding:6px 0;color:#857E77;font-weight:600;">' . esc_html__( 'Phone / WhatsApp:', 'sibco' ) . '</td><td style="padding:6px 0;color:#2B2621;font-weight:600;"><a href="tel:' . esc_attr( $phone ) . '" style="color:#2B2621;text-decoration:none;">' . esc_html( $phone ) . '</a></td></tr>';
	}
	if ( ! empty( $company ) ) {
		$html_content .= '<tr><td style="padding:6px 0;color:#857E77;font-weight:600;">' . esc_html__( 'Company / Buyer:', 'sibco' ) . '</td><td style="padding:6px 0;color:#2B2621;font-weight:700;">' . esc_html( $company ) . '</td></tr>';
	}
	if ( ! empty( $country ) ) {
		$html_content .= '<tr><td style="padding:6px 0;color:#857E77;font-weight:600;">' . esc_html__( 'Destination Port / Country:', 'sibco' ) . '</td><td style="padding:6px 0;color:#2B2621;font-weight:700;">' . esc_html( $country ) . '</td></tr>';
	}
	if ( empty( $product ) && ! empty( $quantity ) ) {
		$html_content .= '<tr><td style="padding:6px 0;color:#857E77;font-weight:600;">' . esc_html__( 'Estimated Volume:', 'sibco' ) . '</td><td style="padding:6px 0;color:#2B2621;font-weight:700;">' . esc_html( $quantity ) . '</td></tr>';
	}
	$html_content .= '<tr><td style="padding:6px 0;color:#857E77;font-weight:600;">' . esc_html__( 'Submitted On:', 'sibco' ) . '</td><td style="padding:6px 0;color:#555;">' . esc_html( current_time( 'F j, Y, g:i a' ) ) . '</td></tr>';
	$html_content .= '</table>';
	$html_content .= '</td></tr>';

	// Specifications / Notes Section
	$html_content .= '<tr><td style="padding:0 36px 26px 36px;">';
	$html_content .= '<h2 style="font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#78726A;border-bottom:1px solid #ECE7DE;padding-bottom:8px;margin:8px 0 12px 0;">' . esc_html__( 'Custom Specifications & Requirements', 'sibco' ) . '</h2>';
	$html_content .= '<div style="background-color:#FAF9F6;border:1px solid #E8E4DA;border-radius:8px;padding:16px 18px;font-size:14px;line-height:1.6;color:#35302C;">';
	$html_content .= ! empty( $message ) ? nl2br( esc_html( $message ) ) : '<em style="color:#888;">' . esc_html__( 'No additional custom notes provided.', 'sibco' ) . '</em>';
	$html_content .= '</div>';
	$html_content .= '</td></tr>';

	// Quick Reply Button
	$html_content .= '<tr><td style="padding:0 36px 32px 36px;" align="center">';
	$html_content .= '<a href="mailto:' . esc_attr( $email ) . '?subject=' . esc_attr( rawurlencode( 'RE: SIBCO Export Quotation: ' . ( ! empty( $product ) ? $product : 'Coir Mat Inquiry' ) ) ) . '" style="display:inline-block;background-color:#2D4B3E;color:#FFFFFF;font-size:14px;font-weight:600;text-decoration:none;padding:12px 28px;border-radius:10px;box-shadow:0 3px 8px rgba(45,75,62,0.25);">';
	$html_content .= esc_html__( 'Reply Directly to Buyer via Email &rarr;', 'sibco' );
	$html_content .= '</a>';
	$html_content .= '</td></tr>';

	// Footer
	$html_content .= '<tr><td style="background-color:#F0ECE3;padding:20px 36px;text-align:center;font-size:12px;color:#7A746C;border-top:1px solid #E4DFD3;">';
	$html_content .= '<p style="margin:0 0 4px 0;"><strong>' . esc_html( $site_name ) . '</strong> &bull; ' . esc_html__( 'Premium Coir & Rubber Door Mats Manufacturer & Exporter', 'sibco' ) . '</p>';
	$html_content .= '<p style="margin:0;color:#948D85;">' . sprintf( esc_html__( 'Dispatched from %s Quote Engine', 'sibco' ), esc_html( $site_host ) ) . '</p>';
	$html_content .= '</td></tr>';

	$html_content .= '</table>';
	$html_content .= '</td></tr></table>';
	$html_content .= '</body></html>';

	// Headers
	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: ' . esc_attr( $site_name ) . ' <' . esc_attr( $from_email ) . '>',
		'Reply-To: ' . esc_attr( $name ) . ' <' . esc_attr( $email ) . '>',
	);

	// Capture potential mail errors
	$mail_error_msg = '';
	$mail_error_catcher = function( $wp_error ) use ( &$mail_error_msg ) {
		if ( is_wp_error( $wp_error ) ) {
			$mail_error_msg = $wp_error->get_error_message();
		}
	};
	add_action( 'wp_mail_failed', $mail_error_catcher );

	// Send Email to all resolved recipients
	$mail_sent = wp_mail( $recipients, $subject, $html_content, $headers );
	remove_action( 'wp_mail_failed', $mail_error_catcher );

	// Permanently record lead in database (CPT sibco_quote)
	$quote_id = 0;
	if ( function_exists( 'sibco_save_quote_entry' ) ) {
		$quote_id = sibco_save_quote_entry( $quote_data, $mail_sent, $mail_error_msg );
	}

	// Return success response to the client
	wp_send_json_success( array(
		'message'   => __( 'Thank you for your quotation request! Our international export team will review your requirements and respond within 24 hours.', 'sibco' ),
		'quote_id'  => is_numeric( $quote_id ) ? $quote_id : 0,
		'mail_sent' => (bool) $mail_sent,
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

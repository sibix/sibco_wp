<?php
/**
 * Advanced Custom Fields Registration for SIBCO Theme
 *
 * @package SIBCO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'acf/init', 'sibco_register_acf_fields' );

function sibco_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// Register Options Page
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page( array(
			'page_title'    => __( 'Site Settings', 'sibco' ),
			'menu_title'    => __( 'Site Settings', 'sibco' ),
			'menu_slug'     => 'sibco-site-settings',
			'capability'    => 'edit_posts',
			'redirect'      => false,
			'icon_url'      => 'dashicons-admin-generic',
			'position'      => 30,
		) );
	}

	// -------------------------------------------------------------
	// 1. SITE SETTINGS (OPTIONS)
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_site_settings',
		'title' => __( 'Site Global Settings (Header, Footer & Contact Info)', 'sibco' ),
		'fields' => array(
			array(
				'key' => 'field_opt_header_tab',
				'label' => __( 'Header Settings', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_header_cta_text',
				'label' => __( 'Header CTA Button Text', 'sibco' ),
				'name' => 'header_cta_text',
				'type' => 'text',
				'default_value' => 'Request a Quote',
			),
			array(
				'key' => 'field_header_cta_url',
				'label' => __( 'Header CTA Button URL', 'sibco' ),
				'name' => 'header_cta_url',
				'type' => 'text',
				'default_value' => '/contact/',
			),
			array(
				'key' => 'field_opt_contact_tab',
				'label' => __( 'Global Contact Details', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_contact_email',
				'label' => __( 'Primary Contact Email', 'sibco' ),
				'name' => 'contact_email',
				'type' => 'email',
				'default_value' => 'export@sibco.in',
			),
			array(
				'key' => 'field_quote_notification_email',
				'label' => __( 'Quote Notification Recipient(s)', 'sibco' ),
				'name' => 'quote_notification_email',
				'type' => 'text',
				'instructions' => __( 'Email addresses to receive Product Quote Requests (separate multiple with commas). Leave blank to send to Primary Contact Email and Site Admin.', 'sibco' ),
				'default_value' => '',
			),
			array(
				'key' => 'field_opt_smtp_tab',
				'label' => __( 'SMTP Mail Settings', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_enable_custom_smtp',
				'label' => __( 'Enable Custom SMTP', 'sibco' ),
				'name' => 'enable_custom_smtp',
				'type' => 'true_false',
				'instructions' => __( 'Enable this to route all quote emails through an external SMTP server (e.g. Gmail, SendGrid, Zoho, cPanel).', 'sibco' ),
				'default_value' => 0,
				'ui' => 1,
			),
			array(
				'key' => 'field_smtp_host',
				'label' => __( 'SMTP Host', 'sibco' ),
				'name' => 'smtp_host',
				'type' => 'text',
				'instructions' => __( 'e.g. smtp.gmail.com or mail.yourdomain.com', 'sibco' ),
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_enable_custom_smtp',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			),
			array(
				'key' => 'field_smtp_port',
				'label' => __( 'SMTP Port', 'sibco' ),
				'name' => 'smtp_port',
				'type' => 'number',
				'default_value' => 587,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_enable_custom_smtp',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			),
			array(
				'key' => 'field_smtp_user',
				'label' => __( 'SMTP Username / Email', 'sibco' ),
				'name' => 'smtp_user',
				'type' => 'text',
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_enable_custom_smtp',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			),
			array(
				'key' => 'field_smtp_pass',
				'label' => __( 'SMTP Password / App Password', 'sibco' ),
				'name' => 'smtp_pass',
				'type' => 'password',
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_enable_custom_smtp',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			),
			array(
				'key' => 'field_smtp_encryption',
				'label' => __( 'SMTP Encryption', 'sibco' ),
				'name' => 'smtp_encryption',
				'type' => 'select',
				'choices' => array(
					'tls'  => 'TLS (Port 587 - Recommended)',
					'ssl'  => 'SSL (Port 465)',
					'none' => 'None',
				),
				'default_value' => 'tls',
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_enable_custom_smtp',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			),
			array(
				'key' => 'field_contact_phone',
				'label' => __( 'Primary Contact Phone', 'sibco' ),
				'name' => 'contact_phone',
				'type' => 'text',
				'default_value' => '+91 XXX XXX XXXX',
			),
			array(
				'key' => 'field_contact_location',
				'label' => __( 'Location / Region', 'sibco' ),
				'name' => 'contact_location',
				'type' => 'text',
				'default_value' => 'Kerala, India',
			),
			array(
				'key' => 'field_contact_address',
				'label' => __( 'Full Office / Factory Address', 'sibco' ),
				'name' => 'contact_address',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => "SIBCO Coir Exports\nIndustrial Estate, Alappuzha\nKerala, India - 688001",
			),
			array(
				'key' => 'field_opt_footer_tab',
				'label' => __( 'Footer & Social', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_footer_desc',
				'label' => __( 'Footer About Description', 'sibco' ),
				'name' => 'footer_description',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Premium coir mat manufacturer with 26 years of export excellence. Trusted by importers, distributors, and OEM brands across Europe and North America.',
			),
			array(
				'key' => 'field_social_linkedin',
				'label' => __( 'LinkedIn URL', 'sibco' ),
				'name' => 'social_linkedin',
				'type' => 'url',
				'default_value' => '#',
			),
			array(
				'key' => 'field_social_facebook',
				'label' => __( 'Facebook URL', 'sibco' ),
				'name' => 'social_facebook',
				'type' => 'url',
				'default_value' => '#',
			),
			array(
				'key' => 'field_social_instagram',
				'label' => __( 'Instagram URL', 'sibco' ),
				'name' => 'social_instagram',
				'type' => 'url',
				'default_value' => '#',
			),
			array(
				'key' => 'field_footer_copyright',
				'label' => __( 'Copyright Text', 'sibco' ),
				'name' => 'footer_copyright',
				'type' => 'text',
				'default_value' => '© 2024 SIBCO. All rights reserved. Premium Coir Mat Manufacturer.',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'sibco-site-settings',
				),
			),
		),
	) );

	// -------------------------------------------------------------
	// 2. PAGE HERO / BANNER (Reusable for subpages)
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_page_hero',
		'title' => __( 'Page Hero Banner', 'sibco' ),
		'fields' => array(
			array(
				'key' => 'field_hero_badge',
				'label' => __( 'Hero Badge / Tagline', 'sibco' ),
				'name' => 'hero_badge',
				'type' => 'text',
				'instructions' => __( 'Small badge pill above the title, e.g. "About SIBCO" or "Established 1998 · India"', 'sibco' ),
			),
			array(
				'key' => 'field_hero_title',
				'label' => __( 'Hero Heading', 'sibco' ),
				'name' => 'hero_title',
				'type' => 'textarea',
				'rows' => 2,
				'instructions' => __( 'Main bold headline displayed in the hero', 'sibco' ),
			),
			array(
				'key' => 'field_hero_description',
				'label' => __( 'Hero Description / Subheading', 'sibco' ),
				'name' => 'hero_description',
				'type' => 'textarea',
				'rows' => 3,
			),
			array(
				'key' => 'field_hero_image',
				'label' => __( 'Hero Background Image', 'sibco' ),
				'name' => 'hero_image',
				'type' => 'image',
				'return_format' => 'array',
				'instructions' => __( 'Optional background image. Defaults to high-resolution factory imagery.', 'sibco' ),
			),
			array(
				'key' => 'field_hero_button_text',
				'label' => __( 'Primary Button Text', 'sibco' ),
				'name' => 'hero_button_text',
				'type' => 'text',
				'default_value' => 'Request a Quote',
			),
			array(
				'key' => 'field_hero_button_url',
				'label' => __( 'Primary Button URL', 'sibco' ),
				'name' => 'hero_button_url',
				'type' => 'text',
				'default_value' => '/contact/',
			),
			array(
				'key' => 'field_hero_button_secondary_text',
				'label' => __( 'Secondary Button Text', 'sibco' ),
				'name' => 'hero_button_secondary_text',
				'type' => 'text',
			),
			array(
				'key' => 'field_hero_button_secondary_url',
				'label' => __( 'Secondary Button URL', 'sibco' ),
				'name' => 'hero_button_secondary_url',
				'type' => 'text',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
	) );

	// -------------------------------------------------------------
	// 3. FRONT PAGE EXCLUSIVE FIELDS (NO REPEATERS - 100% ACF FREE COMPATIBLE)
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_front_page',
		'title' => __( 'Homepage Content & Sections', 'sibco' ),
		'fields' => array(
			// TAB 0: HERO SLIDER (4 SLIDES - ACF FREE COMPATIBLE)
			array(
				'key' => 'field_hp_hero_slider_tab',
				'label' => __( 'Hero Slider (4 Slides)', 'sibco' ),
				'type' => 'tab',
			),
			// --- SLIDE 1 ---
			array(
				'key' => 'field_hero_slide_1_msg',
				'label' => __( '=== Slide 1 (Heritage & Global Export) ===', 'sibco' ),
				'type' => 'message',
				'message' => __( 'Configure the first hero slide showcasing SIBCO experience and export reach.', 'sibco' ),
			),
			array(
				'key' => 'field_hero_slide_1_badge',
				'label' => __( 'Slide 1 Badge', 'sibco' ),
				'name' => 'hero_slide_1_badge',
				'type' => 'text',
				'default_value' => 'Established 1998 · India',
			),
			array(
				'key' => 'field_hero_slide_1_title',
				'label' => __( 'Slide 1 Headline', 'sibco' ),
				'name' => 'hero_slide_1_title',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => '26 Years of Manufacturing Premium Coir Mats for Global Markets',
			),
			array(
				'key' => 'field_hero_slide_1_desc',
				'label' => __( 'Slide 1 Description', 'sibco' ),
				'name' => 'hero_slide_1_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Trusted manufacturing partner supplying high-quality natural coir mats to importers, distributors and private label brands across Europe and North America.',
			),
			array(
				'key' => 'field_hero_slide_1_btn1_text',
				'label' => __( 'Slide 1 Primary Button Text', 'sibco' ),
				'name' => 'hero_slide_1_btn1_text',
				'type' => 'text',
				'default_value' => 'Request a Quote',
			),
			array(
				'key' => 'field_hero_slide_1_btn1_url',
				'label' => __( 'Slide 1 Primary Button URL', 'sibco' ),
				'name' => 'hero_slide_1_btn1_url',
				'type' => 'text',
				'default_value' => '/contact/',
			),
			array(
				'key' => 'field_hero_slide_1_btn2_text',
				'label' => __( 'Slide 1 Secondary Button Text', 'sibco' ),
				'name' => 'hero_slide_1_btn2_text',
				'type' => 'text',
				'default_value' => 'View Product Range',
			),
			array(
				'key' => 'field_hero_slide_1_btn2_url',
				'label' => __( 'Slide 1 Secondary Button URL', 'sibco' ),
				'name' => 'hero_slide_1_btn2_url',
				'type' => 'text',
				'default_value' => '/products/',
			),
			array(
				'key' => 'field_hero_slide_1_image',
				'label' => __( 'Slide 1 Background Image', 'sibco' ),
				'name' => 'hero_slide_1_image',
				'type' => 'image',
				'return_format' => 'array',
			),

			// --- SLIDE 2 ---
			array(
				'key' => 'field_hero_slide_2_msg',
				'label' => __( '=== Slide 2 (Products & Engineered Durability) ===', 'sibco' ),
				'type' => 'message',
				'message' => __( 'Configure the second slide highlighting Panama and Brush coir mats.', 'sibco' ),
			),
			array(
				'key' => 'field_hero_slide_2_badge',
				'label' => __( 'Slide 2 Badge', 'sibco' ),
				'name' => 'hero_slide_2_badge',
				'type' => 'text',
				'default_value' => '100% Eco-Friendly & Natural',
			),
			array(
				'key' => 'field_hero_slide_2_title',
				'label' => __( 'Slide 2 Headline', 'sibco' ),
				'name' => 'hero_slide_2_title',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Engineered Panama & Brush Coir Mats Built for Extreme Durability',
			),
			array(
				'key' => 'field_hero_slide_2_desc',
				'label' => __( 'Slide 2 Description', 'sibco' ),
				'name' => 'hero_slide_2_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Precision-tufted natural coconut fibers with vulcanized heavy-duty rubber backing, delivering maximum dirt scraping, moisture control, and long-lasting entrance performance.',
			),
			array(
				'key' => 'field_hero_slide_2_btn1_text',
				'label' => __( 'Slide 2 Primary Button Text', 'sibco' ),
				'name' => 'hero_slide_2_btn1_text',
				'type' => 'text',
				'default_value' => 'View Product Range',
			),
			array(
				'key' => 'field_hero_slide_2_btn1_url',
				'label' => __( 'Slide 2 Primary Button URL', 'sibco' ),
				'name' => 'hero_slide_2_btn1_url',
				'type' => 'text',
				'default_value' => '/products/',
			),
			array(
				'key' => 'field_hero_slide_2_btn2_text',
				'label' => __( 'Slide 2 Secondary Button Text', 'sibco' ),
				'name' => 'hero_slide_2_btn2_text',
				'type' => 'text',
				'default_value' => 'Request a Custom Quote',
			),
			array(
				'key' => 'field_hero_slide_2_btn2_url',
				'label' => __( 'Slide 2 Secondary Button URL', 'sibco' ),
				'name' => 'hero_slide_2_btn2_url',
				'type' => 'text',
				'default_value' => '/contact/',
			),
			array(
				'key' => 'field_hero_slide_2_image',
				'label' => __( 'Slide 2 Background Image', 'sibco' ),
				'name' => 'hero_slide_2_image',
				'type' => 'image',
				'return_format' => 'array',
			),

			// --- SLIDE 3 ---
			array(
				'key' => 'field_hero_slide_3_msg',
				'label' => __( '=== Slide 3 (OEM & Private Label Manufacturing) ===', 'sibco' ),
				'type' => 'message',
				'message' => __( 'Configure the third slide highlighting custom manufacturing capabilities.', 'sibco' ),
			),
			array(
				'key' => 'field_hero_slide_3_badge',
				'label' => __( 'Slide 3 Badge', 'sibco' ),
				'name' => 'hero_slide_3_badge',
				'type' => 'text',
				'default_value' => 'End-to-End In-House Production',
			),
			array(
				'key' => 'field_hero_slide_3_title',
				'label' => __( 'Slide 3 Headline', 'sibco' ),
				'name' => 'hero_slide_3_title',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Custom OEM & Private Label Solutions for Volume Importers',
			),
			array(
				'key' => 'field_hero_slide_3_desc',
				'label' => __( 'Slide 3 Description', 'sibco' ),
				'name' => 'hero_slide_3_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'From raw fibre processing and automated backing to custom embossing and barcode packaging — our facility produces over 50,000 units monthly with zero quality claims.',
			),
			array(
				'key' => 'field_hero_slide_3_btn1_text',
				'label' => __( 'Slide 3 Primary Button Text', 'sibco' ),
				'name' => 'hero_slide_3_btn1_text',
				'type' => 'text',
				'default_value' => 'Explore Manufacturing',
			),
			array(
				'key' => 'field_hero_slide_3_btn1_url',
				'label' => __( 'Slide 3 Primary Button URL', 'sibco' ),
				'name' => 'hero_slide_3_btn1_url',
				'type' => 'text',
				'default_value' => '/manufacturing/',
			),
			array(
				'key' => 'field_hero_slide_3_btn2_text',
				'label' => __( 'Slide 3 Secondary Button Text', 'sibco' ),
				'name' => 'hero_slide_3_btn2_text',
				'type' => 'text',
				'default_value' => 'Request Material Samples',
			),
			array(
				'key' => 'field_hero_slide_3_btn2_url',
				'label' => __( 'Slide 3 Secondary Button URL', 'sibco' ),
				'name' => 'hero_slide_3_btn2_url',
				'type' => 'text',
				'default_value' => '/contact/',
			),
			array(
				'key' => 'field_hero_slide_3_image',
				'label' => __( 'Slide 3 Background Image', 'sibco' ),
				'name' => 'hero_slide_3_image',
				'type' => 'image',
				'return_format' => 'array',
			),

			// --- SLIDE 4 ---
			array(
				'key' => 'field_hero_slide_4_msg',
				'label' => __( '=== Slide 4 (European Standards & Sustainability) ===', 'sibco' ),
				'type' => 'message',
				'message' => __( 'Configure the fourth slide highlighting quality certifications and environmental commitment.', 'sibco' ),
			),
			array(
				'key' => 'field_hero_slide_4_badge',
				'label' => __( 'Slide 4 Badge', 'sibco' ),
				'name' => 'hero_slide_4_badge',
				'type' => 'text',
				'default_value' => 'EU Certified & Talite Free',
			),
			array(
				'key' => 'field_hero_slide_4_title',
				'label' => __( 'Slide 4 Headline', 'sibco' ),
				'name' => 'hero_slide_4_title',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Sustainable Coir Products Meeting Stringent European Standards',
			),
			array(
				'key' => 'field_hero_slide_4_desc',
				'label' => __( 'Slide 4 Description', 'sibco' ),
				'name' => 'hero_slide_4_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => '100% biodegradable coconut husk fibers, REACH-compliant rubber backing, and certified non-hazardous processing for environmentally conscious international retailers.',
			),
			array(
				'key' => 'field_hero_slide_4_btn1_text',
				'label' => __( 'Slide 4 Primary Button Text', 'sibco' ),
				'name' => 'hero_slide_4_btn1_text',
				'type' => 'text',
				'default_value' => 'Our Sustainability Mission',
			),
			array(
				'key' => 'field_hero_slide_4_btn1_url',
				'label' => __( 'Slide 4 Primary Button URL', 'sibco' ),
				'name' => 'hero_slide_4_btn1_url',
				'type' => 'text',
				'default_value' => '/sustainability/',
			),
			array(
				'key' => 'field_hero_slide_4_btn2_text',
				'label' => __( 'Slide 4 Secondary Button Text', 'sibco' ),
				'name' => 'hero_slide_4_btn2_text',
				'type' => 'text',
				'default_value' => 'Quality Certifications',
			),
			array(
				'key' => 'field_hero_slide_4_btn2_url',
				'label' => __( 'Slide 4 Secondary Button URL', 'sibco' ),
				'name' => 'hero_slide_4_btn2_url',
				'type' => 'text',
				'default_value' => '/quality/',
			),
			array(
				'key' => 'field_hero_slide_4_image',
				'label' => __( 'Slide 4 Background Image', 'sibco' ),
				'name' => 'hero_slide_4_image',
				'type' => 'image',
				'return_format' => 'array',
			),

			// TAB 1: HERO STATS (6 GRID ITEMS)
			array(
				'key' => 'field_hp_stats_tab',
				'label' => __( 'Hero Stats (6 Cards)', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_hero_stat_1_val',
				'label' => __( 'Stat 1 Value', 'sibco' ),
				'name' => 'hero_stat_1_val',
				'type' => 'text',
				'default_value' => '26+',
			),
			array(
				'key' => 'field_hero_stat_1_lbl',
				'label' => __( 'Stat 1 Label', 'sibco' ),
				'name' => 'hero_stat_1_lbl',
				'type' => 'text',
				'default_value' => 'Years Experience',
			),
			array(
				'key' => 'field_hero_stat_2_val',
				'label' => __( 'Stat 2 Value', 'sibco' ),
				'name' => 'hero_stat_2_val',
				'type' => 'text',
				'default_value' => '50K',
			),
			array(
				'key' => 'field_hero_stat_2_lbl',
				'label' => __( 'Stat 2 Label', 'sibco' ),
				'name' => 'hero_stat_2_lbl',
				'type' => 'text',
				'default_value' => 'Units Capacity',
			),
			array(
				'key' => 'field_hero_stat_3_val',
				'label' => __( 'Stat 3 Value', 'sibco' ),
				'name' => 'hero_stat_3_val',
				'type' => 'text',
				'default_value' => '100%',
			),
			array(
				'key' => 'field_hero_stat_3_lbl',
				'label' => __( 'Stat 3 Label', 'sibco' ),
				'name' => 'hero_stat_3_lbl',
				'type' => 'text',
				'default_value' => 'Natural Coir',
			),
			array(
				'key' => 'field_hero_stat_4_val',
				'label' => __( 'Stat 4 Value', 'sibco' ),
				'name' => 'hero_stat_4_val',
				'type' => 'text',
				'default_value' => 'Talite Free',
			),
			array(
				'key' => 'field_hero_stat_4_lbl',
				'label' => __( 'Stat 4 Label', 'sibco' ),
				'name' => 'hero_stat_4_lbl',
				'type' => 'text',
				'default_value' => 'Certified Non-Hazardous',
			),
			array(
				'key' => 'field_hero_stat_5_val',
				'label' => __( 'Stat 5 Value', 'sibco' ),
				'name' => 'hero_stat_5_val',
				'type' => 'text',
				'default_value' => 'Export Focused',
			),
			array(
				'key' => 'field_hero_stat_5_lbl',
				'label' => __( 'Stat 5 Label', 'sibco' ),
				'name' => 'hero_stat_5_lbl',
				'type' => 'text',
				'default_value' => '25+ Countries Served',
			),
			array(
				'key' => 'field_hero_stat_6_val',
				'label' => __( 'Stat 6 Value', 'sibco' ),
				'name' => 'hero_stat_6_val',
				'type' => 'text',
				'default_value' => 'Zero',
			),
			array(
				'key' => 'field_hero_stat_6_lbl',
				'label' => __( 'Stat 6 Label', 'sibco' ),
				'name' => 'hero_stat_6_lbl',
				'type' => 'text',
				'default_value' => 'Quality Claims',
			),

			// TAB 2: TRUST BAR BADGES (6 ITEMS)
			array(
				'key' => 'field_hp_trust_tab',
				'label' => __( 'Trust Bar (6 Badges)', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_trust_item_1_title',
				'label' => __( 'Badge 1 Text', 'sibco' ),
				'name' => 'trust_item_1_title',
				'type' => 'text',
				'default_value' => '26 Years Experience',
			),
			array(
				'key' => 'field_trust_item_2_title',
				'label' => __( 'Badge 2 Text', 'sibco' ),
				'name' => 'trust_item_2_title',
				'type' => 'text',
				'default_value' => 'Rubber Board Registered',
			),
			array(
				'key' => 'field_trust_item_3_title',
				'label' => __( 'Badge 3 Text', 'sibco' ),
				'name' => 'trust_item_3_title',
				'type' => 'text',
				'default_value' => 'Talite Free Certified',
			),
			array(
				'key' => 'field_trust_item_4_title',
				'label' => __( 'Badge 4 Text', 'sibco' ),
				'name' => 'trust_item_4_title',
				'type' => 'text',
				'default_value' => 'Export Manufacturing',
			),
			array(
				'key' => 'field_trust_item_5_title',
				'label' => __( 'Badge 5 Text', 'sibco' ),
				'name' => 'trust_item_5_title',
				'type' => 'text',
				'default_value' => 'OEM & Private Label',
			),
			array(
				'key' => 'field_trust_item_6_title',
				'label' => __( 'Badge 6 Text', 'sibco' ),
				'name' => 'trust_item_6_title',
				'type' => 'text',
				'default_value' => 'Time Bound Delivery',
			),

			// TAB 3: ABOUT SIBCO OVERVIEW TEASER
			array(
				'key' => 'field_hp_about_tab',
				'label' => __( 'About SIBCO Teaser', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_hp_about_badge',
				'label' => __( 'About Badge', 'sibco' ),
				'name' => 'hp_about_badge',
				'type' => 'text',
				'default_value' => 'About SIBCO',
			),
			array(
				'key' => 'field_hp_about_title',
				'label' => __( 'About Heading', 'sibco' ),
				'name' => 'hp_about_title',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'A Legacy of Premium Coir Manufacturing Since 1998',
			),
			array(
				'key' => 'field_hp_about_description',
				'label' => __( 'About Description', 'sibco' ),
				'name' => 'hp_about_description',
				'type' => 'textarea',
				'rows' => 4,
				'default_value' => "SIBCO is an export-focused coir mat manufacturer delivering exceptional quality to importers, distributors, and private label brands across Europe and North America. Combining Kerala's natural coir heritage with precision machinery.",
			),
			array(
				'key' => 'field_hp_about_button_text',
				'label' => __( 'About Button Text', 'sibco' ),
				'name' => 'hp_about_button_text',
				'type' => 'text',
				'default_value' => 'Discover Our Story & Values',
			),
			array(
				'key' => 'field_hp_about_button_url',
				'label' => __( 'About Button URL', 'sibco' ),
				'name' => 'hp_about_button_url',
				'type' => 'text',
				'default_value' => '/about/',
			),
			array(
				'key' => 'field_hp_about_image',
				'label' => __( 'About Facility Image', 'sibco' ),
				'name' => 'hp_about_image',
				'type' => 'image',
				'return_format' => 'array',
			),
			array(
				'key' => 'field_hp_about_stat_number',
				'label' => __( 'Floating Stat Number', 'sibco' ),
				'name' => 'hp_about_stat_number',
				'type' => 'text',
				'default_value' => '26+',
			),
			array(
				'key' => 'field_hp_about_stat_label',
				'label' => __( 'Floating Stat Label', 'sibco' ),
				'name' => 'hp_about_stat_label',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => "Years of\nManufacturing",
			),

			// TAB 4: CORE CAPABILITIES (6 PILLAR CARDS)
			array(
				'key' => 'field_hp_pillars_tab',
				'label' => __( 'Core Capabilities (6 Cards)', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_hp_pillars_badge',
				'label' => __( 'Section Badge', 'sibco' ),
				'name' => 'hp_pillars_badge',
				'type' => 'text',
				'default_value' => 'Core Capabilities',
			),
			array(
				'key' => 'field_hp_pillars_title',
				'label' => __( 'Section Heading', 'sibco' ),
				'name' => 'hp_pillars_title',
				'type' => 'text',
				'default_value' => 'Built for Global B2B Standards',
			),
			array(
				'key' => 'field_hp_pillars_description',
				'label' => __( 'Section Subheading', 'sibco' ),
				'name' => 'hp_pillars_description',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Explore the core areas that make SIBCO the preferred manufacturing partner for international buyers.',
			),
			// Pillar 1: Why SIBCO
			array(
				'key' => 'field_hp_pillar_1_title',
				'label' => __( 'Card 1 Title (Why SIBCO)', 'sibco' ),
				'name' => 'hp_pillar_1_title',
				'type' => 'text',
				'default_value' => 'Why SIBCO',
			),
			array(
				'key' => 'field_hp_pillar_1_desc',
				'label' => __( 'Card 1 Description', 'sibco' ),
				'name' => 'hp_pillar_1_desc',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => '26 years of refined export experience, certified talite-free compliance, and OEM private label expertise.',
			),
			array(
				'key' => 'field_hp_pillar_1_btn_text',
				'label' => __( 'Card 1 Link Text', 'sibco' ),
				'name' => 'hp_pillar_1_btn_text',
				'type' => 'text',
				'default_value' => 'Learn Why Buyers Choose Us',
			),
			array(
				'key' => 'field_hp_pillar_1_btn_url',
				'label' => __( 'Card 1 Link URL', 'sibco' ),
				'name' => 'hp_pillar_1_btn_url',
				'type' => 'text',
				'default_value' => '/why-sibco/',
			),
			// Pillar 2: Manufacturing Excellence
			array(
				'key' => 'field_hp_pillar_2_title',
				'label' => __( 'Card 2 Title (Manufacturing)', 'sibco' ),
				'name' => 'hp_pillar_2_title',
				'type' => 'text',
				'default_value' => 'Manufacturing Excellence',
			),
			array(
				'key' => 'field_hp_pillar_2_desc',
				'label' => __( 'Card 2 Description', 'sibco' ),
				'name' => 'hp_pillar_2_desc',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Complete end-to-end production: fibre sourcing, spinning, weaving, vulcanized rubber backing, and precision embossing.',
			),
			array(
				'key' => 'field_hp_pillar_2_btn_text',
				'label' => __( 'Card 2 Link Text', 'sibco' ),
				'name' => 'hp_pillar_2_btn_text',
				'type' => 'text',
				'default_value' => 'Explore Manufacturing Process',
			),
			array(
				'key' => 'field_hp_pillar_2_btn_url',
				'label' => __( 'Card 2 Link URL', 'sibco' ),
				'name' => 'hp_pillar_2_btn_url',
				'type' => 'text',
				'default_value' => '/manufacturing/',
			),
			// Pillar 3: Product Range
			array(
				'key' => 'field_hp_pillar_3_title',
				'label' => __( 'Card 3 Title (Products)', 'sibco' ),
				'name' => 'hp_pillar_3_title',
				'type' => 'text',
				'default_value' => 'Product Range',
			),
			array(
				'key' => 'field_hp_pillar_3_desc',
				'label' => __( 'Card 3 Description', 'sibco' ),
				'name' => 'hp_pillar_3_desc',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Panama grill mats, high-brush mats, custom embossed logo mats, rubber grill inlays, and sensor LED entrance mats.',
			),
			array(
				'key' => 'field_hp_pillar_3_btn_text',
				'label' => __( 'Card 3 Link Text', 'sibco' ),
				'name' => 'hp_pillar_3_btn_text',
				'type' => 'text',
				'default_value' => 'View Full Product Catalog',
			),
			array(
				'key' => 'field_hp_pillar_3_btn_url',
				'label' => __( 'Card 3 Link URL', 'sibco' ),
				'name' => 'hp_pillar_3_btn_url',
				'type' => 'text',
				'default_value' => '/products/',
			),
			// Pillar 4: Quality & Certifications
			array(
				'key' => 'field_hp_pillar_4_title',
				'label' => __( 'Card 4 Title (Quality)', 'sibco' ),
				'name' => 'hp_pillar_4_title',
				'type' => 'text',
				'default_value' => 'Quality & Certifications',
			),
			array(
				'key' => 'field_hp_pillar_4_desc',
				'label' => __( 'Card 4 Description', 'sibco' ),
				'name' => 'hp_pillar_4_desc',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Rubber Board registered, EU Talite Free certified, with a 100% pre-dispatch inspection rate and zero quality claims.',
			),
			array(
				'key' => 'field_hp_pillar_4_btn_text',
				'label' => __( 'Card 4 Link Text', 'sibco' ),
				'name' => 'hp_pillar_4_btn_text',
				'type' => 'text',
				'default_value' => 'See Quality Standards',
			),
			array(
				'key' => 'field_hp_pillar_4_btn_url',
				'label' => __( 'Card 4 Link URL', 'sibco' ),
				'name' => 'hp_pillar_4_btn_url',
				'type' => 'text',
				'default_value' => '/quality/',
			),
			// Pillar 5: Sustainability Commitment
			array(
				'key' => 'field_hp_pillar_5_title',
				'label' => __( 'Card 5 Title (Sustainability)', 'sibco' ),
				'name' => 'hp_pillar_5_title',
				'type' => 'text',
				'default_value' => 'Sustainability Commitment',
			),
			array(
				'key' => 'field_hp_pillar_5_desc',
				'label' => __( 'Card 5 Description', 'sibco' ),
				'name' => 'hp_pillar_5_desc',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => '100% natural, biodegradable coconut fibres sourced ethically from Kerala plantations with zero-waste production.',
			),
			array(
				'key' => 'field_hp_pillar_5_btn_text',
				'label' => __( 'Card 5 Link Text', 'sibco' ),
				'name' => 'hp_pillar_5_btn_text',
				'type' => 'text',
				'default_value' => 'Read Sustainability Mission',
			),
			array(
				'key' => 'field_hp_pillar_5_btn_url',
				'label' => __( 'Card 5 Link URL', 'sibco' ),
				'name' => 'hp_pillar_5_btn_url',
				'type' => 'text',
				'default_value' => '/sustainability/',
			),
			// Pillar 6: Start Your Enquiry
			array(
				'key' => 'field_hp_pillar_6_title',
				'label' => __( 'Card 6 Title (Contact)', 'sibco' ),
				'name' => 'hp_pillar_6_title',
				'type' => 'text',
				'default_value' => 'Start Your Enquiry',
			),
			array(
				'key' => 'field_hp_pillar_6_desc',
				'label' => __( 'Card 6 Description', 'sibco' ),
				'name' => 'hp_pillar_6_desc',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Connect directly with our export desk. Request product swatches, technical data sheets, and custom container pricing.',
			),
			array(
				'key' => 'field_hp_pillar_6_btn_text',
				'label' => __( 'Card 6 Link Text', 'sibco' ),
				'name' => 'hp_pillar_6_btn_text',
				'type' => 'text',
				'default_value' => 'Contact Export Team',
			),
			array(
				'key' => 'field_hp_pillar_6_btn_url',
				'label' => __( 'Card 6 Link URL', 'sibco' ),
				'name' => 'hp_pillar_6_btn_url',
				'type' => 'text',
				'default_value' => '/contact/',
			),

			// TAB 5: TESTIMONIALS (3 CARDS)
			array(
				'key' => 'field_hp_testi_tab',
				'label' => __( 'Testimonials (3 Cards)', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_hp_testi_badge',
				'label' => __( 'Section Badge', 'sibco' ),
				'name' => 'hp_testi_badge',
				'type' => 'text',
				'default_value' => 'Client Confidence',
			),
			array(
				'key' => 'field_hp_testi_title',
				'label' => __( 'Section Heading', 'sibco' ),
				'name' => 'hp_testi_title',
				'type' => 'text',
				'default_value' => 'What Our Partners Say',
			),
			array(
				'key' => 'field_hp_testi_description',
				'label' => __( 'Section Subheading', 'sibco' ),
				'name' => 'hp_testi_description',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'We maintain strict confidentiality for all OEM partners. The following reflect genuine feedback from our international buyers.',
			),
			// Testimonial 1
			array(
				'key' => 'field_hp_testi_1_quote',
				'label' => __( 'Testimonial 1 Quote', 'sibco' ),
				'name' => 'hp_testi_1_quote',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => '"Reliable manufacturing partner with consistently high product quality. Every shipment meets our specifications without exception."',
			),
			array(
				'key' => 'field_hp_testi_1_client',
				'label' => __( 'Testimonial 1 Client Name', 'sibco' ),
				'name' => 'hp_testi_1_client',
				'type' => 'text',
				'default_value' => 'Confidential',
			),
			array(
				'key' => 'field_hp_testi_1_market',
				'label' => __( 'Testimonial 1 Market / Description', 'sibco' ),
				'name' => 'hp_testi_1_market',
				'type' => 'text',
				'default_value' => 'European Home Products Importer',
			),
			array(
				'key' => 'field_hp_testi_1_rating',
				'label' => __( 'Testimonial 1 Rating (1-5 Stars)', 'sibco' ),
				'name' => 'hp_testi_1_rating',
				'type' => 'select',
				'choices' => array(
					'5' => '5 Stars',
					'4' => '4 Stars',
					'3' => '3 Stars',
				),
				'default_value' => '5',
			),
			// Testimonial 2
			array(
				'key' => 'field_hp_testi_2_quote',
				'label' => __( 'Testimonial 2 Quote', 'sibco' ),
				'name' => 'hp_testi_2_quote',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => '"Excellent communication and dependable deliveries. SIBCO understands the requirements of the North American market very well."',
			),
			array(
				'key' => 'field_hp_testi_2_client',
				'label' => __( 'Testimonial 2 Client Name', 'sibco' ),
				'name' => 'hp_testi_2_client',
				'type' => 'text',
				'default_value' => 'Confidential',
			),
			array(
				'key' => 'field_hp_testi_2_market',
				'label' => __( 'Testimonial 2 Market / Description', 'sibco' ),
				'name' => 'hp_testi_2_market',
				'type' => 'text',
				'default_value' => 'North American Distributor',
			),
			array(
				'key' => 'field_hp_testi_2_rating',
				'label' => __( 'Testimonial 2 Rating (1-5 Stars)', 'sibco' ),
				'name' => 'hp_testi_2_rating',
				'type' => 'select',
				'choices' => array(
					'5' => '5 Stars',
					'4' => '4 Stars',
					'3' => '3 Stars',
				),
				'default_value' => '5',
			),
			// Testimonial 3
			array(
				'key' => 'field_hp_testi_3_quote',
				'label' => __( 'Testimonial 3 Quote', 'sibco' ),
				'name' => 'hp_testi_3_quote',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => '"We\'ve been working with SIBCO for our private label coir mats for years. Their consistency and professionalism are unmatched in the industry."',
			),
			array(
				'key' => 'field_hp_testi_3_client',
				'label' => __( 'Testimonial 3 Client Name', 'sibco' ),
				'name' => 'hp_testi_3_client',
				'type' => 'text',
				'default_value' => 'Confidential',
			),
			array(
				'key' => 'field_hp_testi_3_market',
				'label' => __( 'Testimonial 3 Market / Description', 'sibco' ),
				'name' => 'hp_testi_3_market',
				'type' => 'text',
				'default_value' => 'European Retail Chain — Private Label',
			),
			array(
				'key' => 'field_hp_testi_3_rating',
				'label' => __( 'Testimonial 3 Rating (1-5 Stars)', 'sibco' ),
				'name' => 'hp_testi_3_rating',
				'type' => 'select',
				'choices' => array(
					'5' => '5 Stars',
					'4' => '4 Stars',
					'3' => '3 Stars',
				),
				'default_value' => '5',
			),

			// TAB 6: BOTTOM CTA SECTION
			array(
				'key' => 'field_hp_cta_tab',
				'label' => __( 'Bottom CTA Section', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_hp_cta_override',
				'label' => __( 'Customize Bottom CTA on Homepage', 'sibco' ),
				'name' => 'cta_override',
				'type' => 'true_false',
				'ui' => 1,
				'default_value' => 1,
			),
			array(
				'key' => 'field_hp_cta_badge',
				'label' => __( 'CTA Badge', 'sibco' ),
				'name' => 'cta_badge',
				'type' => 'text',
				'default_value' => 'Ready to Partner',
			),
			array(
				'key' => 'field_hp_cta_heading',
				'label' => __( 'CTA Heading', 'sibco' ),
				'name' => 'cta_heading',
				'type' => 'text',
				'default_value' => 'Looking for a Reliable Coir Mat Manufacturing Partner?',
			),
			array(
				'key' => 'field_hp_cta_description',
				'label' => __( 'CTA Description', 'sibco' ),
				'name' => 'cta_description',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => "Partner with SIBCO for high-quality natural coir mats backed by 26 years of manufacturing excellence. Let's discuss your requirements.",
			),
			array(
				'key' => 'field_hp_cta_btn1_text',
				'label' => __( 'Primary CTA Button Text', 'sibco' ),
				'name' => 'cta_btn1_text',
				'type' => 'text',
				'default_value' => 'Request Quote',
			),
			array(
				'key' => 'field_hp_cta_btn1_url',
				'label' => __( 'Primary CTA Button URL', 'sibco' ),
				'name' => 'cta_btn1_url',
				'type' => 'text',
				'default_value' => '/contact/',
			),
			array(
				'key' => 'field_hp_cta_btn2_text',
				'label' => __( 'Secondary CTA Button Text', 'sibco' ),
				'name' => 'cta_btn2_text',
				'type' => 'text',
				'default_value' => 'Contact Export Team',
			),
			array(
				'key' => 'field_hp_cta_btn2_url',
				'label' => __( 'Secondary CTA Button URL', 'sibco' ),
				'name' => 'cta_btn2_url',
				'type' => 'text',
				'default_value' => '/contact/',
			),
			array(
				'key' => 'field_hp_cta_bg_image',
				'label' => __( 'CTA Background Image', 'sibco' ),
				'name' => 'cta_background_image',
				'type' => 'image',
				'return_format' => 'array',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_type',
					'operator' => '==',
					'value' => 'front_page',
				),
			),
			array(
				array(
					'param' => 'page',
					'operator' => '==',
					'value' => '6',
				),
			),
		),
		'menu_order' => 10,
	) );

	// -------------------------------------------------------------
	// 4. ABOUT PAGE FIELDS (page-about.php)
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_about_page',
		'title' => __( 'About Page Content', 'sibco' ),
		'fields' => array(
			array(
				'key' => 'field_about_badge',
				'label' => __( 'Section Badge', 'sibco' ),
				'name' => 'about_badge',
				'type' => 'text',
				'default_value' => 'About SIBCO',
			),
			array(
				'key' => 'field_about_title',
				'label' => __( 'Section Heading', 'sibco' ),
				'name' => 'about_title',
				'type' => 'text',
				'default_value' => 'A Legacy of Premium Coir Manufacturing Since 1998',
			),
			array(
				'key' => 'field_about_image',
				'label' => __( 'About Feature Image', 'sibco' ),
				'name' => 'about_image',
				'type' => 'image',
				'return_format' => 'array',
			),
			array(
				'key' => 'field_about_stat_number',
				'label' => __( 'Floating Stat Number', 'sibco' ),
				'name' => 'about_stat_number',
				'type' => 'text',
				'default_value' => '26+',
			),
			array(
				'key' => 'field_about_stat_label',
				'label' => __( 'Floating Stat Label', 'sibco' ),
				'name' => 'about_stat_label',
				'type' => 'text',
				'default_value' => "Years of\nManufacturing",
			),
			array(
				'key' => 'field_about_content',
				'label' => __( 'About Content Paragraphs', 'sibco' ),
				'name' => 'about_content',
				'type' => 'wysiwyg',
				'toolbar' => 'basic',
				'media_upload' => 0,
			),
			array(
				'key' => 'field_about_key_points',
				'label' => __( 'Key Bullet Points', 'sibco' ),
				'name' => 'about_key_points',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => __( 'Add Key Point', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_about_point_text',
						'label' => __( 'Point Text', 'sibco' ),
						'name' => 'point_text',
						'type' => 'text',
					),
				),
			),
			array(
				'key' => 'field_about_cta_text',
				'label' => __( 'CTA Link Text', 'sibco' ),
				'name' => 'about_cta_text',
				'type' => 'text',
				'default_value' => 'Learn More About Us',
			),
			array(
				'key' => 'field_about_cta_url',
				'label' => __( 'CTA Link URL', 'sibco' ),
				'name' => 'about_cta_url',
				'type' => 'text',
				'default_value' => '/manufacturing/',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-about.php',
				),
			),
		),
		'menu_order' => 10,
	) );

	// -------------------------------------------------------------
	// 5. WHY SIBCO PAGE FIELDS (page-why-sibco.php) - NO REPEATERS
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_why_page',
		'title' => __( 'Why SIBCO Page Content', 'sibco' ),
		'fields' => array(
			// TAB 1: SECTION HEADER
			array(
				'key' => 'field_why_header_tab',
				'label' => __( 'Section Header', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_why_badge',
				'label' => __( 'Section Badge', 'sibco' ),
				'name' => 'why_badge',
				'type' => 'text',
				'default_value' => 'Why SIBCO',
			),
			array(
				'key' => 'field_why_title',
				'label' => __( 'Section Heading', 'sibco' ),
				'name' => 'why_title',
				'type' => 'text',
				'default_value' => 'Why International Buyers Choose SIBCO',
			),
			array(
				'key' => 'field_why_description',
				'label' => __( 'Section Subheading', 'sibco' ),
				'name' => 'why_description',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Decades of expertise, certified quality, and a manufacturing process built for global export standards.',
			),

			// TAB 2: 6 FEATURE CARDS (NO REPEATER - ACF FREE COMPATIBLE)
			array(
				'key' => 'field_why_cards_tab',
				'label' => __( 'Why Choose Feature Cards (6 Cards)', 'sibco' ),
				'type' => 'tab',
			),
			// Card 1
			array(
				'key' => 'field_why_card_1_title',
				'label' => __( 'Card 1 Title', 'sibco' ),
				'name' => 'why_card_1_title',
				'type' => 'text',
				'default_value' => '26 Years Manufacturing Experience',
			),
			array(
				'key' => 'field_why_card_1_desc',
				'label' => __( 'Card 1 Description', 'sibco' ),
				'name' => 'why_card_1_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Over two and a half decades of refined expertise in coir mat manufacturing, delivering consistent quality to global buyers year after year.',
			),
			array(
				'key' => 'field_why_card_1_icon',
				'label' => __( 'Card 1 Icon', 'sibco' ),
				'name' => 'why_card_1_icon',
				'type' => 'select',
				'choices' => array(
					'clock'   => 'Clock (26 Years Experience)',
					'leaf'    => 'Leaf (100% Natural Coir)',
					'shield'  => 'Shield (Talite Free Certified)',
					'chart'   => 'Chart (Consistent Quality)',
					'truck'   => 'Truck (Time-Bound Delivery)',
					'tag'     => 'Tag (OEM & Private Label)',
				),
				'default_value' => 'clock',
			),
			// Card 2
			array(
				'key' => 'field_why_card_2_title',
				'label' => __( 'Card 2 Title', 'sibco' ),
				'name' => 'why_card_2_title',
				'type' => 'text',
				'default_value' => '100% Natural Coir',
			),
			array(
				'key' => 'field_why_card_2_desc',
				'label' => __( 'Card 2 Description', 'sibco' ),
				'name' => 'why_card_2_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => "Sourced from the finest coconut husks, our coir is completely natural, biodegradable, and sustainably harvested from Kerala's coir belt.",
			),
			array(
				'key' => 'field_why_card_2_icon',
				'label' => __( 'Card 2 Icon', 'sibco' ),
				'name' => 'why_card_2_icon',
				'type' => 'select',
				'choices' => array(
					'clock'   => 'Clock (26 Years Experience)',
					'leaf'    => 'Leaf (100% Natural Coir)',
					'shield'  => 'Shield (Talite Free Certified)',
					'chart'   => 'Chart (Consistent Quality)',
					'truck'   => 'Truck (Time-Bound Delivery)',
					'tag'     => 'Tag (OEM & Private Label)',
				),
				'default_value' => 'leaf',
			),
			// Card 3
			array(
				'key' => 'field_why_card_3_title',
				'label' => __( 'Card 3 Title', 'sibco' ),
				'name' => 'why_card_3_title',
				'type' => 'text',
				'default_value' => 'Talite Free Certified',
			),
			array(
				'key' => 'field_why_card_3_desc',
				'label' => __( 'Card 3 Description', 'sibco' ),
				'name' => 'why_card_3_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Our products are certified talite-free, meeting stringent European import regulations and ensuring complete compliance for EU market entry.',
			),
			array(
				'key' => 'field_why_card_3_icon',
				'label' => __( 'Card 3 Icon', 'sibco' ),
				'name' => 'why_card_3_icon',
				'type' => 'select',
				'choices' => array(
					'clock'   => 'Clock (26 Years Experience)',
					'leaf'    => 'Leaf (100% Natural Coir)',
					'shield'  => 'Shield (Talite Free Certified)',
					'chart'   => 'Chart (Consistent Quality)',
					'truck'   => 'Truck (Time-Bound Delivery)',
					'tag'     => 'Tag (OEM & Private Label)',
				),
				'default_value' => 'shield',
			),
			// Card 4
			array(
				'key' => 'field_why_card_4_title',
				'label' => __( 'Card 4 Title', 'sibco' ),
				'name' => 'why_card_4_title',
				'type' => 'text',
				'default_value' => 'Consistent Product Quality',
			),
			array(
				'key' => 'field_why_card_4_desc',
				'label' => __( 'Card 4 Description', 'sibco' ),
				'name' => 'why_card_4_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Rigorous quality control at every stage of production ensures that every shipment meets the exact specifications and standards expected by international buyers.',
			),
			array(
				'key' => 'field_why_card_4_icon',
				'label' => __( 'Card 4 Icon', 'sibco' ),
				'name' => 'why_card_4_icon',
				'type' => 'select',
				'choices' => array(
					'clock'   => 'Clock (26 Years Experience)',
					'leaf'    => 'Leaf (100% Natural Coir)',
					'shield'  => 'Shield (Talite Free Certified)',
					'chart'   => 'Chart (Consistent Quality)',
					'truck'   => 'Truck (Time-Bound Delivery)',
					'tag'     => 'Tag (OEM & Private Label)',
				),
				'default_value' => 'chart',
			),
			// Card 5
			array(
				'key' => 'field_why_card_5_title',
				'label' => __( 'Card 5 Title', 'sibco' ),
				'name' => 'why_card_5_title',
				'type' => 'text',
				'default_value' => 'Time-Bound Delivery',
			),
			array(
				'key' => 'field_why_card_5_desc',
				'label' => __( 'Card 5 Description', 'sibco' ),
				'name' => 'why_card_5_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Our streamlined production scheduling and logistics management ensure every order is manufactured and dispatched within agreed timelines, without exception.',
			),
			array(
				'key' => 'field_why_card_5_icon',
				'label' => __( 'Card 5 Icon', 'sibco' ),
				'name' => 'why_card_5_icon',
				'type' => 'select',
				'choices' => array(
					'clock'   => 'Clock (26 Years Experience)',
					'leaf'    => 'Leaf (100% Natural Coir)',
					'shield'  => 'Shield (Talite Free Certified)',
					'chart'   => 'Chart (Consistent Quality)',
					'truck'   => 'Truck (Time-Bound Delivery)',
					'tag'     => 'Tag (OEM & Private Label)',
				),
				'default_value' => 'truck',
			),
			// Card 6
			array(
				'key' => 'field_why_card_6_title',
				'label' => __( 'Card 6 Title', 'sibco' ),
				'name' => 'why_card_6_title',
				'type' => 'text',
				'default_value' => 'OEM & Private Label',
			),
			array(
				'key' => 'field_why_card_6_desc',
				'label' => __( 'Card 6 Description', 'sibco' ),
				'name' => 'why_card_6_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Complete private label and OEM manufacturing capabilities with full confidentiality. Your brand, your specifications, our manufacturing expertise.',
			),
			array(
				'key' => 'field_why_card_6_icon',
				'label' => __( 'Card 6 Icon', 'sibco' ),
				'name' => 'why_card_6_icon',
				'type' => 'select',
				'choices' => array(
					'clock'   => 'Clock (26 Years Experience)',
					'leaf'    => 'Leaf (100% Natural Coir)',
					'shield'  => 'Shield (Talite Free Certified)',
					'chart'   => 'Chart (Consistent Quality)',
					'truck'   => 'Truck (Time-Bound Delivery)',
					'tag'     => 'Tag (OEM & Private Label)',
				),
				'default_value' => 'tag',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-why-sibco.php',
				),
			),
			array(
				array(
					'param' => 'page',
					'operator' => '==',
					'value' => '8',
				),
			),
		),
		'menu_order' => 10,
	) );

	// -------------------------------------------------------------
	// 6. MANUFACTURING PAGE FIELDS (page-manufacturing.php)
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_manufacturing_page',
		'title' => __( 'Manufacturing Page Content', 'sibco' ),
		'fields' => array(
			// Tab: Section Header
			array(
				'key' => 'field_mfg_header_tab',
				'label' => __( 'Section Header', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_manufacturing_badge',
				'label' => __( 'Section Badge', 'sibco' ),
				'name' => 'manufacturing_badge',
				'type' => 'text',
				'default_value' => 'Manufacturing',
			),
			array(
				'key' => 'field_manufacturing_title',
				'label' => __( 'Section Title', 'sibco' ),
				'name' => 'manufacturing_title',
				'type' => 'text',
				'default_value' => 'Manufacturing Excellence',
			),
			array(
				'key' => 'field_manufacturing_description',
				'label' => __( 'Section Description', 'sibco' ),
				'name' => 'manufacturing_description',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'From raw coir fibre to finished export-ready products — every step is controlled, measured, and quality-assured.',
			),

			// Tab: 4 Process Steps
			array(
				'key' => 'field_mfg_steps_tab',
				'label' => __( '4 Process Steps', 'sibco' ),
				'type' => 'tab',
			),
			// Step 1
			array(
				'key' => 'field_mfg_step_1_num',
				'label' => __( 'Step 1 Number', 'sibco' ),
				'name' => 'mfg_step_1_num',
				'type' => 'text',
				'default_value' => '01',
			),
			array(
				'key' => 'field_mfg_step_1_title',
				'label' => __( 'Step 1 Title', 'sibco' ),
				'name' => 'mfg_step_1_title',
				'type' => 'text',
				'default_value' => 'Raw Material Sourcing',
			),
			array(
				'key' => 'field_mfg_step_1_desc',
				'label' => __( 'Step 1 Description', 'sibco' ),
				'name' => 'mfg_step_1_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => "Premium coconut coir fibres are carefully selected from Kerala's finest plantations. Each batch is tested for fibre length, strength, and moisture content before entering production.",
			),
			array(
				'key' => 'field_mfg_step_1_image',
				'label' => __( 'Step 1 Image', 'sibco' ),
				'name' => 'mfg_step_1_image',
				'type' => 'image',
				'return_format' => 'array',
			),
			array(
				'key' => 'field_mfg_step_1_tags',
				'label' => __( 'Step 1 Tags (comma-separated)', 'sibco' ),
				'name' => 'mfg_step_1_tags',
				'type' => 'text',
				'default_value' => 'Fibre Testing, Moisture Control, Grade Selection',
			),
			// Step 2
			array(
				'key' => 'field_mfg_step_2_num',
				'label' => __( 'Step 2 Number', 'sibco' ),
				'name' => 'mfg_step_2_num',
				'type' => 'text',
				'default_value' => '02',
			),
			array(
				'key' => 'field_mfg_step_2_title',
				'label' => __( 'Step 2 Title', 'sibco' ),
				'name' => 'mfg_step_2_title',
				'type' => 'text',
				'default_value' => 'Coir Processing & Weaving',
			),
			array(
				'key' => 'field_mfg_step_2_desc',
				'label' => __( 'Step 2 Description', 'sibco' ),
				'name' => 'mfg_step_2_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Fibres undergo spinning, weaving, and mat formation on precision machinery. Our skilled workforce ensures consistent weave density, pattern accuracy, and dimensional stability across every production run.',
			),
			array(
				'key' => 'field_mfg_step_2_image',
				'label' => __( 'Step 2 Image', 'sibco' ),
				'name' => 'mfg_step_2_image',
				'type' => 'image',
				'return_format' => 'array',
			),
			array(
				'key' => 'field_mfg_step_2_tags',
				'label' => __( 'Step 2 Tags (comma-separated)', 'sibco' ),
				'name' => 'mfg_step_2_tags',
				'type' => 'text',
				'default_value' => 'Precision Weaving, Pattern Control, Skilled Workforce',
			),
			// Step 3
			array(
				'key' => 'field_mfg_step_3_num',
				'label' => __( 'Step 3 Number', 'sibco' ),
				'name' => 'mfg_step_3_num',
				'type' => 'text',
				'default_value' => '03',
			),
			array(
				'key' => 'field_mfg_step_3_title',
				'label' => __( 'Step 3 Title', 'sibco' ),
				'name' => 'mfg_step_3_title',
				'type' => 'text',
				'default_value' => 'Rubber Backing & Embossing',
			),
			array(
				'key' => 'field_mfg_step_3_desc',
				'label' => __( 'Step 3 Description', 'sibco' ),
				'name' => 'mfg_step_3_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Vulcanized rubber backing is applied using temperature-controlled hydraulic presses. Custom embossing dies create branded patterns and textures with precision, ensuring every mat meets buyer specifications.',
			),
			array(
				'key' => 'field_mfg_step_3_image',
				'label' => __( 'Step 3 Image', 'sibco' ),
				'name' => 'mfg_step_3_image',
				'type' => 'image',
				'return_format' => 'array',
			),
			array(
				'key' => 'field_mfg_step_3_tags',
				'label' => __( 'Step 3 Tags (comma-separated)', 'sibco' ),
				'name' => 'mfg_step_3_tags',
				'type' => 'text',
				'default_value' => 'Vulcanized Rubber, Custom Embossing, Hydraulic Press',
			),
			// Step 4
			array(
				'key' => 'field_mfg_step_4_num',
				'label' => __( 'Step 4 Number', 'sibco' ),
				'name' => 'mfg_step_4_num',
				'type' => 'text',
				'default_value' => '04',
			),
			array(
				'key' => 'field_mfg_step_4_title',
				'label' => __( 'Step 4 Title', 'sibco' ),
				'name' => 'mfg_step_4_title',
				'type' => 'text',
				'default_value' => 'Quality Inspection & Export Dispatch',
			),
			array(
				'key' => 'field_mfg_step_4_desc',
				'label' => __( 'Step 4 Description', 'sibco' ),
				'name' => 'mfg_step_4_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Every batch undergoes thorough quality inspection — checking dimensions, weight, backing adhesion, and visual standards. Products are then carefully packed for international sea freight with full documentation.',
			),
			array(
				'key' => 'field_mfg_step_4_image',
				'label' => __( 'Step 4 Image', 'sibco' ),
				'name' => 'mfg_step_4_image',
				'type' => 'image',
				'return_format' => 'array',
			),
			array(
				'key' => 'field_mfg_step_4_tags',
				'label' => __( 'Step 4 Tags (comma-separated)', 'sibco' ),
				'name' => 'mfg_step_4_tags',
				'type' => 'text',
				'default_value' => 'Final QC Check, Export Packing, Documentation',
			),

			// Tab: Pipeline & Facility Stats
			array(
				'key' => 'field_mfg_pipeline_tab',
				'label' => __( 'Pipeline Timeline & Stats', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_pipeline_title',
				'label' => __( 'Pipeline Timeline Title', 'sibco' ),
				'name' => 'pipeline_title',
				'type' => 'text',
				'default_value' => 'Complete Production Pipeline',
			),
			// 7 Pipeline Steps
			array(
				'key' => 'field_pipeline_step_1',
				'label' => __( 'Pipeline Step 1 Name', 'sibco' ),
				'name' => 'pipeline_step_1',
				'type' => 'text',
				'default_value' => 'Raw Material',
			),
			array(
				'key' => 'field_pipeline_step_2',
				'label' => __( 'Pipeline Step 2 Name', 'sibco' ),
				'name' => 'pipeline_step_2',
				'type' => 'text',
				'default_value' => 'Processing',
			),
			array(
				'key' => 'field_pipeline_step_3',
				'label' => __( 'Pipeline Step 3 Name', 'sibco' ),
				'name' => 'pipeline_step_3',
				'type' => 'text',
				'default_value' => 'Weaving',
			),
			array(
				'key' => 'field_pipeline_step_4',
				'label' => __( 'Pipeline Step 4 Name', 'sibco' ),
				'name' => 'pipeline_step_4',
				'type' => 'text',
				'default_value' => 'Rubber Backing',
			),
			array(
				'key' => 'field_pipeline_step_5',
				'label' => __( 'Pipeline Step 5 Name', 'sibco' ),
				'name' => 'pipeline_step_5',
				'type' => 'text',
				'default_value' => 'Embossing',
			),
			array(
				'key' => 'field_pipeline_step_6',
				'label' => __( 'Pipeline Step 6 Name', 'sibco' ),
				'name' => 'pipeline_step_6',
				'type' => 'text',
				'default_value' => 'QC & Packing',
			),
			array(
				'key' => 'field_pipeline_step_7',
				'label' => __( 'Pipeline Step 7 Name', 'sibco' ),
				'name' => 'pipeline_step_7',
				'type' => 'text',
				'default_value' => 'Export Dispatch',
			),
			// 4 Facility Stats
			array(
				'key' => 'field_mfg_stat_1_val',
				'label' => __( 'Facility Stat 1 Value/Highlight', 'sibco' ),
				'name' => 'mfg_stat_1_val',
				'type' => 'text',
				'default_value' => 'Modern',
			),
			array(
				'key' => 'field_mfg_stat_1_lbl',
				'label' => __( 'Facility Stat 1 Label', 'sibco' ),
				'name' => 'mfg_stat_1_lbl',
				'type' => 'text',
				'default_value' => 'Production Facility',
			),
			array(
				'key' => 'field_mfg_stat_2_val',
				'label' => __( 'Facility Stat 2 Value/Highlight', 'sibco' ),
				'name' => 'mfg_stat_2_val',
				'type' => 'text',
				'default_value' => 'Skilled',
			),
			array(
				'key' => 'field_mfg_stat_2_lbl',
				'label' => __( 'Facility Stat 2 Label', 'sibco' ),
				'name' => 'mfg_stat_2_lbl',
				'type' => 'text',
				'default_value' => 'Trained Workforce',
			),
			array(
				'key' => 'field_mfg_stat_3_val',
				'label' => __( 'Facility Stat 3 Value/Highlight', 'sibco' ),
				'name' => 'mfg_stat_3_val',
				'type' => 'text',
				'default_value' => 'Controlled',
			),
			array(
				'key' => 'field_mfg_stat_3_lbl',
				'label' => __( 'Facility Stat 3 Label', 'sibco' ),
				'name' => 'mfg_stat_3_lbl',
				'type' => 'text',
				'default_value' => 'Quality Manufacturing',
			),
			array(
				'key' => 'field_mfg_stat_4_val',
				'label' => __( 'Facility Stat 4 Value/Highlight', 'sibco' ),
				'name' => 'mfg_stat_4_val',
				'type' => 'text',
				'default_value' => 'International',
			),
			array(
				'key' => 'field_mfg_stat_4_lbl',
				'label' => __( 'Facility Stat 4 Label', 'sibco' ),
				'name' => 'mfg_stat_4_lbl',
				'type' => 'text',
				'default_value' => 'Export Standards',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-manufacturing.php',
				),
			),
			array(
				array(
					'param' => 'page',
					'operator' => '==',
					'value' => '9',
				),
			),
		),
		'menu_order' => 10,
	) );

	// -------------------------------------------------------------
	// 7. PRODUCTS PAGE FIELDS (page-products.php)
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_products_page',
		'title' => __( 'Products Page Content', 'sibco' ),
		'fields' => array(
			array(
				'key' => 'field_prod_intro_tab',
				'label' => __( 'Category Grid Header', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_products_badge',
				'label' => __( 'Section Badge', 'sibco' ),
				'name' => 'products_badge',
				'type' => 'text',
				'default_value' => 'Product Range',
			),
			array(
				'key' => 'field_products_title',
				'label' => __( 'Section Heading', 'sibco' ),
				'name' => 'products_title',
				'type' => 'text',
				'default_value' => 'Premium Coir Mat Categories',
			),
			array(
				'key' => 'field_products_description',
				'label' => __( 'Section Subtitle', 'sibco' ),
				'name' => 'products_description',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Our comprehensive range of coir mats is designed to meet diverse international market requirements, available in custom sizes and specifications.',
			),
			array(
				'key' => 'field_prod_process_tab',
				'label' => __( 'How It Works (B2B Process)', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_process_badge',
				'label' => __( 'Process Badge', 'sibco' ),
				'name' => 'process_badge',
				'type' => 'text',
				'default_value' => 'How It Works',
			),
			array(
				'key' => 'field_process_title',
				'label' => __( 'Process Heading', 'sibco' ),
				'name' => 'process_title',
				'type' => 'text',
				'default_value' => 'Simple B2B Export Process',
			),
			array(
				'key' => 'field_process_description',
				'label' => __( 'Process Subtitle', 'sibco' ),
				'name' => 'process_description',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'From initial enquiry to global delivery — our streamlined process makes international sourcing effortless.',
			),
			// Step 1
			array(
				'key' => 'field_process_step_1_num',
				'label' => __( 'Step 1 Number', 'sibco' ),
				'name' => 'process_step_1_num',
				'type' => 'text',
				'default_value' => 'Step 01',
			),
			array(
				'key' => 'field_process_step_1_title',
				'label' => __( 'Step 1 Title', 'sibco' ),
				'name' => 'process_step_1_title',
				'type' => 'text',
				'default_value' => 'Send Enquiry',
			),
			array(
				'key' => 'field_process_step_1_desc',
				'label' => __( 'Step 1 Description', 'sibco' ),
				'name' => 'process_step_1_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Contact our export team with your product requirements, specifications, and estimated quantities.',
			),
			array(
				'key' => 'field_process_step_1_icon',
				'label' => __( 'Step 1 Icon', 'sibco' ),
				'name' => 'process_step_1_icon',
				'type' => 'select',
				'choices' => array(
					'mail'  => 'Mail / Enquiry',
					'chat'  => 'Chat / Discussion',
					'box'   => 'Box / Manufacturing',
					'truck' => 'Truck / Global Delivery',
				),
				'default_value' => 'mail',
			),
			// Step 2
			array(
				'key' => 'field_process_step_2_num',
				'label' => __( 'Step 2 Number', 'sibco' ),
				'name' => 'process_step_2_num',
				'type' => 'text',
				'default_value' => 'Step 02',
			),
			array(
				'key' => 'field_process_step_2_title',
				'label' => __( 'Step 2 Title', 'sibco' ),
				'name' => 'process_step_2_title',
				'type' => 'text',
				'default_value' => 'Product Discussion',
			),
			array(
				'key' => 'field_process_step_2_desc',
				'label' => __( 'Step 2 Description', 'sibco' ),
				'name' => 'process_step_2_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'We discuss technical details, provide samples if needed, and finalize pricing, timelines, and specifications.',
			),
			array(
				'key' => 'field_process_step_2_icon',
				'label' => __( 'Step 2 Icon', 'sibco' ),
				'name' => 'process_step_2_icon',
				'type' => 'select',
				'choices' => array(
					'mail'  => 'Mail / Enquiry',
					'chat'  => 'Chat / Discussion',
					'box'   => 'Box / Manufacturing',
					'truck' => 'Truck / Global Delivery',
				),
				'default_value' => 'chat',
			),
			// Step 3
			array(
				'key' => 'field_process_step_3_num',
				'label' => __( 'Step 3 Number', 'sibco' ),
				'name' => 'process_step_3_num',
				'type' => 'text',
				'default_value' => 'Step 03',
			),
			array(
				'key' => 'field_process_step_3_title',
				'label' => __( 'Step 3 Title', 'sibco' ),
				'name' => 'process_step_3_title',
				'type' => 'text',
				'default_value' => 'Manufacturing',
			),
			array(
				'key' => 'field_process_step_3_desc',
				'label' => __( 'Step 3 Description', 'sibco' ),
				'name' => 'process_step_3_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Your order enters production with quality checkpoints at every stage. Progress updates provided throughout.',
			),
			array(
				'key' => 'field_process_step_3_icon',
				'label' => __( 'Step 3 Icon', 'sibco' ),
				'name' => 'process_step_3_icon',
				'type' => 'select',
				'choices' => array(
					'mail'  => 'Mail / Enquiry',
					'chat'  => 'Chat / Discussion',
					'box'   => 'Box / Manufacturing',
					'truck' => 'Truck / Global Delivery',
				),
				'default_value' => 'box',
			),
			// Step 4
			array(
				'key' => 'field_process_step_4_num',
				'label' => __( 'Step 4 Number', 'sibco' ),
				'name' => 'process_step_4_num',
				'type' => 'text',
				'default_value' => 'Step 04',
			),
			array(
				'key' => 'field_process_step_4_title',
				'label' => __( 'Step 4 Title', 'sibco' ),
				'name' => 'process_step_4_title',
				'type' => 'text',
				'default_value' => 'Global Delivery',
			),
			array(
				'key' => 'field_process_step_4_desc',
				'label' => __( 'Step 4 Description', 'sibco' ),
				'name' => 'process_step_4_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Finished goods are export-packed and shipped to your destination port with complete documentation and tracking.',
			),
			array(
				'key' => 'field_process_step_4_icon',
				'label' => __( 'Step 4 Icon', 'sibco' ),
				'name' => 'process_step_4_icon',
				'type' => 'select',
				'choices' => array(
					'mail'  => 'Mail / Enquiry',
					'chat'  => 'Chat / Discussion',
					'box'   => 'Box / Manufacturing',
					'truck' => 'Truck / Global Delivery',
				),
				'default_value' => 'truck',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-products.php',
				),
			),
			array(
				array(
					'param' => 'page',
					'operator' => '==',
					'value' => '10',
				),
			),
		),
		'menu_order' => 10,
	) );

	// -------------------------------------------------------------
	// 7B. PRODUCT CATEGORY FIELDS (taxonomy: product_cat)
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_product_category',
		'title' => __( 'Product Category Details', 'sibco' ),
		'fields' => array(
			array(
				'key' => 'field_cat_image',
				'label' => __( 'Category Display Image', 'sibco' ),
				'name' => 'category_image',
				'type' => 'image',
				'return_format' => 'array',
				'instructions' => __( 'Upload high-resolution category hero image (e.g. 600x400)', 'sibco' ),
			),
			array(
				'key' => 'field_cat_badge',
				'label' => __( 'Badge / Category Tag', 'sibco' ),
				'name' => 'category_badge',
				'type' => 'text',
				'instructions' => __( 'Optional badge (e.g. "Export Grade", "Top Seller")', 'sibco' ),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'product_cat',
				),
			),
		),
		'menu_order' => 10,
	) );

	// -------------------------------------------------------------
	// 7C. SINGLE PRODUCT SPECIFICATIONS (post_type: sibco_product)
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_single_product',
		'title' => __( 'Product Technical Specifications', 'sibco' ),
		'fields' => array(
			array(
				'key' => 'field_prod_spec_tab',
				'label' => __( 'Product Specifications', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_product_material',
				'label' => __( 'Material Composition', 'sibco' ),
				'name' => 'product_material',
				'type' => 'text',
				'instructions' => __( 'e.g. 100% Natural Coir Fiber with Talite-Free Vulcanized Rubber', 'sibco' ),
				'default_value' => '100% Natural Coir Fiber',
			),
			array(
				'key' => 'field_product_thickness',
				'label' => __( 'Standard Thickness', 'sibco' ),
				'name' => 'product_thickness',
				'type' => 'text',
				'instructions' => __( 'e.g. 15mm, 18mm, 22mm (Custom available)', 'sibco' ),
				'default_value' => '15mm - 22mm',
			),
			array(
				'key' => 'field_product_sizes',
				'label' => __( 'Standard Sizes / Dimensions', 'sibco' ),
				'name' => 'product_sizes',
				'type' => 'text',
				'instructions' => __( 'e.g. 40x60 cm, 45x75 cm, 60x90 cm, Rolls up to 2m width', 'sibco' ),
				'default_value' => '40x60cm, 45x75cm, Custom',
			),
			array(
				'key' => 'field_product_backing',
				'label' => __( 'Backing / Construction', 'sibco' ),
				'name' => 'product_backing',
				'type' => 'text',
				'instructions' => __( 'e.g. Natural Latex / Talite-Free Rubber', 'sibco' ),
				'default_value' => 'Talite-Free Natural Rubber',
			),
			array(
				'key' => 'field_product_moq',
				'label' => __( 'Minimum Order Quantity (MOQ)', 'sibco' ),
				'name' => 'product_moq',
				'type' => 'text',
				'instructions' => __( 'e.g. 500 pcs or 1 x 20ft FCL', 'sibco' ),
				'default_value' => '500 pcs / 1x20ft FCL',
			),
			array(
				'key' => 'field_product_packaging',
				'label' => __( 'Export Packaging', 'sibco' ),
				'name' => 'product_packaging',
				'type' => 'text',
				'instructions' => __( 'e.g. Palletized / Carton Pack / Bulk Bale', 'sibco' ),
				'default_value' => 'Palletized Export Pack',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'sibco_product',
				),
			),
		),
		'menu_order' => 10,
	) );

	// -------------------------------------------------------------
	// 8. QUALITY PAGE FIELDS (page-quality.php) - NO REPEATERS
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_quality_page',
		'title' => __( 'Quality Page Content', 'sibco' ),
		'fields' => array(
			// TAB 1: Header & Narrative
			array(
				'key' => 'field_quality_header_tab',
				'label' => __( 'Quality Header & Process', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_quality_badge',
				'label' => __( 'Section Badge', 'sibco' ),
				'name' => 'quality_badge',
				'type' => 'text',
				'default_value' => 'Quality & Certifications',
			),
			array(
				'key' => 'field_quality_title',
				'label' => __( 'Section Heading', 'sibco' ),
				'name' => 'quality_title',
				'type' => 'text',
				'default_value' => 'Certified Quality for Global Markets',
			),
			array(
				'key' => 'field_quality_description',
				'label' => __( 'Section Subheading', 'sibco' ),
				'name' => 'quality_description',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Every product leaving our facility meets international quality standards backed by recognized certifications.',
			),
			array(
				'key' => 'field_quality_process_title',
				'label' => __( 'Quality Process Heading', 'sibco' ),
				'name' => 'quality_process_title',
				'type' => 'text',
				'default_value' => "Quality Is Not an Act — It's a Process at Every Stage",
			),
			array(
				'key' => 'field_quality_process_text',
				'label' => __( 'Quality Process Narrative', 'sibco' ),
				'name' => 'quality_process_text',
				'type' => 'textarea',
				'rows' => 6,
				'default_value' => "At SIBCO, quality assurance begins before production starts. Every batch of raw coir fibre is tested for critical parameters including fibre length, tensile strength, moisture content, and cleanliness.\n\nDuring production, in-line quality checks monitor weave density, dimensional accuracy, rubber backing adhesion, and embossing depth. Our quality team conducts random sampling at defined intervals to ensure process consistency.\n\nFinal inspection covers every aspect — dimensions, weight, visual appearance, backing integrity, and packaging compliance. Only products that pass all checkpoints are approved for export dispatch.",
			),

			// TAB 2: 4 Certification Badges
			array(
				'key' => 'field_quality_badges_tab',
				'label' => __( '4 Certification Badges', 'sibco' ),
				'type' => 'tab',
			),
			// Badge 1
			array(
				'key' => 'field_cert_1_title',
				'label' => __( 'Badge 1 Title', 'sibco' ),
				'name' => 'cert_1_title',
				'type' => 'text',
				'default_value' => 'Talite Free Certified',
			),
			array(
				'key' => 'field_cert_1_desc',
				'label' => __( 'Badge 1 Description', 'sibco' ),
				'name' => 'cert_1_desc',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Compliant with EU talite-free import requirements for coir products',
			),
			array(
				'key' => 'field_cert_1_icon',
				'label' => __( 'Badge 1 Icon', 'sibco' ),
				'name' => 'cert_1_icon',
				'type' => 'select',
				'choices' => array(
					'talite'  => 'Talite Free / Checkmark',
					'board'   => 'Rubber Board / Document',
					'qc'      => 'Consistent QC / Bars',
					'export'  => 'Export Standards / Globe',
				),
				'default_value' => 'talite',
			),
			// Badge 2
			array(
				'key' => 'field_cert_2_title',
				'label' => __( 'Badge 2 Title', 'sibco' ),
				'name' => 'cert_2_title',
				'type' => 'text',
				'default_value' => 'Rubber Board Registered',
			),
			array(
				'key' => 'field_cert_2_desc',
				'label' => __( 'Badge 2 Description', 'sibco' ),
				'name' => 'cert_2_desc',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Officially registered with the Rubber Board of India for rubber-backed products',
			),
			array(
				'key' => 'field_cert_2_icon',
				'label' => __( 'Badge 2 Icon', 'sibco' ),
				'name' => 'cert_2_icon',
				'type' => 'select',
				'choices' => array(
					'talite'  => 'Talite Free / Checkmark',
					'board'   => 'Rubber Board / Document',
					'qc'      => 'Consistent QC / Bars',
					'export'  => 'Export Standards / Globe',
				),
				'default_value' => 'board',
			),
			// Badge 3
			array(
				'key' => 'field_cert_3_title',
				'label' => __( 'Badge 3 Title', 'sibco' ),
				'name' => 'cert_3_title',
				'type' => 'text',
				'default_value' => 'Consistent QC',
			),
			array(
				'key' => 'field_cert_3_desc',
				'label' => __( 'Badge 3 Description', 'sibco' ),
				'name' => 'cert_3_desc',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Multi-stage quality control ensuring zero-defect shipments',
			),
			array(
				'key' => 'field_cert_3_icon',
				'label' => __( 'Badge 3 Icon', 'sibco' ),
				'name' => 'cert_3_icon',
				'type' => 'select',
				'choices' => array(
					'talite'  => 'Talite Free / Checkmark',
					'board'   => 'Rubber Board / Document',
					'qc'      => 'Consistent QC / Bars',
					'export'  => 'Export Standards / Globe',
				),
				'default_value' => 'qc',
			),
			// Badge 4
			array(
				'key' => 'field_cert_4_title',
				'label' => __( 'Badge 4 Title', 'sibco' ),
				'name' => 'cert_4_title',
				'type' => 'text',
				'default_value' => 'Export Standards',
			),
			array(
				'key' => 'field_cert_4_desc',
				'label' => __( 'Badge 4 Description', 'sibco' ),
				'name' => 'cert_4_desc',
				'type' => 'textarea',
				'rows' => 2,
				'default_value' => 'Products manufactured to meet EU and US import standards',
			),
			array(
				'key' => 'field_cert_4_icon',
				'label' => __( 'Badge 4 Icon', 'sibco' ),
				'name' => 'cert_4_icon',
				'type' => 'select',
				'choices' => array(
					'talite'  => 'Talite Free / Checkmark',
					'board'   => 'Rubber Board / Document',
					'qc'      => 'Consistent QC / Bars',
					'export'  => 'Export Standards / Globe',
				),
				'default_value' => 'export',
			),

			// TAB 3: 3 Quality Metrics
			array(
				'key' => 'field_quality_metrics_tab',
				'label' => __( '3 Quality Metrics', 'sibco' ),
				'type' => 'tab',
			),
			// Metric 1
			array(
				'key' => 'field_qm_1_val',
				'label' => __( 'Metric 1 Value (e.g. 100%)', 'sibco' ),
				'name' => 'qm_1_val',
				'type' => 'text',
				'default_value' => '100%',
			),
			array(
				'key' => 'field_qm_1_lbl',
				'label' => __( 'Metric 1 Label (e.g. Inspection Rate)', 'sibco' ),
				'name' => 'qm_1_lbl',
				'type' => 'text',
				'default_value' => 'Inspection Rate',
			),
			// Metric 2
			array(
				'key' => 'field_qm_2_val',
				'label' => __( 'Metric 2 Value (e.g. Zero)', 'sibco' ),
				'name' => 'qm_2_val',
				'type' => 'text',
				'default_value' => 'Zero',
			),
			array(
				'key' => 'field_qm_2_lbl',
				'label' => __( 'Metric 2 Label (e.g. Quality Claims)', 'sibco' ),
				'name' => 'qm_2_lbl',
				'type' => 'text',
				'default_value' => 'Quality Claims',
			),
			// Metric 3
			array(
				'key' => 'field_qm_3_val',
				'label' => __( 'Metric 3 Value (e.g. Multi)', 'sibco' ),
				'name' => 'qm_3_val',
				'type' => 'text',
				'default_value' => 'Multi',
			),
			array(
				'key' => 'field_qm_3_lbl',
				'label' => __( 'Metric 3 Label (e.g. Stage QC)', 'sibco' ),
				'name' => 'qm_3_lbl',
				'type' => 'text',
				'default_value' => 'Stage QC',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-quality.php',
				),
			),
			array(
				array(
					'param' => 'page',
					'operator' => '==',
					'value' => '11',
				),
			),
		),
		'menu_order' => 10,
	) );

	// -------------------------------------------------------------
	// 9. SUSTAINABILITY PAGE FIELDS (page-sustainability.php) - NO REPEATERS
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_sustainability_page',
		'title' => __( 'Sustainability Page Content', 'sibco' ),
		'fields' => array(
			// TAB 1: Header & Feature Media
			array(
				'key' => 'field_sust_header_tab',
				'label' => __( 'Header & Feature Media', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_sustainability_badge',
				'label' => __( 'Section Badge', 'sibco' ),
				'name' => 'sustainability_badge',
				'type' => 'text',
				'default_value' => 'Sustainability',
			),
			array(
				'key' => 'field_sustainability_title',
				'label' => __( 'Section Heading', 'sibco' ),
				'name' => 'sustainability_title',
				'type' => 'text',
				'default_value' => 'Naturally Sustainable. Responsibly Manufactured.',
			),
			array(
				'key' => 'field_sustainability_description',
				'label' => __( 'Section Subheading', 'sibco' ),
				'name' => 'sustainability_description',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Our commitment to sustainability goes beyond using natural materials. Every aspect of our manufacturing process is designed to minimize environmental impact while delivering premium quality products.',
			),
			array(
				'key' => 'field_sustainability_image',
				'label' => __( 'Sustainability Feature Image', 'sibco' ),
				'name' => 'sustainability_image',
				'type' => 'image',
				'return_format' => 'array',
			),
			array(
				'key' => 'field_sustainability_badge_stat',
				'label' => __( 'Floating Eco Badge Stat', 'sibco' ),
				'name' => 'sustainability_badge_stat',
				'type' => 'text',
				'default_value' => '100%',
			),
			array(
				'key' => 'field_sustainability_badge_text',
				'label' => __( 'Floating Eco Badge Text', 'sibco' ),
				'name' => 'sustainability_badge_text',
				'type' => 'text',
				'default_value' => "Natural &\nBiodegradable",
			),

			// TAB 2: 4 Sustainability Pillars
			array(
				'key' => 'field_sust_pillars_tab',
				'label' => __( '4 Sustainability Pillars', 'sibco' ),
				'type' => 'tab',
			),
			// Pillar 1
			array(
				'key' => 'field_pillar_1_title',
				'label' => __( 'Pillar 1 Title', 'sibco' ),
				'name' => 'pillar_1_title',
				'type' => 'text',
				'default_value' => 'Natural Renewable Coir',
			),
			array(
				'key' => 'field_pillar_1_desc',
				'label' => __( 'Pillar 1 Description', 'sibco' ),
				'name' => 'pillar_1_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Coir is a naturally renewable resource extracted from coconut husks, making it one of the most sustainable raw materials available.',
			),
			array(
				'key' => 'field_pillar_1_icon',
				'label' => __( 'Pillar 1 Icon', 'sibco' ),
				'name' => 'pillar_1_icon',
				'type' => 'select',
				'choices' => array(
					'leaf'    => 'Leaf / Natural Renewable',
					'users'   => 'Users / Eco Manufacturing',
					'shield'  => 'Shield / Responsible Production',
					'recycle' => 'Recycle / Biodegradable',
				),
				'default_value' => 'leaf',
			),
			// Pillar 2
			array(
				'key' => 'field_pillar_2_title',
				'label' => __( 'Pillar 2 Title', 'sibco' ),
				'name' => 'pillar_2_title',
				'type' => 'text',
				'default_value' => 'Eco-Friendly Manufacturing',
			),
			array(
				'key' => 'field_pillar_2_desc',
				'label' => __( 'Pillar 2 Description', 'sibco' ),
				'name' => 'pillar_2_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Our production processes minimize waste and energy consumption, adhering to environmentally responsible manufacturing practices.',
			),
			array(
				'key' => 'field_pillar_2_icon',
				'label' => __( 'Pillar 2 Icon', 'sibco' ),
				'name' => 'pillar_2_icon',
				'type' => 'select',
				'choices' => array(
					'leaf'    => 'Leaf / Natural Renewable',
					'users'   => 'Users / Eco Manufacturing',
					'shield'  => 'Shield / Responsible Production',
					'recycle' => 'Recycle / Biodegradable',
				),
				'default_value' => 'users',
			),
			// Pillar 3
			array(
				'key' => 'field_pillar_3_title',
				'label' => __( 'Pillar 3 Title', 'sibco' ),
				'name' => 'pillar_3_title',
				'type' => 'text',
				'default_value' => 'Responsible Production',
			),
			array(
				'key' => 'field_pillar_3_desc',
				'label' => __( 'Pillar 3 Description', 'sibco' ),
				'name' => 'pillar_3_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'From sourcing to dispatch, we maintain ethical production standards that support local communities and protect the environment.',
			),
			array(
				'key' => 'field_pillar_3_icon',
				'label' => __( 'Pillar 3 Icon', 'sibco' ),
				'name' => 'pillar_3_icon',
				'type' => 'select',
				'choices' => array(
					'leaf'    => 'Leaf / Natural Renewable',
					'users'   => 'Users / Eco Manufacturing',
					'shield'  => 'Shield / Responsible Production',
					'recycle' => 'Recycle / Biodegradable',
				),
				'default_value' => 'shield',
			),
			// Pillar 4
			array(
				'key' => 'field_pillar_4_title',
				'label' => __( 'Pillar 4 Title', 'sibco' ),
				'name' => 'pillar_4_title',
				'type' => 'text',
				'default_value' => 'Biodegradable Products',
			),
			array(
				'key' => 'field_pillar_4_desc',
				'label' => __( 'Pillar 4 Description', 'sibco' ),
				'name' => 'pillar_4_desc',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => '100% natural coir products that are fully biodegradable, aligning with circular economy principles and reducing landfill impact.',
			),
			array(
				'key' => 'field_pillar_4_icon',
				'label' => __( 'Pillar 4 Icon', 'sibco' ),
				'name' => 'pillar_4_icon',
				'type' => 'select',
				'choices' => array(
					'leaf'    => 'Leaf / Natural Renewable',
					'users'   => 'Users / Eco Manufacturing',
					'shield'  => 'Shield / Responsible Production',
					'recycle' => 'Recycle / Biodegradable',
				),
				'default_value' => 'recycle',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-sustainability.php',
				),
			),
			array(
				array(
					'param' => 'page',
					'operator' => '==',
					'value' => '12',
				),
			),
		),
		'menu_order' => 10,
	) );

	// -------------------------------------------------------------
	// 10. CONTACT PAGE FIELDS (page-contact.php)
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_contact_page',
		'title' => __( 'Contact Page Content', 'sibco' ),
		'fields' => array(
			array(
				'key' => 'field_contact_info_tab',
				'label' => __( 'Contact Details', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_contact_page_badge',
				'label' => __( 'Contact Badge', 'sibco' ),
				'name' => 'contact_page_badge',
				'type' => 'text',
				'default_value' => 'Contact Us',
			),
			array(
				'key' => 'field_contact_page_title',
				'label' => __( 'Contact Heading', 'sibco' ),
				'name' => 'contact_page_title',
				'type' => 'text',
				'default_value' => 'Get in Touch With Our Export Team',
			),
			array(
				'key' => 'field_contact_page_description',
				'label' => __( 'Contact Description', 'sibco' ),
				'name' => 'contact_page_description',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Discuss custom specifications, request sample swatches, or receive a formal export quotation.',
			),
			array(
				'key' => 'field_contact_direct_email',
				'label' => __( 'Export Email', 'sibco' ),
				'name' => 'contact_direct_email',
				'type' => 'email',
				'default_value' => 'export@sibco.in',
			),
			array(
				'key' => 'field_contact_direct_phone',
				'label' => __( 'Direct Phone / WhatsApp', 'sibco' ),
				'name' => 'contact_direct_phone',
				'type' => 'text',
				'default_value' => '+91 XXX XXX XXXX',
			),
			array(
				'key' => 'field_contact_direct_location',
				'label' => __( 'Office Location', 'sibco' ),
				'name' => 'contact_direct_location',
				'type' => 'text',
				'default_value' => 'Kerala, India',
			),
			array(
				'key' => 'field_contact_direct_address',
				'label' => __( 'Factory / Mailing Address', 'sibco' ),
				'name' => 'contact_direct_address',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => "SIBCO Coir Exports\nIndustrial Estate, Alappuzha\nKerala, India - 688001",
			),
			array(
				'key' => 'field_contact_office_hours',
				'label' => __( 'Office Working Hours', 'sibco' ),
				'name' => 'contact_office_hours',
				'type' => 'text',
				'default_value' => 'Monday - Saturday: 9:00 AM - 6:00 PM IST (Export desk available 24/7)',
			),
			array(
				'key' => 'field_contact_map_tab',
				'label' => __( 'Global Reach Section', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_map_badge',
				'label' => __( 'Global Reach Badge', 'sibco' ),
				'name' => 'map_badge',
				'type' => 'text',
				'default_value' => 'Global Reach',
			),
			array(
				'key' => 'field_map_title',
				'label' => __( 'Global Reach Heading', 'sibco' ),
				'name' => 'map_title',
				'type' => 'text',
				'default_value' => 'Trusted by Importers Across Europe & North America',
			),
			array(
				'key' => 'field_map_description',
				'label' => __( 'Global Reach Description', 'sibco' ),
				'name' => 'map_description',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Supporting international buyers through reliable export manufacturing while maintaining complete confidentiality of our existing OEM partnerships. Our products reach major markets through established shipping routes.',
			),
			array(
				'key' => 'field_map_stats',
				'label' => __( 'Global Reach Stats (4 Cards)', 'sibco' ),
				'name' => 'map_stats',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => __( 'Add Export Stat', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_ms_value',
						'label' => __( 'Value (e.g. 26, 1000s, 2, 100%)', 'sibco' ),
						'name' => 'stat_value',
						'type' => 'text',
					),
					array(
						'key' => 'field_ms_label',
						'label' => __( 'Label (e.g. Years of Export)', 'sibco' ),
						'name' => 'stat_label',
						'type' => 'text',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-contact.php',
				),
			),
		),
		'menu_order' => 10,
	) );

	// -------------------------------------------------------------
	// 11. REUSABLE BOTTOM CTA SECTION
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_cta_section',
		'title' => __( 'Bottom CTA Banner Settings', 'sibco' ),
		'fields' => array(
			array(
				'key' => 'field_cta_override',
				'label' => __( 'Customize Bottom CTA for this page?', 'sibco' ),
				'name' => 'cta_override',
				'type' => 'true_false',
				'default_value' => 0,
				'ui' => 1,
			),
			array(
				'key' => 'field_cta_badge',
				'label' => __( 'CTA Badge', 'sibco' ),
				'name' => 'cta_badge',
				'type' => 'text',
				'default_value' => 'Ready to Partner',
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_cta_override',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			),
			array(
				'key' => 'field_cta_heading',
				'label' => __( 'CTA Heading', 'sibco' ),
				'name' => 'cta_heading',
				'type' => 'text',
				'default_value' => 'Looking for a Reliable Coir Mat Manufacturing Partner?',
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_cta_override',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			),
			array(
				'key' => 'field_cta_description',
				'label' => __( 'CTA Description', 'sibco' ),
				'name' => 'cta_description',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => "Partner with SIBCO for high-quality natural coir mats backed by 26 years of manufacturing excellence. Let's discuss your requirements.",
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_cta_override',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			),
			array(
				'key' => 'field_cta_btn1_text',
				'label' => __( 'CTA Button 1 Text', 'sibco' ),
				'name' => 'cta_btn1_text',
				'type' => 'text',
				'default_value' => 'Request Quote',
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_cta_override',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			),
			array(
				'key' => 'field_cta_btn1_url',
				'label' => __( 'CTA Button 1 URL', 'sibco' ),
				'name' => 'cta_btn1_url',
				'type' => 'text',
				'default_value' => '/contact/',
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_cta_override',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			),
			array(
				'key' => 'field_cta_btn2_text',
				'label' => __( 'CTA Button 2 Text', 'sibco' ),
				'name' => 'cta_btn2_text',
				'type' => 'text',
				'default_value' => 'Contact Export Team',
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_cta_override',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			),
			array(
				'key' => 'field_cta_btn2_url',
				'label' => __( 'CTA Button 2 URL', 'sibco' ),
				'name' => 'cta_btn2_url',
				'type' => 'text',
				'default_value' => '/contact/',
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_cta_override',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			),
			array(
				'key' => 'field_cta_bg_image',
				'label' => __( 'CTA Background Image', 'sibco' ),
				'name' => 'cta_background_image',
				'type' => 'image',
				'return_format' => 'array',
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_cta_override',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
		),
		'menu_order' => 20,
	) );
}

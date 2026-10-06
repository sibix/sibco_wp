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
	// 3. FRONT PAGE EXCLUSIVE FIELDS
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_front_page',
		'title' => __( 'Homepage Content & Stats', 'sibco' ),
		'fields' => array(
			array(
				'key' => 'field_hp_stats_tab',
				'label' => __( 'Hero Stats (6 Grid Items)', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_hero_stats',
				'label' => __( 'Hero Stat Cards', 'sibco' ),
				'name' => 'hero_stats',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => __( 'Add Stat Card', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_hp_stat_value',
						'label' => __( 'Value / Highlight (e.g. 26+, 50K)', 'sibco' ),
						'name' => 'value',
						'type' => 'text',
					),
					array(
						'key' => 'field_hp_stat_label',
						'label' => __( 'Label (e.g. Years Experience)', 'sibco' ),
						'name' => 'label',
						'type' => 'text',
					),
				),
			),
			array(
				'key' => 'field_hp_trust_tab',
				'label' => __( 'Trust Bar (6 Badges)', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_trust_items',
				'label' => __( 'Trust Bar Badges', 'sibco' ),
				'name' => 'trust_items',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => __( 'Add Trust Badge', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_trust_title',
						'label' => __( 'Badge Title', 'sibco' ),
						'name' => 'title',
						'type' => 'text',
					),
					array(
						'key' => 'field_trust_icon_type',
						'label' => __( 'Icon Type', 'sibco' ),
						'name' => 'icon_type',
						'type' => 'select',
						'choices' => array(
							'experience' => 'Experience / Clock',
							'board'      => 'Certificate / Document',
							'talite'     => 'Talite Free / Verified',
							'export'     => 'Export / Shipping Truck',
							'oem'        => 'OEM / Private Label Tag',
							'delivery'   => 'Delivery / Fast Pulse',
						),
						'default_value' => 'experience',
					),
				),
			),
			array(
				'key' => 'field_hp_testi_tab',
				'label' => __( 'Testimonials', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_testimonials',
				'label' => __( 'Client Testimonials', 'sibco' ),
				'name' => 'testimonials',
				'type' => 'repeater',
				'layout' => 'row',
				'button_label' => __( 'Add Testimonial', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_testi_quote',
						'label' => __( 'Quote Text', 'sibco' ),
						'name' => 'quote',
						'type' => 'textarea',
						'rows' => 3,
					),
					array(
						'key' => 'field_testi_client',
						'label' => __( 'Client / Partner Type', 'sibco' ),
						'name' => 'client_type',
						'type' => 'text',
						'default_value' => 'Confidential',
					),
					array(
						'key' => 'field_testi_market',
						'label' => __( 'Market Description', 'sibco' ),
						'name' => 'market',
						'type' => 'text',
						'default_value' => 'European Home Products Importer',
					),
				),
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
	// 5. WHY SIBCO PAGE FIELDS (page-why-sibco.php)
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_why_page',
		'title' => __( 'Why SIBCO Page Content', 'sibco' ),
		'fields' => array(
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
			array(
				'key' => 'field_why_cards',
				'label' => __( 'Why Choose Feature Cards', 'sibco' ),
				'name' => 'why_cards',
				'type' => 'repeater',
				'layout' => 'row',
				'button_label' => __( 'Add Feature Card', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_why_card_title',
						'label' => __( 'Card Title', 'sibco' ),
						'name' => 'card_title',
						'type' => 'text',
					),
					array(
						'key' => 'field_why_card_desc',
						'label' => __( 'Card Description', 'sibco' ),
						'name' => 'card_description',
						'type' => 'textarea',
						'rows' => 3,
					),
					array(
						'key' => 'field_why_card_icon',
						'label' => __( 'Icon Style', 'sibco' ),
						'name' => 'card_icon',
						'type' => 'select',
						'choices' => array(
							'clock'   => 'Clock (26 Years Experience)',
							'leaf'    => 'Leaf (100% Natural Coir)',
							'shield'  => 'Shield (Talite Free Certified)',
							'chart'   => 'Chart (Consistent Quality)',
							'truck'   => 'Truck / Clock (Time-Bound Delivery)',
							'tag'     => 'Tag (OEM & Private Label)',
						),
						'default_value' => 'clock',
					),
				),
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
			array(
				'key' => 'field_mfg_steps_tab',
				'label' => __( '4 Process Steps', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_manufacturing_steps',
				'label' => __( 'Manufacturing Steps', 'sibco' ),
				'name' => 'manufacturing_steps',
				'type' => 'repeater',
				'layout' => 'row',
				'button_label' => __( 'Add Manufacturing Step', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_mfg_step_num',
						'label' => __( 'Step Number (e.g. 01)', 'sibco' ),
						'name' => 'step_number',
						'type' => 'text',
					),
					array(
						'key' => 'field_mfg_step_title',
						'label' => __( 'Step Title', 'sibco' ),
						'name' => 'step_title',
						'type' => 'text',
					),
					array(
						'key' => 'field_mfg_step_desc',
						'label' => __( 'Step Description', 'sibco' ),
						'name' => 'step_description',
						'type' => 'textarea',
						'rows' => 3,
					),
					array(
						'key' => 'field_mfg_step_image',
						'label' => __( 'Step Image', 'sibco' ),
						'name' => 'step_image',
						'type' => 'image',
						'return_format' => 'array',
					),
					array(
						'key' => 'field_mfg_step_tags',
						'label' => __( 'Feature Tags (comma separated)', 'sibco' ),
						'name' => 'step_tags',
						'type' => 'text',
						'instructions' => __( 'e.g. Fibre Testing, Moisture Control, Grade Selection', 'sibco' ),
					),
				),
			),
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
			array(
				'key' => 'field_pipeline_steps',
				'label' => __( 'Pipeline Timeline Steps', 'sibco' ),
				'name' => 'pipeline_steps',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => __( 'Add Pipeline Step', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_pl_step_num',
						'label' => __( 'Step #', 'sibco' ),
						'name' => 'step_number',
						'type' => 'text',
					),
					array(
						'key' => 'field_pl_step_title',
						'label' => __( 'Step Title', 'sibco' ),
						'name' => 'step_title',
						'type' => 'text',
					),
				),
			),
			array(
				'key' => 'field_facility_stats',
				'label' => __( 'Facility Highlights (4 Grid Stats)', 'sibco' ),
				'name' => 'facility_stats',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => __( 'Add Facility Highlight', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_fac_highlight',
						'label' => __( 'Highlight Word (e.g. Modern, Skilled)', 'sibco' ),
						'name' => 'highlight',
						'type' => 'text',
					),
					array(
						'key' => 'field_fac_label',
						'label' => __( 'Label (e.g. Production Facility)', 'sibco' ),
						'name' => 'label',
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
					'value' => 'page-manufacturing.php',
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
				'key' => 'field_prod_items_tab',
				'label' => __( 'Product Items (Repeater)', 'sibco' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_product_items',
				'label' => __( 'Product Cards', 'sibco' ),
				'name' => 'product_items',
				'type' => 'repeater',
				'layout' => 'row',
				'button_label' => __( 'Add Product', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_prod_name',
						'label' => __( 'Product Name', 'sibco' ),
						'name' => 'product_name',
						'type' => 'text',
					),
					array(
						'key' => 'field_prod_image',
						'label' => __( 'Product Image', 'sibco' ),
						'name' => 'product_image',
						'type' => 'image',
						'return_format' => 'array',
					),
					array(
						'key' => 'field_prod_desc',
						'label' => __( 'Description', 'sibco' ),
						'name' => 'product_description',
						'type' => 'textarea',
						'rows' => 3,
					),
					array(
						'key' => 'field_prod_btn_text',
						'label' => __( 'Button / Link Text', 'sibco' ),
						'name' => 'product_button_text',
						'type' => 'text',
						'default_value' => 'Enquire Now',
					),
					array(
						'key' => 'field_prod_btn_url',
						'label' => __( 'Button / Link URL', 'sibco' ),
						'name' => 'product_button_url',
						'type' => 'text',
						'default_value' => '/contact/',
					),
				),
			),
			array(
				'key' => 'field_prod_process_tab',
				'label' => __( 'B2B Export Process', 'sibco' ),
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
			array(
				'key' => 'field_process_steps',
				'label' => __( 'Process Steps (4 Steps)', 'sibco' ),
				'name' => 'process_steps',
				'type' => 'repeater',
				'layout' => 'row',
				'button_label' => __( 'Add Process Step', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_prc_step_num',
						'label' => __( 'Step # (e.g. Step 01)', 'sibco' ),
						'name' => 'step_number',
						'type' => 'text',
					),
					array(
						'key' => 'field_prc_step_title',
						'label' => __( 'Step Title', 'sibco' ),
						'name' => 'step_title',
						'type' => 'text',
					),
					array(
						'key' => 'field_prc_step_desc',
						'label' => __( 'Step Description', 'sibco' ),
						'name' => 'step_description',
						'type' => 'textarea',
						'rows' => 3,
					),
				),
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
		),
		'menu_order' => 10,
	) );

	// -------------------------------------------------------------
	// 8. QUALITY PAGE FIELDS (page-quality.php)
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_quality_page',
		'title' => __( 'Quality Page Content', 'sibco' ),
		'fields' => array(
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
				'key' => 'field_certifications',
				'label' => __( 'Certification Badges (4 Badges)', 'sibco' ),
				'name' => 'certifications',
				'type' => 'repeater',
				'layout' => 'row',
				'button_label' => __( 'Add Certification Badge', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_cert_title',
						'label' => __( 'Certification Title', 'sibco' ),
						'name' => 'cert_title',
						'type' => 'text',
					),
					array(
						'key' => 'field_cert_desc',
						'label' => __( 'Certification Description', 'sibco' ),
						'name' => 'cert_description',
						'type' => 'textarea',
						'rows' => 2,
					),
					array(
						'key' => 'field_cert_icon',
						'label' => __( 'Icon Type', 'sibco' ),
						'name' => 'cert_icon',
						'type' => 'select',
						'choices' => array(
							'talite'  => 'Talite Free / Checkmark',
							'board'   => 'Rubber Board / Document',
							'qc'      => 'Consistent QC / Bars',
							'export'  => 'Export Standards / Globe',
						),
						'default_value' => 'talite',
					),
				),
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
				'type' => 'wysiwyg',
				'toolbar' => 'basic',
				'media_upload' => 0,
			),
			array(
				'key' => 'field_quality_metrics',
				'label' => __( 'Quality Metric Counters (3 Stats)', 'sibco' ),
				'name' => 'quality_metrics',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => __( 'Add Metric Counter', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_qm_value',
						'label' => __( 'Value (e.g. 100%, Zero, Multi)', 'sibco' ),
						'name' => 'metric_value',
						'type' => 'text',
					),
					array(
						'key' => 'field_qm_label',
						'label' => __( 'Label (e.g. Inspection Rate)', 'sibco' ),
						'name' => 'metric_label',
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
					'value' => 'page-quality.php',
				),
			),
		),
		'menu_order' => 10,
	) );

	// -------------------------------------------------------------
	// 9. SUSTAINABILITY PAGE FIELDS (page-sustainability.php)
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_sustainability_page',
		'title' => __( 'Sustainability Page Content', 'sibco' ),
		'fields' => array(
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
				'key' => 'field_sustainability_pillars',
				'label' => __( 'Sustainability Pillars (4 Points)', 'sibco' ),
				'name' => 'sustainability_pillars',
				'type' => 'repeater',
				'layout' => 'row',
				'button_label' => __( 'Add Pillar', 'sibco' ),
				'sub_fields' => array(
					array(
						'key' => 'field_sp_title',
						'label' => __( 'Pillar Title', 'sibco' ),
						'name' => 'pillar_title',
						'type' => 'text',
					),
					array(
						'key' => 'field_sp_desc',
						'label' => __( 'Pillar Description', 'sibco' ),
						'name' => 'pillar_description',
						'type' => 'textarea',
						'rows' => 3,
					),
				),
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
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-sustainability.php',
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

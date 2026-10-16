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
	// 3. FRONT PAGE EXCLUSIVE FIELDS (NO REPEATERS - 100% ACF FREE COMPATIBLE)
	// -------------------------------------------------------------
	acf_add_local_field_group( array(
		'key' => 'group_sibco_front_page',
		'title' => __( 'Homepage Content & Sections', 'sibco' ),
		'fields' => array(
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

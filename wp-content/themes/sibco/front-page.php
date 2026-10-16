<?php
/**
 * Front Page Template
 *
 * 100% editable via Advanced Custom Fields (ACF Free compatible - ZERO repeaters used).
 *
 * @package SIBCO
 */

get_header();

$page_id = get_the_ID();

// -------------------------------------------------------------
// 1. HERO FIELDS
// -------------------------------------------------------------
$hero_badge    = sibco_get_field( 'hero_badge', 'Established 1998 · India', $page_id );
$hero_title    = sibco_get_field( 'hero_title', '26 Years of Manufacturing Premium Coir Mats for Global Markets', $page_id );
$hero_desc     = sibco_get_field( 'hero_description', 'Trusted manufacturing partner supplying high-quality natural coir mats to importers, distributors and private label brands across Europe and North America.', $page_id );
$btn1_text     = sibco_get_field( 'hero_button_text', __( 'Request a Quote', 'sibco' ), $page_id );
$btn1_url      = sibco_get_field( 'hero_button_url', home_url( '/contact/' ), $page_id );
$btn2_text     = sibco_get_field( 'hero_button_secondary_text', __( 'View Product Range', 'sibco' ), $page_id );
$btn2_url      = sibco_get_field( 'hero_button_secondary_url', home_url( '/products/' ), $page_id );

$raw_img       = sibco_get_field( 'hero_image', '', $page_id );
$bg_url        = sibco_get_image_url( $raw_img, 'https://picsum.photos/seed/coir-factory-floor/1920/1080.jpg' );

// Hero Stats (6 Individual Cards - No Repeater)
$hero_stats = array(
	array(
		'val' => sibco_get_field( 'hero_stat_1_val', '26+', $page_id ),
		'lbl' => sibco_get_field( 'hero_stat_1_lbl', __( 'Years Experience', 'sibco' ), $page_id ),
	),
	array(
		'val' => sibco_get_field( 'hero_stat_2_val', '50K', $page_id ),
		'lbl' => sibco_get_field( 'hero_stat_2_lbl', __( 'Units Capacity', 'sibco' ), $page_id ),
	),
	array(
		'val' => sibco_get_field( 'hero_stat_3_val', '100%', $page_id ),
		'lbl' => sibco_get_field( 'hero_stat_3_lbl', __( 'Natural Coir', 'sibco' ), $page_id ),
	),
	array(
		'val' => sibco_get_field( 'hero_stat_4_val', 'Talite Free', $page_id ),
		'lbl' => sibco_get_field( 'hero_stat_4_lbl', __( 'Certified Non-Hazardous', 'sibco' ), $page_id ),
	),
	array(
		'val' => sibco_get_field( 'hero_stat_5_val', 'Export Focused', $page_id ),
		'lbl' => sibco_get_field( 'hero_stat_5_lbl', __( '25+ Countries Served', 'sibco' ), $page_id ),
	),
	array(
		'val' => sibco_get_field( 'hero_stat_6_val', 'Zero', $page_id ),
		'lbl' => sibco_get_field( 'hero_stat_6_lbl', __( 'Quality Claims', 'sibco' ), $page_id ),
	),
);

// -------------------------------------------------------------
// 2. ABOUT SIBCO TEASER FIELDS
// -------------------------------------------------------------
$about_badge    = sibco_get_field( 'hp_about_badge', __( 'About SIBCO', 'sibco' ), $page_id );
$about_title    = sibco_get_field( 'hp_about_title', __( 'A Legacy of Premium Coir Manufacturing Since 1998', 'sibco' ), $page_id );
$about_desc     = sibco_get_field( 'hp_about_description', __( "SIBCO is an export-focused coir mat manufacturer delivering exceptional quality to importers, distributors, and private label brands across Europe and North America. Combining Kerala's natural coir heritage with precision machinery.", 'sibco' ), $page_id );
$about_btn_text = sibco_get_field( 'hp_about_button_text', __( 'Discover Our Story & Values', 'sibco' ), $page_id );
$about_btn_url  = sibco_get_field( 'hp_about_button_url', home_url( '/about/' ), $page_id );
$about_raw_img  = sibco_get_field( 'hp_about_image', '', $page_id );
$about_img_url  = sibco_get_image_url( $about_raw_img, 'https://picsum.photos/seed/factory-exterior-premium/800/600.jpg' );
$about_stat_num = sibco_get_field( 'hp_about_stat_number', '26+', $page_id );
$about_stat_lbl = sibco_get_field( 'hp_about_stat_label', "Years of\nManufacturing", $page_id );

// -------------------------------------------------------------
// 3. CORE CAPABILITIES (PILLARS) FIELDS
// -------------------------------------------------------------
$pillars_badge = sibco_get_field( 'hp_pillars_badge', __( 'Core Capabilities', 'sibco' ), $page_id );
$pillars_title = sibco_get_field( 'hp_pillars_title', __( 'Built for Global B2B Standards', 'sibco' ), $page_id );
$pillars_desc  = sibco_get_field( 'hp_pillars_description', __( 'Explore the core areas that make SIBCO the preferred manufacturing partner for international buyers.', 'sibco' ), $page_id );

$pillar_cards = array(
	array(
		'title'    => sibco_get_field( 'hp_pillar_1_title', __( 'Why SIBCO', 'sibco' ), $page_id ),
		'desc'     => sibco_get_field( 'hp_pillar_1_desc', __( '26 years of refined export experience, certified talite-free compliance, and OEM private label expertise.', 'sibco' ), $page_id ),
		'btn_text' => sibco_get_field( 'hp_pillar_1_btn_text', __( 'Learn Why Buyers Choose Us', 'sibco' ), $page_id ),
		'btn_url'  => sibco_get_field( 'hp_pillar_1_btn_url', home_url( '/why-sibco/' ), $page_id ),
		'icon'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
		'style'    => 'cream',
	),
	array(
		'title'    => sibco_get_field( 'hp_pillar_2_title', __( 'Manufacturing Excellence', 'sibco' ), $page_id ),
		'desc'     => sibco_get_field( 'hp_pillar_2_desc', __( 'Complete end-to-end production: fibre sourcing, spinning, weaving, vulcanized rubber backing, and precision embossing.', 'sibco' ), $page_id ),
		'btn_text' => sibco_get_field( 'hp_pillar_2_btn_text', __( 'Explore Manufacturing Process', 'sibco' ), $page_id ),
		'btn_url'  => sibco_get_field( 'hp_pillar_2_btn_url', home_url( '/manufacturing/' ), $page_id ),
		'icon'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>',
		'style'    => 'cream',
	),
	array(
		'title'    => sibco_get_field( 'hp_pillar_3_title', __( 'Product Range', 'sibco' ), $page_id ),
		'desc'     => sibco_get_field( 'hp_pillar_3_desc', __( 'Panama grill mats, high-brush mats, custom embossed logo mats, rubber grill inlays, and sensor LED entrance mats.', 'sibco' ), $page_id ),
		'btn_text' => sibco_get_field( 'hp_pillar_3_btn_text', __( 'View Full Product Catalog', 'sibco' ), $page_id ),
		'btn_url'  => sibco_get_field( 'hp_pillar_3_btn_url', home_url( '/products/' ), $page_id ),
		'icon'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>',
		'style'    => 'cream',
	),
	array(
		'title'    => sibco_get_field( 'hp_pillar_4_title', __( 'Quality & Certifications', 'sibco' ), $page_id ),
		'desc'     => sibco_get_field( 'hp_pillar_4_desc', __( 'Rubber Board registered, EU Talite Free certified, with a 100% pre-dispatch inspection rate and zero quality claims.', 'sibco' ), $page_id ),
		'btn_text' => sibco_get_field( 'hp_pillar_4_btn_text', __( 'See Quality Standards', 'sibco' ), $page_id ),
		'btn_url'  => sibco_get_field( 'hp_pillar_4_btn_url', home_url( '/quality/' ), $page_id ),
		'icon'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
		'style'    => 'cream',
	),
	array(
		'title'    => sibco_get_field( 'hp_pillar_5_title', __( 'Sustainability Commitment', 'sibco' ), $page_id ),
		'desc'     => sibco_get_field( 'hp_pillar_5_desc', __( '100% natural, biodegradable coconut fibres sourced ethically from Kerala plantations with zero-waste production.', 'sibco' ), $page_id ),
		'btn_text' => sibco_get_field( 'hp_pillar_5_btn_text', __( 'Read Sustainability Mission', 'sibco' ), $page_id ),
		'btn_url'  => sibco_get_field( 'hp_pillar_5_btn_url', home_url( '/sustainability/' ), $page_id ),
		'icon'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="M7 10.5c0-1.657 2.239-3 5-3s5 1.343 5 3"/><path d="M7 14c0 1.657 2.239 3 5 3s5-1.343 5-3"/></svg>',
		'style'    => 'cream',
	),
	array(
		'title'    => sibco_get_field( 'hp_pillar_6_title', __( 'Start Your Enquiry', 'sibco' ), $page_id ),
		'desc'     => sibco_get_field( 'hp_pillar_6_desc', __( 'Connect directly with our export desk. Request product swatches, technical data sheets, and custom container pricing.', 'sibco' ), $page_id ),
		'btn_text' => sibco_get_field( 'hp_pillar_6_btn_text', __( 'Contact Export Team', 'sibco' ), $page_id ),
		'btn_url'  => sibco_get_field( 'hp_pillar_6_btn_url', home_url( '/contact/' ), $page_id ),
		'icon'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
		'style'    => 'coir',
	),
);

// -------------------------------------------------------------
// 4. TESTIMONIALS FIELDS
// -------------------------------------------------------------
$testi_badge = sibco_get_field( 'hp_testi_badge', __( 'Client Confidence', 'sibco' ), $page_id );
$testi_title = sibco_get_field( 'hp_testi_title', __( 'What Our Partners Say', 'sibco' ), $page_id );
$testi_desc  = sibco_get_field( 'hp_testi_description', __( 'We maintain strict confidentiality for all OEM partners. The following reflect genuine feedback from our international buyers.', 'sibco' ), $page_id );

$testimonials = array(
	array(
		'quote'  => sibco_get_field( 'hp_testi_1_quote', '"Reliable manufacturing partner with consistently high product quality. Every shipment meets our specifications without exception."', $page_id ),
		'client' => sibco_get_field( 'hp_testi_1_client', 'Confidential', $page_id ),
		'market' => sibco_get_field( 'hp_testi_1_market', 'European Home Products Importer', $page_id ),
		'rating' => intval( sibco_get_field( 'hp_testi_1_rating', 5, $page_id ) ),
	),
	array(
		'quote'  => sibco_get_field( 'hp_testi_2_quote', '"Excellent communication and dependable deliveries. SIBCO understands the requirements of the North American market very well."', $page_id ),
		'client' => sibco_get_field( 'hp_testi_2_client', 'Confidential', $page_id ),
		'market' => sibco_get_field( 'hp_testi_2_market', 'North American Distributor', $page_id ),
		'rating' => intval( sibco_get_field( 'hp_testi_2_rating', 5, $page_id ) ),
	),
	array(
		'quote'  => sibco_get_field( 'hp_testi_3_quote', '"We\'ve been working with SIBCO for our private label coir mats for years. Their consistency and professionalism are unmatched in the industry."', $page_id ),
		'client' => sibco_get_field( 'hp_testi_3_client', 'Confidential', $page_id ),
		'market' => sibco_get_field( 'hp_testi_3_market', 'European Retail Chain — Private Label', $page_id ),
		'rating' => intval( sibco_get_field( 'hp_testi_3_rating', 5, $page_id ) ),
	),
);
?>

	<!-- ============ HERO SECTION ============ -->
	<section id="hero" class="relative min-h-screen flex items-center overflow-hidden">
		<!-- Background Image -->
		<div class="absolute inset-0">
			<img src="<?php echo esc_url( $bg_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="w-full h-full object-cover">
			<div class="absolute inset-0 bg-gradient-to-r from-charcoal-800/90 via-charcoal-800/75 to-charcoal-800/50"></div>
			<div class="absolute inset-0 bg-gradient-to-t from-charcoal-800/60 via-transparent to-charcoal-800/30"></div>
		</div>

		<!-- Content -->
		<div class="hero-loaded relative z-10 max-w-7xl mx-auto px-6 lg:px-8 w-full pt-32 pb-20">
			<div class="max-w-3xl">
				<!-- Badge -->
				<?php if ( ! empty( $hero_badge ) ) : ?>
				<div class="hero-title inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/10 rounded-full px-4 py-1.5 mb-8">
					<span class="w-2 h-2 bg-coir-400 rounded-full"></span>
					<span class="text-white/80 text-xs font-medium tracking-wider uppercase"><?php echo esc_html( $hero_badge ); ?></span>
				</div>
				<?php endif; ?>

				<!-- Headline -->
				<h1 class="hero-title font-serif text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-600 text-white leading-[1.1] tracking-tight mb-6">
					<?php echo esc_html( $hero_title ); ?>
				</h1>

				<!-- Subheadline -->
				<?php if ( ! empty( $hero_desc ) ) : ?>
				<p class="hero-sub text-lg lg:text-xl text-white/70 font-light leading-relaxed max-w-2xl mb-10">
					<?php echo esc_html( $hero_desc ); ?>
				</p>
				<?php endif; ?>

				<!-- CTAs -->
				<div class="hero-ctas flex flex-wrap gap-4 mb-16">
					<?php if ( ! empty( $btn1_text ) ) : ?>
					<a href="<?php echo esc_url( $btn1_url ); ?>" class="btn-primary bg-coir-500 hover:bg-coir-600 text-white font-semibold px-8 py-4 rounded-lg text-base transition-colors duration-200 inline-flex items-center gap-2">
						<?php echo esc_html( $btn1_text ); ?>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</a>
					<?php endif; ?>

					<?php if ( ! empty( $btn2_text ) ) : ?>
					<a href="<?php echo esc_url( $btn2_url ); ?>" class="bg-white/10 hover:bg-white/15 backdrop-blur-sm border border-white/20 text-white font-medium px-8 py-4 rounded-lg text-base transition-all duration-200 inline-flex items-center gap-2">
						<?php echo esc_html( $btn2_text ); ?>
					</a>
					<?php endif; ?>
				</div>
			</div>

			<!-- Trust Stats Grid (ACF Free Non-Repeater) -->
			<div class="hero-stats grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
				<?php foreach ( $hero_stats as $stat ) : ?>
				<div class="bg-white/8 backdrop-blur-md border border-white/10 rounded-xl p-4 text-center">
					<div class="text-coir-400 font-bold text-2xl mb-1"><?php echo esc_html( $stat['val'] ); ?></div>
					<div class="text-white/60 text-xs font-medium tracking-wide"><?php echo esc_html( $stat['lbl'] ); ?></div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>

		<!-- Scroll indicator -->
		<div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 opacity-60">
			<span class="text-white text-[10px] tracking-[0.2em] uppercase font-medium"><?php esc_html_e( 'Scroll', 'sibco' ); ?></span>
			<div class="w-px h-8 bg-gradient-to-b from-white/60 to-transparent"></div>
		</div>
	</section>

	<!-- ============ TRUST BAR ============ -->
	<?php get_template_part( 'template-parts/trust-bar' ); ?>

	<!-- ============ OVERVIEW HIGHLIGHTS ============ -->
	<!-- 1. About Overview Teaser (Fully ACF Editable) -->
	<section class="py-24 lg:py-28 bg-cream-50">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
				<div class="animate-left relative">
					<div class="relative rounded-2xl overflow-hidden shadow-sm">
						<img src="<?php echo esc_url( $about_img_url ); ?>" alt="<?php echo esc_attr( $about_title ); ?>" class="w-full h-[380px] lg:h-[460px] object-cover">
					</div>
					<div class="absolute -bottom-6 -right-4 lg:-right-8 bg-white rounded-xl shadow-lg p-5 border border-cream-400">
						<div class="text-coir-600 font-bold text-3xl font-serif"><?php echo esc_html( $about_stat_num ); ?></div>
						<div class="text-charcoal-400 text-xs font-medium tracking-wide uppercase mt-1"><?php echo nl2br( esc_html( $about_stat_lbl ) ); ?></div>
					</div>
				</div>
				<div class="animate-right">
					<?php if ( ! empty( $about_badge ) ) : ?>
					<div class="inline-flex items-center gap-2 bg-coir-50 border border-coir-200 rounded-full px-4 py-1.5 mb-6">
						<span class="w-1.5 h-1.5 bg-coir-500 rounded-full"></span>
						<span class="text-coir-700 text-xs font-semibold tracking-wider uppercase"><?php echo esc_html( $about_badge ); ?></span>
					</div>
					<?php endif; ?>

					<h2 class="font-serif text-3xl lg:text-4xl font-600 text-charcoal-800 leading-[1.2] mb-6">
						<?php echo esc_html( $about_title ); ?>
					</h2>

					<p class="text-charcoal-500 text-base leading-relaxed mb-8">
						<?php echo esc_html( $about_desc ); ?>
					</p>

					<?php if ( ! empty( $about_btn_text ) ) : ?>
					<a href="<?php echo esc_url( $about_btn_url ); ?>" class="inline-flex items-center gap-2 text-coir-600 hover:text-coir-700 font-semibold text-sm group transition-colors">
						<?php echo esc_html( $about_btn_text ); ?>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:translate-x-1"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- 2. Core Capabilities Grid (Fully ACF Editable) -->
	<section class="py-24 bg-white border-y border-cream-400">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
				<?php if ( ! empty( $pillars_badge ) ) : ?>
				<div class="inline-flex items-center gap-2 bg-coir-50 border border-coir-200 rounded-full px-4 py-1.5 mb-6">
					<span class="w-1.5 h-1.5 bg-coir-500 rounded-full"></span>
					<span class="text-coir-700 text-xs font-semibold tracking-wider uppercase"><?php echo esc_html( $pillars_badge ); ?></span>
				</div>
				<?php endif; ?>

				<h2 class="font-serif text-3xl lg:text-4xl xl:text-5xl font-600 text-charcoal-800 leading-[1.15] mb-5">
					<?php echo esc_html( $pillars_title ); ?>
				</h2>

				<?php if ( ! empty( $pillars_desc ) ) : ?>
				<p class="text-charcoal-400 text-base lg:text-lg">
					<?php echo esc_html( $pillars_desc ); ?>
				</p>
				<?php endif; ?>
			</div>

			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
				<?php foreach ( $pillar_cards as $card ) :
					$is_coir_card = ( $card['style'] === 'coir' );
					$card_classes = $is_coir_card
						? 'card-hover bg-coir-500 rounded-2xl p-8 text-white flex flex-col justify-between group shadow-md shadow-coir-600/20'
						: 'card-hover bg-cream-50 rounded-2xl p-8 border border-cream-400 flex flex-col justify-between group';
					$icon_box     = $is_coir_card
						? 'w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center mb-6 text-white'
						: 'w-12 h-12 rounded-xl bg-coir-50 flex items-center justify-center mb-6 text-coir-600 group-hover:bg-coir-500 group-hover:text-white transition-colors duration-300';
					$title_class  = $is_coir_card ? 'font-semibold text-white text-xl mb-3' : 'font-semibold text-charcoal-800 text-xl mb-3';
					$desc_class   = $is_coir_card ? 'text-white/80 text-sm leading-relaxed mb-6' : 'text-charcoal-400 text-sm leading-relaxed mb-6';
					$link_class   = $is_coir_card ? 'inline-flex items-center gap-2 text-white font-semibold text-sm group/link underline underline-offset-4' : 'inline-flex items-center gap-2 text-coir-600 hover:text-coir-700 text-sm font-semibold group/link';
				?>
				<div class="<?php echo esc_attr( $card_classes ); ?>">
					<div>
						<div class="<?php echo esc_attr( $icon_box ); ?>">
							<?php echo $card['icon']; // SVG markup ?>
						</div>
						<h3 class="<?php echo esc_attr( $title_class ); ?>"><?php echo esc_html( $card['title'] ); ?></h3>
						<p class="<?php echo esc_attr( $desc_class ); ?>"><?php echo esc_html( $card['desc'] ); ?></p>
					</div>
					<a href="<?php echo esc_url( $card['btn_url'] ); ?>" class="<?php echo esc_attr( $link_class ); ?>">
						<?php echo esc_html( $card['btn_text'] ); ?>
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover/link:translate-x-1"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</a>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ TESTIMONIALS (Fully ACF Editable) ============ -->
	<section class="py-24 lg:py-32 bg-cream-100">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<!-- Header -->
			<div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
				<?php if ( ! empty( $testi_badge ) ) : ?>
				<div class="inline-flex items-center gap-2 bg-coir-50 border border-coir-200 rounded-full px-4 py-1.5 mb-6">
					<span class="w-1.5 h-1.5 bg-coir-500 rounded-full"></span>
					<span class="text-coir-700 text-xs font-semibold tracking-wider uppercase"><?php echo esc_html( $testi_badge ); ?></span>
				</div>
				<?php endif; ?>

				<h2 class="font-serif text-3xl lg:text-4xl xl:text-5xl font-600 text-charcoal-800 leading-[1.15] tracking-tight mb-5">
					<?php echo esc_html( $testi_title ); ?>
				</h2>

				<?php if ( ! empty( $testi_desc ) ) : ?>
				<p class="text-charcoal-400 text-base lg:text-lg leading-relaxed">
					<?php echo esc_html( $testi_desc ); ?>
				</p>
				<?php endif; ?>
			</div>

			<!-- Testimonial Cards -->
			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
				<?php foreach ( $testimonials as $index => $testi ) :
					$rating = ( $testi['rating'] > 0 && $testi['rating'] <= 5 ) ? $testi['rating'] : 5;
					$delay_class = 'delay-' . ( $index + 1 );
				?>
				<div class="animate-on-scroll <?php echo esc_attr( $delay_class ); ?> bg-white rounded-2xl p-8 border border-cream-400 card-hover flex flex-col justify-between">
					<div>
						<!-- Stars -->
						<div class="flex gap-1 mb-6">
							<?php for ( $s = 0; $s < $rating; $s++ ) : ?>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<?php endfor; ?>
						</div>
						<blockquote class="text-charcoal-600 text-base leading-relaxed mb-6 italic">
							<?php echo esc_html( $testi['quote'] ); ?>
						</blockquote>
					</div>
					<div class="flex items-center gap-3 pt-6 border-t border-cream-400">
						<div class="w-10 h-10 rounded-full bg-coir-100 flex items-center justify-center">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
						</div>
						<div>
							<div class="text-charcoal-700 text-sm font-semibold"><?php echo esc_html( $testi['client'] ); ?></div>
							<div class="text-charcoal-400 text-xs"><?php echo esc_html( $testi['market'] ); ?></div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Reusable Bottom CTA (Configurable via ACF) -->
	<?php get_template_part( 'template-parts/cta-banner' ); ?>

<?php
get_footer();

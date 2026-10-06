<?php
/**
 * Front Page Template
 *
 * @package SIBCO
 */

get_header();

$page_id = get_the_ID();

// Hero Fields
$badge     = sibco_get_field( 'hero_badge', 'Established 1998 · India', $page_id );
$title     = sibco_get_field( 'hero_title', '26 Years of Manufacturing Premium Coir Mats for Global Markets', $page_id );
$desc      = sibco_get_field( 'hero_description', 'Trusted manufacturing partner supplying high-quality natural coir mats to importers, distributors and private label brands across Europe and North America.', $page_id );
$btn1_text = sibco_get_field( 'hero_button_text', __( 'Request a Quote', 'sibco' ), $page_id );
$btn1_url  = sibco_get_field( 'hero_button_url', home_url( '/contact/' ), $page_id );
$btn2_text = sibco_get_field( 'hero_button_secondary_text', __( 'View Product Range', 'sibco' ), $page_id );
$btn2_url  = sibco_get_field( 'hero_button_secondary_url', home_url( '/products/' ), $page_id );

$raw_img = sibco_get_field( 'hero_image', '', $page_id );
$bg_url  = sibco_get_image_url( $raw_img, 'https://picsum.photos/seed/coir-factory-floor/1920/1080.jpg' );
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
				<?php if ( ! empty( $badge ) ) : ?>
				<div class="hero-title inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/10 rounded-full px-4 py-1.5 mb-8">
					<span class="w-2 h-2 bg-coir-400 rounded-full"></span>
					<span class="text-white/80 text-xs font-medium tracking-wider uppercase"><?php echo esc_html( $badge ); ?></span>
				</div>
				<?php endif; ?>

				<!-- Headline -->
				<h1 class="hero-title font-serif text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-600 text-white leading-[1.1] tracking-tight mb-6">
					<?php echo esc_html( $title ); ?>
				</h1>

				<!-- Subheadline -->
				<?php if ( ! empty( $desc ) ) : ?>
				<p class="hero-sub text-lg lg:text-xl text-white/70 font-light leading-relaxed max-w-2xl mb-10">
					<?php echo esc_html( $desc ); ?>
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

			<!-- Trust Stats Grid -->
			<div class="hero-stats grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
				<?php
				if ( function_exists( 'have_rows' ) && have_rows( 'hero_stats', $page_id ) ) :
					while ( have_rows( 'hero_stats', $page_id ) ) :
						the_row();
						$sval = get_sub_field( 'value' );
						$slbl = get_sub_field( 'label' );
						?>
						<div class="bg-white/8 backdrop-blur-md border border-white/10 rounded-xl p-4 text-center">
							<div class="text-coir-400 font-bold text-2xl mb-1"><?php echo esc_html( $sval ); ?></div>
							<div class="text-white/60 text-xs font-medium tracking-wide"><?php echo esc_html( $slbl ); ?></div>
						</div>
						<?php
					endwhile;
				else :
					?>
					<div class="bg-white/8 backdrop-blur-md border border-white/10 rounded-xl p-4 text-center">
						<div class="text-coir-400 font-bold text-2xl mb-1">26+</div>
						<div class="text-white/60 text-xs font-medium tracking-wide"><?php esc_html_e( 'Years Experience', 'sibco' ); ?></div>
					</div>
					<div class="bg-white/8 backdrop-blur-md border border-white/10 rounded-xl p-4 text-center">
						<div class="text-coir-400 font-bold text-2xl mb-1">50K</div>
						<div class="text-white/60 text-xs font-medium tracking-wide"><?php esc_html_e( 'Units Capacity', 'sibco' ); ?></div>
					</div>
					<div class="bg-white/8 backdrop-blur-md border border-white/10 rounded-xl p-4 text-center">
						<div class="text-coir-400 font-bold text-2xl mb-1">100%</div>
						<div class="text-white/60 text-xs font-medium tracking-wide"><?php esc_html_e( 'Natural Coir', 'sibco' ); ?></div>
					</div>
					<div class="bg-white/8 backdrop-blur-md border border-white/10 rounded-xl p-4 text-center">
						<div class="text-coir-400 font-bold text-2xl mb-1 flex items-center justify-center gap-1">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
						</div>
						<div class="text-white/60 text-xs font-medium tracking-wide"><?php esc_html_e( 'Talite Free', 'sibco' ); ?></div>
					</div>
					<div class="bg-white/8 backdrop-blur-md border border-white/10 rounded-xl p-4 text-center">
						<div class="text-coir-400 font-bold text-2xl mb-1 flex items-center justify-center gap-1">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
						</div>
						<div class="text-white/60 text-xs font-medium tracking-wide"><?php esc_html_e( 'Export Focused', 'sibco' ); ?></div>
					</div>
					<div class="bg-white/8 backdrop-blur-md border border-white/10 rounded-xl p-4 text-center">
						<div class="text-coir-400 font-bold text-2xl mb-1">Zero</div>
						<div class="text-white/60 text-xs font-medium tracking-wide"><?php esc_html_e( 'Quality Claims', 'sibco' ); ?></div>
					</div>
				<?php endif; ?>
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

	<!-- ============ OVERVIEW HIGHLIGHTS (THE 7 SECTIONS) ============ -->
	<!-- 1. About Overview Teaser -->
	<section class="py-24 lg:py-28 bg-cream-50">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
				<div class="animate-left relative">
					<div class="relative rounded-2xl overflow-hidden shadow-sm">
						<img src="https://picsum.photos/seed/factory-exterior-premium/800/600.jpg" alt="SIBCO Manufacturing Facility" class="w-full h-[380px] lg:h-[460px] object-cover">
					</div>
					<div class="absolute -bottom-6 -right-4 lg:-right-8 bg-white rounded-xl shadow-lg p-5 border border-cream-400">
						<div class="text-coir-600 font-bold text-3xl font-serif">26+</div>
						<div class="text-charcoal-400 text-xs font-medium tracking-wide uppercase mt-1">Years of<br>Manufacturing</div>
					</div>
				</div>
				<div class="animate-right">
					<div class="inline-flex items-center gap-2 bg-coir-50 border border-coir-200 rounded-full px-4 py-1.5 mb-6">
						<span class="w-1.5 h-1.5 bg-coir-500 rounded-full"></span>
						<span class="text-coir-700 text-xs font-semibold tracking-wider uppercase"><?php esc_html_e( 'About SIBCO', 'sibco' ); ?></span>
					</div>
					<h2 class="font-serif text-3xl lg:text-4xl font-600 text-charcoal-800 leading-[1.2] mb-6">
						<?php esc_html_e( 'A Legacy of Premium Coir Manufacturing Since 1998', 'sibco' ); ?>
					</h2>
					<p class="text-charcoal-500 text-base leading-relaxed mb-8">
						<?php esc_html_e( "SIBCO is an export-focused coir mat manufacturer delivering exceptional quality to importers, distributors, and private label brands across Europe and North America. Combining Kerala's natural coir heritage with precision machinery.", 'sibco' ); ?>
					</p>
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="inline-flex items-center gap-2 text-coir-600 hover:text-coir-700 font-semibold text-sm group transition-colors">
						<?php esc_html_e( 'Discover Our Story & Values', 'sibco' ); ?>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:translate-x-1"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- 2. Pillars Grid (Linking Why SIBCO, Manufacturing, Products, Quality, Sustainability) -->
	<section class="py-24 bg-white border-y border-cream-400">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
				<div class="inline-flex items-center gap-2 bg-coir-50 border border-coir-200 rounded-full px-4 py-1.5 mb-6">
					<span class="w-1.5 h-1.5 bg-coir-500 rounded-full"></span>
					<span class="text-coir-700 text-xs font-semibold tracking-wider uppercase"><?php esc_html_e( 'Core Capabilities', 'sibco' ); ?></span>
				</div>
				<h2 class="font-serif text-3xl lg:text-4xl xl:text-5xl font-600 text-charcoal-800 leading-[1.15] mb-5">
					<?php esc_html_e( 'Built for Global B2B Standards', 'sibco' ); ?>
				</h2>
				<p class="text-charcoal-400 text-base lg:text-lg">
					<?php esc_html_e( 'Explore the core areas that make SIBCO the preferred manufacturing partner for international buyers.', 'sibco' ); ?>
				</p>
			</div>

			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
				<!-- Why SIBCO Pillar -->
				<div class="card-hover bg-cream-50 rounded-2xl p-8 border border-cream-400 flex flex-col justify-between group">
					<div>
						<div class="w-12 h-12 rounded-xl bg-coir-50 flex items-center justify-center mb-6 text-coir-600 group-hover:bg-coir-500 group-hover:text-white transition-colors duration-300">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
						</div>
						<h3 class="font-semibold text-charcoal-800 text-xl mb-3"><?php esc_html_e( 'Why SIBCO', 'sibco' ); ?></h3>
						<p class="text-charcoal-400 text-sm leading-relaxed mb-6"><?php esc_html_e( '26 years of refined export experience, certified talite-free compliance, and OEM private label expertise.', 'sibco' ); ?></p>
					</div>
					<a href="<?php echo esc_url( home_url( '/why-sibco/' ) ); ?>" class="inline-flex items-center gap-2 text-coir-600 hover:text-coir-700 text-sm font-semibold group/link">
						<?php esc_html_e( 'Learn Why Buyers Choose Us', 'sibco' ); ?>
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover/link:translate-x-1"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</a>
				</div>

				<!-- Manufacturing Pillar -->
				<div class="card-hover bg-cream-50 rounded-2xl p-8 border border-cream-400 flex flex-col justify-between group">
					<div>
						<div class="w-12 h-12 rounded-xl bg-coir-50 flex items-center justify-center mb-6 text-coir-600 group-hover:bg-coir-500 group-hover:text-white transition-colors duration-300">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
						</div>
						<h3 class="font-semibold text-charcoal-800 text-xl mb-3"><?php esc_html_e( 'Manufacturing Excellence', 'sibco' ); ?></h3>
						<p class="text-charcoal-400 text-sm leading-relaxed mb-6"><?php esc_html_e( 'Complete end-to-end production: fibre sourcing, spinning, weaving, vulcanized rubber backing, and precision embossing.', 'sibco' ); ?></p>
					</div>
					<a href="<?php echo esc_url( home_url( '/manufacturing/' ) ); ?>" class="inline-flex items-center gap-2 text-coir-600 hover:text-coir-700 text-sm font-semibold group/link">
						<?php esc_html_e( 'Explore Manufacturing Process', 'sibco' ); ?>
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover/link:translate-x-1"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</a>
				</div>

				<!-- Products Pillar -->
				<div class="card-hover bg-cream-50 rounded-2xl p-8 border border-cream-400 flex flex-col justify-between group">
					<div>
						<div class="w-12 h-12 rounded-xl bg-coir-50 flex items-center justify-center mb-6 text-coir-600 group-hover:bg-coir-500 group-hover:text-white transition-colors duration-300">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
						</div>
						<h3 class="font-semibold text-charcoal-800 text-xl mb-3"><?php esc_html_e( 'Product Range', 'sibco' ); ?></h3>
						<p class="text-charcoal-400 text-sm leading-relaxed mb-6"><?php esc_html_e( 'Panama grill mats, high-brush mats, custom embossed logo mats, rubber grill inlays, and sensor LED entrance mats.', 'sibco' ); ?></p>
					</div>
					<a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="inline-flex items-center gap-2 text-coir-600 hover:text-coir-700 text-sm font-semibold group/link">
						<?php esc_html_e( 'View Full Product Catalog', 'sibco' ); ?>
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover/link:translate-x-1"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</a>
				</div>

				<!-- Quality Pillar -->
				<div class="card-hover bg-cream-50 rounded-2xl p-8 border border-cream-400 flex flex-col justify-between group">
					<div>
						<div class="w-12 h-12 rounded-xl bg-coir-50 flex items-center justify-center mb-6 text-coir-600 group-hover:bg-coir-500 group-hover:text-white transition-colors duration-300">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
						</div>
						<h3 class="font-semibold text-charcoal-800 text-xl mb-3"><?php esc_html_e( 'Quality & Certifications', 'sibco' ); ?></h3>
						<p class="text-charcoal-400 text-sm leading-relaxed mb-6"><?php esc_html_e( 'Rubber Board registered, EU Talite Free certified, with a 100% pre-dispatch inspection rate and zero quality claims.', 'sibco' ); ?></p>
					</div>
					<a href="<?php echo esc_url( home_url( '/quality/' ) ); ?>" class="inline-flex items-center gap-2 text-coir-600 hover:text-coir-700 text-sm font-semibold group/link">
						<?php esc_html_e( 'See Quality Standards', 'sibco' ); ?>
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover/link:translate-x-1"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</a>
				</div>

				<!-- Sustainability Pillar -->
				<div class="card-hover bg-cream-50 rounded-2xl p-8 border border-cream-400 flex flex-col justify-between group">
					<div>
						<div class="w-12 h-12 rounded-xl bg-coir-50 flex items-center justify-center mb-6 text-coir-600 group-hover:bg-coir-500 group-hover:text-white transition-colors duration-300">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="M7 10.5c0-1.657 2.239-3 5-3s5 1.343 5 3"/><path d="M7 14c0 1.657 2.239 3 5 3s5-1.343 5-3"/></svg>
						</div>
						<h3 class="font-semibold text-charcoal-800 text-xl mb-3"><?php esc_html_e( 'Sustainability Commitment', 'sibco' ); ?></h3>
						<p class="text-charcoal-400 text-sm leading-relaxed mb-6"><?php esc_html_e( '100% natural, biodegradable coconut fibres sourced ethically from Kerala plantations with zero-waste production.', 'sibco' ); ?></p>
					</div>
					<a href="<?php echo esc_url( home_url( '/sustainability/' ) ); ?>" class="inline-flex items-center gap-2 text-coir-600 hover:text-coir-700 text-sm font-semibold group/link">
						<?php esc_html_e( 'Read Sustainability Mission', 'sibco' ); ?>
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover/link:translate-x-1"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</a>
				</div>

				<!-- Contact Pillar -->
				<div class="card-hover bg-coir-500 rounded-2xl p-8 text-white flex flex-col justify-between group shadow-md shadow-coir-600/20">
					<div>
						<div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center mb-6 text-white">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
						</div>
						<h3 class="font-semibold text-white text-xl mb-3"><?php esc_html_e( 'Start Your Enquiry', 'sibco' ); ?></h3>
						<p class="text-white/80 text-sm leading-relaxed mb-6"><?php esc_html_e( 'Connect directly with our export desk. Request product swatches, technical data sheets, and custom container pricing.', 'sibco' ); ?></p>
					</div>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="inline-flex items-center gap-2 text-white font-semibold text-sm group/link underline underline-offset-4">
						<?php esc_html_e( 'Contact Export Team', 'sibco' ); ?>
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover/link:translate-x-1"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- ============ TESTIMONIALS ============ -->
	<section class="py-24 lg:py-32 bg-cream-100">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<!-- Header -->
			<div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
				<div class="inline-flex items-center gap-2 bg-coir-50 border border-coir-200 rounded-full px-4 py-1.5 mb-6">
					<span class="w-1.5 h-1.5 bg-coir-500 rounded-full"></span>
					<span class="text-coir-700 text-xs font-semibold tracking-wider uppercase"><?php esc_html_e( 'Client Confidence', 'sibco' ); ?></span>
				</div>
				<h2 class="font-serif text-3xl lg:text-4xl xl:text-5xl font-600 text-charcoal-800 leading-[1.15] tracking-tight mb-5">
					<?php esc_html_e( 'What Our Partners Say', 'sibco' ); ?>
				</h2>
				<p class="text-charcoal-400 text-base lg:text-lg leading-relaxed">
					<?php esc_html_e( 'We maintain strict confidentiality for all OEM partners. The following reflect genuine feedback from our international buyers.', 'sibco' ); ?>
				</p>
			</div>

			<!-- Testimonial Cards -->
			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
				<!-- Testimonial 1 -->
				<div class="animate-on-scroll delay-1 bg-white rounded-2xl p-8 border border-cream-400 card-hover flex flex-col justify-between">
					<div>
						<div class="flex gap-1 mb-6">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
						</div>
						<blockquote class="text-charcoal-600 text-base leading-relaxed mb-6 italic">
							"Reliable manufacturing partner with consistently high product quality. Every shipment meets our specifications without exception."
						</blockquote>
					</div>
					<div class="flex items-center gap-3 pt-6 border-t border-cream-400">
						<div class="w-10 h-10 rounded-full bg-coir-100 flex items-center justify-center">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
						</div>
						<div>
							<div class="text-charcoal-700 text-sm font-semibold">Confidential</div>
							<div class="text-charcoal-400 text-xs">European Home Products Importer</div>
						</div>
					</div>
				</div>

				<!-- Testimonial 2 -->
				<div class="animate-on-scroll delay-2 bg-white rounded-2xl p-8 border border-cream-400 card-hover flex flex-col justify-between">
					<div>
						<div class="flex gap-1 mb-6">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
						</div>
						<blockquote class="text-charcoal-600 text-base leading-relaxed mb-6 italic">
							"Excellent communication and dependable deliveries. SIBCO understands the requirements of the North American market very well."
						</blockquote>
					</div>
					<div class="flex items-center gap-3 pt-6 border-t border-cream-400">
						<div class="w-10 h-10 rounded-full bg-coir-100 flex items-center justify-center">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
						</div>
						<div>
							<div class="text-charcoal-700 text-sm font-semibold">Confidential</div>
							<div class="text-charcoal-400 text-xs">North American Distributor</div>
						</div>
					</div>
				</div>

				<!-- Testimonial 3 -->
				<div class="animate-on-scroll delay-3 bg-white rounded-2xl p-8 border border-cream-400 card-hover flex flex-col justify-between">
					<div>
						<div class="flex gap-1 mb-6">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="#A67C2E" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
						</div>
						<blockquote class="text-charcoal-600 text-base leading-relaxed mb-6 italic">
							"We've been working with SIBCO for our private label coir mats for years. Their consistency and professionalism are unmatched in the industry."
						</blockquote>
					</div>
					<div class="flex items-center gap-3 pt-6 border-t border-cream-400">
						<div class="w-10 h-10 rounded-full bg-coir-100 flex items-center justify-center">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
						</div>
						<div>
							<div class="text-charcoal-700 text-sm font-semibold">Confidential</div>
							<div class="text-charcoal-400 text-xs">European Retail Chain — Private Label</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Reusable Bottom CTA -->
	<?php get_template_part( 'template-parts/cta-banner' ); ?>

<?php
get_footer();

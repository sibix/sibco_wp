<?php
/**
 * Template Name: Sustainability Page
 *
 * @package SIBCO
 */

get_header();

// Subpage Hero Banner
get_template_part( 'template-parts/page-hero' );

$page_id = get_the_ID();

// ACF Fields
$badge     = sibco_get_field( 'sustainability_badge', 'Sustainability', $page_id );
$title     = sibco_get_field( 'sustainability_title', 'Naturally Sustainable. Responsibly Manufactured.', $page_id );
$desc      = sibco_get_field( 'sustainability_description', 'Our commitment to sustainability goes beyond using natural materials. Every aspect of our manufacturing process is designed to minimize environmental impact while delivering premium quality products.', $page_id );

$raw_img   = sibco_get_field( 'sustainability_image', '', $page_id );
$img_url   = sibco_get_image_url( $raw_img, 'https://picsum.photos/seed/natural-coconut-trees/800/700.jpg' );
$img_alt   = sibco_get_image_alt( $raw_img, 'Sustainable Coir Sourcing' );

$badge_stat = sibco_get_field( 'sustainability_badge_stat', '100%', $page_id );
$badge_text = sibco_get_field( 'sustainability_badge_text', "Natural &\nBiodegradable", $page_id );
?>

	<!-- ============ SUSTAINABILITY ============ -->
	<section id="sustainability" class="py-24 lg:py-32 bg-cream-200 relative overflow-hidden">
		<!-- Organic decorative shapes -->
		<div class="absolute top-10 right-10 w-64 h-64 bg-coir-300/10 organic-shape pointer-events-none"></div>
		<div class="absolute bottom-10 left-10 w-48 h-48 bg-coir-200/20 organic-shape-2 pointer-events-none"></div>

		<div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
			<div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
				<!-- Text Column -->
				<div class="animate-left">
					<?php if ( ! empty( $badge ) ) : ?>
					<div class="inline-flex items-center gap-2 bg-coir-50 border border-coir-200 rounded-full px-4 py-1.5 mb-6">
						<span class="w-1.5 h-1.5 bg-coir-500 rounded-full"></span>
						<span class="text-coir-700 text-xs font-semibold tracking-wider uppercase"><?php echo esc_html( $badge ); ?></span>
					</div>
					<?php endif; ?>

					<h2 class="font-serif text-3xl lg:text-4xl xl:text-5xl font-600 text-charcoal-800 leading-[1.15] tracking-tight mb-6">
						<?php echo esc_html( $title ); ?>
					</h2>

					<?php if ( ! empty( $desc ) ) : ?>
					<p class="text-charcoal-400 text-base leading-relaxed mb-10">
						<?php echo esc_html( $desc ); ?>
					</p>
					<?php endif; ?>

					<div class="space-y-6">
						<?php
						if ( function_exists( 'have_rows' ) && have_rows( 'sustainability_pillars', $page_id ) ) :
							while ( have_rows( 'sustainability_pillars', $page_id ) ) :
								the_row();
								$stitle = get_sub_field( 'pillar_title' );
								$sdesc  = get_sub_field( 'pillar_description' );
								if ( empty( $stitle ) ) continue;
								?>
								<div class="flex items-start gap-4">
									<div class="w-10 h-10 rounded-full bg-coir-100 flex items-center justify-center flex-shrink-0 mt-0.5">
										<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="M7 10.5c0-1.657 2.239-3 5-3s5 1.343 5 3"/><path d="M7 14c0 1.657 2.239 3 5 3s5-1.343 5-3"/></svg>
									</div>
									<div>
										<h4 class="font-semibold text-charcoal-800 text-base mb-1"><?php echo esc_html( $stitle ); ?></h4>
										<p class="text-charcoal-400 text-sm leading-relaxed"><?php echo esc_html( $sdesc ); ?></p>
									</div>
								</div>
								<?php
							endwhile;
						else :
							?>
							<div class="flex items-start gap-4">
								<div class="w-10 h-10 rounded-full bg-coir-100 flex items-center justify-center flex-shrink-0 mt-0.5">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="M7 10.5c0-1.657 2.239-3 5-3s5 1.343 5 3"/><path d="M7 14c0 1.657 2.239 3 5 3s5-1.343 5-3"/></svg>
								</div>
								<div>
									<h4 class="font-semibold text-charcoal-800 text-base mb-1"><?php esc_html_e( 'Natural Renewable Coir', 'sibco' ); ?></h4>
									<p class="text-charcoal-400 text-sm leading-relaxed"><?php esc_html_e( 'Coir is a naturally renewable resource extracted from coconut husks, making it one of the most sustainable raw materials available.', 'sibco' ); ?></p>
								</div>
							</div>
							<div class="flex items-start gap-4">
								<div class="w-10 h-10 rounded-full bg-coir-100 flex items-center justify-center flex-shrink-0 mt-0.5">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
								</div>
								<div>
									<h4 class="font-semibold text-charcoal-800 text-base mb-1"><?php esc_html_e( 'Eco-Friendly Manufacturing', 'sibco' ); ?></h4>
									<p class="text-charcoal-400 text-sm leading-relaxed"><?php esc_html_e( 'Our production processes minimize waste and energy consumption, adhering to environmentally responsible manufacturing practices.', 'sibco' ); ?></p>
								</div>
							</div>
							<div class="flex items-start gap-4">
								<div class="w-10 h-10 rounded-full bg-coir-100 flex items-center justify-center flex-shrink-0 mt-0.5">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
								</div>
								<div>
									<h4 class="font-semibold text-charcoal-800 text-base mb-1"><?php esc_html_e( 'Responsible Production', 'sibco' ); ?></h4>
									<p class="text-charcoal-400 text-sm leading-relaxed"><?php esc_html_e( 'From sourcing to dispatch, we maintain ethical production standards that support local communities and protect the environment.', 'sibco' ); ?></p>
								</div>
							</div>
							<div class="flex items-start gap-4">
								<div class="w-10 h-10 rounded-full bg-coir-100 flex items-center justify-center flex-shrink-0 mt-0.5">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
								</div>
								<div>
									<h4 class="font-semibold text-charcoal-800 text-base mb-1"><?php esc_html_e( 'Biodegradable Products', 'sibco' ); ?></h4>
									<p class="text-charcoal-400 text-sm leading-relaxed"><?php esc_html_e( '100% natural coir products that are fully biodegradable, aligning with circular economy principles and reducing landfill impact.', 'sibco' ); ?></p>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Image Column -->
				<div class="animate-right relative">
					<div class="rounded-2xl overflow-hidden shadow-sm">
						<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="w-full h-[400px] lg:h-[550px] object-cover">
					</div>
					<!-- Floating eco badge -->
					<?php if ( ! empty( $badge_stat ) ) : ?>
					<div class="absolute -bottom-4 -left-4 lg:-left-8 bg-coir-500 text-white rounded-xl p-5 shadow-lg">
						<div class="text-2xl font-bold font-serif"><?php echo esc_html( $badge_stat ); ?></div>
						<div class="text-white/80 text-xs font-medium mt-0.5 whitespace-pre-line"><?php echo esc_html( $badge_text ); ?></div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- Reusable Trust Bar -->
	<?php get_template_part( 'template-parts/trust-bar' ); ?>

	<!-- Reusable Bottom CTA -->
	<?php get_template_part( 'template-parts/cta-banner' ); ?>

<?php
get_footer();

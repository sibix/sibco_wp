<?php
/**
 * Template Name: About Page
 *
 * @package SIBCO
 */

get_header();

// Subpage Hero Banner
get_template_part( 'template-parts/page-hero' );

$page_id = get_the_ID();

// ACF Fields with fallbacks
$badge     = sibco_get_field( 'about_badge', 'About SIBCO', $page_id );
$title     = sibco_get_field( 'about_title', 'A Legacy of Premium Coir Manufacturing Since 1998', $page_id );
$raw_img   = sibco_get_field( 'about_image', '', $page_id );
$img_url   = sibco_get_image_url( $raw_img, 'https://picsum.photos/seed/factory-exterior-premium/800/600.jpg' );
$img_alt   = sibco_get_image_alt( $raw_img, 'SIBCO Manufacturing Facility' );

$stat_num  = sibco_get_field( 'about_stat_number', '26+', $page_id );
$stat_lbl  = sibco_get_field( 'about_stat_label', "Years of\nManufacturing", $page_id );

$content   = sibco_get_field( 'about_content', '', $page_id );
$cta_text  = sibco_get_field( 'about_cta_text', 'Learn More About Our Process', $page_id );
$cta_url   = sibco_get_field( 'about_cta_url', home_url( '/manufacturing/' ), $page_id );
?>

	<!-- ============ ABOUT SIBCO SECTION ============ -->
	<section id="about" class="py-24 lg:py-32 bg-cream-50">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
				<!-- Image Column -->
				<div class="animate-left relative">
					<div class="relative rounded-2xl overflow-hidden shadow-sm">
						<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="w-full h-[400px] lg:h-[500px] object-cover">
					</div>
					<!-- Floating stat card -->
					<?php if ( ! empty( $stat_num ) ) : ?>
					<div class="absolute -bottom-6 -right-4 lg:-right-8 bg-white rounded-xl shadow-lg shadow-charcoal-700/8 p-5 border border-cream-400">
						<div class="text-coir-600 font-bold text-3xl font-serif"><?php echo esc_html( $stat_num ); ?></div>
						<div class="text-charcoal-400 text-xs font-medium tracking-wide uppercase mt-1 whitespace-pre-line"><?php echo esc_html( $stat_lbl ); ?></div>
					</div>
					<?php endif; ?>
					<!-- Decorative element -->
					<div class="absolute -top-4 -left-4 w-20 h-20 border-2 border-coir-300/30 rounded-2xl -z-10"></div>
				</div>

				<!-- Text Column -->
				<div class="animate-right">
					<?php if ( ! empty( $badge ) ) : ?>
					<div class="inline-flex items-center gap-2 bg-coir-50 border border-coir-200 rounded-full px-4 py-1.5 mb-6">
						<span class="w-1.5 h-1.5 bg-coir-500 rounded-full"></span>
						<span class="text-coir-700 text-xs font-semibold tracking-wider uppercase"><?php echo esc_html( $badge ); ?></span>
					</div>
					<?php endif; ?>

					<h2 class="font-serif text-3xl lg:text-4xl xl:text-5xl font-600 text-charcoal-800 leading-[1.15] tracking-tight mb-6">
						<?php echo esc_html( $title ); ?>
					</h2>

					<div class="space-y-4 text-charcoal-500 text-base leading-relaxed mb-8">
						<?php if ( ! empty( $content ) ) : ?>
							<?php echo wp_kses_post( $content ); ?>
						<?php else : ?>
							<p>
								SIBCO is a premium coir mat manufacturer with a 26-year legacy of delivering exceptional quality products to international markets. Based in India's coir heartland, we combine traditional craftsmanship with modern manufacturing capabilities.
							</p>
							<p>
								Our state-of-the-art production facility is purpose-built for export-quality manufacturing, serving importers, distributors, retail chains, and OEM private label brands across the European Union and United States.
							</p>
							<p>
								We are committed to sustainable manufacturing using 100% natural coir, maintaining long-term partnerships built on trust, consistent quality, and reliable delivery.
							</p>
						<?php endif; ?>
					</div>

					<!-- Key Points -->
					<div class="grid grid-cols-2 gap-4 mb-10">
						<?php
						if ( function_exists( 'have_rows' ) && have_rows( 'about_key_points', $page_id ) ) :
							while ( have_rows( 'about_key_points', $page_id ) ) :
								the_row();
								$point_text = get_sub_field( 'point_text' );
								if ( empty( $point_text ) ) continue;
								?>
								<div class="flex items-center gap-3">
									<div class="w-8 h-8 rounded-lg bg-coir-50 flex items-center justify-center flex-shrink-0">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
									</div>
									<span class="text-charcoal-600 text-sm font-medium"><?php echo esc_html( $point_text ); ?></span>
								</div>
								<?php
							endwhile;
						else :
							$fallback_points = array(
								'Export Quality Focus',
								'Strong Production Capacity',
								'Sustainable Materials',
								'Long-Term Partnerships',
							);
							foreach ( $fallback_points as $pt ) :
								?>
								<div class="flex items-center gap-3">
									<div class="w-8 h-8 rounded-lg bg-coir-50 flex items-center justify-center flex-shrink-0">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
									</div>
									<span class="text-charcoal-600 text-sm font-medium"><?php echo esc_html( $pt ); ?></span>
								</div>
								<?php
							endforeach;
						endif;
						?>
					</div>

					<?php if ( ! empty( $cta_text ) ) : ?>
					<a href="<?php echo esc_url( $cta_url ); ?>" class="inline-flex items-center gap-2 text-coir-600 hover:text-coir-700 font-semibold text-sm tracking-wide group transition-colors duration-200">
						<?php echo esc_html( $cta_text ); ?>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-200 group-hover:translate-x-1"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</a>
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

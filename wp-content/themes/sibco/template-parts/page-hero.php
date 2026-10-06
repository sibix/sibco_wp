<?php
/**
 * Subpage Hero Banner Template Part
 *
 * @package SIBCO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_id = get_the_ID();

// ACF Fields with fallbacks
$badge     = sibco_get_field( 'hero_badge', get_the_title(), $page_id );
$title     = sibco_get_field( 'hero_title', get_the_title(), $page_id );
$desc      = sibco_get_field( 'hero_description', '', $page_id );
$btn1_text = sibco_get_field( 'hero_button_text', __( 'Request a Quote', 'sibco' ), $page_id );
$btn1_url  = sibco_get_field( 'hero_button_url', home_url( '/contact/' ), $page_id );
$btn2_text = sibco_get_field( 'hero_button_secondary_text', '', $page_id );
$btn2_url  = sibco_get_field( 'hero_button_secondary_url', '', $page_id );

$raw_img = sibco_get_field( 'hero_image', '', $page_id );
$bg_url  = sibco_get_image_url( $raw_img, 'https://picsum.photos/seed/coir-factory-floor/1920/800.jpg' );
?>

<!-- ============ PAGE HERO BANNER ============ -->
<section class="hero-section relative py-28 lg:py-36 flex items-center overflow-hidden bg-charcoal-800">
	<!-- Background Image & Overlays -->
	<div class="absolute inset-0">
		<img src="<?php echo esc_url( $bg_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="w-full h-full object-cover">
		<div class="absolute inset-0 bg-gradient-to-r from-charcoal-800/95 via-charcoal-800/85 to-charcoal-800/60"></div>
		<div class="absolute inset-0 bg-gradient-to-t from-charcoal-800/70 via-transparent to-charcoal-800/40"></div>
	</div>

	<!-- Content -->
	<div class="hero-loaded relative z-10 max-w-7xl mx-auto px-6 lg:px-8 w-full pt-12">
		<div class="max-w-3xl">
			<!-- Breadcrumb / Badge -->
			<?php if ( ! empty( $badge ) ) : ?>
			<div class="hero-title inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/10 rounded-full px-4 py-1.5 mb-6">
				<span class="w-2 h-2 bg-coir-400 rounded-full"></span>
				<span class="text-white/80 text-xs font-medium tracking-wider uppercase"><?php echo esc_html( $badge ); ?></span>
			</div>
			<?php endif; ?>

			<!-- Title -->
			<h1 class="hero-title font-serif text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-600 text-white leading-[1.15] tracking-tight mb-6">
				<?php echo esc_html( $title ); ?>
			</h1>

			<!-- Subtitle -->
			<?php if ( ! empty( $desc ) ) : ?>
			<p class="hero-sub text-base lg:text-lg text-white/70 font-light leading-relaxed max-w-2xl mb-8">
				<?php echo esc_html( $desc ); ?>
			</p>
			<?php endif; ?>

			<!-- CTAs -->
			<?php if ( ! empty( $btn1_text ) || ! empty( $btn2_text ) ) : ?>
			<div class="hero-ctas flex flex-wrap gap-4">
				<?php if ( ! empty( $btn1_text ) ) : ?>
				<a href="<?php echo esc_url( $btn1_url ); ?>" class="btn-primary bg-coir-500 hover:bg-coir-600 text-white font-semibold px-7 py-3.5 rounded-lg text-sm transition-colors duration-200 inline-flex items-center gap-2">
					<?php echo esc_html( $btn1_text ); ?>
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
				</a>
				<?php endif; ?>

				<?php if ( ! empty( $btn2_text ) ) : ?>
				<a href="<?php echo esc_url( $btn2_url ); ?>" class="bg-white/10 hover:bg-white/15 backdrop-blur-sm border border-white/20 text-white font-medium px-7 py-3.5 rounded-lg text-sm transition-all duration-200 inline-flex items-center gap-2">
					<?php echo esc_html( $btn2_text ); ?>
				</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

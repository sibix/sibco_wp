<?php
/**
 * Bottom CTA Banner Template Part
 *
 * @package SIBCO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_id = get_the_ID();
$override = sibco_get_field( 'cta_override', false, $page_id );

$badge    = $override ? sibco_get_field( 'cta_badge', 'Ready to Partner', $page_id ) : 'Ready to Partner';
$heading  = $override ? sibco_get_field( 'cta_heading', 'Looking for a Reliable Coir Mat Manufacturing Partner?', $page_id ) : 'Looking for a Reliable Coir Mat Manufacturing Partner?';
$desc     = $override ? sibco_get_field( 'cta_description', "Partner with SIBCO for high-quality natural coir mats backed by 26 years of manufacturing excellence. Let's discuss your requirements.", $page_id ) : "Partner with SIBCO for high-quality natural coir mats backed by 26 years of manufacturing excellence. Let's discuss your requirements.";
$btn1_txt = $override ? sibco_get_field( 'cta_btn1_text', 'Request Quote', $page_id ) : 'Request Quote';
$btn1_url = $override ? sibco_get_field( 'cta_btn1_url', home_url( '/contact/' ), $page_id ) : home_url( '/contact/' );
$btn2_txt = $override ? sibco_get_field( 'cta_btn2_text', 'Contact Export Team', $page_id ) : 'Contact Export Team';
$btn2_url = $override ? sibco_get_field( 'cta_btn2_url', home_url( '/contact/' ), $page_id ) : home_url( '/contact/' );

$raw_img = $override ? sibco_get_field( 'cta_background_image', '', $page_id ) : '';
$bg_url  = sibco_get_image_url( $raw_img, 'https://picsum.photos/seed/coir-warehouse-export/1920/800.jpg' );

$email = sibco_get_field( 'contact_email', 'export@sibco.in', 'option' );
$phone = sibco_get_field( 'contact_phone', '+91 XXX XXX XXXX', 'option' );
$loc   = sibco_get_field( 'contact_location', 'Kerala, India', 'option' );
?>

<!-- ============ FINAL CTA ============ -->
<section id="contact-cta" class="relative py-28 lg:py-36 overflow-hidden bg-charcoal-800">
	<!-- Background Image & Overlay -->
	<div class="absolute inset-0">
		<img src="<?php echo esc_url( $bg_url ); ?>" alt="SIBCO Export Facility" class="w-full h-full object-cover">
		<div class="absolute inset-0 bg-charcoal-800/85"></div>
	</div>

	<!-- Content -->
	<div class="relative z-10 max-w-4xl mx-auto px-6 lg:px-8 text-center animate-on-scroll">
		<?php if ( ! empty( $badge ) ) : ?>
		<div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 rounded-full px-4 py-1.5 mb-8 backdrop-blur-sm">
			<span class="w-2 h-2 bg-coir-400 rounded-full" style="animation: subtlePulse 2s ease-in-out infinite;"></span>
			<span class="text-white/60 text-xs font-medium tracking-wider uppercase"><?php echo esc_html( $badge ); ?></span>
		</div>
		<?php endif; ?>

		<h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-600 text-white leading-[1.1] tracking-tight mb-6">
			<?php echo esc_html( $heading ); ?>
		</h2>

		<p class="text-white/60 text-base lg:text-xl font-light leading-relaxed max-w-2xl mx-auto mb-12">
			<?php echo esc_html( $desc ); ?>
		</p>

		<div class="flex flex-wrap justify-center gap-4">
			<a href="<?php echo esc_url( $btn1_url ); ?>" class="btn-primary bg-coir-500 hover:bg-coir-600 text-white font-semibold px-9 py-4 rounded-lg text-base transition-colors duration-200 inline-flex items-center gap-2">
				<?php echo esc_html( $btn1_txt ); ?>
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
			</a>
			<a href="<?php echo esc_url( $btn2_url ); ?>" class="bg-white/10 hover:bg-white/15 backdrop-blur-sm border border-white/20 text-white font-medium px-9 py-4 rounded-lg text-base transition-all duration-200 inline-flex items-center gap-2">
				<?php echo esc_html( $btn2_txt ); ?>
			</a>
		</div>

		<!-- Quick contact info -->
		<div class="flex flex-wrap justify-center gap-8 mt-12 pt-8 border-t border-white/10">
			<div class="flex items-center gap-3">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
				<span class="text-white/50 text-sm"><?php echo esc_html( $email ); ?></span>
			</div>
			<div class="flex items-center gap-3">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
				<span class="text-white/50 text-sm"><?php echo esc_html( $phone ); ?></span>
			</div>
			<div class="flex items-center gap-3">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
				<span class="text-white/50 text-sm"><?php echo esc_html( $loc ); ?></span>
			</div>
		</div>
	</div>
</section>

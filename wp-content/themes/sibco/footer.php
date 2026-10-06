<?php
/**
 * Footer template for SIBCO theme
 *
 * @package SIBCO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$footer_desc = sibco_get_field( 'footer_description', 'Premium coir mat manufacturer with 26 years of export excellence. Trusted by importers, distributors, and OEM brands across Europe and North America.', 'option' );
$contact_email = sibco_get_field( 'contact_email', 'export@sibco.in', 'option' );
$contact_phone = sibco_get_field( 'contact_phone', '+91 XXX XXX XXXX', 'option' );
$contact_location = sibco_get_field( 'contact_location', 'Kerala, India', 'option' );
$copyright = sibco_get_field( 'footer_copyright', '© 2024 SIBCO. All rights reserved. Premium Coir Mat Manufacturer.', 'option' );
$social_linkedin = sibco_get_field( 'social_linkedin', '#', 'option' );
$social_facebook = sibco_get_field( 'social_facebook', '#', 'option' );
$social_instagram = sibco_get_field( 'social_instagram', '#', 'option' );
?>

	<!-- ============ FOOTER ============ -->
	<footer class="bg-charcoal-800 pt-20 pb-8 text-white">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<div class="grid md:grid-cols-2 lg:grid-cols-5 gap-12 lg:gap-8 pb-16 border-b border-white/8">
				<!-- Brand Column -->
				<div class="lg:col-span-2">
					<div class="text-white font-bold text-2xl tracking-tight mb-4">
						<?php bloginfo( 'name' ); ?>
					</div>
					<p class="text-white/40 text-sm leading-relaxed max-w-sm mb-6">
						<?php echo esc_html( $footer_desc ); ?>
					</p>
					<!-- Social Links -->
					<div class="flex gap-3">
						<?php if ( ! empty( $social_linkedin ) ) : ?>
						<a href="<?php echo esc_url( $social_linkedin ); ?>" class="w-9 h-9 rounded-lg bg-white/5 border border-white/8 flex items-center justify-center text-white/40 hover:text-coir-400 hover:border-coir-400/30 transition-all duration-200" aria-label="<?php esc_attr_e( 'LinkedIn', 'sibco' ); ?>" target="_blank" rel="noopener noreferrer">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
						</a>
						<?php endif; ?>

						<?php if ( ! empty( $social_facebook ) ) : ?>
						<a href="<?php echo esc_url( $social_facebook ); ?>" class="w-9 h-9 rounded-lg bg-white/5 border border-white/8 flex items-center justify-center text-white/40 hover:text-coir-400 hover:border-coir-400/30 transition-all duration-200" aria-label="<?php esc_attr_e( 'Facebook', 'sibco' ); ?>" target="_blank" rel="noopener noreferrer">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
						</a>
						<?php endif; ?>

						<?php if ( ! empty( $social_instagram ) ) : ?>
						<a href="<?php echo esc_url( $social_instagram ); ?>" class="w-9 h-9 rounded-lg bg-white/5 border border-white/8 flex items-center justify-center text-white/40 hover:text-coir-400 hover:border-coir-400/30 transition-all duration-200" aria-label="<?php esc_attr_e( 'Instagram', 'sibco' ); ?>" target="_blank" rel="noopener noreferrer">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
						</a>
						<?php endif; ?>
					</div>
				</div>

				<!-- Company Links -->
				<div>
					<h4 class="text-white font-semibold text-sm tracking-wide uppercase mb-5"><?php esc_html_e( 'Company', 'sibco' ); ?></h4>
					<?php
					if ( has_nav_menu( 'footer_company' ) ) :
						wp_nav_menu(
							array(
								'theme_location' => 'footer_company',
								'container'      => false,
								'menu_class'     => 'space-y-3',
								'depth'          => 1,
							)
						);
					else :
						?>
						<ul class="space-y-3">
							<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="text-white/40 text-sm hover:text-coir-400 transition-colors duration-200"><?php esc_html_e( 'About SIBCO', 'sibco' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/why-sibco/' ) ); ?>" class="text-white/40 text-sm hover:text-coir-400 transition-colors duration-200"><?php esc_html_e( 'Why SIBCO', 'sibco' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/manufacturing/' ) ); ?>" class="text-white/40 text-sm hover:text-coir-400 transition-colors duration-200"><?php esc_html_e( 'Manufacturing', 'sibco' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/sustainability/' ) ); ?>" class="text-white/40 text-sm hover:text-coir-400 transition-colors duration-200"><?php esc_html_e( 'Sustainability', 'sibco' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="text-white/40 text-sm hover:text-coir-400 transition-colors duration-200"><?php esc_html_e( 'Contact Us', 'sibco' ); ?></a></li>
						</ul>
						<?php
					endif;
					?>
				</div>

				<!-- Products Links -->
				<div>
					<h4 class="text-white font-semibold text-sm tracking-wide uppercase mb-5"><?php esc_html_e( 'Products', 'sibco' ); ?></h4>
					<?php
					if ( has_nav_menu( 'footer_products' ) ) :
						wp_nav_menu(
							array(
								'theme_location' => 'footer_products',
								'container'      => false,
								'menu_class'     => 'space-y-3',
								'depth'          => 1,
							)
						);
					else :
						?>
						<ul class="space-y-3">
							<li><a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="text-white/40 text-sm hover:text-coir-400 transition-colors duration-200"><?php esc_html_e( 'Panama Grill Mats', 'sibco' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="text-white/40 text-sm hover:text-coir-400 transition-colors duration-200"><?php esc_html_e( 'Brush Grill Mats', 'sibco' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="text-white/40 text-sm hover:text-coir-400 transition-colors duration-200"><?php esc_html_e( 'Brush Coir Mats', 'sibco' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="text-white/40 text-sm hover:text-coir-400 transition-colors duration-200"><?php esc_html_e( 'Embossing Mats', 'sibco' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="text-white/40 text-sm hover:text-coir-400 transition-colors duration-200"><?php esc_html_e( 'LED Light Mats', 'sibco' ); ?></a></li>
						</ul>
						<?php
					endif;
					?>
				</div>

				<!-- Contact Info -->
				<div>
					<h4 class="text-white font-semibold text-sm tracking-wide uppercase mb-5"><?php esc_html_e( 'Contact', 'sibco' ); ?></h4>
					<ul class="space-y-3">
						<li class="flex items-start gap-2">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5 flex-shrink-0"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
							<a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="text-white/40 text-sm hover:text-white transition-colors"><?php echo esc_html( $contact_email ); ?></a>
						</li>
						<li class="flex items-start gap-2">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5 flex-shrink-0"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
							<span class="text-white/40 text-sm"><?php echo esc_html( $contact_phone ); ?></span>
						</li>
						<li class="flex items-start gap-2">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5 flex-shrink-0"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
							<span class="text-white/40 text-sm"><?php echo esc_html( $contact_location ); ?></span>
						</li>
					</ul>
					<div class="mt-6">
						<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="inline-flex items-center gap-2 text-coir-400 hover:text-coir-300 text-sm font-semibold transition-colors duration-200">
							<?php esc_html_e( 'Request a Quote', 'sibco' ); ?>
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
						</a>
					</div>
				</div>
			</div>

			<!-- Bottom Bar -->
			<div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-8">
				<p class="text-white/25 text-xs"><?php echo esc_html( $copyright ); ?></p>
				<div class="flex gap-6">
					<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="text-white/25 text-xs hover:text-white/50 transition-colors duration-200"><?php esc_html_e( 'Privacy Policy', 'sibco' ); ?></a>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="text-white/25 text-xs hover:text-white/50 transition-colors duration-200"><?php esc_html_e( 'Terms of Service', 'sibco' ); ?></a>
				</div>
			</div>
		</div>
	</footer>

<?php wp_footer(); ?>
</body>
</html>

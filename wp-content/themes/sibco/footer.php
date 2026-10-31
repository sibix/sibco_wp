<?php
/**
 * Footer template for SIBCO theme
 *
 * @package SIBCO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$footer_desc     = sibco_get_field( 'footer_description', 'Premium coir mat manufacturer with 26 years of export excellence. Trusted by importers, distributors, and OEM brands.', 'option' );

$contact_email   = sibco_get_field( 'contact_email', 'sibco.coir@gmail.com', 'option' );
if ( empty( $contact_email ) || 'sales@sibcocoir.com' === $contact_email ) {
	$contact_email = 'sibco.coir@gmail.com';
}

$contact_phone   = sibco_get_field( 'contact_phone', '+91 91885 92052', 'option' );
if ( empty( $contact_phone ) || false !== strpos( $contact_phone, 'XXX' ) ) {
	$contact_phone = '+91 91885 92052';
}

$contact_phone_2 = sibco_get_field( 'contact_phone_2', '+91 83300 65483', 'option' );
if ( empty( $contact_phone_2 ) ) {
	$contact_phone_2 = '+91 83300 65483';
}

$contact_location = sibco_get_field( 'contact_location', 'Kerala, India', 'option' );
$copyright       = sibco_get_field( 'footer_copyright', '© ' . date( 'Y' ) . ' SIBCO. All rights reserved. Premium Coir Mat Manufacturer.', 'option' );

$social_instagram = sibco_get_field( 'social_instagram', 'https://www.instagram.com/_sibco_?utm_source=qr&cplk=MTEzZ2k3MzI3MnZjdQ==', 'option' );
if ( empty( $social_instagram ) || '#' === $social_instagram ) {
	$social_instagram = 'https://www.instagram.com/_sibco_?utm_source=qr&cplk=MTEzZ2k3MzI3MnZjdQ==';
}

// Sister Concerns
$sister_title    = sibco_get_field( 'footer_sister_concerns_title', 'Our Sister Concerns', 'option' );
if ( empty( $sister_title ) ) {
	$sister_title = 'Our Sister Concerns';
}

$sister_subtitle = sibco_get_field( 'footer_sister_concerns_subtitle', 'Group Companies & Strategic Partners', 'option' );
if ( empty( $sister_subtitle ) ) {
	$sister_subtitle = 'Group Companies & Strategic Partners';
}

$default_sister_1_logo = get_template_directory_uri() . '/assets/images/sister-concerns/sibco-coir-tech.png';
$raw_sister_1_logo     = sibco_get_field( 'sister_concern_1_logo', '', 'option' );
$sister_1_logo         = ! empty( $raw_sister_1_logo ) ? sibco_get_image_url( $raw_sister_1_logo, $default_sister_1_logo ) : $default_sister_1_logo;
$sister_1_name         = sibco_get_field( 'sister_concern_1_name', 'SIBCO Coir Tech', 'option' );
if ( empty( $sister_1_name ) ) {
	$sister_1_name = 'SIBCO Coir Tech';
}
$sister_1_url          = sibco_get_field( 'sister_concern_1_url', '', 'option' );

$default_sister_2_logo = get_template_directory_uri() . '/assets/images/sister-concerns/mattrends.png';
$raw_sister_2_logo     = sibco_get_field( 'sister_concern_2_logo', '', 'option' );
$sister_2_logo         = ! empty( $raw_sister_2_logo ) ? sibco_get_image_url( $raw_sister_2_logo, $default_sister_2_logo ) : $default_sister_2_logo;
$sister_2_name         = sibco_get_field( 'sister_concern_2_name', 'Mattrends', 'option' );
if ( empty( $sister_2_name ) ) {
	$sister_2_name = 'Mattrends';
}
$sister_2_url          = sibco_get_field( 'sister_concern_2_url', '', 'option' );
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
					<!-- Social Links (Only Instagram as requested) -->
					<?php if ( ! empty( $social_instagram ) ) : ?>
					<div class="flex items-center gap-3">
						<a href="<?php echo esc_url( $social_instagram ); ?>" class="inline-flex items-center gap-2.5 px-4 py-2 rounded-lg bg-white/5 border border-white/10 text-white/70 hover:text-coir-400 hover:border-coir-400/40 hover:bg-white/10 transition-all duration-200 text-xs font-medium tracking-wide shadow-sm" aria-label="<?php esc_attr_e( 'Follow SIBCO on Instagram', 'sibco' ); ?>" target="_blank" rel="noopener noreferrer">
							<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 text-coir-400"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
							<span>Instagram</span>
						</a>
					</div>
					<?php endif; ?>
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
						<li class="flex items-start gap-2.5">
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5 flex-shrink-0"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
							<a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="text-white/60 text-sm hover:text-coir-400 transition-colors break-all"><?php echo esc_html( $contact_email ); ?></a>
						</li>
						<li class="flex items-start gap-2.5">
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5 flex-shrink-0"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
							<div class="flex flex-col space-y-1">
								<?php if ( ! empty( $contact_phone ) ) : ?>
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone ) ); ?>" class="text-white/60 text-sm hover:text-coir-400 transition-colors"><?php echo esc_html( $contact_phone ); ?></a>
								<?php endif; ?>
								<?php if ( ! empty( $contact_phone_2 ) ) : ?>
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone_2 ) ); ?>" class="text-white/60 text-sm hover:text-coir-400 transition-colors"><?php echo esc_html( $contact_phone_2 ); ?></a>
								<?php endif; ?>
							</div>
						</li>
						<li class="flex items-start gap-2.5">
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5 flex-shrink-0"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
							<span class="text-white/60 text-sm"><?php echo esc_html( $contact_location ); ?></span>
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

			<!-- Sister Concerns Showcase -->
			<div class="py-12 border-b border-white/8">
				<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8">
					<div class="max-w-md">
						<div class="inline-flex items-center gap-2 mb-2">
							<span class="w-2 h-2 rounded-full bg-coir-400"></span>
							<span class="text-coir-400 text-xs font-semibold tracking-widest uppercase"><?php echo esc_html( $sister_subtitle ); ?></span>
						</div>
						<h3 class="font-serif text-xl sm:text-2xl font-bold text-white tracking-tight">
							<?php echo esc_html( $sister_title ); ?>
						</h3>
						<p class="text-white/40 text-sm mt-1">
							<?php esc_html_e( 'Manufacturing excellence and innovative floor covering solutions under one family.', 'sibco' ); ?>
						</p>
					</div>

					<div class="flex flex-wrap items-center gap-4 sm:gap-6">
						<!-- Sister Concern 1: SIBCO Coir Tech -->
						<?php if ( ! empty( $sister_1_url ) ) : ?>
						<a href="<?php echo esc_url( $sister_1_url ); ?>" target="_blank" rel="noopener noreferrer" class="bg-white rounded-2xl px-6 py-4 flex items-center justify-center shadow-lg shadow-black/20 hover:scale-[1.03] transition-all duration-300 border border-white/10 hover:ring-2 hover:ring-coir-400/50" title="<?php echo esc_attr( $sister_1_name ); ?>">
							<img src="<?php echo esc_url( $sister_1_logo ); ?>" alt="<?php echo esc_attr( $sister_1_name ); ?>" class="h-11 sm:h-12 w-auto max-w-[190px] object-contain" loading="lazy">
						</a>
						<?php else : ?>
						<div class="bg-white rounded-2xl px-6 py-4 flex items-center justify-center shadow-lg shadow-black/20 hover:scale-[1.03] transition-all duration-300 border border-white/10" title="<?php echo esc_attr( $sister_1_name ); ?>">
							<img src="<?php echo esc_url( $sister_1_logo ); ?>" alt="<?php echo esc_attr( $sister_1_name ); ?>" class="h-11 sm:h-12 w-auto max-w-[190px] object-contain" loading="lazy">
						</div>
						<?php endif; ?>

						<!-- Sister Concern 2: Mattrends -->
						<?php if ( ! empty( $sister_2_url ) ) : ?>
						<a href="<?php echo esc_url( $sister_2_url ); ?>" target="_blank" rel="noopener noreferrer" class="bg-white rounded-2xl px-6 py-4 flex items-center justify-center shadow-lg shadow-black/20 hover:scale-[1.03] transition-all duration-300 border border-white/10 hover:ring-2 hover:ring-coir-400/50" title="<?php echo esc_attr( $sister_2_name ); ?>">
							<img src="<?php echo esc_url( $sister_2_logo ); ?>" alt="<?php echo esc_attr( $sister_2_name ); ?>" class="h-11 sm:h-12 w-auto max-w-[140px] object-contain" loading="lazy">
						</a>
						<?php else : ?>
						<div class="bg-white rounded-2xl px-6 py-4 flex items-center justify-center shadow-lg shadow-black/20 hover:scale-[1.03] transition-all duration-300 border border-white/10" title="<?php echo esc_attr( $sister_2_name ); ?>">
							<img src="<?php echo esc_url( $sister_2_logo ); ?>" alt="<?php echo esc_attr( $sister_2_name ); ?>" class="h-11 sm:h-12 w-auto max-w-[140px] object-contain" loading="lazy">
						</div>
						<?php endif; ?>
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

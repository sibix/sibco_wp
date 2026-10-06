<?php
/**
 * Header template for SIBCO theme
 *
 * @package SIBCO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-cream-50 text-charcoal-700 font-sans antialiased overflow-x-hidden' ); ?>>
<?php wp_body_open(); ?>

	<!-- ============ NAVIGATION ============ -->
	<nav id="mainNav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500" style="background: transparent;">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<div class="flex items-center justify-between h-20">
				<!-- Logo -->
				<div class="flex items-center">
					<?php sibco_custom_logo(); ?>
				</div>

				<!-- Desktop Nav -->
				<div class="hidden lg:flex items-center gap-8">
					<?php
					if ( has_nav_menu( 'primary' ) ) :
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'container'      => false,
								'items_wrap'     => '%3$s',
								'fallback_cb'    => false,
								'depth'          => 1,
							)
						);
					else :
						// Dynamic fallback links to the 7 required pages
						$nav_items = array(
							'about'          => __( 'About', 'sibco' ),
							'why-sibco'      => __( 'Why SIBCO', 'sibco' ),
							'manufacturing'  => __( 'Manufacturing', 'sibco' ),
							'products'       => __( 'Products', 'sibco' ),
							'quality'        => __( 'Quality', 'sibco' ),
							'sustainability' => __( 'Sustainability', 'sibco' ),
							'contact'        => __( 'Contact', 'sibco' ),
						);

						foreach ( $nav_items as $slug => $label ) :
							$url = home_url( '/' . $slug . '/' );
							$is_active = is_page( $slug );
							$active_class = $is_active ? ' text-coir-400 font-semibold' : ' text-white/80 hover:text-white';
							?>
							<a href="<?php echo esc_url( $url ); ?>" class="nav-link text-sm font-medium tracking-wide transition-colors duration-200<?php echo esc_attr( $active_class ); ?>">
								<?php echo esc_html( $label ); ?>
							</a>
							<?php
						endforeach;
					endif;
					?>
				</div>

				<!-- CTA -->
				<div class="hidden lg:flex items-center gap-4">
					<?php
					$cta_text = sibco_get_field( 'header_cta_text', __( 'Request a Quote', 'sibco' ), 'option' );
					$cta_url  = sibco_get_field( 'header_cta_url', home_url( '/contact/' ), 'option' );
					?>
					<a href="<?php echo esc_url( $cta_url ); ?>" class="btn-primary bg-coir-500 hover:bg-coir-600 text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition-colors duration-200">
						<?php echo esc_html( $cta_text ); ?>
					</a>
				</div>

				<!-- Mobile Toggle -->
				<button id="mobileToggle" class="lg:hidden nav-link text-white p-2 transition-colors duration-300" aria-label="<?php esc_attr_e( 'Menu', 'sibco' ); ?>">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
						<line x1="3" y1="6" x2="21" y2="6"/>
						<line x1="3" y1="12" x2="21" y2="12"/>
						<line x1="3" y1="18" x2="21" y2="18"/>
					</svg>
				</button>
			</div>
		</div>
	</nav>

	<!-- Mobile Menu Drawer -->
	<div id="mobileMenu" class="mobile-menu fixed inset-0 z-[60] bg-cream-50 overflow-y-auto">
		<div class="flex items-center justify-between px-6 h-20 border-b border-cream-400">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-charcoal-700 font-bold text-2xl tracking-tight">
				<?php bloginfo( 'name' ); ?>
			</a>
			<button id="mobileClose" class="p-2 text-charcoal-700 hover:text-coir-600 transition-colors" aria-label="<?php esc_attr_e( 'Close', 'sibco' ); ?>">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
					<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
				</svg>
			</button>
		</div>
		<div class="px-6 py-8 flex flex-col gap-1">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-nav-link text-2xl font-medium text-charcoal-700 py-3 border-b border-cream-400"><?php esc_html_e( 'Home', 'sibco' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="mobile-nav-link text-2xl font-medium text-charcoal-700 py-3 border-b border-cream-400"><?php esc_html_e( 'About', 'sibco' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/why-sibco/' ) ); ?>" class="mobile-nav-link text-2xl font-medium text-charcoal-700 py-3 border-b border-cream-400"><?php esc_html_e( 'Why SIBCO', 'sibco' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/manufacturing/' ) ); ?>" class="mobile-nav-link text-2xl font-medium text-charcoal-700 py-3 border-b border-cream-400"><?php esc_html_e( 'Manufacturing', 'sibco' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="mobile-nav-link text-2xl font-medium text-charcoal-700 py-3 border-b border-cream-400"><?php esc_html_e( 'Products', 'sibco' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/quality/' ) ); ?>" class="mobile-nav-link text-2xl font-medium text-charcoal-700 py-3 border-b border-cream-400"><?php esc_html_e( 'Quality', 'sibco' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/sustainability/' ) ); ?>" class="mobile-nav-link text-2xl font-medium text-charcoal-700 py-3 border-b border-cream-400"><?php esc_html_e( 'Sustainability', 'sibco' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="mobile-nav-link text-2xl font-medium text-charcoal-700 py-3 border-b border-cream-400"><?php esc_html_e( 'Contact', 'sibco' ); ?></a>

			<a href="<?php echo esc_url( $cta_url ); ?>" class="mt-8 bg-coir-500 hover:bg-coir-600 text-white text-center text-lg font-semibold px-6 py-4 rounded-lg transition-colors">
				<?php echo esc_html( $cta_text ); ?>
			</a>
		</div>
	</div>

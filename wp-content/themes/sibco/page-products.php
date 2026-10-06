<?php
/**
 * Template Name: Products Page
 *
 * @package SIBCO
 */

get_header();

// Subpage Hero Banner
get_template_part( 'template-parts/page-hero' );

$page_id = get_the_ID();

// ACF Fields
$badge = sibco_get_field( 'products_badge', 'Product Range', $page_id );
$title = sibco_get_field( 'products_title', 'Premium Coir Mat Categories', $page_id );
$desc  = sibco_get_field( 'products_description', 'Our comprehensive range of coir mats is designed to meet diverse international market requirements, available in custom sizes and specifications.', $page_id );

$prc_badge = sibco_get_field( 'process_badge', 'How It Works', $page_id );
$prc_title = sibco_get_field( 'process_title', 'Simple B2B Export Process', $page_id );
$prc_desc  = sibco_get_field( 'process_description', 'From initial enquiry to global delivery — our streamlined process makes international sourcing effortless.', $page_id );
?>

	<!-- ============ PRODUCT CATEGORIES ============ -->
	<section id="products" class="py-24 lg:py-32 bg-white">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<!-- Header -->
			<div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
				<?php if ( ! empty( $badge ) ) : ?>
				<div class="inline-flex items-center gap-2 bg-coir-50 border border-coir-200 rounded-full px-4 py-1.5 mb-6">
					<span class="w-1.5 h-1.5 bg-coir-500 rounded-full"></span>
					<span class="text-coir-700 text-xs font-semibold tracking-wider uppercase"><?php echo esc_html( $badge ); ?></span>
				</div>
				<?php endif; ?>

				<h2 class="font-serif text-3xl lg:text-4xl xl:text-5xl font-600 text-charcoal-800 leading-[1.15] tracking-tight mb-5">
					<?php echo esc_html( $title ); ?>
				</h2>

				<?php if ( ! empty( $desc ) ) : ?>
				<p class="text-charcoal-400 text-base lg:text-lg leading-relaxed">
					<?php echo esc_html( $desc ); ?>
				</p>
				<?php endif; ?>
			</div>

			<!-- Products Grid (ACF Repeater) -->
			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
				<?php
				if ( function_exists( 'have_rows' ) && have_rows( 'product_items', $page_id ) ) :
					while ( have_rows( 'product_items', $page_id ) ) :
						the_row();
						$pname = get_sub_field( 'product_name' );
						$pimg  = get_sub_field( 'product_image' );
						$pdesc = get_sub_field( 'product_description' );
						$pbtn  = get_sub_field( 'product_button_text' );
						$purl  = get_sub_field( 'product_button_url' );

						if ( empty( $pname ) ) continue;
						$img_url = sibco_get_image_url( $pimg, 'https://picsum.photos/seed/coir-product/600/400.jpg' );
						$btn_text = ! empty( $pbtn ) ? $pbtn : __( 'View Products', 'sibco' );
						$btn_url  = ! empty( $purl ) ? $purl : home_url( '/contact/' );
						?>
						<div class="product-card card-hover bg-cream-50 rounded-2xl overflow-hidden border border-cream-400 group">
							<div class="overflow-hidden h-[260px]">
								<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $pname ); ?>" class="product-img w-full h-full object-cover">
							</div>
							<div class="p-6">
								<h3 class="font-semibold text-charcoal-800 text-lg mb-2"><?php echo esc_html( $pname ); ?></h3>
								<p class="text-charcoal-400 text-sm leading-relaxed mb-5"><?php echo esc_html( $pdesc ); ?></p>
								<a href="<?php echo esc_url( $btn_url ); ?>" class="inline-flex items-center gap-2 text-coir-600 hover:text-coir-700 text-sm font-semibold group/link transition-colors duration-200">
									<?php echo esc_html( $btn_text ); ?>
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-200 group-hover/link:translate-x-1"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
								</a>
							</div>
						</div>
						<?php
					endwhile;
				else :
					// Fallback to original 6 products
					$default_products = array(
						array(
							'name' => 'Rubber Backed Panama Coir Grill Mat',
							'img'  => 'https://picsum.photos/seed/panama-coir-grill/600/400.jpg',
							'desc' => 'Classic panama weave pattern with durable rubber backing. Ideal for entrance matting in commercial and residential applications.',
						),
						array(
							'name' => 'Rubber Backed Brush Coir Grill Mat',
							'img'  => 'https://picsum.photos/seed/brush-coir-grill/600/400.jpg',
							'desc' => 'High-brush coir surface with open grid pattern for effective dirt scraping. Premium rubber backing for stability and durability.',
						),
						array(
							'name' => 'Rubber Backed Brush Coir Mat',
							'img'  => 'https://picsum.photos/seed/brush-coir-solid/600/400.jpg',
							'desc' => 'Dense brush coir surface with full rubber backing. Excellent scraping action and moisture absorption for high-traffic entrances.',
						),
						array(
							'name' => 'Coir Embossing Mat',
							'img'  => 'https://picsum.photos/seed/coir-emboss-mat/600/400.jpg',
							'desc' => 'Elegantly embossed coir mats with custom designs and logos. Perfect for branded entrance matting and retail display applications.',
						),
						array(
							'name' => 'Rubber Grill Mat',
							'img'  => 'https://picsum.photos/seed/rubber-grill-mat/600/400.jpg',
							'desc' => 'Durable rubber grill mats with coir inlay options. Heavy-duty construction suitable for industrial and commercial entrance applications.',
						),
						array(
							'name' => 'Motion Sensor LED Light Mat',
							'img'  => 'https://picsum.photos/seed/led-sensor-mat/600/400.jpg',
							'desc' => 'Innovative coir mat with integrated motion-sensor LED lighting. Combines functionality with safety for premium entrance solutions.',
						),
					);

					foreach ( $default_products as $dp ) :
						?>
						<div class="product-card card-hover bg-cream-50 rounded-2xl overflow-hidden border border-cream-400 group">
							<div class="overflow-hidden h-[260px]">
								<img src="<?php echo esc_url( $dp['img'] ); ?>" alt="<?php echo esc_attr( $dp['name'] ); ?>" class="product-img w-full h-full object-cover">
							</div>
							<div class="p-6">
								<h3 class="font-semibold text-charcoal-800 text-lg mb-2"><?php echo esc_html( $dp['name'] ); ?></h3>
								<p class="text-charcoal-400 text-sm leading-relaxed mb-5"><?php echo esc_html( $dp['desc'] ); ?></p>
								<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="inline-flex items-center gap-2 text-coir-600 hover:text-coir-700 text-sm font-semibold group/link transition-colors duration-200">
									<?php esc_html_e( 'View Products', 'sibco' ); ?>
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-200 group-hover/link:translate-x-1"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
								</a>
							</div>
						</div>
						<?php
					endforeach;
				endif;
				?>
			</div>
		</div>
	</section>

	<!-- ============ B2B EXPORT PROCESS ============ -->
	<section class="py-24 lg:py-32 bg-cream-50 border-t border-cream-400">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<!-- Header -->
			<div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
				<?php if ( ! empty( $prc_badge ) ) : ?>
				<div class="inline-flex items-center gap-2 bg-coir-50 border border-coir-200 rounded-full px-4 py-1.5 mb-6">
					<span class="w-1.5 h-1.5 bg-coir-500 rounded-full"></span>
					<span class="text-coir-700 text-xs font-semibold tracking-wider uppercase"><?php echo esc_html( $prc_badge ); ?></span>
				</div>
				<?php endif; ?>

				<h2 class="font-serif text-3xl lg:text-4xl xl:text-5xl font-600 text-charcoal-800 leading-[1.15] tracking-tight mb-5">
					<?php echo esc_html( $prc_title ); ?>
				</h2>

				<?php if ( ! empty( $prc_desc ) ) : ?>
				<p class="text-charcoal-400 text-base lg:text-lg leading-relaxed">
					<?php echo esc_html( $prc_desc ); ?>
				</p>
				<?php endif; ?>
			</div>

			<!-- 4 Steps -->
			<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
				<!-- Step 1 -->
				<div class="animate-on-scroll delay-1 text-center relative">
					<div class="w-20 h-20 mx-auto rounded-2xl bg-coir-50 border border-coir-200 flex items-center justify-center mb-6">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
					</div>
					<div class="text-coir-500 text-xs font-bold tracking-widest uppercase mb-2"><?php esc_html_e( 'Step 01', 'sibco' ); ?></div>
					<h3 class="font-semibold text-charcoal-800 text-lg mb-3"><?php esc_html_e( 'Send Enquiry', 'sibco' ); ?></h3>
					<p class="text-charcoal-400 text-sm leading-relaxed"><?php esc_html_e( 'Contact our export team with your product requirements, specifications, and estimated quantities.', 'sibco' ); ?></p>
					<div class="hidden lg:block absolute top-10 -right-4 w-8">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#D4C8B8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</div>
				</div>

				<!-- Step 2 -->
				<div class="animate-on-scroll delay-2 text-center relative">
					<div class="w-20 h-20 mx-auto rounded-2xl bg-coir-50 border border-coir-200 flex items-center justify-center mb-6">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
					</div>
					<div class="text-coir-500 text-xs font-bold tracking-widest uppercase mb-2"><?php esc_html_e( 'Step 02', 'sibco' ); ?></div>
					<h3 class="font-semibold text-charcoal-800 text-lg mb-3"><?php esc_html_e( 'Product Discussion', 'sibco' ); ?></h3>
					<p class="text-charcoal-400 text-sm leading-relaxed"><?php esc_html_e( 'We discuss technical details, provide samples if needed, and finalize pricing, timelines, and specifications.', 'sibco' ); ?></p>
					<div class="hidden lg:block absolute top-10 -right-4 w-8">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#D4C8B8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</div>
				</div>

				<!-- Step 3 -->
				<div class="animate-on-scroll delay-3 text-center relative">
					<div class="w-20 h-20 mx-auto rounded-2xl bg-coir-50 border border-coir-200 flex items-center justify-center mb-6">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
					</div>
					<div class="text-coir-500 text-xs font-bold tracking-widest uppercase mb-2"><?php esc_html_e( 'Step 03', 'sibco' ); ?></div>
					<h3 class="font-semibold text-charcoal-800 text-lg mb-3"><?php esc_html_e( 'Manufacturing', 'sibco' ); ?></h3>
					<p class="text-charcoal-400 text-sm leading-relaxed"><?php esc_html_e( 'Your order enters production with quality checkpoints at every stage. Progress updates provided throughout.', 'sibco' ); ?></p>
					<div class="hidden lg:block absolute top-10 -right-4 w-8">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#D4C8B8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</div>
				</div>

				<!-- Step 4 -->
				<div class="animate-on-scroll delay-4 text-center">
					<div class="w-20 h-20 mx-auto rounded-2xl bg-coir-500 flex items-center justify-center mb-6">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
					</div>
					<div class="text-coir-500 text-xs font-bold tracking-widest uppercase mb-2"><?php esc_html_e( 'Step 04', 'sibco' ); ?></div>
					<h3 class="font-semibold text-charcoal-800 text-lg mb-3"><?php esc_html_e( 'Global Delivery', 'sibco' ); ?></h3>
					<p class="text-charcoal-400 text-sm leading-relaxed"><?php esc_html_e( 'Finished goods are export-packed and shipped to your destination port with complete documentation and tracking.', 'sibco' ); ?></p>
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

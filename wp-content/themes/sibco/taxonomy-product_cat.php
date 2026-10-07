<?php
/**
 * Taxonomy Template: Product Categories
 *
 * Displays all products in the selected category with specifications
 * and an instant on-page B2B Quote Capture modal.
 *
 * @package SIBCO
 */

get_header();

$current_term = get_queried_object();
$term_name    = ! empty( $current_term->name ) ? $current_term->name : __( 'Product Category', 'sibco' );
$term_desc    = ! empty( $current_term->description ) ? $current_term->description : __( 'Explore our industrial-grade, export-certified coir products manufactured to precision international standards.', 'sibco' );
$term_badge   = function_exists( 'get_field' ) ? get_field( 'category_badge', 'product_cat_' . $current_term->term_id ) : '';
if ( empty( $term_badge ) ) {
	$term_badge = __( 'Product Category', 'sibco' );
}

// Fetch all sibling categories for easy category-switching tabs
$all_categories = get_terms( array(
	'taxonomy'   => 'product_cat',
	'hide_empty' => false,
	'orderby'    => 'name',
	'order'      => 'ASC',
) );
?>

	<!-- ============ CATEGORY HERO BANNER ============ -->
	<section class="relative bg-charcoal-900 text-white pt-36 pb-20 overflow-hidden">
		<!-- Background decorative elements -->
		<div class="absolute inset-0 opacity-10 bg-[radial-gradient(#C88D4A_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
		<div class="absolute -right-32 -bottom-32 w-96 h-96 rounded-full bg-coir-600/10 blur-3xl pointer-events-none"></div>

		<div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
			<!-- Breadcrumb -->
			<nav class="flex items-center gap-2 text-xs text-charcoal-400 font-medium uppercase tracking-wider mb-6">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-coir-400 transition-colors"><?php esc_html_e( 'Home', 'sibco' ); ?></a>
				<span>/</span>
				<a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="hover:text-coir-400 transition-colors"><?php esc_html_e( 'Products', 'sibco' ); ?></a>
				<span>/</span>
				<span class="text-coir-400"><?php echo esc_html( $term_name ); ?></span>
			</nav>

			<div class="max-w-3xl">
				<div class="inline-flex items-center gap-2 bg-charcoal-800 border border-charcoal-700 rounded-full px-4 py-1.5 mb-5">
					<span class="w-1.5 h-1.5 bg-coir-400 rounded-full animate-pulse"></span>
					<span class="text-coir-400 text-xs font-semibold tracking-wider uppercase"><?php echo esc_html( $term_badge ); ?></span>
				</div>

				<h1 class="font-serif text-3xl md:text-4xl lg:text-5xl font-600 text-cream-100 leading-tight mb-5">
					<?php echo esc_html( $term_name ); ?>
				</h1>

				<p class="text-charcoal-300 text-base md:text-lg leading-relaxed">
					<?php echo esc_html( $term_desc ); ?>
				</p>
			</div>

			<!-- Category Switcher Tabs -->
			<?php if ( ! empty( $all_categories ) && ! is_wp_error( $all_categories ) ) : ?>
			<div class="mt-12 pt-8 border-t border-charcoal-800">
				<p class="text-xs font-semibold text-charcoal-400 uppercase tracking-wider mb-3"><?php esc_html_e( 'Explore All Categories:', 'sibco' ); ?></p>
				<div class="flex flex-wrap gap-2">
					<a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="px-4 py-2 rounded-xl text-xs font-semibold transition-all duration-200 bg-charcoal-800 text-charcoal-300 hover:bg-charcoal-700 hover:text-white border border-charcoal-700">
						<?php esc_html_e( '← All Categories', 'sibco' ); ?>
					</a>
					<?php foreach ( $all_categories as $cat ) :
						$is_active = ( $cat->term_id === $current_term->term_id );
						$tab_class = $is_active 
							? 'bg-coir-600 text-white font-bold shadow-md shadow-coir-600/30 border border-coir-500' 
							: 'bg-charcoal-800 text-charcoal-300 hover:bg-charcoal-700 hover:text-white border border-charcoal-700';
					?>
						<a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="px-4 py-2 rounded-xl text-xs font-semibold transition-all duration-200 <?php echo esc_attr( $tab_class ); ?>">
							<?php echo esc_html( $cat->name ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- ============ CATEGORY PRODUCTS GRID ============ -->
	<section class="py-20 lg:py-28 bg-white">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">

			<?php
			// Query products assigned to this category term
			$product_query = new WP_Query( array(
				'post_type'      => 'sibco_product',
				'tax_query'      => array(
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'term_id',
						'terms'    => $current_term->term_id,
					),
				),
				'posts_per_page' => -1,
				'orderby'        => 'menu_order title',
				'order'          => 'ASC',
			) );

			if ( $product_query->have_posts() ) :
			?>
				<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php
					while ( $product_query->have_posts() ) :
						$product_query->the_row();
						$product_query->the_post();

						$pid        = get_the_ID();
						$title      = get_the_title();
						$desc       = get_the_excerpt();
						if ( empty( $desc ) ) {
							$desc = wp_trim_words( get_the_content(), 20 );
						}

						// Product ACF Free specs
						$material   = function_exists( 'get_field' ) ? get_field( 'product_material', $pid ) : '';
						$thickness  = function_exists( 'get_field' ) ? get_field( 'product_thickness', $pid ) : '';
						$sizes      = function_exists( 'get_field' ) ? get_field( 'product_sizes', $pid ) : '';
						$backing    = function_exists( 'get_field' ) ? get_field( 'product_backing', $pid ) : '';
						$moq        = function_exists( 'get_field' ) ? get_field( 'product_moq', $pid ) : '';
						$packaging  = function_exists( 'get_field' ) ? get_field( 'product_packaging', $pid ) : '';

						// Image
						$img_url = get_the_post_thumbnail_url( $pid, 'large' );
						if ( empty( $img_url ) ) {
							$img_url = 'https://picsum.photos/seed/sibco-prod-' . $pid . '/600/400.jpg';
						}
						?>
						<div class="product-card card-hover bg-cream-50 rounded-2xl overflow-hidden border border-cream-400 group flex flex-col justify-between shadow-sm hover:shadow-xl transition-all duration-300">
							<div>
								<!-- Image Container -->
								<div class="overflow-hidden h-[240px] relative bg-charcoal-900">
									<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="product-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
									
									<div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-charcoal-800 text-[11px] font-bold px-2.5 py-1 rounded-md shadow-sm border border-cream-200">
										<?php echo esc_html( $term_name ); ?>
									</div>

									<?php if ( ! empty( $thickness ) ) : ?>
									<div class="absolute bottom-3 right-3 bg-charcoal-900/85 backdrop-blur-sm text-cream-100 text-[11px] font-semibold px-2.5 py-1 rounded-md border border-cream-200/20">
										<?php echo esc_html( $thickness ); ?>
									</div>
									<?php endif; ?>
								</div>

								<!-- Content & Specs -->
								<div class="p-6">
									<h2 class="font-serif text-xl font-bold text-charcoal-800 mb-2 leading-snug">
										<?php echo esc_html( $title ); ?>
									</h2>

									<?php if ( ! empty( $desc ) ) : ?>
									<p class="text-charcoal-400 text-sm leading-relaxed mb-5">
										<?php echo esc_html( $desc ); ?>
									</p>
									<?php endif; ?>

									<!-- Technical Specifications Grid -->
									<div class="bg-white rounded-xl p-4 border border-cream-300 mb-5 space-y-2 text-xs">
										<?php if ( ! empty( $material ) ) : ?>
										<div class="flex items-start justify-between gap-2 pb-1.5 border-b border-cream-200">
											<span class="text-charcoal-400 font-medium"><?php esc_html_e( 'Material', 'sibco' ); ?>:</span>
											<span class="text-charcoal-800 font-semibold text-right"><?php echo esc_html( $material ); ?></span>
										</div>
										<?php endif; ?>

										<?php if ( ! empty( $sizes ) ) : ?>
										<div class="flex items-start justify-between gap-2 pb-1.5 border-b border-cream-200">
											<span class="text-charcoal-400 font-medium"><?php esc_html_e( 'Standard Sizes', 'sibco' ); ?>:</span>
											<span class="text-charcoal-800 font-semibold text-right"><?php echo esc_html( $sizes ); ?></span>
										</div>
										<?php endif; ?>

										<?php if ( ! empty( $backing ) ) : ?>
										<div class="flex items-start justify-between gap-2 pb-1.5 border-b border-cream-200">
											<span class="text-charcoal-400 font-medium"><?php esc_html_e( 'Backing', 'sibco' ); ?>:</span>
											<span class="text-charcoal-800 font-semibold text-right"><?php echo esc_html( $backing ); ?></span>
										</div>
										<?php endif; ?>

										<?php if ( ! empty( $moq ) ) : ?>
										<div class="flex items-start justify-between gap-2">
											<span class="text-charcoal-400 font-medium"><?php esc_html_e( 'Export MOQ', 'sibco' ); ?>:</span>
											<span class="text-coir-700 font-bold text-right"><?php echo esc_html( $moq ); ?></span>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</div>

							<!-- Action Buttons -->
							<div class="p-6 pt-0">
								<button 
									type="button"
									class="open-quote-modal-btn w-full inline-flex items-center justify-center gap-2 bg-coir-600 hover:bg-coir-700 text-white font-semibold text-sm px-5 py-3 rounded-xl transition-all duration-200 shadow-md shadow-coir-600/20 hover:shadow-lg"
									data-product-name="<?php echo esc_attr( $title ); ?>"
									data-product-id="<?php echo esc_attr( $pid ); ?>"
									data-category-name="<?php echo esc_attr( $term_name ); ?>"
									data-product-moq="<?php echo esc_attr( $moq ); ?>"
								>
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
									<?php esc_html_e( 'Request B2B Quote', 'sibco' ); ?>
								</button>
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>

			<?php else : ?>
				<!-- Empty state when no products are found in this category -->
				<div class="text-center py-16 bg-cream-50 rounded-3xl border border-cream-400 max-w-2xl mx-auto p-8">
					<div class="w-16 h-16 bg-coir-100 text-coir-700 rounded-full flex items-center justify-center mx-auto mb-4">
						<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
					</div>
					<h2 class="font-serif text-2xl font-bold text-charcoal-800 mb-2"><?php esc_html_e( 'Products in Preparation', 'sibco' ); ?></h2>
					<p class="text-charcoal-400 text-sm mb-6"><?php esc_html_e( 'Detailed product models for this category are being updated. You can still request a custom catalog or wholesale quote directly from our export team.', 'sibco' ); ?></p>
					<button 
						type="button"
						class="open-quote-modal-btn inline-flex items-center gap-2 bg-coir-600 hover:bg-coir-700 text-white font-semibold text-sm px-6 py-3 rounded-xl transition-colors shadow-md"
						data-product-name="<?php echo esc_attr( $term_name ); ?>"
						data-product-id="0"
						data-category-name="<?php echo esc_attr( $term_name ); ?>"
					>
						<?php esc_html_e( 'Request Custom Category Quote', 'sibco' ); ?>
					</button>
				</div>
			<?php endif; ?>

		</div>
	</section>

	<!-- ============ ON-PAGE B2B QUOTE MODAL ============ -->
	<div id="b2b-quote-modal" class="fixed inset-0 z-50 bg-charcoal-900/80 backdrop-blur-sm hidden items-center justify-center p-4 transition-opacity duration-300" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
		<div class="bg-white rounded-3xl max-w-xl w-full p-6 md:p-8 shadow-2xl relative border border-cream-300 max-h-[92vh] overflow-y-auto transform transition-all duration-300 scale-95" id="b2b-quote-dialog">
			
			<!-- Close Button -->
			<button type="button" id="close-quote-modal" class="absolute top-5 right-5 text-charcoal-400 hover:text-charcoal-800 p-2 rounded-full hover:bg-cream-100 transition-colors" aria-label="<?php esc_attr_e( 'Close', 'sibco' ); ?>">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
			</button>

			<!-- Header -->
			<div class="mb-6">
				<div class="inline-flex items-center gap-2 bg-coir-50 border border-coir-200 rounded-lg px-3 py-1 mb-3 text-xs font-semibold text-coir-700">
					<span><?php esc_html_e( 'Product Quote Request', 'sibco' ); ?></span>
				</div>
				<h3 id="modal-headline" class="font-serif text-2xl font-bold text-charcoal-800 leading-snug">
					<?php esc_html_e( 'Request Wholesale Export Quote', 'sibco' ); ?>
				</h3>
				<div class="mt-2 text-sm text-charcoal-400">
					<?php esc_html_e( 'Selected Product:', 'sibco' ); ?> 
					<strong id="modal-selected-product" class="text-charcoal-800">Product Name</strong>
				</div>
			</div>

			<!-- Form Container -->
			<form id="modal-quote-form" class="space-y-4">
				<input type="hidden" name="action" value="sibco_contact_form">
				<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'sibco_contact_nonce' ) ); ?>">
				<input type="hidden" name="product_name" id="modal-field-product-name" value="">
				<input type="hidden" name="product_category" id="modal-field-category-name" value="">
				
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label class="block text-xs font-bold text-charcoal-700 uppercase tracking-wider mb-1.5" for="quote_name"><?php esc_html_e( 'Full Name *', 'sibco' ); ?></label>
						<input type="text" id="quote_name" name="name" required class="w-full px-4 py-2.5 rounded-xl border border-cream-400 bg-cream-50 focus:bg-white focus:border-coir-600 focus:outline-none text-charcoal-800 text-sm transition-colors" placeholder="John Doe">
					</div>
					<div>
						<label class="block text-xs font-bold text-charcoal-700 uppercase tracking-wider mb-1.5" for="quote_email"><?php esc_html_e( 'Business Email *', 'sibco' ); ?></label>
						<input type="email" id="quote_email" name="email" required class="w-full px-4 py-2.5 rounded-xl border border-cream-400 bg-cream-50 focus:bg-white focus:border-coir-600 focus:outline-none text-charcoal-800 text-sm transition-colors" placeholder="buyer@company.com">
					</div>
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label class="block text-xs font-bold text-charcoal-700 uppercase tracking-wider mb-1.5" for="quote_phone"><?php esc_html_e( 'Phone / WhatsApp', 'sibco' ); ?></label>
						<input type="text" id="quote_phone" name="phone" class="w-full px-4 py-2.5 rounded-xl border border-cream-400 bg-cream-50 focus:bg-white focus:border-coir-600 focus:outline-none text-charcoal-800 text-sm transition-colors" placeholder="+1 234 567 890">
					</div>
					<div>
						<label class="block text-xs font-bold text-charcoal-700 uppercase tracking-wider mb-1.5" for="quote_country"><?php esc_html_e( 'Destination Country / Port', 'sibco' ); ?></label>
						<input type="text" id="quote_country" name="country" class="w-full px-4 py-2.5 rounded-xl border border-cream-400 bg-cream-50 focus:bg-white focus:border-coir-600 focus:outline-none text-charcoal-800 text-sm transition-colors" placeholder="e.g. Hamburg, Germany">
					</div>
				</div>

				<div>
					<label class="block text-xs font-bold text-charcoal-700 uppercase tracking-wider mb-1.5" for="quote_quantity"><?php esc_html_e( 'Quantity / Estimated Container Volume', 'sibco' ); ?></label>
					<input type="text" id="quote_quantity" name="quantity" class="w-full px-4 py-2.5 rounded-xl border border-cream-400 bg-cream-50 focus:bg-white focus:border-coir-600 focus:outline-none text-charcoal-800 text-sm transition-colors" placeholder="e.g. 1 x 20ft FCL or 1,000 pieces">
				</div>

				<div>
					<label class="block text-xs font-bold text-charcoal-700 uppercase tracking-wider mb-1.5" for="quote_message"><?php esc_html_e( 'Custom Specifications / Notes', 'sibco' ); ?></label>
					<textarea id="quote_message" name="message" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-cream-400 bg-cream-50 focus:bg-white focus:border-coir-600 focus:outline-none text-charcoal-800 text-sm transition-colors" placeholder="Provide any custom dimensions, private label branding, or certification requirements..."></textarea>
				</div>

				<div id="modal-form-alert" class="hidden p-4 rounded-xl text-sm font-medium"></div>

				<div class="pt-2">
					<button type="submit" id="modal-submit-btn" class="w-full inline-flex items-center justify-center gap-2 bg-coir-600 hover:bg-coir-700 text-white font-semibold text-sm px-6 py-3.5 rounded-xl transition-all shadow-md shadow-coir-600/30">
						<span><?php esc_html_e( 'Send Quote Request', 'sibco' ); ?></span>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
					</button>
				</div>
			</form>
		</div>
	</div>

	<script>
	document.addEventListener('DOMContentLoaded', function() {
		const modal = document.getElementById('b2b-quote-modal');
		const dialog = document.getElementById('b2b-quote-dialog');
		const closeBtn = document.getElementById('close-quote-modal');
		const openButtons = document.querySelectorAll('.open-quote-modal-btn');
		const labelProduct = document.getElementById('modal-selected-product');
		const hiddenProduct = document.getElementById('modal-field-product-name');
		const hiddenCategory = document.getElementById('modal-field-category-name');
		const quoteForm = document.getElementById('modal-quote-form');
		const submitBtn = document.getElementById('modal-submit-btn');
		const alertBox = document.getElementById('modal-form-alert');

		function openModal(productName, categoryName) {
			labelProduct.textContent = productName || 'Custom Inquiry';
			hiddenProduct.value = productName || '';
			hiddenCategory.value = categoryName || '';
			modal.classList.remove('hidden');
			modal.classList.add('flex');
			setTimeout(() => {
				dialog.classList.remove('scale-95');
				dialog.classList.add('scale-100');
			}, 10);
			document.body.style.overflow = 'hidden';
		}

		function closeModal() {
			dialog.classList.remove('scale-100');
			dialog.classList.add('scale-95');
			setTimeout(() => {
				modal.classList.remove('flex');
				modal.classList.add('hidden');
				document.body.style.overflow = '';
			}, 150);
		}

		openButtons.forEach(btn => {
			btn.addEventListener('click', function() {
				const prod = this.getAttribute('data-product-name');
				const cat = this.getAttribute('data-category-name');
				openModal(prod, cat);
			});
		});

		closeBtn.addEventListener('click', closeModal);

		modal.addEventListener('click', function(e) {
			if (e.target === modal) {
				closeModal();
			}
		});

		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
				closeModal();
			}
		});

		// Submit AJAX Quote
		quoteForm.addEventListener('submit', function(e) {
			e.preventDefault();
			const originalText = submitBtn.innerHTML;
			submitBtn.disabled = true;
			submitBtn.innerHTML = '<span><?php echo esc_js( __( 'Sending inquiry...', 'sibco' ) ); ?></span>';
			alertBox.className = 'hidden';

			const formData = new FormData(quoteForm);

			fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
				method: 'POST',
				body: formData
			})
			.then(res => res.json())
			.then(data => {
				submitBtn.disabled = false;
				submitBtn.innerHTML = originalText;
				alertBox.classList.remove('hidden');

				if (data.success) {
					alertBox.className = 'p-4 rounded-xl text-sm font-medium bg-emerald-50 border border-emerald-200 text-emerald-800';
					alertBox.innerHTML = '✓ ' + (data.data && data.data.message ? data.data.message : '<?php echo esc_js( __( 'Your quote request has been received. Our export team will respond within 24 hours.', 'sibco' ) ); ?>');
					quoteForm.reset();
					setTimeout(() => {
						closeModal();
						alertBox.className = 'hidden';
					}, 4000);
				} else {
					alertBox.className = 'p-4 rounded-xl text-sm font-medium bg-rose-50 border border-rose-200 text-rose-800';
					alertBox.innerHTML = '✕ ' + (data.data && data.data.message ? data.data.message : '<?php echo esc_js( __( 'An error occurred. Please try again.', 'sibco' ) ); ?>');
				}
			})
			.catch(err => {
				submitBtn.disabled = false;
				submitBtn.innerHTML = originalText;
				alertBox.className = 'p-4 rounded-xl text-sm font-medium bg-rose-50 border border-rose-200 text-rose-800';
				alertBox.innerHTML = '✕ <?php echo esc_js( __( 'Server error. Please try again later or contact us directly.', 'sibco' ) ); ?>';
			});
		});
	});
	</script>

	<!-- Reusable Trust Bar -->
	<?php get_template_part( 'template-parts/trust-bar' ); ?>

<?php
get_footer();

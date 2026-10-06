<?php
/**
 * Template Name: Manufacturing Page
 *
 * @package SIBCO
 */

get_header();

// Subpage Hero Banner
get_template_part( 'template-parts/page-hero' );

$page_id = get_the_ID();

// ACF Fields
$badge = sibco_get_field( 'manufacturing_badge', 'Manufacturing', $page_id );
$title = sibco_get_field( 'manufacturing_title', 'Manufacturing Excellence', $page_id );
$desc  = sibco_get_field( 'manufacturing_description', 'From raw coir fibre to finished export-ready products — every step is controlled, measured, and quality-assured.', $page_id );
$pipeline_title = sibco_get_field( 'pipeline_title', 'Complete Production Pipeline', $page_id );
?>

	<!-- ============ MANUFACTURING EXCELLENCE ============ -->
	<section id="manufacturing" class="py-24 lg:py-32 bg-cream-100">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<!-- Header -->
			<div class="text-center max-w-3xl mx-auto mb-20 animate-on-scroll">
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

			<!-- Alternating Process Steps -->
			<div class="space-y-20 lg:space-y-28">
				<?php
				if ( function_exists( 'have_rows' ) && have_rows( 'manufacturing_steps', $page_id ) ) :
					$step_idx = 0;
					while ( have_rows( 'manufacturing_steps', $page_id ) ) :
						the_row();
						$step_idx++;
						$num   = get_sub_field( 'step_number' );
						$stitle = get_sub_field( 'step_title' );
						$sdesc  = get_sub_field( 'step_description' );
						$simg   = get_sub_field( 'step_image' );
						$stags  = get_sub_field( 'step_tags' );

						$img_url = sibco_get_image_url( $simg, 'https://picsum.photos/seed/mfg-' . $step_idx . '/800/500.jpg' );
						$is_even = ( $step_idx % 2 === 0 );
						?>
						<div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
							<?php if ( $is_even ) : ?>
								<div class="animate-left rounded-2xl overflow-hidden shadow-sm">
									<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $stitle ); ?>" class="w-full h-[300px] lg:h-[380px] object-cover">
								</div>
								<div class="animate-right">
									<div class="flex items-center gap-3 mb-4">
										<span class="text-coir-500 font-serif text-4xl font-bold"><?php echo esc_html( $num ); ?></span>
										<div class="h-px flex-1 bg-coir-200"></div>
									</div>
									<h3 class="font-serif text-2xl lg:text-3xl font-600 text-charcoal-800 mb-4"><?php echo esc_html( $stitle ); ?></h3>
									<p class="text-charcoal-400 leading-relaxed mb-6"><?php echo esc_html( $sdesc ); ?></p>
									<?php if ( ! empty( $stags ) ) : ?>
									<div class="flex flex-wrap gap-3">
										<?php
										$tags_arr = array_map( 'trim', explode( ',', $stags ) );
										foreach ( $tags_arr as $tag ) :
											if ( empty( $tag ) ) continue;
											?>
											<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php echo esc_html( $tag ); ?></span>
										<?php endforeach; ?>
									</div>
									<?php endif; ?>
								</div>
							<?php else : ?>
								<div class="animate-left order-2 lg:order-1">
									<div class="flex items-center gap-3 mb-4">
										<span class="text-coir-500 font-serif text-4xl font-bold"><?php echo esc_html( $num ); ?></span>
										<div class="h-px flex-1 bg-coir-200"></div>
									</div>
									<h3 class="font-serif text-2xl lg:text-3xl font-600 text-charcoal-800 mb-4"><?php echo esc_html( $stitle ); ?></h3>
									<p class="text-charcoal-400 leading-relaxed mb-6"><?php echo esc_html( $sdesc ); ?></p>
									<?php if ( ! empty( $stags ) ) : ?>
									<div class="flex flex-wrap gap-3">
										<?php
										$tags_arr = array_map( 'trim', explode( ',', $stags ) );
										foreach ( $tags_arr as $tag ) :
											if ( empty( $tag ) ) continue;
											?>
											<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php echo esc_html( $tag ); ?></span>
										<?php endforeach; ?>
									</div>
									<?php endif; ?>
								</div>
								<div class="animate-right order-1 lg:order-2 rounded-2xl overflow-hidden shadow-sm">
									<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $stitle ); ?>" class="w-full h-[300px] lg:h-[380px] object-cover">
								</div>
							<?php endif; ?>
						</div>
						<?php
					endwhile;
				else :
					?>
					<!-- Step 1 -->
					<div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
						<div class="animate-left order-2 lg:order-1">
							<div class="flex items-center gap-3 mb-4">
								<span class="text-coir-500 font-serif text-4xl font-bold">01</span>
								<div class="h-px flex-1 bg-coir-200"></div>
							</div>
							<h3 class="font-serif text-2xl lg:text-3xl font-600 text-charcoal-800 mb-4"><?php esc_html_e( 'Raw Material Sourcing', 'sibco' ); ?></h3>
							<p class="text-charcoal-400 leading-relaxed mb-6"><?php esc_html_e( "Premium coconut coir fibres are carefully selected from Kerala's finest plantations. Each batch is tested for fibre length, strength, and moisture content before entering production.", 'sibco' ); ?></p>
							<div class="flex flex-wrap gap-3">
								<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php esc_html_e( 'Fibre Testing', 'sibco' ); ?></span>
								<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php esc_html_e( 'Moisture Control', 'sibco' ); ?></span>
								<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php esc_html_e( 'Grade Selection', 'sibco' ); ?></span>
							</div>
						</div>
						<div class="animate-right order-1 lg:order-2 rounded-2xl overflow-hidden">
							<img src="https://picsum.photos/seed/raw-coir-fibre/800/500.jpg" alt="<?php esc_attr_e( 'Raw Coir Fibre', 'sibco' ); ?>" class="w-full h-[300px] lg:h-[380px] object-cover">
						</div>
					</div>

					<!-- Step 2 -->
					<div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
						<div class="animate-left rounded-2xl overflow-hidden">
							<img src="https://picsum.photos/seed/coir-weaving-loom/800/500.jpg" alt="<?php esc_attr_e( 'Coir Weaving Process', 'sibco' ); ?>" class="w-full h-[300px] lg:h-[380px] object-cover">
						</div>
						<div class="animate-right">
							<div class="flex items-center gap-3 mb-4">
								<span class="text-coir-500 font-serif text-4xl font-bold">02</span>
								<div class="h-px flex-1 bg-coir-200"></div>
							</div>
							<h3 class="font-serif text-2xl lg:text-3xl font-600 text-charcoal-800 mb-4"><?php esc_html_e( 'Coir Processing & Weaving', 'sibco' ); ?></h3>
							<p class="text-charcoal-400 leading-relaxed mb-6"><?php esc_html_e( 'Fibres undergo spinning, weaving, and mat formation on precision machinery. Our skilled workforce ensures consistent weave density, pattern accuracy, and dimensional stability across every production run.', 'sibco' ); ?></p>
							<div class="flex flex-wrap gap-3">
								<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php esc_html_e( 'Precision Weaving', 'sibco' ); ?></span>
								<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php esc_html_e( 'Pattern Control', 'sibco' ); ?></span>
								<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php esc_html_e( 'Skilled Workforce', 'sibco' ); ?></span>
							</div>
						</div>
					</div>

					<!-- Step 3 -->
					<div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
						<div class="animate-left order-2 lg:order-1">
							<div class="flex items-center gap-3 mb-4">
								<span class="text-coir-500 font-serif text-4xl font-bold">03</span>
								<div class="h-px flex-1 bg-coir-200"></div>
							</div>
							<h3 class="font-serif text-2xl lg:text-3xl font-600 text-charcoal-800 mb-4"><?php esc_html_e( 'Rubber Backing & Embossing', 'sibco' ); ?></h3>
							<p class="text-charcoal-400 leading-relaxed mb-6"><?php esc_html_e( 'Vulcanized rubber backing is applied using temperature-controlled hydraulic presses. Custom embossing dies create branded patterns and textures with precision, ensuring every mat meets buyer specifications.', 'sibco' ); ?></p>
							<div class="flex flex-wrap gap-3">
								<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php esc_html_e( 'Vulcanized Rubber', 'sibco' ); ?></span>
								<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php esc_html_e( 'Custom Embossing', 'sibco' ); ?></span>
								<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php esc_html_e( 'Hydraulic Press', 'sibco' ); ?></span>
							</div>
						</div>
						<div class="animate-right order-1 lg:order-2 rounded-2xl overflow-hidden">
							<img src="https://picsum.photos/seed/rubber-press-machine/800/500.jpg" alt="<?php esc_attr_e( 'Rubber Backing Process', 'sibco' ); ?>" class="w-full h-[300px] lg:h-[380px] object-cover">
						</div>
					</div>

					<!-- Step 4 -->
					<div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
						<div class="animate-left rounded-2xl overflow-hidden">
							<img src="https://picsum.photos/seed/export-packing-warehouse/800/500.jpg" alt="<?php esc_attr_e( 'Quality Inspection and Packing', 'sibco' ); ?>" class="w-full h-[300px] lg:h-[380px] object-cover">
						</div>
						<div class="animate-right">
							<div class="flex items-center gap-3 mb-4">
								<span class="text-coir-500 font-serif text-4xl font-bold">04</span>
								<div class="h-px flex-1 bg-coir-200"></div>
							</div>
							<h3 class="font-serif text-2xl lg:text-3xl font-600 text-charcoal-800 mb-4"><?php esc_html_e( 'Quality Inspection & Export Dispatch', 'sibco' ); ?></h3>
							<p class="text-charcoal-400 leading-relaxed mb-6"><?php esc_html_e( 'Every batch undergoes thorough quality inspection — checking dimensions, weight, backing adhesion, and visual standards. Products are then carefully packed for international sea freight with full documentation.', 'sibco' ); ?></p>
							<div class="flex flex-wrap gap-3">
								<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php esc_html_e( 'Final QC Check', 'sibco' ); ?></span>
								<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php esc_html_e( 'Export Packing', 'sibco' ); ?></span>
								<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php esc_html_e( 'Documentation', 'sibco' ); ?></span>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<!-- Pipeline Summary Timeline & Stats -->
			<div class="mt-20 lg:mt-28 animate-on-scroll">
				<div class="bg-white rounded-2xl border border-cream-400 p-8 lg:p-12 shadow-sm">
					<h3 class="font-serif text-xl lg:text-2xl font-600 text-charcoal-800 text-center mb-10"><?php echo esc_html( $pipeline_title ); ?></h3>
					
					<div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 md:gap-0 relative">
						<!-- Connecting line (desktop) -->
						<div class="hidden md:block absolute top-5 left-[8%] right-[8%] h-px bg-coir-200"></div>

						<?php
						$steps = array(
							'1' => 'Raw Material',
							'2' => 'Processing',
							'3' => 'Weaving',
							'4' => 'Rubber Backing',
							'5' => 'Embossing',
							'6' => 'QC & Packing',
							'7' => 'Export Dispatch',
						);

						foreach ( $steps as $snum => $sname ) :
							$is_last = ( $snum === '7' );
							$dot_class = $is_last ? 'bg-coir-500 text-white' : 'bg-coir-100 border-2 border-coir-300 text-coir-600';
							$txt_class = $is_last ? 'text-charcoal-800 font-semibold' : 'text-charcoal-600 font-medium';
							?>
							<div class="timeline-step flex items-center gap-3 relative z-10">
								<div class="timeline-dot w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 <?php echo esc_attr( $dot_class ); ?>">
									<span class="text-xs font-bold"><?php echo esc_html( $snum ); ?></span>
								</div>
								<span class="text-sm <?php echo esc_attr( $txt_class ); ?>"><?php echo esc_html( $sname ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>

					<!-- Stats Row -->
					<div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mt-10 pt-10 border-t border-cream-400">
						<div class="text-center">
							<div class="text-coir-600 font-bold text-2xl font-serif"><?php esc_html_e( 'Modern', 'sibco' ); ?></div>
							<div class="text-charcoal-400 text-xs font-medium mt-1"><?php esc_html_e( 'Production Facility', 'sibco' ); ?></div>
						</div>
						<div class="text-center">
							<div class="text-coir-600 font-bold text-2xl font-serif"><?php esc_html_e( 'Skilled', 'sibco' ); ?></div>
							<div class="text-charcoal-400 text-xs font-medium mt-1"><?php esc_html_e( 'Trained Workforce', 'sibco' ); ?></div>
						</div>
						<div class="text-center">
							<div class="text-coir-600 font-bold text-2xl font-serif"><?php esc_html_e( 'Controlled', 'sibco' ); ?></div>
							<div class="text-charcoal-400 text-xs font-medium mt-1"><?php esc_html_e( 'Quality Manufacturing', 'sibco' ); ?></div>
						</div>
						<div class="text-center">
							<div class="text-coir-600 font-bold text-2xl font-serif"><?php esc_html_e( 'International', 'sibco' ); ?></div>
							<div class="text-charcoal-400 text-xs font-medium mt-1"><?php esc_html_e( 'Export Standards', 'sibco' ); ?></div>
						</div>
					</div>
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

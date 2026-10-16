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

// ACF Fields - Section Header
$badge = sibco_get_field( 'manufacturing_badge', 'Manufacturing', $page_id );
$title = sibco_get_field( 'manufacturing_title', 'Manufacturing Excellence', $page_id );
$desc  = sibco_get_field( 'manufacturing_description', 'From raw coir fibre to finished export-ready products — every step is controlled, measured, and quality-assured.', $page_id );

// ACF Fields - 4 Manufacturing Steps
$mfg_steps_defaults = array(
	1 => array(
		'num'   => '01',
		'title' => 'Raw Material Sourcing',
		'desc'  => "Premium coconut coir fibres are carefully selected from Kerala's finest plantations. Each batch is tested for fibre length, strength, and moisture content before entering production.",
		'tags'  => 'Fibre Testing, Moisture Control, Grade Selection',
		'img'   => 'https://picsum.photos/seed/raw-coir-fibre/800/500.jpg',
	),
	2 => array(
		'num'   => '02',
		'title' => 'Coir Processing & Weaving',
		'desc'  => 'Fibres undergo spinning, weaving, and mat formation on precision machinery. Our skilled workforce ensures consistent weave density, pattern accuracy, and dimensional stability across every production run.',
		'tags'  => 'Precision Weaving, Pattern Control, Skilled Workforce',
		'img'   => 'https://picsum.photos/seed/coir-weaving-loom/800/500.jpg',
	),
	3 => array(
		'num'   => '03',
		'title' => 'Rubber Backing & Embossing',
		'desc'  => 'Vulcanized rubber backing is applied using temperature-controlled hydraulic presses. Custom embossing dies create branded patterns and textures with precision, ensuring every mat meets buyer specifications.',
		'tags'  => 'Vulcanized Rubber, Custom Embossing, Hydraulic Press',
		'img'   => 'https://picsum.photos/seed/rubber-press-machine/800/500.jpg',
	),
	4 => array(
		'num'   => '04',
		'title' => 'Quality Inspection & Export Dispatch',
		'desc'  => 'Every batch undergoes thorough quality inspection — checking dimensions, weight, backing adhesion, and visual standards. Products are then carefully packed for international sea freight with full documentation.',
		'tags'  => 'Final QC Check, Export Packing, Documentation',
		'img'   => 'https://picsum.photos/seed/export-packing-warehouse/800/500.jpg',
	),
);

$mfg_steps = array();
for ( $i = 1; $i <= 4; $i++ ) {
	$def     = $mfg_steps_defaults[ $i ];
	$s_num   = sibco_get_field( "mfg_step_{$i}_num", $def['num'], $page_id );
	$s_title = sibco_get_field( "mfg_step_{$i}_title", $def['title'], $page_id );
	$s_desc  = sibco_get_field( "mfg_step_{$i}_desc", $def['desc'], $page_id );
	$s_tags  = sibco_get_field( "mfg_step_{$i}_tags", $def['tags'], $page_id );
	$s_img   = sibco_get_field( "mfg_step_{$i}_image", '', $page_id );
	$img_url = sibco_get_image_url( $s_img, $def['img'] );

	if ( ! empty( $s_title ) ) {
		$mfg_steps[] = array(
			'num'     => $s_num,
			'title'   => $s_title,
			'desc'    => $s_desc,
			'tags'    => $s_tags,
			'img_url' => $img_url,
		);
	}
}

// ACF Fields - Pipeline Timeline & Stats
$pipeline_title = sibco_get_field( 'pipeline_title', 'Complete Production Pipeline', $page_id );

$pipeline_steps = array(
	1 => sibco_get_field( 'pipeline_step_1', 'Raw Material', $page_id ),
	2 => sibco_get_field( 'pipeline_step_2', 'Processing', $page_id ),
	3 => sibco_get_field( 'pipeline_step_3', 'Weaving', $page_id ),
	4 => sibco_get_field( 'pipeline_step_4', 'Rubber Backing', $page_id ),
	5 => sibco_get_field( 'pipeline_step_5', 'Embossing', $page_id ),
	6 => sibco_get_field( 'pipeline_step_6', 'QC & Packing', $page_id ),
	7 => sibco_get_field( 'pipeline_step_7', 'Export Dispatch', $page_id ),
);

$facility_stats = array(
	array(
		'val' => sibco_get_field( 'mfg_stat_1_val', 'Modern', $page_id ),
		'lbl' => sibco_get_field( 'mfg_stat_1_lbl', 'Production Facility', $page_id ),
	),
	array(
		'val' => sibco_get_field( 'mfg_stat_2_val', 'Skilled', $page_id ),
		'lbl' => sibco_get_field( 'mfg_stat_2_lbl', 'Trained Workforce', $page_id ),
	),
	array(
		'val' => sibco_get_field( 'mfg_stat_3_val', 'Controlled', $page_id ),
		'lbl' => sibco_get_field( 'mfg_stat_3_lbl', 'Quality Manufacturing', $page_id ),
	),
	array(
		'val' => sibco_get_field( 'mfg_stat_4_val', 'International', $page_id ),
		'lbl' => sibco_get_field( 'mfg_stat_4_lbl', 'Export Standards', $page_id ),
	),
);
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
				$step_idx = 0;
				foreach ( $mfg_steps as $step ) :
					$step_idx++;
					$is_even = ( $step_idx % 2 === 0 );
					?>
					<div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
						<?php if ( $is_even ) : ?>
							<div class="animate-left rounded-2xl overflow-hidden shadow-sm">
								<img src="<?php echo esc_url( $step['img_url'] ); ?>" alt="<?php echo esc_attr( $step['title'] ); ?>" class="w-full h-[300px] lg:h-[380px] object-cover">
							</div>
							<div class="animate-right">
								<div class="flex items-center gap-3 mb-4">
									<span class="text-coir-500 font-serif text-4xl font-bold"><?php echo esc_html( $step['num'] ); ?></span>
									<div class="h-px flex-1 bg-coir-200"></div>
								</div>
								<h3 class="font-serif text-2xl lg:text-3xl font-600 text-charcoal-800 mb-4"><?php echo esc_html( $step['title'] ); ?></h3>
								<p class="text-charcoal-400 leading-relaxed mb-6"><?php echo esc_html( $step['desc'] ); ?></p>
								<?php if ( ! empty( $step['tags'] ) ) : ?>
								<div class="flex flex-wrap gap-3">
									<?php
									$tags_arr = array_map( 'trim', explode( ',', $step['tags'] ) );
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
									<span class="text-coir-500 font-serif text-4xl font-bold"><?php echo esc_html( $step['num'] ); ?></span>
									<div class="h-px flex-1 bg-coir-200"></div>
								</div>
								<h3 class="font-serif text-2xl lg:text-3xl font-600 text-charcoal-800 mb-4"><?php echo esc_html( $step['title'] ); ?></h3>
								<p class="text-charcoal-400 leading-relaxed mb-6"><?php echo esc_html( $step['desc'] ); ?></p>
								<?php if ( ! empty( $step['tags'] ) ) : ?>
								<div class="flex flex-wrap gap-3">
									<?php
									$tags_arr = array_map( 'trim', explode( ',', $step['tags'] ) );
									foreach ( $tags_arr as $tag ) :
										if ( empty( $tag ) ) continue;
										?>
										<span class="px-3 py-1 bg-white rounded-full text-xs font-medium text-charcoal-500 border border-cream-400"><?php echo esc_html( $tag ); ?></span>
									<?php endforeach; ?>
								</div>
								<?php endif; ?>
							</div>
							<div class="animate-right order-1 lg:order-2 rounded-2xl overflow-hidden shadow-sm">
								<img src="<?php echo esc_url( $step['img_url'] ); ?>" alt="<?php echo esc_attr( $step['title'] ); ?>" class="w-full h-[300px] lg:h-[380px] object-cover">
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Pipeline Summary Timeline & Stats -->
			<div class="mt-20 lg:mt-28 animate-on-scroll">
				<div class="bg-white rounded-2xl border border-cream-400 p-8 lg:p-12 shadow-sm">
					<h3 class="font-serif text-xl lg:text-2xl font-600 text-charcoal-800 text-center mb-10"><?php echo esc_html( $pipeline_title ); ?></h3>
					
					<div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 md:gap-0 relative">
						<!-- Connecting line (desktop) -->
						<div class="hidden md:block absolute top-5 left-[8%] right-[8%] h-px bg-coir-200"></div>

						<?php
						foreach ( $pipeline_steps as $snum => $sname ) :
							if ( empty( $sname ) ) continue;
							$is_last = ( (int) $snum === 7 );
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
						<?php foreach ( $facility_stats as $stat ) : ?>
							<?php if ( ! empty( $stat['val'] ) || ! empty( $stat['lbl'] ) ) : ?>
							<div class="text-center">
								<?php if ( ! empty( $stat['val'] ) ) : ?>
								<div class="text-coir-600 font-bold text-2xl font-serif"><?php echo esc_html( $stat['val'] ); ?></div>
								<?php endif; ?>
								<?php if ( ! empty( $stat['lbl'] ) ) : ?>
								<div class="text-charcoal-400 text-xs font-medium mt-1"><?php echo esc_html( $stat['lbl'] ); ?></div>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						<?php endforeach; ?>
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

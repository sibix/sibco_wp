<?php
/**
 * Template Name: Why SIBCO Page
 *
 * @package SIBCO
 */

get_header();

// Subpage Hero Banner
get_template_part( 'template-parts/page-hero' );

$page_id = get_the_ID();

// ACF Fields
$badge = sibco_get_field( 'why_badge', 'Why SIBCO', $page_id );
$title = sibco_get_field( 'why_title', 'Why International Buyers Choose SIBCO', $page_id );
$desc  = sibco_get_field( 'why_description', 'Decades of expertise, certified quality, and a manufacturing process built for global export standards.', $page_id );
?>

	<!-- ============ WHY CHOOSE SIBCO ============ -->
	<section id="why-sibco" class="py-24 lg:py-32 bg-white">
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

			<!-- Cards Grid -->
			<!-- Cards Grid (Dynamic ACF Free - Zero Repeaters) -->
			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
				<?php
				$cards = array(
					array(
						'title' => sibco_get_field( 'why_card_1_title', '26 Years Manufacturing Experience', $page_id ),
						'desc'  => sibco_get_field( 'why_card_1_desc', 'Over two and a half decades of refined expertise in coir mat manufacturing, delivering consistent quality to global buyers year after year.', $page_id ),
						'icon'  => sibco_get_field( 'why_card_1_icon', 'clock', $page_id ),
					),
					array(
						'title' => sibco_get_field( 'why_card_2_title', '100% Natural Coir', $page_id ),
						'desc'  => sibco_get_field( 'why_card_2_desc', "Sourced from the finest coconut husks, our coir is completely natural, biodegradable, and sustainably harvested from Kerala's coir belt.", $page_id ),
						'icon'  => sibco_get_field( 'why_card_2_icon', 'leaf', $page_id ),
					),
					array(
						'title' => sibco_get_field( 'why_card_3_title', 'Phthalate Free Certified', $page_id ),
						'desc'  => sibco_get_field( 'why_card_3_desc', 'Our products are certified Phthalate-free, meeting stringent European import regulations and ensuring complete compliance for EU market entry.', $page_id ),
						'icon'  => sibco_get_field( 'why_card_3_icon', 'shield', $page_id ),
					),
					array(
						'title' => sibco_get_field( 'why_card_4_title', 'Consistent Product Quality', $page_id ),
						'desc'  => sibco_get_field( 'why_card_4_desc', 'Rigorous quality control at every stage of production ensures that every shipment meets the exact specifications and standards expected by international buyers.', $page_id ),
						'icon'  => sibco_get_field( 'why_card_4_icon', 'chart', $page_id ),
					),
					array(
						'title' => sibco_get_field( 'why_card_5_title', 'Time-Bound Delivery', $page_id ),
						'desc'  => sibco_get_field( 'why_card_5_desc', 'Our streamlined production scheduling and logistics management ensure every order is manufactured and dispatched within agreed timelines, without exception.', $page_id ),
						'icon'  => sibco_get_field( 'why_card_5_icon', 'truck', $page_id ),
					),
					array(
						'title' => sibco_get_field( 'why_card_6_title', 'OEM & Private Label', $page_id ),
						'desc'  => sibco_get_field( 'why_card_6_desc', 'Complete private label and OEM manufacturing capabilities with full confidentiality. Your brand, your specifications, our manufacturing expertise.', $page_id ),
						'icon'  => sibco_get_field( 'why_card_6_icon', 'tag', $page_id ),
					),
				);

				$delay_idx = 1;
				foreach ( $cards as $c ) :
					if ( empty( $c['title'] ) ) continue;
					?>
					<div class="card-hover animate-on-scroll delay-<?php echo esc_attr( $delay_idx ); ?> bg-cream-50 rounded-2xl p-8 border border-cream-400 group">
						<div class="w-12 h-12 rounded-xl bg-coir-50 flex items-center justify-center mb-5 group-hover:bg-coir-500 transition-colors duration-300">
							<?php
							switch ( $c['icon'] ) {
								case 'leaf':
									echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:stroke-white transition-colors duration-300"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="M7 10.5c0-1.657 2.239-3 5-3s5 1.343 5 3"/><path d="M7 14c0 1.657 2.239 3 5 3s5-1.343 5-3"/></svg>';
									break;
								case 'shield':
									echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:stroke-white transition-colors duration-300"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>';
									break;
								case 'chart':
									echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:stroke-white transition-colors duration-300"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>';
									break;
								case 'truck':
									echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:stroke-white transition-colors duration-300"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 8 14"/></svg>';
									break;
								case 'tag':
									echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:stroke-white transition-colors duration-300"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>';
									break;
								default: // clock
									echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#A67C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:stroke-white transition-colors duration-300"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>';
									break;
							}
							?>
						</div>
						<h3 class="font-semibold text-charcoal-800 text-lg mb-3"><?php echo esc_html( $c['title'] ); ?></h3>
						<p class="text-charcoal-400 text-sm leading-relaxed"><?php echo esc_html( $c['desc'] ); ?></p>
					</div>
					<?php
					$delay_idx = ( $delay_idx % 6 ) + 1;
				endforeach;
				?>
			</div>
		</div>
	</section>

	<!-- Reusable Trust Bar -->
	<?php get_template_part( 'template-parts/trust-bar' ); ?>

	<!-- Reusable Bottom CTA -->
	<?php get_template_part( 'template-parts/cta-banner' ); ?>

<?php
get_footer();

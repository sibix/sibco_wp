<?php
/**
 * Trust Bar Template Part
 *
 * Editable via ACF (ACF Free compatible - non-repeater).
 *
 * @package SIBCO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_id = get_the_ID();

$t1 = sibco_get_field( 'trust_item_1_title', __( '26 Years Experience', 'sibco' ), $page_id );
$t2 = sibco_get_field( 'trust_item_2_title', __( 'Rubber Board Registered', 'sibco' ), $page_id );
$t3 = sibco_get_field( 'trust_item_3_title', __( 'Phthalate Free Certified', 'sibco' ), $page_id );
$t4 = sibco_get_field( 'trust_item_4_title', __( 'Export Manufacturing', 'sibco' ), $page_id );
$t5 = sibco_get_field( 'trust_item_5_title', __( 'OEM & Private Label', 'sibco' ), $page_id );
$t6 = sibco_get_field( 'trust_item_6_title', __( 'Time Bound Delivery', 'sibco' ), $page_id );
?>

<!-- ============ TRUST BAR ============ -->
<section class="bg-white border-b border-cream-400">
	<div class="max-w-7xl mx-auto px-6 lg:px-8 py-6">
		<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 lg:gap-4">
			<!-- Item 1 -->
			<div class="trust-icon-wrap flex items-center gap-3 cursor-default">
				<div class="trust-icon-circle w-10 h-10 rounded-lg bg-cream-200 flex items-center justify-center flex-shrink-0 transition-colors duration-300">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-coir-600 transition-colors duration-300"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
				</div>
				<span class="text-charcoal-600 text-sm font-medium"><?php echo esc_html( $t1 ); ?></span>
			</div>
			<!-- Item 2 -->
			<div class="trust-icon-wrap flex items-center gap-3 cursor-default">
				<div class="trust-icon-circle w-10 h-10 rounded-lg bg-cream-200 flex items-center justify-center flex-shrink-0 transition-colors duration-300">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-coir-600 transition-colors duration-300"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
				</div>
				<span class="text-charcoal-600 text-sm font-medium"><?php echo esc_html( $t2 ); ?></span>
			</div>
			<!-- Item 3 -->
			<div class="trust-icon-wrap flex items-center gap-3 cursor-default">
				<div class="trust-icon-circle w-10 h-10 rounded-lg bg-cream-200 flex items-center justify-center flex-shrink-0 transition-colors duration-300">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-coir-600 transition-colors duration-300"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
				</div>
				<span class="text-charcoal-600 text-sm font-medium"><?php echo esc_html( $t3 ); ?></span>
			</div>
			<!-- Item 4 -->
			<div class="trust-icon-wrap flex items-center gap-3 cursor-default">
				<div class="trust-icon-circle w-10 h-10 rounded-lg bg-cream-200 flex items-center justify-center flex-shrink-0 transition-colors duration-300">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-coir-600 transition-colors duration-300"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
				</div>
				<span class="text-charcoal-600 text-sm font-medium"><?php echo esc_html( $t4 ); ?></span>
			</div>
			<!-- Item 5 -->
			<div class="trust-icon-wrap flex items-center gap-3 cursor-default">
				<div class="trust-icon-circle w-10 h-10 rounded-lg bg-cream-200 flex items-center justify-center flex-shrink-0 transition-colors duration-300">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-coir-600 transition-colors duration-300"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
				</div>
				<span class="text-charcoal-600 text-sm font-medium"><?php echo esc_html( $t5 ); ?></span>
			</div>
			<!-- Item 6 -->
			<div class="trust-icon-wrap flex items-center gap-3 cursor-default">
				<div class="trust-icon-circle w-10 h-10 rounded-lg bg-cream-200 flex items-center justify-center flex-shrink-0 transition-colors duration-300">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-coir-600 transition-colors duration-300"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
				</div>
				<span class="text-charcoal-600 text-sm font-medium"><?php echo esc_html( $t6 ); ?></span>
			</div>
		</div>
	</div>
</section>

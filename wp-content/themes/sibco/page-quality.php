<?php
/**
 * Template Name: Quality Page
 *
 * @package SIBCO
 */

get_header();

// Subpage Hero Banner
get_template_part( 'template-parts/page-hero' );

$page_id = get_the_ID();

// ACF Fields
$badge     = sibco_get_field( 'quality_badge', 'Quality & Certifications', $page_id );
$title     = sibco_get_field( 'quality_title', 'Certified Quality for Global Markets', $page_id );
$desc      = sibco_get_field( 'quality_description', 'Every product leaving our facility meets international quality standards backed by recognized certifications.', $page_id );
$proc_ttl  = sibco_get_field( 'quality_process_title', "Quality Is Not an Act — It's a Process at Every Stage", $page_id );
$proc_txt  = sibco_get_field( 'quality_process_text', '', $page_id );
?>

	<!-- ============ QUALITY & CERTIFICATIONS ============ -->
	<section id="quality" class="py-24 lg:py-32 bg-charcoal-700 relative overflow-hidden text-white">
		<!-- Subtle pattern overlay -->
		<div class="absolute inset-0 opacity-5 pointer-events-none">
			<div class="absolute top-0 left-0 w-96 h-96 bg-coir-400 rounded-full blur-3xl"></div>
			<div class="absolute bottom-0 right-0 w-96 h-96 bg-coir-400 rounded-full blur-3xl"></div>
		</div>

		<div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
			<!-- Header -->
			<div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
				<?php if ( ! empty( $badge ) ) : ?>
				<div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 rounded-full px-4 py-1.5 mb-6">
					<span class="w-1.5 h-1.5 bg-coir-400 rounded-full"></span>
					<span class="text-coir-300 text-xs font-semibold tracking-wider uppercase"><?php echo esc_html( $badge ); ?></span>
				</div>
				<?php endif; ?>

				<h2 class="font-serif text-3xl lg:text-4xl xl:text-5xl font-600 text-white leading-[1.15] tracking-tight mb-5">
					<?php echo esc_html( $title ); ?>
				</h2>

				<?php if ( ! empty( $desc ) ) : ?>
				<p class="text-white/50 text-base lg:text-lg leading-relaxed">
					<?php echo esc_html( $desc ); ?>
				</p>
				<?php endif; ?>
			</div>

			<div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
				<!-- Certification Badges -->
				<div class="animate-left">
					<div class="grid grid-cols-2 gap-6">
						<?php
						if ( function_exists( 'have_rows' ) && have_rows( 'certifications', $page_id ) ) :
							while ( have_rows( 'certifications', $page_id ) ) :
								the_row();
								$ctitle = get_sub_field( 'cert_title' );
								$cdesc  = get_sub_field( 'cert_description' );
								$cicon  = get_sub_field( 'cert_icon' );
								if ( empty( $ctitle ) ) continue;
								?>
								<div class="cert-badge bg-white/5 border border-white/10 rounded-2xl p-8 text-center backdrop-blur-sm">
									<div class="w-16 h-16 mx-auto rounded-full bg-coir-500/10 flex items-center justify-center mb-4">
										<?php
										switch ( $cicon ) {
											case 'board':
												echo '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#CCAE7E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>';
												break;
											case 'qc':
												echo '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#CCAE7E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>';
												break;
											case 'export':
												echo '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#CCAE7E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>';
												break;
											default:
												echo '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#CCAE7E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>';
												break;
										}
										?>
									</div>
									<h4 class="text-white font-semibold text-sm mb-2"><?php echo esc_html( $ctitle ); ?></h4>
									<p class="text-white/40 text-xs leading-relaxed"><?php echo esc_html( $cdesc ); ?></p>
								</div>
								<?php
							endwhile;
						else :
							?>
							<!-- Talite Free -->
							<div class="cert-badge bg-white/5 border border-white/10 rounded-2xl p-8 text-center backdrop-blur-sm">
								<div class="w-16 h-16 mx-auto rounded-full bg-coir-500/10 flex items-center justify-center mb-4">
									<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#CCAE7E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
								</div>
								<h4 class="text-white font-semibold text-sm mb-2"><?php esc_html_e( 'Talite Free Certified', 'sibco' ); ?></h4>
								<p class="text-white/40 text-xs leading-relaxed"><?php esc_html_e( 'Compliant with EU talite-free import requirements for coir products', 'sibco' ); ?></p>
							</div>
							<!-- Rubber Board -->
							<div class="cert-badge bg-white/5 border border-white/10 rounded-2xl p-8 text-center backdrop-blur-sm">
								<div class="w-16 h-16 mx-auto rounded-full bg-coir-500/10 flex items-center justify-center mb-4">
									<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#CCAE7E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
								</div>
								<h4 class="text-white font-semibold text-sm mb-2"><?php esc_html_e( 'Rubber Board Registered', 'sibco' ); ?></h4>
								<p class="text-white/40 text-xs leading-relaxed"><?php esc_html_e( 'Officially registered with the Rubber Board of India for rubber-backed products', 'sibco' ); ?></p>
							</div>
							<!-- Quality Control -->
							<div class="cert-badge bg-white/5 border border-white/10 rounded-2xl p-8 text-center backdrop-blur-sm">
								<div class="w-16 h-16 mx-auto rounded-full bg-coir-500/10 flex items-center justify-center mb-4">
									<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#CCAE7E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
								</div>
								<h4 class="text-white font-semibold text-sm mb-2"><?php esc_html_e( 'Consistent QC', 'sibco' ); ?></h4>
								<p class="text-white/40 text-xs leading-relaxed"><?php esc_html_e( 'Multi-stage quality control ensuring zero-defect shipments', 'sibco' ); ?></p>
							</div>
							<!-- Export Standards -->
							<div class="cert-badge bg-white/5 border border-white/10 rounded-2xl p-8 text-center backdrop-blur-sm">
								<div class="w-16 h-16 mx-auto rounded-full bg-coir-500/10 flex items-center justify-center mb-4">
									<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#CCAE7E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
								</div>
								<h4 class="text-white font-semibold text-sm mb-2"><?php esc_html_e( 'Export Standards', 'sibco' ); ?></h4>
								<p class="text-white/40 text-xs leading-relaxed"><?php esc_html_e( 'Products manufactured to meet EU and US import standards', 'sibco' ); ?></p>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Quality Process Text -->
				<div class="animate-right">
					<h3 class="font-serif text-2xl lg:text-3xl font-600 text-white leading-tight mb-6">
						<?php echo esc_html( $proc_ttl ); ?>
					</h3>
					<div class="space-y-5 text-white/50 text-sm leading-relaxed">
						<?php if ( ! empty( $proc_txt ) ) : ?>
							<?php echo wp_kses_post( $proc_txt ); ?>
						<?php else : ?>
							<p>
								<?php esc_html_e( 'At SIBCO, quality assurance begins before production starts. Every batch of raw coir fibre is tested for critical parameters including fibre length, tensile strength, moisture content, and cleanliness.', 'sibco' ); ?>
							</p>
							<p>
								<?php esc_html_e( 'During production, in-line quality checks monitor weave density, dimensional accuracy, rubber backing adhesion, and embossing depth. Our quality team conducts random sampling at defined intervals to ensure process consistency.', 'sibco' ); ?>
							</p>
							<p>
								<?php esc_html_e( 'Final inspection covers every aspect — dimensions, weight, visual appearance, backing integrity, and packaging compliance. Only products that pass all checkpoints are approved for export dispatch.', 'sibco' ); ?>
							</p>
						<?php endif; ?>
					</div>

					<!-- Quality Metrics -->
					<div class="grid grid-cols-3 gap-6 mt-10 pt-8 border-t border-white/10">
						<?php
						if ( function_exists( 'have_rows' ) && have_rows( 'quality_metrics', $page_id ) ) :
							while ( have_rows( 'quality_metrics', $page_id ) ) :
								the_row();
								$mval = get_sub_field( 'metric_value' );
								$mlbl = get_sub_field( 'metric_label' );
								?>
								<div>
									<div class="text-coir-400 font-bold text-3xl font-serif"><?php echo esc_html( $mval ); ?></div>
									<div class="text-white/40 text-xs font-medium mt-1"><?php echo esc_html( $mlbl ); ?></div>
								</div>
								<?php
							endwhile;
						else :
							?>
							<div>
								<div class="text-coir-400 font-bold text-3xl font-serif">100%</div>
								<div class="text-white/40 text-xs font-medium mt-1"><?php esc_html_e( 'Inspection Rate', 'sibco' ); ?></div>
							</div>
							<div>
								<div class="text-coir-400 font-bold text-3xl font-serif">Zero</div>
								<div class="text-white/40 text-xs font-medium mt-1"><?php esc_html_e( 'Quality Claims', 'sibco' ); ?></div>
							</div>
							<div>
								<div class="text-coir-400 font-bold text-3xl font-serif">Multi</div>
								<div class="text-white/40 text-xs font-medium mt-1"><?php esc_html_e( 'Stage QC', 'sibco' ); ?></div>
							</div>
						<?php endif; ?>
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

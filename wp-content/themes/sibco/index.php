<?php
/**
 * Main Index Fallback Template
 *
 * @package SIBCO
 */

get_header();

// Subpage Hero Banner
get_template_part( 'template-parts/page-hero' );
?>

	<div class="py-20 lg:py-28 bg-cream-50">
		<div class="max-w-4xl mx-auto px-6 lg:px-8">
			<div class="bg-white rounded-2xl border border-cream-400 p-8 lg:p-12 shadow-sm space-y-6">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-8 pb-8 border-b border-cream-300 last:border-0' ); ?>>
							<h2 class="font-serif text-2xl font-bold text-charcoal-800 mb-4">
								<a href="<?php the_permalink(); ?>" class="hover:text-coir-600 transition-colors"><?php the_title(); ?></a>
							</h2>
							<div class="text-charcoal-500 leading-relaxed">
								<?php the_excerpt(); ?>
							</div>
						</article>
						<?php
					endwhile;
				else :
					?>
					<p class="text-charcoal-500"><?php esc_html_e( 'No content found.', 'sibco' ); ?></p>
					<?php
				endif;
				?>
			</div>
		</div>
	</div>

	<!-- Reusable Bottom CTA -->
	<?php get_template_part( 'template-parts/cta-banner' ); ?>

<?php
get_footer();

<?php
/**
 * Default Page Template
 *
 * @package SIBCO
 */

get_header();

// Subpage Hero Banner
get_template_part( 'template-parts/page-hero' );
?>

	<div class="py-20 lg:py-28 bg-cream-50">
		<div class="max-w-4xl mx-auto px-6 lg:px-8">
			<div class="bg-white rounded-2xl border border-cream-400 p-8 lg:p-12 shadow-sm prose prose-charcoal max-w-none text-charcoal-600 leading-relaxed space-y-6">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>
		</div>
	</div>

	<!-- Reusable Bottom CTA -->
	<?php get_template_part( 'template-parts/cta-banner' ); ?>

<?php
get_footer();

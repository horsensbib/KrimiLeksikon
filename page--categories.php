<?php
/**
 * Template Name: Page Template for Categories Overview
 *
 * @package KrimiLeksikon
 */
// Make Template Name translatable
// http://stackoverflow.com/questions/13561410/how-to-translate-a-wordpress-template-name
__( 'Page Template for Categories Overview', 'krimileksikon' );

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main" itemprop="mainContentOfPage">
			<?php do_action('before_main') ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop.
					wp_reset_query();  // Restore global post data stomped by the_post(). ?>


			<?php get_template_part( 'template-parts/content', 'categories' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php
if ( is_plugin_active( 'azindex/az-index-admin.php' ) ) {
/**
 * Template Name: Template for Alphabetic Index
 *
 * A WordPress template to list page titles by first letter.
 * Requires Bechs customized azindex plugin.
 *
 * @package KrimiLeksikon
 */
__( 'Template for Alphabetic Index', 'krimileksikon' );

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

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>


<?php } ?>

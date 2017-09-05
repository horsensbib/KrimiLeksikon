<?php
/**
 * Template Name: Front Page
 *
 * This is the template that displays the front page.
 *
 * @package KrimiLeksikon
 */
// Make Template Name translatable
// http://stackoverflow.com/questions/13561410/how-to-translate-a-wordpress-template-name
__( 'Front Page', 'krimileksikon' );

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main" itemprop="mainContentOfPage">
			<?php do_action('before_main') ?>
			<?php /*
			<section class="introduction hero">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'page--frontpage' ); ?>

				<?php endwhile; // End of the loop.
				wp_reset_query(); ?>
			</section><!-- .introduction -->
			*/ ?>
			<section class="carousel">
				<div class="carousel__inner">
					<div class="carousel__inner__slider">
				<?php
					// Set the item counter
					$counter = 1;
					$args = array(
						'posts_per_page' => 5,
						'orderby' => 'rand',
						'ignore_sticky_posts' => 1
					);
					$the_query = new WP_Query( $args );

					if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

					get_template_part( 'template-parts/content', 'carousel' );

					$counter++;

					endwhile; endif;
					wp_reset_query();  // Restore global post data stomped by the_post().
			 	?>
					</div><!-- .carousel__inner__slider -->
				</div>
			</section>

			<section class="articles masonry">
				<?php
					// Set the item counter
					$counter = 1;
					$args = array(
						'posts_per_page' => 12,
						'ignore_sticky_posts' => 1
					);
					$the_query = new WP_Query( $args );

					if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

					get_template_part( 'template-parts/content', 'cards' );

					$counter++;

					endwhile; endif;
					wp_reset_query();  // Restore global post data stomped by the_post().
			 	?>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

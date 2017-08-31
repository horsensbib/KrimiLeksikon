<?php
/**
 * The template used for displaying categories content in page--categories.php
 *
 * @package KrimiLeksikon
 */

?>

<section class="categories" itemscope="" itemtype="https://schema.org/ItemList">
<?php

$catArgs = array(
	'type' 					=> 'post',
	'orderby' 			=> 'name',
	'order' 				=> 'ASC',
	'parent' 				=> 0,
	'hide_empty' 		=> 1,
);

$categories = get_categories( $catArgs );

foreach ( $categories as $category ) {
	$cat_id = $category->term_id;

	$postArgs = array(
		'cat' => $cat_id,
		'posts_per_page' => 3,
		'orderby' => 'date',
		'order' => 'DESC',
		'post__not_in' => get_option( 'sticky_posts' )
	);
?>

	<div class="the-category category-<?php echo $category->category_nicename; ?>" itemprop="itemListElement">

	<?php
	echo '<h2 itemprop="name"><a href="' . get_category_link( $cat_id ) . '">' . $category->name . '</a></h2>';

	$children = get_terms( $category->taxonomy, array(
		'parent'    => $cat_id,
		'hide_empty' => true
	) );

	if ($children) {
	?>
		<ol class="category-children children-of-<?php echo $category->category_nicename; ?>" itemscope="" itemtype="https://schema.org/ItemList">
		<?php
		foreach ($children as $child) {
			echo '<li class="cat-child" itemprop="itemListElement"><a href="' . get_category_link( $child->term_id ) . '">' . $child->name . '</a></li>';
		}
		?>
		</ol>
	<?php
	}

query_posts($postArgs);
	if (have_posts()) { ?>
		<ul class="category-posts posts-in-<?php echo $category->category_nicename; ?>" itemscope="" itemtype="https://schema.org/ItemList">
	<?php while (have_posts()) : the_post(); ?>
			<li class="cat-post" itemprop="itemListElement"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
	<?php endwhile; ?>
		</ul>

<?php echo '<p><a class="button button--bordered--color__secondary" href="' . get_category_link( $cat_id ) . '">' . __('See all posts' , 'leksikon') . '</a></p>';
	}

wp_reset_query();  // Restore global post data stomped by the_post(). ?>
	</div> <!-- / .category -->
<?php } ?>
</section>

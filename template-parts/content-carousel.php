<?php
/**
 * @package KrimiLeksikon
 */
?>

<div>
<article id="post-<?php the_ID(); ?>" <?php post_class('summary-item'); ?> itemscope="" itemtype="http://schema.org/Article">

	<header class="entry-header">
		<h2 class="entry-title" itemprop="name headline"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permanent link to %s', 'leksikon' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header><!-- .entry-header -->

	<div class="entry-summary" itemprop="description">
		<p>
<?php
$excerpt = get_the_excerpt();
echo string_limit_words($excerpt,28); // Set the number of words to display in the excerpt.
?> &hellip;<br />
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permanent link to %s', 'krimileksikon' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark" itemprop="url"><?php _e('Read more about ', 'leksikon') . the_title(); ?></a>
<?php edit_post_link( esc_html__( 'Edit', 'krimileksikon' ), '<span class="edit-link">', '</span>' ); ?>
		</p>
	</div><!-- .entry-summary -->
</article><!-- #post-<?php the_ID(); ?> -->
</div>

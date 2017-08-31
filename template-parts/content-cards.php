<?php
/**
 * @package KrimiLeksikon
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('summary-item--card masonry__item'); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

<?php
$imgargs = array(
	'order'          => 'ASC',
	'post_type'      => 'attachment',
	'post_parent'    => $post->ID,
	'post_mime_type' => 'image',
	'post_status'    => null,
	'numberposts'    => -1,
);
$attachments = get_posts($imgargs);

if ( has_post_thumbnail() ) {	// Check if there is a manually chosen thumbnail. ?>
	<a class="thumbnail list-thumbnail" href="<?php the_permalink() ?>" itemprop="thumbnailUrl"><?php the_post_thumbnail('card'); ?></a>
<?php
} elseif ( $attachments ) {	// Else, choose the first attached thumbnail. ?>
	<a class="thumbnail list-thumbnail" href="<?php the_permalink() ?>" itemprop="thumbnailUrl"><?php get_img('card'); ?></a>
<?php }
	/* else { 	// Else, display a default image
?><img class="attachment-thumb wp-post-image" alt="Kamera" src="<?php bloginfo('stylesheet_directory'); ?>/img/camera.jpg" />
<?php } */
?>

	<header class="entry-header">
		<h2 class="entry-title" itemprop="name headline"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permanent link to %s', 'krimileksikon' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header><!-- .entry-header -->

	<div class="entry-summary" itemprop="description">
		<p>
<?php
$excerpt = get_the_excerpt();
echo string_limit_words($excerpt,28); // Set the number of words to display in the excerpt.
?> &hellip;<br />
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permanent link to %s', 'krimileksikon' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php _e('Read more about ', 'leksikon') . the_title(); ?></a>
<?php edit_post_link( esc_html__( 'Edit', 'krimileksikon' ), '<span class="edit-link">', '</span>' ); ?>
		</p>
	</div><!-- .entry-summary -->

	<?php /* <footer class="entry-meta">

		<span class="publication-time">
			<i class="icon icon-clock"></i>
			<time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="datePublished"><?php the_time('j. M Y'); ?></time>
		</span>
		<span class="categories" itemprop="about">
			<i class="icon icon-folder"></i>
			<?php the_category(', '); ?>
		</span>
		<span class="comments">
			<i class="icon icon-bubble"></i>
			<?php comments_popup_link('(0)', '(1)', '(%)'); ?>
		</span>

	</footer><!-- .entry-meta --> */ ?>
</article><!-- #post-<?php the_ID(); ?> -->

<?php
/**
 * The template used for displaying page content in page--frontpage.php
 *
 * @package KrimiLeksikon
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content" itemprop="about">
		<?php edit_post_link( esc_html__( 'Edit', 'krimileksikon' ), '<span class="edit-link">', '</span>' ); ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'krimileksikon' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

<?php
// Random Attached Image
// https://wordpress.org/support/topic/show-random-attached-image?replies=4
$attachments = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment','post_mime_type' => 'image', 'orderby' => 'rand') );
if($attachments) {
?>
	<figure class="introduction__image">
<?php
$attachments = array_values($attachments);
echo wp_get_attachment_image( $attachments[0]->ID, 'full' );
?>
	</figure>
<?php } ?>

</article><!-- #post-## -->

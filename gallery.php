<?php
/**
 * Template Name: Gallery
 * Description: with some widgets
 *
 * @package WordPress
 * @subpackage Thematic post.php
 */

get_header(); ?>

	<?php the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php edit_post_link( __( 'Edit', 'themename' ), '<span class="edit-link">', '</span>' ); ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>

		<section class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( 'before=<div class="page-link">' . __( 'Pages:', 'themename' ) . '&after=</div>' ); ?>
		</section><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->

	<?php comments_template( '', true ); ?>

<?php get_footer(); ?>
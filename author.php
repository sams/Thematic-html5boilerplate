<?php
/**
 * @package WordPress
 * @subpackage Thematic PFT todo: thematic expanded author display
 */

get_header(); ?>

	<aside class="leftCol"><?php get_sidebar(); ?></aside>

	<!-- once upon a time this was  id="primary" -->
	<section class="main">

		<?php the_post(); ?>

		<h2 class="page-title author"><?php printf( __( 'Author Archives: <span class="vcard">%s</span>', 'themename' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h2>

		<?php rewind_posts(); ?>

		<?php get_template_part( 'loop', 'author' ); ?>

	</section><!-- #primary -->

<?php get_footer(); ?>
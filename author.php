<?php
/**
 * @package WordPress
 * @subpackage Thematic PFT todo: thematic expanded author display
 */

get_header(); ?>

		<div id="primary">
			<div id="content">

				<?php the_post(); ?>

				<h2 class="page-title author"><?php printf( __( 'Author Archives: <span class="vcard">%s</span>', 'themename' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h2>

				<?php rewind_posts(); ?>

				<?php get_template_part( 'loop', 'author' ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
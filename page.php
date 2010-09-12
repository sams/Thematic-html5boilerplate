<?php
/**
 * @package WordPress
 * @subpackage Thematic PFT
 */

get_header(); ?>

<?php get_sidebar(); ?>

	<!-- was id="primary"  -->
	<section class="main">
		<?php the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themename' ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'themename' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->

		<?php comments_template( '', true ); ?>

	</section><!-- #primary -->

<?php get_footer(); ?>
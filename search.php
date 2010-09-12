<?php
/**
 * @package WordPress
 * @subpackage Thematic PFT
 */

get_header(); ?>

<?php get_sidebar(); ?>

		<!-- was id="primary"  -->
		<section class="main">

			<?php if ( have_posts() ) : ?>

				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'themename' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php

	                // displays the page title
	                thematic_page_title();
	
	                // create the navigation above the content
	                thematic_navigation_above();
				
	                // action hook for placing content above the search loop
	                thematic_above_searchloop();

					//	get_template_part( 'loop', 'search' );

	                // action hook creating the search loop
	                thematic_searchloop();

	                // action hook for placing content below the search loop
	                thematic_below_searchloop();
				?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'themename' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'themename' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

		</section><!-- #primary -->

<?php get_footer(); ?>
<?php
/**
 * The template used to display Tag Archive pages
 *
 * @package WordPress
 * @subpackage Thematic PFT todo: thematic exapnsion plugins
 */

/*
	//eh? why is this here
	// displays the page title
	thematic_page_title();
	
	// create the navigation above the content
	thematic_navigation_above();
	
	// action hook for placing content above the tag loop
	thematic_above_tagloop();		
	
	// action hook creating the tag loop
	thematic_tagloop();
	
	// action hook for placing content below the tag loop
	thematic_below_tagloop();
	
	// create the navigation below the content
	thematic_navigation_below();


*/

get_header(); ?>

<?php get_sidebar(); ?>

	<!-- was id="primary"  -->
	<section class="main">

		<?php the_post(); ?>

		<h2 class="page-title"><?php
			printf( __( 'Tag Archives: %s', 'themename' ), '<span>' . single_tag_title( '', false ) . '</span>' );
		?></h2>

		<?php rewind_posts(); ?>

		<?php get_template_part( 'loop', 'tag' ); ?>

	</section><!-- #primary -->

<?php get_footer(); ?>
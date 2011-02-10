<?php

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>


				<!-- thematic above the content -->
		
			<?php thematic_abovecontent(); 

    // calling the standard sidebar 
    thematic_sidebar(); ?>
		
				<!-- thematic content -->
	
	            <?php
	        
	            // displays the page title
	            thematic_page_title();
	
	            // create the navigation above the content
	            thematic_navigation_above();
				
	            // action hook for placing content above the category loop
	            thematic_above_categoryloop();			
	
	            // action hook creating the category loop
	            thematic_categoryloop();
	
	            // action hook for placing content below the category loop
	            thematic_below_categoryloop();			
	
	            // create the navigation below the content
	            thematic_navigation_below();
	            
	            ?>
	
			
			<?php thematic_belowcontent(); ?> 

	<!-- once upon a time this was  id="primary" -->
	<section class="main">

		<h2 class="page-title"><?php
			printf( __( 'Category Archives: %s', 'themename' ), '<span>' . single_cat_title( '', false ) . '</span>' );
		?></h2>

		<?php $categorydesc = category_description(); if ( ! empty( $categorydesc ) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' ); ?>

		<?php get_template_part( 'loop', 'category' );
		
			// calling the standard sidebar 
			thematic_sidebar();
		?>

	</section><!-- #primary -->
<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();


    // calling footer.php
    get_footer();

?>
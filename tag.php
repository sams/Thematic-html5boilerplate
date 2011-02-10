<?php

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

    // calling the standard sidebar 
    thematic_sidebar(); ?>

	<!-- was id="primary"  -->
	<section class="main">
	
        <?php
    
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
        
        ?>

	</section><!-- .main -->


			
			<?php thematic_belowcontent(); ?> 
<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();
    
    // calling footer.php
    get_footer();

?>
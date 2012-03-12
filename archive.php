<?php

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>

<?php 

            the_post();

            // displays the page title
            thematic_page_title();

            rewind_posts();

            // create the navigation above the content
            thematic_navigation_above();

            // action hook creating the archive loop
            thematic_archiveloop();

            // create the navigation below the content
            thematic_navigation_below();

            get_sidebar(); ?>

        <!-- once upon a time this was  id="primary" -->
        <section class="main">

                <?php

                the_post();

                // displays the page title
                thematic_page_title();

                rewind_posts();

                // create the navigation above the content
                thematic_navigation_above();

                // action hook creating the archive loop
                thematic_archiveloop();

                // create the navigation below the content
                thematic_navigation_below();

                ?>

        </section><!-- .main -->


<?php 

    //     action hook for placing content below #content.main  ?wrong place?
    thematic_belowcontent();

    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar 
    thematic_sidebar();
    
    // calling footer.php
    get_footer();

?>

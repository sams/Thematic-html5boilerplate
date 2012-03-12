<?php

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>
        <?php
            thematic_abovecontent();

            // calling the standard sidebar
            thematic_sidebar();
        ?>
        <section class="main">

                <?php

                the_post();

                // create the navigation above the content
                thematic_navigation_above();

                // calling the widget area 'single-top'
                get_sidebar('single-top');

                // action hook creating the single post
                thematic_singlepost();

                // calling the widget area 'single-insert'
                get_sidebar('single-insert');

                // create the navigation below the content
                thematic_navigation_below();

                // calling the comments template
                thematic_comments_template();

                // calling the widget area 'single-bottom'
                get_sidebar('single-bottom');

                ?>

        </section><!-- .main -->

        <?php thematic_belowcontent(); ?>

<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();
    
    // calling footer.php
    get_footer();

?>

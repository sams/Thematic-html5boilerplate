<?php

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();


    thematic_abovecontent();

    // calling the standard sidebar
    thematic_sidebar();
?>

        <section class="main">

<?php
                // create the navigation above the content
                thematic_navigation_above();

                // calling the widget area 'index-top'
                get_sidebar('index-top');

                // action hook for placing content above the index loop
                thematic_above_indexloop();

                // action hook creating the index loop
                thematic_indexloop();

                // action hook for placing content below the index loop
                thematic_below_indexloop();

                // create the navigation below the content
                thematic_navigation_below();
?>

        </section><!-- #main -->

        <?php thematic_belowcontent(); ?>
<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling footer.php
    get_footer(); ?>

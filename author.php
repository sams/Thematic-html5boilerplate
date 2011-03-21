<?php
    // calling the theme options
    global $options, $blog_id;
    foreach ($options as $value) {
        if (get_option( $value['id'] ) === FALSE) { 
            $$value['id'] = $value['std']; 
        } else {
            if (THEMATIC_MB)
            {
                $$value['id'] = get_blog_option($blog_id, $value['id'] );
            }
            else
            {
                $$value['id'] = get_option( $value['id'] );
              }
        }
    }

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>

            <?php

            thematic_abovecontent();

    // calling the standard sidebar 
    thematic_sidebar();

            // wrap this up ?wrong?
                the_post();

                // displays the page title
                thematic_page_title();

                // create the navigation above the content
                thematic_navigation_above();

                /* if display author bio is selected */
                if($thm_authorinfo == 'true' & !is_paged()) { ?>

                    <div id="author-info" class="vcard">
                        <h2 class="entry-title"><?php echo $authordata->first_name; ?> <?php echo $authordata->last_name; ?></h2>

                        <?php

                        // display the author's avatar
                        thematic_author_info_avatar();

                        ?>

                        <div class="author-bio note">
                            <?php

                            if ( !(''== $authordata->user_description) ) : echo apply_filters('archive_meta', $authordata->user_description); endif; ?>

                        </div>
                    <div id="author-email">
                        <a class="email" title="<?php echo antispambot($authordata->user_email); ?>" href="mailto:<?php echo antispambot($authordata->user_email); ?>"><?php _e('Email ', 'thematic') ?><span class="fn n"><span class="given-name"><?php echo $authordata->first_name; ?></span> <span class="family-name"><?php echo $authordata->last_name; ?></span></span></a>
                        <a class="url"  style="display:none;" href="<?php bloginfo( 'url' ) ?>/"><?php bloginfo('name') ?></a>
                    </div>
                </div><!-- #author-info -->
                <?php
                }

                // action hook creating the author loop
                thematic_authorloop();

                // create the navigation below the content
                thematic_navigation_below(); ?>
                <!-- thematic_belowcontent -->
            <?php thematic_belowcontent(); ?>

                <!-- thematic_belowcontainer -->

<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling footer.php
    get_footer();

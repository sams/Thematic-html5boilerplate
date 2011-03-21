<?php

    @header("HTTP/1.1 404 Not found", true, 404);

?><!doctype html>
<title>not found</title>

<style>
body { text-align: center;}
h1 { font-size: 50px; }
body { font: 20px Constantia, 'Hoefler Text',  "Adobe Caslon Pro", Baskerville, Georgia, Times, serif; color: #999; text-shadow: 2px 2px 2px rgba(200, 200, 200, 0.5); }
::-moz-selection{ background:#FF5E99; color:#fff; }
::selection { background:#FF5E99; color:#fff; } 
details { display:block; }
a { color: rgb(36, 109, 56); text-decoration:none; }
a:hover { color: rgb(96, 73, 141) ; text-shadow: 2px 2px 2px rgba(36, 109, 56, 0.5); }
</style>

<details>
    <summary><h1><?php _e( 'Asteroids do not concern me, Admiral. I want that ship, not excuses.', 'themename' ); ?></h1></summary>
    <?php
        $archive_content = '<p>' . sprintf( __( 'Or you maybe attempting to breach our defenses. %1$s', 'themename' ), convert_smilies( ':(' ) ) . '</p>';
        the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
    ?>
    <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'themename' ); ?></p>

    <?php get_search_form(); ?>

    <?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

    <div class="widget">
        <h2 class="widgettitle"><?php _e( 'Most Used Categories', 'themename' ); ?></h2>
        <ul>
        <?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 'TRUE', 'title_li' => '', 'number' => '10' ) ); ?>
        </ul>
    </div>

    <?php
    $archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'themename' ), convert_smilies( ':)' ) ) . '</p>';
    the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
    ?>

    <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
</details>

<?php

if (function_exists('childtheme_override_body'))  {
    function thematic_body() {
        childtheme_override_body();
    }
} else {
    function thematic_body() {
        thematic_bodyopen();
    }
}

function thematic_bodyopen() {
    if (apply_filters('thematic_show_bodyclass',TRUE)) { 
        // Creating the body class
        if (!(THEMATIC_COMPATIBLE_BODY_CLASS)) {
            echo '<body lang="en" ';
            body_class();
            echo '>' . "\n\n";
        } else {
            echo '<body class="';
            thematic_body_class();
            echo '">' . "\n\n";
        }
    } else {
        echo '<body lang="en">' . "\n\n";
    }
}

if (function_exists('childtheme_override_body_class'))  {
    function thematic_body_class() {
        childtheme_override_body_class();
    }
} else {
    // Generates semantic classes for BODY element
    function thematic_body_class( $print = true ) {
        global $wp_query, $current_user, $blog_id, $post, $taxonomy;

        $c = array();

        if (apply_filters('thematic_show_bc_wordpress', TRUE)) {
            // It's surely a WordPress blog, right?
            $c[] = 'wordpress';
        }

        if (apply_filters('thematic_show_bc_blogid', TRUE)) {
            // Applies the blog id to BODY element .. blog-id1 for WordPress < 3.0
            $c[] = 'blogid-' . $blog_id;
        }

        if (apply_filters('thematic_show_bc_datetime', TRUE)) {
            // Applies the time- and date-based classes (below) to BODY element
            thematic_date_classes( time(), $c );
        }

        if (apply_filters('thematic_show_bc_contenttype', TRUE)) {
            // Generic semantic classes for what type of content is displayed
            is_front_page()  ? $c[] = 'home'       : null; // For the front page, if set
            is_home()        ? $c[] = 'blog'       : null; // For the blog posts page, if set
            is_archive()     ? $c[] = 'archive'    : null;
            is_date()        ? $c[] = 'date'       : null;
            is_search()      ? $c[] = 'search'     : null;
            is_paged()       ? $c[] = 'paged'      : null;
            is_attachment()  ? $c[] = 'attachment' : null;
            is_404()         ? $c[] = 'four04'     : null; // CSS does not allow a digit as first character
        }

        if (apply_filters('thematic_show_bc_singular', TRUE)) {
            // Special classes for BODY element when a singular post
            if ( is_singular() ) {
                $c[] = 'singular';
            } else {
                $c[] = 'not-singular';
            }
        }

        // Special classes for BODY element when a single post
        if ( is_single() && apply_filters('thematic_show_bc_singlepost', TRUE)) {
            $postID = $wp_query->post->ID;
            the_post();

            // Adds post slug class, prefixed by 'slug-'
            $c[] = $wp_query->post->post_name;

            // Adds 'single' class and class with the post ID
            $c[] = 'single postid-' . $postID;

            // Adds classes for the month, day, and hour when the post was published
            if ( isset( $wp_query->post->post_date ) )
                thematic_date_classes( mysql2date( 'U', $wp_query->post->post_date ), $c, 's-' );

            // Adds category classes for each category on single posts
            if ( $cats = get_the_category() )
                foreach ( $cats as $cat )
                    $c[] = 's-category-' . $cat->slug;

            // Adds tag classes for each tag on single posts
            if ( $tags = get_the_tags() )
                foreach ( $tags as $tag )
                    $c[] = 's-tag-' . $tag->slug;

            // Adds taxonomy classes for each term on single posts
            $single_post_type = get_post_type_object(get_post_type($post->ID));

            // Check for post types without taxonomy inclusion
            if ( isset($single_post_type->taxonomy) ) {
                if ( $tax = get_the_terms($post->ID, get_post_taxonomies() )) {
                    foreach ( $tax as $term )   {
                        // Remove tags and categories from results
                        if  ( $term->taxonomy != 'post_tag' )    {
                            if  ( $term->taxonomy != 'category' )   {
                                $c[] = 's-tax-' . $term->taxonomy;
                                $c[] = 's-' . $term->taxonomy . '-' . $term->slug;
                            }
                        }
                    }
                }
            }

            // Adds MIME-specific classes for attachments
            if ( is_attachment() ) {
                $mime_type = get_post_mime_type();
                $mime_prefix = array( 'application/', 'image/', 'text/', 'audio/', 'video/', 'music/' );
                    $c[] = 'attachmentid-' . $postID . ' attachment-' . str_replace( $mime_prefix, "", "$mime_type" );
            }

            // Adds author class for the post author
            $c[] = 's-author-' . sanitize_title_with_dashes(strtolower(get_the_author_meta('user_nicename', $post->post_author)));
            rewind_posts();

            // For posts with excerpts
            if (has_excerpt())
                $c[] = 's-has-excerpt';

            // For posts with comments open or closed
            if (comments_open()) {
                $c[] = 's-comments-open';
            } else {
                $c[] = 's-comments-closed';
            }

            // For posts with pings open or closed
            if (pings_open()) {
                $c[] = 's-pings-open';
            } else {
                $c[] = 's-pings-closed';
            }

            // For password-protected posts
            if ( $post->post_password )
                $c[] = 's-protected';

            // For sticky posts
            if (is_sticky())
               $c[] = 's-sticky';

        }

        // Author name classes for BODY on author archives
        elseif ( is_author() && apply_filters('thematic_show_bc_authorarchives', TRUE)) {
            $author = $wp_query->get_queried_object();
            $c[] = 'author';
            $c[] = 'author-' . $author->user_nicename;
        }

        // Category name classes for BODY on category archvies
        elseif ( is_category() && apply_filters('thematic_show_bc_categoryarchives', TRUE)) {
            $cat = $wp_query->get_queried_object();
            $c[] = 'category';
            $c[] = 'category-' . $cat->slug;
        }

        // Tag name classes for BODY on tag archives
        elseif ( is_tag() && apply_filters('thematic_show_bc_tagarchives', TRUE)) {
            $tags = $wp_query->get_queried_object();
            $c[] = 'tag';
            $c[] = 'tag-' . $tags->slug;
        }

        // Taxonomy name classes for BODY on tag archives

        elseif ( is_tax() && apply_filters('thematic_show_bc_taxonomyarchives', TRUE)) {
            $c[] = 'taxonomy';
            $c[] = 'tax-' . $taxonomy;
            $c[] = $taxonomy . '-' . strtolower(thematic_get_term_name());
        }

        // Page author for BODY on 'pages'
        elseif ( is_page() && apply_filters('thematic_show_bc_pages', TRUE)) {
            $pageID = $wp_query->post->ID;
            $page_children = wp_list_pages("child_of=$pageID&echo=0");
            the_post();

            // Adds post slug class, prefixed by 'slug-'
            //$c[] = 'slug-' . $wp_query->post->post_name;
            $c[] = $wp_query->post->post_name;

            $c[] = 'page pageid-' . $pageID;

            $c[] = 'page-author-' . sanitize_title_with_dashes(strtolower(get_the_author_meta('user_nicename', $post->post_author)));

            // Checks to see if the page has children and/or is a child page; props to Adam
            if ( $page_children )
                $c[] = 'page-parent';
            if ( $wp_query->post->post_parent )
                $c[] = 'page-child parent-pageid-' . $wp_query->post->post_parent;

            // For pages with excerpts
            if (has_excerpt())
                $c[] = 'page-has-excerpt';

            // For pages with comments open or closed
            if (comments_open()) {
                $c[] = 'page-comments-open';
            } else {
                $c[] = 'page-comments-closed';
            }

            // For pages with pings open or closed
            if (pings_open()) {
                $c[] = 'page-pings-open';
            } else {
                $c[] = 'page-pings-closed';
            }

            // For password-protected pages
            if ( $post->post_password )
                $c[] = 'page-protected';

            // Checks to see if the page is using a template
            if ( is_page_template() & !is_page_template('default') )
                $c[] = 'page-template page-template-' . str_replace( '.php', '-php', get_post_meta( $pageID, '_wp_page_template', true ) );
            rewind_posts();
        }

        // Search classes for results or no results
        elseif ( is_search() && apply_filters('thematic_show_bc_search', TRUE)) {
            the_post();
            if ( $wp_query->found_posts > 0 ) {
                $c[] = 'search-results';
            } else {
                $c[] = 'search-no-results';
            }
            rewind_posts();
        }

        if (apply_filters('thematic_show_bc_loggedin', TRUE)) {
            // For when a visitor is logged in while browsing
            if ( $current_user->ID )
                $c[] = 'loggedin';
        }

     // Paged classes; for page x > 1 classes of index and all post types etc.
        if (apply_filters('thematic_show_bc_pagex', TRUE)) {
            if ( (( ( $page = $wp_query->get('paged') ) || ( $page = $wp_query->get('page') ) ) && $page > 1 ) ) {
                // Thanks to Prentiss Riddle, twitter.com/pzriddle, for the security fix below.
                $page = intval($page); // Ensures that an integer (not some dangerous script) is passed for the variable
                     $c[] = 'paged-' . $page;
                 if (thematic_is_custom_post_type()) {
                             $c[] = str_replace('_','-',$post->post_type) . '-paged-' . $page;
                     } elseif ( is_single() && $post->post_type=="post"  ) {
                        $c[] = 'single-paged-' . $page;
                    } elseif ( is_page() ) {
                        $c[] = 'page-paged-' . $page;
                    } elseif ( is_category() ) {
                        $c[] = 'category-paged-' . $page;
                    } elseif ( is_tag() ) {
                        $c[] = 'tag-paged-' . $page;
                    } elseif ( is_tax() ) {
                        $c[] = 'taxonomy-paged-' . $page;
                    } elseif ( is_date() ) {
                        $c[] = 'date-paged-' . $page;
                    } elseif ( is_author() ) {
                        $c[] = 'author-paged-' . $page;
                    } elseif ( is_search() ) {
                        $c[] = 'search-paged-' . $page;
                 }
             // Paged classes; for page x = 1    For all post types
             } elseif (strpos($post->post_content, '<!--nextpage-->') )  {
                 if (thematic_is_custom_post_type()) {
                        $c[] = str_replace('_','-',$post->post_type) . '-paged-1';
                     } elseif (is_page()) {
                        $c[] = 'page-paged-1';
                     } elseif (is_single())  {
                        $c[] = 'single-paged-1';
                }
              }
          }


        // Separates classes with a single space, collates classes for BODY
        $c = join( ' ', apply_filters( 'thematic_body_class',  $c ) ); // Available filter: thematic_body_class

        // And tada!
        return $print ? print($c) : $c;
    }
}

// Add browser CSS class to the end (queuing through priority) of the body classes 

if (!(THEMATIC_COMPATIBLE_BODY_CLASS) && (defined('THEMATIC_BROWSER_BODY_CLASS') && THEMATIC_BROWSER_BODY_CLASS)) {
    add_filter('body_class', 'browser_class_names', 20);
    }

if (apply_filters('thematic_show_bc_browser', TRUE)  && (defined('THEMATIC_BROWSER_BODY_CLASS') && THEMATIC_BROWSER_BODY_CLASS)) {
    add_filter('thematic_body_class', 'browser_class_names', 20);
    }




function browser_class_names($classes) {
    // add 'class-name' to the $classes array
    // $classes[] = 'class-name';
    $browser = $_SERVER[ 'HTTP_USER_AGENT' ];

    // Mac, PC ...or Linux
    if ( preg_match( "/Mac/", $browser ) ){
        $classes[] = 'mac';

    } elseif ( preg_match( "/Windows/", $browser ) ){
        $classes[] = 'windows';

    } elseif ( preg_match( "/Linux/", $browser ) ) {
        $classes[] = 'linux';

    } else {
        $classes[] = 'unknown-os';
    }

    // Checks browsers in this order: Chrome, Safari, Opera, MSIE, FF
    if ( preg_match( "/Chrome/", $browser ) ) {
        $classes[] = 'chrome';

        preg_match( "/Chrome\/(\d.\d)/si", $browser, $matches);
        $ch_version = 'ch' . str_replace( '.', '-', $matches[1] );
        $classes[] = $ch_version;

    } elseif ( preg_match( "/Safari/", $browser ) ) {
        $classes[] = 'safari';

        preg_match( "/Version\/(\d.\d)/si", $browser, $matches);
        $sf_version = 'sf' . str_replace( '.', '-', $matches[1] );
        $classes[] = $sf_version;

    } elseif ( preg_match( "/Opera/", $browser ) ) {
        $classes[] = 'opera';

        preg_match( "/Opera\/(\d.\d)/si", $browser, $matches);
        $op_version = 'op' . str_replace( '.', '-', $matches[1] );
        $classes[] = $op_version;

    } elseif ( preg_match( "/MSIE/", $browser ) ) {
        $classes[] = 'msie';

        if( preg_match( "/MSIE 6.0/", $browser ) ) {
            $classes[] = 'ie6';
        } elseif ( preg_match( "/MSIE 7.0/", $browser ) ){
            $classes[] = 'ie7';
        } elseif ( preg_match( "/MSIE 8.0/", $browser ) ){
            $classes[] = 'ie8';
        }

    } elseif ( preg_match( "/Firefox/", $browser ) && preg_match( "/Gecko/", $browser ) ) {
            $classes[] = 'firefox';

            preg_match( "/Firefox\/(\d)/si", $browser, $matches);
            $ff_version = 'ff' . str_replace( '.', '-', $matches[1] );
            $classes[] = $ff_version;

    } else {
        $classes[] = 'unknown-browser';
    }
    // return the $classes array
    return $classes;
}


if (function_exists('childtheme_override_post_class'))  {
    function thematic_post_class() {
        childtheme_override_post_class();
    }
} else {
    // Generates semantic classes for each post DIV element
    function thematic_post_class( $print = true ) {
        global $post, $thematic_post_alt, $thematic_content_length, $taxonomy;

        // hentry for hAtom compliace, gets 'alt' for every other post DIV, describes the post type and p[n]
        $c = array( 'hentry', "p$thematic_post_alt", str_replace('_','-',$post->post_type), $post->post_status );

        // Author for the post queried
        $c[] = 'author-' . sanitize_title_with_dashes(strtolower(get_the_author_meta('user_login')));

        // Category for the post queried
        foreach ( (array) get_the_category() as $cat )
            $c[] = 'category-' . $cat->slug;

        // Tags for the post queried; if not tagged, use .untagged
        if ( get_the_tags() == null ) {
            $c[] = 'untagged';
        } else {
            foreach ( (array) get_the_tags() as $tag )
                $c[] = 'tag-' . $tag->slug;
        }

        if (function_exists('get_post_type_object')) {
            // Taxonomies and terms for the post queried
            $single_post_type = get_post_type_object(get_post_type($post->ID));
            // Check for post types without taxonomy inclusion
            if ( isset($single_post_type->taxonomy) ) {
                foreach ( (array) get_the_terms( $post->ID, get_post_taxonomies() )  as $term  )   {
                    // Remove tags and categories from results
                    if  ( $term->taxonomy != 'category' )    {
                        if  ( $term->taxonomy != 'post_tag' )   {
                            $c[] = 'p-tax-' . $term->taxonomy;
                            $c[] = 'p-' . $term->taxonomy . '-' . $term->slug;
                        }
                    }
                }
            }
        }

        // For posts displayed as full content
        if ($thematic_content_length == 'full')
            $c[] = 'is-full';

        // For posts displayed as excerpts
        if ($thematic_content_length == 'excerpt') {
            $c[] = 'is-excerpt';
            if ( has_excerpt() && !preg_match('/<!--more(.*?)?-->/', $post->post_content) ) {
                // For wp-admin Write Page generated excerpts
                $c[] = 'custom-excerpt';
            } else {
                // For automatically generated excerpts
                $c[] = 'auto-excerpt';
            }
        }

        // For single posts that had a wp-admin Write Page generated excerpt
        if ( has_excerpt() && is_single() )
            $c[] = 'has-excerpt';

        //    For posts using more tag
        if ( preg_match('/<!--more(.*?)?-->/', $post->post_content) ) {
            if ( !is_single() ) {
                $c[] = 'wp-teaser';
            } elseif ( is_single() ) {
                $c[] = 'has-teaser';
            }
        }

        // For posts with comments open or closed
        if ( comments_open() ) {
            $c[] = 'comments-open';
        } else {
            $c[] = 'comments-closed';
        }

        // For posts with pings open or closed
        if (pings_open()) {
            $c[] = 'pings-open';
        } else {
            $c[] = 'pings-closed';
        }

        // For password-protected posts
        if ( $post->post_password )
            $c[] = 'protected';

        // For sticky posts
        if (is_sticky())
           $c[] = 'sticky';

        // Applies the time- and date-based classes (below) to post DIV
        thematic_date_classes( mysql2date( 'U', $post->post_date ), $c );

        // If it's the other to the every, then add 'alt' class
        if ( ++$thematic_post_alt % 2 )
            $c[] = 'alt';

        // Adds post slug class, prefixed by 'slug-'
        $c[] = 'slug-' . $post->post_name;

        // Separates classes with a single space, collates classes for post DIV
        $c = join( ' ', apply_filters( 'post_class', $c ) ); // Available filter: post_class

        // And tada!
        return $print ? print($c) : $c;
    }
}

// Define the num val for 'alt' classes (in post DIV and comment LI)
$thematic_post_alt = 1;

if (function_exists('childtheme_override_comment_class'))  {
    function thematic_comment_class() {
        childtheme_override_comment_class();
    }
} else {
    // Generates semantic classes for each comment LI element
    function thematic_comment_class( $print = true ) {
        global $comment, $post, $thematic_comment_alt, $comment_depth, $comment_thread_alt;

        // Collects the comment type (comment, trackback),
        $c = array( $comment->comment_type );

        // Counts trackbacks (t[n]) or comments (c[n])
        if ( $comment->comment_type == 'comment' ) {
            $c[] = "c$thematic_comment_alt";
        } else {
            $c[] = "t$thematic_comment_alt";
        }

        // If the comment author has an id (registered), then print the log in name
        if ( $comment->user_id > 0 ) {
            $user = get_userdata($comment->user_id);
            // For all registered users, 'byuser'; to specificy the registered user, 'commentauthor+[log in name]'
            $c[] = 'byuser comment-author-' . sanitize_title_with_dashes(strtolower( $user->user_login ));
            // For comment authors who are the author of the post
            if ( $comment->user_id === $post->post_author )
                $c[] = 'bypostauthor';
        }

        // If it's the other to the every, then add 'alt' class; collects time- and date-based classes
        thematic_date_classes( mysql2date( 'U', $comment->comment_date ), $c, 'c-' );
        if ( ++$thematic_comment_alt % 2 )
            $c[] = 'alt';

        // Comment depth
        $c[] = "depth-$comment_depth";

        // Separates classes with a single space, collates classes for comment LI
        $c = join( ' ', apply_filters( 'comment_class', $c ) ); // Available filter: comment_class

        // Tada again!
        return $print ? print($c) : $c;
    }
}

// Generates time- and date-based classes for BODY, post DIVs, and comment LIs; relative to GMT (UTC)
if (function_exists('childtheme_override_date_classes'))  {
    function thematic_date_classes() {
        childtheme_override_date_classes();
    }
} else {
    function thematic_date_classes( $t, &$c, $p = '' ) {
        $t = $t + ( get_option('gmt_offset') * 3600 );
        $c[] = $p . 'y' . gmdate( 'Y', $t ); // Year
        $c[] = $p . 'm' . gmdate( 'm', $t ); // Month
        $c[] = $p . 'd' . gmdate( 'd', $t ); // Day
        $c[] = $p . 'h' . gmdate( 'H', $t ); // Hour
    }
}

// Remember: Thematic, like The Sandbox, is for play.
?>

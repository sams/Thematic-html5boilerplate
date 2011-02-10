<?php

// Located in 404.php (not in PI's twist), archive.php, archives.php, attachement.php, author.php, category.php index.php, 
// links.php, page.php, search.php, single.php, tag.php
// Just between #main and #container
function thematic_abovecontainer() {
    do_action('thematic_abovecontainer');
} // end thematic_abovecontainer


// Located in 404.php, archive.php, archives.php, attachement.php, author.php, category.php index.php, 
// links.php, page.php, search.php, single.php, tag.php
// Just between #main and #container
function thematic_abovecontent() {
    do_action('thematic_abovecontent');
} // end thematic_abovecontent


// Located in 404.php, archive.php, archives.php, attachement.php, author.php, category.php index.php, 
// links.php, page.php, search.php, single.php, tag.php
// Just between #main and #container
function thematic_abovepost() {
    do_action('thematic_abovepost');
} // end thematic_abovepost


// Located in archives.php
// Just after the content
function thematic_archives() {
	do_action('thematic_archives');
} // end thematic_archives


// Located in archive.php, author.php, category.php, index.php, search.php, single.php, tag.php
// Just before the content
function thematic_navigation_above() {
	do_action('thematic_navigation_above');
} // end thematic_navigation_above


// Located in archive.php, author.php, category.php, index.php, search.php, single.php, tag.php
// Just after the content
function thematic_navigation_below() {
	do_action('thematic_navigation_below');
} // end thematic_navigation_below


// Located in index.php 
// Just before the loop
function thematic_above_indexloop() {
    do_action('thematic_above_indexloop');
} // end thematic_above_indexloop


// Located in archive.php
// The Loop
function thematic_archiveloop() {
	do_action('thematic_archiveloop');
} // end thematic_archiveloop


// Located in author.php
// The Loop
function thematic_authorloop() {
	do_action('thematic_authorloop');
} // end thematic_authorloop


// Located in category.php
// The Loop
function thematic_categoryloop() {
	do_action('thematic_categoryloop');
} // end thematic_categoryloop


// Located in index.php
// The Loop
function thematic_indexloop() {
	do_action('thematic_indexloop');
} // end thematic_indexloop


// Located in search.php
// The Loop
function thematic_searchloop() {
	do_action('thematic_searchloop');
} // end thematic_searchloop


// Located in single.php
// The Post
function thematic_singlepost() {
	do_action('thematic_singlepost');
} //end thematic_singlepost


// Located in tag.php
// The Loop
function thematic_tagloop() {
	do_action('thematic_tagloop');
} // end thematic_tagloop


// Located in index.php 
// Just after the loop
function thematic_below_indexloop() {
    do_action('thematic_below_indexloop');
} // end thematic_below_indexloop


// Located in category.php 
// Just before the loop
function thematic_above_categoryloop() {
    do_action('thematic_above_categoryloop');
} // end thematic_above_categoryloop


// Located in category.php 
// Just after the loop
function thematic_below_categoryloop() {
    do_action('thematic_below_categoryloop');
} // end thematic_below_categoryloop


// Located in search.php 
// Just before the loop
function thematic_above_searchloop() {
    do_action('thematic_above_searchloop');
} // end thematic_above_searchloop


// Located in search.php 
// Just after the loop
function thematic_below_searchloop() {
    do_action('thematic_below_searchloop');
} // end thematic_below_searchloop


// Located in tag.php 
// Just before the loop
function thematic_above_tagloop() {
    do_action('thematic_above_tagloop');
} // end thematic_above_tagloop


// Located in tag.php 
// Just after the loop
function thematic_below_tagloop() {
    do_action('thematic_below_tagloop');
} // end thematic_below_tagloop


// Located in 404.php, archive.php, archives.php, attachement.php, author.php, category.php index.php, 
// links.php, page.php, search.php, single.php, tag.php
// Just below #content
function thematic_belowpost() {
    do_action('thematic_belowpost');
} // end thematic_belowpost


// Located in 404.php, archive.php, archives.php, attachement.php, author.php, category.php index.php, 
// links.php, page.php, search.php, single.php, tag.php
// Just below #content
function thematic_belowcontent() {
    do_action('thematic_belowcontent');
} // end thematic_belowcontent


// Located in 404.php, archive.php, archives.php, attachement.php, author.php, category.php index.php, 
// links.php, page.php, search.php, single.php, tag.php
// Just below #container
function thematic_belowcontainer() {
    do_action('thematic_belowcontainer');
} // end thematic_belowcontainer


// Filter the page title
// located in archive.php, attachement.php, author.php, category.php, search.php, tag.php
if (function_exists('childtheme_override_page_title'))  {
	function thematic_page_title() {
		childtheme_override_page_title();
	}
} else {
	function thematic_page_title() {
		
		global $post;
		
		$content = '';
		if (is_attachment()) {
				$content .= '<h2 class="page-title"><a href="';
				$content .= apply_filters('the_permalink',get_permalink($post->post_parent));
				$content .= '" rev="attachment"><span class="meta-nav">&laquo; </span>';
				$content .= get_the_title($post->post_parent);
				$content .= '</a></h2>';
		} elseif (is_author()) {
				$content .= '<h1 class="page-title author">';
				$author = get_the_author_meta( 'display_name' );
				$content .= __('Author Archives: ', 'thematic');
				$content .= '<span>';
				$content .= $author;
				$content .= '</span></h1>';
		} elseif (is_category()) {
				$content .= '<h1 class="page-title">';
				$content .= __('Category Archives:', 'thematic');
				$content .= ' <span>';
				$content .= single_cat_title('', FALSE);
				$content .= '</span></h1>' . "\n";
				$content .= '<div class="archive-meta">';
				if ( !(''== category_description()) ) : $content .= apply_filters('archive_meta', category_description()); endif;
				$content .= '</div>';
		} elseif (is_search()) {
				$content .= '<h1 class="page-title">';
				$content .= __('Search Results for:', 'thematic');
				$content .= ' <span id="search-terms">';
				$content .= esc_html(stripslashes($_GET['s']));
				$content .= '</span></h1>';
		} elseif (is_tag()) {
				$content .= '<h1 class="page-title">';
				$content .= __('Tag Archives:', 'thematic');
				$content .= ' <span>';
				$content .= __(thematic_tag_query());
				$content .= '</span></h1>';
		} elseif (is_tax()) {
			    global $taxonomy;
				$content .= '<h1 class="page-title">';
				$tax = get_taxonomy($taxonomy);
				$content .= $tax->labels->name . ' ';
				$content .= __('Archives:', 'thematic');
				$content .= ' <span>';
				$content .= thematic_get_term_name();
				$content .= '</span></h1>';
		}	elseif (is_day()) {
				$content .= '<h1 class="page-title">';
				$content .= sprintf(__('Daily Archives: <span>%s</span>', 'thematic'), get_the_time(get_option('date_format')));
				$content .= '</h1>';
		} elseif (is_month()) {
				$content .= '<h1 class="page-title">';
				$content .= sprintf(__('Monthly Archives: <span>%s</span>', 'thematic'), get_the_time('F Y'));
				$content .= '</h1>';
		} elseif (is_year()) {
				$content .= '<h1 class="page-title">';
				$content .= sprintf(__('Yearly Archives: <span>%s</span>', 'thematic'), get_the_time('Y'));
				$content .= '</h1>';
		} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
				$content .= '<h1 class="page-title">';
				$content .= __('Blog Archives', 'thematic');
				$content .= '</h1>';
		}
		$content .= "\n";
		echo apply_filters('thematic_page_title', $content);
	}
}


// Action to create the above navigation
if (function_exists('childtheme_override_nav_above'))  {
	function thematic_nav_above() {
		childtheme_override_nav_above();
	}
} else {
	function thematic_nav_above() {
		if (is_single()) { ?>

				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php thematic_previous_post_link() ?></div>
					<div class="nav-next"><?php thematic_next_post_link() ?></div>
				</div>

<?php
		} else { ?>

				<div id="nav-above" class="navigation">
               		<?php if(function_exists('wp_pagenavi')) { ?>
                	<?php wp_pagenavi(); ?>
					<?php } else { ?>  
					<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'thematic')) ?></div>
					<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'thematic')) ?></div>
					<?php } ?>
					
				</div>	
	
<?php
		}
	}
} // end nav_above

add_action('thematic_navigation_above', 'thematic_nav_above', 2);


// The Archive Loop
if (function_exists('childtheme_override_archive_loop'))  {
	function thematic_archive_loop() {
		childtheme_override_archive_loop();
	}
} else {
	function thematic_archive_loop() {
		while ( have_posts() ) : the_post(); 
		
				thematic_abovepost(); ?>

				<div id="post-<?php the_ID();
					echo '" ';
					if (!(THEMATIC_COMPATIBLE_POST_CLASS)) {
						post_class();
						echo '>';
					} else {
						echo 'class="';
						thematic_post_class();
						echo '">';
					}
     				thematic_postheader(); ?>
					<div class="entry-content">
<?php thematic_content(); ?>

					</div><!-- .entry-content -->
					<?php thematic_postfooter(); ?>
				</div><!-- #post -->

			<?php 
			
				thematic_belowpost();
		
		endwhile;
	}
} // end archive_loop

add_action('thematic_archiveloop', 'thematic_archive_loop');


// The Author Loop
if (function_exists('childtheme_override_author_loop'))  {
	function thematic_author_loop() {
		childtheme_override_author_loop();
	}
} else {
	function thematic_author_loop() {
		rewind_posts();
		while (have_posts()) : the_post(); 
		
				thematic_abovepost(); ?>

				<div id="post-<?php the_ID();
					echo '" ';
					if (!(THEMATIC_COMPATIBLE_POST_CLASS)) {
						post_class();
						echo '>';
					} else {
						echo 'class="';
						thematic_post_class();
						echo '">';
					}
     				thematic_postheader(); ?>
					<div class="entry-content ">
<?php thematic_content(); ?>

					</div><!-- .entry-content -->
					<?php thematic_postfooter(); ?>
				</div><!-- #post -->

			<?php 
		
				thematic_belowpost();
		
		endwhile;
	}
} // end author_loop

add_action('thematic_authorloop', 'thematic_author_loop');


// The Category Loop
if (function_exists('childtheme_override_category_loop'))  {
	function thematic_category_loop() {
		childtheme_override_category_loop();
	}
} else {
	function thematic_category_loop() {
		while (have_posts()) : the_post(); 
		
				thematic_abovepost(); ?>
	
				<div id="post-<?php the_ID();
					echo '" ';
					if (!(THEMATIC_COMPATIBLE_POST_CLASS)) {
						post_class();
						echo '>';
					} else {
						echo 'class="';
						thematic_post_class();
						echo '">';
					}
     				thematic_postheader(); ?>
					<div class="entry-content">
<?php thematic_content(); ?>
	
					</div><!-- .entry-content -->
					<?php thematic_postfooter(); ?>
				</div><!-- #post -->

			<?php 
		
				thematic_belowpost();
		
		endwhile;
	}
} // end category_loop

add_action('thematic_categoryloop', 'thematic_category_loop');


// The Index Loop
if (function_exists('childtheme_override_index_loop'))  {
	function thematic_index_loop() {
		childtheme_override_index_loop();
	}
} else {
	function thematic_index_loop() {
		
		global $options, $blog_id;
		
		foreach ($options as $value) {
		    if (get_option( $value['id'] ) === FALSE) { 
		        $$value['id'] = $value['std']; 
		    } else {
		    	if (THEMATIC_MB) 
		    	{
		        	$$value['id'] = get_option($blog_id,  $value['id'] );
		    	}
		    	else
		    	{
		        	$$value['id'] = get_option( $value['id'] );
		    	}
		    }
		}
		
		/* Count the number of posts so we can insert a widgetized area */ $count = 1;
		while ( have_posts() ) : the_post();
		
				thematic_abovepost(); ?>

				<div id="post-<?php the_ID();
					echo '" ';
					if (!(THEMATIC_COMPATIBLE_POST_CLASS)) {
						post_class();
						echo '>';
					} else {
						echo 'class="';
						thematic_post_class();
						echo '">';
					}
     				thematic_postheader(); ?>
					<div class="entry-content">
<?php thematic_content(); ?>

					<?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'thematic') . '&after=</div>') ?>
					</div><!-- .entry-content -->
					<?php thematic_postfooter(); ?>
				</div><!-- #post -->

			<?php 
				
				thematic_belowpost();
				
				comments_template();

				if ($count==$thm_insert_position) {
						get_sidebar('index-insert');
				}
				$count = $count + 1;
		endwhile;
	}
} // end index_loop

add_action('thematic_indexloop', 'thematic_index_loop');


// The Single Post
if (function_exists('childtheme_override_single_post'))  {
	function thematic_single_post() {
		childtheme_override_single_post();
	}
} else {
	function thematic_single_post() { 
		
				thematic_abovepost(); ?>
			
				<div id="post-<?php the_ID();
					echo '" ';
					if (!(THEMATIC_COMPATIBLE_POST_CLASS)) {
						post_class();
						echo '>';
					} else {
						echo 'class="';
						thematic_post_class();
						echo '">';
					}
     				thematic_postheader(); ?>
					<div class="entry-content">
<?php thematic_content(); ?>

						<?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'thematic') . '&after=</div>') ?>
					</div><!-- .entry-content -->
					<?php thematic_postfooter(); ?>
				</div><!-- #post -->
		<?php

			thematic_belowpost();
	}
} // end single_post

add_action('thematic_singlepost', 'thematic_single_post');


// The Search Loop
if (function_exists('childtheme_override_search_loop'))  {
	function thematic_search_loop() {
		childtheme_override_search_loop();
	}
} else {
	function thematic_search_loop() {
		while ( have_posts() ) : the_post(); 
		
				thematic_abovepost(); ?>

				<div id="post-<?php the_ID();
					echo '" ';
					if (!(THEMATIC_COMPATIBLE_POST_CLASS)) {
						post_class();
						echo '>';
					} else {
						echo 'class="';
						thematic_post_class();
						echo '">';
					}
     				thematic_postheader(); ?>
					<div class="entry-content">
<?php thematic_content(); ?>

					</div><!-- .entry-content -->
					<?php thematic_postfooter(); ?>
				</div><!-- #post -->

			<?php 
		
				thematic_belowpost();
		
		endwhile;
	}
} // end search_loop

add_action('thematic_searchloop', 'thematic_search_loop');


// The Tag Loop
if (function_exists('childtheme_override_tag_loop'))  {
	function thematic_tag_loop() {
		childtheme_override_tag_loop();
	}
} else {
	function thematic_tag_loop() {
		while (have_posts()) : the_post(); 
		
				thematic_abovepost(); ?>

				<div id="post-<?php the_ID();
					echo '" ';
					if (!(THEMATIC_COMPATIBLE_POST_CLASS)) {
						post_class();
						echo '>';
					} else {
						echo 'class="';
						thematic_post_class();
						echo '">';
					}
     				thematic_postheader(); ?>
					<div class="entry-content">
<?php thematic_content() ?>

					</div><!-- .entry-content -->
					<?php thematic_postfooter(); ?>
				</div><!-- #post -->

			<?php 
		
				thematic_belowpost();
		
		endwhile;
	}
} // end tag_loop

add_action('thematic_tagloop', 'thematic_tag_loop');


// Filter to create the time url title displayed in Post Header
function thematic_time_title() {

	$time_title = 'Y-m-d\TH:i:sO';
	
	// Filters should return correct 
	$time_title = apply_filters('thematic_time_title', $time_title);
	
	return $time_title;
} // end time_title


// Filter to create the time displayed in Post Header
function thematic_time_display() {

	$time_display = get_option('date_format');
	
	// Filters should return correct 
	$time_display = apply_filters('thematic_time_display', $time_display);
	
	return $time_display;
} // end time_display


// Information in Post Header
if (function_exists('childtheme_override_postheader'))  {
	function thematic_postheader() {
		childtheme_override_postheader();
	}
} else {
	function thematic_postheader() {
 	   
 	   global $post;
 	 
 	   if ( is_404() || $post->post_type == 'page') {
 	       $postheader = thematic_postheader_posttitle();        
 	   } else {
 	       $postheader = thematic_postheader_posttitle() . thematic_postheader_postmeta();    
 	   }
 	   
 	   echo apply_filters( 'thematic_postheader', $postheader ); // Filter to override default post header
	}
}  // end postheader


// Create the post edit link
if (function_exists('childtheme_override_postheader_posteditlink'))  {
	function thematic_postheader_posteditlink() {
		return childtheme_override_postheader_posteditlink(); 
	}
} else {
	function thematic_postheader_posteditlink() {
    	
    	global $id;
    
		$posteditlink = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/post.php?action=edit&amp;post=' . $id;
		$posteditlink .= '" title="' . __('Edit post', 'thematic') .'">';
		$posteditlink .= __('Edit', 'thematic') . '</a>';
		
		return apply_filters('thematic_postheader_posteditlink',$posteditlink); 

	}
} // end postheader_posteditlink


// Create post title
if (function_exists('childtheme_override_postheader_posttitle'))  {
	function thematic_postheader_posttitle() {
		return childtheme_override_postheader_posttitle();
	}
} else {
	function thematic_postheader_posttitle() {

	    if (is_single() || is_page()) {
	        $posttitle = '<h1 class="entry-title">' . get_the_title() . "</h1>\n";
	    } elseif (is_404()) {    
	        $posttitle = '<h1 class="entry-title">' . __('Not Found', 'thematic') . "</h1>\n";
	    } else {
	        $posttitle = '<h2 class="entry-title"><a href="';
	        $posttitle .= apply_filters('the_permalink', get_permalink());
	        $posttitle .= '" title="';
	        $posttitle .= __('Permalink to ', 'thematic') . the_title_attribute('echo=0');
	        $posttitle .= '" rel="bookmark">';
	        $posttitle .= get_the_title();   
	        $posttitle .= "</a></h2>\n";
	    }
	    
	    return apply_filters('thematic_postheader_posttitle',$posttitle); 
	
	} 
} // end postheader_posttitle


// Create post meta
if (function_exists('childtheme_override_postheader_postmeta'))  {
	function thematic_postheader_postmeta() {
		return childtheme_override_postheader_postmeta();
	}
} else {
	function thematic_postheader_postmeta() {

	    $postmeta = '<div class="entry-meta">';
	    $postmeta .= thematic_postmeta_authorlink();
	    $postmeta .= '<span class="meta-sep meta-sep-entry-date"> | </span>';
	    $postmeta .= thematic_postmeta_entrydate();
	    
	    $postmeta .= thematic_postmeta_editlink();
	                   
	    $postmeta .= "</div><!-- .entry-meta -->\n";
	    
	    return apply_filters('thematic_postheader_postmeta',$postmeta); 
	
	}
} // end postheader_postmeta


// Create author link for post meta
if (function_exists('childtheme_override_postmeta_authorlink'))  {
	function thematic_postmeta_authorlink() {
		return childtheme_override_postmeta_authorlink();
	}
} else {
	function thematic_postmeta_authorlink() {
	    
	    global $authordata;
	
	    $authorlink = '<span class="meta-prep meta-prep-author">' . __('By ', 'thematic') . '</span>';
	    $authorlink .= '<span class="author vcard">'. '<a class="url fn n" href="';
	    $authorlink .= get_author_posts_url($authordata->ID, $authordata->user_nicename);
	    $authorlink .= '" title="' . __('View all posts by ', 'thematic') . get_the_author_meta( 'display_name' ) . '">';
	    $authorlink .= get_the_author_meta( 'display_name' );
	    $authorlink .= '</a></span>';
	    
	    return apply_filters('thematic_post_meta_authorlink', $authorlink);
	   
	}
} // end postmeta_authorlink()


// Create entry date for post meta
if (function_exists('childtheme_override_postmeta_entrydate'))  {
	function thematic_postmeta_entrydate() {
		return childtheme_override_postmeta_entrydate();
	}
} else {
	function thematic_postmeta_entrydate() {
	
	    $entrydate = '<span class="meta-prep meta-prep-entry-date">' . __('Published: ', 'thematic') . '</span>';
	    $entrydate .= '<span class="entry-date"><abbr class="published" title="';
	    $entrydate .= get_the_time(thematic_time_title()) . '">';
	    $entrydate .= get_the_time(thematic_time_display());
	    $entrydate .= '</abbr></span>';
	    
	    return apply_filters('thematic_post_meta_entrydate', $entrydate);
	   
	}
} // end postmeta_entrydate()


// Create edit link for post meta
if (function_exists('childtheme_override_postmeta_editlink'))  {
	function thematic_postmeta_editlink() {
		return childtheme_override_postmeta_editlink();
	}
} else {
	function thematic_postmeta_editlink() {
    
	    // Display edit link
	    if (current_user_can('edit_posts')) {
	        $editlink = ' <span class="meta-sep meta-sep-edit">|</span> ' . '<span class="edit">' . thematic_postheader_posteditlink() . '</span>';
	        return apply_filters('thematic_post_meta_editlink', $editlink);
	    }               
	}
} // end postmeta_editlink


// Sets up the post content 
if (function_exists('childtheme_override_content_init'))  {
	function thematic_content_init() {
		childtheme_override_content_init();
	}
} else {
	function thematic_content_init() {
		global $thematic_content_length;
		
		$content = '';
		$thematic_content_length = '';
		
		if (is_home() || is_front_page()) { 
			$content = 'full';
		} elseif (is_single()) {
			$content = 'full';
		} elseif (is_tag()) {
			$content = 'excerpt';
		} elseif (is_search()) {
			$content = 'excerpt';	
		} elseif (is_category()) {
			$content = 'excerpt';
		} elseif (is_author()) {
			$content = 'excerpt';
		} elseif (is_archive()) {
			$content = 'excerpt'; 
		}
		
		$thematic_content_length = apply_filters('thematic_content', $content);
		
	}
	add_action('thematic_abovepost','thematic_content_init');
}

// Creates the post content 
if (function_exists('childtheme_override_content'))  {
	function thematic_content() {
		childtheme_override_content();
	}
} else {
	function thematic_content() {
		global $thematic_content_length;
	
		if ( strtolower($thematic_content_length) == 'full' ) {
			$post = get_the_content(more_text());
			$post = apply_filters('the_content', $post);
			$post = str_replace(']]>', ']]&gt;', $post);
		} elseif ( strtolower($thematic_content_length) == 'excerpt') {
			$post = '';
			$post .= get_the_excerpt();
			$post = apply_filters('the_excerpt',$post);
			if ( apply_filters( 'thematic_post_thumbs', TRUE) ) {
				$post_title = get_the_title();
				$size = apply_filters( 'thematic_post_thumb_size' , array(100,100) );
				$attr = apply_filters( 'thematic_post_thumb_attr', array('title'	=> 'Permalink to ' . $post_title) );
				if ( has_post_thumbnail() ) {
					$post = '<a class="entry-thumb" href="' . get_permalink() . '" title="Permalink to ' . get_the_title() . '" >' . get_the_post_thumbnail(get_the_ID(), $size, $attr) . '</a>' . $post;
					}
			}
		} elseif ( strtolower($thematic_content_length) == 'none') {
		} else {
			$post = get_the_content(more_text());
			$post = apply_filters('the_content', $post);
			$post = str_replace(']]>', ']]&gt;', $post);
		}
		echo apply_filters('thematic_post', $post);
	} 
} // end content


// Functions that hook into thematic_archives()

		// Open .archives-page
		
		if (function_exists('childtheme_override_archivesopen'))  {
			function thematic_archivesopen() {
				childtheme_override_archivesopen();
			}
		} else {
			function thematic_archivesopen() { ?>
				
				<ul id="archives-page" class="xoxo">
		<?php }
		} // end archivesopen
		
		add_action('thematic_archives', 'thematic_archivesopen', 1);


		// Display the Category Archives
		if (function_exists('childtheme_override_category_archives'))  {
			function thematic_category_archives() {
				childtheme_override_category_archives();
			}
		} else {
			function thematic_category_archives() { ?>
						<li id="category-archives" class="content-column">
							<h2><?php _e('Archives by Category', 'thematic') ?></h2>
							<ul>
								<?php wp_list_categories('optioncount=1&feed=RSS&title_li=&show_count=1') ?> 
							</ul>
						</li>
		<?php }
		} // end category_archives
		
		add_action('thematic_archives', 'thematic_category_archives', 3);


		// Display the Monthly Archives
		if (function_exists('childtheme_override_monthly_archives'))  {
			function thematic_monthly_archives() {
				childtheme_override_monthly_archives();
			}
		} else {
			function thematic_monthly_archives() { ?>
						<li id="monthly-archives" class="content-column">
							<h2><?php _e('Archives by Month', 'thematic') ?></h2>
							<ul>
								<?php wp_get_archives('type=monthly&show_post_count=1') ?>
							</ul>
						</li>
		<?php }
		} // end monthly_archives
		
		add_action('thematic_archives', 'thematic_monthly_archives', 5);


		// Close .archives-page
		if (function_exists('childtheme_override_archivesclose'))  {
			function thematic_archivesclose() {
				childtheme_override_archivesclose();
			}
		} else {
			function thematic_archivesclose() { ?>
				</ul>
		<?php }
		} // end _archivesclose
		
		add_action('thematic_archives', 'thematic_archivesclose', 9);
		
// End of functions that hook into thematic_archives()


// Action hook called in 404.php
function thematic_404() {
	do_action('thematic_404');
} // end thematic_404


	// 404 content injected into thematic_404
	if (function_exists('childtheme_override_404_content'))  {
		function thematic_404_content() {
			childtheme_override_404_content();
		}
	} else {
		function thematic_404_content() { ?>
   			<?php thematic_postheader(); ?>
   			
				<div class="entry-content">
					<p><?php _e('Apologies, but we were unable to find what you were looking for. Perhaps  searching will help.', 'thematic') ?></p>
				</div><!-- .entry-content -->
				
				<form id="error404-searchform" method="get" action="<?php bloginfo('url') ?>/">
					<div>
						<input id="error404-s" name="s" type="text" value="<?php echo esc_html(stripslashes(get_query_var('s'))) ?>" size="40" />
						<input id="error404-searchsubmit" name="searchsubmit" type="submit" value="<?php _e('Find', 'thematic') ?>" />
					</div>
				</form>
	<?php }
	} // end 404_content
	
	add_action('thematic_404','thematic_404_content');


// creates the $more_link_text for the_content
function more_text() {
	$content = ''.__('Read More <span class="meta-nav">&raquo;</span>', 'thematic').'';
	return apply_filters('more_text', $content);
} // end more_text


// creates the $more_link_text for the_content
function list_bookmarks_args() {
	$content = 'title_before=<h2>&title_after=</h2>';
	return apply_filters('list_bookmarks_args', $content);
} // end list_bookmarks_args


// Information in Post Footer
if (function_exists('childtheme_override_postfooter'))  {
	function thematic_postfooter() {
		childtheme_override_postfooter();
	}
} else {
	function thematic_postfooter() {
	    
	    global $id, $post;
	    
	    if ($post->post_type == 'page' && current_user_can('edit_posts')) { /* For logged-in "page" search results */
	        $postfooter = '<div class="entry-utility">' . thematic_postfooter_posteditlink();
	        $postfooter .= "</div><!-- .entry-utility -->\n";    
	    } elseif ($post->post_type == 'page') { /* For logged-out "page" search results */
	        $postfooter = '';
	    } else {
	        if (is_single()) {
	            $postfooter = '<div class="entry-utility">' . thematic_postfooter_postcategory() . thematic_postfooter_posttags() . thematic_postfooter_postconnect();
	        } else {
	            $postfooter = '<div class="entry-utility">' . thematic_postfooter_postcategory() . thematic_postfooter_posttags() . thematic_postfooter_postcomments();
	        }
	        $postfooter .= "</div><!-- .entry-utility -->\n";    
	    }
	    
	    // Put it on the screen
	    echo apply_filters( 'thematic_postfooter', $postfooter ); // Filter to override default post footer
    }
} // end postfooter


// Create the post edit link
if (function_exists('childtheme_override_postfooter_posteditlink'))  {
	function thematic_postfooter_posteditlink() {
		return childtheme_override_postfooter_posteditlink();
	}
} else {
	function thematic_postfooter_posteditlink() {

	    global $id;
	    
	    $posteditlink = '<span class="edit"><a href="' . get_bloginfo('wpurl') . '/wp-admin/post.php?action=edit&amp;post=' . $id;
	    $posteditlink .= '" title="' . __('Edit post', 'thematic') .'">';
	    $posteditlink .= __('Edit', 'thematic') . '</a></span>';
	    return apply_filters('thematic_postfooter_posteditlink',$posteditlink); 
	    
	} 
} // end postfooter_posteditlink


// Create post category
if (function_exists('childtheme_override_postfooter_postcategory'))  {
	function thematic_postfooter_postcategory() {
		return childtheme_override_postfooter_postcategory();
	}
} else {
	function thematic_postfooter_postcategory() {
    
	    $postcategory = '<span class="cat-links">';
	    if (is_single()) {
	        $postcategory .= __('This entry was posted in ', 'thematic') . get_the_category_list(', ');
	        $postcategory .= '</span>';
	    } elseif ( is_category() && $cats_meow = thematic_cats_meow(', ') ) { /* Returns categories other than the one queried */
	        $postcategory .= __('Also posted in ', 'thematic') . $cats_meow;
	        $postcategory .= '</span> <span class="meta-sep meta-sep-tag-links">|</span>';
	    } else {
	        $postcategory .= __('Posted in ', 'thematic') . get_the_category_list(', ');
	        $postcategory .= '</span> <span class="meta-sep meta-sep-tag-links">|</span>';
	    }
	    return apply_filters('thematic_postfooter_postcategory',$postcategory); 
	    
	}
}  // end postfooter_postcategory

// Create post tags
if (function_exists('childtheme_override_postfooter_posttags'))  {
	function thematic_postfooter_posttags() {
		return childtheme_override_postfooter_posttags();
	}
} else {
	function thematic_postfooter_posttags() {

	    if (is_single()) {
	        $tagtext = __(' and tagged', 'thematic');
	        $posttags = get_the_tag_list("<span class=\"tag-links\"> $tagtext ",', ','</span>');
	    } elseif ( is_tag() && $tag_ur_it = thematic_tag_ur_it(', ') ) { /* Returns tags other than the one queried */
	        $posttags = '<span class="tag-links">' . __(' Also tagged ', 'thematic') . $tag_ur_it . '</span> <span class="meta-sep meta-sep-comments-link">|</span>';
	    } else {
	        $tagtext = __('Tagged', 'thematic');
	        $posttags = get_the_tag_list("<span class=\"tag-links\"> $tagtext ",', ','</span> <span class="meta-sep meta-sep-comments-link">|</span>');
	    }
	    return apply_filters('thematic_postfooter_posttags',$posttags); 
	
	}
} // end postfooter_posttags


// Create comments link and edit link
if (function_exists('childtheme_override_postfooter_postcomments'))  {
	function thematic_postfooter_postcomments() {
		return childtheme_override_postfooter_postcomments();
	}
} else {
	function thematic_postfooter_postcomments() {
	    if (comments_open()) {
	        $postcommentnumber = get_comments_number();
	        if ($postcommentnumber > '1') {
	            $postcomments = ' <span class="comments-link"><a href="' . apply_filters('the_permalink', get_permalink()) . '#comments" title="' . __('Comment on ', 'thematic') . the_title_attribute('echo=0') . '">';
	            $postcomments .= get_comments_number() . __(' Comments', 'thematic') . '</a></span>';
	        } elseif ($postcommentnumber == '1') {
	            $postcomments = ' <span class="comments-link"><a href="' . apply_filters('the_permalink', get_permalink()) . '#comments" title="' . __('Comment on ', 'thematic') . the_title_attribute('echo=0') . '">';
	            $postcomments .= get_comments_number() . __(' Comment', 'thematic') . '</a></span>';
	        } elseif ($postcommentnumber == '0') {
	            $postcomments = ' <span class="comments-link"><a href="' . apply_filters('the_permalink', get_permalink()) . '#comments" title="' . __('Comment on ', 'thematic') . the_title_attribute('echo=0') . '">';
	            $postcomments .= __('Leave a comment', 'thematic') . '</a></span>';
	        }
	    } else {
	        $postcomments = ' <span class="comments-link comments-closed-link">' . __('Comments closed', 'thematic') .'</span>';
	    }
	    // Display edit link
	    if (current_user_can('edit_posts')) {
	        $postcomments .= ' <span class="meta-sep meta-sep-edit">|</span> ' . thematic_postfooter_posteditlink();
	    }               
	    return apply_filters('thematic_postfooter_postcomments',$postcomments); 
	    
	}
} // end postfooter_postcomments


// Create permalink, comments link, and RSS on single posts
if (function_exists('childtheme_override_postfooter_postconnect'))  {
	function thematic_postfooter_postconnect() {
		return childtheme_override_postfooter_postconnect();
	}
} else {
	function thematic_postfooter_postconnect() {
    
	    $postconnect = __('. Bookmark the ', 'thematic') . '<a href="' . apply_filters('the_permalink', get_permalink()) . '" title="' . __('Permalink to ', 'thematic') . the_title_attribute('echo=0') . '">';
	    $postconnect .= __('permalink', 'thematic') . '</a>.';
	    if ((comments_open()) && (pings_open())) { /* Comments are open */
	        $postconnect .= ' <a class="comment-link" href="#respond" title ="' . __('Post a comment', 'thematic') . '">' . __('Post a comment', 'thematic') . '</a>';
	        $postconnect .= __(' or leave a trackback: ', 'thematic');
	        $postconnect .= '<a class="trackback-link" href="' . get_trackback_url() . '" title ="' . __('Trackback URL for your post', 'thematic') . '" rel="trackback">' . __('Trackback URL', 'thematic') . '</a>.';
	    } elseif (!(comments_open()) && (pings_open())) { /* Only trackbacks are open */
	        $postconnect .= __(' Comments are closed, but you can leave a trackback: ', 'thematic');
	        $postconnect .= '<a class="trackback-link" href="' . get_trackback_url() . '" title ="' . __('Trackback URL for your post', 'thematic') . '" rel="trackback">' . __('Trackback URL', 'thematic') . '</a>.';
	    } elseif ((comments_open()) && !(pings_open())) { /* Only comments open */
	        $postconnect .= __(' Trackbacks are closed, but you can ', 'thematic');
	        $postconnect .= '<a class="comment-link" href="#respond" title ="' . __('Post a comment', 'thematic') . '">' . __('post a comment', 'thematic') . '</a>.';
	    } elseif (!(comments_open()) && !(pings_open())) { /* Comments and trackbacks closed */
	        $postconnect .= __(' Both comments and trackbacks are currently closed.', 'thematic');
	    }
	    // Display edit link on single posts
	    if (current_user_can('edit_posts')) {
	        $postconnect .= ' ' . thematic_postfooter_posteditlink();
	    }
	    return apply_filters('thematic_postfooter_postconnect',$postconnect); 
	}
} // end postfooter_postconnect


// Action to create the below navigation
if (function_exists('childtheme_override_nav_below'))  {
	function thematic_nav_below() {
		childtheme_override_nav_below();
	}
} else {
	function thematic_nav_below() {
		if (is_single()) { ?>

		<nav id="nav-below" class="navigation">
			<p class="nav-previous"><?php thematic_previous_post_link() ?></p>
			<p class="nav-next"><?php thematic_next_post_link() ?></p>
		</nav>

<?php
		} else { ?>

		<nav id="nav-below" class="navigation">
			<?php if(function_exists('wp_pagenavi')) { ?>
			<?php wp_pagenavi(); ?>
			<?php } else { ?>  
			<p class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'thematic')) ?></p>
			<p class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'thematic')) ?></p>
			<?php } ?>
		</nav>
	
<?php
		}
	}
} // end nav_below

add_action('thematic_navigation_below', 'thematic_nav_below', 2);


// Creates the previous_post_link
if (function_exists('childtheme_override_previous_post_link'))  {
	function thematic_previous_post_link() {
		childtheme_override_previous_post_link();
	}
} else {
	function thematic_previous_post_link() {
		$args = array ('format'              => '%link',
									 'link'                => '<span class="meta-nav">&laquo;</span> %title',
									 'in_same_cat'         => FALSE,
									 'excluded_categories' => '');
		$args = apply_filters('thematic_previous_post_link_args', $args );
		previous_post_link($args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories']);
	}
} // end previous_post_link


// Creates the next_post_link
if (function_exists('childtheme_override_next_post_link'))  {
	function thematic_next_post_link() {
		childtheme_override_next_post_link();
	}
} else {
	function thematic_next_post_link() {
		$args = array ('format'              => '%link',
									 'link'                => '%title <span class="meta-nav">&raquo;</span>',
									 'in_same_cat'         => FALSE,
									 'excluded_categories' => '');
		$args = apply_filters('thematic_next_post_link_args', $args );
		next_post_link($args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories']);
	}
} // end next_post_link


// Produces an avatar image with the hCard-compliant photo class for author info
if (function_exists('childtheme_override_author_info_avatar'))  {
	function thematic_author_info_avatar() {
		childtheme_override_author_info_avatar();
	}
} else {
	function thematic_author_info_avatar() {
    
	    global $wp_query; $curauth = $wp_query->get_queried_object();
		
		$email = $curauth->user_email;
		$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar("$email") );
		echo $avatar;
	}
} // end author_info_avatar


// For category lists on category archives: Returns other categories except the current one (redundant)
if (function_exists('childtheme_override_cats_meow'))  {
	function thematic_cats_meow() {
		return childtheme_override_cats_meow();
	}
} else {
	function thematic_cats_meow($glue) {
		$current_cat = single_cat_title( '', false );
		$separator = "\n";
		$cats = explode( $separator, get_the_category_list($separator) );
		foreach ( $cats as $i => $str ) {
			if ( strpos( $str, ">$current_cat<" ) > 0) {
				unset($cats[$i]);
				break;
			}
		}
		if ( empty($cats) )
			return false;
	
		return trim(join( $glue, $cats ));
	}
} // end cats_meow


// For tag lists on tag archives: Returns other tags except the current one (redundant)
if (function_exists('childtheme_override_tag_ur_it'))  {
	function thematic_tag_ur_it() {
		return childtheme_override_tag_ur_it();
	}
} else {
	function thematic_tag_ur_it($glue) {
		$current_tag = single_tag_title( '', '',  false );
		$separator = "\n";
		$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
		foreach ( $tags as $i => $str ) {
			if ( strpos( $str, ">$current_tag<" ) > 0 ) {
				unset($tags[$i]);
				break;
			}
		}
		if ( empty($tags) )
			return false;
		
		return trim(join( $glue, $tags ));
	}
} // end thematic_tag_ur_it


?>
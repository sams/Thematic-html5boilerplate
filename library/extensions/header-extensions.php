<?php

// Creates the DOCTYPE section
function thematic_create_doctype() {


	/*
	 * TODO: handle manifests make a plugin to manage manifests
	 * this new plugin could use a jquery bookmarklet to collect img/css/js/etc refs for manifest
	 * this could work like the minify bookmarklet for making groups 
	 * (infact images would need to be added and it would redirect to admin manifest page and allow resorting of assets)
	 * then it can generate the manifest :) for exta niceness I would like to be able to add manifest generation interface to wp admin bar
	 * I would like to be able to add things to the groovy new admin bar generally have other things in mind
	 */



	$content = '<!doctype html>' . "\n";
	if(DEVICE == 'mobile') {
		$content.= '<html lang="en" class="no-js">' . "\n";
	} else {
        $content.= '<!--[if lt IE 7 ]> <html class="no-js ie6"> <![endif]-->' . "\n";
        $content.= '<!--[if IE 7 ]>    <html class="no-js ie7"> <![endif]-->' . "\n";
        $content.= '<!--[if IE 8 ]>    <html class="no-js ie8"> <![endif]-->' . "\n";
        $content.= '<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js"> <!--<![endif]-->' . "\n";
	}
	echo apply_filters('thematic_create_doctype', $content);
} // end thematic_create_doctype


// Creates the HEAD Profile
function thematic_head_profile() {
	$content = '<head>';
	$content .= "\n<meta charset=\"";
	$content .= strtolower(get_bloginfo('charset'));
	$content .= "\">";
	echo apply_filters('thematic_head_profile', $content);
} // end thematic_head_profile


// Get the page number adapted from http://efficienttips.com/wordpress-seo-title-description-tag/
function pageGetPageNo() {
	if (get_query_var('paged')) {
		print ' | Page ' . get_query_var('paged');
	}
} // end pageGetPageNo


// Located in header.php 
// Creates the content of the Title tag
// Credits: Tarski Theme
if (function_exists('childtheme_override_doctitle'))  {
    function thematic_doctitle() {
    	childtheme_override_doctitle();
    }
} else {
	function thematic_doctitle() {
		$site_name = get_bloginfo('name');
	    $separator = '|';
	        	
	    if ( is_single() ) {
	      $content = single_post_title('', FALSE);
	    }
	    elseif ( is_home() || is_front_page() ) { 
	      $content = get_bloginfo('description');
	    }
	    elseif ( is_page() ) { 
	      $content = single_post_title('', FALSE); 
	    }
	    elseif ( is_search() ) { 
	      $content = __('Search Results for:', 'thematic'); 
	      $content .= ' ' . esc_html(stripslashes(get_search_query()));
	    }
	    elseif ( is_category() ) {
	      $content = __('Category Archives:', 'thematic');
	      $content .= ' ' . single_cat_title("", false);;
	    }
	    elseif ( is_tag() ) { 
	      $content = __('Tag Archives:', 'thematic');
	      $content .= ' ' . thematic_tag_query();
	    }
	    elseif ( is_404() ) { 
	      $content = __('Not Found', 'thematic'); 
	    }
	    else { 
	      $content = get_bloginfo('description');
	    }
	
	    if (get_query_var('paged')) {
	      $content .= ' ' .$separator. ' ';
	      $content .= 'Page';
	      $content .= ' ';
	      $content .= get_query_var('paged');
	    }
	
	    if($content) {
	      if ( is_home() || is_front_page() ) {
	          $elements = array(
	            'site_name' => $site_name,
	            'separator' => $separator,
	            'content' => $content
	          );
	      }
	      else {
	          $elements = array(
	            'content' => $content
	          );
	      }  
	    } else {
	      $elements = array(
	        'site_name' => $site_name
	      );
	    }
	
	    // Filters should return an array
	    $elements = apply_filters('thematic_doctitle', $elements);
		
	    // But if they don't, it won't try to implode
	    if(is_array($elements)) {
	      $doctitle = implode(' ', $elements);
	    }
	    else {
	      $doctitle = $elements;
	    }
	    
	    $doctitle = "\t" . "<title>" . $doctitle . "</title>" . "\n\n";
	    
	    echo $doctitle;
	} // end thematic_doctitle
}

// Creates the content-type section
function thematic_create_contenttype() {
    $content  = "\t";
    $content .= "<meta http-equiv=\"Content-Type\" content=\"";
    $content .= get_bloginfo('html_type'); 
    $content .= "; charset=";
    $content .= get_bloginfo('charset');
    $content .= "\" />";
    $content .= "\n\n";
    echo apply_filters('thematic_create_contenttype', $content);
}

// Creates the inital head content of boilerplate (many options here are controlled by admin options)
function thematic_show_meta() {
	global $my_shortname;
	$cf = stripslashes(get_option($my_shortname . '_chromeframe'));
	$fi = stripslashes(get_option($my_shortname . '_favicon'));
	$at = stripslashes(get_option($my_shortname . '_appletouch'));
	$msa = stripslashes(get_option($my_shortname . '_msa'));
	$sl = $fe = false;

	// if chrome frame is set ie its not in htaccess
	if($cf == "true")	{
		$content .= "\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">";
	}

	if($sl == 'true')	{
		// todo not sure yet - http://microformats.org/wiki/rel-shortlink
		$content .= "\n<meta rel=\"shortlink\" type=\"text/html\" href=\"\">";
	}

	if($fe == 'true')	{
		// featured image resized will be fb image
		// else will be logo <link rel="image_src" href="">
		$content .= "\n<meta rel=\"image_src\" href=\"\">";
	}
	
	if(DEVICE == 'mobile')	{
		// featured image resized will be fb image
		// else will be logo <link rel="image_src" href="">
		$content .= "\n<meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0\">";
	}

	// verification meta tags for google and yahoo, bing and alexa
	// verify v1? check this
	// only if home:-
	if(is_home() || is_front_page())	{

		$gsv = stripslashes(get_option($my_shortname . '_gsv'));
		$ykey = stripslashes(get_option($my_shortname . '_ykey'));
		$akey = stripslashes(get_option($my_shortname . '_akey'));
		$msv = stripslashes(get_option($my_shortname . '_msv'));

		if(!empty($gsv) || !empty($ykey) || !empty($msv))	{
			$content .= "\n<!-- verification meta -->";
		}

		// google-site-verification
		if(!empty($gsv))	{
			$content .= "\n<meta name=\"google-site-verification\" content=\"$gsv\">";
		}

		// yahoo
		if(!empty($ykey))	{
			$content .= "\n<meta name=\"y_key\" content=\"$ykey\">";
		}

		// Alexa
		if(!empty($akey))	{
			$content .= "\n<meta name=\"alexaVerifyID\" content=\"$akey\">";
		}

		// bing
		if(!empty($msv))	{
			$content .= "\n<meta name=\"msvalidate.01\" content=\"$msv\">";
		}
	}
	
	if(DEVICE == 'desktop')	{
		$content .= "\n<meta http-equiv=\"imagetoolbar\" content=\"false\">";
		$content .= "\n";
	}

	// if your using default favicon & apple touch - these may be uploaded
	if(!empty($fi) || !empty($at))	{
		$content .= "\n<!-- Icon Links  -->";
	}
	if(!empty($fi) && $fi == 'true')	{
		$content .= "\n<link rel=\"shortcut icon\" href=\"$fi\">";
	}
	if(!empty($at) && $at == 'true')	{
		$content .= "\n<link rel=\"apple-touch-icon\" href=\"$at\">";
	}

	echo apply_filters('thematic_create_contenttype', $content);
} // end thematic_create_contenttype

// The master switch for SEO functions
function thematic_seo() {
	$content = TRUE;
	return apply_filters('thematic_seo', $content);
} // end thematic_seo

function thematic_script() {
	$jsfoot = stripslashes(get_option($my_shortname . '_jsfoot'));
	$google_hosted_apis = stripslashes(get_option($my_shortname . '_gdn'));
	$jqueryversion = stripslashes(get_option($my_shortname . '_jqueryversion'));
	$js_plugins = stripslashes(get_option($my_shortname . '_js_plugins'));
	$js_dropdowns = stripslashes(get_option($my_shortname . '_js_dropdowns'));
	$dqjquery = stripslashes(get_option($my_shortname . '_js_dqjquery'));

	if(!empty($dqjquery) && $dqjquery == 'true') {
		wp_deregister_script('jquery');
	}

	if(!is_admin() && $jsfoot == 'true' && $isHead && ($google_hosted_apis == 'true') )	{
		if((!empty($dqjquery) && $dqjquery == 'true') || ($google_hosted_apis == 'true'))	{
			wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/'.$jqueryversion.'/jquery.min.js', array(), false, true);
		}
	}
	//$scripts =   themeatic_script_setup();
	
	//if($jsfoot !== 'true') return;

	// Print filtered scripts
	print apply_filters('thematic_head_scripts', $scripts);
	
}

// Creates the canonical URL
function thematic_canonical_url() {
	if (thematic_seo()) {
		if ( is_singular() ) {
			$canonical_url = "\t";
			$canonical_url .= '<link rel="canonical" href="' . get_permalink() . '">';
			$canonical_url .= "\n";
			echo apply_filters('thematic_canonical_url', $canonical_url);
		}
	}
} // end thematic_canonical_url


// switch use of thematic_the_excerpt() - default: ON
function thematic_use_excerpt() {
    $display = TRUE;
    $display = apply_filters('thematic_use_excerpt', $display);
    return $display;
} // end thematic_use_excerpt


// switch use of thematic_the_excerpt() - default: OFF
function thematic_use_autoexcerpt() {
    $display = FALSE;
    $display = apply_filters('thematic_use_autoexcerpt', $display);
    return $display;
} // end thematic_use_autoexcerpt


/**
 * Creates the meta-tag description
 */
function thematic_create_description() {
		$content = '';
		if (thematic_seo()) {
    		if (is_single() || is_page() ) {
      		  if ( have_posts() ) {
          		  while ( have_posts() ) {
            		    the_post();
										if (thematic_the_excerpt() == "") {
                    		if (thematic_use_autoexcerpt()) {
                        		$content ="\t";
														$content .= "<meta name=\"description\" content=\"";
                        		$content .= thematic_excerpt_rss();
                        		$content .= "\" />";
                        		$content .= "\n\n";
                    		}
                		} else {
                    		if (thematic_use_excerpt()) {
                        		$content ="\t";
                        		$content .= "<meta name=\"description\" content=\"";
                        		$content .= thematic_the_excerpt();
                        		$content .= "\" />";
                        		$content .= "\n\n";
                    		}
                		}
            		}
        		}
    		} elseif ( is_home() || is_front_page() ) {
        		$content ="\t";
        		$content .= "<meta name=\"description\" content=\"";
        		$content .= get_bloginfo('description');
        		$content .= "\" />";
        		$content .= "\n\n";
    		}
    		echo apply_filters ('thematic_create_description', $content);
		}
} // end thematic_create_description


/**
 * meta-tag description is switchable using a filter
 */
function thematic_show_description() {
	$display = TRUE;
	$display = apply_filters('thematic_show_description', $display);
	if ($display) {
		thematic_create_description();
	}
} // end thematic_show_description


/**
 * create meta-tag robots
 */
function thematic_create_robots() {
	global $paged;
	if (thematic_seo()) {
		$content = "<!-- meta robots -->\n";
		if((is_home() && ($paged < 2 )) || is_front_page() || is_single() || is_page() || is_attachment()) {
			$content .= "<meta name=\"robots\" content=\"index,follow\">";
		} elseif (is_search()) {
			$content .= "<meta name=\"robots\" content=\"noindex,nofollow\">";
		} else {	
			$content .= "<meta name=\"robots\" content=\"noindex,follow\">";
		}
		$content .= "\n";
		if (get_option('blog_public')) {
			echo apply_filters('thematic_create_robots', $content);
		}
	}
} // end thematic_create_robots


/**
 * meta-tag robots is switchable using a filter
 */
function thematic_show_robots() {
	$display = TRUE;
	$display = apply_filters('thematic_show_robots', $display);
	if ($display) {
		thematic_create_robots();
	}
} // end thematic_show_robots


// Located in header.php
/**
 * creates link to style.css
 */
	function thematic_create_stylesheet() {
		global $my_shortname;
		$hhUrl = stripslashes(get_option($my_shortname . '_hh_style_url'));
		$mainUrl = stripslashes(get_option($my_shortname . '_main_style_url'));
		$hh = stripslashes(get_option($my_shortname . '_handheld'));
		$minify = stripslashes(get_option($my_shortname . '_minify'));
		
		
		$content .= "<!-- style links ".(($minify == 'css' || $minify == 'css and js') ? 'minifed ' : 'non minifed ')."-->\n";
		if(($minify == 'css' || $minify == 'css and js') && function_exists('w3tc_styles'))	{
			$w3_plugin_minify = & W3_Plugin_Minify::instance();
			$w3_plugin_minify->printed_styles[] = $location;
			
			$content .= $w3_plugin_minify->get_styles($location, $group);
			if($hh == 'true') {
				$content .= "\n<link rel=\"stylesheet\" media=\"handheld\" type=\"text/css\" href=\"";
				$content .= (!empty($hhUrl)) ? $hhUrl : get_stylesheet_directory_uri() . "/library/css/handheld.css";
				$content .= "\">\n";
			}
		} elseif(($minify == 'css' || $minify == 'cssjs') && function_exists('wp_minify')) {
		} else {
			$content .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"";
			$content .= (!empty($mainUrl)) ? $mainUrl : get_bloginfo('stylesheet_url');
			$content .= "\">\n";
			if($hh == 'true') {
				$content .= "<link rel=\"stylesheet\" media=\"handheld\" type=\"text/css\" href=\"";
				$content .= (!empty($hhUrl)) ? $hhUrl : get_stylesheet_directory_uri() . "/library/css/handheld.css";
				$content .= "\">\n";
			}
		}
		$content .= "\n";
		echo apply_filters('thematic_create_stylesheet', $content);
	}


/**
 * rss usage is switchable using a filter
 */
function thematic_show_rss() {
    $display = TRUE;
    $display = apply_filters('thematic_show_rss', $display);
    if ($display) {
        $content = "\t";
        $content .= "<link rel=\"alternate\" type=\"application/rss+xml\" href=\"";
        $content .= get_bloginfo('rss2_url');
        $content .= "\" title=\"";
        $content .= esc_html(get_bloginfo('name'));
        $content .= " " . __('Posts RSS feed', 'thematic');
        $content .= "\" />";
        $content .= "\n";
        echo apply_filters('thematic_rss', $content);
    }
} // end thematic_show_rss


/**
 * comments rss usage is switchable using a filter
 */
function thematic_show_commentsrss() {
    $display = TRUE;
    $display = apply_filters('thematic_show_commentsrss', $display);
    if ($display) {
        $content = "\t";
        $content .= "<link rel=\"alternate\" type=\"application/rss+xml\" href=\"";
        $content .= get_bloginfo('comments_rss2_url');
        $content .= "\" title=\"";
        $content .= esc_html(get_bloginfo('name'));
        $content .= " " . __('Comments RSS feed', 'thematic');
        $content .= "\" />";
        $content .= "\n\n";
        echo apply_filters('thematic_commentsrss', $content);
    }
} // end thematic_show_commentsrss


/**
 * search allows 
 */
function thematic_rel_search() {
// 
	$display = TRUE;
	$display = apply_filters('thematic_rel_search', $display);
	if ($display) {
		$content .= "<link rel=\"search\" title=\"";
		$content .= "\" href=\"";
		$content .= get_stylesheet_directory_uri();
		$content .= "/ox.xml\">";
		$content .= "\n";
		echo $content;
	}
} // end thematic_show_pingback


/**
 * pingback usage is switchable using a filter
 */
function thematic_show_pingback() {
    $display = TRUE;
    $display = apply_filters('thematic_show_pingback', $display);
    if ($display) {
        $content = "\t";
        $content .= "<link rel=\"pingback\" href=\"";
        $content .= get_bloginfo('pingback_url');
        $content .= "\" />";
        $content .= "\n\n";
        echo apply_filters('thematic_pingback_url',$content);
    }
} // end thematic_show_pingback


// comment reply usage is switchable using a filter
function thematic_show_commentreply() {
    $display = TRUE;
    $display = apply_filters('thematic_show_commentreply', $display);
    if ($display)
        if ( is_singular() ) 
            wp_enqueue_script( 'comment-reply', '', array(), false, true); // support for comment threading
} // end thematic_show_commentreply

/**
 * output modernizr to head of doc
 */
if (function_exists('childtheme_thematic_head_modernizr'))  {
    function thematic_head_modernizr() {
    	childtheme_thematic_head_modernizr();
    }
} else {
	function thematic_head_modernizr() {
	global $my_shortname;	
	$modernizr = stripslashes(get_option($my_shortname . '_modernizr_build'));
		$parentTheme = THEMELIB . '/..';
		// option to use group for modernizer though its a single file it may be easier to styleup
		echo "\n<script src=\"".get_stylesheet_directory_uri()."/library/js/libs/$modernizr\"></script>\n";	} // end thematic_create_modernizr

	if (apply_filters('thematic_head_modernizr', TRUE)) {
		add_action('wp_head','thematic_head_modernizr', 90);
	}
}

// Load scripts for the jquery Superfish plugin http://users.tpg.com.au/j_birch/plugins/superfish/#examples
if(stripslashes(get_option($my_shortname . '_override_head_scripts')) == 'true' && !function_exists('childtheme_override_head_scripts')) {
    function childtheme_override_head_scripts() {}
} elseif (function_exists('childtheme_override_head_scripts'))  {
    function thematic_head_scripts() {
    	childtheme_override_head_scripts();
    }
} else {
    function thematic_head_scripts() {
	    $scriptdir_start = "\t";
	    $scriptdir_start .= '<script type="text/javascript" src="';
	    $scriptdir_start .= get_bloginfo('template_directory');
	    $scriptdir_start .= '/library/js/';
	    
	    $scriptdir_end = '"></script>';
	    
	    $scripts = "\n";
	    $scripts .= $scriptdir_start . 'hoverIntent.js' . $scriptdir_end . "\n";
	    $scripts .= $scriptdir_start . 'superfish.js' . $scriptdir_end . "\n";
	    $scripts .= $scriptdir_start . 'supersubs.js' . $scriptdir_end . "\n";
	    $dropdown_options = $scriptdir_start . 'thematic-dropdowns.js' . $scriptdir_end . "\n";
	    
	    $scripts = $scripts . apply_filters('thematic_dropdown_options', $dropdown_options);
	
	    	$scripts .= "\n";
	    	$scripts .= "\t";
	    	$scripts .= '<script type="text/javascript">' . "\n";
	    	$scripts .= "\t\t" . '/*<![CDATA[*/' . "\n";
	    	$scripts .= "\t\t" . 'jQuery.noConflict();' . "\n";
	    	$scripts .= "\t\t" . '/*]]>*/' . "\n";
	    	$scripts .= "\t";
	    	$scripts .= '</script>' . "\n";
	
	    // Print filtered scripts
	    print apply_filters('thematic_head_scripts', $scripts);
	}

	if (apply_filters('thematic_use_superfish', TRUE)) {
		add_action('wp_head','thematic_head_scripts');
	}
}

// Create the default arguments for wp_page_menu()
function thematic_page_menu_args() {
	$args = array (
		'sort_column' => 'menu_order',
		'menu_class'  => 'menu',
		'include'     => '',
		'exclude'     => '',
		'echo'        => FALSE,
		'show_home'   => FALSE,
		'link_before' => '',
		'link_after'  => ''
	);
	return $args;
}
add_filter('wp_page_menu_args','thematic_page_menu_args');


// Create the default arguments for wp_page_menu()
function thematic_nav_menu_args() {
	$args = array (
		'theme_location'	=> apply_filters('thematic_primary_menu_id', 'primary-menu'),
		'menu'				=> '',
		'container'			=> 'div',
		'container_class'	=> 'menu',
		'menu_class'		=> 'sf-menu',
		'fallback_cb'		=> 'wp_page_menu',
		'before'			=> '',
		'after'				=> '',
		'link_before'		=> '',
		'link_after'		=> '',
		'depth'				=> 0,
		'walker'			=> '',
		'echo'				=> false
	);
	
	return apply_filters('thematic_nav_menu_args', $args);
}

if (function_exists('childtheme_override_init_navmenu'))  {
    function thematic_init_navmenu() {
    	childtheme_override_init_navmenu();
    }
} else {
    function thematic_init_navmenu() {
    	if (function_exists( 'register_nav_menu' )) {
    		register_nav_menu( apply_filters('thematic_primary_menu_id', 'primary-menu'), apply_filters('thematic_primary_menu_name', __( 'Primary Menu', 'thematic' ) ) );
		}
	}
}
add_action('init', 'thematic_init_navmenu');

// Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu
function thematic_add_menuclass($ulclass) {
	if (apply_filters('thematic_use_superfish', TRUE)) {
		return preg_replace('/<ul>/', '<ul class="sf-menu">', $ulclass, 1);
	} else {
		return $ulclass;
	}
} // end thematic_add_menuclass

// Just after the opening body tag, before anything else.
function thematic_before() {
    do_action('thematic_before');
} // end thematic_before


// Just before the header 
function thematic_aboveheader() {
    do_action('thematic_aboveheader');
} // end thematic_aboveheader


// Used to hook in the HTML and PHP that creates the content of div id="header">
function thematic_header() {
    do_action('thematic_header');
} // end thematic_header


// Functions that hook into thematic_header()

// Open #branding
// In the header div
function thematic_brandingopen() { ?>
<?php }
add_action('thematic_header','thematic_brandingopen',1);

function thematic_hgroup() {
	global $my_shortname;
	$title = stripslashes(get_option($my_shortname . '_rmtitle'));
	$desc = stripslashes(get_option($my_shortname . '_rmdesc'));
	if($title == 'false' && $desc == 'false') { ?>
	<hgroup>
	<?php
		thematic_blogtitle();
		thematic_blogdescription();
	?>
	</hgroup>
	<?php } else {
		if(empty($title) || $title !== 'true') {
			thematic_blogtitle();
		}
		if(empty($desc) || $desc !== 'true') {
			thematic_blogdescription();
		}
	}
}
add_action('thematic_header','thematic_hgroup',2);

// Create the blog title
// In the header div
function thematic_blogtitle() { ?>
	<h1 id="blog-title"><a href="<?php bloginfo('url') ?>/" title="<?php bloginfo('name') ?>" rel="home"><?php bloginfo('name') ?></a></h1>
<?php }

// Create the blog description
// In the header div
function thematic_blogdescription() {	?>
	<h2 id="blog-description"><?php bloginfo('description'); ?></h2>
	<?php
} // 

// Close #branding
function thematic_brandingclose() {
}
add_action('thematic_header','thematic_brandingclose',7);

// Create #access
// In the header
function thematic_access() {  
	global $my_shortname;
	$searchasli = stripslashes(get_option($my_shortname . '_searchasli'));
	// remove the fugly div; this has gone f00king bananas; it is supposed to add search to navigation li item. once upon at time it did work but has gone nuts
	// have a way to add search to access as li (todo)

	$findPatterns = array();
	$replacePatterns = array();

	$findPatterns[] =   '#^\<(div)([^>]*)\>#';
	$findPatterns[] =   '#\<([/]*)(div)\>$#';
	$replacePatterns[] = '';
	$replacePatterns[] = ''; 

	if($searchasli == 'true') {
		$findPatterns[] = '#(\<\/ul\>$)#';
		$replacePatterns[] = '<li class="search">'.thematic_search_form(false).'</li></ul>';
	}

	$access = preg_replace(
		$findPatterns,
		$replacePatterns, trim(wp_nav_menu( array('primary-menu', 'container_class' => '', 'menu_class' => '', 'echo' => false) )), 1
	);
	?>
	<nav id="access" role="navigation">
		<a href="#content" class="skip-link" title="<?php _e('Skip navigation to the content', 'thematic'); ?>"><?php _e('Skip to content', 'thematic'); ?></a> 
		<?php
			if(function_exists('wpmp_switcher_link')) {
				echo str_replace('<a ', '<a class="switch-mobile"', wpmp_switcher_link('mobile', 'mobile'));
			}
			echo $access;
		?>
	</nav><!-- #access -->
<?php }
add_action('thematic_header','thematic_access',9);
		

// End of functions that hook into thematic_header()

		
// Just after the header div
function thematic_belowheader() {
	do_action('thematic_belowheader');
} // end thematic_belowheader

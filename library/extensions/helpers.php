<?php

function themeatic_script_setup($isHead = true)	{
	global $my_shortname;
	$jsfoot = stripslashes(get_option($my_shortname . '_jsfoot'));
	$swfobject = stripslashes(get_option($my_shortname . '_swfobject'));
	$google_hosted_apis = stripslashes(get_option($my_shortname . '_gdn'));
	$jqversion = stripslashes(get_option($my_shortname . '_jquery_version'));
	$js_plugins = stripslashes(get_option($my_shortname . '_js_plugins'));
	$js_dropdowns = stripslashes(get_option($my_shortname . '_js_dropdowns'));
	$dqjquery = stripslashes(get_option($my_shortname . '_js_dqjquery'));
	$jquery = '1.5.0'; // so this could easily (?? or not so easily work with non jquery stuff in place of jquery not  addition too) those last two would require other things 

	if(($isHead && (empty($jsfoot) && $jsfoot !== 'true')) || ($jsfoot == 'true' && !$isHead))	{
		if(empty($google_hosted_apis) || $google_hosted_apis == 'true')	{
			$scripts .= thematic_h5bp_cdnalt('jquery', $jqversion);
		}
		$scripts .= apply_filters('thematic_dropdown_options', $dropdown_options);
	}

	/*switch()	{
		case :
			echo '';
		break; 
	
	} */
	return $scripts;
}

function thematic_h5bp_script($file, $defer = false) {
	$return = "";
	$defer ($defer) ? ' defer="true"' : '';
	$return.= "\n<script src=\"$file\"$defer></script>";
	return $return;
}

function thematic_h5bp_cdnalt($file, $version) {
	$return = "";
	$return.= "\n<script src=\"//ajax.googleapis.com/ajax/libs/$file/$version/$file.min.js\"></script>";
	$return.= "\n<script>!window.jQuery && document.write(unescape('%3Cscript src=\"" . get_stylesheet_directory_uri() . "/library/js/$file-$version.min.js\"%3E%3C/script%3E'))</script>";
	return $return;
}



// create bullet-proof excerpt for meta name="description"

function thematic_trim_excerpt($text) {
	if ( '' == $text ) {
		$text = get_the_content('');

		$text = strip_shortcodes( $text );

		$text = str_replace(']]>', ']]&gt;', $text);
		$text = strip_tags($text);
	  $text = str_replace('"', '\'', $text);
		$excerpt_length = apply_filters('excerpt_length', 55);
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words) > $excerpt_length) {
			array_pop($words);
			array_push($words, '[...]');
			$text = implode(' ', $words);
		}
	}
	return $text;
}

function thematic_the_excerpt($deprecated = '') {
	global $post;
	$output = '';
	$output = strip_tags($post->post_excerpt);
	$output = str_replace('"', '\'', $output);
	if ( post_password_required($post) ) {
		$output = __('There is no excerpt because this is a protected post.');
		return $output;
	}

	return $output;
	
}

function thematic_excerpt_rss() {
	global $post;
	$output = '';
	$output = strip_tags($post->post_excerpt);
	if ( post_password_required($post) ) {
		$output = __('There is no excerpt because this is a protected post.');
		return $output;
}

	return apply_filters('thematic_excerpt_rss', $output);

}

add_filter('thematic_excerpt_rss', 'thematic_trim_excerpt');

// create nice multi_tag_title
// Credits: Martin Kopischke for providing this code

function thematic_tag_query() {
	$nice_tag_query = get_query_var('tag'); // tags in current query
	$nice_tag_query = str_replace(' ', '+', $nice_tag_query); // get_query_var returns ' ' for AND, replace by +
	$tag_slugs = preg_split('%[,+]%', $nice_tag_query, -1, PREG_SPLIT_NO_EMPTY); // create array of tag slugs
	$tag_ops = preg_split('%[^,+]*%', $nice_tag_query, -1, PREG_SPLIT_NO_EMPTY); // create array of operators

	$tag_ops_counter = 0;
	$nice_tag_query = '';

	foreach ($tag_slugs as $tag_slug) { 
		$tag = get_term_by('slug', $tag_slug ,'post_tag');
		// prettify tag operator, if any
		if ($tag_ops[$tag_ops_counter] == ',') {
			$tag_ops[$tag_ops_counter] = ', ';
		} elseif ($tag_ops[$tag_ops_counter] == '+') {
			$tag_ops[$tag_ops_counter] = ' + ';
		}
		// concatenate display name and prettified operators
		$nice_tag_query = $nice_tag_query.$tag->name.$tag_ops[$tag_ops_counter];
		$tag_ops_counter += 1;
	}
	 return $nice_tag_query;
}

function thematic_get_term_name() {
	// Credits: Justin Tadlock Theme Hybrid
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
	return $term->name;
}

function thematic_is_custom_post_type() {
	global $post; 
	if ($post->post_type !== "post") {
		if ($post->post_type !== "page") {
			return true;
		}
	}
	return false;
}


function thematic_ifieblock() {
	global $my_shortname;
		$pngfix = stripslashes(get_option($my_shortname . '_dd_pngfix'));
		$selectivizr = stripslashes(get_option($my_shortname . '_selectivizr'));
	
?>
 
<!-- BEGIN thematic_ifieblock -->
<?php if(!empty($selectivizr) && $selectivizr == 'true'):?>
<!--[if lt IE 8 ]>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/selectivizr.js"></script>
<![endif]-->
<?php endif; if(!empty($pngfix) && $pngfix == 'true'): ?>
<!--[if lt IE 7 ]>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/dd_belatedpng.js"></script>
	<script>
	DD_belatedPNG.fix('img, .png_bg');
	</script>
<![endif]-->
<?php endif; ?>
<!-- END thematic_ifieblock -->

<?php
}

function thematic_googleanalytics() {
	global $my_shortname;
		$ga = stripslashes(get_option($my_shortname . '_googleanalytics'));
		if($ga == 'YOAST') {
		// yoast ga needs to be in the header
			yoast_analytics(); 
			return;
		}
		if(!$ga || $ga == 'false') {
			return;
		}
	?>

		<!-- BEGIN thematic_googleanalytics -->
		<script>
			var _gaq = [['_setAccount', '<?php echo $ga; ?>'], ['_trackPageview']];
			(function(d, t) {
			var g = d.createElement(t),
			    s = d.getElementsByTagName(t)[0];
			g.async = true;
			g.src = '//www.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g, s);
			})(document, 'script');
		</script>
		<!-- END thematic_googleanalytics -->

<?php
}

function thematic_yahooprofiler() {
	global $my_shortname;
	$yp = stripslashes(get_option($my_shortname . '_yahooprofile'));
	//echo "<!-- yahoo profiling ? {$yp} -->"; return;
	if(!$yp || $yp == 'false') {
		return;
	}
	?>

		<!-- BEGIN thematic_yahooprofiler - move to scripts/ => js/ -->
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/profiling/yahoo-profiling.min.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/profiling/config.js"></script>
		<!-- END thematic_yahooprofiler -->

<?php
}



function thematic_head_final_filter() {
//(\ type="text/css")
	// remove all text/css
//(\ type="text/javascript")
	// remove all text/javascripts
}

function thematic_foot_final_filter() {

	// remove all text/javascripts
	// move the total cache or minify marker to footer
	// move the mobile link to header if option is set

//(\ type="text/css")
//(\ type="text/javascript")
}
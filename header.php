<?php


	//if (ob_get_level() == 0) ob_start(); 

/**
 * @package WordPress
 * @subpackage Thematic post.php
 */
	thematic_create_doctype();

	// Creating the head profile
	thematic_head_profile();
	
	// TODO change function name this one is crappy 
	thematic_show_meta();

	// Creating the doc title
	thematic_doctitle();
	
	// Creating the description
	thematic_show_description();
	
	// Creating the robots tags
	thematic_show_robots();
	
	// Loading the stylesheet
	thematic_create_stylesheet();

	if (THEMATIC_COMPATIBLE_FEEDLINKS) {    
    	// Creating the internal RSS links
    	thematic_show_rss();
    
    	// Creating the comments RSS links
    	thematic_show_commentsrss();
   	}

	// Creating the pingback adress
	thematic_show_pingback();

	// Enables comment threading
	thematic_show_commentreply();

	// Calling WordPress' header action hook
	wp_head();
?>

</head>

<?php 
	//ob_get_flush();	flush();
	// Creating the body class

thematic_body();

// action hook for placing content before opening #wrapper
thematic_before(); 

if (apply_filters('thematic_open_wrapper', true)) {
	//echo '<div id="wrapper" class="hfeed">';
}
    
    // action hook for placing content above the theme header
    thematic_aboveheader();
	?>
		<header id="header" role="banner" class="head clearfix">
			<?php
				// action hook creating the theme header
				thematic_header(); 
			?>
		</header><!-- #header -->

		<?php
	// currently this is a complete mess to me and may be rethought. figure though appeals to me here but this setup is borky should be in a function but seemed to bork then
	if ( is_singular() &&
	has_post_thumbnail( $post->ID ) &&
	( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
	$image[1] >= HEADER_IMAGE_WIDTH && !is_page('gallery')) :
	// Houston, we have a new header image!
	echo '<figure>', get_the_post_thumbnail( $post->ID, 'post-thumbnail' ), '</figure>';
	elseif(!is_page('gallery')) : ?>
	<figure><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" /></figure>
	<?php endif;
		// action hook for placing content below the theme header  
		thematic_belowheader();
	?>

	<section id="content" class="content clearfix">
<?php
/**
 * @package WordPress
 * @subpackage Thematic PFT
 */
	thematic_create_doctype();

	// Creating the head profile
	thematic_head_profile();
	
	// TODO change function name this one is crappy 
	thematic_create_initialhead();

	// Creating the doc title
	thematic_doctitle();
	
	// Creating the description
	thematic_show_description();
	
	// Creating the robots tags
	thematic_show_robots();
	
	// Loading the stylesheet
	thematic_create_stylesheet();

	// Creating the internal RSS links
	thematic_show_rss();

	// Creating the comments RSS links
	thematic_show_commentsrss();

	// Creating the pingback adress
	thematic_show_pingback();

	// Enables comment threading
	thematic_show_commentreply();

	// Calling WordPress' header action hook
	wp_head();

	// Modernizer
	thematic_create_modernizr();
?>
<!-- WP-Minify CSS -->

</head>

<?php

if (apply_filters('thematic_show_bodyclass',TRUE)) { 
	// Creating the body class
	?>

<body class="<?php echo thematic_body_class(); ?>">
	<?php }

	// action hook for placing content before it all begins - later will be able to open a wrapper
	thematic_before();

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

	<section id="main" class="body content clearfix">
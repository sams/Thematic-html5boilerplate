<?php
/**
 * @package WordPress
 * @subpackage Thematic PFT
 */
	thematic_create_doctype();

	// Creating the head profile
	thematic_head_profile();

	thematic_create_contenttype();

	// Creating the doc title
	thematic_doctitle();
	
	// Creating the description
	thematic_show_description();
	
	// Creating the robots tags
	thematic_show_robots();
	
	// Creating the canonical URL
	thematic_canonical_url();
	
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

	thematic_create_modernizr();

	// Calling WordPress' header action hook
	wp_head();
?>
<!-- WP-Minify CSS -->

</head>

<?php 

if (apply_filters('thematic_show_bodyclass',TRUE)) { 
	// Creating the body class
	?>

<body class="<?php echo thematic_body_class(); ?>">
	
<?php }

// action hook for placing content before opening #wrapper
thematic_before(); ?>
<div id="page" class="hfeed container"><?php

	// action hook for placing content above the theme header
	thematic_aboveheader(); 
	// think I wish to remove these additional div wrappers and they can be placed using the theme callbacks
	?>
	<div id="masthead" class="head clearfix">
		<header id="branding" role="banner">
			<hgroup> 
		<?php 
		
		// action hook creating the theme header
		thematic_header();
		
		?>
			</hgroup>
			<?php
				// Check if this is a post or page, if it has a thumbnail, and if it's a big one
				if ( is_singular() &&
						has_post_thumbnail( $post->ID ) &&
						( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
						$image[1] >= HEADER_IMAGE_WIDTH ) :
					// Houston, we have a new header image!
					echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
				else : ?>
					<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
				<?php endif; ?>
		</header><!-- #branding -->
		<nav id="access">
			<h1 class="screen-reader-text"><?php _e( 'Main menu', 'themename' ); ?></h1>
			<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'themename' ); ?>"><?php _e( 'Skip to content', 'themename' ); ?></a></div>
	
			<?php //wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #access -->
	</div><!-- #masthead -->

	<?php 
	// action hook for placing content below the theme header  
	thematic_belowheader();

		?>

	<div id="main" class="body">
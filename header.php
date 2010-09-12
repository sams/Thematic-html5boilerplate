<?php
/**
 * @package WordPress
 * @subpackage Thematic PFT
 */
	thematic_create_doctype();

	// Creating the head profile
	thematic_head_profile();
	
	// 
	thematic_create_initialhead();

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
		// action hook for placing content below the theme header  
		thematic_belowheader();
		?>

	<section id="main" class="body content clearfix">
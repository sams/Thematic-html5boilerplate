<?php
/**
 * @package WordPress
 * @subpackage Html5Boilerplate
 */

/**
 * Make theme available for translation     - Setup child themes
 * Translations can be filed in the /languages/ directory
 */
// Credits: S Sherlock (merged ideas from thematic and twenty 10 + addded html5 boilerplate)
// Credits: Joern Kretzschmar
// Credits: Twenty 10 Wordpress Original Theme

$themeData = get_theme_data(TEMPLATEPATH . '/style.css');
$version = trim($themeData['Version']);

if(!$version)	{
	$version = "unknown";
}

$ct=get_theme_data(STYLESHEETPATH . '/style.css');
$templateversion = trim($ct['Version']);

if(!$templateversion)	{
	$templateversion = "unknown";
}

// set theme constants
define('THEMENAME', $themeData['Title']);
define('THEMEAUTHOR', $themeData['Author']);
define('THEMEURI', $themeData['URI']);
define('THEMATICVERSION', $version);

// move this to options
define('JSFOOT', true);

// set child theme constants
define('TEMPLATENAME', $ct['Title']);
define('TEMPLATEAUTHOR', $ct['Author']);
define('TEMPLATEURI', $ct['URI']);
define('TEMPLATEVERSION', $templateversion);


/** remove this*/
function thematic_scripts() {
}

// load jQuery
if(!is_admin())	{
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', array(), false, true);
}

// Path constants
define('THEMELIB', TEMPLATEPATH . '/library');

// Create Theme Options Page
require_once(THEMELIB . '/extensions/theme-options.php');

// Load legacy functions
require_once(THEMELIB . '/legacy/deprecated.php');

// Load widgets
require_once(THEMELIB . '/extensions/widgets.php');

// Load custom header extensions
require_once(THEMELIB . '/extensions/header-extensions.php');

// Load custom content filters
require_once(THEMELIB . '/extensions/content-extensions.php');

// Load custom Comments filters
require_once(THEMELIB . '/extensions/comments-extensions.php');

// Load custom Widgets
require_once(THEMELIB . '/extensions/widgets-extensions.php');

// Load the Comments Template functions and callbacks
require_once(THEMELIB . '/extensions/discussion.php');

// Load custom sidebar hooks
require_once(THEMELIB . '/extensions/sidebar-extensions.php');

// Load custom footer hooks
require_once(THEMELIB . '/extensions/footer-extensions.php');

// Add Dynamic Contextual Semantic Classes
require_once(THEMELIB . '/extensions/dynamic-classes.php');

// Need a little help from our helper functions
require_once(THEMELIB . '/extensions/helpers.php');

// Load shortcodes
require_once(THEMELIB . '/extensions/shortcodes.php');

add_theme_support( 'post-thumbnails', array( 'post') ); // Add it for posts

add_filter( 'pre_get_posts', 'home_content' );

function home_content( $query )	{
	if ( is_home() && false == $query->query_vars['suppress_filters'] )
		$query->set( 'post_type', array( 'home', 'attachment' ) );

	return $query;
}

// Adds filters for the description/meta content in archives.php
add_filter( 'archive_meta', 'wptexturize' );
add_filter( 'archive_meta', 'convert_smilies' );
add_filter( 'archive_meta', 'convert_chars' );
add_filter( 'archive_meta', 'wpautop' );

// Remove the WordPress Generator – via http://blog.ftwr.co.uk/archives/2007/10/06/improving-the-wordpress-generator/
function thematic_remove_generators()	{ return ''; }

if (apply_filters('thematic_hide_generators', TRUE)) {  
	add_filter('the_generator','thematic_remove_generators');
}

// Translate, if applicable
load_theme_textdomain('thematic', THEMELIB . '/languages');

$locale = get_locale();
$locale_file = THEMELIB . "/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);

/**
 * Enable / Disable profiling.
 */
if ( ! isset( $profiling ) ) { 
	$profiling = false;
}

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'thematic_h5bp_setup' );

if ( ! function_exists( 'thematic_h5bp_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override thematic_h5bp_setup() in a child theme, add your own thematic_h5bp_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 */
function thematic_h5bp_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'thematic_h5bp', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'oxox' => __( 'Primary Navigation', 'thematic_h5bp' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to thematic_h5bp_header_image_width and thematic_h5bp_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'thematic_h5bp_header_image_width', 940 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'thematic_h5bp_header_image_height', 198 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See thematic_h5bp_admin_header_style(), below.
	add_custom_image_header( '', 'thematic_h5bp_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'path' => array(
			'url' => '%s/images/headers/path.jpg',
			'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Path', 'thematic_h5bp' )
		),
		'h5bp' => array(
			'url' => '%s/images/headers/h5bp.jpg',
			'thumbnail_url' => '%s/images/headers/h5bp-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Html5 Boilerplate', 'thematic_h5bp' )
		)
	) );
}
endif;

if ( ! function_exists( 'thematic_h5bp_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in thematic_h5bp_setup().
 *
 * @since Twenty Ten 1.0
 */
function thematic_h5bp_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function thematic_h5bp_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'thematic_h5bp_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function thematic_h5bp_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'thematic_h5bp_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function thematic_h5bp_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'thematic_h5bp' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and thematic_h5bp_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function thematic_h5bp_auto_excerpt_more( $more ) {
	return ' &hellip;' . thematic_h5bp_continue_reading_link();
}
add_filter( 'excerpt_more', 'thematic_h5bp_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function thematic_h5bp_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= thematic_h5bp_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'thematic_h5bp_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function thematic_h5bp_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'thematic_h5bp_remove_gallery_css' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) { 
	$content_width = 640;
}
/**
 * This theme uses wp_nav_menu() in one location.
 */
register_nav_menus( array(
	'oxox' => __( 'Primary Menu', 'themename' ),
	'aside' => __( 'Aside Menu', 'themename' )
) );

/**
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function toolbox_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;
		
	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'thematic_h5bp' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'thematic_h5bp' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'thematic_h5bp' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'toolbox_filter_wp_title', 10, 2 );


// Set constant for current theme directory

$dirname = get_stylesheet_directory();

define('CHILDTHEME_THEME_DIRECTORY', $dirname . '/');

// You can mess with these if you wish.
$my_themename = get_current_theme();
$my_shortname = 'childtheme';

// Get theme panel
require_once(CHILDTHEME_THEME_DIRECTORY . 'functions/admin-panel.php');

// Get panel options
require_once(CHILDTHEME_THEME_DIRECTORY . 'functions/admin-panel-options.php');

// Functions related to admin panel
require_once(CHILDTHEME_THEME_DIRECTORY . 'functions/admin-panel-functions.php');

// Ajax Functions
require_once(CHILDTHEME_THEME_DIRECTORY . 'functions/admin-panel-ajax.php');

// Custom theme functions
require_once(CHILDTHEME_THEME_DIRECTORY . 'functions/theme-functions.php');

add_action('admin_notices', 'childtheme_timthumb_nag');

function childtheme_timthumb_nag(){
	if (! is_writable( CHILDTHEME_THEME_DIRECTORY . 'scripts/tmp/'  ) || ! is_writable( CHILDTHEME_THEME_DIRECTORY . 'scripts/cache/' ) ):

		global $my_themename;
		echo '<div class="error"><p>';
		printf( __('Notice: In order for %1$s to function properly, both %2$s and %3$s must be writable by the webserver ' ), $my_themename, CHILDTHEME_THEME_DIRECTORY . 'scripts/tmp/', CHILDTHEME_THEME_DIRECTORY . 'scripts/tmp/' ) ;
		echo '</p></div>';

	endif;
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function toolbox_page_menu_args($args) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'toolbox_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function toolbox_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'thematic_h5bp' ),
		'id' => 'primary-menu',
		'description' => __( 'The primary menu in header (not wrapped in div)', 'thematic_h5bp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'thematic_h5bp' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'thematic_h5bp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'thematic_h5bp' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'thematic_h5bp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'thematic_h5bp' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'thematic_h5bp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'thematic_h5bp' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'thematic_h5bp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'thematic_h5bp' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'thematic_h5bp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'thematic_h5bp' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'thematic_h5bp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

add_action( 'init', 'toolbox_widgets_init' );

/*
 * This example will work at least on WordPress 2.6.3, 
 * but maybe on older versions too.
 */

/* 

add_action('admin_init', 'my_plugin_admin_init');
add_action('admin_menu', 'my_plugin_admin_menu');
 
function my_plugin_admin_init()
{
	/* Register our script. * /
	wp_register_script('myPluginScript', WP_PLUGIN_URL . '/myPlugin/script.js');
}function my_plugin_admin_menu()
{
	/* Register our plugin page * /
	$page = add_submenu_page( 'edit.php', 
							  __('My Plugin', 'myPlugin'), 
							  __('My Plugin', 'myPlugin'), 9,  __FILE__, 
							  'my_plugin_manage_menu');

	/* Using registered $page handle to hook script load * /
	add_action('admin_print_scripts-' . $page, 'my_plugin_admin_styles');
}

function my_plugin_admin_styles()
{
	/*
	 * It will be called only on your plugin admin page, enqueue our script here
	 * /
	wp_enqueue_script('myPluginScript');
}

function my_plugin_manage_menu()
{
	/* Output our admin page * /
} */
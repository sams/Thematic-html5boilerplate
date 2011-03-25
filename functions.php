<?php
/**
 * @package WordPress
 * @subpackage Html5Boilerplate
 */
// Credits: S Sherlock (merged ideas from thematic and twenty 10 + addded html5 boilerplate)


/**
 * Make theme available for translation     - Setup child themes
 * Translations can be filed in the /languages/ directory
 */// Credits: Joern Kretzschmar
// Credits: Twenty 10 Wordpress Original Theme

$themeData = get_theme_data(TEMPLATEPATH . '/style.css');
$version = trim($themeData['Version']);

if(!$version)    {
    $version = "unknown";
}

$ct=get_theme_data(STYLESHEETPATH . '/style.css');
$templateversion = trim($ct['Version']);

if(!$templateversion)    {
    $templateversion = "unknown";
}

if(!defined('DEVICE')) {
    define('DEVICE', 'desktop');
}

// set theme constants
define('THEMENAME', $themeData['Title']);
define('THEMEAUTHOR', $themeData['Author']);
define('THEMEURI', $themeData['URI']);
define('THEMATICVERSION', $version);


// set feed links handling
// If you set this to TRUE, thematic_show_rss() and thematic_show_commentsrss() are used instead of add_theme_support( 'automatic-feed-links' )
if (!defined('THEMATIC_COMPATIBLE_FEEDLINKS')) {
    if (function_exists('comment_form')) {
        define('THEMATIC_COMPATIBLE_FEEDLINKS', false); // WordPress 3.0
    } else {
        define('THEMATIC_COMPATIBLE_FEEDLINKS', true); // below WordPress 3.0
    }
}    
    define('THEMATIC_COMPATIBLE_COMMENT_HANDLING', false);

// set comments handling for pages, archives and links
// If you set this to TRUE, comments only show up on pages with a key/value of "comments"
if (!defined('THEMATIC_COMPATIBLE_COMMENT_HANDLING')) {
    define('THEMATIC_COMPATIBLE_COMMENT_HANDLING', false);
}

// set comments handling for pages, archives and links
// If you set this to TRUE, comments only show up on pages with a key/value of "comments"
if (!defined('THEMATIC_BROWSER_BODY_CLASS')) {
    define('THEMATIC_BROWSER_BODY_CLASS', false);
}

// set body class handling to WP body_class()
// If you set this to TRUE, Thematic will use thematic_body_class instead
if (!defined('THEMATIC_COMPATIBLE_BODY_CLASS')) {
    define('THEMATIC_COMPATIBLE_BODY_CLASS', false);
}

// set post class handling to WP post_class()
// If you set this to TRUE, Thematic will use thematic_post_class instead
if (!defined('THEMATIC_COMPATIBLE_POST_CLASS')) {
    define('THEMATIC_COMPATIBLE_POST_CLASS', false);
}
// which comment form should be used
if (!defined('THEMATIC_COMPATIBLE_COMMENT_FORM')) {
    if (function_exists('comment_form')) {
        define('THEMATIC_COMPATIBLE_COMMENT_FORM', false); // WordPress 3.0
    } else {
        define('THEMATIC_COMPATIBLE_COMMENT_FORM', true); // below WordPress 3.0
    }
}

// Check for WordPress mu or WordPress 3.0
define('THEMATIC_MB', function_exists('get_blog_option'));

// Create the feedlinks
if (!(THEMATIC_COMPATIBLE_FEEDLINKS)) {
    add_theme_support( 'automatic-feed-links' );
}

// Check for WordPress 2.9 add_theme_support()
if ( apply_filters( 'thematic_post_thumbs', TRUE) ) {
    if ( function_exists( 'add_theme_support' ) )
    add_theme_support( 'post-thumbnails' );
}

// set child theme constants
define('TEMPLATENAME', $ct['Title']);
define('TEMPLATEAUTHOR', $ct['Author']);
define('TEMPLATEURI', $ct['URI']);
define('TEMPLATEVERSION', $templateversion);

// Path constants
define('THEMELIB', TEMPLATEPATH . '/library');

// You can mess with these if you wish.
$my_themename = get_current_theme();
$my_shortname = 'h5bp';

// Create Theme Options Page
require_once(THEMELIB . '/extensions/theme-options.php');

// Load legacy functions
//require_once(THEMELIB . '/legacy/deprecated.php');

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

// load device type specific functions
require_once(THEMELIB . '/extensions/'.DEVICE.'-extensions.php');


/**
 *    Handle White Label CMS
 */
if (function_exists('wlcms_add_admin')) {
    define(strtoupper('wlcms_add_admin'), true);
}

/**
 *    Handle Minify
 */
if (class_exists('WPMinify')) {
    // make a switch to disable minify temp/soft switch?? maybe not required check this
    // set link to /wp-content/plugins/wp-minify/min/builder/
    // inform use of bookmarklet COOL

    // the results of bookmark should be added to /wp-content/plugins/wp-minify/min/groupsConfig.php
    //     'keyName' => array('//wpt/wp-content/themes/h5bp/library/js/plugins.top.js', '//wpt/wp-includes/js/jquery/jquery.form.js', '//wpt/wp-content/themes/h5bp/library/js/superfish.js', '//wpt/wp-content/themes/h5bp/library/js/supersubs.js', '//wpt/wp-content/themes/h5bp/library/js/jquery.bgiframe.min.js', '//wpt/wp-content/themes/h5bp/library/js/hoverIntent.js', '//wpt/wp-content/themes/h5bp/library/js/plugins.bottom.js'),
    //
    define(strtoupper('WPMinify'), true);
}

/**
 *    Handle Super Cache
 */
if (function_exists('wp_cache_is_enabled')) {
    // make a soft switch
    // make interface links to clear cache etc
    define(strtoupper('wp_cache_is_enabled'), true);
}

/**
 *    Handle Swf Object
 */
if (function_exists('wp_swfobject')) {
    // make a page in sidebar appear its a display of html5boilerplate video
    // would be cool to make one for this theme
    // also oocss slides & some jquery & wordpress tv maybe a feed of html5 wordpress vdieos
    // ha ha but this should use video in some cases (not like over use eg bing video background urgh)
    define(strtoupper('SWFObjectWP_SWFObject'), true);
}

/**
 *    Handle WP Ajax
 */
if (function_exists('wp_ajax')) {
    // hand specific ajax things like what
    define(strtoupper('wp_ajax'), true);
}

/**
 *    Handle Contact 7
 */
//if (function_exists('wpcf7')) {
    define(strtoupper('WP_Contact7'), true);
//}

/**
 *    Handle Cleaner Gallery
 */
if (function_exists('cleaner_gallery_setup')) { 
    define(strtoupper('cleaner_gallery'), true);
}

/**
 *    Handle GA Admin Plugin by Yoast
 */
if (class_exists('GA_Admin')) {
    define(strtoupper('Google_Analytics'), true);
}

/**
 *    Handle Google Sitemap Generator
 */
if (class_exists('Google_Sitemap_Generator')) {
    define(strtoupper('GoogleSitemapGeneratorLoader'), true);
}

/**
 *    Handle All In One SEO
 */
if (function_exists('All_in_One_SEO_Pack')) {
// septup some stuff for plugin interface from within theme options
// also define some functions for use in theme to display agumented 
// information based on these refined plugin settings 
    define(strtoupper('All_in_One_SEO_Pack'), true);
}

add_theme_support( 'post-thumbnails', array( 'post') ); // Add it for posts

// thematic_open_wrapper
define('THEMATIC_OPEN_WRAPPER', false);

/**
 *    thematic script
 */
if (!function_exists('thematic_scripts')) {
    function thematic_scripts() {
    themeatic_script_setup();
    }
}
/**
 * trial function to handle bunch of styles
 * aim to handle multiple styles and assist
 * in grouping them via mninify.  It will assist in
 * rewriting the childtheme/default stylesheey
 */ 
if (!function_exists('thematic_theme_styles')) {
    function thematic_theme_styles() {
    }
} // end thematic_theme_styles


/**
 * trial function to handle bunch of scripts
 * aim to handle multiple scripts for debugging 
 * and assist in grouping them via mninify
 */ 
if (!function_exists('thematic_theme_styles')) {
    function thematic_theme_scripts() {
    }
} // end thematic_theme_scripts


function home_content( $query )    {
    if ( is_home() && false == $query->query_vars['suppress_filters'] )
        $query->set( 'post_type', array( 'home', 'attachment' ) );

    return $query;
}

add_filter('pre_get_posts', 'home_content');

// Adds filters for the description/meta content in archives.php
add_filter( 'archive_meta', 'wptexturize' );
add_filter( 'archive_meta', 'convert_smilies' );
add_filter( 'archive_meta', 'convert_chars' );
add_filter( 'archive_meta', 'wpautop' );

// Remove the WordPress Generator via http://blog.ftwr.co.uk/archives/2007/10/06/improving-the-wordpress-generator/
function thematic_remove_generators()    { return ''; }

if (apply_filters('thematic_hide_generators', TRUE)) {  
    add_filter('the_generator','thematic_remove_generators');
}
/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 * Translate, if applicable
*/
load_theme_textdomain('thematic', THEMELIB . '/languages');

$locale = get_locale();
$locale_file = THEMELIB . "/languages/$locale.php";
if ( is_readable($locale_file) )
    require_once($locale_file);

/** Tell WordPress to run thematic_h5bp_setup() ala Twenty_Ten when the 'after_setup_theme' hook is run. */
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
    GLOBAL $my_themename;

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // This theme uses post thumbnails
    add_theme_support( 'post-thumbnails' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Make theme available for translation - I can remove the other one
    // Translations can be filed in the /languages/ directory
    load_theme_textdomain( $my_themename, TEMPLATEPATH . '/languages' );

    $locale = get_locale();
    $locale_file = TEMPLATEPATH . "/languages/$locale.php";
    if ( is_readable( $locale_file ) )
        require_once( $locale_file );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'xoxo' => __( 'Primary Navigation', $my_themename ),
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
            'description' => __( 'Path', $my_themename )
        ),
        'h5bp' => array(
            'url' => '%s/images/headers/h5bp.jpg',
            'thumbnail_url' => '%s/images/headers/h5bp-thumbnail.jpg',
            /* translators: header image description */
            'description' => __( 'Html5 Boilerplate', $my_themename )
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
    return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', $my_themename ) . '</a>';
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
    'xoxo' => __( 'Primary Menu', $my_themename ),
    'aside' => __( 'Aside Menu', $my_themename )
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
 *     vertical bar, "|", as a separator in header.php.
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
        $title = sprintf( __( 'Search results for %s', $my_themename ), '"' . get_search_query() . '"' );
        // Add a page number if we're on page 2 or more:
        if ( $paged >= 2 )
            $title .= " $separator " . sprintf( __( 'Page %s', $my_themename ), $paged );
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
        $title .= " $separator " . sprintf( __( 'Page %s', $my_themename ), max( $paged, $page ) );

    // Return the new title to wp_title():
    return $title;
}
// add_filter( 'wp_title', 'toolbox_filter_wp_title', 10, 2 );


// Set constant for current theme directory

$dirname = get_stylesheet_directory();

define('CHILDTHEME_THEME_DIRECTORY', $dirname . '/');

// Get theme panel
require_once(TEMPLATEPATH . '/functions/admin-panel.php');

// Get panel options
require_once(TEMPLATEPATH . '/functions/admin-panel-options.php');
// Get panel options
require_once(TEMPLATEPATH . '/functions/admin-panel-plugins.php');

// Functions related to admin panel
require_once(TEMPLATEPATH . '/functions/admin-panel-functions.php');

// Ajax Functions
require_once(TEMPLATEPATH . '/functions/admin-panel-ajax.php');

// Custom theme functions
require_once(TEMPLATEPATH . '/functions/theme-functions.php');

add_action('admin_notices', 'childtheme_phpthumb_nag');

function childtheme_phpthumb_nag(){
    if (! is_writable( CHILDTHEME_THEME_DIRECTORY . 'cache/'  ) ):

        global $my_themename;
        echo '<div class="error"><p>';
        printf( __('Notice: In order for %1$s to function properly, %2$s must be writable by the webserver chmod 0755 h5bp/cache/' ), $my_themename, CHILDTHEME_THEME_DIRECTORY . 'cache/' ) ;
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
    GLOBAL $my_themename;
    register_sidebar( array(
        'name' => __( 'Home Content', $my_themename ),
        'id' => 'home-content',
        'description' => __( 'This widget displays markup ideal for a sliding/fading (or tabbed use classes and customise the css) list on the home page', $my_themename ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Blurb AboutBox', $my_themename ),
        'id' => 'about-box',
        'description' => __( 'An about aside widgets displayed as sections', $my_themename ),
        'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Primary Widget Area', $my_themename ),
        'id' => 'primary-menu',
        'description' => __( 'The primary menu in header (not wrapped in div)', $my_themename ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Primary Widget Area', $my_themename ),
        'id' => 'primary-widget-area',
        'description' => __( 'The primary widget area', $my_themename ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
    register_sidebar( array(
        'name' => __( 'Secondary Widget Area', $my_themename ),
        'id' => 'secondary-widget-area',
        'description' => __( 'The secondary widget area', $my_themename ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Area 3, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'First Footer Widget Area', $my_themename ),
        'id' => 'first-footer-widget-area',
        'description' => __( 'The first footer widget area', $my_themename ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Area 4, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Second Footer Widget Area', $my_themename ),
        'id' => 'second-footer-widget-area',
        'description' => __( 'The second footer widget area', $my_themename ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Area 5, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Third Footer Widget Area', $my_themename ),
        'id' => 'third-footer-widget-area',
        'description' => __( 'The third footer widget area', $my_themename ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Area 6, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Fourth Footer Widget Area', $my_themename ),
        'id' => 'fourth-footer-widget-area',
        'description' => __( 'The fourth footer widget area', $my_themename ),
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

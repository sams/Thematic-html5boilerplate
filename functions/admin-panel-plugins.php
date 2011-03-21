<?php

// Theme options adapted from "A Theme Tip For WordPress Theme Authors"
// http://literalbarrage.org/blog/archives/2007/05/03/a-theme-tip-for-wordpress-theme-authors/
// is it req to add options for minify etc
  
/**
 *    Handle White Label CMS
 */
if (function_exists('wlcms_add_admin')) {
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
}

/**
 *    Handle Super Cache
 */
if (function_exists('wp_cache_is_enabled')) {
    // make a soft switch
    // make interface links to clear cache etc
}

/**
 *    Handle Swf Object
 */
if (function_exists('wpswfObject')) {
    // make a page in sidebar appear its a display of html5boilerplate video
    // would be cool to make one for this theme
    // also oocss slides & some jquery & wordpress tv maybe a feed of html5 wordpress vdieos
    // ha ha but this should use video in some cases (not like over use eg bing video background urgh)
}

/**
 *    Handle Contact 7
 */
if (function_exists('wpcf7')) {

}

/**
 *    Handle Cleaner Gallery
 */
if (function_exists('cleaner_gallery_setup')) {
}

/**
 *    Handle GA Admin Plugin by Yoast
 */
if (class_exists('GA_Admin')) {
}

/**
 *    Handle Google Sitemap Generator
 */
if (class_exists('GoogleSitemapGeneratorLoader')) {
}

/**
 *    Handle All In One SEO
 */
if (class_exists('All_in_One_SEO_Pack')) {
// septup some stuff for plugin interface from within theme options
// also define some functions for use in theme to display agumented 
// information based on these refined plugin settings
}
$supported_plugins = array(
    'wlcms_add_admin' => array(
        'name' => 'White Label CMS',
        'desc' => 'Whitelabe CMS options for additional control',
        'type' => 'checkbox',
    ),
    'WPMinify' => array(
        'name' => 'WP Minify',
        'desc' => 'Soft disable/enable; additional grouping instructions',
        'type' => 'checkbox',
    ),
    'wp_cache_is_enabled' => array(
        '' => 'WP Super Cache',
        'desc' => 'Soft disable/enable',
        'type' => 'checkbox',
    ),
    'wpswfObject' => array(
        'name' => 'WP SWFObject',
        'desc' => 'Additional Controls',
        'type' => 'checkbox',
    ),
    'wpcf7' => array(
        'name' => 'WP Contact 7',
        'desc' => 'Additional Controls',
        'type' => 'checkbox',
    ),
    'cleaner_gallery_setup' => array(
        'name' => 'Cleaner Gallery',
        'desc' => 'Addition Controls',
        'type' => 'checkbox',
    ),
    'GA_Admin' => array(
        'name' => 'Google Analaytics Yoast Plugin',
        'desc' => 'Additional Controls',
        'type' => 'checkbox',
    ),
    'GoogleSitemapGeneratorLoader' => array(
        'name' => 'Google Sitemap Generator Loader',
        'desc' => 'Addional controls',
        'type' => 'checkbox',
    ),
    'All_in_One_SEO_Pack' => array(
        'name' => 'All in One SEO Pack',
        'desc' => 'Additional Controls',
        'type' => 'checkbox',
    ),
);

$my_plugins = array();

foreach($supported_plugins as $h5BPP => $thisPlugin) {
    if(defined(str_replace(' ', '_', strtoupper($h5BPP))))    {
    $my_options[] =     array(
            'name' => __($thisPlugin['name'], 'thematicchild'),
            'desc' => __($thisPlugin['desc'], 'thematicchild'),
            'id' => $my_shortname . '_' . $h5BPP,
            'std' => ($thisPlugin['std'] ? $thisPlugin['std'] : ''),
            'type' => $thisPlugin['type']
        );
    } else {
        // uninstalled and deactivated plugins with built in theme support
    }
}

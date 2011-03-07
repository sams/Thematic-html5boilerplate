<?php

// TODO alt layouts are available within a single set of sheets; aim to allow great diversity of layouts within theme; plus less complex
// presently this is supa fooked this array needs flipping in places - aim to have the keys used as classes and the values descriptions
$alt_layouts = array(
	'Default' => '',
	'Left' => 'ldefault',
	'Full' => 'full',
	'col3a' => '2 sidebars and central layout',
	'col3b' => '2 sidebars (left)',
	'col3c' => '2 sidebars (right)',
);
//die(get_template_directory() . '/library/js/libs/modernizr-*.js');
$modernizrBuildsComplete = glob(get_template_directory() . '/library/js/libs/modernizr-*.js');
$modernizrBuilds = array();
foreach($modernizrBuildsComplete as $build) {
    $modernizrBuilds[] = basename($build);    
}
unset($modernizrBuildsComplete);

$jqueryversion = array(
	// stable jquery libs
	'1.5.1' => '1.5.1',
	'1.5.0' => '1.5.0',
	'1.4.3' => '1.4.3',
	'1.4.2' => '1.4.2',
	'1.4.1' => '1.4.1',
	'1.3.2' => '1.3.2',
	'1.3.0' => '1.3.0',
	'1.2.6' => '1.2.6',
	'1.2.3' => '1.2.3'
);

$minification_options = array(
	'' => 'none',
	'css' => 'css',
	'js' => 'js',
	'html' => 'html',
	'cssjs' => 'css and js',
	'all' => 'all',
);

                          
// Theme options adapted from "A Theme Tip For WordPress Theme Authors"
// http://literalbarrage.org/blog/archives/2007/05/03/a-theme-tip-for-wordpress-theme-authors/
// is it req to add options for minify etc

$my_options = array(
	array(
		'name' => __('Column Layout', 'thematicchild'),
		'desc' => '',
		'id' => $my_shortname . '_alt_layouts',
		'std' => 'default',
		'type' => 'select',
		'options' => $alt_layouts
	),
	array(
		'name' => __('Logo Image', 'thematicchild'),
		'desc' => __('Upload a logo image to use.', 'childtheme') ,
		'id' => $my_shortname . '_logo',
		'std' => '',
		'type' => 'upload'
	),
	array(
		'name' => __('Logo URL', 'thematicchild'),
		'desc' => __('Specify a url for the logo image (overrides the uploaded).', 'childtheme') ,
		'id' => $my_shortname . '_logourl',
		'std' => '',
		'type' => 'text'
	),
	array(
		'name' => __('Remove Title', 'thematicchild'),
		'desc' => __('remove the title from header.', 'childtheme') ,
		'id' => $my_shortname . '_rmtitle',
		'std' => '',
		'type' => 'checkbox'
	),
	array(
		'name' => __('Remove Description', 'thematicchild'),
		'desc' => __('remove the description from header.', 'childtheme') ,
		'id' => $my_shortname . '_rmdesc',
		'std' => '',
		'type' => 'checkbox'
	),
	array(
		'name' => __('Favicon', 'thematicchild'),
		'desc' => __('Icon used by browsers when bookmarking.', 'childtheme') ,
		'id' => $my_shortname . '_appletouch',
		'std' => '',
		'type' => 'upload'
	),
	array(
		'name' => __('Apple Touch Icon', 'thematicchild'),
		'desc' => __('An icon used by Apple devices as icon when favouriting (Android use it too).', 'childtheme') ,
		'id' => $my_shortname . '_appletouch',
		'std' => '',
		'type' => 'upload'
	),
	array(
		'name' => __('Facebook Src', 'thematicchild'),
		'desc' => __('Facebook Src\'s allow you to specifiy the image which appears in status updates.  These are choosen in post and pages', 'thematicchild'),
		'id' => $my_shortname . '_fbsrc',
		'std' => '',
		'type' => 'checkbox'
	),
	array(
		'name' => __('Chrome Frame', 'thematicchild'),
		'desc' => __('If you want the chrome frame output oin head because your not adding it to .htaccess.', 'thematicchild'),
		'id' => $my_shortname . '_chromeframe',
		'std' => '',
		'type' => 'checkbox'
	),
	array(
		'name' => __('Main Styles Url', 'thematicchild'),
		'desc' => __('Uri for main stylesheet', 'thematicchild'),
		'id' => $my_shortname . '_main_style_url',
		'std' => '',
		'type' => 'text'
	),
	array(
		'name' => __('Handheld', 'thematicchild'),
		'desc' => __('Include the handheld styles.', 'thematicchild'),
		'id' => $my_shortname . '_handheld',
		'std' => '',
		'type' => 'checkbox'
	),
	array(
		'name' => __('Handheld Style Url', 'thematicchild'),
		'desc' => __('Uri for main stylesheet', 'thematicchild'),
		'id' => $my_shortname . '_hh_style_url',
		'std' => '',
		'type' => 'text'
	),
	array(
		'name' => __('Minify', 'thematicchild'),
		'desc' => __('Minifcation options.', 'thematicchild'),
		'id' => $my_shortname . '_minify',
		'std' => '',
		'type' => 'select',
		'options' => $minification_options
	),
	array(
		'name' => __('Liquid', 'thematicchild'),
		'desc' => __('Set the body to be liquid.', 'thematicchild'),
		'id' => $my_shortname . '_liquid',
		'std' => '',
		'type' => 'checkbox'
	),
	array(
		'name' => __('jQuery Version', 'thematicchild'),
		'desc' => __('What Version of jQuery are we to load', 'thematicchild'),
		'id' => $my_shortname . '_jquery_version',
		'std' => '1.5.0',
		'type' => 'select',
		'options' => $jqueryversion,
	),
	array(
		'name' => __('modernizr builds', 'thematicchild'),
		'desc' => __('Lists available builds of modernizr include custom builds that you add', 'thematicchild'),
		'id' => $my_shortname . '_modernizr_build',
		'std' => 'modernizr-1.6.min',
		'type' => 'select',
		'options' => $modernizrBuilds,
	),
	array(
		'name' => __('JS in Footer', 'thematicchild'),
		'desc' => __('Place JS Before body close after footer', 'thematicchild'),
		'id' => $my_shortname . '_jsfoot',
		'std' => '',
		'type' => 'checkbox'
	),
	array(
		'name' => __('childtheme_override_head_scripts', 'thematicchild'),
		'desc' => __('Override the thematic script header. If set this to true or create a function named \'childtheme_override_head_scripts\'.  If you set this to false you\'ll have errors.', 'thematicchild'),
		'id' => $my_shortname . '_override_head_scripts',
		'std' => 'true',
		'type' => 'checkbox'
	),
	array(
		'name' => __('Deque jQuery', 'thematicchild'),
		'desc' => __('Your already including it', 'thematicchild'),
		'id' => $my_shortname . '_dqjquery',
		'std' => '',
		'type' => 'checkbox'
	),
	array(
		'name' => __('Google Hosted Api', 'thematicchild'),
		'desc' => __('Load jQuery from Google Hosted CDN', 'thematicchild'),
		'id' => $my_shortname . '_gdn',
		'std' => '',
		'type' => 'checkbox'
	),
	array(
		'name' => __('JS Plugins', 'thematicchild'),
		'desc' => __('jQuery Plugins to CnC (one file each line); change to minify url once known if using groups', 'thematicchild'),
		'id' => $my_shortname . '_js_plugins',
		'std' => '',
		'type' => 'textarea'
	),
	array(
		'name' => __('JS Script', 'thematicchild'),
		'desc' => __('jQuery Script Files (one file eachline); change to minify url once known if using groups', 'thematicchild'),
		'id' => $my_shortname . '_js_script',
		'std' => '',
		'type' => 'textarea'
	),
	array(
		'name' => __('Yahoo Profiling', 'thematicchild'),
		'desc' => __('Enable Yahoo Profiling.  Don\'t leave it on it will slow things down (see Paul Irish\'s Video Tutorial for how to use this)', 'thematicchild'),
		'id' => $my_shortname . '_yahooprofile',
		'std' => '',
		'type' => 'checkbox'
	),
	array(
		'name' => __('Search as Header li', 'thematicchild'),
		'desc' => __('Add the search to header as a listed item widget or you many manually add it to an aside', 'thematicchild'),
		'id' => $my_shortname . '_searchasli',
		'std' => '',
		'type' => 'checkbox'
	),
	array(
		'name' => __('Footer Text', 'thematicchild'),
		'desc' => __('You can use the shortcodes: [wp-link] [theme-link] [loginout-link] [blog-title] [blog-link] [the-year]', 'thematicchild'),
		'id' => $my_shortname . '_footertext',
		'std' => __('Powered by [wp-link]. Built on the [theme-link].', 'thematicchild'),
		'type' => 'textarea'
	),
	array(
		'name' => __('Selectivizr', 'thematicchild'),
		'desc' => __('Add selectivizr for IE 8 and less.', 'thematicchild'),
		'id' => $my_shortname . '_selectivizr',
		'std' => '',
		'type' => 'checkbox'
	),
	array(
		'name' => __('Drew Diller PNG Fix', 'thematicchild'),
		'desc' => __('Fix PNG transparency with DD PNGFix use .png_bg  class on images to fix them in ie7 and below.', 'thematicchild'),
		'id' => $my_shortname . '_dd_pngfix',
		'std' => 'true',
		'type' => 'checkbox'
	),
	array(
		'name' => __('Google Analytics Code', 'thematicchild'),
		'desc' => __('Your Google Analytics Id String (not the full code just UA-xxx).  Install Yoast GA & Seo Plugins http://yoast.com/.', 'thematicchild'),
		'id' => $my_shortname . '_googleanalytics',
		'std' => '',
		'type' => 'text'
	),
	array(
		'name' => __('Google Site Verification', 'thematicchild'),
		'desc' => __('Adding a Value here will place a meta tag to the head of home page only to verify the site in Google Webmaster Tools', 'thematicchild'),
		'id' => $my_shortname . '_gsv',
		'std' => '',
		'type' => 'text'
	),
	array(
		'name' => __('Yahoo Site Verification', 'thematicchild'),
		'desc' => __('Adding a Value here will place a meta tag to the head of home page only to verify the site in Yahoo Site Explorer', 'thematicchild'),
		'id' => $my_shortname . '_ykey',
		'std' => '',
		'type' => 'text'
	),
	array(
		'name' => __('Alexa Site Verification', 'thematicchild'),
		'desc' => __('Adding a Value here will place a meta tag to the head of home page only to verify the site in Aexla Webmaster Tools', 'thematicchild'),
		'id' => $my_shortname . '_akey',
		'std' => '',
		'type' => 'text'
	),
	array(
		'name' => __('Bing Site Verification', 'thematicchild'),
		'desc' => __('Adding a Value here will place a meta tag to the head of home page only to verify the site in Bing Webmaster Tools', 'thematicchild'),
		'id' => $my_shortname . '_msv',
		'std' => '',
		'type' => 'text'
	),
);

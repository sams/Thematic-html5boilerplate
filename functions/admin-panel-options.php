<?php

// Fetch alternate theme stylesheets    - this will be either classnames on the body or these will be added to the minify at runtime
$alt_layout_dir = CHILDTHEME_THEME_DIRECTORY . 'layouts/';
$alt_layouts = array();

if (is_dir($alt_layout_dir)) {
  $alt_layouts[] = 'default';
  $layouts = scandir($alt_layout_dir);
  foreach ($layouts as $layout) {
    if (strpos($layout, '.css')) {
      $alt_layouts[] = $layout;
    }
  }
}

// Theme options adapted from "A Theme Tip For WordPress Theme Authors"
// http://literalbarrage.org/blog/archives/2007/05/03/a-theme-tip-for-wordpress-theme-authors/
// is it req to add options for minify etc

$my_options = array(
  array(
    'name' => __('Column Layout', 'thematicchild'),
    'desc' => '',
    'id' => $my_shortname . '_alt_layouts',
    'std' => 'desfault',
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
    'name' => __('Handheld', 'thematicchild'),
    'desc' => __('Include the handheld styles.', 'thematicchild'),
    'id' => $my_shortname . '_handheld',
    'std' => '',
    'type' => 'checkbox'
  ),
  array(
    'name' => __('Liquid', 'thematicchild'),
    'desc' => __('Set the body to be liquid.', 'thematicchild'),
    'id' => $my_shortname . '_liquid',
    'std' => '',
    'type' => 'checkbox'
  ),
  array(
    'name' => __('JS in Footer', 'thematicchild'),
    'desc' => __('For optimal rendering in performance', 'thematicchild'),
    'id' => $my_shortname . '_jsfoot',
    'std' => '',
    'type' => 'checkbox'
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
    'name' => __('Google Analytics Code', 'thematicchild'),
    'desc' => __('Your Google Analytics Id String (not the full code just UA-xxx).  Install Yoast GA & Seo Plugins http://yoast.com/.', 'thematicchild'),
    'id' => $my_shortname . '_googleanalytics',
    'std' => '',
    'type' => 'text'
  ),
);
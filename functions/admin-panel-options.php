<?php

// Fetch alternate theme stylesheets    - this will be either classnames on the body or these will be added to the minify at runtime
$alt_layout_dir = CHILDTHEME_THEME_DIRECTORY . 'layouts/';
$alt_layouts = array();

if (is_dir($alt_layout_dir)) {
  $layouts = scandir($alt_layout_dir);
  foreach ($layouts as $layout) {
    if (strpos($layout, '.css')) {
      $alt_layouts[] = $layout;
    }
  }
}

// Theme options adapted from "A Theme Tip For WordPress Theme Authors"
// http://literalbarrage.org/blog/archives/2007/05/03/a-theme-tip-for-wordpress-theme-authors/

$my_options = array(
  array(
    'name' => __('Column Layout', 'thematicchild'),
    'desc' => '',
    'id' => $my_shortname . '_alt_layouts',
    'std' => '2c-r-fixed.css',
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
    'name' => __('Google Analytics Code', 'thematicchild'),
    'desc' => __('Paste Your Google Analytics Code Here.', 'thematicchild'),
    'id' => $my_shortname . '_googleanalytics',
    'std' => '',
    'type' => 'textarea'
  ),
    array(
    'name' => __('Footer Text', 'thematicchild'),
    'desc' => __('You can use the shortcodes: [wp-link] [theme-link] [loginout-link] [blog-title] [blog-link] [the-year]', 'thematicchild'),
    'id' => $my_shortname . '_footertext',
    'std' => __('Powered by [wp-link]. Built on the [theme-link].', 'thematicchild'),
    'type' => 'textarea'
  ),
);

?>

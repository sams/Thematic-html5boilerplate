<?php

// Add a Favicon  - make this handle more stuff from pft

function childtheme_favicon() { ?>
<link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/images/favicon.ico" />
<link rel="apple-touch-icon" href="<?php echo bloginfo('stylesheet_directory') ?>/images/apple-touch-icon.png" />
<?php }

add_action('wp_head', 'childtheme_favicon');

?>
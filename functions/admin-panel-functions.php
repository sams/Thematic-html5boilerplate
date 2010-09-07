<?php

/*
 * Switch CSS Style
 */

function childtheme_pick_layout($content) {
  global $my_shortname;
  $altstyle = get_option($my_shortname . '_alt_layouts');
  if (empty($altstyle)) { $altstyle = '2c-r-fixed.css'; }
  if ($altstyle !== 'default' || $altstyle !== 'default.css') {
	  $content .= "\t";
	  $content .= '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/layouts/' . $altstyle. '" />';
	  $content .= "\n\n";
  }
  return $content;
}

add_filter('thematic_create_stylesheet', 'childtheme_pick_layout');

/*
 * Replace Blog Title with Logo
 */

function add_childtheme_logo() {
	global $my_shortname;
	$logo = get_option($my_shortname . '_logo');
	$rmtitle = get_option($my_shortname . '_rmtitle');
	$rmdesc = get_option($my_shortname . '_rmdesc');
	if (!empty($logo)) {
		if($rmtitle)
			remove_action('thematic_header','thematic_blogtitle', 3);
		if($rmdesc)
			remove_action('thematic_header','thematic_blogdescription',5);
		add_action('thematic_header','childtheme_logo', 1);
	}
}
add_action('init','add_childtheme_logo');

function childtheme_logo() {
	global $my_shortname;
	$logo = get_option($my_shortname . '_logo');
	if (!empty($logo)) { ?>
		<div id="logo"><a href="<?php bloginfo('url') ?>/" title="<?php bloginfo('name') ?>" rel="home"><img src="<?php bloginfo('stylesheet_directory'); ?>/scripts/timthumb.php?src=<?php echo $logo; ?>&amp;w=55&amp;zc=1" alt="<?php bloginfo('name') ?>" /></a></div>
		<?php
		}
	}

/*
 * Add Google Analytics Code if Available
 */

function analytic_footer() {
	global $my_shortname;
	echo stripslashes(get_option($my_shortname . '_googleanalytics'));
}
add_filter ('thematic_after', 'analytic_footer');


/*
 * Build upload field
 */

function get_upload_field($id, $std = '', $desc = '') {
  $data = get_option($id);

  $field = '<input id="' . $id . '" type="file" name="attachment_' . $id . '" />' .
           '<span class="submit"><input name="save" type="submit" value="Upload" class="button panel-upload-save" />
		   </span> <span class="description"> '. __($desc,'thematic') .' </span>' .
           ($data ?
				get_upload_image_preview($data) .
		   '<div class="img_location" ><input id="header_img_location" class="img_location regular-text" type="text" class="" name="' . $id . '" value="' . ($data ? $data : $std) . '" readonly="readonly" /></div>
		   <input name="save" id="'.$id.'" type="submit" class="remove_img button panel-upload-save hide-if-no-js" value="' . __("Remove") .'" />
		   <input name="save" id="'.$id.'" type="submit" class="remove_img hide-if-js remove_img button panel-upload-save" value="' . __("Remove $id") .'" />

		   ' : '') ;

  return $field;
}

/*
 * Build image preview using timthumb.php
 */
function get_upload_image_preview($data = '') {
  if (!empty($data)) {
    $img_preview = '<div class="img_preview">' .
                  '<img src="' . get_bloginfo('stylesheet_directory') . '/scripts/timthumb.php?src=' . $data . '&amp;w=55&amp;zc=1" alt="Thumbnail Preview">' .
                  '</div>';

                    return $img_preview;

    return $img_preview;
  }
  else {
    return;
  }
}

/*
 * Generate Footer Code
 */

function childtheme_footer($thm_footertext) {
    global $my_shortname;
	$footertext = get_option($my_shortname . '_footertext');
    	return $footertext;
    }

add_filter('thematic_footertext', 'childtheme_footer');

/**
 * Check to see if the current user has sufficiant abilities to manage the options based on the WP version
 *
 * On pre 3.0, the capability checked is manage_options, post it is edit_theme_options
 *
 */


function childtheme_can_edit_theme_options(){
	global $wp_version;

	if( $wp_version{0} != 3)
		return current_user_can( 'manage_options' );
	else
		return current_user_can( 'edit_theme_options' ) ;
}
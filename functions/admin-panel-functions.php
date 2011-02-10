<?php

/**
 * Switch CSS Style
 */
function childtheme_pick_layout($content) {
	return $content;
}

add_filter('thematic_create_stylesheet', 'childtheme_pick_layout');

/**
 * Hook to add the logo
 */
function add_childtheme_logo() {
	global $my_shortname;
	$logo = get_option($my_shortname . '_logo');
	if (!empty($logo)) {
		add_action('thematic_header','childtheme_logo', 1);
	}
}
add_action('init','add_childtheme_logo');



/**
 * the actual logo adding function
 */
function childtheme_logo() {
	global $my_shortname;
	$logo = get_option($my_shortname . '_logo');
	$logourl = get_option($my_shortname . '_logourl');
	if (!empty($logo) && (strpos($logo, '/cache/') === false)) { ?>
		<a id="logo" href="<?php bloginfo('url') ?>/" title="<?php bloginfo('name') ?>" rel="home"><img src="<?php bloginfo('stylesheet_directory'); ?>/functions/phpthumb/PHPThumb.php?src=<?php echo str_replace('http://' . $_SERVER['HTTP_HOST'], '', $logo); ?>&amp;w=55&amp;zc=1" alt="<?php bloginfo('name') ?>" /></a>
		<?php
	} else { ?>
		<a id="logo" href="<?php bloginfo('url') ?>/" title="<?php bloginfo('name') ?>" rel="home"><img src="<?php echo (strpos($logo, '/cache/') === false) ? $logouyl : $logo; ?>" alt="<?php bloginfo('name') ?>" /></a>
		<?php
		}
	}

/**
 * Add Google Analytics Code if Available
 */
function analytic_footer() {
	global $my_shortname;
	echo stripslashes(get_option($my_shortname . '_googleanalytics'));
}
add_filter ('thematic_after', 'analytic_footer');


/**
 * Build upload field
 */
function get_upload_field($id, $std = '', $desc = '') {
	$data = get_option($id);

	$field =	'<input id="' . $id . '" type="file" name="attachment_' . $id . '" />' . 
				'<span class="submit"><input name="save" type="submit" value="Upload" class="button panel-upload-save" />' . 
				'</span> <span class="description"> '. __($desc,'thematic') .' </span>' .
			( $data ?
				get_upload_image_preview($data, 'img'.$id) .
				'<div class="img_location" ><input id="header_img_location" class="img_location regular-text" type="text" class="" name="' . $id . '" value="' . ($data ? $data : $std) . '" readonly="readonly" /></div>' . 
				'<input name="save" id="'.$id.'" type="submit" class="remove_img button panel-upload-save hide-if-no-js" value="' . __("Remove") .'" />' . 
				'<input name="save" id="'.$id.'" type="submit" class="remove_img hide-if-js remove_img button panel-upload-save" value="' . __("Remove $id") .'" />' : '' );

	return $field;
}

/**
 * Build image preview using phpthumb
 */
function get_upload_image_preview($data = '', $imgid = '') {
	if ( !empty($data) && (strpos($data, '/cache/') === false)) {
		$img_preview =  '<div class="img_preview">' .
						'<img id="'.$id.'" class="uncached" src="' . get_bloginfo('template_directory') . '/functions/phpthumb/PHPThumb.php?src=' . preg_replace('#((https?:\/\/)|(www.))([^/]*)#', '', $data) . '&amp;w=55&amp;zc=1" alt="Thumbnail Preview">' . 
						'</div>';
		return $img_preview;
	} elseif ( !empty($data)) {
		$img_preview =  '<div class="img_preview">' .
						'<img id="'.$id.'" src="' . $data . '" alt="Thumbnail Preview (cached)" class="cached">' . 
						'</div>';
		return $img_preview;
	} else {
		return;
	}
}

/**
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

	if( $wp_version{0} != 3 ) {
		return current_user_can( 'manage_options' );
	} else {
		return current_user_can( 'edit_theme_options' ) ;
	}
}
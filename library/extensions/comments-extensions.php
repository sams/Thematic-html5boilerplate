<?php


// Located in comments.php
// Just before #comments
function thematic_abovecomments() {
    do_action('thematic_abovecomments');
}


// Located in comments.php
// Just before #comments-list
function thematic_abovecommentslist() {
    do_action('thematic_abovecommentslist');
}


// Located in comments.php
// Just after #comments-list
function thematic_belowcommentslist() {
    do_action('thematic_belowcommentslist');
}


// Located in comments.php
// Just before #trackbacks-list
function thematic_abovetrackbackslist() {
    do_action('thematic_abovetrackbackslist');
}


// Located in comments.php
// Just after #trackbacks-list
function thematic_belowtrackbackslist() {
    do_action('thematic_belowtrackbackslist');
}


// Located in comments.php
// Just before the comments form
function thematic_abovecommentsform() {
    do_action('thematic_abovecommentsform');
}


// Adds the Subscribe to comments button
function thematic_show_subscription_checkbox() {
    if(function_exists('show_subscription_checkbox')) { show_subscription_checkbox(); }
}
add_action('comment_form', 'thematic_show_subscription_checkbox', 98);


// Located in comments.php
// Just after the comments form
function thematic_belowcommentsform() {
    do_action('thematic_belowcommentsform');
}


// Adds the Subscribe without commenting button
function thematic_show_manual_subscription_form() {
    if(function_exists('show_manual_subscription_form')) { show_manual_subscription_form(); }
}
add_action('thematic_belowcommentsform', 'thematic_show_manual_subscription_form', 5);


// Located in comments.php
// Just after #comments
function thematic_belowcomments() {
    do_action('thematic_belowcomments');
}

// Located in comments.php
// Creates the standard text for one comment
function thematic_singlecomment_text() {
    $content = __('<span>One</span> Comment', 'thematic');
    return apply_filters(thematic_singlecomment_text, $content);
}

// Located in comments.php
// Creates the standard text for more than one comment
function thematic_multiplecomments_text() {
    $content = __('<span>%d</span> Comments', 'thematic');
    return apply_filters(thematic_multiplecomments_text, $content);
}

// creates the list comments arguments
function list_comments_arg() {
	$content = 'type=comment&callback=thematic_comments';
	return apply_filters('list_comments_arg', $content);
}

// Located in comments.php
// Creates the standard text 'Post a Comment'
function thematic_postcomment_text() {
    $content = __('Post a Comment', 'thematic');
    return apply_filters(thematic_postcomment_text, $content);
}

// Located in comments.php
// Creates the standard text 'Post a Reply to %s'
function thematic_postreply_text() {
    $content = __('Post a Reply to %s', 'thematic');
    return apply_filters(thematic_postreply_text, $content);
}

// Located in comments.php
// Creates the standard text 'Comment' for the text box
function thematic_commentbox_text() {
    $content = __('Comment', 'thematic');
    return apply_filters(thematic_commentbox_text, $content);
}

// Located in comments.php
// Creates the standard text 'Post Comment' for the send button
function thematic_commentbutton_text() {
    $content = __('Post Comment', 'thematic');
    return apply_filters(thematic_commentbutton_text, $content);
}

// Produces an avatar image with the hCard-compliant photo class
function thematic_commenter_link() {
	$commenter = get_comment_author_link();
	if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
		$commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
	} else {
		$commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
	}
	$avatar_email = get_comment_author_email();
	$avatar_size = apply_filters( 'avatar_size', '80' ); // Available filter: avatar_size
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, $avatar_size ) );
	echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end thematic_commenter_link


// A hook for the standard comments template
function thematic_comments_template() {
	do_action('thematic_comments_template');
} // end thematic_comments


	// The standard comments template is injected into thematic_comments_template() by default
	function thematic_include_comments() {
		comments_template('', true);
	} // end thematic_include_comments
	
	add_action('thematic_comments_template','thematic_include_comments',5);
	
	
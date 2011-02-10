<?php

function thmfooter_wp_link() {
    return '<a class="wp-link" href="http://WordPress.org/" title="WordPress" rel="generator">WordPress</a>';
}
add_shortcode('wp-link', 'thmfooter_wp_link');		  
		  
function thmfooter_theme_link() {
    $themelink = '<a class="theme-link" href="http://themeshaper.com/thematic/" title="Thematic Theme Framework" rel="designer">Thematic Theme Framework</a>';
    return apply_filters('thematic_theme_link',$themelink);
}
add_shortcode('theme-link', 'thmfooter_theme_link');	

function thmfooter_login_link() {
    if ( ! is_user_logged_in() )
        $link = '<a href="' . site_url('/wp-login.php') . '">' . __('Login','thematic') . '</a>';
    else
    $link = '<a href="' . wp_logout_url($redirect) . '">' . __('Logout','thematic') . '</a>';
    return apply_filters('loginout', $link);
}
add_shortcode('loginout-link', 'thmfooter_login_link');		  	  

function thmfooter_blog_title() {
	return '<span class="blog-title">' . get_bloginfo('name') . '</span>';
}
add_shortcode('blog-title', 'thmfooter_blog_title');

function thmfooter_blog_link() {
	return '<a href="' . site_url('/') . '" title="' . get_option('blogname') . '" >' . get_option('blogname') . "</a>";
}
add_shortcode('blog-link', 'thmfooter_blog_link');

function thmfooter_year() {   
    return '<span class="the-year">' . date('Y') . '</span>';
}
add_shortcode('the-year', 'thmfooter_year');

// Providing information about Thematic

function theme_name() {
    return THEMENAME;
}
add_shortcode('theme-name', 'theme_name');

function theme_author() {
    return THEMEAUTHOR;
}
add_shortcode('theme-author', 'theme_author');

function theme_uri() {
    return THEMEURI;
}
add_shortcode('theme-uri', 'theme_uri');

function theme_version() {
    return THEMATICVERSION;
}
add_shortcode('theme-version', 'theme_version');

// Providing information about the child theme

function child_name() {
    return TEMPLATENAME;
}
add_shortcode('child-name', 'child_name');

function child_author() {
    return TEMPLATEAUTHOR;
}
add_shortcode('child-author', 'child_author');

function child_uri() {
    return TEMPLATEURI;
}
add_shortcode('child-uri', 'child_uri');

function child_version() {
    return TEMPLATEVERSION;
}
add_shortcode('child-version', 'child_version');

?>
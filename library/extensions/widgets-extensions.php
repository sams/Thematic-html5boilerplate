<?php

function thematic_search_form() {
				$search_form = "\n" . "\t";
				$search_form .= '<form id="searchform" method="get" action="' . get_bloginfo('home') .'">';
				$search_form .= "\n" . "\t" . "\t";
				$search_form .= '<div>';
				$search_form .= "\n" . "\t" . "\t". "\t";
				if (is_search()) {
						$search_form .= '<input id="s" name="s" type="text" value="' . wp_specialchars(stripslashes($_GET['s']), true) .'" size="32" tabindex="1" />';
				} else {
						$value = __('To search, type and hit enter', 'thematic');
						$value = apply_filters('search_field_value',$value);
						$search_form .= '<input id="s" name="s" type="text" value="' . $value . '" onfocus="if (this.value == \'' . $value . '\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'' . $value . '\';}" size="32" tabindex="1" />';
				}
				$search_form .= "\n" . "\t" . "\t". "\t";

				$search_submit = '<input id="searchsubmit" name="searchsubmit" type="submit" value="' . __('Search', 'thematic') . '" tabindex="2" />';

				$search_form .= apply_filters('thematic_search_submit', $search_submit);

				$search_form .= "\n" . "\t" . "\t";
				$search_form .= '</div>';

				$search_form .= "\n" . "\t";
				$search_form .= '</form>';

				echo apply_filters('thematic_search_form', $search_form);

}

// Widgets plugin: intializes the plugin after the widgets above have passed snuff

function thematic_widgets_init() {

	// Define array for the widgetized areas
	$thematic_widgetized_areas = array(
		'Header Widgets' => array(
			'admin_menu_order' => 100,
			'args' => array (
				'name' => 'Header Widgets',
				'id' => 'hdr-widgets',
                'description' => __('The header widget area for additional mast head items.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_header',
			'function'		=> 'thematic_widget_header',
			'priority'		=> 10,
			),
		'Primary Aside' => array(
			'admin_menu_order' => 200,
			'args' => array (
				'name' => 'Primary Aside',
				'id' => 'primary-aside',
                'description' => __('The primary widget area, most often used as a sidebar.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_primary_aside',
			'function'		=> 'thematic_primary_aside',
			'priority'		=> 10,
			),
		'Secondary Aside' => array(
			'admin_menu_order' => 300,
			'args' => array (
				'name' => 'Secondary Aside',
				'id' => 'secondary-aside',
                'description' => __('The secondary widget area, most often used as a sidebar.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_secondary_aside',
			'function'		=> 'thematic_secondary_aside',
			'priority'		=> 10,
			),
		'1st Subsidiary Aside' => array(
			'admin_menu_order' => 400,
			'args' => array (
				'name' => '1st Subsidiary Aside',
				'id' => '1st-subsidiary-aside',
                'description' => __('The 1st widget area in the footer.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_subsidiaries',
			'function'		=> 'thematic_1st_subsidiary_aside',
			'priority'		=> 30,
			),
		'2nd Subsidiary Aside' => array(
			'admin_menu_order' => 500,
			'args' => array (
				'name' => '2nd Subsidiary Aside',
				'id' => '2nd-subsidiary-aside',
                'description' => __('The 2nd widget area in the footer.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_subsidiaries',
			'function'		=> 'thematic_2nd_subsidiary_aside',
			'priority'		=> 50,
			),
		'3rd Subsidiary Aside' => array(
			'admin_menu_order' => 600,
			'args' => array (
				'name' => '3rd Subsidiary Aside',
				'id' => '3rd-subsidiary-aside',
                'description' => __('The 3rd widget area in the footer.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_subsidiaries',
			'function'		=> 'thematic_3rd_subsidiary_aside',
			'priority'		=> 70,
		),
		'Index Top' => array(
			'admin_menu_order' => 700,
			'args' => array (
				'name' => 'Index Top',
				'id' => 'index-top',
                'description' => __('The top widget area displayed on the index page.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_index_top',
			'function'		=> 'thematic_index_top',
			'priority'		=> 10,
			),
		'Index Insert' => array(
			'admin_menu_order' => 800,
			'args' => array (
				'name' => 'Index Insert',
				'id' => 'index-insert',
                'description' => __('The widget area inserted after x posts on the index page.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_index_insert',
			'function'		=> 'thematic_index_insert',
			'priority'		=> 10,
			),
		'Index Bottom' => array(
			'admin_menu_order' => 900,
			'args' => array (
				'name' => 'Index Bottom',
				'id' => 'index-bottom',
                'description' => __('The bottom widget area displayed on the index page.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_index_bottom',
			'function'		=> 'thematic_index_bottom',
			'priority'		=> 10,
			),
		'Single Top' => array(
			'admin_menu_order' => 1000,
			'args' => array (
				'name' => 'Single Top',
				'id' => 'single-top',
                'description' => __('The top widget area displayed on a single post.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_single_top',
			'function'		=> 'thematic_single_top',
			'priority'		=> 10,
			),
		'Single Insert' => array(
			'admin_menu_order' => 1100,
			'args' => array (
				'name' => 'Single Insert',
				'id' => 'single-insert',
                'description' => __('The widget area inserted between the post and the comments on a single post.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_single_insert',
			'function'		=> 'thematic_single_insert',
			'priority'		=> 10,
			),
		'Single Bottom' => array(
			'admin_menu_order' => 1200,
			'args' => array (
				'name' => 'Single Bottom',
				'id' => 'single-bottom',
                'description' => __('The bottom widget area displayed on a single post.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_single_bottom',
			'function'		=> 'thematic_single_bottom',
			'priority'		=> 10,
			),
		'Page Top' => array(
			'admin_menu_order' => 1300,
			'args' => array (
				'name' => 'Page Top',
				'id' => 'page-top',
                'description' => __('The top widget area displayed on a page.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_page_top',
			'function'		=> 'thematic_page_top',
			'priority'		=> 10,
			),
		'Page Bottom' => array(
			'admin_menu_order' => 1400,
			'args' => array (
				'name' => 'Page Bottom',
				'id' => 'page-bottom',
                'description' => __('The bottom widget area displayed on a page.', 'thematic'),
				'before_widget' => thematic_before_widget(),
				'after_widget' => thematic_after_widget(),
				'before_title' => thematic_before_title(),
				'after_title' => thematic_after_title(),
				),
			'action_hook'	=> 'widget_area_page_bottom',
			'function'		=> 'thematic_page_bottom',
			'priority'		=> 10,
			),
		);
	
	$thematic_widgetized_areas = apply_filters('thematic_widgetized_areas', $thematic_widgetized_areas);
	
	if ( !function_exists('register_sidebars') )
			return;

	foreach ($thematic_widgetized_areas as $key => $value) {
		register_sidebar($thematic_widgetized_areas[$key]['args']);
		if (!has_action($thematic_widgetized_areas[$key]['action_hook'], $thematic_widgetized_areas[$key]['function'])) {
			add_action($thematic_widgetized_areas[$key]['action_hook'], $thematic_widgetized_areas[$key]['function'], $thematic_widgetized_areas[$key]['priority']);	
		}
	}
	  
    // we will check for a Thematic widgets directory and and add and activate additional widgets
    // Thanks to Joern Kretzschmar
	  $widgets_dir = @ dir(ABSPATH . '/wp-content/themes/' . get_template() . '/widgets');
	  if ($widgets_dir)	{
		  while(($widgetFile = $widgets_dir->read()) !== false) {
			 if (!preg_match('|^\.+$|', $widgetFile) && preg_match('|\.php$|', $widgetFile))
				  include(ABSPATH . '/wp-content/themes/' . get_template() . '/widgets/' . $widgetFile);
		  }
	  }

	  // we will check for the child themes widgets directory and add and activate additional widgets
    // Thanks to Joern Kretzschmar 
	  $widgets_dir = @ dir(ABSPATH . '/wp-content/themes/' . get_stylesheet() . '/widgets');
	  if ((TEMPLATENAME != THEMENAME) && ($widgets_dir)) {
		  while(($widgetFile = $widgets_dir->read()) !== false) {
			 if (!preg_match('|^\.+$|', $widgetFile) && preg_match('|\.php$|', $widgetFile))
				  include(ABSPATH . '/wp-content/themes/' . get_stylesheet() . '/widgets/' . $widgetFile);
		  }
	  }   

	// Remove WP default Widgets
	// WP 2.8 function using $widget_class
	if (function_exists('unregister_widget')) {
		unregister_widget('WP_Widget_Meta');
		unregister_widget('WP_Widget_Search');
        unregister_widget('');
	
	// pre WP 2.8 function using $id
	} else {
		unregister_widget_control('meta');
		unregister_widget_control('search');	
	}

	// Finished intializing Widgets plugin, now let's load the thematic default widgets
	register_sidebar_widget(__('Search', 'thematic'), 'widget_thematic_search', null, 'search');
	unregister_widget_control('search');
	register_sidebar_widget(__('Meta', 'thematic'), 'widget_thematic_meta', null, 'meta');
	unregister_widget_control('meta');
	register_sidebar_widget(array(__('RSS Links', 'thematic'), 'widgets'), 'widget_thematic_rsslinks');
	register_widget_control(array(__('RSS Links', 'thematic'), 'widgets'), 'widget_thematic_rsslinks_control', 300, 90);

	// Pre-set Widgets
	$preset_widgets = array (
		'primary-aside'  => array( 'search', 'pages', 'categories', 'archives' ),
		'secondary-aside'  => array( 'links', 'rss-links', 'meta' )
		);

    if ( isset( $_GET['activated'] ) ) {
  		update_option( 'sidebars_widgets', apply_filters('thematic_preset_widgets',$preset_widgets ));
  	}

}

// Runs our code at the end to check that everything needed has loaded
add_action( 'widgets_init', 'thematic_widgets_init' );

// We sort our array of widgetized areas to get a nice list display under wp-admin
function thematic_sort_widgetized_areas($content) {
	asort($content);
	return $content;
}
add_filter('thematic_widgetized_areas', 'thematic_sort_widgetized_areas', 100);

// We start our functions for the widgetized areas here

// Define the thematic_widget_header
function thematic_widget_header() {
		echo thematic_before_widget_area('widget-header');   
		dynamic_sidebar('hdr-widgets');
		echo thematic_after_widget_area('widget-header');
} 
// Define the Primary Aside 
function thematic_primary_aside() {
	if (is_sidebar_active('primary-aside')) {
		echo thematic_before_widget_area('primary-aside');
		dynamic_sidebar('primary-aside');
		echo thematic_after_widget_area('primary-aside');
	}
}

// Define the Secondary Aside
function thematic_secondary_aside() {
	if (is_sidebar_active('secondary-aside')) {
		echo thematic_before_widget_area('secondary-aside');
		dynamic_sidebar('secondary-aside');
		echo thematic_after_widget_area('secondary-aside');
	}
}

// Define the 1st Subsidiary Aside
function thematic_1st_subsidiary_aside() {
	if (is_sidebar_active('1st-subsidiary-aside')) {
		echo thematic_before_widget_area('1st-subsidiary-aside');
		dynamic_sidebar('1st-subsidiary-aside');
		echo thematic_after_widget_area('1st-subsidiary-aside');
	}
}

// Define the 2nd Subsidiary Aside
function thematic_2nd_subsidiary_aside() {
	if (is_sidebar_active('2nd-subsidiary-aside')) {
		echo thematic_before_widget_area('2nd-subsidiary-aside');
		dynamic_sidebar('2nd-subsidiary-aside');
		echo thematic_after_widget_area('2nd-subsidiary-aside');
	}
}

// Define the 3rd Subsidiary Aside
function thematic_3rd_subsidiary_aside() {
	if (is_sidebar_active('3rd-subsidiary-aside')) {
		echo thematic_before_widget_area('3rd-subsidiary-aside');
		dynamic_sidebar('3rd-subsidiary-aside');
		echo thematic_after_widget_area('3rd-subsidiary-aside');
	}
}

// Define the Index Top
function thematic_index_top() {
	if (is_sidebar_active('index-top')) {
		echo thematic_before_widget_area('index-top');
		dynamic_sidebar('index-top');
		echo thematic_after_widget_area('index-top');
	}
}

// Define the Index Insert
function thematic_index_insert() {
	if (is_sidebar_active('index-insert')) {
		echo thematic_before_widget_area('index-insert');
		dynamic_sidebar('index-insert');
		echo thematic_after_widget_area('index-insert');
	}
}

// Define the Index Bottom
function thematic_index_bottom() {
	if (is_sidebar_active('index-bottom')) {
		echo thematic_before_widget_area('index-bottom');
		dynamic_sidebar('index-bottom');
		echo thematic_after_widget_area('index-bottom');
	}
}

// Define the Single Top
function thematic_single_top() {
	if (is_sidebar_active('single-top')) {
		echo thematic_before_widget_area('single-top');
		dynamic_sidebar('single-top');
		echo thematic_after_widget_area('single-top');
	}
}

// Define the Single Insert
function thematic_single_insert() {
	if (is_sidebar_active('single-insert')) {
		echo thematic_before_widget_area('single-insert');
		dynamic_sidebar('single-insert');
		echo thematic_after_widget_area('single-insert');
	}
}

// Define the Single Bottom
function thematic_single_bottom() {
	if (is_sidebar_active('single-bottom')) {
		echo thematic_before_widget_area('single-bottom');
		dynamic_sidebar('single-bottom');
		echo thematic_after_widget_area('single-bottom');
	}
}

// Define the Page Top
function thematic_page_top() {
	if (is_sidebar_active('page-top')) {
		echo thematic_before_widget_area('page-top');
		dynamic_sidebar('page-top');
		echo thematic_after_widget_area('page-top');
	}
}

// Define the Page Bottom
function thematic_page_bottom() {
	if (is_sidebar_active('page-bottom')) {
		echo thematic_before_widget_area('page-bottom');
		dynamic_sidebar('page-bottom');
		echo thematic_after_widget_area('page-bottom');
	}
}

// this function returns the opening CSS markup for the widget area 
function thematic_before_widget_area($hook) {
	$content =  "\n";
	if ($hook == 'primary-aside') {
		$content .= '<div id="primary" class="aside main-aside">' . "\n";
	} elseif ($hook == 'secondary-aside') {
		$content .= '<div id="secondary" class="aside main-aside">' . "\n";
	} elseif ($hook == '1st-subsidiary-aside') {
		$content .= '<div id="first" class="aside sub-aside">' . "\n";
	} elseif ($hook == '2nd-subsidiary-aside') {
		$content .= '<div id="second" class="aside sub-aside">' . "\n";
	} elseif ($hook == '3rd-subsidiary-aside') {
		$content .= '<div id="third" class="aside sub-aside">' . "\n";
	} else {
		$content .= '<div id="' . $hook . '" class="aside">' ."\n";
	}
	$content .= "\t" . '<ul class="xoxo">' . "\n";
	return apply_filters('thematic_before_widget_area', $content);
}

// this function returns the clossing CSS markup for the widget area
function thematic_after_widget_area($hook) {
	$content = "\n" . "\t" . '</ul>' ."\n";
	if ($hook == 'primary-aside') {
		$content .= '</div><!-- #primary .aside -->' ."\n";
	} elseif ($hook == 'secondary-aside') {
		$content .= '</div><!-- #secondary .aside -->' ."\n";
	} elseif ($hook == '1st-subsidiary-aside') {
		$content .= '</div><!-- #first .aside -->' ."\n";
	} elseif ($hook == '2nd-subsidiary-aside') {
		$content .= '</div><!-- #second .aside -->' ."\n";
	} elseif ($hook == '3rd-subsidiary-aside') {
		$content .= '</div><!-- #third .aside -->' ."\n";
	} else {
		$content .= '</div><!-- #' . $hook . ' .aside -->' ."\n";
	} 
	return apply_filters('thematic_after_widget_area', $content);
}

?>
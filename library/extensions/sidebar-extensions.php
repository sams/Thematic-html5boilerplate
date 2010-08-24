<?php


// Filter to create the sidebar
function thematic_sidebar() {

  $show = TRUE;

	// Filters should return Boolean 
	$show = apply_filters('thematic_sidebar', $show);
	
	if ($show) {
    get_sidebar();}
	
	return;
} // end thematic_sidebar


// Main Aside Hooks


	// Located in sidebar.php 
	// Just before the main asides (commonly used as sidebars)
	function thematic_abovemainasides() {
	    do_action('thematic_abovemainasides');
	} // end thematic_abovemainasides


	// Located in sidebar.php 
	// regular hook for primary asides
	function widget_area_primary_aside() {
	    do_action('widget_area_primary_aside');
	} // end widget_area_primary_aside
	
	
	// Located in sidebar.php 
	// Between the main asides (commonly used as sidebars)
	function thematic_betweenmainasides() {
	    do_action('thematic_betweenmainasides');
	} // end thematic_betweenmainasides


	// Located in sidebar.php 
	// regular hook for primary asides
	function widget_area_secondary_aside() {
	    do_action('widget_area_secondary_aside');
	} // end widget_area_secondary_aside
	
	
	// Located in sidebar.php 
	// after the main asides (commonly used as sidebars)
	function thematic_belowmainasides() {
	    do_action('thematic_belowmainasides');
	} // end thematic_belowmainasides
	

// Index Aside Hooks

	
	// Located in sidebar-index-top.php
	function thematic_aboveindextop() {
		do_action('thematic_aboveindextop');
	} // end thematic_aboveindextop
	

	// Located in sidebar-index-top.php
	function widget_area_index_top() {
		do_action('widget_area_index_top');
	} // end widget_area_index_top
	
	
	// Located in sidebar-index-top.php
	function thematic_belowindextop() {
		do_action('thematic_belowindextop');
	} // end thematic_belowindextop
	
	
	// Located in sidebar-index-insert.php
	function thematic_aboveindexinsert() {
		do_action('thematic_aboveindexinsert');
	} // end thematic_aboveindexinsert
	
	// ocated in sidebar-index-insert.php
	function widget_area_index_insert() {
		do_action('widget_area_index_insert');
	} // end widget_area_index_insert
	
	
	// Located in sidebar-index-insert.php
	function thematic_belowindexinsert() {
		do_action('thematic_belowindexinsert');
	} // end thematic_belowindexinsert	
	

	// Located in sidebar-index-bottom.php
	function thematic_aboveindexbottom() {
		do_action('thematic_aboveindexbottom');
	} // end thematic_aboveindexbottom
	
	// Located in sidebar-index-bottom.php
	function widget_area_index_bottom() {
		do_action('widget_area_index_bottom');
	} // end widget_area_index_bottom
	
	
	// Located in sidebar-index-bottom.php
	function thematic_belowindexbottom() {
		do_action('thematic_belowindexbottom');
	} // end thematic_belowindexbottom	
	
	
// Single Post Asides


	// Located in sidebar-single-top.php
	function thematic_abovesingletop() {
		do_action('thematic_abovesingletop');
	} // end thematic_abovesingletop


	// Located in sidebar-single-top.php
	function widget_area_single_top() {
		do_action('widget_area_single_top');
	} // end thematic_abovesingletop
	
	
	// Located in sidebar-single-top.php
	function thematic_belowsingletop() {
		do_action('thematic_belowsingletop');
	} // end thematic_belowsingletop
	
	
	// Located in sidebar-single-insert.php
	function thematic_abovesingleinsert() {
		do_action('thematic_abovesingleinsert');
	} // end thematic_abovesingleinsert
	
	
	// Located in sidebar-single-insert.php
	function widget_area_single_insert() {
		do_action('widget_area_single_insert');
	} // end thematic_abovesingleinsert
	
	
	// Located in sidebar-single-insert.php
	function thematic_belowsingleinsert() {
		do_action('thematic_belowsingleinsert');
	} // end thematic_belowsingleinsert	
	

	// Located in sidebar-single-bottom.php
	function thematic_abovesinglebottom() {
		do_action('thematic_abovesinglebottom');
	} // end thematic_abovesinglebottom
	

	// Located in sidebar-single-bottom.php
	function widget_area_single_bottom() {
		do_action('widget_area_single_bottom');
	} // end widget_area_single_bottom
	
	
	// Located in sidebar-single-bottom.php
	function thematic_belowsinglebottom() {
		do_action('thematic_belowsinglebottom');
	} // end thematic_belowsinglebottom	
	


// Page Aside Hooks


	// Located in sidebar-page-top.php
	function thematic_abovepagetop() {
		do_action('thematic_abovepagetop');
	} // end thematic_abovepagetop


	// Located in sidebar-page-top.php
	function widget_area_page_top() {
		do_action('widget_area_page_top');
	} // end widget_area_page_top
	
	
	// Located in sidebar-page-top.php
	function thematic_belowpagetop() {
		do_action('thematic_belowpagetop');
	} // end thematic_belowpagetop


	// Located in sidebar-page-bottom.php
	function thematic_abovepagebottom() {
		do_action('thematic_abovepagebottom');
	} // end thematic_abovepagebottom


	// Located in sidebar-page-bottom.php
	function widget_area_page_bottom() {
		do_action('widget_area_page_bottom');
	} // end widget_area_page_bottom

	
	// Located in sidebar-page-bottom.php
	function thematic_belowpagebottom() {
		do_action('thematic_belowpagebottom');
	} // end thematic_belowpagebottom	



// Subsidiary Aside Hooks
	

	// Located in sidebar-subsidiary.php
	function thematic_abovesubasides() {
		do_action('thematic_abovesubasides');
	} // end thematic_abovesubasides
	

	// Located in sidebar-subsidiary.php
	function thematic_belowsubasides() {
		do_action('thematic_belowsubasides');
	} // end thematic_belowsubasides
    
    function thematic_subsidiaryopen() {
        if ( is_sidebar_active('1st-subsidiary-aside') || is_sidebar_active('2nd-subsidiary-aside') || is_sidebar_active('3rd-subsidiary-aside') ) { // one of the subsidiary asides has a widget ?>
            
            <div id="subsidiary">
            
        <?php
        }
    }
    add_action('widget_area_subsidiaries', 'thematic_subsidiaryopen', 10);
	

	// Located in sidebar-subsidiary.php
	function thematic_before_first_sub() {
		do_action('thematic_before_first_sub');
	} // end thematic_before_first_sub
    
    function add_before_first_sub() {
        if ( is_sidebar_active('1st-subsidiary-aside') || is_sidebar_active('2nd-subsidiary-aside') || is_sidebar_active('3rd-subsidiary-aside') ) { // one of the subsidiary asides has a widget
            thematic_before_first_sub();
        }
    }
    add_action('widget_area_subsidiaries', 'add_before_first_sub',20);

	// Located in sidebar-subsidiary.php
	function widget_area_subsidiaries() {
		do_action('widget_area_subsidiaries');
	} // end widget_area_1st_subsidiary_aside

	// Located in sidebar-subsidiary.php
	function thematic_between_firstsecond_sub() {
		do_action('thematic_between_firstsecond_sub');
	} // end thematic_between_firstsecond_sub
    
    function add_between_firstsecond_sub() {
        if ( is_sidebar_active('1st-subsidiary-aside') || is_sidebar_active('2nd-subsidiary-aside') || is_sidebar_active('3rd-subsidiary-aside') ) { // one of the subsidiary asides has a widget
            thematic_between_firstsecond_sub();
        }
    }
    add_action('widget_area_subsidiaries', 'add_between_firstsecond_sub',40);


	// Located in sidebar-subsidiary.php
	function thematic_between_secondthird_sub() {
		do_action('thematic_between_secondthird_sub');
	} // end thematic_between_secondthird_sub
    
    function add_between_secondthird_sub() {
        if ( is_sidebar_active('1st-subsidiary-aside') || is_sidebar_active('2nd-subsidiary-aside') || is_sidebar_active('3rd-subsidiary-aside') ) { // one of the subsidiary asides has a widget
            thematic_between_secondthird_sub();
        }
    }
    add_action('widget_area_subsidiaries', 'add_between_secondthird_sub',60);
	
	
	// Located in sidebar-subsidiary.php
	function thematic_after_third_sub() {
		do_action('thematic_after_third_sub');
	} // end thematic_after_third_sub	

    
    function add_after_third_sub() {
        if ( is_sidebar_active('1st-subsidiary-aside') || is_sidebar_active('2nd-subsidiary-aside') || is_sidebar_active('3rd-subsidiary-aside') ) { // one of the subsidiary asides has a widget
            thematic_after_third_sub();
        }
    }
    add_action('widget_area_subsidiaries', 'add_after_third_sub',80);
    
    function thematic_subsidiaryclose() {
        if ( is_sidebar_active('1st-subsidiary-aside') || is_sidebar_active('2nd-subsidiary-aside') || is_sidebar_active('3rd-subsidiary-aside') ) { // one of the subsidiary asides has a widget ?>
            
            </div><!-- #subsidiary -->
            
        <?php
        }
    }
    add_action('widget_area_subsidiaries', 'thematic_subsidiaryclose', 200);

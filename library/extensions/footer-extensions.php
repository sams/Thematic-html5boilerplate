<?php


// Located in footer.php
// Just before the footer div
function thematic_abovefooter() {
    do_action('thematic_abovefooter');
} // end thematic_abovefooter

// Located in footer.php
// Just after the footer div
function thematic_footer() {
    do_action('thematic_footer');
} // end thematic_footer      

    add_action('thematic_footer', 'thematic_scripts', 1);


// located in footer.php
// the footer text can now be filtered and controlled from your own functions.php
function thematic_footertext($thm_footertext) {
    $thm_footertext = apply_filters('thematic_footertext', $thm_footertext);
    return $thm_footertext;
} // end thematic_footertext


// Located in footer.php
// Just after the footer div
function thematic_belowfooter() {
    do_action('thematic_belowfooter');
} // end thematic_belowfooter


// Located in footer.php 
// Just before the closing body tag, after everything else.
function thematic_after() {   
    do_action('thematic_after');   
    
    
    print $scripts;
} // end thematic_after


// Functions that hook into thematic_footer()

    function thematic_subsidiaries() {
        widget_area_subsidiaries();
    }
    add_action('thematic_footer', 'thematic_subsidiaries', 10);

    function thematic_jqueryalt() { ?>
    
		<script>!window.jQuery && document.write('<script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/jquery-1.4.2.min.js"><\/script>')</script>
    
    <?php
    }
    add_action('thematic_footer', 'thematic_jqueryalt', 50);

    function thematic_ifieblock() {
	?>
	<!--[if lt IE 7 ]>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/dd_belatedpng.js"></script>
		<script>
		DD_belatedPNG.fix('img, .png_bg');
		</script>
	<![endif]-->
    <?php
    }
    add_action('thematic_footer', 'thematic_ifieblock', 50);
    
    function thematic_googleanalytics() {
    	global $my_shortname;
		$ga = stripslashes(get_option($my_shortname . '_googleanalytics'));
		if($ga == 'YOAST') {
		// yoast ga needs to be in the header
			yoast_analytics(); 
			return;
		}
		if(!$ga || $ga == 'false' || $ga == '') {
			return;
		}
	?>
    
		<!-- BEGIN thematic_googleanalytics -->
		<script>
		   var _gaq = [['_setAccount', '<?php echo $ga; ?>'], ['_trackPageview']];
		   (function(d, t) {
		    var g = d.createElement(t),
		        s = d.getElementsByTagName(t)[0];
		    g.async = true;
		    g.src = '//www.google-analytics.com/ga.js';
		    s.parentNode.insertBefore(g, s);
		   })(document, 'script');
		</script>
		<!-- END thematic_googleanalytics -->

	<?php
	}
	add_action('thematic_footer', 'thematic_googleanalytics', 60);

	function thematic_yahooprofiler() {
		global $my_shortname;
		$yp = stripslashes(get_option($my_shortname . '_yahooprofile'));
		//echo "<!-- yahoo profiling ? {$yp} -->"; return;
		if(!$yp || $yp == 'false' || $yp == '') {
			return;
		}
		?>
		<!-- BEGIN thematic_yahooprofiler - move to scripts/ => js/ -->
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/profiling/yahoo-profiling.min.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/profiling/config.js"></script>
		<!-- END thematic_yahooprofiler -->

	<?php
	}
    add_action('thematic_footer', 'thematic_yahooprofiler', 50);

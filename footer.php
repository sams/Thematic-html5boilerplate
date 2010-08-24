<?php
/**
 * @package WordPress
 * @subpackage Thematic PFT
 */
?>

	</div><!-- #main.body -->

	<footer id="footer" class="foot">
		<div id="colophon">

<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>

			<div id="site-info">
				<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</div><!-- #site-info -->
			<div id="site-generator">
				<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'themename' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s.', 'themename' ), 'WordPress' ); ?></a>
			</div>
		</div><!-- #colophon -->
	</footer><!-- #footer -->
</div><!-- #page.container -->

<?php wp_footer(); ?>


  <!-- this should be moved to a footer hook Grab Google CDN's jQuery. fall back to local if neccessary -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script>!window.jQuery && document.write('<script src="<?php echo get_stylesheet_directory_uri(); ?>/library/scripts/jquery-1.4.2.min.js"><\/script>')</script>
  <!-- WP-Minify JS -->
  
  <!--[if lt IE 7 ]>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/library/scripts/dd_belatedpng.js"></script>
  <![endif]-->

  <?php if($profiling): ?>
  <!-- yui profiler and profileviewer - remove for production -->
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/library/scripts/profiling/yahoo-profiling.min.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/library/scripts/profiling/config.js"></script>
  <!-- end profiling code -->
  <?php endif; ?>
</body>
</html>
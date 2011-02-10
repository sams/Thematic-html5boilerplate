<?php
/**
 * @package WordPress
 * @subpackage Thematic post.php
 */
?>
                
	</section><!-- #content.body -->
		<?php
    		thematic_abovefooter();
		?>

	<footer id="footer" class="foot" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with four columns of widgets.
				 */
				get_sidebar('footer');
				thematic_footer();
			?>
		<!-- div id="colophon">

			<div id="site-info">
				<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</div><!-- #site-info -->
			<div id="site-generator">
				<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'themename' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s.', 'themename' ), 'WordPress' ); ?></a>
			</div>

		</div><!- - #colophon -->

	</footer><!-- #footer -->

<?php
    thematic_belowfooter();
    
    if (apply_filters('thematic_close_wrapper', true)) {
    	//echo '</div><!-- #wrapper .hfeed -->';
    }

	wp_footer();

// action hook for placing content before closing the BODY tag
thematic_after(); 
 ?>
</body>
</html>
<?php
    
    // ob_flush();    flush();
?>
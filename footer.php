<?php
/**
 * @package WordPress
 * @subpackage Thematic PFT
 */
?>

	</section><!-- #main.body -->

	<footer id="footer" class="foot">
		<div id="colophon">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with four columns of widgets.
				 */
				get_sidebar('footer');
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

<?php wp_footer(); thematic_footer(); ?>
</body>
</html>
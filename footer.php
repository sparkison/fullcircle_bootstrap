<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package fullcircle_bootstrap
 */

?>

	</div><!-- #content -->
	</div><!-- .row -->

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">

				<footer id="colophon" class="site-footer" role="contentinfo">
					<div class="site-info">
						<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'fullcircle_bootstrap' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'fullcircle_bootstrap' ), 'WordPress' ); ?></a>
						<span class="sep"> | </span>
						<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'fullcircle_bootstrap' ), '<a href="https://github.com/sparkison/fullcircle_bootstrap" target="_blank">fullcircle_bootstrap</a>', '<a href="http://www.fullcirclegfx.com/" target="_blank" rel="designer">Full Circle Graphics</a>' ); ?>
					</div><!-- .site-info -->
				</footer><!-- #colophon -->
			</div>
		</div>
	</div>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

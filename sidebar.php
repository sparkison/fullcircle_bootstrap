<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package fullcircle_bootstrap
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area col-md-4" role="complementary" style="padding-top: 42px">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->

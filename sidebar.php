<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package fullcircle_bootstrap
 */
?>

<div id="secondary" class="col-md-4" role="complementary" style="padding-top: 40px;">
    <div class="widget-area">

        <?php do_action( 'before_sidebar' ); ?>
        <?php if ( !dynamic_sidebar( 'sidebar-1' ) ) : ?>

            <aside id="search" class="widget widget_search">
                <?php get_search_form(); ?>
            </aside>

            <aside id="archives" class="widget">
                <h1 class="widget-title"><?php _e( 'Archives', 'fullcircle_bootstrap' ); ?></h1>
                <ul>
                    <?php wp_get_archives( array('type' => 'monthly') ); ?>
                </ul>
            </aside>

            <aside id="meta" class="widget">
                <h1 class="widget-title"><?php _e( 'Meta', 'fullcircle_bootstrap' ); ?></h1>
                <ul>
                    <?php wp_register(); ?>
                    <li><?php wp_loginout(); ?></li>
                    <?php wp_meta(); ?>
                </ul>
            </aside>

        <?php endif; // end sidebar widget area ?>
    </div>
</div><!-- #secondary .widget-area -->

<?php if ( ! fox56() ) { include_once(dirname( __FILE__ ).'/v55/woocommerce.php'); return; } ?>
<?php get_header();
    // Start the loop.
    if ( have_posts() ) :
        $cl = [ 'woo56', 'single56', 'page56' ];
        $sidebar_state = get_theme_mod( 'shop_sidebar_state', 'no-sidebar' );
        $has_sidebar = false;
        if ( $sidebar_state == 'sidebar-left' ) {
            $cl[] = 'hassidebar';
            $cl[] = 'hassidebar--left';
            $has_sidebar = true;
        } elseif ( $sidebar_state == 'sidebar-right' ) {
            $cl[] = 'hassidebar';
            $cl[] = 'hassidebar--right';
            $has_sidebar = true;
        } else {
            $cl[] = 'no-sidebar';
        }
        if ( $has_sidebar ) {
            if ( get_theme_mod( 'sticky_sidebar' ) ) {
                $cl[] = 'hassidebar--sticky';
            }
        }
?>
<div id="wi-content" <?php post_class( $cl ); ?>>

    <div class="container container--main single56__outer">
        <div class="primary56">
            <?php fox56_shop_header(); ?>
            <?php woocommerce_content(); ?>
        </div><!-- .primary56 -->
        <?php if ( $has_sidebar ) { fox56_shop_sidebar(); } ?>
    </div>
    
</div><!-- .woo56 -->
    
<?php
// End the loop.
endif;

get_footer();
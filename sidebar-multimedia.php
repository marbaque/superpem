<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Super_PEM
 */
if (!is_active_sidebar( 'sidebar-3' )) {
    return;
}
?>

<aside id="multimedia-secondary" class="widget-area multimedia-sidebar" role="complementary">
    <?php dynamic_sidebar( 'sidebar-3' ); ?>
</aside><!-- #secondary -->

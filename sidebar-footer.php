<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Super_PEM
 */

if ( ! is_active_sidebar( 'footer-1' ) ) {
	return;
}
?>

<aside id="secondary" class="footer-widget-area footer-widgets" role="complementary">
	<?php dynamic_sidebar( 'footer-1' ); ?>
</aside><!-- #secondary -->

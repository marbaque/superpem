<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Super_PEM
 */
?>

        </div><!-- #content -->

        <?php get_sidebar('footer'); ?>
        
        <a href="#" class="topscroll">
            <?php echo __('Back to top', 'superpem'); ?>
        </a>

        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="site-info">
                <?php wp_nav_menu(array('theme_location' => 'creditos-menu', 'menu_id' => 'creditos-menu')); ?>
            </div><!-- .site-info -->
        </footer><!-- #colophon -->
        </div><!-- #page -->

        <?php wp_footer(); ?>

    </body>
</html>

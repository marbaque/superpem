<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Super_PEM
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if (has_post_thumbnail()) { ?>

        <figure class="imagen-destacada full-bleed">
            <?php
            the_post_thumbnail('superpem-full-bleed');
            ?>
        </figure>
    <?php } ?>



    <div class="entry-content post-content">
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header><!-- .entry-header -->
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'superpem'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <?php
    get_sidebar('page');
    ?>


</article><!-- #post-## -->

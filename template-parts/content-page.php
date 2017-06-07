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
    
    <?php 
    if ( has_post_thumbnail() ) { ?>
    
    <figure class="imagen-destacada full-bleed">
        <?php
        the_post_thumbnail( 'superpem-full-bleed' );
        ?>
    </figure>
    <?php } ?>
    
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header><!-- .entry-header -->

    <div class="entry-content post-content">
        <?php
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'superpem'),
                'after' => '</div>',
            ));
        ?>
    </div><!-- .entry-content -->
    
    <?php
        get_sidebar( 'page' ); 
    ?>

    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    /* translators: %s: Name of current post */
                    esc_html__('Edit %s', 'superpem'), the_title('<span class="screen-reader-text">"', '"</span>', false)
                ), '<span class="edit-link">', '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-## -->

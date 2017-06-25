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

    <?php superpem_custom_breadcrumbs(); ?>



    <div class="entry-content post-content">
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header><!-- .entry-header -->

        <?php
        the_content();

        superpem_multimedia_navigation();
        ?>

    </div><!-- .entry-content -->

    <?php
    get_sidebar('multimedia');
    ?>


</article><!-- #post-## -->

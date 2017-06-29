<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Super_PEM
 */
?>

<figure class="imagen-destacada full-bleed">
    <?php
    the_post_thumbnail('superpem-full-bleed');
    ?>
</figure>

<div class="tools">
    <?php superpem_custom_breadcrumbs(); ?>

    <div class="mmtools">
        <a href="" class="smaller" title="<?php echo __('Smaller text', 'superpem'); ?>">A</a>
        <a href="" class="reset" title="<?php echo __('Reset text size', 'superpem'); ?>">A</a>
        <a href="" class="bigger" title="<?php echo __('Bigger text', 'superpem'); ?>">A</a>
        <a href="" class="pdf" title="<?php echo __('Dowload PDF file', 'superpem'); ?>">PDF</a>
    </div>

</div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if (has_post_thumbnail()) { ?>


    <?php } ?>





    <div class="entry-content post-content">
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header><!-- .entry-header -->

        <?php
        the_content();

        getPrevNext();
        ?>


    </div><!-- .entry-content -->

    <?php
    get_sidebar('multimedia');
    ?>


</article><!-- #post-## -->

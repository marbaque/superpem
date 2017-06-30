<?php
/**
 * Template part for displaying page content in single-multimedia.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Super_PEM
 */
?>

<?php if (has_post_thumbnail()) { ?>
    <figure class="imagen-destacada full-bleed">
        <?php
        the_post_thumbnail('superpem-full-bleed');
        ?>
    </figure>

<?php } ?>

<div class="tools-container">
    <?php superpem_custom_breadcrumbs(); ?>

    <div class="mmtools">
        <?php
        if (function_exists('zeno_font_resizer_place')) {
            ?>
        <span class="label">Tamaño de texto</span>
            <?php
            zeno_font_resizer_place();
        }
        ?>
    </div>

</div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



    <div class="entry-content post-content">
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header><!-- .entry-header -->

        <div class="entry-meta">
            <--! agregar autor aqui, no seria visible -->
        </div><!-- .entry-meta -->

        <?php
        the_content();

        getPrevNext();
        ?>


    </div><!-- .entry-content -->

    <?php
    get_sidebar('multimedia');
    ?>


</article><!-- #post-## -->

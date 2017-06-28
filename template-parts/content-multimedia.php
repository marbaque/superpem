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

    <div class="mmtools">
        <a href="" class="smaller"></a>
        <a href="" class="reset"></a>
        <a href="" class="bigger"></a>
        <a href="" class="pdf"></a>
    </div>


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

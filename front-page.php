<?php
/**
 * The template for displaying the front page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Super_PEM
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" class="flex-container">

                <div class="col uno">


                    <div class="entry-content">
                        <?php
                        the_content();
                        ?>
                    </div><!-- .entry-content -->
                </div>

                
                <?php if (has_post_thumbnail($post->ID)): ?>
                <div class="col dos">
                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "single-post-thumbnail"); ?>
                </div>
                <?php endif; ?>
                


            </article><!-- #post-## -->



        <?php endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();

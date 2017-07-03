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


<?php

/**
 * Plugin Name: Páginas de contenidos principales para multimedia
 * Description: Simple plugin que agrega custom post types
 * 
 */
function my_custom_posttypes() {

    //Artículos de prensa
    $labels = array(
        'name' => 'Contenido multimedia',
        'singular_name' => 'Contenido multimedia',
        'menu_name' => 'Contenido multimedia',
        'name_admin_bar' => 'Contenido multimedia',
        'add_new' => 'Agregar contenido nuevo',
        'add_new_item' => 'Agregar página de contenido',
        'new_item' => 'Nueva página de contenido',
        'edit_item' => 'Editar contenido multimedia',
        'view_item' => 'Ver',
        'all_items' => 'Contenido existente',
        'search_items' => 'Buscar páginas de contenido',
        'parent_item_colon' => 'Página de contenidos principales:',
        'not_found' => 'No se encontraron páginas de contenido.',
        'not_found_in_trash' => 'No hay páginas de contenidos en el basurero.',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-book',
        'query_var' => true,
        'rewrite' => array('slug' => 'contenidos'),
        'capability_type' => 'page',
        'has_archive' => false,
        'hierarchical' => true,
        'menu_position' => 5,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
            'revisions',
            'page-attributes'
        ),
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'show_in_rest' => true
    );
    register_post_type('multimedia', $args);
}

add_action('init', 'my_custom_posttypes');

function my_rewrite_flush() {
    my_custom_posttypes();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'my_rewrite_flush');

// Custom Taxonomies
function custom_taxonomies() {

    // Nombre del proyecto asignado a cada investigador (puede estar en varios!)
    $labels = array(
        'name' => 'Autores',
        'singular_name' => 'Autor',
        'search_items' => 'Buscar autor',
        'all_items' => 'Todos',
        'parent_item' => 'ID principal de autor',
        'parent_item_colon' => 'ID principal de autor:',
        'edit_item' => 'Editar autor',
        'update_item' => 'Actualizar autor asignado',
        'add_new_item' => 'Agregar nombre de autor(a)',
        'new_item_name' => 'Nuevo nombre de autor',
        'menu_name' => 'Autor asignado',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'autor'),
    );

    register_taxonomy('autor', array('multimedia'), $args);
}

add_action('init', 'custom_taxonomies');





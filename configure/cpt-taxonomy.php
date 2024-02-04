<?php

// Função personalizada para registrar um tipo de postagem "ensaio"// Função personalizada para registrar um tipo de postagem "ensaio"
function cpt_ensaio() {
    $labels = array(
      'name'               => __( 'Ensaios' ),
      'singular_name'      => __( 'Ensaio' ),
      'add_new'            => __( 'Adicionar Novo Ensaio' ),
      'add_new_item'       => __( 'Adicionar Novo Ensaio' ),
      'edit_item'          => __( 'Editar Ensaio' ),
      'new_item'           => __( 'Novo Ensaio' ),
      'all_items'          => __( 'Todos os Ensaios' ),
      'view_item'          => __( 'Ver Ensaio' ),
      'search_items'       => __( 'Procurar Ensaios' ),
      'featured_image'     => 'Imagem Destacada',
      'set_featured_image' => 'Adicionar Imagem Destacada'
    );
   
    $args = array(
      'labels'            => $labels,
      'description'       => 'Armazena nossos ensaios e dados específicos de ensaios',
      'public'            => true,
      'menu_position'     => 5,
      'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
      'has_archive'       => true,
      'show_in_admin_bar' => true,
      'show_in_nav_menus' => true,
      'has_archive'       => true,
      'menu_icon' => 'dashicons-format-gallery',
      'query_var'         => 'ensaio'
    );
   
    register_post_type( 'ensaio', $args);

    // Registra a taxonomia "Tipo de Ensaio"
    register_taxonomy(
        'tipo_ensaio',
        'ensaio',
        array(
            'label' => __( 'Tipo de Ensaio' ),
            'rewrite' => array( 'slug' => 'tipo-ensaio' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'cpt_ensaio' );

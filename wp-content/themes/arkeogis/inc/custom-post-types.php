<?php
// Register Custom Actualités
function arkeogis_news() {

  $labels = array(
    'name'                  => _x( 'Actualités', 'Actualités General Name', 'Arkeogis' ),
    'singular_name'         => _x( 'Actualité', 'Actualités Singular Name', 'Arkeogis' ),
    'menu_name'             => __( 'Actualités', 'Arkeogis' ),
    'name_admin_bar'        => __( 'Actualités', 'Arkeogis' ),
    'archives'              => __( 'Item Archives', 'Arkeogis' ),
    'attributes'            => __( 'Item Attributes', 'Arkeogis' ),
    'parent_item_colon'     => __( 'Parent Item:', 'Arkeogis' ),
    'all_items'             => __( 'All Items', 'Arkeogis' ),
    'add_new_item'          => __( 'Add New Item', 'Arkeogis' ),
    'add_new'               => __( 'Add New', 'Arkeogis' ),
    'new_item'              => __( 'New Item', 'Arkeogis' ),
    'edit_item'             => __( 'Edit Item', 'Arkeogis' ),
    'update_item'           => __( 'Update Item', 'Arkeogis' ),
    'view_item'             => __( 'View Item', 'Arkeogis' ),
    'view_items'            => __( 'View Items', 'Arkeogis' ),
    'search_items'          => __( 'Search Item', 'Arkeogis' ),
    'not_found'             => __( 'Not found', 'Arkeogis' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'Arkeogis' ),
    'featured_image'        => __( 'Featured Image', 'Arkeogis' ),
    'set_featured_image'    => __( 'Set featured image', 'Arkeogis' ),
    'remove_featured_image' => __( 'Remove featured image', 'Arkeogis' ),
    'use_featured_image'    => __( 'Use as featured image', 'Arkeogis' ),
    'insert_into_item'      => __( 'Insert into item', 'Arkeogis' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'Arkeogis' ),
    'items_list'            => __( 'Items list', 'Arkeogis' ),
    'items_list_navigation' => __( 'Items list navigation', 'Arkeogis' ),
    'filter_items_list'     => __( 'Filter items list', 'Arkeogis' ),
  );
  $args = array(
    'label'                 => __( 'Actualité', 'Arkeogis' ),
    'description'           => __( 'Actualités Arkeogis', 'Arkeogis' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 7,
    'menu_icon'             => 'dashicons-calendar-alt',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
    'show_in_rest'          => true,
  );
  register_post_type( 'arkeogis_news', $args );

}
add_action( 'init', 'arkeogis_news', 0 );
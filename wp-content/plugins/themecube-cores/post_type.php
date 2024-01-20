<?php

//PROJECT
if ( ! function_exists('cpt_room') ) {

function cpt_room() {

	$labels = array(
		'name'                  => _x( 'Rooms', 'Post Type General Name', 'escape' ),
		'singular_name'         => _x( 'Room', 'Post Type Singular Name', 'escape' ),
		'menu_name'             => __( 'Rooms', 'escape' ),
		'name_admin_bar'        => __( 'Room', 'escape' ),
		'archives'              => __( 'Room Archives', 'escape' ),
		'parent_item_colon'     => __( 'Parent Item:', 'escape' ),
		'all_items'             => __( 'All Rooms', 'escape' ),
		'add_new_item'          => __( 'Add New Room', 'escape' ),
		'add_new'               => __( 'Add New', 'escape' ),
		'new_item'              => __( 'New Room', 'escape' ),
		'edit_item'             => __( 'Edit Room', 'escape' ),
		'update_item'           => __( 'Update Room', 'escape' ),
		'view_item'             => __( 'View Room', 'escape' ),
		'search_items'          => __( 'Search Room', 'escape' ),
		'not_found'             => __( 'Not found', 'escape' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'escape' ),
		'featured_image'        => __( 'Featured Image', 'escape' ),
		'set_featured_image'    => __( 'Set featured image', 'escape' ),
		'remove_featured_image' => __( 'Remove featured image', 'escape' ),
		'use_featured_image'    => __( 'Use as featured image', 'escape' ),
		'insert_into_item'      => __( 'Insert into item', 'escape' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'escape' ),
		'items_list'            => __( 'Items list', 'escape' ),
		'items_list_navigation' => __( 'Items list navigation', 'escape' ),
		'filter_items_list'     => __( 'Filter items list', 'escape' ),
	);
	$args = array(
		'label'                 => __( 'Room', 'escape' ),
		'description'           => __( 'Post Type Description', 'escape' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-admin-network',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'room', $args );

}
add_action( 'init', 'cpt_room', 0 );

}


// Testimonial 
add_action( 'init', 'testimonials_init' );
function testimonials_init() { 
    
    $labels = array(
        'name'               => _x( 'Testimonials', 'post type general name', 'escape' ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name', 'escape' ),
        'menu_name'          => _x( 'Testimonials', 'admin menu', 'escape' ),
        'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'escape' ),
        'add_new'            => _x( 'Add New Testimonial', 'Testimonial', 'escape' ),
        'add_new_item'       => __( 'Add New Testimonial', 'escape' ),
        'new_item'           => __( 'New Testimonial', 'escape' ),
        'edit_item'          => __( 'Edit Testimonial', 'escape' ),
        'view_item'          => __( 'View Testimonial', 'escape' ),
        'all_items'          => __( 'All Testimonials', 'escape' ),
        'search_items'       => __( 'Search Testimonials', 'escape' ),
        'parent_item_colon'  => __( 'Parent Testimonials:', 'escape' ),
        'not_found'          => __( 'No Testimonials found.', 'escape' ),
        'not_found_in_trash' => __( 'No Testimonials found in Trash.', 'escape' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-format-quote',
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonial' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 22,
        'supports'           => array( 'title', 'editor','thumbnail',)
    );

    register_post_type( 'testimonial', $args );
}


?>
<?php

add_action( 'cmb2_init', 'tc_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function tc_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_tc_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'header_metabox',
        'title'         => esc_html__( 'Header Options', 'escape' ),
        'object_types'  => array( 'page', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ) );

	//Header Background
    $cmb->add_field( array(
		'name' => esc_html__( 'Header Background Image', 'escape' ),
		'desc' => esc_html__( 'Upload an image or enter a URL.', 'escape' ),
		'id'   => $prefix . 'header_bg',
		'type' => 'file',
	) );

    // Overlay Background Color
    $cmb->add_field( array(
        'name'    => esc_html__( 'Overlay Background Color', 'escape' ),
		'id'   => $prefix . 'overlay_bg',
		'type' => 'rgba_colorpicker',
		'default'  => 'rgba(0,0,0, 0.0)',
    ) );
	
	// Header Color
	$cmb->add_field( array(
		'name'    => 'Title Color',
		'id'      => $prefix . 'title_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );
	
	// Subheader
   $cmb->add_field( array(
		'name'       => esc_html__( 'Subhead', 'escape' ),
		'id'         => $prefix . 'subhead',
		'type'       => 'text',
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		
		// 'repeatable'      => true,
	) );
	
	
	
	//Room
	$cmb = new_cmb2_box( array(
        'id'            => 'room_metabox',
        'title'         => esc_html__( 'Room Details', 'escape' ),
        'object_types'  => array( 'room', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ) );

	
	
	// Difficulty
   $cmb->add_field( array(
		'name'       => esc_html__( 'Difficulty', 'escape' ),
		'id'         => $prefix . 'difficulty',
		'type'       => 'text_medium',
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
	) );
	
	// Duration
	$cmb->add_field( array(
		'name'       => esc_html__( 'Duration', 'escape' ),
		'id'         => $prefix . 'duration',
		'type'       => 'text_small',
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
	) );
	
	//Size
	$cmb->add_field( array(
		'name'       => esc_html__( 'Group Size', 'escape' ),
		'id'         => $prefix . 'size',
		'type'       => 'text_small',
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
	) );
	
	//Escape Rate
	$cmb->add_field( array(
		'name'       => esc_html__( 'Escape Rate', 'escape' ),
		'id'         => $prefix . 'escape_percentage',
		'type'       => 'text_small',
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
	) );
	
	//Escape Rate
	$cmb->add_field( array(
		'name'       => esc_html__( 'Best Time', 'escape' ),
		'id'         => $prefix . 'best_time',
		'type'       => 'text_small',
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
	) );
	
	
	//Image Gallery
	$cmb->add_field( array(
		'name' => 'Room Gallery',
		'id'   => 'room_file_list',
		'type' => 'file_list',
		// 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );
	
	//Room Video
	$cmb->add_field( array(
		'name' => 'Room Video',
		'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
		'id'   => 'room_video',
		'type' => 'oembed',
	) );
	
	
	//////////////////////////////

	
	

	//////////////////////////////
	
	//TESTIMONIAL
	$cmb = new_cmb2_box( array(
        'id'            => 'testimonial_mtbx',
        'title'         => esc_html__( 'Author Info', 'escape' ),
        'object_types'  => array( 'testimonial', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
		//'show_on'      => array( 'key' => 'page-template', 'value' => 'woocommerce.php' )
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    	
	// Subheader
   $cmb->add_field( array(
		'name'       => esc_html__( 'Author Name', 'escape' ),
		'id'         => $prefix . 'author_name',
		'type'       => 'text',
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		
		// 'repeatable'      => true,
	) );
	
	
	//EMBED MEDIA
	 $cmb = new_cmb2_box( array(
        'id'            => 'post_embed',
        'title'         => esc_html__( 'Post Options', 'escape' ),
        'object_types'  => array('post'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
		//'show_on'      => array( 'key' => 'page-template', 'value' => 'woocommerce.php' )
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

	//Header Background
    $cmb->add_field( array(
    'name' => 'oEmbed',
    'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
    'id' =>  'media_embed',
    'type' => 'oembed',
) );

    
}
	
	



?>
<?php
/**
 * Escape functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Escape
 */

if ( ! function_exists( 'escape_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function escape_setup() {
	
	//THEME OPTIONS
	require get_template_directory() . '/admin/admin-init.php';	
	global $escape_global_var;
	global $font_icons; 

	$escape_global_var = get_option('escape_global_var');
	


	//CMB2
	if ( file_exists( get_template_directory() . '/admin/cmb2/init.php' ) ) {
		require_once get_template_directory() . '/admin/cmb2/init.php';
	} elseif ( file_exists( get_template_directory() . '/admin/CMB2/init.php' ) ) {
		require_once get_template_directory() . '/admin/CMB2/init.php';
	}
	
	include get_template_directory() . '/admin/cmb2/metabox-functions.php';
	
	
	
	// Register Custom Navigation Walker
	require_once get_template_directory() . '/admin/wp_bootstrap_navwalker.php';

	//WIDGET
	require_once get_template_directory() . '/admin/widget-recent-posts.php';
	
	
	//REDUX NOTICES DISABLE

	function escape_removeDemoModeLink() { // Be sure to rename this function to something more unique
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
		}
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
		}
	}
	add_action('init', 'escape_removeDemoModeLink');
	

	function escape_remove_redux_menu() {
	    remove_submenu_page('tools.php','redux-about');
	    remove_submenu_page('themes.php','redux-about');
	    remove_submenu_page('themes.php','redux-changelog');
	    remove_submenu_page('themes.php','redux-extensions');
	    remove_submenu_page('themes.php','redux-support');
	    remove_submenu_page('themes.php','redux-extensions');
	    remove_submenu_page('themes.php','redux-credits');
	    remove_submenu_page('themes.php','redux-status');
	}
	add_action( 'admin_menu', 'escape_remove_redux_menu',12 );


	//WOOCOMMERCE SUPPORT
	add_theme_support( 'woocommerce' );

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Escape, use a find and replace
	 * to change 'escape' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'escape', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'escape' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'escape_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // escape_setup
add_action( 'after_setup_theme', 'escape_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function escape_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'escape_content_width', 640 );
}
add_action( 'after_setup_theme', 'escape_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function escape_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'escape' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar', 'escape' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
}
add_action( 'widgets_init', 'escape_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function escape_scripts() {
	//wp_enqueue_script("google-maps-api", "http://maps.google.com/maps/api/js?sensor=false",array(),false,true);
	wp_enqueue_script("bootstrap-min", get_template_directory_uri()."/js/bootstrap.min.js",array('jquery'),false,true);
	wp_enqueue_script("retina", get_template_directory_uri()."/js/retina.min.js",array(),false,true);
	wp_enqueue_script("owl-carousel", get_template_directory_uri()."/js/owl.carousel.min.js",array(),false,true);
	wp_enqueue_script("waypoints", get_template_directory_uri()."/js/waypoints.min.js",array(),false,true);
	wp_enqueue_script("counterup", get_template_directory_uri()."/js/jquery.counterup.min.js",array(),false,true);
	wp_enqueue_script("magnific-popup", get_template_directory_uri()."/js/jquery.magnific-popup.min.js",array(),false,true);
	wp_enqueue_script("instafeed", get_template_directory_uri()."/js/instafeed.min.js",array(),false,true);
	wp_enqueue_script("main", get_template_directory_uri()."/js/main.js",array(),false,true);
	
	
	/* styles */
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');
	wp_enqueue_style( 'pe-7-icon', get_template_directory_uri().'/css/pe-icon-7-stroke.css');
	wp_enqueue_style( 'helper', get_template_directory_uri().'/css/helper.css');
	wp_enqueue_style( 'pe-icon-social', get_template_directory_uri().'/css/pe-icon-social.css');
	wp_enqueue_style( 'icomoon', get_template_directory_uri().'/css/icomoon.css');
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri().'/css/magnific-popup.css');
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/css/owl.carousel.css');
	wp_enqueue_style( 'owl-theme', get_template_directory_uri().'/css/owl.theme.css');
	wp_enqueue_style( 'owl-transition', get_template_directory_uri().'/css/owl.transitions.css');
	wp_enqueue_style( 'custom-room-cornubia', get_template_directory_uri().'/css/custom-room-cornubia.css');
	wp_enqueue_style( 'escape-style', get_stylesheet_uri(), true, '1.0', 'all' );

	wp_enqueue_style( 'style-css', get_template_directory_uri().'/style.php', true, '1.0', 'all');




	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'escape_scripts' );

//CUSTOM CSS
if (!function_exists('escape_custom_css')) {
		function escape_custom_css(){
			$escape_global_var = get_option('escape_global_var');

			if (!empty($escape_global_var['css_editor'])){

				echo '<style type="text/css"> '.$escape_global_var['css_editor'].'</style>';
			} else
				echo "";

		}
}

add_action('wp_enqueue_style','escape_custom_css');

//CUSTOM JS
if (!function_exists('escape_custom_js')) {
		function escape_custom_js(){
			$escape_global_var = get_option('escape_global_var');

			if (!empty($escape_global_var['js_editor'])){

				echo '<script> '.$escape_global_var['js_editor'].'</script>';
			}

		}
}

add_action('wp_enqueue_script','escape_custom_js');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



function escape_do_shortcode($content) {
    global $shortcode_tags;
    if (empty($shortcode_tags) || !is_array($shortcode_tags))
        return $content;
    $pattern = get_shortcode_regex();
    return preg_replace_callback( "/$pattern/s", 'do_shortcode_tag', $content );
}

/* Visual Composer */
if(function_exists('vc_add_param')){
 
  vc_add_param('vc_row',array(
        "type" => "dropdown",
        "heading" => esc_html__('Fullwidth', 'escape'),
        "param_name" => "fullwidth",
        "value" => array(   
                esc_html__('No', 'escape') => 'no',  
                esc_html__('Yes', 'escape') => 'yes',                                                                                
                ),
        "description" => esc_html__("Select Fullwidth or not", 'escape'),      
      ) 
    );
	
	vc_add_param('vc_row_inner',array(
        "type" => "dropdown",
        "heading" => esc_html__('Fullwidth', 'escape'),
        "param_name" => "fullwidth",
        "value" => array(   
                esc_html__('No', 'escape') => 'no',  
                esc_html__('Yes', 'escape') => 'yes',                                                                                
                ),
        "description" => esc_html__("Select Fullwidth or not", 'escape'),      
      ) 
    );
	

}


if ( !function_exists( 'escape_backend_css' ) ) {
	
	function escape_backend_css() {	                           		
            wp_enqueue_style( 'pe-7-icon', get_template_directory_uri().'/css/pe-icon-7-stroke.css', false, '', 'all');
            wp_enqueue_style( 'helper', get_template_directory_uri().'/css/helper.css', false, '', 'all');
			wp_enqueue_style( 'icomoon', get_template_directory_uri().'/css/icomoon.css', false, '', 'all');
			wp_enqueue_style( 'pe-social', get_template_directory_uri().'/css/pe-icon-social.css', false, '', 'all');
			wp_enqueue_style( 'admin-css', get_template_directory_uri().'/css/admin.css', false, '', 'all' );
        }
		        
	// Pe Icon fonts for backend
    add_action( 'admin_enqueue_scripts', 'escape_backend_css' );                   
}


/* Read More */
if ( !function_exists( 'escape_modify_read_more_link' ) ) {
    function escape_modify_read_more_link() {

        global $escape_global_var;
        $read_more_text = isset( $escape_global_var['blog-continue-reading'] ) ? sanitize_text_field( $escape_global_var['blog-continue-reading'] ) : esc_html__( 'Read more', 'escape' );
        return '<a class="read-more-button" href="' . get_permalink() . '">' . $read_more_text . '<span class="screen-reader-text">of the title of post</span></a>';
    }
    add_filter( 'the_content_more_link', 'escape_modify_read_more_link' );
  }
  
/*  */
if ( !function_exists( 'escape_get_the_excerpt_max_charlength' ) ) {
    function escape_get_the_excerpt_max_charlength( $charlength ) {
    	$excerpt = get_the_excerpt();
        
    	$charlength++;
    
    	if ( mb_strlen( $excerpt ) > $charlength ) {
    		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
    		$exwords = explode( ' ', $subex );
    		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
    		if ( $excut < 0 ) {
    			$subex = mb_substr( $subex, 0, $excut );
    		} 
    		$subex .= '...';
            $excerpt = $subex;
    	} 
        
        return $excerpt;
    }   
}


//Rooms Excerpt
function escape_get_the_room_excerpt(){
	$excerpt = get_the_content();
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$the_str = substr($excerpt, 0, 150);
	return $the_str;
}

function wpb_custom_billing_fields( $fields = array() ) {
 unset($fields['billing_company']);
 unset($fields['billing_address_1']);
 unset($fields['billing_address_2']);
 unset($fields['billing_state']);
 unset($fields['billing_city']);
 //unset($fields['billing_phone']);
 unset($fields['billing_postcode']);
 unset($fields['billing_country']);
 return $fields;
}
add_filter('woocommerce_billing_fields','wpb_custom_billing_fields');

add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
add_filter( 'woocommerce_checkout_fields' , 'remove_order_notes' );
function remove_order_notes( $fields ) {
 unset($fields['order']['order_comments']);
 return $fields;
}

remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );  //main image
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );  ///title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );  //from price
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );  //can you solve the myster
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );
remove_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );
remove_action( 'woocommerce_review_comment_text', 'woocommerce_review_display_comment_text', 10 );

/* Add to the functions.php file of your theme */ 
add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); function woo_custom_order_button_text() { return __( 'Book Now!', 'woocommerce' ); }
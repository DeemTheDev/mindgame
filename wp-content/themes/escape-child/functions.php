<?php
/**
 * Setup Escape Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function escape_child_theme_setup() {
	load_child_theme_textdomain( 'escape-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'escape_child_theme_setup' );

function wpb_custom_billing_fields( $fields = array() ) {
 unset($fields['billing_company']);
 unset($fields['billing_address_1']);
 unset($fields['billing_address_2']);
 unset($fields['billing_state']);
 unset($fields['billing_city']);
 unset($fields['billing_phone']);
 unset($fields['billing_postcode']);
 unset($fields['billing_country']);
 return $fields;
}
add_filter('woocommerce_billing_fields','wpb_custom_billing_fields');

add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); function woo_custom_order_button_text() { return __( 'Book Now!', 'woocommerce' ); }

// Add Code is here.
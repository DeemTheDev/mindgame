<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Escape for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */


require_once get_template_directory() . '/admin/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'escape_register_required_plugins' );


function escape_register_required_plugins() {
	

	$plugins = array(

		

		array(
			'name' 	   => 'Redux Framework',
			'slug' 	   => 'redux-framework',
			'required' => true,
		),
		
		array(
            'name'               => 'Visual Composer', 
            'slug'               => 'js_composer', 
            'source'             => get_template_directory() . '/plugins/js_composer.zip', 
            'required'           => true, 
        ),
		
		array(
            'name'               => 'Revolution Slider', 
            'slug'               => 'revslider', 
            'source'             => get_template_directory() . '/plugins/revslider.zip', 
            'required'           => true, 
        ),
		
		array(
            'name'               => 'Booked', 
            'slug'               => 'booked', 
            'source'             => get_template_directory() . '/plugins/booked.zip', 
            'required'           => true, 
        ),

        array(
            'name'               => 'Booked Payments with WooCommerce', 
            'slug'               => 'booked-payments', 
            'source'             => get_template_directory() . '/plugins/booked-payments.zip', 
            'required'           => false, 
        ),
		
		array(
            'name'               => 'ThemeCube Core', 
            'slug'               => 'themecube-cores', 
            'source'             => get_template_directory() . '/plugins/tc_core.zip', 
            'required'           => true, 
        ),

		array(
			'name' 	   => 'WooCommerce',
			'slug' 	   => 'woocommerce',
			'required' => false,
		),
		
		array(
			'name' 	   => 'Contact Form 7',
			'slug' 	   => 'contact-form-7',
			'required' => true,
		),

		array(
            'name'               => 'CMB2 RGBa Colorpicker', 
            'slug'               => 'cmb2-rgba-picker', 
            'source'             => get_template_directory() . '/plugins/CMB2_RGBa_Picker.zip', 
            'required'           => true, 
        ),
		

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'escape',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'escape' ),
			'menu_title'                      => __( 'Install Plugins', 'escape' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'escape' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'escape' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'escape' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'escape'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'escape'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'escape'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'escape'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'escape'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'escape'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'escape'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'escape'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'escape'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'escape' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'escape' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'escape' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'escape' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'escape' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'escape' ),
			'dismiss'                         => __( 'Dismiss this notice', 'escape' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'escape' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'escape' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}

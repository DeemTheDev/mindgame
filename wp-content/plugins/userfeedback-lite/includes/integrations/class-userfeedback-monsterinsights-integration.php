<?php

/**
 * MonsterInsights integration class.
 *
 * We have to override quite a few things from the parent class because MI can be present
 * with a different slug depending on whether it's Lite or Pro.
 *
 * @since 1.0.0
 *
 * @package UserFeedback
 * @author  David Paternina
 */
class UserFeedback_MonsterInsights_Integration extends UserFeedback_Plugin_Integration {

	/**
	 * Plugin slugs. For MI we have to check if either Lite or Pro exist
	 */
	protected static $slugs = array(
		'google-analytics-for-wordpress/googleanalytics.php',
		'google-analytics-premium/googleanalytics-premium.php',
	);

	/**
	 * @inheritdoc
	 */
	protected $name = 'monsterinsights';

	/**
	 * @inheritdoc
	 */
	protected $load_in_frontend_scripts = true;

	// Override validation function
	/**
	 * @inheritdoc
	 */
	public static function is_active() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		foreach ( self::$slugs as $slug ) {
			if ( is_plugin_active( $slug ) ) {
				return true;
			}
		}

		return false;
	}

	// Override validation function
	/**
	 * @inheritdoc
	 */
	public static function is_installed() {
		foreach ( self::$slugs as $slug ) {
			if ( userfeedback_is_plugin_installed( $slug ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Check if installed MI is Pro version.
	 * Doesn't care if plugin is activated, just checks for its presence using the slug
	 *
	 * @return bool
	 */
	public static function is_pro() {
		return userfeedback_is_plugin_installed( 'google-analytics-premium/googleanalytics-premium.php' );
	}

	/**
	 * @inheritdoc
	 */
	public function get_basename() {
		return self::is_pro() ? 'google-analytics-premium/googleanalytics-premium.php' : 'google-analytics-for-wordpress/googleanalytics.php';
	}
}

new UserFeedback_MonsterInsights_Integration();

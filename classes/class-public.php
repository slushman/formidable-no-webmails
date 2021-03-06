<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Formidable_No_Webmails
 * @subpackage Formidable_No_Webmails/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Formidable_No_Webmails
 * @subpackage Formidable_No_Webmails/public
 * @author     Slushman <chris@slushman.com>
 */
class Formidable_No_Webmails_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/formidable-no-webmails.js', array( 'jquery' ), $this->version, true );

	}

	public function no_webmails_allowed( $errors, $posted_field, $posted_value ) {

		if ( 'email' !== $posted_field->type ) { return $errors; }

		$services[] = 'att.net';
		$services[] = 'aol.com';
		$services[] = 'bellsouth.net';
		$services[] = 'comcast.net';
		$services[] = 'earthlink.com';
		$services[] = 'frontier.net';
		$services[] = 'gmail.com';
		$services[] = 'gmx.com';
		$services[] = 'gmx.net';
		$services[] = 'hotmail.com';
		$services[] = 'hushmail.com';
		$services[] = 'icloud.com';
		$services[] = 'juno.com';
		$services[] = 'live.com';
		$services[] = 'mac.com';
		$services[] = 'me.com';
		$services[] = 'outlook.com';
		$services[] = 'protonmail.com';
		$services[] = 'verizon.net';
		$services[] = 'yandex.com';
		$services[] = 'yahoo.com';
		$services[] = 'zoho.com';

		$services = apply_filters( 'formidable-no-webmails-services', $services );

		foreach ( $services as $service ) {

			$check = strpos( $posted_value, $service );

			if ( ! empty( $check ) ) {

				$errors[ $posted_field->id ] = 'Please provide a business email address.';

			}

		} // foreach

		return $errors;

	} // no_webmails_allowed()

}

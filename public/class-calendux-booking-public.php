<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://aventux.com
 * @since      1.0.0
 *
 * @package    Calendux_Booking
 * @subpackage Calendux_Booking/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Calendux_Booking
 * @subpackage Calendux_Booking/public
 * @author     Aventux <kontakt@aventux.com>
 */
class Calendux_Booking_Public {

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
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Calendux_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Calendux_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/calendux-booking-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Calendux_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Calendux_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/calendux-booking-public.js', array( 'jquery' ), $this->version, false );

	}

    function calendux_booking_widget() {
        $options = get_option( $this->plugin_name );
        $slug = (!empty($options['identification_token']) ? $options['identification_token'] : 'aventux');

        return '
<!-- Calendar Button-Widget Start -->
<script src="https://cdn.calendux.net/calendar/widget.js"></script>
<a href=" http://booking.buchungssystem.test/company/' . $slug . '" class="booking-btn" style="background-color: #563d7c; background-color: #563d7c; color: #ffffff" target="_blank">Jetzt buchen</a>
<!-- Calendar Button-Widget End -->
        ';
    }
}

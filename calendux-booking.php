<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://aventux.com
 * @since             1.0.0
 * @package           Calendux_Booking
 *
 * @wordpress-plugin
 * Plugin Name:       Calendux Booking
 * Plugin URI:        https://calendux.net/
 * Description:       Dies ist das offizelle Plugin von dem Calendux Buchungssystem.
 * Version:           1.0.2
 * Author:            Aventux
 * Author URI:        https://aventux.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       calendux-booking
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'CALENDUX_BOOKING_PLUGIN_NAME', 'plugin-name' );
define( 'CALENDUX_BOOKING_VERSION', '1.0.0' );
define( 'CALENDUX_BOOKING_URL', plugin_dir_url( __FILE__ ) );
define( 'CALENDUX_BOOKING_PATH', plugin_dir_path( __FILE__ ) );
define( 'CALENDUX_BOOKING_BASE_DIR', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-calendux-booking-activator.php
 */
function activate_calendux_booking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-calendux-booking-activator.php';
	Calendux_Booking_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-calendux-booking-deactivator.php
 */
function deactivate_calendux_booking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-calendux-booking-deactivator.php';
	Calendux_Booking_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_calendux_booking' );
register_deactivation_hook( __FILE__, 'deactivate_calendux_booking' );

/*****************************************
 * CUSTOM UPDATER FOR PLUGIN
 * @tutorial custom_updater_for_plugin.php
 */
if ( is_admin() ) {

    /**
     * A custom update checker for WordPress plugins.
     *
     * How to use:
     * - Copy vendor/plugin-update-checker to your plugin OR
     *   Download https://github.com/YahnisElsts/plugin-update-checker to the folder
     * - Create a subdomain or a folder for the update server eg. https://updates.example.net
     *   Download https://github.com/YahnisElsts/wp-update-server and copy to the subdomain or folder
     * - Add plguin zip to the 'packages' folder
     *
     * Useful if you don't want to host your project
     * in the official WP repository, but would still like it to support automatic updates.
     * Despite the name, it also works with themes.
     *
     * @link http://w-shadow.com/blog/2011/06/02/automatic-updates-for-commercial-themes/
     * @link https://github.com/YahnisElsts/plugin-update-checker
     * @link https://github.com/YahnisElsts/wp-update-server
     */
    if( ! class_exists( 'Puc_v4_Factory' ) ) {

        require_once join( DIRECTORY_SEPARATOR, array( CALENDUX_BOOKING_BASE_DIR, 'vendor', 'plugin-update-checker', 'plugin-update-checker.php' ) );

    }

    $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    // CHANGE THIS FOR YOUR UPDATE URL
        'https://github.com/Aventux/wp-calendux-booking/',
        __FILE__, //Full path to the main plugin file.
        CALENDUX_BOOKING_PLUGIN_NAME //Plugin slug. Usually it's the same as the name of the directory.
    );

    $myUpdateChecker->getVcsApi()->enableReleaseAssets();

    /**
     * add plugin upgrade notification
     * https://andidittrich.de/2015/05/howto-upgrade-notice-for-wordpress-plugins.html
     */
    add_action( 'in_plugin_update_message-' . CALENDUX_BOOKING_PLUGIN_NAME . '/' . CALENDUX_BOOKING_PLUGIN_NAME .'.php', 'plugin_name_show_upgrade_notification', 10, 2 );
    function plugin_name_show_upgrade_notification( $current_plugin_metadata, $new_plugin_metadata ) {

        /**
         * Check "upgrade_notice" in readme.txt.
         *
         * Eg.:
         * == Upgrade Notice ==
         * = 20180624 = <- new version
         * Notice		<- message
         *
         */
        if ( isset( $new_plugin_metadata->upgrade_notice ) && strlen( trim( $new_plugin_metadata->upgrade_notice ) ) > 0 ) {

            // Display "upgrade_notice".
            echo sprintf( '<span style="background-color:#d54e21;padding:10px;color:#f9f9f9;margin-top:10px;display:block;"><strong>%1$s: </strong>%2$s</span>', esc_attr( 'Important Upgrade Notice', 'exopite-multifilter' ), esc_html( rtrim( $new_plugin_metadata->upgrade_notice ) ) );

        }
    }


}
// END CUSTOM UPDATER FOR PLUGIN
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-calendux-booking.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_calendux_booking() {

	$plugin = new Calendux_Booking();
	$plugin->run();

}
run_calendux_booking();

<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://aventux.com
 * @since      1.0.0
 *
 * @package    Calendux_Booking
 * @subpackage Calendux_Booking/admin/partials
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2>Calendux <?php esc_attr_e('Einstellungen', 'calendux_booking' ); ?></h2>

    <form method="post" name="<?php echo $this->plugin_name; ?>" action="options.php">
        <?php
        //Grab all options
        $options = get_option( $this->plugin_name );

        $identification_token = ( isset( $options['identification_token'] ) && ! empty( $options['identification_token'] ) ) ? esc_attr( $options['identification_token'] ) : '';

        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);

        ?>

        <!-- Text -->
        <fieldset>
            <p><?php esc_attr_e( 'Ihr Identifikationskürzel', 'calendux_booking' ); ?></p>
            <legend class="screen-reader-text">
                <span><?php esc_attr_e( 'Identifikationskürzel', 'calendux_booking' ); ?></span>
            </legend>
            <input type="text" class="identification_token" id="<?php echo $this->plugin_name; ?>-identification_token" name="<?php echo $this->plugin_name; ?>[identification_token]" value="<?php if( ! empty( $identification_token ) ) echo $identification_token; else echo ''; ?>" required/>
        </fieldset>

        <?php submit_button( __( 'Speichern', 'calendux_booking' ), 'primary','submit', TRUE ); ?>
    </form>
</div>
<?php

/**
 * Sentius Map plugin for WordPress
 *
 * @package   sentius-map
 * @link      https://github.com/httvhutceoscop
 * @author    Viet Tien Nguyen <tienvietnguyen1110@gmail.com>
 * @copyright 2021 Viet Tien Nguyen
 * @license   GPL v2 or later
 *
 * Plugin Name:  Sentius Map
 * Description:  Create Google Map to allow user pick the place and highlight it
 * Version:      1.0.0
 * Plugin URI:   https://kysuit.net
 * Author:       Viet Tien Nguyen
 * Author URI:   https://kysuit.net
 * Text Domain:  sentius-map
 * Network:      true
 * Requires PHP: >5.6
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

/**
 * Main singleton class for the Sentius Map plugin.
 */

class Sentius_Map
{
    private static $_instance;
    private static $initiated = false;
    public static function get_instance()
    {
        if (!is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function __construct()
    {
        // Do stuff
    }
    public static function init()
    {
        if (!self::$initiated) {
            self::init_hooks();
        }
    }

    private static function init_hooks()
    {
        self::$initiated = true;
        // Do stuff

    }
}

add_action('admin_menu', 'vnt_option');
add_action('init', 'vnt_add_settings');

function vnt_option()
{
    add_menu_page('VNT Map', 'Map Settings', 'administrator', 'vnt_option', 'vnt_adjustments', 'dashicons-location-alt', 99);
}
function vnt_add_settings()
{
    register_setting('vnt_gmap_setting', 'vnt_gmap_latitude');
    register_setting('vnt_gmap_setting', 'vnt_gmap_longitude');
}

function vnt_adjustments()
{
?>
    <div class="wrap">
        <h1>Google Map Settings</h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('vnt_gmap_setting');
            do_settings_sections('vnt_gmap_setting');
            $latitude = get_option('vnt_gmap_latitude') ? get_option('vnt_gmap_latitude') : 21.029039423363564;
            $longitude = get_option('vnt_gmap_longitude') ? get_option('vnt_gmap_longitude') : 105.85208456787406;
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Latitude : </th>
                    <td>
                        <input required placeholder="Location's latitude here like: 40.6773988" class="regular-text" type="text" name="vnt_gmap_latitude" value="<?php echo esc_attr($latitude); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Longitude : </th>
                    <td>
                        <input required placeholder="Location's longitude here like: -85.6134087" class="regular-text" type="text" name="vnt_gmap_longitude" value="<?php echo esc_attr($longitude); ?>">
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        <br>
        <h2>Instructions:</h2>
        <p>Shortcode <span style="color:red; font-weight:bold;">[vnt-map]</span></p>
    </div>
<?php
} ?>

<?php
function vnt_create_map()
{
    ob_start(); ?>
    <?php

    $latitude = get_option('vnt_gmap_latitude') ? get_option('vnt_gmap_latitude') : 21.029039423363564;
    $longitude = get_option('vnt_gmap_longitude') ? get_option('vnt_gmap_longitude') : 105.85208456787406;

    if (get_option('vnt_gmap_height')) {
        $getHeight = (int) filter_var(get_option('vnt_gmap_height'), FILTER_SANITIZE_NUMBER_INT);
        $height = $getHeight . "px";
    } else {
        $height = "400px";
    }

    $width = get_option('vnt_gmap_width') ? get_option('vnt_gmap_width') : "100%";
    ?>
    <div id="vnt-map" style="overflow:hidden; width:<?php echo $width; ?>; margin:0 auto; position: relative;">
        <div class="fluid-width-video-wrapper" style="padding-top:1px !important;">
            <iframe src="https://maps.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&hl=en;z=14&amp;output=embed" width="100%" frameborder="0" title="Our Location in google map" style="height:<?php echo $height; ?>; width:100%;  padding:0 !important;" allowfullscreen="">
            </iframe>
        </div>
    </div>
<?php $content = ob_get_clean();
    return $content;
}
add_shortcode('vnt-map', 'vnt_create_map');

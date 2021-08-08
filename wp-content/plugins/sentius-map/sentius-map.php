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
    public $author_name = '';
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
    public function set_author_name($author_name)
    {
        $this->author_name = $author_name;
    }
    public function get_author_name()
    {
        return $this->author_name;
    }
}

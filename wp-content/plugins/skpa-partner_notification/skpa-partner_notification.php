<?php
/*
Plugin Name: SKPA Partner Notification
Plugin URI: http://safespaces.com/
Description: Adds the ability to add social profiles to a site and output them as a widget.
Version: 1.0
License: GPL-2.0+
Author: Joel Pajaron
Author URI: https://joelpajaron.com/
Text domain:  skpa-partner_notification-slug
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the lilypad.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the lilypad, Makati City
*/

/* exist if directly accessed */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// define variable for path to this plugin file.
define( 'HD_ESPW_LOCATION', dirname( __FILE__ ) );
define( 'HD_ESPW_LOCATION_URL', plugins_url( '', __FILE__ ) );

/**
 * Get the registered social profiles.
 *
 * @return array An array of registered social profiles.
 */
function hd_espw_get_social_profiles() {

	// return a filterable social profiles.
	return apply_filters(
		'hd_espw_social_profiles',
		array()
	);

}


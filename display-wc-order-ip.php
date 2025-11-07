<?php
/*
Plugin Name: Display WooCommerce Order IP
Plugin URI: https://github.com/maddisondesigns/display-woocommerce-order-ip
Description: A simple plugin to display the Customer IP on the Order Lists page.
Version: 1.0.0
Author: Anthony Hortin
Author URI: http://maddisondesigns.com
Text Domain: display-wc-order-ip
Requires plugins: woocommerce
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, see http://www.gnu.org/licenses/gpl-2.0.html.
*/

class dwcoip_display_wc_order_ip {

	const SETTINGS_NAMESPACE = 'display_wc_order_ip';

	/**
	 * Add the necessary filters & actions to display the IP Address
	 */
	public function __construct() {
		if ( is_admin() ) {
			// Add Filters for Orders list page
			add_filter( 'manage_edit-shop_order_columns', array( $this, 'dwcoip_add_ip_column' ) );

			// Add Actions for Orders list page
			add_action( 'manage_shop_order_posts_custom_column', array( $this, 'dwcoip_display_ip_address' ), 10, 2 );
		}
	}

	/**
	 * Add IP Column to WooCommerce Orders List page
	 */
	public function dwcoip_add_ip_column( $columns ) {
		$columns['ip_address'] = 'IP Address';
		return $columns;
	}

	/**
	 * Add IP Address into column on Orders List page
	 */
	public function dwcoip_display_ip_address( $column, $post_id ) {
		if ( $column == 'ip_address' ) {
			$order = wc_get_order( $post_id );
			echo $order->get_customer_ip_address();
		}
	}
}

$dwcoip_display_woocommer_order_ip = new dwcoip_display_wc_order_ip();

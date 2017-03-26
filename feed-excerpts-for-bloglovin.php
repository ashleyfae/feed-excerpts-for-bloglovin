<?php
/**
 * Plugin Name: Feed Excerpts for Bloglovin
 * Plugin URI: https://www.nosegraze.com
 * Description: Only show post excperts to Bloglovin' without having to adjust your settings globally.
 * Version: 1.0
 * Author: Ashley Gibson
 * Author URI: https://www.nosegraze.com
 * License: GPL2
 *
 * @package   feed-excerpts-for-bloglovin
 * @copyright Copyright (c) 2017, Ashley Gibson
 * @license   GPL2+
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Create new RSS feed with excerpts only.
 *
 * @since 1.0
 * @return void
 */
function feb_excerpt_feed() {
	add_feed( 'excerpts', 'feb_render_excerpt_feed' );
}

add_action( 'init', 'feb_excerpt_feed' );

/**
 * Pulls in the feed contents to render the feed.
 *
 * @since 1.0
 * @return void
 */
function feb_render_excerpt_feed() {
	include plugin_dir_path( __FILE__ ) . 'excerpt-feed.php';
}

/**
 * Add "Keep reading" link after the excerpt.
 *
 * @param string $excerpt Post excerpt.
 *
 * @since 1.0
 * @return string
 */
function feb_add_read_more_link( $excerpt ) {
	return $excerpt . ' <a href="' . esc_url( get_permalink() ) . '">' . __( 'Keep reading &raquo;' ) . '</a>';
}

add_filter( 'the_excerpt_rss', 'feb_add_read_more_link' );
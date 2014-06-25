<?php
/**
 * Plugin Name: Infinite Scrolling Categories
 * Plugin URI: http://vitogalatro.info
 * Description: Enables support for infinitely scrolling category and archive pages.
 * Version: 0.1
 * Author: Vito J. Galatro
 * Author URI: http://vitogalatro.info
 * License: GPL2
 *
 * Copyright 2014  Vito J. Galatro  (email : vjgalatro@gmail.com)
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

class WP_INFINITE_SCROLL_CAT {

  public function get_instance() {
    static $instance = null;
    if ($instance === null) {
      $instance = new WP_INFINITE_SCROLL_CAT();
    }
    return $instance;
  }

  private function __construct() {
    
  }

}

$WP_INIFINITE_SCROLL_CAT = WP_INFINITE_SCROLL_CAT::get_instance();


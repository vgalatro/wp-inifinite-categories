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
  
  private $current_query_vars;
  
  public function get_instance() {
    static $instance = null;
    if ($instance === null) {
      $instance = new WP_INFINITE_SCROLL_CAT();
    }
    return $instance;
  }

  private function __construct() {
    add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
    add_action('wp_ajax_wpic_load_next_page', array(&$this, 'ajax_callback'));
    add_action('wp_ajax_nopriv_wpic_load_next_page', array(&$this, 'ajax_callback'));
    add_action('parse_query', array(&$this, 'parse_query'));
  }

  public function enqueue_scripts() {
    wp_register_script('wp_infinite_categories', plugins_url('js/wp-infinite-categories.js', __FILE__), array('jquery'));
    wp_enqueue_script('wp_infinite_categories');
    
        
    wp_localize_script('wp_infinite_categories', 'ajax_data', array(
      'url' => admin_url('admin-ajax.php'),
      'query_vars' => $this->current_query_vars,
    ));
  }
  
  public function ajax_callback() {
    if (isset($_POST['query'])) {
      $next_page = new WP_Query($_POST['query']);
      while ($next_page->have_posts()) {
        $next_page->the_post();
        get_template_part( 'content', get_post_format());
      }
    }
    die();
  }
  
  public function parse_query($query) {
    $this->current_query_vars = $query->query_vars;
  }
  
}

$WP_INIFINITE_SCROLL_CAT = WP_INFINITE_SCROLL_CAT::get_instance();


<?php
/**
 * @package ChrisPlugin
 */
/*
 * Plugin Name:       Chris plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Making my first plugin
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Chris
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

 /*
    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License
    as published by the Free Software Foundation; either version 2
    of the License, or (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
    Copyright 2005-2015 Automattic, Inc.
 */

 defined ('ABSPATH') or die ('Hey you cannot access this!');

 class ChrisPlugin {
     function __construct(){
        add_action('init', array($this,'custom_post_type'));
     }
     
     function activate(){
        // generate cpt
        $this->custom_post_type();
        // flush rewrite rules
        flush_rewrite_rules(); 
     }
    
    function deactivate(){
        // flush rewrite rules
        flush_rewrite_rules(); 
     }

    
    function custom_post_type(){
        register_post_type('book', ['public' => 'true', 'label' => 'Books']);
    }
 }
 if (class_exists('ChrisPLugin')){
    $chrisPlugin = new ChrisPlugin();
 }

 //Activation
 register_activation_hook(__FILE__, array($chrisPlugin, 'activate'));
 // Deactivation
 register_deactivation_hook(__FILE__, array($chrisPlugin, 'deactivate'));


 //Creating class and objects
 class Fruit {
    // Properties
    public $name;
    public $color;
  
    // Methods
    function set_name($name) {
      $this->name = $name;
    }
    function get_name() {
      return $this->name;
    }
    function set_color($color) {
      $this->color = $color;
    }
    function get_color() {
      return $this->color;
    }
  }
  
  $apple = new Fruit();
  $apple->set_name('Apple');
  $apple->set_color('Red');

  //TEST if plugin is active
  //echo ("Plugin active");
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

 /*
* Creating a function to create our CPT
*/
 
function custom_post_type() {
 
   // Set UI labels for Custom Post Type
       $labels = array(
           'name'                => _x( 'Movies', 'Post Type General Name', 'twentytwenty' ),
           'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'twentytwenty' ),
           'menu_name'           => __( 'Movies', 'twentytwenty' ),
           'parent_item_colon'   => __( 'Parent Movie', 'twentytwenty' ),
           'all_items'           => __( 'All Movies', 'twentytwenty' ),
           'view_item'           => __( 'View Movie', 'twentytwenty' ),
           'add_new_item'        => __( 'Add New Movie', 'twentytwenty' ),
           'add_new'             => __( 'Add New', 'twentytwenty' ),
           'edit_item'           => __( 'Edit Movie', 'twentytwenty' ),
           'update_item'         => __( 'Update Movie', 'twentytwenty' ),
           'search_items'        => __( 'Search Movie', 'twentytwenty' ),
           'not_found'           => __( 'Not Found', 'twentytwenty' ),
           'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
       );
        
   // Set other options for Custom Post Type
        
       $args = array(
           'label'               => __( 'movies', 'twentytwenty' ),
           'description'         => __( 'Movie news and reviews', 'twentytwenty' ),
           'labels'              => $labels,
           // Features this CPT supports in Post Editor
           'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
           // You can associate this CPT with a taxonomy or custom taxonomy. 
           'taxonomies'          => array( 'genres', 'actors', 'year'),
           /* A hierarchical CPT is like Pages and can have
           * Parent and child items. A non-hierarchical CPT
           * is like Posts.
           */ 
           'hierarchical'        => false,
           'public'              => true,
           'show_ui'             => true,
           'show_in_menu'        => true,
           'show_in_nav_menus'   => true,
           'show_in_admin_bar'   => true,
           'menu_position'       => 5,
           'can_export'          => true,
           'has_archive'         => true,
           'exclude_from_search' => false,
           'publicly_queryable'  => true,
           'capability_type'     => 'post',
           'show_in_rest' => true,
    
       );
        
       // Registering your Custom Post Type
       register_post_type( 'movies', $args );
    
   }
    
   /* Hook into the 'init' action so that the function
   * Containing our post type registration is not 
   * unnecessarily executed. 
   */
    
   add_action( 'init', 'custom_post_type', 0 );

//-------------------- SHORTCODES

    /**
     * Plugin Name: movie_display
     * Description: Displays movie info
    
    */
function movie_display_func( $atts ){
	return "Movie details";

}
add_shortcode( 'movie_display', 'movie_display_func' );

   /**
 * [cta_button] returns the HTML code for a CTA Button.
 * @return string Button HTML Code
*/

add_shortcode( 'cta_button', 'salcodes_cta' );

function salcodes_cta( $atts ) {
 $a = shortcode_atts( array(
 'link' => '#',
 'id' => 'salcodes',
 'color' => 'blue',
 'size' => '',
 'label' => 'Get Started',
 'target' => salcodes_boxed($atts, $content = '$image', $tag = ''),
 ), $atts );
 $output = '<p><a href="' . esc_url( $a['link'] ) . '" id="' . esc_attr( $a['id'] ) . '" class="button ' . esc_attr( $a['color'] ) . ' ' . esc_attr( $a['size'] ) . '" target="' . esc_attr($a['target']) . '">' . esc_attr( $a['label'] ) . '</a></p>';
 return $output;
}

/**
 * [boxed] returns the HTML code for a content box with colored titles.
 * @return string HTML code for boxed content
*/

add_shortcode( 'boxed', 'salcodes_boxed' );

function salcodes_boxed( $atts, $content, $tag = '' ) {
 $a = shortcode_atts( array(
 'title' => 'Title',
 'title_color' => 'white',
 'color' => 'blue',
 'image' => '<img src="../img/devilsadvocat.jpeg">',
 ), $atts );
 
 $output = '<div class="salcodes-boxed" style="border:2px solid ' . esc_attr( $a['color'] ) . ';">'.'<div class="salcodes-boxed-title" style="background-color:' . esc_attr( $a['color'] ) . ';"><h3 style="color:' . esc_attr( $a['title_color'] ) . ';">' . esc_attr( $a['title'] ) . '</h3></div>'.'<div class="salcodes-boxed-content"><p>' . esc_attr( $content ) . '</p></div>'.'</div>';
 
 return $output;
}


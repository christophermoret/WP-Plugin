<?php

/**
 * THIS IS TO ALLOW UNINSTALATION AND CLEARING UP DATA IF DONE SO. 
 *trigger this file on plugoin ininstall 
 *@package ChrisPlugin 
 */

if( ! defined('WP_UNINSTALL_PLUGIN') ){
    die; 
}

// Clear db stored data 
$books = get_posts(array('post_type' => 'book', 'numberposts' => -1));

foreach($books as $book){
    wp_delete_post($book->ID, true);
}

/* Acces db via SQL !!! MORE DANGEROUS THAN foreach!!!
global $wbdb; 
$wpdb->query("DELETE FROM wp_post_type = 'book'");
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE post_id NOT IN (SELECT id FROM wp_posts)");
*/


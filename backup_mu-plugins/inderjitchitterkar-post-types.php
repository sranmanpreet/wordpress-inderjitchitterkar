<?php

function portfolio_post_types() {
  // Work Post type
  register_post_type('Client', array(
    'capability_type' => 'post',
    'map_meta_cap' => true,
    'supports' => array('title'),
    'rewrite' => array('slug' => 'clients'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Clients',
      'add_new_item' => 'Add New Client',
      'edit_item' => 'Edit Client',
      'all_items' => 'All Clients',
      'singular_name' => 'Client'
    ),
    'menu_icon' => 'dashicons-playlist-video'
  ));
  
  // Service Post type
  register_post_type('Service', array(
    'capability_type' => 'post',
    'map_meta_cap' => true,
    'supports' => array('title'),
    'rewrite' => array('slug' => 'services'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Services',
      'add_new_item' => 'Add New Service',
      'edit_item' => 'Edit Service',
      'all_items' => 'All Services',
      'singular_name' => 'Service'
    ),
    'menu_icon' => 'dashicons-screenoptions'
  ));

}

add_action('init', 'portfolio_post_types');
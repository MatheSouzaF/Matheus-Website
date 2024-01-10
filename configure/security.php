<?php

defined('WPINC') || die();

// Remove generator do head
remove_action('wp_head', 'wp_generator');

// Remove wlwmanifest.xml.
remove_action('wp_head', 'wlwmanifest_link');

// Remove xmlrpc
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter('wp_headers', function($headers, $wp_query){
    if (array_key_exists('X-Pingback', $headers)) {
      unset($headers['X-Pingback']);
    }
    return $headers;
  }, 11, 2);
  add_action('wp', function(){
    remove_action('wp_head', 'rsd_link');
}, 11);

//Remove Oembed
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');

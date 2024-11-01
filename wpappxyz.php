<?php
/*
Plugin Name: wpappxyz
Plugin URI: http://wpapp.xyz
Description: wp rest api ext
Version: 0.0.1
Author: oldcwj
Author URI: http://wpapp.xyz/
License: GPL
*/

function wpappxyz_prepare_post( $data, $post, $request ) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id );
	$_data['featured_image'] = $thumbnail[0];
	$data->data = $_data;
	return $data;
}


function wpappxyz_allow_offset_query( $valid_vars ) {
	
	$valid_vars = array_merge( $valid_vars, array( 'offset') );
	return $valid_vars;
}

function wpappxyz_init() {
	add_filter( 'rest_prepare_post', 'wpappxyz_prepare_post', 10, 3 );
  add_filter( 'rest_query_vars', 'wpappxyz_allow_offset_query' );
}

add_filter( 'init', 'wpappxyz_init' );
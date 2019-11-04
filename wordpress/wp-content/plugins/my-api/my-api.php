<?php
/**
 * Plugin Name: My API
 * Plugin URI: http://mildronize.com
 * Description: My API
 * Version: 1.0
 * Author: Thada
 * Author URI: http://mildronize.com
 */
function debug() {
	$args = [
		'numberposts' => 99999,
		'post_type' => 'post'
	];
	$posts = get_posts($args);
	return $posts;
}

function api_posts() {
	$args = [
		'numberposts' => 99999,
		'post_type' => 'post'
	];
	$posts = get_posts($args);
	$data = [];
	$i = 0;
	foreach($posts as $post) {
		$data[$i]['id'] = $post->ID;
		$data[$i]['title'] = $post->post_title;
		$data[$i]['date'] = $post-> post_date;
		$data[$i]['slug'] = $post->post_name;
		$data[$i]['tags'] = get_tags(['ID' => $post->ID]);
		$data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');
		$data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID, 'medium');
		$data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');
		$i++;
	}
	return $data;
}
function api_post( $slug ) {
	$args = [
		'name' => $slug['slug'],
		'post_type' => 'post'
	];
	$post = get_posts($args);
	$data['id'] = $post[0]->ID;
	$data['title'] = $post[0]->post_title;
	$data['content'] = $post[0]->post_content;
	$data['date'] = $post[0]-> post_date;
	$data['slug'] = $post[0]->post_name;
	$data['tags'] = get_tags(['ID' => $post[0]->ID]);
	$data['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post[0]->ID, 'thumbnail');
	$data['featured_image']['medium'] = get_the_post_thumbnail_url($post[0]->ID, 'medium');
	$data['featured_image']['large'] = get_the_post_thumbnail_url($post[0]->ID, 'large');
	return $data;
}

function api_pages() {
	$args = [
		'numberposts' => 99999,
		'post_type' => 'page'
	];
	$posts = get_posts($args);
	$data = [];
	$i = 0;
	foreach($posts as $post) {
		$data[$i]['id'] = $post->ID;
		$data[$i]['title'] = $post->post_title;
		$data[$i]['date'] = $post-> post_date;
		$data[$i]['slug'] = $post->post_name;
		$data[$i]['tags'] = get_tags(['ID' => $post->ID]);
		$data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');
		$data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID, 'medium');
		$data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');
		$i++;
	}
	return $data;
}

function api_page( $slug ) {
	$args = [
		'name' => $slug['slug'],
		'post_type' => 'page'
	];
	$post = get_posts($args);
	$data['id'] = $post[0]->ID;
	$data['title'] = $post[0]->post_title;
	$data['content'] = $post[0]->post_content;
	$data['date'] = $post[0]-> post_date;
	$data['slug'] = $post[0]->post_name;
	$data['tags'] = get_tags(['ID' => $post[0]->ID]);
	$data['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post[0]->ID, 'thumbnail');
	$data['featured_image']['medium'] = get_the_post_thumbnail_url($post[0]->ID, 'medium');
	$data['featured_image']['large'] = get_the_post_thumbnail_url($post[0]->ID, 'large');
	return $data;
}

add_action('rest_api_init', function() {
	register_rest_route('api/v1', 'debug', [
		'methods' => 'GET',
		'callback' => 'debug',
	]);
	register_rest_route('api/v1', 'posts', [
		'methods' => 'GET',
		'callback' => 'api_posts',
	]);
	register_rest_route( 'api/v1', 'posts/(?P<slug>[a-zA-Z0-9-]+)', array(
		'methods' => 'GET',
		'callback' => 'api_post',
	) );
	
	register_rest_route('api/v1', 'pages', [
		'methods' => 'GET',
		'callback' => 'api_pages',
	]);
	register_rest_route( 'api/v1', 'pages/(?P<slug>[a-zA-Z0-9-]+)', array(
		'methods' => 'GET',
		'callback' => 'api_page',
	) );
});
<?php
/*
Plugin Name: Players REST API
Plugin URI: http://colinswinney.com/
Description: Custom REST API End Points for Players
Author: Colin Swinney
Version:1
Author URI:http://colinswinney.com
*/



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Create new endpoint to grab all players
function cr_everything_register_api_hooks() {
  register_rest_route( 'baseballtweets/v1', '/get-everything/', array(
    'methods' => 'GET',
    'callback' => 'cr_get_everything',
  ) );
}
// Return all post IDs
function cr_get_everything() {
  $all_posts = get_posts( array(
    'numberposts' => -1,
    'post_type'   => 'post'
  ) );

  $all_pages = get_posts( array(
    'numberposts' => -1,
    'post_type'   => 'page'
  ) );

  $all_players = get_posts( array(
    'numberposts' => -1,
    'post_type'   => 'players'
  ) );

  $teams = get_terms( 'teams', array(
    'hide_empty' => false,
  ));
  $team_info = array();
  foreach ( $teams as $team ) {
      $team_info[] = $team;
  }

  $my_menu = wp_get_nav_menu_items('Main Menu');

  foreach ( $all_players as $player ) {
      $player_info[] = $player;
  }

  return array('cr_posts' => $all_posts, 'cr_pages' => $all_pages, 'cr_players' => $player_info, 'cr_menu' => $my_menu, 'cr_teams' => $team_info);
}
add_action( 'rest_api_init', 'cr_everything_register_api_hooks' );















// add Players category info to rest api
function register_players_categories() {

  register_rest_field( 'players',
    'category_info',
    array(
      'get_callback' => 'players_category_field'
    )
  );
}
function players_category_field( $object, $field_name, $request ) {

  $id = $object['id'];
  $terms = get_the_terms( $id, 'category' );

  $category_info = array();
  foreach ( $terms as $term ) {
      $category_info[] = $term;
  }

  return $category_info;
}
add_action( 'rest_api_init',  'register_players_categories' );






// add Players team info to rest api
function register_players_teams() {

  register_rest_field( 'players',
    'team_info',
    array(
      'get_callback' => 'players_team_field'
    )
  );
}
function players_team_field( $object, $field_name, $request ) {

  $id = $object['id'];
  $terms = get_the_terms( $id, 'teams' );

  $category_info = array();
  foreach ( $terms as $term ) {
      $category_info[] = $term;
  }

  return $category_info;
}
add_action( 'rest_api_init',  'register_players_teams' );





// add ACF fields to player rest return
function register_player_acf_fields() {

  register_rest_field( 'players',
    'acf_fields',
    array(
      'get_callback' => 'player_acf_field'
    )
  );
}
function player_acf_field( $object, $field_name, $request ) {

  $id = $object['id'];
  $twitter_user_name = get_field('twitter_user_name', $id );
  $twitter_id = get_field('twitter_id', $id );
  return array('twitter_user_name' => $twitter_user_name, 'twitter_id' => $twitter_id);
}
add_action( 'rest_api_init',  'register_player_acf_fields' );




// Create new endpoint to grab all players
function player_register_api_hooks() {
  register_rest_route( 'players-cpt/v1', '/get-all-players/', array(
    'methods' => 'GET',
    'callback' => 'player_get_all_post_ids',
  ) );
}
// Return all post IDs
function player_get_all_post_ids() {
  $all_players = get_posts( array(
    'numberposts' => -1,
    'post_type'   => 'players'
  ) );
  $player_info = array();
  foreach ( $all_players as $player ) {
      $player_info[] = array('slug' => $player->post_name, 'id' => $player->ID);
  }
  return $player_info;
}
add_action( 'rest_api_init', 'player_register_api_hooks' );
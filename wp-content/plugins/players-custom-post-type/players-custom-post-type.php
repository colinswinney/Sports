<?php

/*
Plugin Name: Players Custom Post Type
Plugin URI: https://www.colinswinney.com/
Description: Creats Players CPT and Teams Taxonomy
Version: 1.0
Author: Colin Swinney
Author URI: http://www.colinswinney.com/
Copyright: Colin Swinney
*/


// Register Custom Post Type
function create_players_post_type() {

	$labels = array(
		'name'                  => _x( 'Players', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Player', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Players', 'text_domain' ),
		'name_admin_bar'        => __( 'Player', 'text_domain' ),
		'archives'              => __( 'Player Archives', 'text_domain' ),
		'attributes'            => __( 'Player Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Player:', 'text_domain' ),
		'all_items'             => __( 'All Players', 'text_domain' ),
		'add_new_item'          => __( 'Add New Player', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Player', 'text_domain' ),
		'edit_item'             => __( 'Edit Player', 'text_domain' ),
		'update_item'           => __( 'Update Player', 'text_domain' ),
		'view_item'             => __( 'View Player', 'text_domain' ),
		'view_items'            => __( 'View Players', 'text_domain' ),
		'search_items'          => __( 'Search Player', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Player', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Player', 'text_domain' ),
		'items_list'            => __( 'Players list', 'text_domain' ),
		'items_list_navigation' => __( 'Players list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Players list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Player', 'text_domain' ),
		'description'           => __( 'Players Post Type', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'revisions', ),
		'taxonomies'            => array( 'category', ' team' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'players', $args );

}
add_action( 'init', 'create_players_post_type', 0 );





// Register Custom Taxonomy
function create_teams_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Teams', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Team', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Team', 'text_domain' ),
		'all_items'                  => __( 'All Teams', 'text_domain' ),
		'parent_item'                => __( 'Parent Team', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Team:', 'text_domain' ),
		'new_item_name'              => __( 'New Team Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Team', 'text_domain' ),
		'edit_item'                  => __( 'Edit Team', 'text_domain' ),
		'update_item'                => __( 'Update Team', 'text_domain' ),
		'view_item'                  => __( 'View Team', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Teams with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Teams', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Teams', 'text_domain' ),
		'search_items'               => __( 'Search Teams', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Teams', 'text_domain' ),
		'items_list'                 => __( 'Teams list', 'text_domain' ),
		'items_list_navigation'      => __( 'Teams list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'teams', array( 'players' ), $args );

}
add_action( 'init', 'create_teams_taxonomy', 0 );
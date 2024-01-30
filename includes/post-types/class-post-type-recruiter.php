<?php
/**
 * Post Type: Recruiter
 *
 * @package    goRecruiter-core
 * @author     DevSyed 
 * @license    GNU General Public License, version 3
 */


defined('ABSPATH') || exit; 

class GTRecruiterPostType {

	public static function init()
	{
		add_action('init', [__CLASS__,'gt_create_recruiter_post_type']);
	}

	public static function gt_create_recruiter_post_type()
	{
		$labels = array(
			'name'                  => 'Recruiters',
			'singular_name'         => 'Recruiter',
			'menu_name'             => 'Recruiters',
			'all_items'             => 'All Recruiters',
			'add_new'               => 'Add New',
			'add_new_item'          => 'Add New Recruiter',
			'edit_item'             => 'Edit Recruiter',
			'new_item'              => 'New Recruiter',
			'view_item'             => 'View Recruiter',
			'search_items'          => 'Search Recruiters',
			'not_found'             => 'No Recruiters found',
			'not_found_in_trash'    => 'No Recruiters found in Trash',
			'parent_item_colon'     => '',
			'featured_image'        => 'Recruiter Image',
			'set_featured_image'    => 'Set Recruiter Image',
			'remove_featured_image' => 'Remove Recruiter Image',
			'use_featured_image'    => 'Use as Recruiter Image',
			'archives'              => 'Recruiter Archives',
			'insert_into_item'      => 'Insert into Recruiter',
			'uploaded_to_this_item' => 'Uploaded to this Recruiter',
			'filter_items_list'     => 'Filter Recruiters list',
			'items_list_navigation'  => 'Recruiters list navigation',
			'items_list'            => 'Recruiters list',
		);
	
		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'rewrite'             => array('slug' => 'recruiter'), // Customize the URL slug
			'capability_type'     => 'post',
			'has_archive'         => false, // Set to true if you want an archive page
			'hierarchical'        => false,
			'menu_position'       => null,
			'menu_icon' 		  => 'dashicons-groups',
			'supports'            => array('title'),
		);
	
		register_post_type('recruiter', $args);
	}


	public static function gt_get_all_recruiters()
	{
		$recruiters = new WP_User_Query(array(
			'role' => 'recruiter',
		));
	}

	
}

GTRecruiterPostType::init();
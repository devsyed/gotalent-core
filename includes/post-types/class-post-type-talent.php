<?php
/**
 * Post Type: Talent
 *
 * @package    gotalent-core
 * @author     DevSyed 
 * @license    GNU General Public License, version 3
 */


defined('ABSPATH') || exit; 

class GTTalentPostType {

	public static function init()
	{
		add_action('init', [__CLASS__,'gt_create_talent_post_type']);
		add_action( 'cmb2_admin_init', [__CLASS__,'gt_talent_meta_fields'] );
	}

	public static function gt_create_Talent_post_type()
	{
		$labels = array(
			'name'                  => 'Talents',
			'singular_name'         => 'Talent',
			'menu_name'             => 'Talents',
			'all_items'             => 'All Talents',
			'add_new'               => 'Add New',
			'add_new_item'          => 'Add New Talent',
			'edit_item'             => 'Edit Talent',
			'new_item'              => 'New Talent',
			'view_item'             => 'View Talent',
			'search_items'          => 'Search Talents',
			'not_found'             => 'No Talents found',
			'not_found_in_trash'    => 'No Talents found in Trash',
			'parent_item_colon'     => '',
			'featured_image'        => 'Talent Image',
			'set_featured_image'    => 'Set Talent Image',
			'remove_featured_image' => 'Remove Talent Image',
			'use_featured_image'    => 'Use as Talent Image',
			'archives'              => 'Talent Archives',
			'insert_into_item'      => 'Insert into Talent',
			'uploaded_to_this_item' => 'Uploaded to this Talent',
			'filter_items_list'     => 'Filter Talents list',
			'items_list_navigation'  => 'Talents list navigation',
			'items_list'            => 'Talents list',
		);
	
		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'rewrite'             => array('slug' => 'talent'), // Customize the URL slug
			'capability_type'     => 'post',
			'has_archive'         => true,
			'hierarchical'        => false,
			'menu_position'       => null,
			'menu_icon' 		  => 'dashicons-universal-access-alt',
			'supports'            => array('title'),
		);
	
		register_post_type('talent', $args);
	}


	public static function gt_talent_meta_fields()
	{
		
	}


	public static function gt_get_talent($id)
	{
		$talent = get_user_by('id', $id);
		return $talent;
	}



	public static function gt_get_verified_talent()
	{
		$verified_talent = new WP_User_Query(array(
			'role' => 'talent',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key'     => 'verified',
					'compare' => 'EXISTS'
				),
			)
		));
		$results = $verified_talent->get_results();
		return $results;
	}


	public static function gt_get_talent_by_category($cat_id)
	{
		$args = array(
			'role' => 'talent',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key'     => 'talent_category',
					'value'   => $cat_id,
					'compare' => '='
				),
			)
		);
		$query = new WP_User_Query( $args);
		$result = $query->get_results();
		return $result;
	}



	public static function gt_get_unverified_talent()
	{
		$unverified_talent = new WP_User_Query(array(
			'role' => 'talent',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key'     => 'verified',
					'value'   => true,
					'compare' => 'NOT EXISTS'
				),
			)
		));
		$results = $unverified_talent->get_results();
		return $results;
	}


	public static function gt_verify_talent($talent_id)
	{
		$user = get_user_by('id',$talent_id);
		if($user){
			update_user_meta($user->ID,'verified', true);
			return true;
		}
		return false;
	}



	
}

GTTalentPostType::init();
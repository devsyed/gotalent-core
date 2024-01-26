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
				'relation' => 'AND',
				array(
					'key'     => 'verified',
					'value' => true,
					'compare' => 'EXISTS'
				),
				array(
					'key' => 'deleted_user',
					'compare' => 'NOT EXISTS'
				)
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
				array(
					'key' => 'deleted_user',
					'compare' => 'NOT EXISTS'
				)
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
				'relation' => 'AND',
				array(
					'key'     => 'verified',
					'value'   => true,
					'compare' => 'NOT EXISTS'
				),
				array(
					'key' => 'deleted_user',
					'compare' => 'NOT EXISTS'
				)
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
			$mail = GTMailer::gt_send_mail($user->user_email, 'welcome@gotalent.global', 'GoTalent', 'Your Account has been Verified', 'emails/talent-account-verified.php');
			return true;
		}
		return false;
	}

	public static function gt_set_as_spotlight($talent_id)
	{
		update_user_meta($talent_id,'is_spotlight_talent', 'yes');
		return true;
	}
	
	
	public static function gt_unset_as_spotlight($talent_id)
	{
		delete_user_meta($talent_id,'is_spotlight_talent', 'yes');
		return true;
	}


	public static function get_searched_talent($query = array())
	{
		$build_query = array(
			'relation' => 'AND',
			array(
				'key'     => 'verified',
				'value' => true,
				'compare' => 'EXISTS'
			),
			array(
				'key' => 'deleted_user',
				'compare' => 'NOT EXISTS'
			),
			
		);
		if(isset($query['cat_slug'])){
			$build_query[] = array(
				'key' => 'talent_category',
				'value' => $query['cat_slug'],
				'compare' => '='
			);
		}
		
		if(isset($query['sub_cat_slug'])){
			$build_query[] = array(
				'key' => 'talent_sub_category',
				'value' => $query['sub_cat_slug'],
				'compare' => '='
			);
		}

		$verified_talent = new WP_User_Query(array(
			'role' => 'talent',
			'meta_query' => $build_query
		));

		$results = $verified_talent->get_results();
		return $results;

	}



	
}

GTTalentPostType::init();
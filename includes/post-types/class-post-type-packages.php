<?php
/**
 * Post Type: Package
 *
 * @package    GoTalent-core
 * @author     DevSyed 
 * @license    GNU General Public License, version 3
 */


defined('ABSPATH') || exit; 

class GTPackagePostType {

	public static function init()
	{
		add_action('init', [__CLASS__,'gt_create_package_post_type']);
	}

	public static function gt_create_package_post_type()
	{
		$labels = array(
			'name'                  => 'Packages',
			'singular_name'         => 'Package',
			'menu_name'             => 'Packages',
			'all_items'             => 'All Packages',
			'add_new'               => 'Add New',
			'add_new_item'          => 'Add New Package',
			'edit_item'             => 'Edit Package',
			'new_item'              => 'New Package',
			'view_item'             => 'View Package',
			'search_items'          => 'Search Packages',
			'not_found'             => 'No Packages found',
			'not_found_in_trash'    => 'No Packages found in Trash',
			'parent_item_colon'     => '',
			'featured_image'        => 'Package Image',
			'set_featured_image'    => 'Set Package Image',
			'remove_featured_image' => 'Remove Package Image',
			'use_featured_image'    => 'Use as Package Image',
			'archives'              => 'Package Archives',
			'insert_into_item'      => 'Insert into Package',
			'uploaded_to_this_item' => 'Uploaded to this Package',
			'filter_items_list'     => 'Filter Packages list',
			'items_list_navigation'  => 'Packages list navigation',
			'items_list'            => 'Packages list',
		);
	
		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'rewrite'             => array('slug' => 'talent_package'), // Customize the URL slug
			'capability_type'     => 'post',
			'has_archive'         => false, // Set to true if you want an archive page
			'hierarchical'        => false,
			'menu_position'       => null,
			'menu_icon' 		  => 'dashicons-groups',
			'supports'            => array('title'),
		);
	
		register_post_type('talent_package', $args);
	}



	/** 
	 * Create Package
	 * @param int|array  $talent_id|$package_details = []
	 */
	public static function create_package($talent_id, $package_details = array())
	{
		if(empty($package_details)) return new WP_Error('package-creation-error', 'Package could not be created, try again.');
		$meta_fields = [];
		foreach($package_details as $key => $value){
			if (strpos($key, '_meta_') === 0) {
				$formatted_key = str_replace('_meta_', '', $key);
				$meta_fields[$formatted_key] = $value;
			} 
		}
		$args = array(
			'post_type' => 'talent_package', 
			'post_status' => 'private',
			'post_title' => (isset($package_details['package_title'])) ? $package_details['package_title'] : '',
		);
		if(isset($package_details['package_id'])){
			$args['ID'] = $package_details['package_id'];
		}
		$package_id = wp_insert_post($args);
		update_post_meta($package_id,'talent_id', $talent_id);
		foreach($meta_fields as $meta_key => $meta_value){
			update_post_meta($package_id,$meta_key,$meta_value);
		}
		return $package_id;
		
	}


	/** 
	 * Get All Packages | Post Type
	 */
	public static function gt_get_all_talent_packages($talent_id)
	{
		$args = array(
			'author'      => $talent_id,
			'post_type'   => 'talent_package',
			'post_status' => 'private',
			'orderby'     => array('meta_value' => 'ASC'),
			'meta_key'    => 'price',
		);
		$packages = new WP_Query($args);
		return $packages->posts;

	}



	
}

GTPackagePostType::init();
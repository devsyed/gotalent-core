<?php
/**
 * Post Type: Withdraw
 *
 * @package    gotalent-core
 * @author     DevSyed 
 * @license    GNU General Public License, version 3
 */


defined('ABSPATH') || exit; 

class GTWithdrawPostType {

	public static function init()
	{
		add_action('init', [__CLASS__,'gt_create_withdraw_post_type']);
	}

	public static function gt_create_withdraw_post_type()
	{
		$labels = array(
			'name'                  => 'Withdraws',
			'singular_name'         => 'Withdraw',
			'menu_name'             => 'Withdraws',
			'all_items'             => 'All Withdraws',
			'add_new'               => 'Add New',
			'add_new_item'          => 'Add New Withdraw',
			'edit_item'             => 'Edit Withdraw',
			'new_item'              => 'New Withdraw',
			'view_item'             => 'View Withdraw',
			'search_items'          => 'Search Withdraws',
			'not_found'             => 'No Withdraws found',
			'not_found_in_trash'    => 'No Withdraws found in Trash',
			'parent_item_colon'     => '',
			'featured_image'        => 'Withdraw Image',
			'set_featured_image'    => 'Set Withdraw Image',
			'remove_featured_image' => 'Remove Withdraw Image',
			'use_featured_image'    => 'Use as Withdraw Image',
			'archives'              => 'Withdraw Archives',
			'insert_into_item'      => 'Insert into Withdraw',
			'uploaded_to_this_item' => 'Uploaded to this Withdraw',
			'filter_items_list'     => 'Filter Withdraws list',
			'items_list_navigation'  => 'Withdraws list navigation',
			'items_list'            => 'Withdraws list',
		);
	
		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'rewrite'             => array('slug' => 'withdraw'), // Customize the URL slug
			'capability_type'     => 'post',
			'has_archive'         => false, // Set to true if you want an archive page
			'hierarchical'        => false,
			'menu_position'       => null,
			'menu_icon' 		  => 'dashicons-money-alt',
			'supports'            => array('title'),
		);
	
		register_post_type('withdraw', $args);
	}


	/** 
	 * Get Talent Total Earnings 
	 * @param $talent_id
	 * @return $total_earnings
	 * @author DevSyed
	 */
	public static function gt_get_talent_total_earnings($talent_id){}

	/** 
	 * Get Talent Withdraws
	 * @param $talent_id
	 * @return Array 
	 * @author DevSyed
	 */
	public static function gt_get_talent_all_withdraws($talent_id){}

	/** 
	 * Create Withdraw Request
	 * @param $talent_id, $amount
	 * @return JSON
	 * @author DevSyed
	 */
	public static function gt_create_withdraw_request($talent_id,$amount){}


	/** 
	 * Process Withdraw Request
	 * @param $talent_id
	 */
	public static function gt_process_withdraw_request($withdraw_request_id){}


	
}

GTWithdrawPostType::init();
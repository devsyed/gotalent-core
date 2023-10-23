<?php
/**
 * Post Type: Notification
 *
 * @package    Gotalent-Core
 * @author     DevSyed 
 * @license    GNU General Public License, version 3
 */


defined('ABSPATH') || exit; 

class GTNotificationPostType {

	public static function init()
	{
		add_action('init', [__CLASS__,'gt_create_notification_post_type']);
	}

	public static function gt_create_notification_post_type()
	{
		$labels = array(
			'name'                  => 'Notifications',
			'singular_name'         => 'Notification',
			'menu_name'             => 'Notifications',
			'all_items'             => 'All Notifications',
			'add_new'               => 'Add New',
			'add_new_item'          => 'Add New Notification',
			'edit_item'             => 'Edit Notification',
			'new_item'              => 'New Notification',
			'view_item'             => 'View Notification',
			'search_items'          => 'Search Notifications',
			'not_found'             => 'No Notifications found',
			'not_found_in_trash'    => 'No Notifications found in Trash',
			'parent_item_colon'     => '',
			'featured_image'        => 'Notification Image',
			'set_featured_image'    => 'Set Notification Image',
			'remove_featured_image' => 'Remove Notification Image',
			'use_featured_image'    => 'Use as Notification Image',
			'archives'              => 'Notification Archives',
			'insert_into_item'      => 'Insert into Notification',
			'uploaded_to_this_item' => 'Uploaded to this Notification',
			'filter_items_list'     => 'Filter Notifications list',
			'items_list_navigation'  => 'Notifications list navigation',
			'items_list'            => 'Notifications list',
		);
	
		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'rewrite'             => array('slug' => 'notification'), // Customize the URL slug
			'capability_type'     => 'post',
			'has_archive'         => false, // Set to true if you want an archive page
			'hierarchical'        => false,
			'menu_position'       => null,
			'menu_icon' 		  => 'dashicons-bell',
			'supports'            => array('title'),
		);
	
		register_post_type('notification', $args);
	}


	/** 
	 * Create New Notification 
	 */
	public static function gt_create_new_notification($for, $type = '', $from = 0 , $message = '', $status)
	{
		$args = array(
			'post_type' => 'notification',
			'post_title' => $message,
			'post_status' => 'private',
		);
		$notification = wp_insert_post($args);
		update_post_meta($notification, 'type', $type);
		update_post_meta($notification, 'for', $for);
		update_post_meta($notification,'from',$from);
		update_post_meta($notification, 'status', $status);
		update_post_meta($notification,'seen', false);
		update_post_meta($notification,'seen_on', null);

		return $notification;
	}


	/** 
	 * Get Notification 
	 */
	public static function gt_get_notification($notification_id)
	{
		$notification = get_post($notification_id);
		return $notification;
	}


	/** 
	 * Get Notifications for User
	 */
	public static function gt_get_all_user_notifications($user_id)
	{
		$args = array(
			'post_type' => 'notification',
			'post_count' => -1,
			'post_status' => 'private',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'for',
					'value' => $user_id,
					'compare' => '='
				)
			)
		);
		return new WP_Query($args);

	}


	/**
	 * Change Notification Status 
	 */
	public static function gt_change_notification_status($notification_id,$status)
	{
		update_post_meta($notification_id,'status',$status );
	}
	
	/**
	 * Mark Notification Seen 
	 */
	public static function gt_mark_notification_seen($notification_id)
	{
		update_post_meta($notification_id,'seen', true );
		update_post_meta($notification_id,'seen_on', time() );
	}
	



	
}

GTNotificationPostType::init();
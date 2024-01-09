<?php

/**
 * Post Type: Booking
 *
 * @package    GoTalent-core
 * @author     DevSyed 
 * @license    GNU General Public License, version 3
 */

defined('ABSPATH') || exit;

class GTBookingPostType
{

	public static function init()
	{
		add_action('init', [__CLASS__, 'gt_create_booking_post_type']);
	}

	public static function gt_create_booking_post_type()
	{
		$labels = array(
			'name'                  => 'Bookings',
			'singular_name'         => 'Booking',
			'menu_name'             => 'Bookings',
			'all_items'             => 'All Bookings',
			'add_new'               => 'Add New',
			'add_new_item'          => 'Add New Booking',
			'edit_item'             => 'Edit Booking',
			'new_item'              => 'New Booking',
			'view_item'             => 'View Booking',
			'search_items'          => 'Search Bookings',
			'not_found'             => 'No Bookings found',
			'not_found_in_trash'    => 'No Bookings found in Trash',
			'parent_item_colon'     => '',
			'featured_image'        => 'Booking Image',
			'set_featured_image'    => 'Set Booking Image',
			'remove_featured_image' => 'Remove Booking Image',
			'use_featured_image'    => 'Use as Booking Image',
			'archives'              => 'Booking Archives',
			'insert_into_item'      => 'Insert into Booking',
			'uploaded_to_this_item' => 'Uploaded to this Booking',
			'filter_items_list'     => 'Filter Bookings list',
			'items_list_navigation'  => 'Bookings list navigation',
			'items_list'            => 'Bookings list',
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'rewrite'             => array('slug' => 'booking'), // Customize the URL slug
			'capability_type'     => 'post',
			'has_archive'         => false, // Set to true if you want an archive page
			'hierarchical'        => false,
			'menu_position'       => null,
			'menu_icon' 		  => 'dashicons-buddicons-pm',
			'supports'            => array('title'),
		);

		register_post_type('booking', $args);
	}

	public static function gt_get_all_bookings($date = array(), $count = -1, $offset = 0)
	{
		$booking_args = array(
			'post_type' => 'booking',
			'post_status' => 'private',
		);
		if(!empty($date)){
			$booking_args['date_query'] = [
				'after'     => $date['start_date'],
				'before'    => $date['end_date'],
				'inclusive' => true, 
			];
		}
		return new WP_Query($booking_args);
	}

	public static function gt_get_booking($booking_id)
	{
		return get_post($booking_id);
	}

	public static function gt_create_booking($title, $content = '', $meta = array())
	{
		$booking_data = array(
			'post_title' => $title,
			'post_type' => 'booking',
			'post_status' => 'private',
		);

		$booking_id = wp_insert_post($booking_data);
		do_action('gt_booking_created',$meta['talent_id'], $booking_id, $meta['recruiter_id']);
		$talent = get_user_by('id', $meta['talent_id']);
		$mail_to_talent = GTMailer::gt_send_mail($talent->user_email,'bookings@gotalent.global', 'GoTalent', 'Your New Booking is Created', 'emails/talent-new-booking.php',array('booking_id' => $booking_id) );

		// now mail the admin 

		if ($booking_id && !is_wp_error($booking_id)) {
			if(!empty($meta)){
				foreach ($meta as $key => $value) {
					update_post_meta($booking_id, $key, $value);
				}
			}
		} 
		return $booking_id;
	}

	public static function gt_delete_booking($booking_id)
	{
		return wp_delete_post($booking_id, true); // Set to true to force delete from trash
	}

	public static function gt_update_booking($booking_id, $title, $content = '', $meta = array())
	{
		$booking_data = array(
			'ID' => $booking_id,
			'post_title' => $title,
			'post_content' => $content,
		);

		$updated = wp_update_post($booking_data);

		if ($updated && !is_wp_error($updated)) {
			// Update custom metadata
			foreach ($meta as $key => $value) {
				update_post_meta($booking_id, $key, $value);
			}
			return true;
		} else {
			return false;
		}
	}

	public static function get_all_bookings_for_recruiter($recruiter_id)
	{
		$args = array(
			'post_type' => 'booking',
			'post_status' => 'private',
			'meta_query' => array(
				array(
					'key' => 'recruiter_id',
					'value' => $recruiter_id,
					'compare' => '='
				),
			),
		);
		
		$bookings = new WP_Query($args);
		return $bookings->posts;
	}
	
	
	public static function get_all_bookings_for_talent($talent_id)
	{
		$args = array(
			'post_type' => 'booking',
			'post_status' => 'private',
			'meta_query' => array(
				array(
					'key' => 'talent_id',
					'value' => $talent_id,
					'compare' => '='
				),
			),
		);
		
		$bookings = new WP_Query($args);
		return $bookings->posts;
	}

	public static function gt_user_belongs_to_booking($booking_id)
	{
		$is_user_recruiter = get_post_meta($booking_id, 'recruiter_id', true) == get_current_user_id();
		$is_user_talent = get_post_meta($booking_id, 'talent_id', true) == get_current_user_id();
		$is_admin = current_user_can('manage-options');

		if ($is_user_recruiter || $is_user_talent || $is_admin) {
			return true;
		} else {
			return false;
		}

	}

	public static function gt_get_earnings_for_user($user_id = 0,$date = array())
	{
		
		$user_type = 'talent';
		if(current_user_can('can_manage_recruiter_and_talent')){
			$user_type = 'administrator';
		}
		$total_earnings = 0;
		$commission_rate = ($user_type == 'administrator') ? 0.2 : 0.8;
		
		$args = array(
			'post_type' => 'booking',
			'post_status' => 'private',
		);
		if($user_type == 'talent' && $user_id !== 0){
			$args['meta_query'] = array(
				array(
					'key' => 'talent_id',
					'value' => $user_id
				)
			);
		}

		if(!empty($date)){
			$args['date_query'] = [
				'after'     => $date['start_date'],
				'before'    => $date['end_date'],
				'inclusive' => true, 
			];
		}
		$bookings_query = new WP_Query($args);
		$bookings = $bookings_query->posts;
		if(!$bookings) return; 
		foreach($bookings as $booking){
			$package = get_post(get_post_meta($booking->ID,'package_id', true));
			$total_earnings += (int) get_post_meta($package->ID, 'price', true) * $commission_rate;
		}
		return $total_earnings;
	}

}

GTBookingPostType::init();

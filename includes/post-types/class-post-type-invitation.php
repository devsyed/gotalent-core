<?php
/**
 * Post Type: Invitation
 *
 * @package    GoTalent-core
 * @author     DevSyed 
 * @license    GNU General Public License, version 3
 */


defined('ABSPATH') || exit; 

class GTInvitationPostType {

	public static function init()
	{
		add_action('init', [__CLASS__,'gt_create_invitation_post_type']);
	}

	public static function gt_create_invitation_post_type()
	{
		$labels = array(
			'name'                  => 'Invitations',
			'singular_name'         => 'Invitation',
			'menu_name'             => 'Invitations',
			'all_items'             => 'All Invitations',
			'add_new'               => 'Add New',
			'add_new_item'          => 'Add New Invitation',
			'edit_item'             => 'Edit Invitation',
			'new_item'              => 'New Invitation',
			'view_item'             => 'View Invitation',
			'search_items'          => 'Search Invitations',
			'not_found'             => 'No Invitations found',
			'not_found_in_trash'    => 'No Invitations found in Trash',
			'parent_item_colon'     => '',
			'featured_image'        => 'Invitation Image',
			'set_featured_image'    => 'Set Invitation Image',
			'remove_featured_image' => 'Remove Invitation Image',
			'use_featured_image'    => 'Use as Invitation Image',
			'archives'              => 'Invitation Archives',
			'insert_into_item'      => 'Insert into Invitation',
			'uploaded_to_this_item' => 'Uploaded to this Invitation',
			'filter_items_list'     => 'Filter Invitations list',
			'items_list_navigation'  => 'Invitations list navigation',
			'items_list'            => 'Invitations list',
		);
	
		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'rewrite'             => array('slug' => 'invitation'), // Customize the URL slug
			'capability_type'     => 'post',
			'has_archive'         => false, // Set to true if you want an archive page
			'hierarchical'        => false,
			'menu_position'       => null,
			'menu_icon' 		  => 'dashicons-buddicons-pm',
			'supports'            => array('title'),
		);
	
		register_post_type('invitation', $args);
	}

	public static function gt_get_invitation($invitation_id)
	{
		$invitation = get_post($invitation_id);
		return $invitation;
	}

	public static function gt_get_invitations_by_talent_id($talent_id)
	{
		$args = array(
			'post_type' => 'invitation',
			'post_status' => 'private',
			'meta_query' => array(
				array(
					'key' => 'talent_id',
				'value' => $talent_id,
				'compare' => '='
				)
			),
		);
		$invitations = new WP_Query($args);
		return $invitations->posts;
	}

	public static function gt_get_invitations_by_recruiter_id($recruiter_id)
	{
		$args = array(
			'post_type' => 'invitation',
			'post_status' => 'private',
			'meta_query' => array(
				array(
					'key' => 'recruiter_id',
				'value' => $recruiter_id,
				'compare' => '='
				)
			),
		);
		$invitations = new WP_Query($args);
		return $invitations->posts;
	}

	public static function gt_create_invitation_request($title, $meta = array())
	{
		$booking_data = array(
			'post_title' => $title,
			'post_type' => 'invitation',
			'post_status' => 'private'
		);

		$invitation_id = wp_insert_post($booking_data);
		do_action('gt_invitation_created',$meta['talent_id'], $invitation_id, $meta['recruiter_id']);

		if ($invitation_id && !is_wp_error($invitation_id)) {
			foreach ($meta as $key => $value) {
				update_post_meta($invitation_id, $key, $value);
			}
			// Add Invitation status to pending 
			update_post_meta($invitation_id,'status', 'pending');
		} 
		return $invitation_id;
	}

	public static function gt_invitation_belongs_to_talent($talent_id, $invitation_id)
	{
		$talent_invitations = self::gt_get_invitations_by_talent_id($talent_id);
		
		$invitation_belongs_to_talent = array_reduce($talent_invitations, function ($carry, $post) use ($invitation_id) {
			return $carry || ($post->ID == $invitation_id);
		}, false);

		return $invitation_belongs_to_talent;
	}

	public static function gt_invitation_belongs_to_recruiter($recruiter_id, $invitation_id)
	{
		$talent_invitations = self::gt_get_invitations_by_recruiter_id($recruiter_id);
		
		$invitation_belongs_to_talent = array_reduce($talent_invitations, function ($carry, $post) use ($invitation_id) {
			return $carry || ($post->ID == $invitation_id);
		}, false);

		return $invitation_belongs_to_talent;
	}

	public static function gt_accept_invitation_request($invitation_id)
	{

		$package_id = get_post_meta($invitation_id,'package_id', true);
		$package = get_post($package_id);
		$package_price = get_post_meta($package->ID,'price', true);
		if(!$package) return;

		$thread_id = get_post_meta($invitation_id,'thread_id', true);

		$talent_id = get_post_meta($invitation_id,'talent_id', true);
		$talent = get_user_by('id', $talent_id);

		$duration = get_post_meta($invitation_id,'duration', true);
		update_post_meta($invitation_id,'invitation_status', 'accepted');


		$recruiter_id = get_post_meta($invitation_id,'recruiter_id',true);

		// Now create the booking 
		$booking_meta = [
			'invitation_id' => $invitation_id,
			'price' => $package_price,
			'thread_id' => $thread_id,
			'talent_id' => $talent_id,
			'duration' => $duration,
			'recruiter_id' => $recruiter_id,
		];
		$booking = GTBookingPostType::gt_create_booking('New Booking', array(),$booking_meta);
		return $booking;


	}

}

GTInvitationPostType::init();
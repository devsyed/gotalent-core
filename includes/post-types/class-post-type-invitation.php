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

	public static function gt_create_Invitation_post_type()
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

	/** 
	 * Get all Invitations
	 */
	public static function gt_get_all_invitations()
	{

	}
	
	
	/** 
	 * Get Invitation by ID
	 */
	public static function gt_get_invitation($invtation_id)
	{

	}


	/** 
	 * Create an Invitiation 
	 */
	public static function gt_create_invitation_request()
	{

	}


	/** 
	 * Delete an Invitation Request
	 */
	public static function gt_delete_invitation_request()
	{

	}


	/**
	 * Update Invitation Request
	 */
	public static function gt_update_invitation_request()
	{

	}


	
}

GTInvitationPostType::init();
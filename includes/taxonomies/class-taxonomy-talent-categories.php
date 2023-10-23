<?php

/**
 * Talent Categories
 *
 * @package    gotalent
 * @author     DevSyed 
 * @license    GNU General Public License, version 3
 */
defined('ABSPATH') || exit;

class GTTaxonomy_Talent_Category
{

	/**
	 *
	 */
	public static function init()
	{
		add_action('init', array(__CLASS__, 'definition'), 1);
	}

	/**
	 *
	 */
	public static function definition($args)
	{

		$singular = __('Category', 'gotalent-core');
		$plural   = __('Categories', 'gotalent-core');

		$labels = array(
			'name'              => sprintf(__('Talent %s', 'gotalent-core'), $plural),
			'singular_name'     => $singular,
			'search_items'      => sprintf(__('Search %s', 'gotalent-core'), $plural),
			'all_items'         => sprintf(__('All %s', 'gotalent-core'), $plural),
			'parent_item'       => sprintf(__('Parent %s', 'gotalent-core'), $singular),
			'parent_item_colon' => sprintf(__('Parent %s:', 'gotalent-core'), $singular),
			'edit_item'         => __('Edit', 'gotalent-core'),
			'update_item'       => __('Update', 'gotalent-core'),
			'add_new_item'      => __('Add New', 'gotalent-core'),
			'new_item_name'     => sprintf(__('New %s', 'gotalent-core'), $singular),
			'menu_name'         => $plural,
		);

		$rewrite_slug = get_option('gt_talent_category_slug');
		if (empty($rewrite_slug)) {
			$rewrite_slug = _x('talent-category', 'Talent category slug - resave permalinks after changing this', 'gotalent-core');
		}
		$rewrite = array(
			'slug'         => $rewrite_slug,
			'with_front'   => false,
			'hierarchical' => false,
		);
		register_taxonomy('talent_category', 'talent', array(
			'labels'            => apply_filters('gt_taxomony_talent_category_labels', $labels),
			'hierarchical'      => true,
			'rewrite'           => $rewrite,
			'public'            => true,
			'show_ui'           => true,
			'show_in_rest'		=> true
		));
	}

	public static function gt_create_talent_category($term_name, $parent_category = 0)
	{
		$term_exists = term_exists($term_name, 'talent_category');
		if ($term_exists) {
			return new WP_Error('term-exists', 'This Category Already exists');
		}
		$args = array(
			'name' => $term_name,
			'taxonomy' => 'talent_category',
			'parent' => $parent_category,
		);

		$result = wp_insert_term($term_name, 'talent_category', $args);

		return $result;
	}



	public static function gt_get_all_talent_categories($parent_id = 0)
	{
		$args = array(
			'taxonomy' => 'talent_category',
			'hide_empty' => false,
			'parent' => $parent_id
		);

		$terms = get_terms($args);
		return $terms;
	}
}

GTTaxonomy_Talent_Category::init();

<?php


class GTThemeHelper
{

    public static function init()
    {
        add_filter('show_admin_bar', [__CLASS__, 'gt_hide_admin_bar']);
        add_action('gt_header', array(__CLASS__, 'gt_header_show'), 10);
        add_action('gt_header', array(__CLASS__, 'gt_show_talent_categories'), 20);
        add_action('wp_footer', [__CLASS__, 'gt_authentication_modal']);


        /** Action: gt_dashboard_sidebar_links */
        add_action('gt_dashboard_sidebar_links', [__CLASS__, 'gt_dashboard_sidebar_links']);

        /** Action: gt_dashboard_header_right */
        add_action('gt_dashboard_header_right', array(__CLASS__, 'gt_dashboard_user_verification'), 10);
        add_action('gt_dashboard_header_right', array(__CLASS__, 'gt_dashboard_user_menu'), 20);

        add_filter('dashboard_header_title', array(__CLASS__,'gt_dashboard_header_for_add_new'),10, 1);


    
    }

    public static function gt_hide_admin_bar()
    {
        if (!current_user_can('manage_options')) {
            return false;
        }
    }

    public static function gt_header_show()
    {
        GTHelpers::gt_get_template_part('header.php', array());
    }

    public static function gt_show_talent_categories()
    {
        $talent_cats = GTTaxonomy_Talent_Category::gt_get_all_talent_categories();
        GTHelpers::gt_get_template_part('gt-category-bar.php', $talent_cats);
    }

    public static function gt_authentication_modal()
    {
        if (!is_user_logged_in()) {
            GTHelpers::gt_get_template_part('modal-registration-login.php', array());
        }
    }


    /** 
     * @todo - Need to handle the error and show normal header when no header with slug matched. 
     */
    public static function gt_get_header($header_slug)
    {
        GTHelpers::gt_get_template_part($header_slug . '.php');
    }


    /** 
     * @todo - Need to handle the error and show normal header when no header with slug matched. 
     */
    public static function gt_get_footer($footer_slug)
    {
        GTHelpers::gt_get_template_part($footer_slug . '.php');
    }

    /** 
     * Header Right
     * 10 - User Verification Notice
     */
    public static function gt_dashboard_user_verification()
    {
        $user = wp_get_current_user();
        $user_verified = (get_user_meta($user->ID, 'talent_verified', true)) ? 'true' : 'false';
        GTHelpers::gt_get_template_part('talent-unverified-notice.php', $user_verified);
    }


    /** 
     * Header Right
     * 20 - User Menu | Dashboard
     */
    public static function gt_dashboard_user_menu()
    {
        $user = get_userdata(get_current_user_id());
        $userObjToArray = json_decode(json_encode($user), true);
        GTHelpers::gt_get_template_part('user-menu-dashboard.php', $userObjToArray['data']);
        
    }


    /** 
     * @todo - Change Detection of links from role to capabilities in future. 
     * 
     */
    public static function gt_dashboard_sidebar_links()
    {
        $sidebar_links = [
            'gotalent-dashboard/manage-profile' => __('Manage Profile', 'gotalent-core'),
            'gotalent-dashboard/manage-payment-settings' => __('Payment Settings', 'gotalent-core'),
            'gotalent-dashboard/earnings' => __('Earnings', 'gotalent-core'),
            'gotalent-dashboard/manage-bookings' => __('Manage Bookings', 'gotalent-core'),
            'gotalent-dashboard/manage-availability' => __('Manage Availability', 'gotalent-core'),
            'gotalent-dashboard/notifications' => __('Notifications', 'gotalent-core'),
            'gotalent-dashboard/messages' => __('Messages', 'gotalent-core'),
            'gotalent-dashboard/manage-recruiters' => __('Manage Recruiters', 'gotalent-core'),
            'gotalent-dashboard/manage-talent' => __('Manage Talent', 'gotalent-core'),
            'gotalent-dashboard/site-settings' => __('Settings', 'gotalent-core'),
            'gotalent-dashboard/manage-talent-categories' => __('Talent Categories', 'gotalent-core'),
            'gotalent-dashboard/manage-verification-settings' => __('Vertification Settings', 'gotalent-core'),
            'gotalent-dashboard/pending-talent-verification' => __('Pending Talent Verification', 'gotalent-core')
        ];

        $role = wp_get_current_user()->roles[0];
        switch ($role) {
            case 'recruiter':
                unset($sidebar_links['gotalent-dashboard/manage-availability']);
                unset($sidebar_links['gotalent-dashboard/manage-recruiters']);
                unset($sidebar_links['gotalent-dashboard/manage-talent']);
                unset($sidebar_links['gotalent-dashboard/site-settings']);
                unset($sidebar_links['gotalent-dashboard/manage-payment-settings']);
                unset($sidebar_links['gotalent-dashboard/manage-talent-categories']);
                unset($sidebar_links['gotalent-dashboard/manage-verification-settings']);
                unset($sidebar_links['gotalent-dashboard/pending-talent-verification']);
                break;
            case 'talent':
                unset($sidebar_links['gotalent-dashboard/manage-recruiters']);
                unset($sidebar_links['gotalent-dashboard/manage-talent']);
                unset($sidebar_links['gotalent-dashboard/manage-talent-categories']);
                unset($sidebar_links['gotalent-dashboard/site-settings']);
                unset($sidebar_links['gotalent-dashboard/pending-talent-verification']);

                break;
            default:
                unset($sidebar_links['gotalent-dashboard/manage-availability']);
                unset($sidebar_links['gotalent-dashboard/messages']);
                unset($sidebar_links['gotalent-dashboard/manage-payment-settings']);
                unset($sidebar_links['gotalent-dashboard/manage-verification-settings']);
                unset($sidebar_links['gotalent-dashboard/manage-profile']);

                break;
        }

        $links = apply_filters('gt_sidebar_links', $sidebar_links);
        GTHelpers::gt_get_template_part('components/sidebar-links.php', $links);
    }


    public static function gt_dashboard_header_for_add_new($title)
    {
        if(isset($_GET['add_new'])){
            $page_title = str_replace('Manage', '', $title);
            return __('Add','gotalent-core') . $page_title;
        }
        return $title;
    }

    
}

GTThemeHelper::init();

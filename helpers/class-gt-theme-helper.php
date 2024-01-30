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


         /** Talent Archive Page */
         add_action('gt_talent_page_archive', array(__CLASS__,'gt_talent_page_archive_filters'),20);
         add_action('gt_talent_page_archive', array(__CLASS__,'gt_talent_page_archive_listing'),30);


         /** Talent Author Page */
         add_action('gt_talent_packages', array(__CLASS__,'gt_talent_show_packages'),10,1);

         /** Talent Veritifcation Notice | Header */
         add_action('wp_head', array(__CLASS__,'gt_show_verification_alert'));


         /** Badges for Sidebar Links */
         add_action('sidebar_link_gotalent-dashboardmanage-invitations', function(){
            if(current_user_can('can_be_hired')){
                echo GTInvitationPostType::count_unresponded_invitations(get_current_user_id());
            }
         });
    
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
        if(!is_front_page()) return;
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
        $user_verified = (get_user_meta($user->ID, 'verified', true)) ? 'true' : 'false';
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
     * @todo - Combine this and Template Include together, load these pages from .env file so pages
     * can be created with just single change.
     * 
     */
    public static function gt_dashboard_sidebar_links()
    {
        $sidebar_links = [
            'gotalent-dashboard/manage-profile' => __('Manage Profile', 'gotalent-core'),
            'gotalent-dashboard/manage-bookings' => __('Manage Bookings', 'gotalent-core'),
            'gotalent-dashboard/manage-invitations' => __('Manage Invitations', 'gotalent-core'),
            'gotalent-dashboard/invitations-sent' => __('Manage Invitations', 'gotalent-core'),
            'gotalent-dashboard/manage-availability' => __('Manage Availability', 'gotalent-core'),
            'gotalent-dashboard/manage-talent' => __('Manage Talent', 'gotalent-core'),
            'gotalent-dashboard/manage-recruiters' => __('Manage Recruiters', 'gotalent-core'),
            'gotalent-dashboard/manage-talent-categories' => __('Talent Categories', 'gotalent-core'),
            'gotalent-dashboard/manage-packages' => __('Packages', 'gotalent-core'),
            'gotalent-dashboard/manage-media' => __('Manage Media', 'gotalent-core'),
            'gotalent-dashboard/manage-verification-settings' => __('Vertification Settings', 'gotalent-core'),
            'gotalent-dashboard/manage-payment-settings' => __('Payment Settings', 'gotalent-core'),
            'gotalent-dashboard/earnings' => __('Earnings', 'gotalent-core'),
            'gotalent-dashboard/messages' => __('Messages', 'gotalent-core'),
            'gotalent-dashboard/site-settings' => __('Settings', 'gotalent-core'),
            'gotalent-dashboard/pending-talent-verification' => __('Pending Talent Verification', 'gotalent-core'),
        ];

        $role = wp_get_current_user()->roles[0];
        switch ($role) {
            case 'recruiter':
                unset($sidebar_links['gotalent-dashboard/manage-availability']);
                unset($sidebar_links['gotalent-dashboard/manage-profile']);
                unset($sidebar_links['gotalent-dashboard/manage-recruiters']);
                unset($sidebar_links['gotalent-dashboard/manage-talent']);
                unset($sidebar_links['gotalent-dashboard/site-settings']);
                unset($sidebar_links['gotalent-dashboard/manage-payment-settings']);
                unset($sidebar_links['gotalent-dashboard/manage-talent-categories']);
                unset($sidebar_links['gotalent-dashboard/manage-verification-settings']);
                unset($sidebar_links['gotalent-dashboard/pending-talent-verification']);
                unset($sidebar_links['gotalent-dashboard/manage-packages']);
                unset($sidebar_links['gotalent-dashboard/earnings']);
                unset($sidebar_links['gotalent-dashboard/manage-media']);
                unset($sidebar_links['gotalent-dashboard/manage-invitations']);
                
                break;
                case 'talent':
                    unset($sidebar_links['gotalent-dashboard/manage-recruiters']);
                    unset($sidebar_links['gotalent-dashboard/messages']);
                    unset($sidebar_links['gotalent-dashboard/manage-talent']);
                    unset($sidebar_links['gotalent-dashboard/manage-talent-categories']);
                    unset($sidebar_links['gotalent-dashboard/site-settings']);
                    unset($sidebar_links['gotalent-dashboard/pending-talent-verification']);
                    unset($sidebar_links['gotalent-dashboard/invitations-sent']);
                    if(get_user_meta(get_current_user_id(), 'verified', true)){
                        unset($sidebar_links['gotalent-dashboard/manage-verification-settings']);
                    }
                    
                        break;
                default:
                    unset($sidebar_links['gotalent-dashboard/manage-availability']);
                    unset($sidebar_links['gotalent-dashboard/messages']);
                    unset($sidebar_links['gotalent-dashboard/manage-payment-settings']);
                    unset($sidebar_links['gotalent-dashboard/manage-verification-settings']);
                    unset($sidebar_links['gotalent-dashboard/manage-profile']);
                    unset($sidebar_links['gotalent-dashboard/manage-packages']);
                    unset($sidebar_links['gotalent-dashboard/manage-media']);

                    unset($sidebar_links['gotalent-dashboard/invitations-sent']);
                    
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



    /** 
     * Archive Page: Talent
     * Priority: 10 
     * Description: Show BreadCrumb
     */
    public static function show_breadcrumb($title, $subtitle)
    {
        GTHelpers::gt_get_template_part('breadcrumb.php',array('title' => $title,'subtitle' => $subtitle));
    }
    
    
    /** 
     * Archive Page: Talent
     * Priority: 20 
     * Description: Show Filters
     */
    public static function gt_talent_page_archive_filters()
    {
        GTHelpers::gt_get_template_part('talent-filters-horizontal.php');
    }
    
    
    /** 
     * Archive Page: Talent
     * Priority: 30 
     * Description: Show Listing
     */
    public static function gt_talent_page_archive_listing()
    {
        GTHelpers::gt_get_template_part('talent-listing.php');
    }



    /** 
     * gt_talent_show_packages
     */
    public static function gt_talent_show_packages($talent_id)
    {
        $packages = GTPackagePostType::gt_get_all_talent_packages($talent_id);
        GTHelpers::gt_get_template_part('talent-packages.php', $packages);
    }


    /** 
     * 
     */
    public static function gt_show_verification_alert()
    {
        $user = wp_get_current_user();
        if(!get_user_meta($user->ID, 'verified', true) && current_user_can('can_be_hired')){
            GTHelpers::gt_get_template_part('talent-verification-notice-header.php',[]);
        }
    }

    
}

GTThemeHelper::init();

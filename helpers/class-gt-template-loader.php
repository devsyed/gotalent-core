<?php
class GTTemplateLoader
{
    public static function init()
    {
        add_filter('template_include', array(__CLASS__, 'gt_template_include'), 10, 1);
    }

    public static function gt_prepare_endpoints()
    {
        $endpoints = array(
            'gotalent-dashboard/manage-profile' => array(
                'allowed_capabilities' => array('can_be_hired'),
            ),
            'gotalent-dashboard/site-settings' => array(
                'allowed_capabilities' => array('can_manage_recruiter_and_talent'),
            ),
            'gotalent-dashboard/pending-talent-verification' => array(
                'allowed_capabilities' => array('can_manage_recruiter_and_talent'),
                'single_page' => 'gotalent-dashboard/talent/unverified_single'
            ),
            'gotalent-dashboard/manage-bookings' => array(
                'single_page' => 'gotalent-dashboard/bookings/single',
            ),
            'gotalent-dashboard/notifications' => array(),
            'gotalent-dashboard/earnings' => array(),
            'gotalent-dashboard/manage-recruiters' => array(
                'allowed_capabilities' => array('can_manage_recruiter_and_talent'),
                'single_page' => 'gotalent-dashboard/recruiters/index'
            ),
            'gotalent-dashboard/manage-talent' => array(
                'allowed_capabilities' => array('can_manage_recruiter_and_talent'),
                'single_page' => 'gotalent-dashboard/talent/verified_single'
            ),
            'gotalent-dashboard/messages' => array(
                'allowed_capabilities' => array('can_be_hired', 'can_hire_talent'),
            ),
            'gotalent-dashboard/manage-payment-settings' => array(
                'allowed_capabilities' => array('can_be_hired', 'can_hire_talent'),
            ),
            'gotalent-dashboard/manage-verification-settings' => array(
                'allowed_capabilities' => array('can_be_hired')
            ),
            'gotalent-dashboard/manage-availability' => array(
                'allowed_capabilities' => array('can_be_hired')
            ),
            'gotalent-dashboard/manage-talent-categories' => array(
                'allowed_capabilities' => array('can_manage_talent_categories'),
                'add_new_page' => 'gotalent-dashboard/talent-categories/add',
                'single_page' => 'gotalent-dashboard/talent-categories/single',
            ),
            'gotalent-dashboard/invitations-sent' => array(
                'allowed_capabilities' => array('can_hire_talent'),
                'single_page' => 'gotalent-dashboard/invitations/sent-invitation-single',
            ),
            'gotalent-dashboard/manage-packages' => array(
                'allowed_capabilities' => array('can_be_hired'),
                'add_new_page' => 'gotalent-dashboard/packages/add',
                'single_page' => 'gotalent-dashboard/packages/single'
            ),
            'gotalent-dashboard/manage-invitations' => array(
                'allowed_capabilities' => array('can_be_hired', 'can_manage_recruiter_and_talent'),
                'single_page' => 'gotalent-dashboard/invitations/single'
            ),
            'gotalent-dashboard/manage-media' => array(
                'allowed_capabilities' => array('can_be_hired'),
            ),
            'buy-package' => array(
                'single_page' => 'buy-package',
                'requires_authentication' => false,
            ),
            'book-talent' => array(
                'single_page' => 'book-talent',
            ),
            'payment-successful' => array(
                'single_page' => 'payment-successful',
            )
        );
        return apply_filters('gt_allowed_endpoints', $endpoints);
    }

    public static function gt_template_include($template)
    {
        global $wp, $wp_query;
        $current_page = $wp->request;
        $wp_query->is_404 = false;
        $user = wp_get_current_user();
        $all_endpoints = self::gt_prepare_endpoints();

        if (!isset($all_endpoints[$current_page])) {
            return $template;
        }

        $endpoint = $all_endpoints[$current_page];
        $authentication_required = !isset($endpoint['requires_authentication']) || $endpoint['requires_authentication'];

        if ($authentication_required && !is_user_logged_in()) {
            return $template;
        }

        if (isset($endpoint['allowed_capabilities'])) {
            $user_capabilities = $user->allcaps;
            $allowed_capabilities = $endpoint['allowed_capabilities'];
            $user_can_access = false;

            foreach ($allowed_capabilities as $capability) {
                if (isset($user_capabilities[$capability]) && $user_capabilities[$capability]) {
                    $user_can_access = true;
                    break;
                }
            }

            if (!$user_can_access) {
                return $template;
            }
        }

        if (isset($_GET['query_id'])) {
            $template = GTHelpers::gt_get_template_part($endpoint['single_page'] . '.php');
            return $template;
        }

        if (isset($_GET['add_new'])) {
            $template = GTHelpers::gt_get_template_part($endpoint['add_new_page'] . '.php');
            return $template;
        }

        if (isset($endpoint['template_url'])) {
            $template = GTHelpers::gt_get_template_part($endpoint['template_url']);
        } else {
            $template = GTHelpers::gt_get_template_part($current_page . '.php');
        }


        status_header(200);

        return $template;
    }
}

GTTemplateLoader::init();

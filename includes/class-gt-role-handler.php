<?php 


defined('ABSPATH') || exit; 

class GTRolesHandler
{
    public static function init()
    {
        add_action('init', array(__CLASS__, 'gt_add_custom_roles'));
        add_action('init', array(__CLASS__, 'gt_add_custom_capabilities'));
    }


    public static function gt_add_custom_roles()
    {
        add_role('talent','Talent');
        add_role('recruiter','Recruiter');
    }

    public static function gt_add_custom_capabilities()
    {
        $roles = array(
            'talent' => array(
                'can_be_hired',
                'generate_payment_link'
            ), 
            'recruiter' => array(
                'can_hire_talent',
            ), 
            'administrator' => array(
                'can_manage_recruiter_and_talent',
                'can_manage_talent_categories'
            )
        );
        foreach ($roles as $role_key => $capabilities) {
            $role = get_role($role_key);
            foreach ($capabilities as $cap) {
                $role->add_cap($cap);
            }
        }
    }

}

GTRolesHandler::init();
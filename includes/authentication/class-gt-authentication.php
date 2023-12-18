<?php

defined('ABSPATH') || exit; 

class GTAuthentication
{

    public static function gt_user_login($username,$password,$remember = false)
    {
        if ( is_user_logged_in() ) return new WP_Error(__('User is already logged in.','gotalent-core'));
        $user_id = wp_signon(array(
            'user_login' => $username,
            'user_password' => $password,
            'remember' => $remember,
        ),false);

        if (is_wp_error($user_id)) {
            echo $user_id->get_error_message();
        } else {
            wp_set_auth_cookie($user_id->ID, true);
        }
        return $user_id->ID;
    }


    public static function gt_register_user($user_details)
    {
        $required_fields = array('first_name', 'last_name', 'email_address', 'password', 'apply_as', 'phone_number');

        foreach ($required_fields as $field) {
            if (!isset($user_details[$field]) || $user_details[$field] == '') {
                return new WP_Error('missing-field', ucwords( str_replace('_', ' ', $field)) . ' is missing.');
            }
        }

        if (is_user_logged_in()) {
            return new WP_Error('user-logged-in', 'User is already logged in.');
        }

        if (email_exists($user_details['email_address'])) {
            return new WP_Error('user-exists', 'User with this email already exists. Try logging in.');
        }   

        $user_data = [
            'first_name' => $user_details['first_name'],
            'last_name' => $user_details['last_name'],
            'user_email' => $user_details['email_address'],
            'user_login' => $user_details['email_address'],
            'user_pass' => $user_details['password'],
            'role' => $user_details['apply_as'],
        ];

        $user_id = wp_insert_user($user_data);
 
        $talent_post_id = wp_insert_post(array(
            'post_type' => $user_details['apply_as'],
            'post_title' => $user_details['first_name'] . ' ' . $user_details['last_name'],
            'post_status' => 'draft',
        ));
        update_post_meta($talent_post_id,'linked_user_id' , $user_id);

        if (!is_wp_error($user_id)) {
            update_user_meta($user_id, 'phone_number', $user_details['phone_number']);
            update_user_meta($user_id,'linked_post_id', $talent_post_id);
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);
        }

        return $user_id;
    }




    
}
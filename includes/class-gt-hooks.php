<?php 

defined('ABSPATH') || exit; 

class GTHooks
{
    public static function init()
    {
        add_filter('logout_redirect', array(__CLASS__,'gt_redirect_to_home'),10, 3);
        add_filter('login_redirect', function(){ return 'gotalent-dashboard/manage-profile'; });


        /** After Registration Hook */
        add_action('user_register', array(__CLASS__, 'gt_send_email_new_account'), 10,1 );
        add_action('user_register', array(__CLASS__, 'gt_create_user_specific_folder'), 20,1 );

      
    }


    /** 
     * Create Private Folder for User
     */
    public static function gt_create_user_specific_folder($user_id)
    {
        $random_string = md5($user_id,'user_files');
        if ( ! is_dir( ABSPATH . '/wp-content/uploads/' . $random_string) ) {
            update_user_meta($user_id,'secure_folder_name', $random_string);
            wp_mkdir_p( ABSPATH . '/wp-content/uploads/'  . $random_string);
        }
    }


    /** 
     * Redirect User to Homepage after Logout. 
     * 
     */
    public static function gt_redirect_to_home($redirect_to,$requested_redirect_to,$user)
    {
        return esc_url(home_url());
    }


    public static function gt_send_email_new_account($user_id)
    {
        $user = get_user_by('id',$user_id);
        $mail = GTMailer::gt_send_mail($user->user_email,'welcome@gotalent.com','GoTalent','Welcome to GoTalent - Account Information', 'emails/new-registration.php');
        if($mail){
            update_user_meta($user_id,'welcome_email_sent', true);
            return true;
        }
        return $mail;
    }

}

GTHooks::init();
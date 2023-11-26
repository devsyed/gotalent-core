<?php 

defined('ABSPATH') || exit; 


class GTOverrideBetterMessages
{
    public static function init()
    {
        add_filter('gt_message_users_list', array(__CLASS__,'gt_show_selected_message_recipeients'),10, 1);
        add_filter('better_messages_search_user_results', array(__CLASS__,'gt_show_selected_message_search_users'));

        
    }


    /** 
     * Show Selected Message Recipients 
     * Better Messages right now shows all users in the new message list, 
     * this function now restricts it from showing all and shows only recruiters and talents they have
     * sent intivitation to. 
     * @param array $users 
     * @return $users
     */
    public static function gt_show_selected_message_recipeients($users)
    {
        $current_user = wp_get_current_user();
        $talent_or_recruiter = current_user_can('can_be_hired') ? 'recruiters' : 'talents';
        $allowed_users = get_user_meta($current_user->ID, 'allowed_message_'.$talent_or_recruiter.'_recipients', true);
        foreach($allowed_users as $allowed_user){
            $users[] = get_user_by('id', $allowed_user);
        }
        return $users;
    }
    
    
    /** 
     * Show Selected Message Recipients 
     * Better Messages right now shows all users in the new message list, 
     * this function now restricts it from showing all and shows only recruiters and talents they have
     * sent intivitation to. 
     * @return array $user_ids in array
     */
    public static function gt_show_selected_message_search_users()
    {
        $current_user = wp_get_current_user();
        $talent_or_recruiter = current_user_can('can_be_hired') ? 'recruiters' : 'talents';
        $allowed_users = get_user_meta($current_user->ID, 'allowed_message_'.$talent_or_recruiter.'_recipients', true);
        foreach($allowed_users as $allowed_user){
            $users[] = $allowed_user;
        }
        return $users;
    }

}

GTOverrideBetterMessages::init();
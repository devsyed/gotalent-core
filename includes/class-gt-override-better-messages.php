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
       return [];
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
       return [1];
    }
}

GTOverrideBetterMessages::init();
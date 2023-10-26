<?php 

class GTUserHandler{

    

    /** 
     * Process User Meta
     * updates user_meta and also linked post_meta
     */
    public static function gt_process_user_meta($user_id,$fields)
    {
        if (!$user_id) {
            return new WP_Error('no-user-id-for-meta', 'Provide User ID to store meta information.');
        }
        $post_id = get_user_meta($user_id, 'linked_post_id', true);
        if (!empty($fields)) {
            foreach ($fields as $key => $field) {
                
                $meta_key = (strpos($key, '_meta_') !== false) ? str_replace('_meta_', '', $key) : $key;
                update_user_meta($user_id, $meta_key, $field);
                update_post_meta($post_id, $meta_key, $field);
            }
        }
        
        return true;
        
    }

    /** 
     * Update User Data
     */
    public static function gt_update_user_data($user_id, $data)
    {
        $user_data = array(
            'ID' => $user_id, 
            'user_email' => $data['email_address'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
        );
        if($data['password'] !== ''){
            $user_data['user_pass'] = $data['password'];
        }

        $update_user = wp_update_user($user_data);
        return $update_user;
    }


    /** 
     * Upload Images for User
     */
    public static function gt_user_handle_images($user_id, $files, $image_id, $directory = '')
    {
        $links = GTFormHelper::save_files($files,$directory);
        return $links;
    }

}

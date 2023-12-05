<?php 

defined('ABSPATH') || exit; 

class GTAjaxHandler
{
    public static $ajax_actions = [
        'gotalent_authenticate_login',
        'gotalent_authenticate_register', 
        'gotalent_generate_payment_link',
        'gotalent_talent_categories_add_new',
        'gotalent_get_talent_subcategories',
        'gotalent_user_process_meta',
        'gt_upload_images',
        'gotalent_availabilities_update_days',
        'gotalent_packages_add_package',
        'gotalent_talent_add_portfolio',
        'gotalent_store_package_session',
        'gotalent_create_invitation',
        'gotalent_accept_invitation',
        'gotalent_talent_approve_talent'

    ];

    public static function load_all_ajax_scripts()
    {
        foreach (self::$ajax_actions as $ajax_action) {
            add_action('wp_ajax_' . $ajax_action, [__CLASS__, $ajax_action]);
            add_action('wp_ajax_nopriv_' . $ajax_action, [__CLASS__, $ajax_action]);
        }
    }

    /**
     * Handle AJAX response with consistent error handling.
     *
     * @param mixed  $response
     * @param string $success_message
     */
    public static function handle_ajax_response($response, $success_message = 'Request successful')
    {
        if (is_wp_error($response)) {
            self::send_ajax_error($response);
        } else {
            self::send_ajax_success(['message' => $success_message]);
        }
    }

    /**
     * Send an AJAX error response with appropriate HTTP status code.
     *
     * @param WP_Error $wp_error
     */
    public static function send_ajax_error($wp_error)
    {
        $error_data = [
            'code'    => 0,
            'message' => $wp_error->get_error_message(),
        ];
        $http_status_code = $wp_error->get_error_code();

        wp_send_json_error($error_data, $http_status_code);
    }

    /**
     * Send an AJAX success response.
     *
     * @param array $data
     */
    public static function send_ajax_success($message)
    {
        wp_send_json_success(['code' => 1, 'message' => $message]);
    }

    /**
     * Verify a nonce and handle rejection.
     *
     * @param string $nonce
     * @param string $action
     */
    public static function verify_nonce($nonce, $action)
    {
        if (!wp_verify_nonce($nonce, $action)) {
            self::send_ajax_error(new WP_Error('unauthorized', 'You are not authorized to make this request.'));
        }
    }


    /**
     * GoTalent Authenticate | Login User
     */
    public static function gotalent_authenticate_login()
    {
        try {
            parse_str($_POST['formData'], $data);

            self::verify_nonce($data['gotalent_login_nonce'], 'gotalent_login');

            $user_log_in = GTAuthentication::gt_user_login($data['user_login'], $data['password'], true);

            if (is_wp_error($user_log_in)) {
                self::send_ajax_error($user_log_in);
            }

            self::send_ajax_success('User Logged in Succesfully, Redirecting to your dashboard.');
        } catch (Error $err) {
            self::send_ajax_error(new WP_Error('internal_error', $err->getMessage()));
        }
    }
    
    
    /** 
     * GoTalent Authenticate | Register User
     * gotalent_register_nonce
     */
    public static function gotalent_authenticate_register()
    {
        try {
            parse_str($_POST['formData'], $data);

            self::verify_nonce($data['gotalent_register_nonce'], 'gotalent_register');

            $register_user = GTAuthentication::gt_register_user($data);

            if (is_wp_error($register_user)) {
                self::send_ajax_error($register_user);
            }
            self::send_ajax_success('Account Created Succesfully, Redirecting to your dashboard.');
        } catch (Error $err) {
            self::send_ajax_error(new WP_Error('internal_error', $err->getMessage()));
        }
    }


    public static function gotalent_generate_payment_link()
    {
        try{
            parse_str($_POST['formData'], $data);
            self::verify_nonce($data['gotalent_generate_payment_link_nonce'], 'gotalent_generate_payment_link');
            
            $url = GTPaymentHandler::gt_create_payment_link($data['total_amount'], $data['booking_details']);
            if (is_wp_error($url)) {
                self::send_ajax_error($url);
            }
            self::send_ajax_success($url);
        }
        catch (Error $err) {
            self::send_ajax_error(new WP_Error('internal_error', $err->getMessage()));
        }
    }

    public static function gotalent_talent_categories_add_new()
    {
        try{
            parse_str($_POST['formData'], $data);
            self::verify_nonce($data['gotalent_add_category_nonce'], 'gotalent_add_category');
            
            $term = GTTaxonomy_Talent_Category::gt_create_talent_category($data['category_name'], $data['parent_category']);
            if (is_wp_error($term)) {
                self::send_ajax_error($term);
            }
            self::send_ajax_success($term);
        }
        catch (Error $err) {
            self::send_ajax_error(new WP_Error('internal_error', $err->getMessage()));
        }
    }

    public static function gotalent_get_talent_subcategories()
    {
        $cats = GTTaxonomy_Talent_Category::gt_get_all_talent_categories($_GET['parent_id']);
        self::send_ajax_success($cats);
    }

    public static function gotalent_user_process_meta()
    {
        $meta_fields = [];
        $non_meta_fields = [];
        try{
            parse_str($_POST['formData'], $data);
            foreach ($data as $key => $value) {
                if (strpos($key, '_meta_') === 0) {
                    $meta_fields[$key] = $value;
                } else {
                    $non_meta_fields[$key] = $value;
                }
            }
            $user_info_update = GTUserHandler::gt_update_user_data(get_current_user_id(),$non_meta_fields);
            if (is_wp_error($user_info_update)) {
                self::send_ajax_error($user_info_update);
            }
            $meta_updated = GTUserHandler::gt_process_user_meta(get_current_user_id(),$meta_fields);
            self::send_ajax_success($meta_updated);

        }
        catch (Error $err) {
            self::send_ajax_error(new WP_Error('internal_error', $err->getMessage()));
        }
    }

    public static function gt_upload_images()
    {
        $image_id = $_REQUEST['id'];
        try{
            $link = GTUserHandler::gt_user_handle_images(get_current_user_id(),$_FILES,$image_id);
            self::send_ajax_success($link);
        }catch(Error $err){
            self::send_ajax_error(new WP_Error('internal_error', $err->getMessage()));
        }
    }

    public static function gotalent_availabilities_update_days()
    {
        parse_str($_POST['formData'],$data);
        $availabilities_updated = GTUserHandler::gt_process_user_meta(get_current_user_id(),$data);
        self::send_ajax_success($availabilities_updated);
    }

    public static function gotalent_packages_add_package()
    {
        try{
            parse_str($_POST['formData'], $data);
            $package_create = GTPackagePostType::create_package(get_current_user_id(),$data);
            if (is_wp_error($package_create)) {
                self::send_ajax_error($package_create);
            }
            self::send_ajax_success($package_create);

        }
        catch (Error $err) {
            self::send_ajax_error(new WP_Error('internal_error', $err->getMessage()));
        }
    }

    public static function gotalent_talent_add_portfolio()
    {
        $pieces = explode("&", $_POST['formData']);
        $result = array();
        $metaFields = array();
        foreach ($pieces as $piece) {
            $pair = explode("=", $piece);
            $key = urldecode($pair[0]);
            $value = urldecode($pair[1]);

            if (strpos($key, '_meta_') !== false) {
                $metaFields[$key] = $value;
            }

            if (!isset($result[$key])) {
                $result[$key] = array();
            }

            $result[$key][] = $value;
        }
        update_user_meta(get_current_user_id(), 'portfolio_links', $result['_meta_portfolio_links']);
        update_user_meta(get_current_user_id(), 'portfolio_video_links', $metaFields);
    }

    public static function gotalent_store_package_session()
    {
        try{
            parse_str($_POST['session'],$session);
            set_transient(get_current_user_id() . '_package_purchase_session', $session);
            self::send_ajax_success('Session Stored Successfully.');
        }
        catch(Error $er){
            self::send_ajax_error($er);
        }
    }

    public static function gotalent_create_invitation()
    {
        try{
            parse_str($_POST['formData'],$data);
            $title = 'Booking Request ';
            $invitation_created = GTInvitationPostType::gt_create_invitation_request($title,$data);
            if (is_wp_error($invitation_created)) {
                self::send_ajax_error($invitation_created);
            }
            self::send_ajax_success($invitation_created);
        }
        catch(Error $er){
            self::send_ajax_error($er);
        }
    }

    public static function gotalent_accept_invitation()
    {
        try {
            parse_str($_POST['formData'], $data);
            $accept_invite = GTInvitationPostType::gt_accept_invitation_request($data['invitation_id']);
            self::send_ajax_success($accept_invite);
        } catch (\Throwable $th) {
            self::send_ajax_error($th);
        }

    }
    
    public static function gotalent_talent_approve_talent()
    {
        try {
            parse_str($_POST['formData'], $data);
            $approve_talent = GTTalentPostType::gt_verify_talent($data['talent_id']);
            if($approve_talent){
                self::send_ajax_success('Talent Approved');
            }
        } catch (\Throwable $th) {
            self::send_ajax_error($th);
        }
    }
}

GTAjaxHandler::load_all_ajax_scripts();

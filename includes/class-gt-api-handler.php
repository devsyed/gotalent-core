<?php 
defined('ABSPATH') || exit; 

class GTApiHandler
{
    public static $api_prefix = 'gotalent/v1';

    public static $routes = [
        '/register' => ['method' => 'POST', 'callback' => 'register_user', 'permission_callback' => '__return_true'],
        '/login' => ['method' => 'POST', 'callback' => 'login_user', 'permission_callback' => '__return_true']
    ];

    public static function init()
    {
        add_action('rest_api_init', [__CLASS__, 'gt_register_custom_routes']);
    }

    /** 
     * Register Custom API Routes | GoTalent
     */
    public static function gt_register_custom_routes()
    {
        foreach (self::$routes as $route => $route_data) {
            $route_callback = isset($route_data['callback']) ? $route_data['callback'] : null;
            $route_methods = isset($route_data['method']) ? $route_data['method'] : 'GET';
            $route_permission_callback = isset($route_data['permission_callback']) ? $route_data['permission_callback'] : '__return_true';

            register_rest_route(self::$api_prefix, $route, array(
                'methods' => $route_methods,
                'callback' => $route_callback ? array(__CLASS__, $route_callback) : null,
                'permission_callback' => $route_permission_callback
            ));
        }
    }


    /** 
     * Register User | GoTalent API 
     * @url /gotalent/v1/register
     * @method POST
     */
    public static function register_user($request)
    {
        $parameters = $request->get_params();

        if(is_user_logged_in()) return new WP_Error(__('User already Logged In', 'gotalent-core'));

        if(email_exists($parameters['email_address'])){
            return wp_send_json_error(__('Email already exists.', 'gotalent-core'));
        }
        if($parameters['email_address'] == '' || $parameters['password'] == ''){
            return wp_send_json_error(__('Username and Password are required fields.', 'gotalent-core'));
        }
        try{
            $user_id = GTAuthentication::gt_register_user($parameters);
            if(is_wp_error($user_id)){
                return new WP_Error('missing-field', $user_id->get_error_message());
            }
            $request = new WP_REST_Request( 'POST', '/jwt-auth/v1/token' );
            $request->set_query_params(array(
                'username' => $parameters['email_address'],
                'password' => $parameters['password']
            ));
            $response = rest_do_request( $request );
            update_user_meta($user_id->ID,'last_logged_in',time());
            update_user_meta($user_id->ID,'last_token_used',$response->data['token']);
            /** Do Registration Action */
            
            return wp_send_json_success($response->data['token']);
        }catch(Exception $err){
            return wp_send_json_error($err);
        }
    }


    /** 
     * Login User | GoTalent 
     * @url /gotalent/v1/login_user
     * @method POST
     */
    public static function login_user($request)
    {
        $parameters = $request->get_params();

        if(is_user_logged_in()) return new WP_Error(__('User already Logged In', 'gotalent-core'));

        if(!email_exists($parameters['email_address'])){
            return wp_send_json_error(__('No User with such email exists.', 'gotalent-core'));
        }
        if($parameters['email_address'] == '' || $parameters['password'] == ''){
            return wp_send_json_error(__('Username and Password are required fields.', 'gotalent-core'));
        }

        try{
            $user_id = GTAuthentication::gt_user_login($parameters['email_address'],$parameters['password']);
            if(is_wp_error($user_id)){
                wp_send_json_error(strip_tags(__($user_id->get_error_message(), 'gotalent-core')));
            }
            $request = new WP_REST_Request( 'POST', '/jwt-auth/v1/token' );
            $request->set_query_params(array(
                'username' => $parameters['email_address'],
                'password' => $parameters['password']
            ));
            $response = rest_do_request( $request );
            update_user_meta($user_id->ID,'last_logged_in',time());
            update_user_meta($user_id->ID,'last_token_used',$response->data['token']);
            return wp_send_json_success($response->data['token']);
        }catch(Exception $err){
            return wp_send_json_error($err);
        }



    }
}

GTApiHandler::init();

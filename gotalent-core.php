<?php 
/*
Plugin Name: GoTalent Core Plugin 
Description: Handles all the core functionality of GoTalent Web App.
Version: 1.0
Author: DevSyed
Author URL: https://devsyed.com
*/

defined( 'ABSPATH' ) || exit;
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

final class GoTalent {

    private static $instance;

    public static function get_instance() {
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof GoTalent ) ) {
            self::$instance = new GoTalent;
        }
        return self::$instance;
    }

    private function __construct() {
        $this->setup_constants();
        $this->includes();
        $this->register_hooks();
    }

    private function setup_constants()
    {
        define('GOTALENT_VER', '1.0');
        define('GOTALENT', __FILE__);
        define('GOTALENT_CORE', plugin_dir_url(__FILE__));
        define('GOTALENT_ADMIN', plugin_dir_url(__FILE__) . 'admin');
        define('GOTALENT_ADMIN_ASSETS', plugin_dir_url(__FILE__) . 'admin/assets');
        define('GOTALENT_PUBLIC_ASSETS', plugin_dir_url(__FILE__) . 'assets');
        define('GOTALENT_PLUGIN_PATH', plugin_dir_path(__FILE__));

        define('GOTALENT_TEXT_DOMAIN', 'gotalent-core');
    }

    private function includes() 
    {
        require_once GOTALENT_PLUGIN_PATH . '/helpers/class-gt-helpers.php';
        require_once GOTALENT_PLUGIN_PATH . '/helpers/class-gt-template-loader.php';
        require_once GOTALENT_PLUGIN_PATH . '/helpers/class-gt-theme-helper.php';
        require_once GOTALENT_PLUGIN_PATH . '/includes/class-gt-form-helper.php';

        require_once GOTALENT_PLUGIN_PATH . '/includes/class-gt-role-handler.php';
        require_once GOTALENT_PLUGIN_PATH . '/includes/class-gt-payment-handler.php';
        require_once GOTALENT_PLUGIN_PATH . '/includes/class-gt-mailer.php';
        require_once GOTALENT_PLUGIN_PATH . '/includes/class-gt-spotlight-handler.php';

        /** Post Types | GoTalent  */
        require_once GOTALENT_PLUGIN_PATH . '/includes/post-types/class-post-type-withdraw.php';
        require_once GOTALENT_PLUGIN_PATH . '/includes/post-types/class-post-type-talent.php';
        require_once GOTALENT_PLUGIN_PATH . '/includes/post-types/class-post-type-notification.php';
        require_once GOTALENT_PLUGIN_PATH . '/includes/post-types/class-post-type-recruiter.php';
        require_once GOTALENT_PLUGIN_PATH . '/includes/post-types/class-post-type-invitation.php';
        require_once GOTALENT_PLUGIN_PATH . '/includes/post-types/class-post-type-booking.php';
        require_once GOTALENT_PLUGIN_PATH . '/includes/post-types/class-post-type-packages.php';

        /** Taxonomy | GoTalent */
        require_once GOTALENT_PLUGIN_PATH . '/includes/taxonomies/class-taxonomy-talent-categories.php';

        /** Pages Helper */
        require_once GOTALENT_PLUGIN_PATH . '/includes/class-gt-pages-helper.php';

        /** AJAX Handler */
        require_once GOTALENT_PLUGIN_PATH . '/includes/class-gt-ajax-handler.php';
        
        /** User Functions */
        require_once GOTALENT_PLUGIN_PATH . '/includes/authentication/class-gt-authentication.php';
        require_once GOTALENT_PLUGIN_PATH . '/includes/class-gt-user-handler.php';
        
        
        /** Shortcode Handler */
        require_once GOTALENT_PLUGIN_PATH . '/includes/class-gt-shortcode-handler.php';



        /** API Handler */
        require_once GOTALENT_PLUGIN_PATH . '/includes/class-gt-api-handler.php';


        /** CMB2 Fields */
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2-conditionals/cmb2-conditionals.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2_field_map/cmb-field-map.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2_field_tags/cmb2-field-type-tags.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2_field_file/cmb2-field-type-file.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2_field_attached_user/cmb2-field-type-attached_user.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2_field_profile_url/cmb2-field-type-profile_url.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2_field_image_select/cmb2-field-type-image-select.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb_field_select2/cmb-field-select2.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb_field_taxonomy_select2/cmb-field-taxonomy-select2.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb_field_taxonomy_select2_search/cmb-field-taxonomy-select2-search.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2_field_ajax_search/cmb2-field-ajax-search.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb_field_taxonomy_location/cmb-field-taxonomy-location.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb_field_taxonomy_location_search/cmb-field-taxonomy-location-search.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2-hide-show-password-field/cmb2-hide-show-password.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2_field_rate_exchange/cmb2-field-type-rate_exchange.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2_field_datepicker/cmb2-field-type-datepicker.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2_field_datepicker2/cmb2-field-type-datepicker2.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2_field_addons/cmb2-field-type-addons.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2_field_payout_details/cmb2-field-type-payout-details.php';
        require_once GOTALENT_PLUGIN_PATH . 'libraries/cmb2/cmb2-tabs/plugin.php';
        

        require_once GOTALENT_PLUGIN_PATH . 'includes/class-gt-hooks.php';

        require_once GOTALENT_PLUGIN_PATH . 'includes/class-gt-override-better-messages.php';

        require_once GOTALENT_PLUGIN_PATH . 'widgets/gt-include-elementor-widgets.php';
    }

    private function register_hooks()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts_and_styles']);

        add_action('wp_head', function(){
            // $mail = GTMailer::gt_send_mail('9uiu7k023k@secretmail.net', 'welcome@gotalent.com', 'GoTalent', 'New Account Creation!', 'emails/admin-new-registration.php',array('invitation_id' => ''));
        });
    }

    public function enqueue_scripts_and_styles() 
    {
        wp_enqueue_script('datatables-js', '//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js', array(), '1.0', true);
       
        wp_enqueue_script('toast-js',GOTALENT_PUBLIC_ASSETS . '/toast.min.js', array(), '1.0', true );
        wp_enqueue_script('dropzone-js',GOTALENT_PUBLIC_ASSETS . '/dropzone.js', array(), '1.0', true );
        wp_enqueue_script('fullcalendar-js',GOTALENT_PUBLIC_ASSETS . '/fullcalendar.js', array(), '1.0', true );
        wp_enqueue_script('select2-js',GOTALENT_PUBLIC_ASSETS . '/select2.js', array(), '1.0', true );
        wp_enqueue_script('sweetalert-js',GOTALENT_PUBLIC_ASSETS . '/sweetalert.js', array(), '1.0', true );
        wp_enqueue_script( 'jquery-ui-datepicker' );
        wp_enqueue_script('multistep-js',GOTALENT_PUBLIC_ASSETS . '/multi-step.js', array('jquery'), '1.0', true );
        wp_enqueue_script('gt-core-js',GOTALENT_PUBLIC_ASSETS . '/core.js', array('jquery','wp-tinymce','dropzone-js'), '1.0', true );

        wp_enqueue_script('lightbox-gallery',GOTALENT_PUBLIC_ASSETS . '/lightgallery.min.js', array('jquery'), '1.0', true );



        wp_enqueue_style('dropzone-css',GOTALENT_PUBLIC_ASSETS . '/dropzone.css', array(), '1.0', 'all' );
        wp_enqueue_style('datatables-css','//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css', array(), '1.0', 'all' );
        wp_enqueue_style('fontawesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), '1.0', 'all' );
        wp_enqueue_style('select2-css',GOTALENT_PUBLIC_ASSETS . '/select2.css', array(), '1.0', 'all' );
        wp_enqueue_style('toast-css',GOTALENT_PUBLIC_ASSETS . '/toast.min.css', array(), '1.0', 'all' );
        wp_register_style( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css' );
        wp_enqueue_style( 'jquery-ui' );  
        wp_enqueue_style('gt-core-css',GOTALENT_PUBLIC_ASSETS . '/core.css', array(), '1.0', 'all' );
        wp_enqueue_style('lightbox-gallery',GOTALENT_PUBLIC_ASSETS . '/lightbox.min.css', array(), '1.0', 'all' );

        wp_localize_script('gt-core-js', 'gotalent_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'site_url' => home_url(),
            'is_user_logged_in' => is_user_logged_in(),
        ));
        wp_localize_script('multistep-js', 'gotalent_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'site_url' => home_url(),
            'is_user_logged_in' => is_user_logged_in(),
        ));
        
    }
}

GoTalent::get_instance(); 

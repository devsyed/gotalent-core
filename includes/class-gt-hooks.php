<?php

defined('ABSPATH') || exit;

class GTHooks
{
    public static function init()
    {
        add_filter('logout_redirect', array(__CLASS__, 'gt_redirect_to_home'), 10, 3);
        add_filter('login_redirect', function () {
           return '/gotalent-dashboard/manage-bookings';
        });



        add_action('user_register', array(__CLASS__, 'gt_send_email_new_account'), 10, 1);
        add_action('user_register', array(__CLASS__, 'gt_create_user_specific_folder'), 20, 1);

        add_action('gt_invitation_created', array(__CLASS__, 'gt_send_new_invitation_email_to_talent_and_recruiter'), 10, 3);

        // invitation accepted
        add_action('gt_invitation_accepted', array(__CLASS__, 'gt_send_invitation_accepted_email_to_talent_and_recruiter'), 10, 3);

        // booking created 
        add_action('gt_booking_created', array(__CLASS__, 'gt_send_booking_accepted_emails'), 10, 3);

       
    }


    /** 
     * Create Private Folder for User
     */
    public static function gt_create_user_specific_folder($user_id)
    {
        $folder_exists = get_user_meta($user_id, 'secure_folder_name', true);
        if (!$folder_exists) {
            $random_string = md5($user_id . 'user_files' . uniqid());
            $folder_path = ABSPATH . '/wp-content/uploads/' . $random_string;

            if (!is_dir($folder_path)) {
                if (wp_mkdir_p($folder_path)) {
                    update_user_meta($user_id, 'secure_folder_name', $random_string);
                    return true;
                }
            }
        }
        return $folder_exists;
    }


    /** 
     * Redirect User to Homepage after Logout. 
     * 
     */
    public static function gt_redirect_to_home($redirect_to, $requested_redirect_to, $user)
    {
        return esc_url(home_url());
    }


    public static function gt_send_email_new_account($user_id)
    {
        $user = get_user_by('id', $user_id);
        $mail = GTMailer::gt_send_mail($user->user_email, 'welcome@gotalent.com', 'GoTalent', 'Welcome to GoTalent - Account Information', 'emails/user-new-registration.php');
        
        $mail = GTMailer::gt_send_mail(get_option('gotalent_admin_email'), 'welcome@gotalent.com', 'GoTalent', 'New Account Creation!', 'emails/admin-new-registration.php',array('user_signed_up' => get_user_by('id', $user_id)));
        if ($mail) {
            update_user_meta($user_id, 'welcome_email_sent', true);
            return true;
        }
        return $mail;
    }


    /** 
     * Send Email to Talent on Booking Creation 
     * Action: gt_booking_created
     * Priority: 10
     */
    public static function gt_send_new_invitation_email_to_talent_and_recruiter($talent_id, $invitation_id, $recruiter_id)
    {
        $talent = get_user_by('id', $talent_id);
        $recruiter = get_user_by('id', $recruiter_id);

        $mail = GTMailer::gt_send_mail($talent->user_email, 'welcome@gotalent.com', 'GoTalent', 'New Invitation', 'emails/talent-new-invitation.php',array('invitation_id' => $invitation_id));
       
        $mail = GTMailer::gt_send_mail(get_option('gotalent_admin_email'), 'welcome@gotalent.com', 'GoTalent', 'New Invitation', 'emails/admin-new-invitation.php', array('invitation_id' => $invitation_id));

        $mail = GTMailer::gt_send_mail($recruiter->user_email, 'welcome@gotalent.com', 'GoTalent', 'Booking Invitation Sent', 'emails/recruiter-new-invitation.php',array('invitation_id' => $invitation_id));
        
        if($mail) return true;
    }


    /** 
     * Send Email to Talent on Booking Creation 
     * Action: gt_booking_created
     * Priority: 10
     */
    public static function gt_send_invitation_accepted_email_to_talent_and_recruiter($talent_id, $invitation_id, $recruiter_id)
    {
        $talent = get_user_by('id', $talent_id);
        $recruiter = get_user_by('id', $recruiter_id);

       
        $mail = GTMailer::gt_send_mail(get_option('gotalent_admin_email'), 'welcome@gotalent.com', 'GoTalent', 'Invitation Accepted', 'emails/admin-invitation-accepted.php', array('invitation_id' => $invitation_id));

        $mail = GTMailer::gt_send_mail($recruiter->user_email, 'welcome@gotalent.com', 'GoTalent', 'Invitation Accepted', 'emails/recruiter-invitation-accepted.php',array('invitation_id' => $invitation_id));
        
        if($mail) return true;
    }

    /** 
     * Add Recruiter and Talent as Allowed Recipients
     * Action: gt_booking_created
     * Priority: 20
     */
    public static function gt_add_recruiter_and_talent_as_recipients($talent_id, $booking_id, $recruiter_id)
    {
        $talent_recipients = get_user_meta($talent_id, 'allowed_message_recruiters_recipients', true);
        $recruiter_recipients = get_user_meta($recruiter_id, 'allowed_message_talent_recipients', true);
        if (!is_array($talent_recipients)) {
            $talent_recipients = array();
        }
        if (!is_array($recruiter_recipients)) {
            $recruiter_recipients = array();
        }
        if (!in_array($recruiter_id, $talent_recipients)) {
            $talent_recipients[] = $recruiter_id;
        }
        if (!in_array($talent_id, $recruiter_recipients)) {
            $recruiter_recipients[] = $talent_id;
        }
        update_user_meta($talent_id, 'allowed_message_recruiters_recipients', $talent_recipients);
        update_user_meta($recruiter_id, 'allowed_message_talent_recipients', $recruiter_recipients);
    }
    
    /** 
     * Send A Message to Talent about Invitation
     * Action: gt_booking_created
     * Priority: 20
     */
    public static function gt_create_talent_message_thread($talent_id, $invitation_id, $recruiter_id)
    {
        $recruiter = get_user_by('id', $recruiter_id);
        $message = 'Hey! I have invited you to an event. Please respond to my invitation.';
        $recipients = [abs(intval($talent_id))];
        $subject = 'New Booking from: ' . $recruiter->first_name . ' ' . $recruiter->last_name;

        $data = array(
            'message' => $message,
            'recipients' => $recipients,
            'subject' => $subject,
            'sender_id' => $recruiter_id
        );

        $request = new WP_REST_Request('POST', '/better-messages/v1/thread/new');
        $request->set_header('Content-Type', 'application/json');
        $request->set_body_params($data);

        $response = rest_do_request($request);

        $response_data = $response->get_data();
        update_post_meta($invitation_id,'thread_id', $response_data['thread_id']);
        

    }

    public static function gt_send_booking_accepted_emails($booking_id, $talent, $recruiter)
    {

        $mail = GTMailer::gt_send_mail(get_option('gotalent_admin_email'), 'welcome@gotalent.com', 'GoTalent', 'New Booking Created', 'emails/admin-new-booking.php', array('booking_id' => $booking_id));
        

        $mail = GTMailer::gt_send_mail($recruiter->user_email, 'welcome@gotalent.com', 'GoTalent', 'Payment Succesfull - Booking Created', 'emails/recruiter-payment-successfull.php',array('booking_id' => $booking_id));
       
        $mail = GTMailer::gt_send_mail($talent->user_email, 'welcome@gotalent.com', 'GoTalent', 'You have a new Booking!', 'emails/talent-new-booking.php',array('booking_id' => $booking_id));
        
        if($mail) return true;
    }

}

GTHooks::init();

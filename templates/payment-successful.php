<?php 

get_header();
if(!isset($_GET['invitation_id'])) wp_safe_redirect('/');
$invitation_id = (isset($_GET['invitation_id'])) ? $_GET['invitation_id'] : false;
$invitation = get_post($invitation_id);
$payment_token = (isset($_GET['payment_token'])) ? $_GET['payment_token'] : false;
if(!$payment_token) wp_safe_redirect('/');
$invitation_meta = array('thread_id','talent_id','recruiter_id','package_id','booking_type','event_type','event_location','event_location_address','total_number_of_guests','phone_number','event_description','start_time','duration','invitation_status','payment_link');
$meta = [];
foreach($invitation_meta as $meta_info){
    $meta[$meta_info] = get_post_meta($invitation_id,$meta_info,true);
}

$package = get_post($meta['package_id']);
$talent = get_post($meta['talent_id']);
$verify_nonce = (wp_verify_nonce( $payment_token, "invitation_id_{$invitation_id}" )) ? 'yes' : 'no';
if($invitation_id){
    update_post_meta($invitation_id,'payment_completed', true);
    update_post_meta($invitation_id,'invitation_status', 'booking_created');
    $title = 'You are booking ' . $talent->display_name . ' for ' . $package->post_title . '.';
    GTBookingPostType::gt_create_booking($title,'',$meta);
}
?>
<div class="tf-container my-5">
    <div class="row">
        <div class="col-8 mx-auto text-center">
            <div class="box-thankyou">
                <img src="<?php echo GOTALENT_PUBLIC_ASSETS . '/checked.png' ?>" alt="">
                <h3>Thank You!</h3>
                <h4 class="mt-2 my-3">Your payment was successfully processed and the talent has been successfully booked. You will recieve the details in your email aswell.</h4>
                <a class="text-underline" href="/gotalent-dashboard/manage-bookings">View Bookings</a>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
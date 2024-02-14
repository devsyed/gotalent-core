<?php
GTHelpers::gt_get_template_part('email-header.php', array('title' => 'Booking is confirmed'));
$user_data = $variables;
$user = $user_data['user'];
$booking_id = $user_data['meta']['booking_id'];
$booking = get_post($booking_id);
$invitation_meta = array('booking_type','event_type','event_location','event_location_address','total_number_of_guests','phone_number','event_description','start_time','duration', 'custom_quote_amount');
?>
Dear <?php echo $user->display_name; ?>,
<br>
A new booking is confirmed
<br>
<ul>
<?php 
foreach($invitation_meta as $meta_info){
    echo $meta_info . ': ' . get_post_meta($booking_id,$meta_info,true);
}
?>
</ul>
<a href="https://gotalent.global/gotalent-dashboard/manage-bookings">Manage Bookings</a>
<?php GTThemeHelper::gt_get_footer('email-footer'); ?>
<?php
GTHelpers::gt_get_template_part('email-header.php', array('title' => 'New Booking'));
$user_data = $variables;
$user = $user_data['user'];
$booking_id = $user_data['meta']['booking_id'];
$booking = get_post($booking_id);
print_r($booking);
?>
talent new booking
<?php GTThemeHelper::gt_get_footer('email-footer'); ?>
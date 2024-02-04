<?php
GTHelpers::gt_get_template_part('email-header.php', array('title' => 'Payment Successfull'));
$user_data = $variables;
$user = $user_data['user'];
$booking_id = $user_data['meta']['booking_id'];
$booking = get_post($booking_id);
print_r($booking);
?>
Recruiter payment succesfull.
<?php GTThemeHelper::gt_get_footer('email-footer'); ?>
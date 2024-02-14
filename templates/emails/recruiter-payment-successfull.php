<?php
GTHelpers::gt_get_template_part('email-header.php', array('title' => 'Payment has been successfully made'));
$user_data = $variables;
$user = $user_data['user'];
$booking_id = $user_data['meta']['booking_id'];
$booking = get_post($booking_id);

?>
Dear <?php echo $user->display_name; ?>
<br>

Your payment has been successfully made.
Thank you for choosing GoTalent.

<br>

<a href="https://gotalent.global/gotalent-dashboard/manage-bookings">Manage Bookings</a>

<?php GTThemeHelper::gt_get_footer('email-footer'); ?>
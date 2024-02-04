<?php
GTHelpers::gt_get_template_part('email-header.php', array('title' => 'Your Account has been created'));
$user_data = $variables;
$user = $user_data['user'];
?>
Dear <strong><?php echo $user->display_name; ?></strong>, <br>

Welcome to <strong>GoTalent</strong>, the platform that empowers your talent and connects you with exciting
opportunities! We're thrilled to have you on board.
<br>
<br>

<?php if (user_can($user->ID, 'can_be_hired')) : ?>
To get started, please verify your account by clicking on the link below: <br>
<a href="https://gotalent.global/gotalent-dashboard/manage-verification-settings">Verify Account</a>
<br>
<br>


Once Verified, you'll gain access to a world of possibilities, where your skills and expertise can shine. Explore our
diverse range of opportunities, connect with like-minded professionals, and take your talent to new heights.
<br>
<br>

<?php endif; ?>

If you have any questions or need assistance, our support team is here to help.
<br>
<br>

Thank you for choosing GoTalent. We can't wait to see what amazing things you'll accomplish on our platform!
<br>

<?php GTThemeHelper::gt_get_footer('email-footer'); ?>
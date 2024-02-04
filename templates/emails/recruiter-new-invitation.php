<?php
GTHelpers::gt_get_template_part('email-header.php', array('title' => 'Your Invitation has been sent.'));
$user_data = $variables;
$user = $user_data['user'];
$invitation_id = $user_data['meta']['invitation_id'];
$invitation = get_post($invitation_id);
print_r($invitation);
?>
recruiter new invitation
<?php GTThemeHelper::gt_get_footer('email-footer'); ?>
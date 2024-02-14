<?php
GTHelpers::gt_get_template_part('email-header.php', array('title' => 'Invitation sent'));
$user_data = $variables;
$user = $user_data['user'];
$invitation_id = $user_data['meta']['invitation_id'];
$invitation = get_post($invitation_id);
$talent = get_user_by('id', get_post_meta($invitation_id,'talent_id',true));
?>
Dear <?php echo $user->display_name; ?>
<br>
Your invitation to <?php echo $talent->display_name; ?> has been sent.
Please wait until the talent replies.
Thank you for choosing GoTalent

<a href="https://gotalent.global/gotalent-dashboard/manage-invitations">Manage Invitations</a>
<?php GTThemeHelper::gt_get_footer('email-footer'); ?>
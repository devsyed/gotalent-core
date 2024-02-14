<?php
GTHelpers::gt_get_template_part('email-header.php', array('title' => 'New Invitation for Talent'));
$user_data = $variables;
$user = $user_data['user'];
$invitation_id = $user_data['meta']['invitation_id'];
$invitation = get_post($invitation_id);
?>
Dear <?php echo $user->display_name; ?>
You have a new invitation
Before accepting/rejecting, please read the full information provided by recruiter.
<a href="https://gotalent.global/gotalent-dashboard/manage-invitations">Manage Invitations</a>
<?php GTThemeHelper::gt_get_footer('email-footer'); ?>
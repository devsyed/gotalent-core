<?php
$user_data = $variables;
$user = $user_data['user'];
$meta = $user_data['meta']['user_signed_up'];
$user_type = (user_can($meta->ID, 'can_be_hired')) ? 'Talent' : 'Recruiter';
$title = 'A New ' . $user_type . ' Signed Up';
GTHelpers::gt_get_template_part('email-header.php', array('title' => $title ));

?>
Dear Admin!
A New <?php echo $user_type ?> has been registered on GoTalent.

<?php GTThemeHelper::gt_get_footer('email-footer'); ?>
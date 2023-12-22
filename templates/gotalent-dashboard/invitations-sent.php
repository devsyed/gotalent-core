<?php GTThemeHelper::gt_get_header('header-dashboard');
$invitations = GTInvitationPostType::gt_get_invitations_by_recruiter_id(get_current_user_id());

?>
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>Talent Name</th>
                                <th>Event Type</th>
                                <th>Event Date</th>
                                <th>Booking Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($invitations)): foreach($invitations as $invitation): ?>
                                <tr>
                                    <td><?php echo $invitation->ID ?></td>
                                    <td><?php echo get_post_meta($invitation->ID,'event_description', true); ?></td>
                                    <td><?php echo get_user_by('id', get_post_meta($invitation->ID,'talent_id',true))->user_nicename; ?></td>
                                    <td><?php echo get_post_meta($invitation->ID,'event_type', true); ?></td>
                                    <td><?php echo get_post_meta($invitation->ID,'event_date', true); ?></td>
                                    <td><?php echo $invitation->post_date; ?></td>
                                    <td>
                                        <?php echo (get_post_meta($invitation->ID,'invitation_status',true) !== 'pending') ? '<strong><a href="'.get_post_meta($invitation->ID,'payment_link', true).'">Pay Now</a></strong>' : get_post_meta($invitation->ID,'invitation_status',true); ?>
                                    </td>
                                    <td><a href="?query_id=<?php echo $invitation->ID ?>">View Details</a></td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_header('footer-dashboard'); ?>
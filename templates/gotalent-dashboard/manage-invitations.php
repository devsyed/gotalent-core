
<?php GTThemeHelper::gt_get_header('header-dashboard');
$invitations = GTInvitationPostType::gt_get_invitations_by_talent_id(get_current_user_id());
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
                                <th>Event Type</th>
                                <th>Recruiter</th>
                                <th>Package/Custom Quote</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($invitations)): foreach($invitations as $invitation): ?>
                                <tr>
                                    <td><?php echo $invitation->ID ?></td>
                                    <td><?php echo get_post_meta($invitation->ID,'event_type', true) ?></td>
                                    <td><?php 
                                        $recruiter = get_user_by('id', get_post_meta($invitation->ID,'recruiter_id',true));
                                        echo $recruiter->first_name . ' ' . $recruiter->last_name;
                                    ?></td>
                                    <td>
                                        <?php 
                                        $booking_type = get_post_meta($invitation->ID,'booking_type', true);
                                        $package_id = ($booking_type == 'package') ? get_post_meta($invitation->ID,'package_id', true) : false; 
                                        echo ($package_id) ? 'Package' : 'Custom Quote';
                                        ?>
                                    </td>
                                    <td><?php echo $invitation->post_date; ?></td>
                                    <td><?php echo ucwords(get_post_meta($invitation->ID,'invitation_status', true)); ?></td>
                                    <td><?php echo '<a href="?query_id='. $invitation->ID.'">View Details</a>' ?></td>
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
<?php
$invitation_id = $_GET['query_id'];
$invitation = GTInvitationPostType::gt_get_invitation($invitation_id);
$invitation_belongs_to_talent = GTInvitationPostType::gt_invitation_belongs_to_talent(get_current_user_id(), $invitation_id);
$talent = get_user_by('id', get_post_meta($invitation->ID,'talent_id', true));
if (!$invitation_belongs_to_talent) wp_safe_redirect('/gotalent-dashboard/manage-invitations');
GTThemeHelper::gt_get_header('header-dashboard');
$recruiter = get_user_by('id', get_post_meta($invitation_id, 'recruiter_id', true));
?>
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">
                    <h3 class="mb-2">Booking Invitation from: <?php echo $recruiter->first_name . ' ' . $recruiter->last_name ?></h3>
                    <?php if(current_user_can('can_manage_recruiter_and_talent')): ?>
                    <h3>Booking For: <a href="<?php echo '/author/' . $talent->user_nicename ?>"><?php echo $talent->display_name; ?></a></h3>
                    <?php endif; ?>
                    <ul class="booking-details mt-5">
                        <li class="my-2"><strong>Event Type:
                            </strong><?php echo get_post_meta($invitation_id, 'event_type', true); ?></li>
                        <li class="my-2"><strong>Location of Event:
                            </strong><?php echo get_post_meta($invitation_id, 'event_location', true); ?></li>
                        <li class="my-2"><strong><?php echo (get_post_meta($invitation->ID, 'booking_type', true) == 'custom_quote') ? 'Custom Quote' : 'Package Selected'; ?></strong>
                            <?php
                            $booking_type = get_post_meta($invitation->ID, 'booking_type', true);
                            $package_id = ($booking_type == 'package') ? get_post_meta($invitation->ID, 'package_id', true) : false;
                            if ($package_id) {
                                echo get_post($package_id)->post_title;
                            } else {
                                echo 'AED ' . get_post_meta($invitation->ID, 'custom_quote_amount', true);
                            }
                            ?>
                        </li>
                        <li class="my-2"><strong>Event Description:
                            </strong><?php echo get_post_meta($invitation_id, 'event_description', true); ?> </li>
                        <li class="my-2"><strong>Event Location:
                            </strong><?php echo get_post_meta($invitation_id, 'event_location', true); ?> </li>
                        <li class="my-2"><strong>Total Number of Guests:
                            </strong><?php echo get_post_meta($invitation_id, 'total_number_of_guests', true); ?> </li>
                        <li class="my-2"><strong>Total Duration Required:
                            </strong><?php echo get_post_meta($invitation_id, 'duration', true); ?> </li>
                        <li class="my-2"><strong>Event Date
                            </strong><?php echo get_post_meta($invitation_id, 'start_date', true); ?>
                        </li>
                        <li class="my-2"><strong>Start Time
                            </strong><?php echo get_post_meta($invitation_id, 'start_time', true); ?>
                        </li>
                        <li class="my-2"><strong>Invite Sent On
                            </strong><?php echo $invitation->post_date; ?>
                        </li>
                    </ul>
                </div>
                <?php if(current_user_can('can_be_hired')): ?>
                <div class="save-form-wrapper">
                    <form action="gotalent/accept_invitation" method="POST" class="gt-form">
                        <input type="hidden" name="invitation_id" value="<?php echo $invitation_id; ?>">
                        <?php if ((get_post_meta($invitation_id, 'invitation_status', true) === 'pending')) : ?>
                            <button type="submit" class="btn-gt-default-2"><?php echo __('Decline Invitation', 'gotalent-core'); ?></button>
                            <button type="submit" class="btn-gt-default"><?php echo __('Accept Invitation', 'gotalent-core'); ?></button>
                        <?php endif; ?>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_footer('footer-dashboard'); ?>
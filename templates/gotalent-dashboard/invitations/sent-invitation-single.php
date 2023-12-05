<?php
$invitation_id = $_GET['query_id'];
$invitation = GTInvitationPostType::gt_get_invitation($invitation_id);
$invitation_belongs_to_talent = GTInvitationPostType::gt_invitation_belongs_to_recruiter(get_current_user_id(),$invitation_id);
if(!$invitation_belongs_to_talent) wp_safe_redirect('/gotalent-dashboard/sent-invitations');
GTThemeHelper::gt_get_header('header-dashboard');
$recruiter = get_user_by('id', get_post_meta($invitation_id,'recruiter_id', true));
?>
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">
                    
                    <ul class="booking-details">
                        <li class="my-2"><strong>Location of Event:
                            </strong><?php echo get_post_meta($invitation_id,'event_location', true); ?></li>
                        <li class="my-2"><strong>Selected Package:</strong>
                            <?php 
                                $booking_type = get_post_meta($invitation->ID,'booking_type', true);
                                $package_id = ($booking_type == 'package') ? get_post_meta($invitation->ID,'package_id', true) : false; 
                                echo get_post($package_id)->post_title;
                            ?>
                        </li>
                        <li class="my-2"><strong>Event Description:
                            </strong><?php echo get_post_meta($invitation_id,'event_description', true); ?> </li>
                        <li class="my-2"><strong>Event Location:
                            </strong><?php echo get_post_meta($invitation_id,'event_location', true); ?> </li>
                        <li class="my-2"><strong>Total Number of Guests:
                            </strong><?php echo get_post_meta($invitation_id,'total_number_of_guests', true); ?> </li>
                        <li class="my-2"><strong>Total Duration Required:
                            </strong><?php echo get_post_meta($invitation_id,'duration', true); ?> </li>
                        <li class="my-2"><strong>Start Time
                            </strong><?php echo get_post_meta($invitation_id,'start_time', true); ?> </li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_footer('footer-dashboard'); ?>
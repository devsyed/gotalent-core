<?php
$booking_id = $_GET['query_id'];
$booking = GTbookingPostType::gt_get_booking($booking_id);
GTThemeHelper::gt_get_header('header-dashboard');
$recruiter = get_user_by('id', get_post_meta($booking_id,'recruiter_id', true));
?>
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">
                    <h3>Booking booking from: <?php echo $recruiter->first_name . ' ' . $recruiter->last_name ?></h3>
                    <ul class="booking-details mt-5">
                        <li class="my-2"><strong>Location of Event:
                            </strong><?php echo get_post_meta($booking_id,'event_location', true); ?></li>
                        <li class="my-2"><strong>Selected Package:</strong>
                            <?php 
                                $booking_type = get_post_meta($booking->ID,'booking_type', true);
                                $package_id = ($booking_type == 'package') ? get_post_meta($booking->ID,'package_id', true) : false; 
                                echo get_post($package_id)->post_title;
                            ?>
                        </li>
                        <li class="my-2"><strong>Event Description:
                            </strong><?php echo get_post_meta($booking_id,'event_description', true); ?> </li>
                        <li class="my-2"><strong>Event Location:
                            </strong><?php echo get_post_meta($booking_id,'event_location', true); ?> </li>
                        <li class="my-2"><strong>Total Number of Guests:
                            </strong><?php echo get_post_meta($booking_id,'total_number_of_guests', true); ?> </li>
                        <li class="my-2"><strong>Total Duration Required:
                            </strong><?php echo get_post_meta($booking_id,'duration', true); ?> </li>
                        <li class="my-2"><strong>Start Time
                            </strong><?php echo get_post_meta($booking_id,'start_time', true); ?> </li>
                    </ul>
                </div>
                <div class="save-form-wrapper">
                    <form action="gotalent/accept_booking" method="POST" class="gt-form">
                        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                        <?php if(!(get_post_meta($booking_id,'booking_status',true))) : ?>
                            <button type="submit" class="btn-gt-default-2"><?php echo __('Decline booking', 'gotalent-core'); ?></button>
                            <button type="submit" class="btn-gt-default"><?php echo __('Accept booking', 'gotalent-core'); ?></button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_footer('footer-dashboard'); ?>
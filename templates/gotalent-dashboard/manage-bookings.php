<?php GTThemeHelper::gt_get_header('header-dashboard');
$bookings = [];
if(current_user_can('can_be_hired')){
    $bookings = GTBookingPostType::get_all_bookings_for_talent(get_current_user_id());
}
if(current_user_can('can_manage_recruiter_and_talent')){
    $bookings = GTBookingPostType::gt_get_all_bookings()->posts;
}

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
                                <th>Recruiter</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($bookings)) : foreach ($bookings as $booking) : ?>
                                    <tr>
                                        <td><?php echo $booking->ID ?></td>
                                        <td><?php echo get_post_meta($booking->ID, 'event_type', true) ?></td>
                                        <td><?php
                                            $recruiter = get_user_by('id', get_post_meta($booking->ID, 'recruiter_id', true));
                                            echo $recruiter->first_name . ' ' . $recruiter->last_name;
                                            ?></td>
                                        <td><strong>
                                                AED <?php
                                                    echo get_post_meta($booking->ID, 'price', true);
                                                    ?>
                                            </strong>

                                        </td>
                                        <td><?php echo $booking->post_date; ?></td>
                               
                                        <td><?php echo !(get_post_meta($booking->ID, 'invitation_status', true)) ? '<a href="?query_id=' . $booking->ID . '">View Details</a>' : ''; ?></td>
                                    </tr>
                            <?php endforeach;
                            endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_header('footer-dashboard'); ?>
<?php GTThemeHelper::gt_get_header('header-dashboard');
$bookings = [];
if (current_user_can('can_be_hired')) {
    $bookings = GTBookingPostType::get_all_bookings_for_talent(get_current_user_id());
}
if (current_user_can('can_hire_talent')) {
    $bookings = GTBookingPostType::get_all_bookings_for_recruiter(get_current_user_id());
}
if (current_user_can('can_manage_recruiter_and_talent')) {
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
                                <th><?php echo (current_user_can('can_hire_talent') || current_user_can('can_manage_recruiter_and_talent')) ? 'Talent' : 'Recruiter' ?>
                                </th>
                                <?php echo (current_user_can('can_manage_recruiter_and_talent')) && '<th>Talent</th>'; ?>
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
                                        <td>
                                            <?php
                                            $user_type = (current_user_can('can_hire_talent')  || current_user_can('can_manage_recruiter_and_talent')) ? 'talent' : 'recruiter';
                                            $user = get_user_by('id', get_post_meta($booking->ID, $user_type . '_id', true));
                                            echo $user->first_name . ' ' . $user->last_name;
                                            ?></td>
                                        <?php echo (current_user_can('can_manage_recruiter_and_talent')) && '<td>' . $user = get_user_by('id', get_post_meta($booking->ID, 'talent_id', true))->display_name . '</td>'; ?>
                                        <td><strong>
                                                AED <?php
                                                    $package = get_post(get_post_meta($booking->ID, 'package_id', true));
                                                    if ($package) {
                                                        echo get_post_meta($package->ID, 'price', true);
                                                    } else {
                                                        echo get_post_meta($booking->ID, 'custom_quote_amount', true);
                                                    }
                                                    ?>
                                            </strong>

                                        </td>
                                        <td><?php echo $booking->post_date; ?></td>

                                        <td><a href="?query_id=<?php echo $booking->ID ?>">View Details</a>
                                        </td>
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
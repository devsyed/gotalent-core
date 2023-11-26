<?php GTThemeHelper::gt_get_header('header-dashboard');
$total_earned = GTBookingPostType::gt_get_earnings_for_user();
$total_bookings_query = GTBookingPostType::gt_get_all_bookings();
$total_bookings_count = $total_bookings_query->found_posts;
?>
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row mb-3">
            <div class="col-lg-3">
                <div class="single-stat-box d-flex flex-column">
                    <p class="mb-1">Total Earnings</p>
                    <div>AED <?php echo floatval($total_earned); ?></div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-stat-box d-flex flex-column">
                    <p class="mb-1">Total Bookings</p>
                    <div><?php echo $total_bookings_count; ?></div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-stat-box d-flex flex-column">
                    <p class="mb-1">Bookings This Month</p>
                    <div>0</div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-stat-box d-flex flex-column">
                    <p class="mb-1">Earnings This Month</p>
                    <div>AED 0</div>
                </div>
            </div>
        </div>
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
                            
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_header('footer-dashboard'); ?>
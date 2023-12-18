<?php GTThemeHelper::gt_get_header('header-dashboard');
$total_earned = GTBookingPostType::gt_get_earnings_for_user(get_current_user_id());
$total_bookings_query = GTBookingPostType::gt_get_all_bookings();
$total_bookings_count = $total_bookings_query->found_posts;

$current_date = current_time('Y-m-d');
$one_month_ago = date('Y-m-d', strtotime('-1 month', strtotime($current_date)));

$earnings_this_month = GTBookingPostType::gt_get_earnings_for_user(get_current_user_id(),array('start_date' => $one_month_ago, 'end_date' => $current_date));

$bookings_this_month_query = GTBookingPostType::gt_get_all_bookings(array('start_date' => $one_month_ago, 'end_date' => $current_date));
$bookings_this_month_count = $bookings_this_month_query->found_posts;
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
                    <div><?php echo $bookings_this_month_count ?></div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-stat-box d-flex flex-column">
                    <p class="mb-1">Earnings This Month</p>
                    <div>AED <?php echo floatval($earnings_this_month) ?></div>
                </div>
            </div>
        </div>
        
    </div>
</section>
<?php GTThemeHelper::gt_get_header('footer-dashboard'); ?>
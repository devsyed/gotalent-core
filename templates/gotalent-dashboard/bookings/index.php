<?php 

/** 
 * Template: Single Booking Dashboard View 
 * To Override this template, copy it to yourtheme/gotalent/gotalent-dashboard/bookings/index.php
 */

$booking_id = $_GET['query_id'];
$allowed_to_view_booking = GTBookingPostType::gt_user_belongs_to_booking($booking_id);
if(!$allowed_to_view_booking) wp_safe_redirect('/gotalent-dashboard/manage-bookings');

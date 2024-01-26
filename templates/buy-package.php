<?php
if (!is_user_logged_in()) {
    wp_safe_redirect('/#registration_modal');
}
get_header();
$package_id = isset($_GET['query_id']) ? (int)$_GET['query_id'] : 0;
$custom_quote = isset($_GET['custom_quote']) ? $_GET['custom_quote'] : false;
$talent_id = isset($_GET['talent_id']) ? $_GET['talent_id'] : false;
$is_it_package = ($package_id !== 0 && !($custom_quote)) ? true : false;

if($package_id !== 0){
    $package = get_post($package_id);
    if (!$package) wp_safe_redirect('/talent');
    $talent = get_user_by('id', get_post_meta($package_id, 'talent_id', true));
    $is_talent_viewing = ($talent->ID === get_current_user_id()) ? true : false;
    GTThemeHelper::show_breadcrumb('Complete Your Booking with ' . $talent->first_name . ' ' . $talent->last_name, 'Your Selected Package: ' . $package->post_title);

    $package_price = get_post_meta($package_id, 'price', true);
}
if($talent_id){
    $talent = get_user_by('id',$talent_id);
    $is_talent_viewing = ($talent->ID === get_current_user_id()) ? true : false;
    if($custom_quote){
        GTThemeHelper::show_breadcrumb('Complete Your Booking with ' . $talent->display_name . ' ' . $talent->last_name, 'Your Custom Quote: AED ' . $custom_quote );
    }
}

?>
<div class="wrapper-buy-package">
    <div class="container-fluid mt-5 py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if (!$is_talent_viewing) : ?>
                    <div class="form-wrapper mt-5">
                        <ol class="step-indicator">
                            <li class="step-indicator-item active" data-content="1">Event Information</li>
                            <li class="step-indicator-item" data-content="2">Date & Time</li>
                            <li class="step-indicator-item" data-content="3">Finalize Your Booking</li>
                        </ol>
                        <form id="multi-step-form">
                            <input type="hidden" name="talent_id" value="<?php echo $talent->ID; ?>">
                            <input type="hidden" name="recruiter_id" value="<?php echo get_current_user_id(); ?>">
                            <input type="hidden" name="package_id" value="<?php echo $package_id; ?>">
                            <input type="hidden" name="booking_type" value="package">
                            <div class="step">
                                <div class="d-flex align-items-center gap-2">
                                    <?php
                                    GTFormHelper::generate_form_fields(array(
                                        array(
                                            'type' => 'select',
                                            'name' => 'event_type',
                                            'required' => true,
                                            'label' => 'Event Type',
                                            'options' => array('Hotels & Restaurant'=>'Hotels & Restaurant','Clubs & Pubs' => 'Clubs & Pubs','Wedding' => 'Wedding','Festivals' => 'Festivals', 'Public Event' => 'Public Event','Cruise ship' => 'Cruise ship', 'Corporate event' => 'Corporate event', 'Corporate event' => 'Corporate event', 'Private Party' => 'Private Party', 'Bachelor Party' => 'Bachelor Party','Exhibition ' => 'Exhibition'),
                                        ),
                                        array(
                                            'type' => 'select',
                                            'name' => 'event_location',
                                            'required' => true,
                                            'label' => 'Event Location',
                                            'options' => array('Ras Al Khaimah' => 'Ras Al Khaimah', 'Dubai' => 'Dubai', 'Sharjah' => 'Sharjah', 'Al Ain' => 'Al Ain', 'Fujairah' => 'Fujairah'),

                                        ),
                                        array(
                                            'type' => 'text',
                                            'name' => 'event_location_address',
                                            'required' => true,
                                            'label' => 'Event Address',
                                            

                                        ),
                                    ))
                                    ?>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <?php
                                    GTFormHelper::generate_form_fields(array(
                                        array(
                                            'type' => 'text',
                                            'name' => 'total_number_of_guests',
                                            'required' => true,
                                            'label' => 'Total Number of Guests ( Expected )',
                                            'placeholder' => 'Eg: Birthday Party',
                                        ),
                                        array(
                                            'type' => 'text',
                                            'name' => 'phone_number',
                                            'required' => true,
                                            'label' => 'Phone Number',
                                            'placeholder' => '',
                                        ),
                                    ))
                                    ?>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <?php
                                    GTFormHelper::generate_form_fields(array(
                                        array(
                                            'type' => 'textarea',
                                            'name' => 'event_description',
                                            'required' => true,
                                            'label' => 'Event Description',
                                            'placeholder' => '',
                                        ),
                                    ))
                                    ?>
                                </div>
                            </div>
                            <div class="step">
                                <div class="d-flex align-items-center gap-2">
                                    <?php
                                    GTFormHelper::generate_form_fields(array(
                                        array(
                                            'type' => 'date',
                                            'name' => 'start_date',
                                            'required' => true,
                                            'label' => 'When is your event?',
                                            'placeholder' => '',
                                        ),
                                        array(
                                            'type' => 'time',
                                            'name' => 'start_time',
                                            'required' => true,
                                            'label' => 'What time does your event start?',
                                            'placeholder' => '',
                                        ),
                                    ))
                                    ?>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <?php
                                    GTFormHelper::generate_form_fields(array(
                                        array(
                                            'type' => 'number',
                                            'name' => 'duration',
                                            'required' => true,
                                            'label' => 'How long do you need the talent for? ( In Hours ) ',
                                            'placeholder' => '',
                                            'div_width' => '50'
                                        ),

                                    ))
                                    ?>

                                </div>
                            </div>
                            <div class="step">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="booking-summary w-100" data-content="Booking Summary">
                                        <div class="booking-info-single">
                                            <strong>Your Event Type:</strong>
                                            <p id="event_type"></p>
                                        </div>
                                        <div class="booking-info-single">
                                            <strong>Your Event City:</strong>
                                            <p id="event_location"></p>
                                        </div>
                                        <div class="booking-info-single">
                                            <strong>Total Number of Guests ( Expected ):</strong>
                                            <p id="total_number_of_guests"></p>
                                        </div>
                                        <div class="booking-info-single">
                                            <strong>Date of Event</strong>
                                            <p id="date_time"></p>
                                        </div>
                                        <div class="booking-info-single">
                                            <strong>Time of Event</strong>
                                            <p id="start_time"></p>
                                        </div>
                                        <?php if($is_it_package) : ?>
                                        <div class="booking-info-single">
                                            <strong>Selected Package</strong>
                                            <p><?php echo $package->post_title; ?></p>
                                        </div>
                                        <?php endif; ?>
                                        <div class="gt-form-control">
                                            <?php if($is_it_package): ?>
                                                <p class="d-flex justify-content-between mt-3 align-item-center">
                                                    <span class="d-flex flex-column justify-content-start"><strong>Total Amount:
                                                        </strong></span>
                                                    <span class="text-lg pricing" data-hourly-rate="100">AED <?php echo $package_price ?></span>
                                                </p>
                                            <?php else: ?>
                                                <input type="hidden" name="booking_type" value="custom_quote"/>
                                                <input type="hidden" name="custom_quote_amount" value="<?php echo $custom_quote; ?>">
                                                <p class="d-flex justify-content-between mt-3 align-item-center">
                                                    <span class="d-flex flex-column justify-content-start"><strong>Total Amount:
                                                        </strong></span>
                                                    <span class="text-lg pricing">AED <?php echo $custom_quote ?></span>
                                                </p>
                                            <?php endif; ?>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <button type="submit" class="gt-send-query w-50">Send Invitation</button>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- Navigation buttons -->
                            <div class="step-btns">
                                <button type="button" class="btn btn-primary prev"><i class="fas fa-arrow-left"></i></button>
                                <button type="button" class="btn btn-primary next"><i class="fas fa-arrow-right"></i></button>

                            </div>
                        </form>
                    </div>
                <?php else : ?>
                    <p class="booking-error-message">You cant book your self.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
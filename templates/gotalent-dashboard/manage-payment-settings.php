<?php GTThemeHelper::gt_get_header('header-dashboard');
$account_full_name = get_user_meta(get_current_user_id(), 'account_full_name', true);
$bank_name = get_user_meta(get_current_user_id(), 'bank_name', true);
$swift_code = get_user_meta(get_current_user_id(), 'swift_code', true);
$account_number = get_user_meta(get_current_user_id(), 'account_number', true);
$routing_number = get_user_meta(get_current_user_id(), 'routing_number', true);
?>
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">
                    <form action="gotalent/user/process_meta" method="POST" class="gt-form" data-redirect-url="/gotalent-dashboard/manage-payment-settings">
                        <div class="gt-form-row">
                            <?php GTFormHelper::generate_dashboard_form_fields(array(
                                array(
                                    'type' => 'text',
                                    'name' => '_meta_account_full_name',
                                    'label' => 'Account Full Name',
                                    'value' => $account_full_name,
                                ),
                                array(
                                    'type' => 'text',
                                    'name' => '_meta_bank_name',
                                    'label' => 'Bank Name',
                                    'value' => $bank_name,
                                ),
                                array(
                                    'type' => 'text',
                                    'name' => '_meta_account_number',
                                    'label' => 'Account Number',
                                    'value' => $account_number,
                                ),

                            )) ?>
                        </div>
                        <div class="gt-form-row">
                            <?php GTFormHelper::generate_dashboard_form_fields(array(
                                array(
                                    'type' => 'text',
                                    'name' => '_meta_swift_code',
                                    'label' => 'Swift Code',
                                    'value' => $swift_code,
                                ),
                                array(
                                    'type' => 'text',
                                    'name' => '_meta_routing_number',
                                    'label' => 'Routing Number',
                                    'value' => $routing_number,
                                ),

                            )) ?>
                        </div>
                        <div class="save-form-wrapper">

                            <button type="submit" class="ms-3 btn-gt-default"><?php echo __('Save Payment Settings', 'gotalent-core'); ?></button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_header('footer-dashboard'); ?>
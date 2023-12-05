<?php GTThemeHelper::gt_get_header('header-dashboard');
$available_days = (get_user_meta(get_current_user_id(), 'available_days', true)) ? get_user_meta(get_current_user_id(), 'available_days', true) : ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
?>    
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">

                    <div class="available-days-set">
                        <h3><?php echo __('Set Your Available Days', 'gotalent-core'); ?></h3>
                        <form action="gotalent/availabilities/update_days" class="mt-5 gt-form" method="POST"
                            data-redirect-url="/manage-availability">
                            <div class="available-days">
                                <?php 
                                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                    $fields = [];
                                    if($days){
                                        foreach($days as $day){
                                            $fields[] = array(
                                                'type' => 'checkbox',
                                                'name' => 'available_days[]',
                                                'label' => $day,
                                                'fieldset_class' => 'day-single',
                                                'value' => $day,
                                                'default' => (in_array(strtolower($day),$available_days)) ? true : false
    
                                            );
                                        }
                                        GTFormHelper::generate_dashboard_form_fields($fields);
                                    }
                                    
                                ?>
                            </div>
                            <div class="save-form-wrapper">
                                <button type="submit" class="btn-gt-default"><?php echo __('Save Availability', 'gotalent-core'); ?></button>
                            </div>
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>

    </div>

</section>
<?php GTThemeHelper::gt_get_header('footer-dashboard'); ?>
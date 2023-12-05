<?php GTThemeHelper::gt_get_header('header-dashboard'); ?>
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">
                    <form action="gotalent/packages/add_package" method="POST" data-redirect-url="gotalent-dashboard/manage-packages" class="gt-form">
                        <div class="gt-form-row">
                        <?php GTFormHelper::generate_dashboard_form_fields(array(
                            array(
                                'type' => 'text',
                                'name' => 'package_title',
                                'label' => 'Title of Your Package',
                            ),
                            array(
                                'type' => 'number',
                                'name' => '_meta_duration',
                                'label' => 'Duration <small>(Duration in minutes / set)</small>',
                            ),
                            array(
                                'type' => 'number',
                                'name' => '_meta_number_of_sets',
                                'label' => 'Number of Sets',
                            ),
                            array(
                                'type' => 'text',
                                'name' => '_meta_price',
                                'label' => 'Price of the Package',
                                'info' => __('You will recieve 80% of this amount. Rest 20% will be commission to the <strong>Gotalent</strong>', 'gotalent-core')
                            ),

                        )); ?>
                        </div>
                        <div class="gt-form-row">
                        <?php GTFormHelper::generate_dashboard_form_fields(array(
                            
                            array(
                                'type' => 'textarea',
                                'name' => '_meta_includes',
                                'label' => 'What does your package include?',
                            ),
                            array(
                                'type' => 'textarea',
                                'name' => '_meta_excludes',
                                'label' => 'What does your package exclude?',
                            ),
                            
                        )); ?>
                        </div>
                        <div class="gt-form-row">
                        <?php GTFormHelper::generate_dashboard_form_fields(array(
                            array(
                                'type' => 'textarea',
                                'name' => '_meta_description',
                                'label' => 'Describe your package briefly',
                            ),
                            
                        )); ?>
                        </div>
                        <div class="save-form-wrapper">
                            <button class="btn-gt-default" type="submit"><?php echo __('Create Package', 'gotalent-core') ?></button>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_footer('footer-dashboard'); ?>

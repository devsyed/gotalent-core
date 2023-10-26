<?php GTThemeHelper::gt_get_header('header-dashboard');
$package_id = $_GET['query_id'];
$package = get_post($package_id);
$title = $package->post_title;
$price = get_post_meta($package_id,'price', true);
$duration = get_post_meta($package_id,'duration', true);
$sets = get_post_meta($package_id,'number_of_sets', true);
$includes = get_post_meta($package_id,'includes', true);
$excludes = get_post_meta($package_id,'excludes', true);
$description = get_post_meta($package_id,'description', true);
?>
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
                                'value' => $title,
                            ),
                            array(
                                'type' => 'number',
                                'name' => '_meta_duration',
                                'label' => 'Duration',
                                'value' => $duration,
                            ),
                            array(
                                'type' => 'number',
                                'name' => '_meta_number_of_sets',
                                'label' => 'Number of Sets',
                                'value' => $sets,
                            ),
                            array(
                                'type' => 'number',
                                'name' => '_meta_price',
                                'label' => 'Price of the Package',
                                'value' => $price
                            ),
                            
                        )); ?>
                        </div>
                        <div class="gt-form-row">
                            <?php GTFormHelper::generate_dashboard_form_fields(array(
                                
                                array(
                                    'type' => 'textarea',
                                    'name' => '_meta_includes',
                                    'label' => 'What does your package include?',
                                    'value' => $includes
                                ),
                                array(
                                    'type' => 'textarea',
                                    'name' => '_meta_excludes',
                                    'label' => 'What does your package exclude?',
                                    'value' => $excludes
                                ),
                                
                            )); ?>
                        </div>
                        <div class="gt-form-row">
                            <?php GTFormHelper::generate_dashboard_form_fields(array(
                                array(
                                    'type' => 'textarea',
                                    'name' => '_meta_description',
                                    'label' => 'Describe your package briefly',
                                    'value' => $description
                                ),
                                
                            )); ?>
                        </div>
                        <?php GTFormHelper::generate_dashboard_form_fields(array(
                                array(
                                    'type' => 'hidden',
                                    'name' => 'package_id',
                                    'label' => '',
                                    'value' => $package_id,
                                ),
                                
                            )); ?>
                        
                        <div class="save-form-wrapper">
                            <button class="btn-gt-default" type="submit"><?php echo __('Save Package', 'gotalent-core') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_footer('footer-dashboard'); ?>

<?php GTThemeHelper::gt_get_header('header-dashboard');
$existing_portfolio = get_user_meta(get_current_user_id(), 'portfolio_links', true);
?>
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">
                   <form class="gt-form" action="gotalent/talent/add_portfolio" method="POST" enctype="multipart/form-data">
                    <div class=" current-portfolio d-flex justify-content-space-between flex-wrap align-items-start">
                    <?php if(is_array($existing_portfolio) && !empty($existing_portfolio)): foreach($existing_portfolio as $key => $portfolio): ?>
                        <div class="relative single-portfolio-item">
                            <input type="hidden" name="_meta_portfolio_links" value="<?php echo $portfolio; ?>">
                            <img width="200" height="200" src="<?php echo $portfolio ?>" alt="<?php echo $portfolio ?>">
                            <button class="remove_portfolio_item">Remove</button>
                        </div>
                    <?php endforeach; endif; ?>
                    </div>
                    <?php GTFormHelper::generate_dashboard_form_fields(array(
                        array(
                            'type' => 'file',
                            'name' => 'talent_portfolio',
                            'label' => 'Add Portfolio',
                            'max_upload' => 10,
                            'action' => 'gt_upload_images',
                            'input_id' => '_meta_portfolio_links',
                            'message' => 'Add Portfolio',
                            'upload_directory' => get_user_meta(get_current_user_id(), 'secure_folder_name', true)
                        )
                    )) ?>
                    <div class="save-form-wrapper">
                <button type="submit" class="btn-gt-default"><?php echo __('Save Portfolio', 'gotalent-core'); ?></button>
            </div>
                   </form>
                </div>

            </div>

        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_footer('footer-dashboard'); ?>
<?php GTThemeHelper::gt_get_header('header-dashboard');
$existing_portfolio = get_user_meta(get_current_user_id(), 'portfolio_links', true);
$allowed_videos_link = 5;
$portfolio_video_links = get_user_meta(get_current_user_id(), 'portfolio_video_links', true);
$values = [];
for($i = 0; $i < $allowed_videos_link; $i++){
    $values[] = $portfolio_video_links['_meta_portfolio_video_link_' . $i];
}


$fields = [];
for($i = 0; $i < $allowed_videos_link; $i++){
    $fields[] = array(
        'type' => 'text',
        'name' => '_meta_portfolio_video_link_' . $i,
        'label' => 'Add Portfolio Video ' . $i + 1,
        'value' => $values[$i]
    );
}

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
                            <img class="portfolio-item-single" src="<?php echo $portfolio ?>" alt="<?php echo $portfolio ?>">
                            <button class="remove_portfolio_item">Remove</button>
                        </div>
                    <?php endforeach; endif; ?>
                    </div>
                    <?php  GTFormHelper::generate_dashboard_form_fields(array(
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
                        )); ?>
                    <p class="mt-5 mb-2 text-bold">Please put in the Youtube Video ID here. </p>
                    <div class="gt-form-row">
                    <?php GTFormHelper::generate_dashboard_form_fields($fields) ?>
                </div>
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
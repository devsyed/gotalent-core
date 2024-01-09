<?php GTThemeHelper::gt_get_header('header-dashboard'); ?>
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">
                    <form action="gotalent/settings/update_settings" method="POST" class="gt-form">
                        <div class="gt-form-row">
                            <?php GTFormHelper::generate_dashboard_form_fields(array(
                                    array(
                                        'type' => 'text',
                                        'name' => 'instagram_url',
                                        'label' => 'Instagram URL',
                                        'value' => get_option('instagram_url'),
                                    ),
                                    array(
                                        'type' => 'text',
                                        'name' => 'facebook_url',
                                        'label' => 'Facebook URL',
                                        'value' => get_option('facebook_url'),
                                    ),
                                    array(
                                        'type' => 'text',
                                        'name' => 'youtube_url',
                                        'label' => 'Youtube URL',
                                        'value' => get_option('youtube_url'),
                                    ),
                                    
                                )); ?>
                        </div>
                       <div class="gt-form-row">
                        <?php
                            GTFormHelper::generate_dashboard_form_fields(array(
                                array(
                                    'type' => 'text',
                                    'name' => 'address',
                                    'label' => 'Address',
                                    'value' => get_option('address'),
                                ),
                                array(
                                    'type' => 'text',
                                    'name' => 'contact_number',
                                    'label' => 'Contact Number',
                                    'value' => get_option('contact_number'),
                                ),
                            ))
                        ?>
                       </div>
                       <div class="gt-form-row">
                        <?php
                            GTFormHelper::generate_dashboard_form_fields(array(
                                array(
                                    'type' => 'text',
                                    'name' => 'google_play_link',
                                    'label' => 'App Google Store Link',
                                    'value' => get_option('google_play_link'),
                                ),
                                array(
                                    'type' => 'text',
                                    'name' => 'apple_store_link',
                                    'label' => 'iOS App Store Link',
                                    'value' => get_option('apple_store_link'),
                                ),
                            ))
                        ?>
                       </div>
                        <a href="/wp-admin/post.php?post=244&action=elementor">Edit FAQ</a>
                        <div class="save-form-wrapper">
                            <button type="submit" class="btn-gt-default"><?php echo __('Save Settings', 'gotalent-core'); ?></button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_footer('footer-dashboard'); ?>

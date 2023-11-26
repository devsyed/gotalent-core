<?php 
GTThemeHelper::gt_get_header('header-dashboard'); 
$user = wp_get_current_user();
$role = $user->roles[0];

$talent_categories_obj = GTTaxonomy_Talent_Category::gt_get_all_talent_categories();
$talent_categories = wp_list_pluck($talent_categories_obj,'name', 'term_id');


$profile_image = get_user_meta($user->ID,'profile_image_url',true);
$cover_image = get_user_meta($user->ID,'cover_image_url', true);
$description = get_user_meta($user->ID, 'bio_description', true);
$phone_number = get_user_meta($user->ID,'phone_number', true);
$alternate_phone_number = get_user_meta($user->ID,'alternate_phone_number', true);
$facebook_profile = get_user_meta($user->ID,'facebook_profile', true);
$linkedin_profile = get_user_meta($user->ID,'linkedin_profile', true);
$twitter_profile = get_user_meta($user->ID,'twitter_profile', true);
$instagram_profile = get_user_meta($user->ID,'instagram_profile', true);
$pinterest_profile = get_user_meta($user->ID,'pinterest_profile', true);
$youtube_profile = get_user_meta($user->ID,'youtube_profile', true);
$accept_custom_offers = get_user_meta($user->ID,'accept_custom_offers',true);
$hourly_rate = get_user_meta($user->ID,'per_hour_rate', true);
$talent_selected_category = get_user_meta($user->ID, 'talent_category', true);
$talent_selected_subcategory = get_user_meta($user->ID, 'talent_sub_category', true);
$talent_profession = get_user_meta($user->ID,'talent_profession', true);
$talent_tags = get_user_meta($user->ID,'talent_tags', true);
$requirements = get_user_meta($user->ID,'requirement_for_performing', true);

$talent_sub_categories_obj = GTTaxonomy_Talent_Category::gt_get_all_talent_categories($talent_selected_category);
$talent_sub_categories = wp_list_pluck($talent_sub_categories_obj,'name', 'term_id');
?>

<section class="flat-dashboard-setting">
    <div class="themes-container">
        <form class="gt-form row" data-redirect-url="/gotalent-dashboard/manage-profile" method="POST" action="gotalent/user/process_meta" enctype="multipart/form-data">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">
                    
                    <div class="author-profile flex2 border-bt">
                        <?php
                        echo GTFormHelper::generate_dashboard_form_fields(array(
                            array(
                                'type' => 'file',
                                'name' => 'profile-image-uploader',
                                'action' => 'gt_upload_images',
                                'max_upload' => 1,
                                'input_id' => '_meta_profile_image_url',
                                'message' => 'Profile Image'
                            ),
                            array(
                                'type' => 'file',
                                'name' => 'cover-image-uploader',
                                'action' => 'gt_upload_images',
                                'max_upload' => 1,
                                'input_id' => '_meta_cover_image_url',
                                'message' => 'Upload Cover Image Here'
                            ),
                        ))
                        ?>
                        
                    </div>

                    <div class="form-infor-profile">
                        <h4 class="profile-info-heading"><?php echo __('Personal Information', 'gotalent-core'); ?></h4>
                        <div class="gt-form-row">
                            <?php
                                GTFormHelper::generate_dashboard_form_fields(
                                    array(
                                        array(
                                            'type' => 'text',
                                            'name' => 'first_name',
                                            'label' => 'First name',
                                            'required' => false,
                                            'value' => $user->first_name,
                                        ),
                                        array(
                                            'type' => 'text',
                                            'name' => 'last_name',
                                            'label' => 'Last Name',
                                            'required' => false,
                                            'value' => $user->last_name,
                                        ),
                                        array(
                                            'type' => 'email',
                                            'name' => 'email_address',
                                            'label' => 'Email Address',
                                            'required' => false,
                                            'value' => $user->user_email,
                                        ),
                                        array(
                                            'type' => 'password',
                                            'name' => 'password',
                                            'label' => 'Password',
                                            'required' => false,
                                            'value' => '',
                                            'info' => __('Please leave this empty if you dont wish to update your password.', 'gotalent-core')
                                        ),
                                    )
                                );
                            ?>
                        </div>
                        <div class="gt-form-row">
                            <?php
                                GTFormHelper::generate_dashboard_form_fields(
                                    array(
                                        array(
                                            'type' => 'textarea',
                                            'name' => '_meta_bio_description',
                                            'label' => 'Bio Description',
                                            'required' => false,
                                            'value' => $description,
    
                                        ),
                                ));
                            ?>

                        </div>
                        <div class="gt-form-row">
                            <?php
                            GTFormHelper::generate_dashboard_form_fields(
                                array(
                                    array(
                                        'type' => 'text',
                                        'name' => '_meta_phone_number',
                                        'label' => 'Phone Number',
                                        'required' => false,
                                        'value' => $phone_number
                                    ),
                                    array(
                                        'type' => 'text',
                                        'name' => '_meta_alternate_phone_number',
                                        'label' => 'Alternate Phone Number',
                                        'required' => false,
                                        'value' => get_user_meta(get_current_user_id(), 'alternate_phone_number', true)
                                    )
                            ));
                        ?>
                        </div>

                        <div class="social-wrap border-bt">
                            <h3><?php echo __('Social Networking Sites','gotalent-core'); ?></h3>
                            <div class="form-social form-wg flex flat-form">
                                <div class="form-box info-wd wg-box">
                                    <fieldset class="flex2">
                                        <span class="icon-facebook"></span>
                                        <input name="_meta_facebook_profile" type="text" class="input-form"
                                            value="<?php echo $facebook_profile; ?>">
                                    </fieldset>
                                    <fieldset class="flex2">
                                        <span class="icon-twitter"></span>
                                        <input name="_meta_twitter_profile" type="text" class="input-form2"
                                            placeholder="URL" value="<?php echo $twitter_profile; ?>">
                                    </fieldset>
                                    <fieldset class="flex2">
                                        <span class="icon-instagram1"></span>
                                        <input name="_meta_instagram_profile" type="text" class="input-form2"
                                            placeholder="URL" value="<?php echo $instagram_profile; ?>">
                                    </fieldset>
                                </div>
                                <div class="form-box info-wd wg-box">
                                    <fieldset class="flex2">
                                        <span class="icon-linkedin2"></span>
                                        <input name="_meta_linkedin_profile" type="text" class="input-form2"
                                            placeholder="URL" value="<?php echo $linkedin_profile; ?>">
                                    </fieldset>
                                    <fieldset class="flex2">
                                        <span class="icon-pinterest"></span>
                                        <input name="_meta_pinterest_profile" type="text" class="input-form2"
                                            placeholder="URL" value="<?php echo $pinterest_profile; ?>">
                                    </fieldset>
                                    <fieldset class="flex2">
                                        <span class="icon-youtube"></span>
                                        <input name="_meta_youtube_profile" type="text" class="input-form2"
                                            placeholder="URL" value="<?php echo $youtube_profile; ?>">
                                    </fieldset>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="profile-setting bg-white">
                    <?php if($role !== 'administrator' && $role !== 'recruiter'): ?>
                    <div class="form-infor-profile">
                        <h4 class="profile-info-heading"><?php echo __('Professional Information', 'gotalent-core'); ?>
                        </h4>
                        <div class="gt-form-row">
                            <?php
                                GTFormHelper::generate_dashboard_form_fields(
                                    array(
                                        array(
                                            'type' => 'text',
                                            'name' => '_meta_talent_profession',
                                            'label' => 'What do you call yourself? ',
                                            'required' => false,
                                            'value' => $talent_profession,
                                        ),
                                        array(
                                            'type' => 'select',
                                            'name' => '_meta_talent_category',
                                            'label' => 'Select Your Category',
                                            'required' => false,
                                            'options' => $talent_categories,
                                            'value' => $talent_selected_category,
                                        ),
                                        array(
                                            'type' => 'select',
                                            'name' => '_meta_talent_sub_category',
                                            'label' => 'Select Your Speciality',
                                            'required' => false,
                                            'onchange' => 'gt_get_subcategories',
                                            'options' => $talent_sub_categories,
                                            'value' => $talent_selected_subcategory,
                                        ),
                                        
                                    )
                                );
                            ?>
                        </div>
                        <div class="gt-form-row">
                            <?php
                                GTFormHelper::generate_dashboard_form_fields(array(
                                    array(
                                        'type' => 'multiselect', 
                                        'name' => '_meta_talent_tags',
                                        'label' => 'Skill Tags',
                                        'required' => true,
                                        'value' => $hourly_rate,
                                        'options' => $talent_tags,
                                        'value' => $talent_selected_subcategory,
                                    ),
                                    
                                    array(
                                        'type' => 'checkbox',
                                        'name' => '_meta_accept_custom_offers',
                                        'label' => 'Accept Custom Offers',
                                        'required' => false,
                                        'fieldset_class' => 'gt-flex',
                                        'value' => 'accept_custom_offers',
                                        'default' => $accept_custom_offers,
                                    )
                                ))
                            ?>
                        </div>
                        <div class="gt-form-row">
                            <?php
                                GTFormHelper::generate_dashboard_form_fields(
                                    array(
                                        array(
                                            'type' => 'textarea',
                                            'name' => '_meta_requirement_for_performing',
                                            'label' => 'State Your Requirements to Perform',
                                            'required' => false,
                                            'value' => $requirements,
    
                                        ),
                                ));
                            ?>

                        </div>

                    </div>
                    <?php endif; ?>
                </div>

            </div>
            <div class="save-form-wrapper">
                <a href="/author/<?php echo $user->user_nicename; ?>"><?php echo __('View Your Profile', 'gotalent-core'); ?></a>
                <button type="submit" class="ms-3 btn-gt-default"><?php echo __('Save Profile Settings', 'gotalent-core'); ?></button>
            </div>
        </form>
    </div>
</section>
<?php GTThemeHelper::gt_get_header('footer-dashboard'); ?>
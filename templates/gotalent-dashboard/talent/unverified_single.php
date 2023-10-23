<?php GTThemeHelper::gt_get_header('header-dashboard'); 
$talent = GTTalentPostType::gt_get_talent($_GET['query_id']);
$talent_data = get_userdata($talent->ID);
$profile_image_url = get_user_meta($talent->ID,'profile-image-url', true)[0];
$profession = get_user_meta($talent->ID,'talent_profession',true);
$tags = get_user_meta($talent->ID,'talent_tags',true);
$hourly_rate = get_user_meta($talent->ID,'per_hour_rate',true);
$description = get_user_meta($talent->ID,'bio_description',true);
$phone_number = get_user_meta($talent->ID,'phone_number', true);

?>
<section class="flat-dashboard-user flat-dashboard-profile">
      <div class="themes-container">
        <div class="row">
          <div class="col-lg-12 col-md-12 ">
            <div class="wrap-profile flex2 bg-white">

              <div class="box-profile flex2">
                <div class="images">
                  <img width="100" height="100" src="<?php echo $profile_image_url ?>" alt="">
                </div>
                <div class="content">
                  <h5 class="fw-6 color-3"><?php echo $profession; ?></h5>
                  <div class="check-box flex2">

                    <h3><?php echo $talent->first_name . ' ' . $talent->last_name; ?></h3>
                  </div>
                  <div class="tag-wrap flex">
                    <div class="tag-box flex">
                     <?php if(!empty($tags)): foreach($tags as $tag): ?>
                        <a href="javascript:void"><?php echo $tag; ?></a>
                    <?php endforeach; endif; ?>
                    </div>
                    <div class="map color-4">United Arab Emirates</div>
                    <div class="dolar color-4">AED <?php echo $hourly_rate ?>/hour</div>
                  </div>

                </div>
              </div>
              <div class="save-form-wrapper">
                  <button type="submit" class="btn-gt-default-2"><?php echo __('Decline', 'gotalent-core'); ?></button>
                <button type="submit" class="btn-gt-default"><?php echo __('Approve Talent', 'gotalent-core'); ?></button>
            </div>


            </div>

          </div>

        </div>
      </div>
    </section>
    <section class="flat-dashboard-overview flat-dashboard-about">
      <div class="themes-container">
        <div class="row">
          <div class="col-lg-12 col-md-12 ">
            <div class="wrap-about flex">
              <div class="side-bar">
                <div class="sidebar-map bg-white">

                  <div class="title-box flex">
                    <div class="p-16">Career Finding</div>
                    <h4 class="color-"><?php echo $profession; ?></h4>
                  </div>
                  <div class="title-box flex">
                    <div class="p-16">Location</div>
                    <h4>Dubai, United Arab Emirates</h4>
                  </div>
                  <div class="title-box flex">
                    <div class="p-16">Phone Number</div>
                    <h4><?php echo $phone_number ?></h4>
                  </div>
                  <div class="title-box flex">
                    <div class="p-16">Email</div>
                    <h4><?php echo $talent->user_email; ?></h4>
                  </div>
                  <div class="title-box flex">
                    <div class="p-16">Hourly Rate</div>
                    <h4><?php echo $hourly_rate; ?> / Hour</h4>
                  </div>

                  <div class="title-box flex">
                    <div class="p-16">Language</div>
                    <h4>English, Arabic </h4>
                  </div>
                  <div class="title-box flex">
                    <div class="p-16">Age</div>
                    <h4>26 Years Old</h4>
                  </div>
     
                  <div class="wrap-icon">
                    <h4>Socials:</h4>
                    <div class="box-icon flex">
                      <a href="<?php echo get_user_meta($talent->ID,'facebook_profile',true); ?>" class="icon-facebook"></a>
                      <a href="<?php echo get_user_meta($talent->ID,'linkedin_profile',true); ?>" class="icon-linkedin2"></a>
                      <a href="<?php echo get_user_meta($talent->ID,'twitter_profile',true); ?>" class="icon-twitter"></a>
                      <a href="<?php echo get_user_meta($talent->ID,'pinterest_profile',true); ?>" class="icon-pinterest"></a>
                      <a href="<?php echo get_user_meta($talent->ID,'instagram_profile',true); ?>" class="icon-instagram1"></a>
                      <a href="<?php echo get_user_meta($talent->ID,'youtube_profile',true); ?>" class="icon-youtube"></a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="post-about widget-dash-video bg-white">
                <h3 class="title-about">About Me</h3>
                <p><?php echo $description; ?></p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
<?php GTThemeHelper::gt_get_header('footer-dashboard'); ?>
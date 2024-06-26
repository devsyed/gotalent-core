<?php GTThemeHelper::gt_get_header('header-dashboard');
$talent = GTTalentPostType::gt_get_talent($_GET['query_id']);
$talent_data = get_userdata($talent->ID);
$profile_image_url = (get_user_meta($talent->ID, 'profile_image_url', true)) ? get_user_meta($talent->ID, 'profile_image_url', true) : get_avatar_url($talent->ID);
$profession = get_user_meta($talent->ID, 'talent_profession', true);
$tags = get_user_meta($talent->ID, 'talent_tags', true);
$hourly_rate = get_user_meta($talent->ID, 'per_hour_rate', true);
$description = get_user_meta($talent->ID, 'bio_description', true);
$phone_number = get_user_meta($talent->ID, 'phone_number', true);
$drivers_license = get_user_meta($talent->ID, 'drivers_license', true);
$proof_numbering = ['one', 'two', 'three'];
$proofs = [];
foreach ($proof_numbering as $proof_number) {
    $proofs[] = get_user_meta($talent->ID, 'proof_' . $proof_number, true);
}
$formatted_proofs = array_filter($proofs);
$portfolio = !empty(get_user_meta($talent->ID, 'portfolio_links', true)) ? get_user_meta($talent->ID, 'portfolio_links', true) : [];

$allowed_videos_link = 5;
$portfolio_video_links = get_user_meta($talent->ID, 'portfolio_video_links', true);
$values = [];
for ($i = 0; $i < $allowed_videos_link; $i++) {
    $values[] = (isset($portfolio_video_links['_meta_portfolio_video_link_' . $i])) ? $portfolio_video_links['_meta_portfolio_video_link_' . $i] : null;
}
$values_filtered = array_filter($values);
?>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        lightGallery(document.getElementById('lightgallery'), {
            speed: 500,
        });
    })
</script>

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
                            <div class="check-box flex2 m-0">

                                <h3><?php echo $talent->first_name . ' ' . $talent->last_name; ?></h3>
                            </div>
                            <div class="tag-wrap flex">
                                <div class="tag-box flex">
                                    <?php if (!empty($tags)) : foreach ($tags as $tag) : ?>
                                            <a href="javascript:void"><?php echo $tag; ?></a>
                                    <?php endforeach;
                                    endif; ?>
                                </div>
                                <div class="map color-4">United Arab Emirates</div>

                            </div>

                        </div>
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
<section class="flat-dashboard-user flat-dashboard-profile">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-8 col-md-8 ">
                <div class="wrap-profile flex2 bg-white">

                    <div class="box-profile flex2">

                        <div class="content">
                            <div class="check-box flex2">
                                <h3>Verification Documents Uploaded</h3>
                            </div>
                            <?php if ($formatted_proofs) : foreach ($formatted_proofs as $proof) : ?>
                                    <img src="<?php echo $proof ?>" alt="">
                            <?php endforeach;
                            endif; ?>
                        </div>
                    </div>


                </div>

            </div>
            <div class="col-lg-4 col-md-4">
                <div class="wrap-profile bg-white">
                    <p class="confidential-details-title mt-0">Bank Details</p>
                    <ul>
                        <li><strong>Bank Name:</strong> <?php echo get_user_meta($talent->ID, 'bank_name', true); ?></li>
                        <li><strong>Account Number:</strong> <?php echo get_user_meta($talent->ID, 'account_number', true); ?></li>
                        <li><strong>Swift Code</strong> <?php echo get_user_meta($talent->ID, 'swift_code', true); ?></li>
                        <li><strong>IBAN Number</strong> <?php echo get_user_meta($talent->ID, 'iban_number', true); ?></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="flat-dashboard-user flat-dashboard-profile">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="wrap-profile flex2 bg-white">

                    <div class="box-profile flex2">

                        <div class="content">
                            <div class="check-box flex2">
                                <h3>Talent Media Images</h3>
                            </div>
                            <div id="lightgallery">
                                <?php if (!empty($portfolio)) : foreach ($portfolio as $ps) : ?>
                                        <a href="<?php echo $ps ?>">
                                            <img class="portfolio-item-single" src="<?php echo $ps ?>" alt="<?php echo $ps ?>">
                                        </a>
                                <?php endforeach;
                                endif; ?>
                            </div>

                        </div>
                    </div>



                </div>

            </div>

        </div>
    </div>
</section>
<section class="flat-dashboard-user flat-dashboard-profile">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="wrap-profile flex2 bg-white">

                    <div class="box-profile flex2">

                        <div class="content">
                            <div class="check-box flex2">
                                <h3>Talent Media Videos</h3>
                            </div>
                            <div id="lightgallery">
                                <?php if (!empty($values_filtered)) : foreach ($values_filtered as $ps) : ?>
                                        <a target="_blank" href="https://www.youtube.com/watch?v=<?php echo $ps ?>">
                                            <img class="portfolio-item-single" src="http://img.youtube.com/vi/<?php echo $ps ?>/mqdefault.jpg" alt="<?php echo $ps ?>">
                                        </a>
                                <?php endforeach;
                                endif; ?>
                            </div>

                        </div>
                    </div>



                </div>
                <div class="save-form-wrapper">
                    <form action="gotalent/talent/remove_talent" method="POST" class="gt-form">
                        <input type="hidden" name="talent_id" value="<?php echo $talent->ID ?>">
                        <button type="submit" class="btn-gt-default">Remove Talent</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_header('footer-dashboard'); ?>
<?php GTThemeHelper::gt_get_header('header-dashboard'); ?>

<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">
                    <?php echo do_shortcode('[better_messages]') ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php GTHelpers::gt_get_template_part('gotalent-dashboard/modal-generate-payment-link.php'); ?>
<?php GTThemeHelper::gt_get_header('footer-dashboard'); ?>
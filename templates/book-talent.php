<?php
get_header();
GTThemeHelper::show_breadcrumb('Proceed Your Booking with Talent','Select the package you want to book the talent for.');
$talent_id = isset($_GET['talent_id']) ? $_GET['talent_id'] : 0;
$packages = GTPackagePostType::gt_get_all_talent_packages($talent_id);
?>
<div class="wrapper-buy-package">
    <div class="container mt-5 py-5">
        <div class="row justify-content-start">
            <div class="col-md-12">
                <div class="row">
                <?php 
            if(!empty($packages)): foreach($packages as $package):
                 GTHelpers::gt_get_template_part('package-single.php', $package); 
                    endforeach; 
                else:
                    echo 'Talent does not have any Packages ';
             endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<?php
GTThemeHelper::gt_get_header('header-dashboard');
$talent_packages = GTPackagePostType::gt_get_all_talent_packages(get_current_user_id());

?>
<div class="add-new-button">
    <a href="/gotalent-dashboard/manage-packages?add_new"><?php echo __('Add New', 'gotalent-core'); ?></a>
</div>
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">
                <table id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo __('Package Name', 'gotalent-core'); ?></th>
                                <th><?php echo __('Package Price', 'gotalent-core'); ?></th>
                                <th><?php echo __('Number of Sets', 'gotalent-core'); ?></th>
                                <th><?php echo __('Action', 'gotalent-core'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if($talent_packages->have_posts()): while($talent_packages->have_posts()): $talent_packages->the_post(); $package = get_post(get_the_ID()) ?>
                            <tr>
                                <td><?php echo get_the_ID(); ?></td>
                                <td><?php echo $package->post_title; ?></td>
                                <td>AED <?php echo get_post_meta(get_the_ID(),'price',true); ?></td>
                                <td><?php echo get_post_meta(get_the_ID(),'number_of_sets',true); ?></td>
                                <td><a href="?query_id=<?php echo get_the_ID(); ?>">View</a></td>
                            </tr>
                            <?php endwhile; wp_reset_query(); endif; ?>
                        </tbody>
                    </table>
                </div>


            </div>

        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_footer('footer-dashboard'); ?>
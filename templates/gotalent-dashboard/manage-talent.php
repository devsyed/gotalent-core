<?php 
GTThemeHelper::gt_get_header('header-dashboard');
$results = GTTalentPostType::gt_get_verified_talent();

?>
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="profile-setting bg-white">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Date Applied</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if($results): foreach($results as $talent): $user = get_userdata($talent->ID) ?>
                          <tr>
                            <td><?php echo $user->ID; ?></td>
                            <td><?php echo $user->first_name ?></td>
                            <td><?php echo $user->last_name ?></td>
                            <td><?php echo $user->user_email ?></td>
                            <td><?php echo $user->user_registered ?></td>
                            <td><a href="/author/<?php echo $user->user_nicename; ?>">View Talent Page</a></td>
                          </tr>
                        <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</section>
<?php GTThemeHelper::gt_get_header('footer-dashboard'); ?>
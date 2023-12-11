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
                                <th>Set as Featured</th>
                                <th>Action</th>
                                <th>&nbsp;</th>
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
                            <td><?php if(!get_user_meta($user->ID,'is_spotlight_talent',true) == 'yes'): ?>
                                <form method="POST" action="gotalent/talent/set_as_spotlight" class="gt-form">
                                    <input type="hidden" name="talent_id" value="<?php echo $user->ID ?>">
                                    <button class="btn-gt-default" type="submit">Set as Spotlight Talent</button>
                                </form>
                            <?php else: ?>
                                <form method="POST" action="gotalent/talent/unset_as_spotlight" class="gt-form">
                                    <input type="hidden" name="talent_id" value="<?php echo $user->ID ?>">
                                    <button class="btn-gt-default" type="submit">Remove From Spotlight Talent</button>
                                </form>
                            <?php endif; ?></td>
                            <td><a href="/author/<?php echo $user->user_nicename; ?>">View Talent Page</a></td>
                            <td><button class="btn-gt-secondary">
                            Remove Talent
                            </button></td>
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
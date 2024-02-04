
<?php GTThemeHelper::gt_get_header('header-dashboard'); 
$recruiters = GTRecruiterPostType::gt_get_all_recruiters();
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
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($recruiters)): foreach($recruiters as $recruiter):  ?>
                                <tr>
                                    <td><?php echo $recruiter->ID; ?></td>
                                    <td><?php echo $recruiter->display_name; ?></td>
                                    <td><?php echo $recruiter->user_email; ?></td>
                                    <td><form action="gotalent/recruiter/remove_recruiter" method="POST" class="gt-form">
                                    <input type="hidden" name="recruiter_id" value="<?php echo $recruiter->ID ?>">    
                                    <button type="submit" class="btn-gt-default">Remove Recruiter</button>
                                </form></td>
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
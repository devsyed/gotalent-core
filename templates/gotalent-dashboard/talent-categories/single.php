<?php GTThemeHelper::gt_get_header('header-dashboard');

$talent_categories_obj = GTTaxonomy_Talent_Category::gt_get_all_talent_categories($_GET['query_id']);
$sub_categories = wp_list_pluck($talent_categories_obj,'name', 'term_id');
?>
<script>

</script>
<div class="add-new-button">
    <a href="/gotalent-dashboard/manage-talent-categories?add_new&cat_id=<?php echo $_GET['query_id'] ?>"><?php echo __('Add New Sub Category', 'gotalent-core'); ?></a>
</div>
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">

            <div class="profile-setting bg-white">
                <table id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php if(!empty($sub_categories)): foreach($sub_categories as $id => $sub_category): ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $sub_category ?></td>
                                <td><button class="btn-gt-default" data-action-url="" >Delete</button></td>
                            </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php GTThemeHelper::gt_get_footer('footer-dashboard'); ?>
<?php GTThemeHelper::gt_get_header('header-dashboard'); 
$all_catgories = GTTaxonomy_Talent_Category::gt_get_all_talent_categories();
?>
<div class="add-new-button">
    <a href="/gotalent-dashboard/manage-talent-categories?add_new"><?php echo __('Add New', 'gotalent-core'); ?></a>
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
                                <th>Description</th>
                                <th>Sub Categories</th>
                                <th>Count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($all_catgories)): foreach ($all_catgories as $category):
                                
                                $talent_sub_categories_count = count(wp_list_pluck(GTTaxonomy_Talent_Category::gt_get_all_talent_categories($category->term_id),'name', 'term_id'));
                                $talents= GTTalentPostType::gt_get_talent_by_category($category->term_id);
                                $talent_ids = [];
                                foreach($talents as $talent){
                                    $talent = get_userdata($talent->ID);
                                    $talent_ids[] = $talent->ID;
                                };


                            ?>
                               <tr>
                                <td><?php echo $category->term_id; ?></td>
                                <td><?php echo $category->name; ?></td>
                                <td><?php echo $category->description; ?></td>
                                <td><?php echo $talent_sub_categories_count; ?></td>
                                <td><?php echo count($talent_ids); ?></td>
                                <td><a href="/gotalent-dashboard/manage-talent-categories?query_id=<?php echo $category->term_id; ?>">View Details</a></td>
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
<?php GTThemeHelper::gt_get_header('header-dashboard');

$talent_categories_obj = GTTaxonomy_Talent_Category::gt_get_all_talent_categories(false,1);
$talent_categories = wp_list_pluck($talent_categories_obj,'name', 'term_id');
$talent_categories[0] = 'Select Category';
?>
<script>

</script>
<section class="flat-dashboard-setting">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
            <div class="profile-setting bg-white">
                <p class="error-form"></p>
                <form method="POST" class="gt-form" action="gotalent/talent_categories/add_new"  data-redirect-url="/gotalent-dashboard/manage-talent-categories">
                    <div class="gt-form-control">
                        <?php GTFormHelper::generate_dashboard_form_fields(array(
                            array(
                                'type' => 'text', 
                                'name' => 'category_name',
                                'label' => 'Category Name'
                            ),
                            array(
                                'type' => 'select', 
                                'name'=> 'parent_category', 
                                'label' => 'Parent Category',
                                'options' => $talent_categories,
                                'default' => (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0
                            )
                        )) ?>
                    </div>
                    <button type="submit" class="btn-gt-default"><?php echo __('Create Category', 'gotalent-core'); ?></button>
                    <?php wp_nonce_field( 'gotalent_add_category', 'gotalent_add_category_nonce' ); ?>
                </form>
            </div>
            </div>
        </div>
    </div>
</section>

<?php GTThemeHelper::gt_get_footer('footer-dashboard'); ?>
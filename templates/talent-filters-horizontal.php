<?php
$talent_categories_obj = GTTaxonomy_Talent_Category::gt_get_all_talent_categories();
$talent_categories = wp_list_pluck($talent_categories_obj,'name', 'term_id');
$searched_category_id = isset($_GET['cat_slug']) ? $_GET['cat_slug'] : 0;
$talent_sub_categories_obj = GTTaxonomy_Talent_Category::gt_get_all_talent_categories($searched_category_id);
$talent_sub_categories = wp_list_pluck($talent_sub_categories_obj,'name', 'term_id');
$searched_keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
?>
<section class="form-sticky stc2">
    <div class="tf-container">
        <div class="candidate-form job-search-form inner-form-map style2">
            <form method="GET">
                <div class="row-group-search">
                <?php GTFormHelper::generate_dashboard_form_fields(array(
                            array(
                                'type' => 'text', 
                                'name' => 'talent_keyword',
                                'label' => 'Keyword',
                                'value' => $searched_keyword
                            ),
                            array(
                                'type' => 'select',
                                'name' => 'cat_slug',
                                'label' => 'Select Category',
                                'required' => false,
                                'options' => $talent_categories,
                                'default' => $searched_category_id
                            ),
                            array(
                                'type' => 'select',
                                'name' => 'sub_cat_slug',
                                'label' => 'Select Sub Category',
                                'required' => false,
                                'onchange' => 'gt_get_subcategories',
                                'options' => ($searched_category_id !== 0) ? $talent_sub_categories : [],

                            ),
                        )) ?>
                    <div class="form-group-btn mt-3">
                        <button type="submit" class="btn-gt-default" id="filterCandidates"><?php echo __('Filter Candidates', 'gotalent-core'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
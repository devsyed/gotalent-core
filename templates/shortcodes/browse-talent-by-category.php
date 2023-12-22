<?php $talent_categories = $variables; ?>
<div class="group-category-job wow fadeInUp">
    <?php if($talent_categories): foreach($talent_categories as $category): ?>
        <div class="job-category-box">
            <div class="job-category-header">
            <h1><a href="<?php echo '/talent?cat_slug=' . $category->term_id; ?>"><?php echo $category->name; ?></a></h1>
            </div>
            <a href="<?php echo '/talent?cat_slug=' . $category->term_id; ?>" class="btn-category-job"><?php echo __('Explore Talent ', 'gotalent-core'); ?><span class="icon-keyboard_arrow_right"></span></a>
        </div>
    <?php endforeach; endif; ?>
</div>
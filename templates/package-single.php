<?php $package = $variables;
?>
<div class="col-5 pricing-box me-2  mb-2">
    <div class="group-tag">
        <div class="tag1"><?php echo $package['post_title']; ?></div>
    </div>
    <div class="pricing">
        <h6 class="ms-0 text-start">AED <?php echo get_post_meta($package['ID'],'price', true); ?></h6>
    </div>
    <ul class="list-unstyled mt-3 mb-4">
        <li><strong>Number of Packages:
        </strong><?php echo get_post_meta($package['ID'],'number_of_sets', true); ?></li>
        <li><strong>Duration: </strong><?php echo get_post_meta($package['ID'],'duration', true); ?></li>
        <li><strong>Inlcudes: </strong><?php echo get_post_meta($package['ID'],'includes', true); ?></li>
        <li><strong>Excludes: </strong><?php echo get_post_meta($package['ID'],'excludes', true); ?></li>
        <li><strong>Excludes: </strong><?php echo get_post_meta($package['ID'],'excludes', true); ?></li>
        <li><strong>Description: </strong><?php echo get_post_meta($package['ID'],'description', true); ?>
        </li>

    </ul>
    <a href="/buy-package?query_id=<?php echo $package['ID'] ?>" class="btn">Buy Package</a>
</div>
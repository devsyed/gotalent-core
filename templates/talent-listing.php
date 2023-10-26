<?php $talent = GTTalentPostType::gt_get_verified_talent();?>
<section class="candidates-section">
  <div class="tf-container">
    <div class="row">
      <div class="col-lg-12 tf-tab">
        <div class="wd-meta-select-job">
          <div class="wd-findjob-filer">
            <div class="group-select-display">

              <p class="nofi-job">
                <span>1249</span> candidates recommended for you
              </p>
            </div>
            <div class="group-select">
              <select>
                <option>12 Per Page</option>
                <option>1 Per Page</option>
                <option>10 Per Page</option>
              </select>
              <select>
                <option>Sort by (Defaut)</option>
                <option>New</option>
                <option>Last</option>
              </select>
            </div>
          </div>
        </div>

        <div class="content-tab">
          <div class="inner">
            <div class="group-col-3">
              <?php if(!empty($talent)): foreach($talent as $talent_single): ?>
                <?php GTHelpers::gt_get_template_part('talent-listing-single.php',array('talent_id' => $talent_single->ID)); ?>
              <?php endforeach; endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
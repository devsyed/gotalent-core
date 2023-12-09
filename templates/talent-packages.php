<?php $packages = $variables; ?>
<div class="talent-packages-all">
    <section class="pricing-section-two">
        <div class="tf-container st3">
            <div class="group-pricing-v1 st-2 tf-tab">
                <div class="content-tab">
                    <div class="inner active" style="margin-left:10px;">
                        <div class="group-col-3">
                            <?php if(!empty($packages)): foreach($packages as $package):  ?>
                                <?php GTHelpers::gt_get_template_part('package-single.php', $package); ?>
                            <?php 
                            endforeach; 
                            else:
                            echo 'Talent does not have any Packages ';
                            endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

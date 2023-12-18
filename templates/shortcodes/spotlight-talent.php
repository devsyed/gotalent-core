<?php
$all_spotlight_talent = GTSpotlightHandler::gt_get_all_spotlight_talent(); ?>
<div class="spotlight-talent-videos swiper mb-4">
    <div class="swiper-wrapper">
        <?php if (!empty($all_spotlight_talent)) : foreach ($all_spotlight_talent as $talent) :
                $profile_image = (get_user_meta($talent->ID, 'profile_image_url', true)) ? get_user_meta($talent->ID, 'profile_image_url', true) : get_avatar_url($talent->ID);
        ?>
                <div class="swiper-slide">
                  <a href="/author/<?php echo $talent->user_nicename; ?>">
                  <div class="spotlight-talent-single mb-3" style="background-image:url(<?php echo $profile_image; ?>)">
                    </div>
                    <div class="spotlight-video-header">
                        <p><?php echo get_user_meta($talent->ID, 'talent_profession', true); ?></p>
                        <h1><?php echo $talent->display_name ?></a></h1>
                    </div>
</a>
                </div>
        <?php endforeach;
        endif; ?>
    </div>
</div>
<?php 
$all_spotlight_videos = GTSpotlightHandler::gt_get_all_spotlight_talent_videos();
$all_video_ids = array_values($all_spotlight_videos[0]);
if($all_video_ids[0]) {
    unset($all_video_ids[0]);
}
?>
<div class="spotlight-talent-videos swiper">
    <div class="swiper-wrapper">
        <?php if(!empty($all_video_ids)): foreach($all_video_ids as $video_id): ?>
            <div class="swiper-slide">
                <div class="spotlight-talent-single" style="background-image:url(<?php echo 'https://i.ytimg.com/vi/'.$video_id.'/maxresdefault.jpg' ?>)"></div>
            </div>
        <?php endforeach; endif; ?>
    </div>
</div>

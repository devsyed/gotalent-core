<?php 
$all_spotlight_videos = GTSpotlightHandler::gt_get_all_spotlight_talent_videos();
$video_ids = [];
if(!empty($all_spotlight_videos)){
    foreach($all_spotlight_videos as $user_id => $video_id){
            for($i = 0; $i < 5; $i++){
                if(empty($video_id[0]['_meta_portfolio_video_link_' . $i])) continue;
                $video_ids[$user_id][] = $video_id[0]['_meta_portfolio_video_link_' . $i];
            }
     }
} 
?>

<script type="text/javascript">
   
   function handleTalentVideos(){
    var spotlightVideoArea = document.getElementById('spotlight-video-area');
    var iframeArea = document.querySelector('.iframe-area');
    document.querySelector(".close-spotlight-area").addEventListener('click', function(){
        spotlightVideoArea.style.display = 'none';
    })

    document.querySelectorAll(".spotlight-talent-single").forEach(function(div,index){
        var videoId = div.dataset.videoId;
        div.addEventListener('click',function(e){
            spotlightVideoArea.style.display = 'flex';
            spotlightVideoArea.classList.add('open-spotlight-area')
            iframeArea.innerHTML = `<iframe style="width:60vw; height:60vh;"
            src="https://www.youtube.com/embed/${videoId}">
            </iframe>`
        })
    });
   }
   document.addEventListener("DOMContentLoaded", function(){
    if (document.querySelector(".spotlight-talent-videos")?.length > 0) {
        const spotlightTalentVideos = new Swiper(".spotlight-talent-videos", {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 32,
            thumbs: {
                swiper: thumbsPortfolio
            },
            navigation: {
                clickable: true,
                nextEl: ".button-tes-next",
                prevEl: ".button-tes-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                500: {
                slidesPerView: 2,
                spaceBetween: 32,
                },
                1200: {
                slidesPerView: 4,
                spaceBetween: 46,
                },
            },
        });
    }
    handleTalentVideos()
   })
</script>
<div id="spotlight-video-area">
    <button class="close-spotlight-area"><i class="fas fa-times"></i></button>
    <div class="iframe-area"></div>
</div>
<div class="spotlight-talent-videos swiper mb-4">
    <div class="swiper-wrapper">
    <?php if(!empty($video_ids)): foreach($video_ids as $user_id =>  $video_id): $i = 0; $user = get_user_by('id', $user_id); ?>
            <div class="swiper-slide">
                <div class="spotlight-talent-single mb-3" data-video-id="<?php echo $video_id[$i]; ?>" style="background-image:url(<?php echo 'https://i.ytimg.com/vi/'.$video_id[$i].'/maxresdefault.jpg' ?>)">
               <button class="play-video"> <i class="fas fa-play"></i></button>
            </div>
            <p></p>
            <div class="spotlight-video-header">
                <p><?php echo get_user_meta($user->ID,'talent_profession',true); ?></p>
                <h1><a href="/author/<?php echo $user->user_nicename ?>"><?php echo $user->display_name ?></a></h1>
            </div>
            
            </div>
        <?php $i++; endforeach; endif; ?>
    </div>
</div>


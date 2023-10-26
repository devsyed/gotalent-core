<?php 
$talent_id = $variables['talent_id'];
$talent = get_userdata($talent_id);
$profile_image_url = get_user_meta($talent_id,'profile-image-url', true)[0];
$profession = get_user_meta($talent_id,'talent_profession',true);
$tags = get_user_meta($talent_id,'talent_tags',true);
$hourly_rate = get_user_meta($talent_id,'per_hour_rate',true);
$description = get_user_meta($talent_id,'bio_description',true);
$phone_number = get_user_meta($talent_id,'phone_number', true);

?>
<div class="features-job wd-thum-career stc style-2 cl3">
  <div class="job-archive-header">
    <div class="career-header-left">
      <img src="<?php echo $profile_image_url; ?>" alt="<?php echo $profile_image_url; ?>" class="thumb">
      <div class="career-left-inner">
        <h4>
          <a href="#"><?php echo $profession; ?></a>
        </h4>
        <h3>
          <a href="#"><?php echo $talent->first_name . ' ' . $talent->last_name; ?></a>
          <span class="icon-bolt"></span>
        </h3>
        <ul class="career-info">
          <li>Available now</li>
          <li>
            <span class="icon-map-pin"></span>
            Dubai, United Arab Emirates
          </li>
          <li>
            <span class="icon-dolar1"></span>
            <?php echo $hourly_rate ?> / hour
          </li>
        </ul>

        <ul class="career-tag">
          <?php if(!empty($tags)): foreach($tags as $tag): ?>
            <li><a href="javascript:void(0)"><?php echo ucwords($tag) ?></a></li>
          <?php endforeach; endif;  ?>
        </ul>
      </div>
    </div>
    <div class="career-header-right">
      <span class="icon-heart"></span>
    </div>
  </div>
  <div class="job-archive-footer">
    <a href="/author/<?php echo $talent->user_nicename ?>" class="tf-btn">View Profile</a>
  </div>
</div>
</div>
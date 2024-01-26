<?php $talent_cats = $variables; ?>
<div class="category-header-bar py-2 d-flex align-items-center">
    <div class="tf-container">
      <div class="categories-header-bar swiper">
        <ul class="swiper-wrapper align-items-center">
          <?php if($talent_cats): foreach($talent_cats as $talent_cat): ?>
            <li class="swiper-slide text-center">
                <a href="/talent?cat_slug=<?php echo $talent_cat->term_id ?>"><?php echo $talent_cat->name; ?></a>
            </li>
          <?php endforeach; endif; ?>
        </ul>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>
  </div>
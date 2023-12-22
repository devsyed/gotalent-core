<?php $user = wp_get_current_user(); ?>
<header class="header-fixed">
    <div class="tf-container">
      <div class="row align-items-center">
        <div class="col-3">
          <div class="d-flex">
            <button class="mobile-menu-btn d-block d-lg-none"><i class="fas fa-bars"></i></button>
            <?php if(function_exists('gt_logo')): gt_logo(); endif; ?>
          </div>
        </div>
        <div class="col-9 d-flex align-items-center justify-content-end justify-content-lg-between ">
          <div class="gt-header-option gt-location-option d-flex align-items-center gap-2  d-none d-lg-flex">
            <img src="<?php echo GT_IMAGES ?>/location.svg" alt="gt-location">
            <div class="gt-location-option d-flex flex-column">
              <small><?php echo __('Location','gotalent') ?></small>
              <select name="gt_country" id="gt_country">
                <option value="uae">United Arab Emirates</option>
              </select>
            </div>
          </div>
          <div class="gt-header-option gt-language-option ms-3 d-flex align-items-center gap-2  d-none d-lg-flex">
            <img src="<?php echo GT_IMAGES ?>/global.svg" alt="gt-language">
            <div class="gt-language-option d-flex flex-column">
              <small><?php echo __('Language', 'gotalent'); ?></small>
              <select name="gt_language" id="gt_language">
                <option value="en">English</option>
              </select>
            </div>
          </div>
          <?php 
            wp_nav_menu(array(
              'theme_location' => 'primary', 
              'container' => 'ul',
              'menu_class' => 'header-navigation d-none d-lg-flex m-0 py-0 align-items-center gap-3 list-category'
            ));
          ?>
          <?php if(!is_user_logged_in()): ?>
            <button class="btn-gt-default" data-bs-toggle="modal" data-bs-target="#registration-modal"><?php echo __('Login/Register','gotalent'); ?></button>
          <?php else: ?>
            <div class="header-customize-item account">
              <a href="<?php echo (current_user_can('can_manage_recruiter_and_talent') || current_user_can('can_hire_talent')) ? '/gotalent-dashboard/manage-bookings' : '/gotalent-dashboard/manage-profile' ?>" class="btn-gt-default"><?php echo __('Dashboard', 'gotalent-core'); ?></a>
            </div
          <?php endif; ?>
        </div>
      </div>

    </div>
  </header>
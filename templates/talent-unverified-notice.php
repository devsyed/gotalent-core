<?php $user_verified = $variables['variable']; ?>
<p class="account-verification-notice">
    <?php if($user_verified !== 'true' && !current_user_can('can_hire_talent')): ?>
        <?php echo __('<span class="icon-mark">!</span>Your account is not verified, you will not show up in results until you finish 
        verification.','gotalent-core'); ?> <a href="/gotalent-dashboard/manage-verification-settings"><?php echo __('Verify Now', 'gotalent-core'); ?></a>
    <?php endif; ?>
</p>
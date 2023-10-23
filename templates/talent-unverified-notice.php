<?php $user_verified = $variables['variable']; ?>
<p class="account-verification-notice">
    <?php if($user_verified !== 'true'): ?>
        <?php echo __('<span class="icon-mark">!</span>Your account is not verified, you will not show up in results until you finish 
        verification.','gotalent-core'); ?> <a href="/"><?php echo __('Verify Now', 'gotalent-core'); ?></a>
    <?php endif; ?>
</p>
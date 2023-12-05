<?php $user = $variables;
$avatar_url = get_user_meta($user['ID'], 'profile_image_url',true);
?>
<div class="header-customize-item account ms-5">
    <img class="user-avatar" src="<?php echo ($avatar_url !== '') ? $avatar_url : get_avatar_url($user['ID']); ?>" alt="user-image" width="50" height="50">
    <div class="name">
        <?php echo $user['display_name'] ?><span class="icon-keyboard_arrow_down"></span>
    </div>
</div>
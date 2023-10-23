<?php $user = $variables;
$first_name = get_user_meta($user['ID'], 'first_name', true);
$last_name = get_user_meta($user['ID'], 'last_name', true);
$avatar_url = get_user_meta($user['ID'], 'profile-image-url',true)[0];
?>
<div class="header-customize-item account ms-5">
    <img class="user-avatar" src="<?php echo $avatar_url ?>" alt="user-image" width="50" height="50">
    <div class="name">
        <?php echo $first_name . ' ' . $last_name; ?><span class="icon-keyboard_arrow_down"></span>
    </div>
</div>
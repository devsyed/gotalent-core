<!doctype html>
<html <?php language_attributes(); ?>>
<?php 
global $wp;
$page_title = str_replace(['-','/', '_', 'gotalent', 'dashboard'], ' ', $wp->request);
$title = ($page_title !== '') ? ucwords($page_title) : 'Dashboard';

?>
<head>
	<meta charset="UTF-8" />
  	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <title><?php echo $title; ?> | GoTalent</title>
	<?php wp_head(); ?>
</head>

<body class="dashboard show">

<?php wp_body_open(); ?>
<div id="wrapper">
<header id="header" class="header header-default ">
    <div class="tf-container ct2">
        <div class="row">
            <div class="col-md-12">
                <div class="sticky-area-wrap">
                    <div class="header-ct-left">
                        <div id="logo" class="logo">
                            <?php if(function_exists('gt_logo')): gt_logo(); endif; ?>
                            
                        </div>
                    </div>

                    <div class="header-ct-right">
                        <?php 
                            /** 
                             * gt_dashboard_user_verification - $priority 10
                             * gt_dashboard_user_menu - $priority 20
                             */
                            if(!current_user_can('manage_options')){
                                do_action('gt_dashboard_header_right');
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="left-menu">
    <div id="sidebar-menu">
        <ul class="downmenu list-unstyled" id="side-menu">
            <?php
                /**
                 * 10 - gt_dashboard_sidebar_links */ 
                do_action('gt_dashboard_sidebar_links');
             ?>
            <li>
                <a href="<?php echo wp_logout_url() ?>" class="tf-effect">
                    <span class="dash-titles"><?php echo __('Log Out','gotalent-core'); ?></span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="dashboard__content">
<section class="page-title-dashboard">
    <div class="themes-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="title-dashboard">
                    <div class="page-title"><?php echo apply_filters('dashboard_header_title', $title); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>

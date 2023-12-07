<?php 

defined('ABSPATH') || exit;

class GTShortcodeHandler
{
    public static function init()
    {
        add_shortcode('gotalent_browse_talent_by_category', array(__CLASS__,'gt_browse_talent_by_category'));
        add_shortcode('gotalent_spotlight_talent', array(__CLASS__,'gt_spotlight_talent'));
    }

    public static function gt_browse_talent_by_category()
    {
        ob_start();
        $all_categories = GTTaxonomy_Talent_Category::gt_get_all_talent_categories();
        GTHelpers::gt_get_template_part('shortcodes/browse-talent-by-category.php',$all_categories);
        return ob_get_clean(); 
    }

    public static function gt_spotlight_talent()
    {
        ob_start();
        $all_categories = GTTaxonomy_Talent_Category::gt_get_all_talent_categories();
        GTHelpers::gt_get_template_part('shortcodes/spotlight-talent.php',$all_categories);
        return ob_get_clean(); 
    }
}

GTShortcodeHandler::init();
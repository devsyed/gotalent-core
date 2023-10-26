<?php 

defined('ABSPATH') || exit;

class GTShortcodeHandler
{
    public static function init()
    {
        add_shortcode('gotalent_browse_talent_by_category', array(__CLASS__,'gt_browse_talent_by_category'));
    }


    /**  
     * Browse Talent By Category
     */
    public static function gt_browse_talent_by_category()
    {
        ob_start();
        $all_categories = GTTaxonomy_Talent_Category::gt_get_all_talent_categories();
        GTHelpers::gt_get_template_part('shortcodes/browse-talent-by-category.php',$all_categories);
        return ob_get_clean(); 
    }
}

GTShortcodeHandler::init();
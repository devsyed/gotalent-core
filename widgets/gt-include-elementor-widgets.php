<?php 

class GTIncludeElementorWidgets
{
    public static function init()
    {
        add_action( 'elementor/widgets/widgets_registered', array( __CLASS__, 'gt_include_all_widgets' ) );
    }


    /** 
     * Include All Elementor Widgets
     * 
     */
    public static function gt_include_all_widgets()
    {
        $widgets = array(
            '/gt-slider-widget.php',
            '/gt-partners-widget.php',
        );

        foreach($widgets as $widget){
            require_once __DIR__ . $widget;
        }

    }
}

GTIncludeElementorWidgets::init();
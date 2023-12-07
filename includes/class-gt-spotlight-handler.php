<?php 

defined('ABSPATH') || exit; 

class GTSpotlightHandler
{
    public static function init()
    {

    }

    public static function gt_get_all_spotlight_talent()
    {
        $spotlight_talent = new WP_User_Query(array(
			'role' => 'talent',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key'     => 'is_spotlight_talent',
					'value'   => 'yes',
					'compare' => '='
				),
			)
		));
		$results = $spotlight_talent->get_results();
		return $results;
    }


    public static function gt_get_all_spotlight_talent_videos()
    {
        $talent = self::gt_get_all_spotlight_talent();
        $all_talent_videos = [];
        if(!empty($talent)){
            foreach($talent as $talent_single){
                $all_talent_videos[] = get_user_meta($talent_single->ID,'portfolio_video_links',true);
            }
        }
        return $all_talent_videos;

    }

    
}


GTSpotlightHandler::init();
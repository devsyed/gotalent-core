<?php

class GTHelpers
{

    /** 
     * Load the template from theme (if available) or from plugin templates
     * @param string $template_name
     * @param mixed $variables
     * @return HTML
     * @author @devsyed
     */
    public static function gt_load_template($template_name = '', $variables = array())
    {
        if (is_object($variables)) {
            $variables = (array) $variables;
        } elseif (is_string($variables)) {
            $variables = array('variable' => $variables);
        }
        extract($variables);

        $template_name = str_replace('/', DIRECTORY_SEPARATOR, $template_name);

        $template_path = locate_template('gotalent/' . $template_name);
        if (!$template_path) {
            $template_path = GOTALENT_PLUGIN_PATH . 'templates/' . $template_name;
        }
        if ($template_path) {
            include($template_path);
        }
    }
    
    /**
     * Get the HTML content of a template from the theme (if available) or from plugin templates.
     *
     * @param string $template_name
     * @param array  $variables
     *
     * @return string HTML content of the template
     */
    public static function gt_get_template_content($template_name = '', $variables = array())
    {
        extract($variables);

        $template_path = locate_template('gotalent/' . $template_name);

        if (!$template_path) {
            $template_path = GOTALENT_PLUGIN_PATH . 'templates/' . $template_name;
        }

        ob_start();

        if ($template_path && file_exists($template_path)) {
            include($template_path);
        }

        return ob_get_clean();
    }

    public static function gt_get_template_part($template_name, $variables = array())
    {
        self::gt_load_template($template_name, $variables);
    }

    public static function gt_is_url($string)
    {
        return filter_var($string, FILTER_VALIDATE_URL) !== false;
    }

    public static function gt_get_youtube_video_id($string)
    {
        if(!self::gt_is_url($string)) return $string;
        $urlParts = parse_url($string);
        parse_str($urlParts['query'], $queryVars);
        $videoId = isset($queryVars['v']) ? $queryVars['v'] : null;
        return $videoId;
    }

    public static function gt_verify_nonce($string,$action)
    {
        $verify_nonce = wp_verify_nonce($string,$action);
        return $verify_nonce;
    }
}

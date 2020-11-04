<?php
/*
Plugin Name: Meta Shortcode
Plugin URI: http://www.nutt.net/tag/meta-shortcode/
Description: Add a metafield shortcode to easily insert meta values into a post or page.
Version: 0.1
Author: Ryan Nutt
Author URI: http://www.nutt.net
License: GPL2
*/

class MetaShortcode {
    public function handler($atts) {
        global $post; 
        $atts = array_merge(
                array(
                    'field' => '',
                    'sorted' => false,
                    'before' => '',
                    'after' => '',
                    'empty' => '' 
                ),
                $atts);
        
        $meta = get_post_meta($post->ID, $atts['field']);
        
        if (empty($meta[0])) {
            return $atts['empty'];
        }
        else if (count($meta) == 1) {
            return $atts['before'] . $meta[0] . $atts['after'];
        }
        else if (count($meta) > 1) {
            if ($atts['before'] == '' && $atts['after'] == '') {
                $atts['before'] = '<ul>';
                $atts['after'] = '</ul>';
            }
            if ($atts['sorted'] == true) {
                sort($meta);
            }
            $out = $atts['before'];
            foreach ($meta as $val) {
                $out .= '<li>'.$val.'</li>'; 
            }
            $out .= $atts['after'];
            return $out;
        }
        
        
    }
}

add_shortcode('metafield', array('MetaShortcode', 'handler'));

?>
<?php
if (!defined('SANTOS_FRAMEWORK')) exit('No direct access allowed');

/**
 * Post Like System (used in Shop Products)
 * 
 */


class santos_Love_Post
{
    


    function __construct() {

        add_action('wp_ajax_santos_love_post', array(&$this,
            'action_triger'
        ));
        add_action('wp_ajax_nopriv_santos_love_post', array(&$this,
            'action_triger'
        ));

    }


    
    function action_triger($post_id) {
        
        if (isset($_POST['post_id'])) {
            $post_id = str_replace('santos-love-', '', $_POST['post_id']);
            echo self::love_post($post_id, 'update');
        } 
        else {
            $post_id = str_replace('santos-love-', '', $_POST['post_id']);
            echo self::love_post($post_id, 'get');
        }
        
        exit;
    }



    

    static function love_post($post_id, $action = 'get') {
        
        if (!is_numeric($post_id)) return;
        
        switch ($action) {
            case 'get':
                $love_count = get_post_meta($post_id, 'santos_post_love', true);
                if (!$love_count) {
                    $love_count = 0;
                    add_post_meta($post_id, 'santos_post_love', $love_count, true);
                }
                
                return '<span class="santos-love-count">' . $love_count . '</span>';
                break;

            case 'update':
                $love_count = get_post_meta($post_id, 'santos_post_love', true);
                if (isset($_COOKIE['santos_post_love_' . $post_id])) return $love_count;
                
                $love_count++;
                update_post_meta($post_id, 'santos_post_love', $love_count);
                setcookie('santos_post_love_' . $post_id, $post_id, time() * 20, '/');
                
                return '<span class="santos-love-count">' . $love_count . '</span>';
                break;
            }
    }
    

    static function check_love($icon = 'ion-heart') {
        global $post;
        
        $love_count = self::love_post($post->ID);
        
		 return '<div id="newsBox-love-' . $post->ID . '" class="newsBox-love-this"><i class="font-icon '.$icon.'"></i> <span class="newsBox-love-count">' . $love_count . ' </span> </div>';
        
      

    }
	

    static function send_love($icon = 'ion-heart') {
        global $post;
        
        $love_count = self::love_post($post->ID);
        
        $class = '';

        if (isset($_COOKIE['santos_post_love_' . $post->ID])) {
            $class = 'item-loved';
        }
        
        return '<a href="#" class="santos-love-this ' . $class . '" id="santos-love-' . $post->ID . '"><i class="font-icon '.$icon.'"></i> ' . $love_count . '</a>';

    }
}
new santos_Love_Post();

?>
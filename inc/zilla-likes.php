<?php
/*
ZillaLikes by ThemeZilla (http://www.themezilla.com/plugins/zillalikes
*/

class ZillaLikes {

    function __construct() 
    {	
        add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
        add_filter('the_content', array(&$this, 'the_content'));
        add_filter('the_excerpt', array(&$this, 'the_content'));
        add_filter('body_class', array(&$this, 'body_class'));
        add_action('publish_post', array(&$this, 'setup_likes'));
        add_action('wp_ajax_zilla-likes', array(&$this, 'ajax_callback'));
		add_action('wp_ajax_nopriv_zilla-likes', array(&$this, 'ajax_callback'));
        add_shortcode('zilla_likes', array(&$this, 'shortcode'));
	}
		
	function enqueue_scripts()
	{
	    $options = get_option( 'zilla_likes_settings' );
		
		
		wp_localize_script('theme', 'zilla', array(
        	'ajaxurl' => admin_url('admin-ajax.php'),
        ));
        
		
		wp_localize_script( 'theme', 'zilla_likes', array('ajaxurl' => admin_url('admin-ajax.php')) );
	}
	
	function the_content( $content )
	{		
	    
		global $wp_current_filter;
		if ( in_array( 'get_the_excerpt', (array) $wp_current_filter ) ) {
			return $content;
		}
		
		$options = get_option( 'zilla_likes_settings' );
		if( !isset($options['add_to_posts']) ) $options['add_to_posts'] = '0';
		if( !isset($options['add_to_pages']) ) $options['add_to_pages'] = '0';
		if( !isset($options['add_to_other']) ) $options['add_to_other'] = '0';
		if( !isset($options['exclude_from']) ) $options['exclude_from'] = '';
		
		$ids = explode(',', $options['exclude_from']);
		if(in_array(get_the_ID(), $ids)) return $content;
		
		if(is_singular('post') && $options['add_to_posts']) $content .= $this->do_likes();
		if(is_page() && !is_front_page() && $options['add_to_pages']) $content .= $this->do_likes();
		if((is_front_page() || is_home() || is_category() || is_tag() || is_author() || is_date() || is_search()) && $options['add_to_other'] ) $content .= $this->do_likes();
		
		return $content;
	}
	
	function setup_likes( $post_id ) 
	{
		if(!is_numeric($post_id)) return;
	
		add_post_meta($post_id, '_zilla_likes', '0', true);
	}
	
	function ajax_callback($post_id) 
	{

		$options = get_option( 'zilla_likes_settings' );
		if( !isset($options['add_to_posts']) ) $options['add_to_posts'] = '0';
		if( !isset($options['add_to_pages']) ) $options['add_to_pages'] = '0';
		if( !isset($options['add_to_other']) ) $options['add_to_other'] = '0';
		if( !isset($options['zero_postfix']) ) $options['zero_postfix'] = '';
		if( !isset($options['one_postfix']) ) $options['one_postfix'] = '';
		if( !isset($options['more_postfix']) ) $options['more_postfix'] = '';

		if( isset($_POST['likes_id']) ) {
		    // Click event. Get and Update Count
			$post_id = str_replace('zilla-likes-', '', $_POST['likes_id']);
			echo $this->like_this($post_id, $options['zero_postfix'], $options['one_postfix'], $options['more_postfix'], 'update');
		} else {
		    // AJAXing data in. Get Count
			$post_id = str_replace('zilla-likes-', '', $_POST['post_id']);
			echo $this->like_this($post_id, $options['zero_postfix'], $options['one_postfix'], $options['more_postfix'], 'get');
		}
		
		exit;
	}
	
	function like_this($post_id, $zero_postfix = false, $one_postfix = false, $more_postfix = false, $action = 'get') 
	{
		if(!is_numeric($post_id)) return;
		$zero_postfix = strip_tags($zero_postfix);
		$one_postfix = strip_tags($one_postfix);
		$more_postfix = strip_tags($more_postfix);		
		
		switch($action) {
		
			case 'get':
				$likes = get_post_meta($post_id, '_zilla_likes', true);
				if( !$likes ){
					$likes = 0;
					add_post_meta($post_id, '_zilla_likes', $likes, true);
				}
				
				if( $likes == 0 ) { $postfix = $zero_postfix; }
				elseif( $likes == 1 ) { $postfix = $one_postfix; }
				else { $postfix = $more_postfix; }
				
				return '<span class="zilla-likes-count">'. $likes .'</span> <span class="zilla-likes-postfix">'. $postfix .'</span>';
				break;
				
			case 'update':
				$likes = get_post_meta($post_id, '_zilla_likes', true);
				if( isset($_COOKIE['zilla_likes_'. $post_id]) ) return $likes;
				
				$likes++;
				update_post_meta($post_id, '_zilla_likes', $likes);
				setcookie('zilla_likes_'. $post_id, $post_id, time()*20, '/');
				
				if( $likes == 0 ) { $postfix = $zero_postfix; }
				elseif( $likes == 1 ) { $postfix = $one_postfix; }
				else { $postfix = $more_postfix; }
				
				return '<span class="zilla-likes-count">'. $likes .'</span> <span class="zilla-likes-postfix">'. $postfix .'</span>';
				break;
		
		}
	}
	
	function shortcode( $atts )
	{
		extract( shortcode_atts( array(
		), $atts ) );
		
		return $this->do_likes();
	}
	
	function do_likes()
	{
		global $post;

        $options = get_option( 'zilla_likes_settings' );
		if( !isset($options['zero_postfix']) ) $options['zero_postfix'] = '';
		if( !isset($options['one_postfix']) ) $options['one_postfix'] = '';
		if( !isset($options['more_postfix']) ) $options['more_postfix'] = '';
		
		$output = $this->like_this($post->ID, $options['zero_postfix'], $options['one_postfix'], $options['more_postfix']);
  
  		$class = 'zilla-likes';
  		$title = __('Like this', 'zilla');
		if( isset($_COOKIE['zilla_likes_'. $post->ID]) ){
			$class = 'zilla-likes active';
			$title = __('You already like this', 'zilla');
		}
		
		return '<a href="#" class="'. $class .'" id="zilla-likes-'. $post->ID .'" title="'. $title .'">'. $output .'</a>';
	}
	
    function body_class($classes) {
        $options = get_option( 'zilla_likes_settings' );
        
        if( !isset($options['ajax_likes']) ) $options['ajax_likes'] = false;
        
        if( $options['ajax_likes'] ) {
        	$classes[] = 'ajax-zilla-likes';
    	}
    	return $classes;
    }
	
}
global $zilla_likes;
$zilla_likes = new ZillaLikes();

/**
 * Template Tag
 */
function zilla_likes()
{
	global $zilla_likes;
    echo $zilla_likes->do_likes(); 
	
}
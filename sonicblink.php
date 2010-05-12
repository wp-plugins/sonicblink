<?php
/*
Plugin Name: SonicBlink
Plugin Version: 0.1
Plugin URI: http://www.sonicblink.com/
Author URI: http://www.sonicblink.com
Plugin Description: SonicBlink lets users rate and tag your content.
Plugin Author: Todd Williams
Plugin License: GPL
*/ 

// activate plugin
function sonicblink_activate() {
	$options = array(
				'index' => 'yes',
				'page' => 'yes',
				'post' => 'yes',
				'on_the_web' => 'yes'
			);
	update_option('sonicblink', $options);
}

register_activation_hook( __FILE__, 'sonicblink_activate');

			
if (!class_exists("SonicBlink")) {
	class SonicBlink 
	{
  		function SonicBlink()
		{
			add_action('admin_init', array(&$this, 'options'));
			
			$this->path = plugins_url('/sonicblink/');
			$this->options = get_option('sonicblink');
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery.sonicblink', 'http://api.sonicblink.com/static/scripts/jquery.sonicblink-1.0.min.js', false, '0.1');
			wp_enqueue_script('wp_sonicblink', $this->path . 'js/wp_sonicblink.js', false, '0.1');
			
			// display sonic blink!
			add_action('the_posts', array(&$this, 'initialize'));
			
			// admin stuff
			add_action('admin_menu', array(&$this, 'menu'));
			add_action('admin_head', array(&$this, 'admin_css'));
			add_action('admin_head', array(&$this, 'admin_js'));
		}
		
		function initialize($posts) {
			if(is_front_page() && $this->options['index'] == 'yes')
			{
				$this->display();
			}
			
			if(is_page() && $this->options['page'] == 'yes')
			{
				$this->display();
			}
			
			if(is_single() && $this->options['post'] == 'yes')
			{
				$this->display();
			}
			
			return $posts;
		}
		
		function display()
		{
			add_filter('the_content', array(&$this, 'show_sonicblink'));
		}
		
		function options()
		{
			register_setting('sonicblink-options', 'sonicblink');
		}
		
		function show_sonicblink($content)
		{
			// get tags into a string
			$tag_string = '';
			$tags = get_the_tags();
			if($tags)
			{
				foreach($tags as $tag)
				{
					$tag_string .= $tag->name . ',';
				}
			}
			
			// check for popup settings
			$on_the_web_settings = '';
			if ($this->options['on_the_web'] == "no")
			{
				$on_the_web_settings = '<input type="hidden" class="sb_show_on_the_web" value="no" />';
			}
			
			// add display code
			return $content . '<div class="sonicblink"><input type="hidden" class="sb_url" value="' . get_permalink($id) . '" /><input type="hidden" class="sb_pre_tags" value="' . $tag_string . '" />' . $on_the_web_settings . '</div>';
		}

		function menu() {
		  add_options_page('SonicBlink Options', 'SonicBlink', 'update_plugins', 'sonicblink_menu', array(&$this, 'sonicblink_options'));
		}
		
		function sonicblink_options() {
		  include( dirname(__FILE__) . '/options.php');
		}
		
		function admin_css() {
			echo '<link rel="stylesheet" href="' . $this->path . 'css/admin.css" type="text/css" />';
		}
		
		function admin_js() {
			echo '<script type="text/javascript" src="http://api.sonicblink.com/static/scripts/jquery.sonicblink-1.0.min.js"></script>';
			echo '<script type="text/javascript" src="' . $this->path . 'js/wp_sonicblink_admin.js"></script>';
		}

	}
}

if (class_exists("SonicBlink")) {
  //$jQueryLightbox = new jQueryLightbox();
  add_action('plugins_loaded', create_function('', 'global $SonicBlink; $SonicBlink = new SonicBlink();'));
}
?>
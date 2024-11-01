<?php
/*
Plugin Name: Thumbnail Slider Plugin
Plugin URI: http://www.snilesh.com/?p=902
Description: Wordpress plugin for simple slideshow.
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=YKY7SHDT8GTQG
Version: 1.1
Author: Snilesh
Tags: images, gallery, slideshow, photos, post, jquery slideshow,swirl gallery,random gallery,banner,rotating banners,thumb ads,thumbnail slider
Author URI: http://www.snilesh.com
*/

/*  Copyright 2010  Snilesh.com  (email : snilesh.com@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
global $wp_version;	
$exit_msg='Wordpress Thumbnail Slider Plugin requires WordPress 2.9 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';
$WPNS_thumb_slider_plugin_url=defined('WP_PLUGIN_URL') ? (WP_PLUGIN_URL . '/' . dirname(plugin_basename(__FILE__))) : trailingslashit(get_bloginfo('wpurl')) . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)); 

if (version_compare($wp_version,"2.9","<"))
{
	exit ($exit_msg);
}
if (!defined('WP_CONTENT_URL')) {
	define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
}

define('WPNS_THUMBNAIL_SLIDER',get_option('siteurl').'/wp-content/plugins/wpns_thumbnail_slider/');
global $wpns_slider_defaults;
global $wpns_settings_var;
$wpns_settings_var=get_option('wpns_slider_options');

$wpns_slider_defaults=array(
'width'=>193, // width of slider panel
'height'=>78, // height of slider panel
'space_img'=>10,
'rotate_items'=>4,
'visible_images'=>4,
'circular'=>'true',
'margin'=>7,
'icons'=>'default',
'delay'=>3000, // delay between images in ms
'speed'=>800, // delay between images in ms
'navigation'=>'true', // prev next and buttons
'slide_image1'=>WP_CONTENT_URL.'/plugins/wpns_thumbnail_slider/images/img1.jpg',
'slide_image2'=>WP_CONTENT_URL.'/plugins/wpns_thumbnail_slider/images/img2.jpg',
'slide_image3'=>WP_CONTENT_URL.'/plugins/wpns_thumbnail_slider/images/img3.jpg',
'slide_image4'=>WP_CONTENT_URL.'/plugins/wpns_thumbnail_slider/images/img4.jpg',
'slide_image5'=>WP_CONTENT_URL.'/plugins/wpns_thumbnail_slider/images/img5.jpg',
'slide_imagelink1'=>'http://www.snilesh.com/resources/jquery/jquery-image-slider/',
'slide_imagelink2'=>'http://www.snilesh.com/resources/wordpress/wordpress-tips-and-tricks/wordpress-show-title-and-excerpt-of-child-pages-on-parent-page/',
'slide_imagelink3'=>'http://www.snilesh.com/resources/wordpress/wordpress-plugins/wordpress-news-ticker-plugin/',
'slide_imagelink4'=>'http://www.snilesh.com/resources/jquery/jquery-image-sliders-2010/',
'slide_imagelink5'=>'http://www.snilesh.com/resources/jquery/jquery-dynamic-selectbox/',
'number_of_posts'=>4,
'custom_image'=>'true',
'post_category'=>'',
'no_of_custom_images'=>5,
'order'=>'false',
'new_window'=>'false'
);
register_deactivation_hook(__FILE__, 'wpns_slider_deactivate' );
register_activation_hook(__FILE__, 'wpns_slider_activate'); 
function wpns_slider_deactivate()
{
	delete_option('wpns_slider_options');
}
function wpns_slider_activate()
{
	global $wpns_slider_defaults,$values;
	$default_settings = get_option('wpns_slider_options');
	$default_settings= wp_parse_args($default_settings, $wpns_slider_defaults);
	add_option('wpns_slider_options',$default_settings);
}
/* Add Administrator Menu's*/
function wpns_slider_admin_menu()
{
	$level = 'level_10';
   add_menu_page('Thumbnail Slider', 'Thumbnail Slider', $level, __FILE__,'wpns_slider_options_page',WPNS_THUMBNAIL_SLIDER.'images/icon6.png');
   add_submenu_page(__FILE__, 'Help &amp; Support', 'Help &amp; Support', $level,'wpns_slider_help_page','wpns_slider_help_page');
}
add_action('admin_menu', 'wpns_slider_admin_menu');	

function wpns_slider_options_page()
{
	wpns_slider_settings_update();
	include_once dirname(__FILE__).'/options_page.php';
}
function wpns_slider_settings_update()
{
	if(isset($_POST['wpns_slider_options']))
	{
		echo '<div class="updated fade" id="message"><p>Wordpress Thumbnail Slider Settings <strong>Updated</strong></p></div>';
		unset($_POST['update']);
		update_option('wpns_slider_options', $_POST['wpns_slider_options']);
	}
}
function wpns_slider_help_page()
{
include_once dirname(__FILE__).'/help_support.php';
}

if ( function_exists('add_theme_support') ) {
	global $wpns_settings_var;
	add_theme_support('post-thumbnails');
	add_image_size( 'wp-thumbnail-slider', $wpns_settings_var['width'], $wpns_settings_var['height'] ,false); 
}

// ADD Content Slide JS TO HEAD SECTION
add_action('wp_print_scripts', 'wpns_thumb_slider_user_scripts');
function wpns_thumb_slider_user_scripts() {
	global $wpns_settings_var;
    wp_enqueue_script ('jquery');
	wp_enqueue_script('jquery_carousel', WPNS_THUMBNAIL_SLIDER.'js/jquery_carousel.js', $deps = array('jquery'));
	echo '<link rel="stylesheet" type="text/css" href="'.WPNS_THUMBNAIL_SLIDER.'css/style.css" />';
}

add_action('wp_head', 'wpns_tumbnail_header_scripts');
function wpns_tumbnail_header_scripts() { 
global $wpns_settings_var; ?>
<script type="text/javascript">
	var $jquery = jQuery.noConflict(); 
	$jquery(document).ready(function() 
	{
					$jquery(".wpns_thumb_slider").jCarouselLite({
						btnNext: ".wpns_next_thumb",
						btnPrev: ".wpns_prev_thumb",
						visible: <?php echo $wpns_settings_var['visible_images'];?>,
						start: 1,
						scroll:<?php echo $wpns_settings_var['rotate_items'];?>,
						vertical: false,
						circular: <?php echo $wpns_settings_var['circular'];?>,
						auto: <?php echo $wpns_settings_var['delay'];?>,
						speed: <?php echo $wpns_settings_var['speed'];?>
					});
				
	});
	</script>
<style type="text/css" media="screen">
.wpns_thumb_slider ul li
{ float:left; width:<?php echo $wpns_settings_var['width'];?>; height:<?php echo $wpns_settings_var['height'];?>; padding:0px; margin:0px <?php echo trim($wpns_settings_var['margin'])/2;?>px 0px <?php echo trim($wpns_settings_var['margin'])/2;?>px;}
.wpns_thumb_slider ul li .item a img
{
float:left; overflow:hidden; width:<?php echo $wpns_settings_var['width'];?>;height:<?php echo $wpns_settings_var['height'];?>; }
.wpns_prev_thumb,.wpns_next_thumb
{	height:<?php echo $wpns_settings_var['height'];?>; }
.wpns_prev_thumb
{background:url('<?php echo WPNS_THUMBNAIL_SLIDER;?>css/icons/<?php echo $wpns_settings_var['icons'];?>_left.png') no-repeat center;}
.wpns_next_thumb
{   background:url('<?php echo WPNS_THUMBNAIL_SLIDER;?>css/icons/<?php echo $wpns_settings_var['icons'];?>_right.png') no-repeat center;}
</style>
<!-- End Content Slider Settings -->

<?php }
function wpns_thumbnail_slider()
{
	global $wpns_settings_var;
	$wpns_settings_var=get_option('wpns_slider_options');
    echo '<div class="wpns_thumb_slider_box">';
	if($wpns_settings_var['navigation']=='true')
	{
	echo '<a href="#" title="" class="wpns_prev_thumb"></a>';
	}
	echo '<div class="wpns_thumb_slider"><ul>';
	 if($wpns_settings_var['custom_image']=='false')
	{
	  if($wpns_settings_var['order']=='true')
	  {
		  $tmp='orderby=rand&';
	  }
	  else
	  {
		  $tmp='';
	  }
	  $recent_posts = new WP_Query($tmp."cat=".$wpns_settings_var['post_category'].'&showposts='.$wpns_settings_var['number_of_posts']); 
	  $count=0;
	  while($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
	   <?php
		if(has_post_thumbnail()) {
		  		$new_window='';
				if($wpns_settings_var['new_window']=='true')
				{
					$new_window=' target="_blank"';
				}
	   ?>
	  <li><div class="item"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php echo $new_window;?>><?php the_post_thumbnail ( array($wpns_settings_var['height'], $wpns_settings_var['width']) ); ?>
      </a></li>
	  <?php
	  }
	   else
		{
		   continue;
		}
		
	  ?>
	<?php endwhile;	
	wp_reset_query();
	}
	else
	{
	$custom_images=array();
	$temp_array=array();
	for($j=1;$j<=$wpns_settings_var['no_of_custom_images'];$j++)
	{
		$temp_array=array('image_src'=>$wpns_settings_var['slide_image'.$j],'image_link'=>$wpns_settings_var['slide_imagelink'.$j]);
		array_push($custom_images,$temp_array);
	}

	if($wpns_settings_var['order']=='true')
	{
		shuffle($custom_images);
	}
	

		foreach($custom_images as $images)
		{
			echo '<li><div class="item">';
			if($images['image_link']!='')
			{
				$new_window='';
				if($wpns_settings_var['new_window']=='true')
				{
					$new_window=' target="_blank"';
				}
		?>
		<a href="<?php echo $images['image_link']; ?>" title="<?php echo $images['heading'];?>" <?php echo $new_window; ?>>
		<?php
			}
		?>
		<img src="<?php echo WPNS_THUMBNAIL_SLIDER.'timthumb.php?src='.$images['image_src'].'&w='.$wpns_settings_var['width'].'&h='.$wpns_settings_var['height'].''; ?>" alt="<?php echo $images['image_src'];?>"  />
        <?php  
		if($images['image_link']!='')
			{
		?>
        </a>
		<?php
			}
		echo '</div></li>';
		}
	}
	
	
echo '</ul></div>';
if($wpns_settings_var['navigation']=='true')
{
echo '<a href="#" title="" class="wpns_next_thumb"></a>';
}
echo '</div>';
}
?>
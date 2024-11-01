<div class="wrap">
	<h2>WP Thumbnail Slider Options</h2>
	<form method="post" action="">
	<?php $options = get_option('wpns_slider_options'); ?>
	<!-- SETTINGS PAGE FIRST COLUMN -->
	<div class="metabox-holder">
		<div class="postbox">
		<h3><?php _e("General Setings", 'wpns_thumbnail_slider'); ?></h3>
			<div class="inside" style="padding:0px 15px 0px 15px;">	
			<p><?php _e("Image width", 'wpns_thumbnail_slider'); ?>:<input type="text" name="wpns_slider_options[width]" value="<?php echo $options['width'] ?>" size="3" />px&nbsp;&nbsp;<?php _e("height", 'wpns_thumbnail_slider'); ?>:<input type="text" name="wpns_slider_options[height]" value="<?php echo $options['height'] ?>" size="3" />px</p>
			<p><?php _e("Space Between Images", 'wpns_thumbnail_slider'); ?>:<input type="text" name="wpns_slider_options[margin]" value="<?php echo $options['margin'] ?>" size="3" />px</p>
			<p><?php _e("Icons Style <small>( Next/Previous Icon Style )</small>", 'wpns_thumbnail_slider'); ?>:<select name="wpns_slider_options[icons]">
			<option value="default" <?php selected('default', $options['icons']); ?>>Default</option>
			<option value="blue" <?php selected('blue', $options['icons']); ?>>Blue</option>
			<option value="blue_glossy" <?php selected('blue_glossy', $options['icons']); ?>>Glossy Blue</option>
			<option value="black_glossy" <?php selected('black_glossy', $options['icons']); ?>>Glossy Black</option>
			<option value="blue_round" <?php selected('blue_round', $options['icons']); ?>>Round Blue</option>
			<option value="green" <?php selected('green', $options['icons']); ?>>Green</option>
			<option value="orange" <?php selected('orange', $options['icons']); ?>>Orange</option>			
			</select></p>
			 <input type="hidden" name="wpns_slider_options[update]" value="UPDATED" />
                <p><input type="submit" class="button-primary" value="<?php _e('Save Settings') ?>" /></p>
			</div>
		</div>
	</div>
	<!-- End First column -->
	<!-- SETTINGS PAGE SECONT COLUMN -->
	<div class="metabox-holder">
		<div class="postbox">
		<h3><?php _e("Effects &amp; Animation Setings", 'wpns_thumbnail_slider'); ?></h3>
			<div class="inside" style="padding:0px 15px 0px 15px;">
			 <p><?php _e("Delay between images in ms", 'wpns_thumbnail_slider'); ?>:<input id="delay" type="text" name="wpns_slider_options[delay]" value="<?php echo $options['delay'] ?>" size="5" />
			 </p>
			 <p><?php _e("Sliding Speed in ms", 'wpns_thumbnail_slider'); ?>:<input id="speed" type="text" name="wpns_slider_options[speed]" value="<?php echo $options['speed'] ?>" size="5" />
			 </p>
			 <p><?php _e("Number of Images Visible", 'wpns_thumbnail_slider'); ?>:<input id="visible_images" type="text" name="wpns_slider_options[visible_images]" value="<?php echo $options['visible_images'] ?>" size="5" /></p>
			 <p><?php _e("Number of items to scroll when you click the next or prev buttons", 'wpns_thumbnail_slider'); ?>:<input id="rotate_items" type="text" name="wpns_slider_options[rotate_items]" value="<?php echo $options['rotate_items'] ?>" size="5" /></p>
			 <p><?php _e("Navigation Previous/Next <small>( Previous/Next buttons on image.)</small>", 'wpns_thumbnail_slider'); ?>:<select name="wpns_slider_options[navigation]"><option value="true" <?php selected('true', $options['navigation']); ?>>Yes</option><option value="false" <?php selected('false', $options['navigation']); ?>>No</option></select></p>
			 <p><?php _e("Circular ", 'wpns_thumbnail_slider'); ?>:<select name="wpns_slider_options[circular]"><option value="true" <?php selected('true', $options['circular']); ?>>Yes</option><option value="false" <?php selected('false', $options['circular']); ?>>No</option></select></p>
			 <p>
			 <input type="hidden" name="wpns_slider_options[update]" value="UPDATED" />
            <p><input type="submit" class="button-primary" value="<?php _e('Save Settings') ?>" /></p>
			</div>
		</div>
    </div>
	<div class="metabox-holder" id="wpsc_custom_images">
		<div class="postbox">
		<script type="text/javascript" language="javascript">
		jQuery(document).ready(function($) {
			var val1=$('#wpns_slider_img_src').attr('value');
			if(val1=="true")
			{
			$('#wpns_post_category_div').hide();
			}
			else
			{
			$('#wpns_custom_img_div').hide();
			}
			$('#wpns_slider_img_src').change(function(){
				var val=$('#wpns_slider_img_src').attr('value');
				if(val=="true")
				{
					$('#wpns_post_category_div').fadeOut(1000);
					$('#wpns_custom_img_div').fadeIn(1000).fadeTo(1000, 1);
				}
				else
				{
					$('#wpns_custom_img_div').fadeOut(1000);
					$('#wpns_post_category_div').fadeIn(1000).fadeTo(1000, 1);
					
				}
			});
		});
			
		</script>
		<h3><?php _e("Images Source Settings", 'wpns_thumbnail_slider'); ?></h3>
			<div class="inside" style="padding:0px 15px 0px 15px;">
			<p><?php _e("Open Images/Links In New Window", 'wpns_thumbnail_slider'); ?>?&nbsp;<select name="wpns_slider_options[new_window]"><option value="true" <?php selected('true', $options['new_window']); ?>>Yes</option><option value="false" <?php selected('false', $options['new_window']); ?>>No</option></select></p>
			<p><?php _e("Order Images Randomally", 'wpns_thumbnail_slider'); ?>?&nbsp;<select name="wpns_slider_options[order]"><option value="true" <?php selected('true', $options['order']); ?>>Yes</option><option value="false" <?php selected('false', $options['order']); ?>>No</option></select>
			</p>
			<p><?php _e("Use custom images", 'wpns_thumbnail_slider'); ?>?&nbsp;<select name="wpns_slider_options[custom_image]" id="wpns_slider_img_src"><option value="true" <?php selected('true', $options['custom_image']); ?>>Yes, Custom Images.</option><option value="false" <?php selected('false', $options['custom_image']); ?>>No, Using Posts from a Category</option></select> <small>If you select custom you dont have to create posts.</small></p>
			<div id="wpns_post_category_div">
			<p><?php _e("Select a Category:", 'wpns_thumbnail_slider'); ?><br /><?php wp_dropdown_categories(array('selected' => $options['post_category'], 'name' => 'wpns_slider_options[post_category]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_all' => __("All Categories", 'wpns_thumbnail_slider'), 'hide_empty' => '0' )); ?></p>
            <p><?php _e("No. of posts/images", 'wpns_thumbnail_slider'); ?>:<input type="text" name="wpns_slider_options[number_of_posts]" value="<?php echo $options['number_of_posts'] ?>" size="3" /></p>
            </div>
			<div id="wpns_custom_img_div">
				<p><?php _e("Number of custom Images", 'wpns_thumbnail_slider'); ?></td><td>
				<input type="text" name="wpns_slider_options[no_of_custom_images]" value="<?php echo $options['no_of_custom_images'] ?>" size="5" /></p>
				<p><input type="submit" class="button-primary" value="<?php _e('Save Settings') ?>" /></p>
				<?php 
				for($i=1;$i<=$options['no_of_custom_images'];$i++)
				{
				?>
				<h4>Custom Image <?php echo $i;?></h4>
				<table cellspacing="0" cellpadding="0" border="0">
				<tr><td width="150">
				<?php _e("Image ".$i." SRC", 'wpns_thumbnail_slider'); ?></td><td>
				<input type="text" name="wpns_slider_options[slide_image<?php echo $i;?>]" value="<?php echo $options['slide_image'.$i] ?>" size="90" /></td></tr>
				<tr><td width="150"><?php _e("Image ".$i." Link", 'wpns_thumbnail_slider'); ?></td><td>
				<input type="text" name="wpns_slider_options[slide_imagelink<?php echo $i;?>]" value="<?php echo $options['slide_imagelink'.$i] ?>" size="90" /></td></tr><tr>
				</table>
				<?php
				}
				?>
			</div>
                <input type="hidden" name="wpns_slider_options[update]" value="UPDATED" />
                <p><input type="submit" class="button-primary" value="<?php _e('Save Settings') ?>" /></p>
			</div>
		</div>
	</div>
	</form>
</div>
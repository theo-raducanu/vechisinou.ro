<div class="item<?php if ($i%4 == 0) echo(' last'); ?>">
	<div class="item-image">
		<?php 
		$width = 207;
		$height = 136;
		$titletext = get_the_title();

		$thumbnail = get_thumbnail($width,$height,'portfolio',$titletext,$titletext,true,'Portfolio');
		$thumb = $thumbnail["thumb"];
		print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, 'portfolio'); ?>
		<span class="overlay"></span>
		
		<a class="fancybox zoom-icon" rel="gallery" href="<?php echo($thumbnail['fullpath']); ?>"><?php _e('Zoom in','DeepFocus'); ?></a>
		<a class="more-icon" href="<?php the_permalink(); ?>"><?php _e('Read more','DeepFocus'); ?></a>
	</div> <!-- end .item-image -->
</div> <!-- end .item -->
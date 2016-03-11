<?php $thumb = '';
	$width = 185;
	$height = 185;
	$classtext = '';
	$titletext = get_the_title();
	
	$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
	$thumb = $thumbnail["thumb"]; ?>

<div class="entry clearfix">
	<?php if ($thumb <> '' && get_option('deepfocus_thumbnails_index') == 'on') { ?>
		<div class="blog-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
				<span class="overlay"></span>
			</a>
		</div> <!-- end .blog-thumb -->
	<?php } ?>
	<div class="entry-description<?php if ($thumb == '' || get_option('deepfocus_thumbnails_index') == 'false') echo(' full-description'); ?>">
		<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php include(TEMPLATEPATH . '/includes/postinfo.php'); ?>
		<?php if (get_option('deepfocus_blog_style') == 'on') { ?>
			<?php the_content(); ?>
		<?php } else { ?>
			<p><?php truncate_post(375); ?></p>
		<?php } ?>
		<a class="readmore" href="<?php the_permalink(); ?>"><span><?php _e('Learn More','DeepFocus'); ?></span></a>
	</div> <!-- end .entry-description -->
</div> <!-- end .entry -->
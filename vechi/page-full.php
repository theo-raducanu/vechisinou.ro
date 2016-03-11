<?php 
/*
Template Name: Full Width Page
*/
?>
<?php get_header();
the_post(); ?>
	
<div id="content-full">
	<div id="hr">
		<div id="hr-center">
			<div id="intro">
				<div class="center-highlight">
				
					<div class="container">
						
						<?php include(TEMPLATEPATH . '/includes/breadcrumbs.php'); ?>
						
					</div> <!-- end .container -->	
				</div> <!-- end .center-highlight -->
			</div>	<!-- end #intro -->	
		</div> <!-- end #hr-center -->
	</div> <!-- end #hr -->
			
	<div class="center-highlight">
		<div class="container">
	
			<div id="full" class="clearfix">
				
				
					<?php if (get_option('deepfocus_integration_single_top') <> '' && get_option('deepfocus_integrate_singletop_enable') == 'on') echo(get_option('deepfocus_integration_single_top')); ?>
					
					<div class="entry clearfix post full">
						<?php $width = 185;
							  $height = 185;
							  $classtext = '';
							  $titletext = get_the_title();
						
							  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
							  $thumb = $thumbnail["thumb"]; ?>
					
						<?php if (get_option('deepfocus_blog_thumbnails') == 'on' && $isBlogPage) { ?>
							
							<?php if($thumb <> '') { ?>
								<div class="blog-thumb">
									<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
									<span class="overlay"></span>
								</div> <!-- end .blog-thumb -->
							<?php } ?>
						<?php } ?>
						
						<h1 class="title"><?php the_title(); ?></h1>
						<?php include(TEMPLATEPATH . '/includes/postinfo.php'); ?>
						
						<?php if($thumb == '') echo('<div class="clear"></div>'); ?>
						
						<?php if($thumb <> '' && get_option('deepfocus_page_thumbnails') == 'on') { ?>
							<div class="post-thumbnail">							
								<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, $classtext); ?>
								<span class="overlay"></span>
							</div> 	<!-- end .thumbnail -->	
						<?php }; ?>

						<?php the_content(); ?>
						<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages','DeepFocus').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
						<?php edit_post_link(__('Edit this page','DeepFocus')); ?>
					</div> <!-- end .entry -->
					
					<?php if (get_option('deepfocus_integration_single_bottom') <> '' && get_option('deepfocus_integrate_singlebottom_enable') == 'on') echo(get_option('deepfocus_integration_single_bottom')); ?>
					
					<?php if (get_option('deepfocus_show_pagescomments') == 'on') comments_template('', true); ?>
									
			</div> <!-- end #content-area -->

		</div> <!-- end .container -->
					
		<?php get_footer(); ?>
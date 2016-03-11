<?php get_header(); ?>

<?php if (is_archive()) $post_number = get_option('deepfocus_archivenum_posts');
if (is_search()) $post_number = get_option('deepfocus_searchnum_posts');
if (is_tag()) $post_number = get_option('deepfocus_tagnum_posts');
if (is_category()) $post_number = get_option('deepfocus_catnum_posts'); ?>
	
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
				
				<?php $i = 1; ?>
				<?php global $query_string; 
				if (is_category()) query_posts($query_string . "&showposts=$post_number&paged=$paged&cat=$cat");
				else query_posts($query_string . "&showposts=$post_number&paged=$paged"); ?>
			
				<?php $blogcat = get_cat_ID(get_option('deepfocus_blog_cat')); ?>
				
				<?php if ( (is_category() && in_subcat($blogcat,$cat)) || get_option('deepfocus_blog_style') == 'on' ) { ?>
				
					<div id="content-area" class="clearfix">
				
						<div id="left-area">
							
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>					
								<?php include(TEMPLATEPATH . '/includes/entry.php'); ?>
								<?php $i++; ?>
							<?php endwhile; ?>
								<div class="clear"></div>
								<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
								else { ?>
									 <?php include(TEMPLATEPATH . '/includes/navigation.php'); ?>
								<?php } ?>
								
							<?php else : ?>
								<?php include(TEMPLATEPATH . '/includes/no-results.php'); ?>
							<?php endif; wp_reset_query(); ?>
							
						</div> <!-- end #left-area -->
						
						<?php get_sidebar(); ?>

					</div> <!-- end #content-area -->
					
				<?php } else { ?>
					<div id="gallery">					
						<div id="portfolio-items" class="clearfix">
						
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>					
								<?php include(TEMPLATEPATH . '/includes/gallery.php'); ?>
								<?php $i++; ?>
							<?php endwhile; ?>
								<div class="clear"></div>
								<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
								else { ?>
									 <?php include(TEMPLATEPATH . '/includes/navigation.php'); ?>
								<?php } ?>
								
							<?php else : ?>
								<?php include(TEMPLATEPATH . '/includes/no-results.php'); ?>
							<?php endif; wp_reset_query(); ?>
						</div> <!-- end #portfolio-items -->	
					</div> <!-- end #gallery -->	
				<?php } ?>
				
				
			</div> <!-- end .container -->
					
			<?php get_footer(); ?>
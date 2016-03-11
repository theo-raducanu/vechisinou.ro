<?php get_header(); ?>
	
	<div id="content-full">
		<div id="home-top"></div>
		<div id="hr">
			<div id="hr-center">
				<div id="intro">
					<div class="center-highlight">
					
						<div class="container">
	
							<?php if (get_option('deepfocus_featured') == 'on') include(TEMPLATEPATH . '/includes/featured.php'); ?>
							
							<?php if (get_option('deepfocus_quote') == 'on') { ?>
								<div id="tagline">
									<p><?php echo(get_option('deepfocus_quote_one')); ?></p>
									<span class="quote2"><?php echo(get_option('deepfocus_quote_two')); ?></span>
								</div>	<!-- end #tagline-->
							<?php } ?>
							
						</div> <!-- end .container -->	
					</div> <!-- end .center-highlight -->
				</div>	<!-- end #intro -->	
			</div> <!-- end #hr-center -->
		</div> <!-- end #hr -->
				
		<div class="center-highlight">
			<div class="container">
				
				<?php if (get_option('deepfocus_blog_style') == 'false') { ?>
					<?php for ($i=1; $i <= 2; $i++) { ?>
						<?php query_posts('page_id=' . get_pageId(html_entity_decode(get_option('deepfocus_home_page_'.$i)))); while (have_posts()) : the_post(); ?>
							<div class="service">
								<h3 class="hometitle"><?php the_title(); ?></h3>
								<?php global $more;
								$more = 0;	
								the_content(''); ?>
								<a href="<?php the_permalink(); ?>" class="readmore"><span><?php _e('Mai mult','DeepFocus'); ?></span></a>
							</div> <!-- end .service -->
						<?php endwhile; wp_reset_query(); ?>
					<?php } ?>
				
					
					<div class="service" id="blog">
						<div id="blog-top"></div>
						<div id="blog-wrapper">
							<div id="blog-content">
								<h4 class="widgettitle"><?php _e('Ultimele Adaugate','DeepFocus'); ?></h4>
								<div class="recentscroll">
									<ul>
										<?php query_posts("showposts=".get_option('deepfocus_fromblog_number')."&cat=".get_cat_ID(get_option('deepfocus_blog_cat')));
										if (have_posts()) : while (have_posts()) : the_post(); ?>
											<li class="clearfix">
												<a href="<?php the_permalink(); ?>" class="title"><span><?php truncate_title(30); ?></span></a>
												<span class="postinfo"><?php _e('Posted','DeepFocus'); ?> <?php _e('by','DeepFocus'); ?> <?php the_author_posts_link(); ?> <?php _e('on','DeepFocus'); ?> <?php the_time(get_option('deepfocus_date_format')) ?></span>
											</li>
										<?php endwhile; endif; wp_reset_query(); ?>
									</ul> <!-- end ul.nav -->
								</div> <!-- end .recentscroll -->
							</div> <!-- end #blog-center -->
						</div> <!-- end #blog-wrapper -->	
						
						<div id="controllers2">
							<a href="#" id="left-arrow"><?php _e('Previous','DeepFocus'); ?></a>
							<a href="#" id="right-arrow"><?php _e('Next','DeepFocus'); ?></a>
						</div>	<!-- end #controllers2 -->
					</div> <!-- end .service -->
					
					<div class="clear"></div>
					
					<h3 class="hometitle recentworks"><?php _e('Recent Works','DeepFocus'); ?></h3>
					
					<div id="portfolio-items" class="clearfix">
						
						<?php $allCats = get_categories();
						
						$blogCats = array();
						$blogcat = get_cat_ID(get_option('deepfocus_blog_cat'));
						
						foreach ($allCats as $category) {
							if (in_subcat($blogcat, $category->cat_ID)) $blogCats[] = $category->cat_ID;
						}
						
						$args = array('category__not_in' => $blogCats,
									  'showposts' => get_option('deepfocus_portfolio_number'));
						
						$i = 1;
						query_posts($args);
						if (have_posts()) : while (have_posts()) : the_post(); ?>
							<?php include(TEMPLATEPATH . '/includes/gallery.php'); ?>
						<?php $i++; endwhile; endif; wp_reset_query(); ?>
						
						<div class="clear"></div>
						
						<a href="<?php echo(get_category_link(get_cat_ID(get_option('deepfocus_portfolio_cat')))); ?>" class="readmore entergallery"><span><?php _e('Enter The Gallery','DeepFocus'); ?></span></a>
					</div> <!-- end #portfolio-items -->	
				
				<?php } else { ?>
					<div id="content-area" class="clearfix">
				
						<div id="left-area">
							<?php $args=array(
								'showposts'=>get_option('deepfocus_homepage_posts'),
								'paged'=>$paged,
								'category__not_in' => get_option('deepfocus_exlcats_recent'),
							);
							if (get_option('deepfocus_duplicate') == 'false') $args['post__not_in'] = $ids;
							query_posts($args); ?>
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
				<?php } ?>
				
			</div> <!-- end .container -->
					
			<?php get_footer(); ?>
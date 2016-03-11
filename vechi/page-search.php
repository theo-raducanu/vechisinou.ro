<?php 
/*
Template Name: Search Page
*/
?>
<?php the_post(); ?>

<?php 
	$et_ptemplate_settings = array();
	$et_ptemplate_settings = maybe_unserialize( get_post_meta($post->ID,'et_ptemplate_settings',true) );
	
	$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : (bool) $et_ptemplate_settings['et_fullwidthpage'];
?>

<?php get_header(); ?>
	
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
	
			<?php if ($fullwidth) { ?>
				<div id="full" class="clearfix">
			<?php } else { ?>
				<div id="content-area" class="clearfix">
					<div id="left-area">
			<?php } ?>
					
					<?php if (get_option('deepfocus_integration_single_top') <> '' && get_option('deepfocus_integrate_singletop_enable') == 'on') echo(get_option('deepfocus_integration_single_top')); ?>
					
					<div class="entry clearfix post<?php if($fullwidth) echo(' full');?>">
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
						
						
						<?php if($thumb == '') echo('<div class="clear"></div>'); ?>
						
						<?php if($thumb <> '' && get_option('deepfocus_page_thumbnails') == 'on') { ?>
							<div class="post-thumbnail">							
								<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, $classtext); ?>
								<span class="overlay"></span>
							</div> 	<!-- end .thumbnail -->	
						<?php }; ?>

						<?php the_content(); ?>
						<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages','DeepFocus').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
						
						<div id="et-search">
							<div id="et-search-inner" class="clearfix">
								<p id="et-search-title"><span><?php _e('search this website','DeepFocus'); ?></span></p>
								<form action="<?php bloginfo('url'); ?>" method="get" id="et_search_form">
									<div id="et-search-left">
										<p id="et-search-word"><input type="text" id="et-searchinput" name="s" value="search this site..." /></p>
																		
										<p id="et_choose_posts"><label><input type="checkbox" id="et-inc-posts" name="et-inc-posts"> <?php _e('Posts','DeepFocus'); ?></label></p>
										<p id="et_choose_pages"><label><input type="checkbox" id="et-inc-pages" name="et-inc-pages"> <?php _e('Pages','DeepFocus'); ?></label></p>
										<p id="et_choose_date">
											<select id="et-month-choice" name="et-month-choice">
												<option value="no-choice"><?php _e('Select a month','DeepFocus'); ?></option>
												<?php 
													global $wpdb, $wp_locale;
													
													$selected = '';
													$query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";
													
													$arcresults = $wpdb->get_results($query);
																														
													foreach ( (array) $arcresults as $arcresult ) {
														if ( isset($_POST['et-month-choice']) && ( $_POST['et-month-choice'] == ($arcresult->year . $arcresult->month) ) ) {
															$selected = ' selected="selected"';
														}
														echo "<option value='{$arcresult->year}{$arcresult->month}'{$selected}>{$wp_locale->get_month($arcresult->month)}" . ", {$arcresult->year}</option>";
														if ( $selected <> '' ) $selected = '';
													}
												?>
											</select>
										</p>
									
										<p id="et_choose_cat"><?php wp_dropdown_categories('show_option_all=Choose a Category&show_count=1&hierarchical=1&id=et-cat&name=et-cat'); ?></p>
									</div> <!-- #et-search-left -->
									
									<div id="et-search-right">
										<input type="hidden" name="et_searchform_submit" value="et_search_proccess" />
										<input class="et_search_submit" type="submit" value="<?php _e('Submit','DeepFocus'); ?>" id="et_search_submit" />
									</div> <!-- #et-search-right -->
								</form>
							</div> <!-- end #et-search-inner -->
						</div> <!-- end #et-search -->
						
						<div class="clear"></div>
						
						<?php edit_post_link(__('Edit this page','DeepFocus')); ?>
					</div> <!-- end .entry -->
					
					<?php if (get_option('deepfocus_integration_single_bottom') <> '' && get_option('deepfocus_integrate_singlebottom_enable') == 'on') echo(get_option('deepfocus_integration_single_bottom')); ?>
					
					</div> <!-- end #left-area -->
				
				<?php if (!$fullwidth) get_sidebar(); ?>

			</div> <!-- end #content-area -->

		</div> <!-- end .container -->
					
		<?php get_footer(); ?>
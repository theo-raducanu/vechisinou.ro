<?php session_start();
/*
Template Name: Contact Page
*/
?>
<?php the_post(); ?>

<?php 
	$et_ptemplate_settings = array();
	$et_ptemplate_settings = maybe_unserialize( get_post_meta($post->ID,'et_ptemplate_settings',true) );
	
	$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : (bool) $et_ptemplate_settings['et_fullwidthpage'];
	
	$et_regenerate_numbers = isset( $et_ptemplate_settings['et_regenerate_numbers'] ) ? (bool) $et_ptemplate_settings['et_regenerate_numbers'] : (bool) $et_ptemplate_settings['et_regenerate_numbers'];
		
	$et_error_message = '';
	$et_contact_error = false;
	
	if ( isset($_POST['et_contactform_submit']) ) {
		if ( !isset($_POST['et_contact_captcha']) || empty($_POST['et_contact_captcha']) ) {
			$et_error_message .= '<p>' . __('Make sure you entered the captcha. ','DeepFocus') . '</p>';
			$et_contact_error = true;
		} else if ( $_POST['et_contact_captcha'] <> ( $_SESSION['et_first_digit'] + $_SESSION['et_second_digit'] ) ) {			
			$et_numbers_string = $et_regenerate_numbers ? __('Numbers regenerated.') : '';
			$et_error_message .= '<p>' . __('You entered the wrong number in captcha. ','DeepFocus') . $et_numbers_string . '</p>';
			
			if ($et_regenerate_numbers) {
				unset( $_SESSION['et_first_digit'] );
				unset( $_SESSION['et_second_digit'] );
			}
			
			$et_contact_error = true;
		} else if ( empty($_POST['et_contact_name']) || empty($_POST['et_contact_email']) || empty($_POST['et_contact_subject']) || empty($_POST['et_contact_message']) ){
			$et_error_message .= '<p>' . __('Make sure you fill all fields. ','DeepFocus') . '</p>';
			$et_contact_error = true;
		}
		
		if ( !is_email( $_POST['et_contact_email'] ) ) {
			$et_error_message .= '<p>' . __('Invalid Email. ','DeepFocus') . '</p>';
			$et_contact_error = true;
		}
	} else {
		$et_contact_error = true;
		if ( isset($_SESSION['et_first_digit'] ) ) unset( $_SESSION['et_first_digit'] );
		if ( isset($_SESSION['et_second_digit'] ) ) unset( $_SESSION['et_second_digit'] );
	}
	
	if ( !isset($_SESSION['et_first_digit'] ) ) $_SESSION['et_first_digit'] = $et_first_digit = rand(1, 15);
	else $et_first_digit = $_SESSION['et_first_digit'];
	
	if ( !isset($_SESSION['et_second_digit'] ) ) $_SESSION['et_second_digit'] = $et_second_digit = rand(1, 15);
	else $et_second_digit = $_SESSION['et_second_digit'];
	
	if ( !$et_contact_error ) {
		$et_email_to = ( isset($et_ptemplate_settings['et_email_to']) && !empty($et_ptemplate_settings['et_email_to']) ) ? $et_ptemplate_settings['et_email_to'] : get_site_option('admin_email');
				
		wp_mail($et_email_to, sprintf( '[%s] ' . $_POST['et_contact_subject'], $current_site->site_name ), $_POST['et_contact_message'],'From: "'. $_POST['et_contact_name'] .'" <' . $_POST['et_contact_email'] . '>');
		
		$et_error_message = '<p>' . __('Thanks for contacting us','DeepFocus') . '</p>';
	}
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
						
						<div id="et-contact">
						
							<div id="et-contact-message"><?php echo($et_error_message); ?> </div>
							
							<?php if ( $et_contact_error ) { ?>
								<form action="<?php echo(get_permalink($post->ID)); ?>" method="post" id="et_contact_form">
									<div id="et_contact_left">
										<p class="clearfix">
											<input type="text" name="et_contact_name" value="<?php if ( isset($_POST['et_contact_name']) ) echo $_POST['et_contact_name']; else _e('Name','DeepFocus'); ?>" id="et_contact_name" class="input" />
										</p>
										
										<p class="clearfix">
											<input type="text" name="et_contact_email" value="<?php if ( isset($_POST['et_contact_email']) ) echo $_POST['et_contact_email']; else _e('Email Address','DeepFocus'); ?>" id="et_contact_email" class="input" />
										</p>
										
										<p class="clearfix">
											<input type="text" name="et_contact_subject" value="<?php if ( isset($_POST['et_contact_subject']) ) echo $_POST['et_contact_subject']; else _e('Subject','DeepFocus'); ?>" id="et_contact_subject" class="input" />
										</p>
									</div> <!-- #et_contact_left -->
									
									<div id="et_contact_right">
										<p class="clearfix">
											<?php 
												_e('Captcha: ','DeepFocus');	
												echo '<br/>';
												echo $et_first_digit . ' + ' . $et_second_digit . ' = ';
											?>
											<input type="text" name="et_contact_captcha" value="<?php if ( isset($_POST['et_contact_captcha']) ) echo $_POST['et_contact_captcha']; ?>" id="et_contact_captcha" class="input" size="2" />
										</p>
									</div> <!-- #et_contact_right -->
									
									<p class="clearfix">
										<textarea class="input" id="et_contact_message" name="et_contact_message"><?php if ( isset($_POST['et_contact_message']) ) echo $_POST['et_contact_message']; else _e('Message','DeepFocus'); ?></textarea>
									</p>
										
									<input type="hidden" name="et_contactform_submit" value="et_contact_proccess" />
									
									<input type="reset" id="et_contact_reset" value="<?php _e('Reset','DeepFocus'); ?>" />
									<input class="et_contact_submit" type="submit" value="<?php _e('Submit','DeepFocus'); ?>" id="et_contact_submit" />
								</form>
							<?php } ?>
						</div> <!-- end #et-contact -->
						
						<div class="clear"></div>
						
						<?php edit_post_link(__('Edit this page','DeepFocus')); ?>
					</div> <!-- end .entry -->
					
					<?php if (get_option('deepfocus_integration_single_bottom') <> '' && get_option('deepfocus_integrate_singlebottom_enable') == 'on') echo(get_option('deepfocus_integration_single_bottom')); ?>
					
					</div> <!-- end #left-area -->
				
				<?php if (!$fullwidth) get_sidebar(); ?>

			</div> <!-- end #content-area -->

		</div> <!-- end .container -->
					
		<?php get_footer(); ?>
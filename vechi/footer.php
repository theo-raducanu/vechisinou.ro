				<div id="footer">
					<div id="footer-wrapper">
						<div id="footer-center">
							<div class="container">
								<?php if (!is_home()) { ?>
									<div id="footer-widgets" class="clearfix">
										<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?> 
										<?php endif; ?>
									</div> <!-- end #footer-widgets -->	
								<?php } ?>
							
								<p id="copyright"><?php _e('Designed by ','DeepFocus'); ?> <a href="mailto:theo.raducanu@yahoo.com" title="Raducanu Theodor">Raducanu Theodor</a> | <?php _e('Powered by ','Vechi si Nou'); ?> <a href="#">Vechi si Nou </a><?php _e('2012 ','DeepFocus'); ?></p>
							</div> <!-- end .container -->
						</div> <!-- end #footer-center -->
					</div> <!-- end #footer-wrapper -->
				</div> <!-- end #footer -->

			</div> <!-- end .center-highlight -->

	</div> <!-- end #content-full -->
		
	<?php include(TEMPLATEPATH . '/includes/scripts.php'); ?>

	<?php wp_footer(); ?>	
</body>
</html>
<?php

/* sets predefined Post Thumbnail dimensions */
if ( function_exists( 'add_theme_support' ) ) {
   add_theme_support( 'post-thumbnails' );
   
   //blog page template
	add_image_size( 'ptentry-thumb', 184, 184, true );
	//gallery page template
	add_image_size( 'ptgallery-thumb', 207, 136, true );
      
   //entry image size
   add_image_size( 'entry-thumb', 185, 185, true );
   
   //entry gallery image size
   add_image_size( 'entry-gallery', 650, 9999 );
	  
   //featured image size
   add_image_size( 'featured-thumb', 960, 447, true );
      
   //recent category image size
   add_image_size( 'recent-works', 207, 136, true );
   
   //entry image size
   add_image_size( 'custom-thumb', 238, 238, true );
      
   //small image size
   add_image_size( 'small-thumb', 59, 59, true );
   
};
/* --------------------------------------------- */

?>
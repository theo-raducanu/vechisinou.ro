<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php elegant_titles(); ?></title>
<?php elegant_description(); ?>
<?php elegant_keywords(); ?>
<?php elegant_canonical(); ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery.fancybox-1.2.6.css" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie6style.css" />
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type="text/javascript">DD_belatedPNG.fix('img#logo, #search-form, #featured, span.date, .footer-widget ul li, span.overlay, a.readmore, a.readmore span, #recent-posts a#left-arrow, #recent-posts a#right-arrow, h4#recent, div#breadcrumbs, #sidebar h4');</script>
<![endif]-->
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie7style.css" />
<![endif]-->
<!--[if IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie8style.css" />
<![endif]-->
<!--[if gte IE 9]> <script type="text/javascript"> Cufon.set('engine', 'canvas'); </script> <![endif]--> 
<meta http-equiv="X-UA-Compatible" content="IE=8" />

<script type="text/javascript">
	document.documentElement.className = 'js';
</script>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>
<body<?php if (is_home()) { if (get_option('deepfocus_featured') == 'on') echo(' id="home-featured"'); else echo(' id="home"'); } ?><?php if ( get_option('deepfocus_cufon') == 'false' ) echo(' class="cufon-disabled"'); ?>>
	<div id="top">
		<div class="container">
			<div id="header">
				<a href="<?php bloginfo('url'); ?>">
					<?php $logo = (get_option('deepfocus_logo') <> '') ? get_option('deepfocus_logo') : get_bloginfo('template_directory').'/images/logo.png'; ?>
					<img src="<?php echo $logo; ?>" alt="DeepFocus Logo" id="logo"/>
				</a>
				<div id="menu" class="clearfix">
					<?php $menuClass = 'nav';
					$menuID = 'primary';
					$primaryNav = '';
					if (function_exists('wp_nav_menu')) {
						$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) ); 
					};
					if ($primaryNav == '') { ?>
						<ul id="<?php echo $menuID; ?>" class="<?php echo $menuClass; ?>">
							<?php if (get_option('deepfocus_home_link') == 'on') { ?>
								<li <?php if (is_home()) echo('class="current_page_item"') ?>><a href="<?php bloginfo('url'); ?>"><?php _e('Home','DeepFocus') ?></a></li>
							<?php }; ?>
							
							<?php show_page_menu($menuClass,false,false); ?>
						
							<?php show_categories_menu($menuClass,false); ?>
						</ul> <!-- end ul#nav -->
					<?php }
					else echo($primaryNav); ?>
						
					<div id="search-form">
						<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
							<input type="text" value="<?php _e('search this site...','DeepFocus'); ?>" name="s" id="searchinput" />

							<input type="image" src="<?php bloginfo('template_directory'); ?>/images/search-btn.png" id="searchsubmit" />
						</form>
					</div> <!-- end #search-form -->
				</div> <!-- end #menu -->		
			</div> <!-- end #header -->
		</div> <!-- end .container -->		
	</div> <!-- end #top -->
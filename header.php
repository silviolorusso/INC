<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php echo get_bloginfo(); ?><?php wp_title( '|', TRUE, 'RIGHT' ); ?></title>
		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>
		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>
		<!-- fonts and icons -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,300,600' rel='stylesheet' type='text/css'>
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/libs/jquery.infinitescroll.js"></script>
		<!-- FitVids -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/libs/jquery.fitvids.js"></script>
		<!-- ScrollTo -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/libs/jquery.scrollTo.min.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/libs/jquery.localScroll.min.js"></script>
	</head>
	<body <?php body_class(); ?>>
		<div id="container">
			<header class="header" role="banner">
				<div id="inner-header" class="wrap clearfix">
					<p id="logo" class="h1">
						<a href="<?php echo home_url(); ?>" rel="nofollow">
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/inc-logos/inc_logo1@2x.png" alt="<?php bloginfo('name'); ?>" />
						</a>
					</p>
					<div id="search">
						<form method="get" id="searchform" action="http://www.google.com/search">
							<input type="text" class="inputbox" alt="search" maxlength="20" name="q" id="s" size="15">
							<input type="radio" name="sitesearch" value="http://networkcultures.org" checked="" style="display:none;">
			        	</form>			    
					</div>
				</div>
			</header>
			<div id="main-nav">
				<nav role="navigation" class="wrap" id="burger">
					<div id="navicon">
						<span>MENU</span>
					</div>
					<?php bones_main_nav(); ?>
				</nav>
				<nav role="navigation" class="wrap" id="baguette">
					<?php bones_main_nav(); ?>
				</nav>
			</div>
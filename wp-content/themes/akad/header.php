<?php
/**
* The header for our theme.
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package Akad
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--        Bootstrap core CSS      -->
	<link href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

	<!-- 		Jasny Bootstrap -->

	<link href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>

	<!--        FontAwesome Icons       -->
	<link href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

	<!--        Google Fonts        -->
	<link href='https://fonts.googleapis.com/css?family=Montserrat:700|Open+Sans' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>
<!--HEADER
=====================================================================-->

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<div id="content" class="site-content">

			<header>


					<div class="container">
						<nav id="menu" class="navbar navbar-default">
							<div class="container">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<a class="navbar-brand" href="#">
										<img src="wp-content/themes/akad/assets/img/logo.png" alt="" />
									</a>
								</div>
								<div id="navbar" class="navbar-collapse collapse mont color-gray">
									<ul class="nav navbar-nav navbar-right">
										<li class="active"><a href="#">Home</a></li>
										<li><a href="">About Us</a></li>
										<li><a href="">Services</a></li>
										<li><a href="">Portfolio</a></li>
										<li><a href="">Blog</a></li>
										<li><a href="">Contact Us</a></li>
									</ul>
								</div><!--/.nav-collapse -->
							</div>
						</nav>
					</div>



		</header>

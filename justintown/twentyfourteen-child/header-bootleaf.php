<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<!--META-->
			<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-43232355-6']);
  _gaq.push(['_gat._forceSSL']);
  _gaq.push(['_trackPageview']);

  (function () {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
  })();

</script>
	<!--META-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="author" content="">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
<?php /*wp_head();*/ ?>
    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.leafletjs.com/leaflet-0.7.3/leaflet.css">
    <link rel="stylesheet" href="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css">
    <link rel="stylesheet" href="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css">
    <link rel="stylesheet" href="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.24.0/L.Control.Locate.css">
    <link rel="stylesheet" href="http://www.cityplanner.it/php/bootleaf-master/assets/leaflet-sidebar-0.1.5/L.Control.Sidebar.css">
    <link rel="stylesheet" href="http://www.cityplanner.it/php/bootleaf-master/assets/css/app.css">

    <link rel="apple-touch-icon" sizes="76x76" href="http://www.cityplanner.it/php/bootleaf-master/assets/img/favicon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="http://www.cityplanner.it/php/bootleaf-master/assets/img/favicon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="http://www.cityplanner.it/php/bootleaf-master/assets/img/favicon-152.png">
    <link rel="icon" sizes="196x196" href="http://www.cityplanner.it/php/bootleaf-master/assets/img/favicon-196.png">
    <link rel="shortcut icon" sizes="196x196" href="http://www.cityplanner.it/php/bootleaf-master/assets/img/favicon-196.png">

</head><!--/head-->

<body>




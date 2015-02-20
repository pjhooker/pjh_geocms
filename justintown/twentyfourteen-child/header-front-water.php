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
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<!--META-->
		<?php 
	//wp_head();

	?>
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
	<!-- qgis2leaf -->
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" /> <!-- we will us e this as the styling script for our webmap-->
	<link rel="stylesheet" href="http://www.cityplanner.it/mapping_ginosa/php/qgis2leaf/export_2014_12_18_01_53_15/css/MarkerCluster.css" />
	<link rel="stylesheet" href="http://www.cityplanner.it/mapping_ginosa/php/qgis2leaf/export_2014_12_18_01_53_15/css/MarkerCluster.Default.css" />
	<link rel="stylesheet" type="text/css" href="http://www.cityplanner.it/mapping_ginosa/php/qgis2leaf/export_2014_12_18_01_53_15/css/own_style.css">
    <link rel="stylesheet" href="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.css" />	
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> <!-- this is the javascript file that does the magic-->
	<script src="http://www.cityplanner.it/mapping_ginosa/php/qgis2leaf/export_2014_12_18_01_53_15/js/Autolinker.min.js"></script>
	<!-- /qgis2leaf -->

	<?php
	$postid = get_the_ID();
	get_metaimage($postid);
	?>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/blog/blog.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://getbootstrap.com/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="http://www.cityplanner.it/valleolona/php/openlayers-master/lib/OpenLayers.js"></script>
    
</head>

<body style='width:100%;'>
	<!-- qgis2leaf -->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.2/leaflet.js"></script> <!-- this is the javascript file that does the magic-->
	<script src="http://www.cityplanner.it/mapping_ginosa/php/qgis2leaf/export_2014_12_18_01_53_15/js/leaflet-hash.js"></script>
	<script src="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.js"></script>
	<script src="http://www.cityplanner.it/mapping_ginosa/php/qgis2leaf/export_2014_12_18_01_53_15/js/leaflet.markercluster.js"></script>
	<!-- /qgis2leaf -->
    <div class="blog-masthead">
      <div class="container">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>


			<nav id="primary-navigation" class="site-navigation primary-navigation blog-nav" role="navigation">
				<button class="menu-toggle"><?php _e( 'Primary Menu', 'twentyfourteen' ); ?></button>
				<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'twentyfourteen' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
        	</nav>
      </div>
    </div>



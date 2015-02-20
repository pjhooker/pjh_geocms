<?php
/**
 * Template Name: MAP
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header('front-water'); ?>



    <div class="container">

      <div class="row">
        <div class="col-sm-8 blog-main">

          <div class="blog-post">

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );
?>

<?php/*

<div id="map" class="smallmap"></div>
<?php
$lng=8.9499;
$lat=45.6497;


// NEW MAP START 
?>

    <style type="text/css">
        #map {
            width: 100%;
            height: 500px;
            border: 1px solid #00BFFF;
            background-color: #fff;
    }
    </style>
<?php


?>

<script src='http://www.cityplanner.it/valleolona/js/mappa_tutti_percorsi.js'></script>
<script type="text/javascript">
    var lon = <?php echo $lng; ?>,
    lat = <?php echo $lat; ?>
</script>

<?php
 
//NEW MAP STOP 
//MOD PJH --- STOP
 

			*/
			?>

	<!-- qgis2leaf -->

	<div id="map"></div> <!-- this is the initial look of the map. in most cases it is done externally using something like a map.css stylesheet were you can specify the look of map elements, like background color tables and so on.-->
	<script src='http://www.cityplanner.it/mapping_ginosa/php/qgis2leaf/export_2014_12_18_01_53_15/data/exp_ptluoghi.js' ></script>
				
	<script>
		var map = L.map('map', { zoomControl:true }).fitBounds([[44.5249,7.6624],[44.5748,7.7972]]);
		var hash = new L.Hash(map); //add hashes to html address to easy share locations
		var additional_attrib = 'created w. <a href="https://github.com/geolicious/qgis2leaf" target ="_blank">qgis2leaf</a> by <a href="http://www.geolicious.de" target ="_blank">Geolicious</a> & contributors<br>';
	var feature_group = new L.featureGroup([]);

	var raster_group = new L.LayerGroup([]);
	
	var basemap_0 = L.tileLayer('http://a.tile.stamen.com/watercolor/{z}/{x}/{y}.png', { 
		attribution: additional_attrib + 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data: &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'});	
	basemap_0.addTo(map);	
	var layerOrder=new Array();
							function pop_ptluoghi(feature, layer) {
										
	var popupContent = '<table><tr><td><a href="https://it.wikipedia.org/wiki/Ginosa#mediaviewer/File:Passion_of_Christ.jpg"><img src="https://upload.wikimedia.org/wikipedia/commons/3/33/Passion_of_Christ.jpg" width="200px"><br>Resurrezione di Gesù</a></td></tr></table>';
	layer.bindPopup(popupContent);


				}
						
				var exp_ptluoghiJSON = new L.geoJson(exp_ptluoghi,{
					onEachFeature: pop_ptluoghi,
					pointToLayer: function (feature, latlng) {  
						return L.circleMarker(latlng, {
							radius: feature.properties.radius_qgis2leaf,
							fillColor: feature.properties.color_qgis2leaf,

							color: feature.properties.borderColor_qgis2leaf,
							weight: 1,
							opacity: feature.properties.transp_qgis2leaf,
							fillOpacity: feature.properties.transp_qgis2leaf
							})
						}
					});
				
				var cluster_groupptluoghiJSON= new L.MarkerClusterGroup({showCoverageOnHover: false});
				cluster_groupptluoghiJSON.addLayer(exp_ptluoghiJSON);
				
						//add comment sign to hide this layer on the map in the initial view.
						cluster_groupptluoghiJSON.addTo(map);
		/*
		var title = new L.Control();
		title.onAdd = function (map) {
			this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
			this.update();
			return this._div;
	    };
	    title.update = function () {
			this._div.innerHTML = '<h2>This is the title</h2>This is the subtitle'
		};
		title.addTo(map);
		*/
		var osmGeocoder = new L.Control.OSMGeocoder({
            collapsed: false,
            position: 'topright',
            text: 'Find!',
			});
		osmGeocoder.addTo(map);
		
	var baseMaps = {
		'Stamen Watercolor': basemap_0
	};
	L.control.layers(baseMaps,{"pt_luoghi": cluster_groupptluoghiJSON},{collapsed:false}).addTo(map);
	L.control.scale({options: {position: 'bottomleft',maxWidth: 100,metric: true,imperial: false,updateWhenIdle: false}}).addTo(map);
	</script>
	<!-- /qgis2leaf -->
<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;

?>
         </div><!-- /.blog-post -->


        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">

<?php get_sidebar();?>

        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->
<?php
get_footer();

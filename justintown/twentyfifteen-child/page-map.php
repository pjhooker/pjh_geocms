<?php acf_form_head(); ?>
<?php
/**
 * Template Name: MAP >>
 */

get_header('leaflet-osm'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
<style type="text/css">
	.entry-content a  {
    border-bottom: 0px solid #333;
}
</style>

<div class="row">
<div class="col-sm-6">
    <div class="list-group">
            <span class='list-group-item active'>
              Prossimi eventi
            </span>
<?php
//prossimi eventi


$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 3, post_status => 'publish'));
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();


// TITOLO
$title=get_the_title();
$title = str_replace('"', '', $title);
$plink=get_permalink();
$postid = get_the_ID();
$date_start=get_field('date_start');
if ($date_start >= date('Ymd',time())){

echo"
            <a href='$plink' class='list-group-item' style='font-size:12px;border-bottom: 1px solid #333;'>$title $date_start</a> 
";
}else{}

endwhile;
// Reset Post Data
wp_reset_postdata();


?>
    </div>
</div>
<div class="col-sm-6">
    <div class="list-group">
            <span class='list-group-item active'>
              Luoghi con eventi
            </span>
<?php
//luoghi con eventi

$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 3, post_status => 'publish'));
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();


// TITOLO

$postid = get_the_ID();
$date_start=get_field('date_start');
$place_id=get_field('poi_id');
$title1=get_the_title($place_id);
$title1 = str_replace('"', '', $title1);
$plink1=get_permalink($place_id);
if ($date_start >= date('Ymd',time())){

echo"
            <a href='$plink1' class='list-group-item' style='font-size:12px;border-bottom: 1px solid #333;'>$title1</a> 
";
}else{}

endwhile;
// Reset Post Data
wp_reset_postdata();


?>
    </div>
</div>
</div>

		<div id="map"></div> <!-- this is the initial look of the map. in most cases it is done externally using something like a map.css stylesheet were you can specify the look of map elements, like background color tables and so on.-->

<script src='<?php echo site_url($path, $scheme); ?>/geodata/exp_ptluoghi.js' ></script>
				
<script>
	var map = L.map('map', { zoomControl:true }).fitBounds([[44.5249,7.6624],[44.5748,7.7972]]);
	var hash = new L.Hash(map); //add hashes to html address to easy share locations
	var additional_attrib = 'created w. <a href="https://github.com/geolicious/qgis2leaf" target ="_blank">qgis2leaf</a> by <a href="http://www.geolicious.de" target ="_blank">Geolicious</a> & contributors<br>';
	var feature_group = new L.featureGroup([]);

	var raster_group = new L.LayerGroup([]);
	
	var basemap_0 = L.tileLayer(
		'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { 
			attribution: additional_attrib + '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
		}
	);	
	basemap_0.addTo(map);	
	var layerOrder=new Array();
		function pop_ptluoghi(feature, layer) {									
			var popupContent = '<a href="' + feature.properties.id + '">'
						+'' + feature.properties.title + ''
					+'</a><br><img src="http://cdn.mysitemyway.com/etc-mysitemyway/icons/legacy-previews/icons/glossy-black-icons-social-media-logos/099377-glossy-black-icon-social-media-logos-wordpress-logo-square.png" width="80"/>';
			layer.bindPopup(popupContent);
		}
						
	var exp_ptluoghiJSON = new L.geoJson(exp_ptluoghi,{
		onEachFeature: pop_ptluoghi,
		pointToLayer: function (feature, latlng) {  
	            return L.marker(latlng, {
	              icon: L.icon({
					iconUrl: feature.properties.icon_exp,      
	                iconSize:     [24, 24], // size of the icon change this to scale your icon (first coordinate is x, second y from the upper left corner of the icon)
	                iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location (first coordinate is x, second y from the upper left corner of the icon)
	                popupAnchor:  [0, -14] // point from which the popup should open relative to the iconAnchor (first coordinate is x, second y from the upper left corner of the icon)
	              })  // L.icon
	            })    // L.marker
			}
		});

	
	var cluster_groupptluoghiJSON= new L.MarkerClusterGroup({showCoverageOnHover: false});
	cluster_groupptluoghiJSON.addLayer(exp_ptluoghiJSON);
	
			//add comment sign to hide this layer on the map in the initial view.
			cluster_groupptluoghiJSON.addTo(map);

		
	var baseMaps = {
		'OpenStreetsMap': basemap_0
	};
	L.control.layers(baseMaps,{"pt_luoghi": cluster_groupptluoghiJSON},{collapsed:false}).addTo(map);
	L.control.scale({options: {position: 'bottomleft',maxWidth: 100,metric: true,imperial: false,updateWhenIdle: false}}).addTo(map);
</script>

	</div><!-- .entry-content -->

</article><!-- #post-## -->

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>

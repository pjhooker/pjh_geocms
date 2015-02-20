<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		twentyfifteen_post_thumbnail();
		
	?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				//the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ( is_single() ) :
			/* translators: %s: Name of current post */
		//the_meta();
			the_content( sprintf(
				__( 'Continue reading %s', 'twentyfifteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
$user = wp_get_current_user();
$allowed_roles = array('editor', 'administrator', 'author');
if( array_intersect($allowed_roles, $user->roles ) ) { 
	crea_geojson_poi_schedapoi();
	//crea_geojson_poi_schedapoi_singolo($postid);

	//the_meta();
} // IF EDITNG --STOP
else
{
	crea_geojson_poi_schedapoi_singolo($postid);
} // ELSE EDITNG --STOP

			?>

<?php
$postid = get_the_ID();
$location = get_field('map');
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng']; 
$address=$location['address'];
endif; // lat lng

?>
<style type="text/css">
	.entry-content a  {
    border-bottom: 0px solid #333;
}
</style>
<div class="row">
<div class="col-sm-12">
    <div class="list-group">
            <span class='list-group-item active'>
              Prossimi eventi
            </span>
<?php
//prossimi eventi

get_event_poi($postid);



?>
    </div>
</div>
</div>

		<div id="map"></div> <!-- this is the initial look of the map. in most cases it is done externally using something like a map.css stylesheet were you can specify the look of map elements, like background color tables and so on.-->

<script src='<?php echo site_url($path, $scheme); ?>/geodata/exp_ptluoghi.js' ></script>
<script type="text/javascript">
    var lon = <?php echo $lng; ?>,
    lat = <?php echo $lat; ?>

	var map = L.map('map', { zoomControl:true }).fitBounds([[(lat-0.002),(lon-0.002)],[(lat+0.002),(lon+0.002)]]);
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

		L.circle([lat, lon], 50, {
			color: 'red',
			fillColor: '#f03',
			fillOpacity: 0.2
		}).addTo(map);

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

<?php
echo"
	<h2>Eventi</h2>
";

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			else :

			endif;				
		?>
	</div><!-- .entry-content -->

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<footer class="entry-footer">
		<?php twentyfifteen_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

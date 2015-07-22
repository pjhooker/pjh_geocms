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
$category = get_the_category();
$catslug=$category[0]->slug;
$catname=$category[0]->cat_name;
$catlink=get_category_link( $category[0]->term_id);
$user = wp_get_current_user();
$allowed_roles = array('editor', 'administrator', 'author');
if( array_intersect($allowed_roles, $user->roles ) ) {
	//echo "in editig<hr>";
	$myFile = "365.geojson";
	$fh = fopen($myFile, 'w') or die("can't open file");
	$stringData = '{ "features" : [ ';
      	fwrite($fh, $stringData);
	$the_query = new WP_Query( array( 'posts_per_page' => -1 ) );
      	$i=0;
      	// The Loop
      	while ( $the_query->have_posts() ) : $the_query->the_post();
        	$postid   = get_the_ID();
        	$plink    = get_permalink();
    		$title = get_the_title($ID);
    		$title = str_replace('"', '', $title);
    		$title = strip_tags($title);
    		$title = trim(preg_replace('/\s\s+/', ' ', $title));
    		$location = get_field('map');

    		if( !empty($location) ):

      			$lat=$location['lat'];
      			$lng=$location['lng'];
      			$address=$location['address'];
          		$i++;
          		if ($i==1){$comma='';}
          		else{$comma=',';}
          		$stringData = $comma.' {
				"geometry" : { "coordinates" : ['.$lng.','.$lat.'],"type" : "Point"},
            			"properties" : { "postid":"'.$postid.'","titolo":"'.$title.'","url_post":"'.$plink.'"},
				"type" : "Feature"
			}';
          		fwrite($fh, $stringData);
		endif; // lat lng
	endwhile;
      	// Reset Post Data
      	wp_reset_postdata();
      	$stringData = '
        	],"type" : "FeatureCollection"}
      	';
      	fwrite($fh, $stringData);
      	fclose($fh);
} // IF EDITNG --STOP
else
{
} // ELSE EDITNG --STOP
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
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			if ( is_single() ) {

			the_content( sprintf(
				__( 'Continue reading %s', 'twentyfifteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
	$map = get_field('map');
	if( !empty($map) ):
		$lat= $map['lat'];
		$lng=$map['lng'];
		$address=$map['address'];
		if ($lat==0){}
		else{
?>
</div><!-- .entry-content -->
</article>
	<link rel="stylesheet" href="http://leafletjs.com/dist/leaflet.css" />
	<script src="http://leafletjs.com/dist/leaflet.js"></script>


	<article <?php post_class(); ?> style="margin-top:15px;">
	    <div class="row">
	        <div class="col-sm-12">
				<div id="map" style="width: 100%; height: 400px;"></div>
	        </div>
	    </div>
	</article>


<?php	}
	endif; // lat lng

if($catslug=='mappa'){
	$source_file=get_field('source_file');
	?>
	</div><!-- .entry-content -->
	</article>
	<link rel="stylesheet" href="http://leafletjs.com/dist/leaflet.css" />
	<script src="http://leafletjs.com/dist/leaflet.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>


	<article <?php post_class(); ?> style="margin-top:15px;padding-top:0px;">
	    <div class="row">
	        <div class="col-sm-12">
				<div id="map" style="width: 100%; height: 800px;"></div>
	        </div>
	    </div>
	</article>
<?php
}
}
else {
	the_excerpt();
}
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
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

<?php


	if($catslug=='mappa'){
		?>
		<script>

			var map = L.map('map').setView([45.594271, 8.920323], 13);

			L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
				maxZoom: 18,
				attribution: 'Map tiles by <a href="https://www.mapbox.com/">MapBox</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data: &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
			}).addTo(map);


$.getJSON("http://www.centinaiogohome.it/blog/365.geojson", function(data) {
	var geojson = L.geoJson(data, {
			pointToLayer: function (feature, latlng) {
				// crea un punto e definisce l'icona per ogni punto
				return L.marker(latlng, {
						icon: L.icon({
							iconUrl: "http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/cemetery-24@2x.png",
							iconSize: [24, 24],
							iconAnchor: [12, 12],
							popupAnchor: [0, -12]
						}),
						//
						title: feature.properties.tipo,
						riseOnHover: true
				});
		},
		onEachFeature: function (feature, layer) {
			layer.bindPopup("<a href='"+feature.properties.url_post+"'>"+feature.properties.titolo+"</a>");
		}
	});
	geojson.addTo(map);
});
		</script>
		<?php
	}

else{
	if ($lat==0){}
	else{
?>
<script>

	var map = L.map('map').setView([<?php echo $lat; ?>, <?php echo $lng; ?>], 16);

	L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: 'Map tiles by <a href="https://www.mapbox.com/">MapBox</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data: &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
	}).addTo(map);


	L.marker([<?php echo $lat; ?>, <?php echo $lng; ?>]).addTo(map)
		.bindPopup("<?php echo'<h2>';the_title(); echo '</h2>'.$address; ?>").openPopup();

	L.circle([<?php echo $lat; ?>, <?php echo $lng; ?>], 100, {
		color: '#f03',
		fillColor: 'white',
		fillOpacity: 0.5
	}).addTo(map).bindPopup("I am a circle.");

	var popup = L.popup();

	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent("You clicked the map at " + e.latlng.toString())
			.openOn(map);
	}

	map.on('click', onMapClick);

</script>
<?php
	}
}
?>

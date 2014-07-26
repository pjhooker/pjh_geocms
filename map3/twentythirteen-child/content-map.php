<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>

		<?php if ( is_single() ) : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; // is_single() ?>

		<div class="entry-meta">
			<?php twentythirteen_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
<?php /* INIZIO MODIFICA PJH */ ?>


<?php /* INIZIO PARTE CREZIONE FILE JSON */ ?>

<?php

//crea JSON
$myFile = "json/textfile.json";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = '{ "features" : [ ';
fwrite($fh, $stringData);


// The Query to show a specific Custom Field
$the_query = new WP_Query( array( 'meta_key' => 'mappa', 'meta_value' => 'prova','posts_per_page' => -1 ) );

// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post();

echo "<b>";
$title=get_the_title($post->ID);
echo $title;
echo "</b> ";

$key="mappa";
echo get_post_meta($post->ID, $key, true);
echo " - ";

$key="lat";
$lat = get_post_meta($post->ID, $key, true);
echo "$lat | ";

$key="lng";
$lng = get_post_meta($post->ID, $key, true);
echo"$lng<br>";

$stringData = ' { "geometry" : {
"coordinates" : [ ' . $lng .', ' . $lat .' ],
"type" : "Point"
},
"properties" : { "Colour" : "#ffffff",
"ImageURL" : "http://openclipart.org/image/800px/svg_to_png/140725/marker-red-optimized.png",
"titolo" : "'.$title.'",
"picture" : "http://static.panoramio.com/photos/large/103131489.jpg",
"url_post" : "http://www.panoramio.com/photo/84217907"
},
"type" : "Feature"
},';
fwrite($fh, $stringData);


endwhile;
// Reset Post Data
wp_reset_postdata();


$stringData = ' { "geometry" : {
"coordinates" : [ -1.4948717600000001, 53.68926664 ],
"type" : "Point"
},
"properties" : { "Colour" : "#ffffff",
"ImageURL" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxOB2zEbsioye4aA-sT560tnsVPe4afwif5tp90zv1U2rVamtKKCvbk1HD",
"titolo" : "Titolo punto 3",
"picture" : "http://static.panoramio.com/photos/large/103131489.jpg",
"url_post" : "http://www.panoramio.com/photo/84217907"
},
"type" : "Feature"
}
], "type" : "FeatureCollection" }';
fwrite($fh, $stringData);
fclose($fh);

?>
<br>
---<br>
FINE ELENCO POST CON COORDINATE<hr>

<?php /* FINE PARTE CREAZIONE FILE JSON */ ?>


<style type="text/css">
    #map {
        width: 100%;
        height: 100%;
        border: 1px solid #00BFFF;
        background-color: #fff;
    }
</style>

<script type="text/javascript">
            
    var map;
    var lon = 9.180763,
        lat = 45.477369,
        zoom = 10,
        epsg4326 = new OpenLayers.Projection('EPSG:4326'),
        epsg900913 = new OpenLayers.Projection('EPSG:900913');
    var layer, markers;
    var currentPopup;

// function INIT -START
function init(){
    
    var option = {
                projection: new OpenLayers.Projection("EPSG:900913"),
                displayProjection: new OpenLayers.Projection("EPSG:4326")
            };
            
        map = new OpenLayers.Map('map', option);

        /* MAPPA OPENNSTREETMAP standard
* olmapnik = new OpenLayers.Layer.OSM("OpenStreetMap Mapnik", "http://tile.openstreetmap.org/${z}/${x}/${y}.png", {layers: 'basic'} );
*/
         
        // MAPPA OPENNSTREETMAP OpenCycleMap
        olmapnik = new OpenLayers.Layer.OSM("OpenCycleMap",
            ["http://a.tile.opencyclemap.org/cycle/${z}/${x}/${y}.png",
            "http://b.tile.opencyclemap.org/cycle/${z}/${x}/${y}.png",
            "http://c.tile.opencyclemap.org/cycle/${z}/${x}/${y}.png"]
        );

        // Variabili per disegnare i POI -START
        var context = {
            getColor: function(feature) {
                return feature.attributes['Colour'];
            },
            getImageURL: function(feature) {
                return feature.attributes['ImageURL'];
            },
            getLabel: function(feature) {
                return feature.attributes['Label'];
            }
        };

        var template = {
            externalGraphic: "${getImageURL}",
            pointRadius: 50,
            strokeWidth: 50,
            strokeColor: "${getColor}"
        };
        
        var style = new OpenLayers.Style(template, { context: context });
        // Variabili per disegnare i POI -END
        
        // Carica le geometrie da un file JSON -START
        var layer = new OpenLayers.Layer.Vector("GeoJSON", {
            projection: epsg4326,
            /* ALTERNATIVA
* strategies: [new OpenLayers.Strategy.Fixed()],
*/
            strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
            protocol: new OpenLayers.Protocol.HTTP({
                // FILE JSON
                //url: "json/map1.json",
                url: "json/textfile.json",
                format: new OpenLayers.Format.GeoJSON()
            })
        });
        
        layer.styleMap = new OpenLayers.StyleMap(style);
        // Carica le geometrie da un file JSON -END
       
        // Quali layer aggiungere
        map.addLayers([olmapnik, layer]);
        
        // Definizione del centro e dello zoom della mappa (definite all'inizio dello script
        map.setCenter(new OpenLayers.LonLat(lon, lat).transform(epsg4326, epsg900913), zoom);


        // Interaction; not needed for initial display
        selectControl = new OpenLayers.Control.SelectFeature(layer);
        map.addControl(selectControl);
        selectControl.activate();
        layer.events.on({
            'featureselected': onFeatureSelect,
            'featureunselected': onFeatureUnselect
        });
}
// function INIT -END

// Needed only for interaction, not for the display -START

// FUNCTION A1 -START
function onPopupClose(evt) {
    // 'this' is the popup.
    var feature = this.feature;
    if (feature.layer) {
        // The feature is not destroyed
        selectControl.unselect(feature);
    } else {
        // After "moveend" or "refresh" events on POIs layer all
        // features have been destroyed by the Strategy.BBOX
        this.destroy();
    }
}
// FUNCTION A1 -END

// FUNCTION A2 -START
function onFeatureSelect(evt) {
    feature = evt.feature;
    popup = new OpenLayers.Popup.FramedCloud("featurePopup",
        feature.geometry.getBounds().getCenterLonLat(),
        new OpenLayers.Size(100,100),
        // Cosa appare nel popup -START
        "<a href='"+feature.attributes.url_post+"'>" +
            "<b>"+feature.attributes.titolo + "</b>" +
        "</a>" +
        "<br>" +
        "<img src='" + feature.attributes.picture + "' style='width:350px;height:auto;'>"
        ,
        // Cosa appare nel popup -END
        null, true, onPopupClose
    );
    feature.popup = popup;
    popup.feature = feature;
    map.addPopup(popup, true);
}
// FUNCTION A2 -END

// FUNCTION A3 -START
function onFeatureUnselect(evt) {
    feature = evt.feature;
    if (feature.popup) {
        popup.feature = null;
        map.removePopup(feature.popup);
        feature.popup.destroy();
        feature.popup = null;
    }
}
// FUNCTION A3 -END

// Needed only for interaction, not for the display -END

</script>
        <table width='100%'>
            <tr>
                <td align='center'>
                    <div id='map' style='width:800px;height:800px;'></div>
                </td>
            </tr>
        </table>
        
<?php /* FINE MODIFICA PJH */ ?>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->

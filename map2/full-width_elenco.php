<?php
/**
 * Template Name: Full Width Page ELENCO
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
        
        
        
<article id="post-7" class="post-7 page type-page status-publish hentry">
<div class="entry-content">
TITOLO PJHOOKER<br>
---<br>
INIZIO ELENCO POST CON COORIDNATE<br>
<br>
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

$stringData = '    { "geometry" : { 
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


$stringData = '    { "geometry" : {
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
FINE LENCO POST CON COORDINATE<br>
</div><!-- .entry-content -->
</article>
        
        
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();

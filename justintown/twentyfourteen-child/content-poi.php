<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php

$user_ID = get_current_user_id();
$user_info = get_userdata($user_ID);
$postid = get_the_ID();
$img1=get_field('immagine_evidenza'); 
$short=wp_get_shortlink(); 

$location = get_field('map');
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng']; 
$address=$location['address'];
endif; // lat lng
?> 
<?php
//$img1=get_field('immagine_evidenza');
$user = wp_get_current_user();
$allowed_roles = array('editor', 'administrator', 'author');
if( array_intersect($allowed_roles, $user->roles ) ) { 
	echo "in editig<hr>";
	crea_geojson_poi_schedapoi();
	crea_geojson_poi_schedapoi_singolo($postid);
	//sezione_galleria($postid);
	if ($img1==NULL) {}
	else {
		crea_thumb($img1);
	}
	//the_meta();
	view_meta_post($postid);
	if(get_field('nome_manuale'==0)){
		$field_value=get_comune($address);
		$field_key = "nome_comune";
	    update_field( $field_key, $field_value);
	}
	else{}

} // IF EDITNG --STOP
else
{
	crea_geojson_poi_schedapoi_singolo($postid);
} // ELSE EDITNG --STOP

?>
<article <?php post_class(); ?>>
	<?php twentyfourteen_post_thumbnail(); ?>

	<header class="entry-header">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && twentyfourteen_categorized_blog() ) : ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>
		</div>
		<?php
			endif;

			if ( is_single() ) :
				the_title( "<div class='blog-header'><h1 class='blog-title'>", "</h1></div>" );
			else :
				the_title( "<div class='blog-header'><h1 class='blog-title'><a href='" . esc_url( get_permalink() ) . "'' rel='bookmark'>", "</h1></div>" );
			endif;
		?>

		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() )
					twentyfourteen_posted_on();

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyfourteen' ), __( '1 Comment', 'twentyfourteen' ), __( '% Comments', 'twentyfourteen' ) ); ?></span>
			<?php
				endif;

				edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) { ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?> 
	</div><!-- .entry-summary -->
	<?php }
	else if ( is_single() ) { ?>

	<div class="entry-content">
         
<script type='text/javascript' src='http://www.cityplanner.it/valleolona/php/bootstrap-lightbox/bootstrap-lightbox.js'></script>
<!--<script type='text/javascript' src='http://www.monferratopaesaggi.org/php/bootstrap-lightbox/bootstrap-lightbox.min.js'></script>-->
<link rel='stylesheet' href='http://www.cityplanner.it/valleolona/php/bootstrap-lightbox/bootstrap-lightbox.css'  media='all' />
<!--<link rel='stylesheet' href='http://www.monferratopaesaggi.org/php/bootstrap-lightbox/bootstrap-lightbox.min.css'  media='all' />-->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<style>
.thumbnail.with-caption {
display: inline-block;
background: #f5f5f5;
}
.thumbnail.with-caption p {
margin: 0;
padding-top: 0.5em;
}
.thumbnail.with-caption small:before {
content: '\2014 \00A0';
}
.thumbnail.with-caption small {
width: 100%;
text-align: right;
display: inline-block;
color: #999;
}
</style>
<?php
if ($img1==NULL){}
else if ($img1==''){}
else {	

	$fonte_opera = get_field('fonte_opera');
	
	echo"<a href='$fonte_opera'><img style='margin-top:10px;' src='";
	return_thumb_main($img1);
	echo"' height='auto' width='100%'></a>";
	echo"
	    <div style='background-color:#CCCCCC;padding:5px;margin-bottom:10px;font-size:12px;text-align:center;border:1px solid #5b5b5b;'><p>
	";
	$titolo_opera = get_field('titolo_opera');
	if ($titolo_opera==NULL){}
	else{echo"$titolo_opera ";} 

	$licenza = get_field('licenza');
	if ($titolo_opera=='nd'){echo"Licenza non definita<br>";}
	else{echo"$licenza<br>";} 

	$nome_autore = get_field('nome_autore');
	if ($nome_autore==NULL){}
	else{
		$url_autore = get_field('url_autore');
		if ($url_autore==NULL){echo"$nome_autore ";}
		else{echo"<a href='$url_autore'>$nome_autore</a> ";}
		
	} 

	$tipo_opera = get_field('tipo_opera');
	if ($tipo_opera==NULL){}
	else{echo"$tipo_opera ";} 

	
	if ($fonte_opera==NULL){}
	else{echo"<a href='$fonte_opera'>Link a fonte opera</a>";} 

	echo"</p></div>
	";
}
?>
		<?php
			$wiki_url = get_field('wiki_url');
			if ($wiki_url==NULL){}
			else{echo "<a href='$wiki_url'>Da Wikipedia, l'enciclopedia libera</a>";}
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) );
			if ($wiki_url==NULL){}
			else{echo "[<a href='$wiki_url'>...</a>]<hr>";}
	?>	
		<?php
			$osmid = get_field('osmid');
			if ($osmid==NULL){}
			else{
				$osmmaintype = get_field('osmmaintype');
				$osmmainvalue = get_field('osmmainvalue');
				echo "<i class='fa fa-heart-o'></i> <a href='http://www.openstreetmap.org/$osmid'>vedi oggetto su OSM: $osmid $osmmaintype=$osmmainvalue</a><br>";
			}
	?>		



<?php

echo "
	<i class='fa fa-map-marker'></i> Coordinate $lat, $lng 
	<br>
";
$nome_comune=get_field('nome_comune');
echo "<img src='http://www.sjjb.co.uk/mapicons/png/amenity_public_building.p.32.png' width='20px'> <a href='http://www.cityplanner.it/valleolona/?s=$nome_comune'>$nome_comune</a>";
echo "
	<br>
	Short link: <a href='$short'>$short</a>
	<br>
";
?>

<div id="map" class="smallmap"></div>
    <style type="text/css">
        #map {
            width: 100%;
            height: 500px;
            border: 1px solid #5b5b5b;
            background-color: #fff;
    }
    </style>
<?php


?>

<script src='http://www.cityplanner.it/valleolona/js/mappa_scheda_poi_black.js'></script>
<script type="text/javascript">
    var lon = <?php echo $lng; ?>,
    lat = <?php echo $lat; ?>
</script>

<?php
/* 
 * NEW MAP STOP 
 * MOD PJH --- STOP
*/ 

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php }
	else {} ?>


	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->


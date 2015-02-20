<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'parent-style' ) );
}

function test(){

}

function view_meta_post($ID){
  $key="view_meta";
  $value=get_post_meta($ID,$key,true);
  if ($value==1){
	echo"
		<article class='post type-post status-publish format-standard hentry category-evento'>
			<div class='entry-content'>
			    <h3 class='panel-title'>Meta()</h3>
	";
	the_meta();
	echo"
	    	</div>
	    </article>
	";
  }
  else {

  }
}

function tipo_icon($TIPO){
	if ($TIPO=='blue'){return 'http://www.sjjb.co.uk/mapicons/png/poi_point_of_interest.p.32.png';}
	else if ($TIPO=='archaeological_site'){return 'http://www.sjjb.co.uk/mapicons/png/tourist_archaeological2.n.32.png';}
	else if ($TIPO=='natural_tree'){return 'http://wiki.openstreetmap.org/w/images/7/7b/Tree_broad-leafed.png';}
	else if ($TIPO=='drinking_water'){return 'http://wiki.openstreetmap.org/w/images/thumb/8/88/Osmarender_drinking_water.svg/120px-Osmarender_drinking_water.svg.png';}
	else if ($TIPO=='path'){return 'http://www.sjjb.co.uk/mapicons/png/transport_walking.p.32.png';}
	else if ($TIPO=='place_of_worship'){return 'http://www.sjjb.co.uk/mapicons/png/place_of_worship_christian.n.32.png';}
	else if ($TIPO=='watermill'){return 'http://www.sjjb.co.uk/mapicons/png/tourist_waterwheel.n.32.png';}
	else if ($TIPO=='historic_railway'){return 'http://www.sjjb.co.uk/mapicons/png/tourist_steam_train.p.32.png';}
	else if ($TIPO=='bridge'){return 'http://www.sjjb.co.uk/mapicons/png/poi_mountain_pass.p.32.png';}
	else if ($TIPO=='residential'){return 'http://www.sjjb.co.uk/mapicons/png/amenity_public_building.p.32.png';}
	else {$TIPO='none';return 'http://www.sjjb.co.uk/mapicons/png/poi_point_of_interest.p.32.png';}
}

function crea_geojson_poi_schedapoi() {

//crea JSON
$myFile = "./geodata/exp_ptluoghi.js"; //home
$myFile_bl = "./geodata/bootleaf_poi.geojson"; //bootleaf
$myFile_blevent = "./geodata/bootleaf_event.geojson"; //bootleaf

$fh = fopen($myFile, 'w') or die("can't open file");
$fh_bl = fopen($myFile_bl, 'w') or die("can't open file");
$fh_blevent = fopen($myFile_blevent, 'w') or die("can't open file");

$stringData = 'var exp_ptluoghi = {
	"type": "FeatureCollection",
	"crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },                                                                     
	"features": [';
fwrite($fh, $stringData);

$stringData_bl = '{ "features" : [ ';
fwrite($fh_bl, $stringData_bl);

$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 2, post_status => 'publish'));
$count_poi=0;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();


// TITOLO
$title=get_the_title();
$title = str_replace('"', '', $title);
$plink=get_permalink();
$postid = get_the_ID();


// prende le coordinate dal meta 'map'
$location = get_field('map');
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng']; 
endif; // lat lng

	$tipo = get_field('tipo_poi');
	if ($tipo=='blue'){$tipo='none';$iconurl=tipo_icon($tipo);$tipoIcon='wht_blank';}
	else if ($tipo=='archaeological_site'){$iconurl=tipo_icon($tipo);$tipoIcon='grn_stars';}
	else if ($tipo=='natural_tree'){$iconurl=tipo_icon($tipo);$tipoIcon='grn_stars';}
	else if ($tipo=='drinking_water'){$iconurl=tipo_icon($tipo);$tipoIcon='grn_stars';}
	else if ($tipo=='path'){$iconurl=tipo_icon($tipo);$tipoIcon='grn_stars';}
	else if ($tipo=='place_of_worship'){$iconurl=tipo_icon($tipo);$tipoIcon='grn_stars';}
	else if ($tipo=='watermill'){$iconurl=tipo_icon($tipo);$tipoIcon='grn_stars';}
	else if ($tipo=='historic_railway'){$iconurl=tipo_icon($tipo);$tipoIcon='grn_stars';}
	else if ($tipo=='bridge'){$iconurl=tipo_icon($tipo);$tipoIcon='grn_stars';}
	else if ($tipo=='residential'){$iconurl=tipo_icon($tipo);$tipoIcon='grn_stars';}
	else {$tipo='none';$iconurl=tipo_icon($tipo);}

if ($lat==NULL){}
else if ($lat==0){}
else{

	$count_poi++;

	if($count_poi==1){$comma='';}
	else {$comma=', ';}

	$stringData = $comma.' 
			{ 
				"type": "Feature", 
				"properties": { 
					"color_qgis2leaf": "#ed8faf", "radius_qgis2leaf": 4.0, "borderColor_qgis2leaf": "#000000", 
					"transp_qgis2leaf": 1.0, "transp_fill_qgis2leaf": 1.0, "id": "'.$plink.'", "title": "'.$title.'" , "icon_exp": "'.$iconurl.'" 
				}, 
				"geometry": {
					"type": "Point", "coordinates": [ '.$lng.','.$lat.'  ] 
				} 
			}	
	';
	fwrite($fh, $stringData);

	$stringData_bl = $comma.' 
		{ 
			"geometry" : { "coordinates" : ['.$lng.','.$lat.' ],"type" : "Point"},
	        "properties" : { 
	        	"Colour" : "#ffffff", "picture":"http://cdn.slidesharecdn.com/ss_thumbnails/just-in-time-1229329097411768-2-thumbnail-4.jpg",
	        	"ADRESS1":"-","ADRESS2":"none","TEL":"Just in TOWN","URL":"'.$plink.'",
	        	"NAME":"'.$title.'","titolo":"'.$title.'","url_post":"'.$plink.'",
	            "icon_exp": "'.$iconurl.'"
	        },
	        "type" : "Feature"
	    }
	';
	fwrite($fh_bl, $stringData_bl);

}


endwhile;
// Reset Post Data
wp_reset_postdata();

$stringData = '
	]
}
';
fwrite($fh, $stringData);

$stringData_bl = '
	],"type" : "FeatureCollection"}
';
fwrite($fh_bl, $stringData_bl);

fclose($fh);
fclose($fh_bl);

// crea geometrie eventi

$stringData_blevent = '{ "features" : [ ';
fwrite($fh_blevent, $stringData_blevent);

$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 12, post_status => 'publish'));
$count_poi=0;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();


// TITOLO
$title=get_the_title();
$title = str_replace('"', '', $title);
$plink=get_permalink();
$postid = get_the_ID();
$poi_id = get_field('poi_id');

$date_start = get_field('date_start');
$date_stop = get_field('date_stop');

// prende le coordinate dal meta 'map'
$location = get_field('map',$poi_id);
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng']; 
endif; // lat lng


			if($date_start==NULL){}
			else{
				//for uman
				$data_inizio = DateTime::createFromFormat('Ymd',$date_start);
				//$data_inizio=$data_inizio->format( 'l j F' );
				$data_fine = DateTime::createFromFormat('Ymd',$date_stop);
				//$data_fine=$data_fine->format( 'l j F' );			

				$format_in = 'Ymd'; // the format your value is saved in (set in the field options)
				$format_out = 'Y-m-d'; // the format you want to end up with			

				$date = DateTime::createFromFormat($format_in,$date_start);
				$date=$date->format( $format_out );

				date_default_timezone_set('Europe/Berlin');

				// birthdate format is YYYY-MM-DD
				$birth = new DateTime($date);
				$today = new DateTime();
			}

			if($date_start==NULL){}
			else{
				if($birth<$today){

				}
				else {
					if ($lat==NULL){}
					else if ($lat==0){}
					else{

						$count_poi++;

						if($count_poi==1){$comma='';}
						else {$comma=', ';}

						$stringData_blevent = $comma.' 
							{ 
								"geometry" : { "coordinates" : ['.$lng.','.$lat.' ],"type" : "Point"},
						        "properties" : { 
						        	"Colour" : "#ffffff", "picture":"http://cdn.slidesharecdn.com/ss_thumbnails/just-in-time-1229329097411768-2-thumbnail-4.jpg",
						        	"ADRESS1":"-","ADRESS2":"none","TEL":"Just in TOWN","URL":"'.$plink.'",
						        	"NAME":"'.$title.'","titolo":"'.$title.'","url_post":"'.$plink.'",
						            "ImageURL" : "http://openclipart.org/image/300px/svg_to_png/188330/tree-mappin-by-pjhooker.png",';

						if ($date_stop==NULL){$stringData_blevent.='"data" : "'.$date_start.'", "data_stop" : "'.$date_start;}
						else{$stringData_blevent.='"data" : "'.$date_start.'", "data_stop" : "'.$date_stop;}

						$stringData_blevent.='"
						        },
						        "type" : "Feature"
						    }
						';
						fwrite($fh_blevent, $stringData_blevent);

					}					
				}
			}




endwhile;
// Reset Post Data
wp_reset_postdata();

$stringData_blevent = '
	],"type" : "FeatureCollection"}
';
fwrite($fh_blevent, $stringData_blevent);

fclose($fh_blevent);

}

function rename_post_formats( $safe_text ) {
    if ( $safe_text == 'Link' )
        return 'Tip';

    return $safe_text;
}
add_filter( 'esc_html', 'rename_post_formats' );

//rename Aside in posts list table
function live_rename_formats() { 
    global $current_screen;

    if ( $current_screen->id == 'edit-post' ) { ?>
        <script type="text/javascript">
        jQuery('document').ready(function() {

            jQuery("span.post-state-format").each(function() { 
                if ( jQuery(this).text() == "Link" )
                    jQuery(this).text("Tip");             
            });

        });      
        </script>
<?php }
}
add_action('admin_head', 'live_rename_formats');



function get_event_poi($postid){
$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 12, post_status => 'publish','meta_key' => 'poi_id' ,'meta_value' => $postid));
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();


// TITOLO
$title=get_the_title();
$title = str_replace('"', '', $title);
$plink=get_permalink();
$date_start=get_field('date_start');

	if ($date_start >= date('Ymd',time())){

	echo"
	            <a href='$plink' class='list-group-item' style='font-size:12px;border-bottom: 1px solid #333;'>$title $date_start</a> 
	";
	}else{}

endwhile;
// Reset Post Data
wp_reset_postdata();
}


define( 'ACF_LITE', true );
include_once('advanced-custom-fields/acf.php');


function my_pre_save_post( $post_id ) {

    // check if this is to be a new post
    if( $post_id != 'new' )
    {
        return $post_id;
    }

    // Create a new post
    $post = array(
        'post_status'  => 'private',
        'post_title'  => 'Nuovo iscritto',
        'post_type'  => 'post',
        'post_category' => array(14),

    );

    // insert the post
    $post_id = wp_insert_post( $post, $wp_error  );


    //now you can use $post_id withing add_post_meta or update_post_meta
    //add_post_meta( $post_id, 'template', 'commento' );
    //add_post_meta( $post_id, 'commento_to_id', $_POST['fields']['field_54c2683d5ac91'] );


    // update $_POST['return']
    $_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );

    // return the new ID
    //
    
    return $post_id;
    echo '<script type="text/javascript">alert("Grazie per esserti iscritto"); </script>';
}

add_filter('acf/pre_save_post' , 'my_pre_save_post' );

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_immagine-evidenza',
		'title' => 'immagine evidenza',
		'fields' => array (
			array (
				'key' => 'field_535a359daaf94',
				'label' => 'immagine_evidenza',
				'name' => 'immagine_evidenza',
				'type' => 'text',
				'instructions' => 'Questa immagine (unica) verrà visualizzata sia nella testata dell\'articolo, sia nel popup sulla mappa. NOTA: Non è necessario inserire l\'immagine in evidenza qui a destra.',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5444fff1707ba',
				'label' => 'titolo opera',
				'name' => 'titolo_opera',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54450021707bb',
				'label' => 'licenza',
				'name' => 'licenza',
				'type' => 'radio',
				'choices' => array (					
					'Google plus' => 'Google plus',
					'Facebook' => 'Facebook',
					'Instagram' => 'Instagram',
					'nd' => 'nd',
					'CC BY-NC 4.0' => 'CC BY-NC 4.0',
					'CC BY-SA 4.0' => 'CC BY-SA 4.0',
					'CC BY-SA 3.0' => 'CC BY-SA 3.0',
					'CC BY-SA 2.5' => 'CC BY-SA 2.5',
					'CC BY-SA 2.0' => 'CC BY-SA 2.0',
					'yelp' => 'yelp',
					'instagram' => 'instagram',
					'cc_a_share' => 'cc_a_share',
					'google' => 'google',
					'facebook' => 'facebook',
					'Pubblico dominio' => 'Pubblico dominio',
					'nessuno' => 'nessuno',
					
				),
				'other_choice' => 1,
				'save_other_choice' => 1,
				'default_value' => 'nd',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_54450073707bc',
				'label' => 'Nome autore',
				'name' => 'nome_autore',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5445009d707bd',
				'label' => 'url autore',
				'name' => 'url_autore',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_544500a8707be',
				'label' => 'tipo opera',
				'name' => 'tipo_opera',
				'type' => 'radio',
				'choices' => array (
					'opera propria' => 'opera propria',
					'opera derivata' => 'opera derivata',
				),
				'other_choice' => 1,
				'save_other_choice' => 1,
				'default_value' => 'opera propria',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_54453ea7ffabc',
				'label' => 'fonte opera',
				'name' => 'fonte_opera',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '5',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'featured_image',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_location',
		'title' => 'Location',
		'fields' => array (
			array (
				'key' => 'field_5451408e9c0c7',
				'label' => 'Map',
				'name' => 'map',
				'type' => 'google_map',
				'center_lat' => '44.5461',
				'center_lng' => '7.7235',
				'zoom' => '15',
				'height' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '5',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '4',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '6',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '5',
					'order_no' => 0,
					'group_no' => 3,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_poi-scheda',
		'title' => 'POI scheda',
		'fields' => array (
			array (
				'key' => 'field_54538e89858bc',
				'label' => 'tipo_poi',
				'name' => 'tipo_poi',
				'type' => 'radio',
				'choices' => array (
					'archaeological_site' => 'archaeological_site',
					'nd' => 'nd',
					'drinking_water' => 'drinking_water',
					'natural_tree' => 'natural_tree',
					'place_of_worship' => 'place_of_worship',
					'watermill' => 'watermill',
					'historic_railway' => 'historic_railway',
					'bridge'=>'bridge',
					'path' => 'path',
					'residential' => 'residential',
				),
				'other_choice' => 1,
				'save_other_choice' => 1,
				'default_value' => 'nd',
				'layout' => 'horizontal',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '5',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_post-template',
		'title' => 'Post template',
		'fields' => array (
			array (
				'key' => 'field_545131a6e123c',
				'label' => 'Template',
				'name' => 'template',
				'type' => 'radio',
				'choices' => array (
					'default' => 'default',
					'poi' => 'poi',
					'evento' => 'evento',
					'comune' => 'comune',
					'percorso' => 'percorso',
					'bootleaf' => 'bootleaf',
				),
				'other_choice' => 1,
				'save_other_choice' => 1,
				'default_value' => 'default',
				'layout' => 'horizontal',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_view-meta',
		'title' => 'view meta',
		'fields' => array (
			array (
				'key' => 'field_54537383257a5',
				'label' => 'view_meta',
				'name' => 'view_meta',
				'type' => 'radio',
				'choices' => array (
					0 => 0,
					1 => 1,
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 0,
				'layout' => 'horizontal',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_wikipedia',
		'title' => 'Wikipedia',
		'fields' => array (
			array (
				'key' => 'field_nome_comune',
				'label' => 'nome_comune',
				'name' => 'nome_comune',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),	
			array (
				'key' => 'field_nome_manuale',
				'label' => 'nome_manuale',
				'name' => 'nome_manuale',
				'type' => 'radio',
				'choices' => array (
					0 => 0,
					1 => 1,
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 0,
				'layout' => 'horizontal',
			),					
			array (
				'key' => 'field_5454319d4225e',
				'label' => 'wiki_nome',
				'name' => 'wiki_nome',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_545431a94225f',
				'label' => 'wiki_url',
				'name' => 'wiki_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_osmid',
				'label' => 'osmid',
				'name' => 'osmid',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),	
			array (
				'key' => 'field_osmmaintype',
				'label' => 'osmmaintype',
				'name' => 'osmmaintype',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),	
			array (
				'key' => 'field_osmmainvalue',
				'label' => 'osmmainvalue',
				'name' => 'osmmainvalue',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),									
		),
		'location' => array (
			array (
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '5',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	register_field_group(array (
		'id' => 'acf_evento-su-poi',
		'title' => 'Evento su POI',
		'fields' => array (
			array (
				'key' => 'field_54c64769e0d23',
				'label' => 'poi_id',
				'name' => 'poi_id',
				'type' => 'post_object',
				'post_type' => array (
					0 => 'post',
				),
				'taxonomy' => array (
					0 => 'category:5', //categoria POI
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_54c64791e0d24',
				'label' => 'date_start',
				'name' => 'date_start',
				'type' => 'date_picker',
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),
			array (
				'key' => 'field_54c647a1e0d25',
				'label' => 'date_stop',
				'name' => 'date_stop',
				'type' => 'date_picker',
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),
			array (
				'key' => 'field_54cfd2edb3a94',
				'label' => 'categoria_evento',
				'name' => 'categoria_evento',
				'type' => 'radio',
				'choices' => array (
					'nd' => 'nd',
					'manifestazioni' => 'manifestazioni',
					'musica' => 'musica',
					'cultura' => 'cultura',
					'sport' => 'sport',
					'enogastronomia' => 'enogastronomia',										
				),
				'other_choice' => 1,
				'save_other_choice' => 1,
				'default_value' => '',
				'layout' => 'horizontal',
			),	

			array (
				'key' => 'field_54d36b50b082b',
				'label' => 'Allega documento',
				'name' => 'allega_documento',
				'type' => 'file',
				'save_format' => 'url',
				'library' => 'all',
			),		
			array (
				'key' => 'field_54d38a3020ccf',
				'label' => 'time_start',
				'name' => 'time_start',
				'type' => 'select',
				'choices' => array (
					'tutto il giorno' => 'tutto il giorno',
					'dalla notte al mattino' => 'dalla notte al mattino',
					'dal mattino alla sera' => 'dal mattino alla sera',
					'tutta la notte' => 'tutta la notte',
					'06:00' => '06:00',
					'06:30' => '06:30',
					'07:00' => '07:00',
					'07:30' => '07:30',
					'08:00' => '08:00',
					'08:30' => '08:30',
					'09:00' => '09:00',
					'09:30' => '09:30',
					'10:30' => '10:00',
					'10:00' => '10:30',
					'11:00' => '11:00',
					'11:30' => '11:30',
					'12:00' => '12:00',
					'12:30' => '12:30',
					'13:00' => '13:00',
					'13:30' => '13:30',
					'14:00' => '14:00',
					'14:30' => '14:30',
					'15:00' => '15:00',
					'15:30' => '15:30',
					'16:00' => '16:00',
					'16:30' => '16:30',
					'17:00' => '17:00',
					'17:30' => '17:30',
					'18:00' => '18:00',
					'18:30' => '18:30',
					'19:00' => '19:00',
					'19:30' => '19:30',
					'20:00' => '20:00',
					'20:30' => '20:30',
					'21:00' => '21:00',
					'21:30' => '21:30',
					'22:00' => '22:00',
					'22:30' => '22:30',
					'23:00' => '23:00',
					'23:30' => '23:30',
					'24:00' => '24:00',					
					'01:00' => '01:00',
					'02:00' => '02:00',
					'03:00' => '03:00',
					'04:00' => '04:00',
					'05:00' => '05:00',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_54d38aa020cd0',
				'label' => 'time_stop',
				'name' => 'time_stop',
				'type' => 'select',
				'choices' => array (
					'06:00' => '06:00',
					'06:30' => '06:30',
					'07:00' => '07:00',
					'07:30' => '07:30',
					'08:00' => '08:00',
					'08:30' => '08:30',
					'09:00' => '09:00',
					'09:30' => '09:30',
					'10:30' => '10:00',
					'10:00' => '10:30',
					'11:00' => '11:00',
					'11:30' => '11:30',
					'12:00' => '12:00',
					'12:30' => '12:30',
					'13:00' => '13:00',
					'13:30' => '13:30',
					'14:00' => '14:00',
					'14:30' => '14:30',
					'15:00' => '15:00',
					'15:30' => '15:30',
					'16:00' => '16:00',
					'16:30' => '16:30',
					'17:00' => '17:00',
					'17:30' => '17:30',
					'18:00' => '18:00',
					'18:30' => '18:30',
					'19:00' => '19:00',
					'19:30' => '19:30',
					'20:00' => '20:00',
					'20:30' => '20:30',
					'21:00' => '21:00',
					'21:30' => '21:30',
					'22:00' => '22:00',
					'22:30' => '22:30',
					'23:00' => '23:00',
					'23:30' => '23:30',
					'24:00' => '24:00',					
					'01:00' => '01:00',
					'02:00' => '02:00',
					'03:00' => '03:00',
					'04:00' => '04:00',
					'05:00' => '05:00',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),


		),
		'location' => array (
			array (
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '3', // categoria EVENTO
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));




	register_field_group(array (
		'id' => 'acf_field-segnalazione-tree',
		'title' => 'field - segnalazione tree',
		'fields' => array (
			array (
				'key' => 'field_53a57c221609a',
				'label' => 'osm_node',
				'name' => 'osm_node',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53b7239e50745',
				'label' => 'osm id',
				'name' => 'osm_id',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53a57e83c636b',
				'label' => 'Autore nome',
				'name' => 'autore_nome',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_543bcaaa4248f',
				'label' => 'Autore luogo',
				'name' => 'autore_luogo',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53a57e8dc636c',
				'label' => 'Autore link',
				'name' => 'autore_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53b72287acea2',
				'label' => 'Tipo albero',
				'name' => 'tipo_albero',
				'type' => 'radio',
				'choices' => array (
					'nd' => 'non identificato',
					'quercia' => 'quercia',
					'faggio' => 'faggio',
					'castagno' => 'castagno',
					'platano' => 'platano',
					'Gelso' => 'Gelso',
					'Ginko biloba' => 'Ginko biloba',
					'Cedro' => 'Cedro',
					'Salice' => 'Salice',
				),
				'other_choice' => 1,
				'save_other_choice' => 1,
				'default_value' => 'nd',
				'layout' => 'horizontal',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '8',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'discussion',
				1 => 'comments',
				2 => 'revisions',
				3 => 'slug',
				4 => 'author',
				5 => 'format',
				6 => 'featured_image',
				7 => 'send-trackbacks',
			),
		),
		'menu_order' => 10,
	));


	register_field_group(array (
		'id' => 'acf_comment',
		'title' => 'Comment',
		'fields' => array (
			array (
				'key' => 'field_54c24b04bf8d8',
				'label' => 'Indirizzo email',
				'name' => 'contatto',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),			
			array (
				'key' => 'field_54c22a75282c9',
				'label' => 'Nickname',
				'name' => 'nickname',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'Scrivi qui ...',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_luogo_form',
				'label' => 'Luogo',
				'name' => 'luogo',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'Fossano ...',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),			
			array (
				'key' => 'field_54c22a82282ca',
				'label' => 'Interessato a:',
				'name' => 'tipo',
				'type' => 'radio',
				'choices' => array (
					'notizie' => 'Ricevere notizie',
					'contenuti' => 'Inserire contenuti',
					'team' => 'Fare parte del Team JIT',
				),
				'other_choice' => 1,
				'save_other_choice' => 1,
				'default_value' => 'notizie',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_privacy_regole',
				'label' => 'Accetti le nostre norme di privacy e il regolamento (vedi link sotto)',
				'name' => 'tipo',
				'type' => 'radio',
				'choices' => array (
					'accetto' => 'Accetto',
					'non_accetto' => 'Non accetto',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'accetto',
				'layout' => 'horizontal',
			),			
		),
		'location' => array (
			array (
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '4',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));



	register_field_group(array (
		'id' => 'acf_filed-segnalazione-tutti',
		'title' => 'filed - segnalazione (tutti)',
		'fields' => array (
			array (
				'key' => 'field_53d68c3390687',
				'label' => 'Url sorgente (fonte) pagina_sorgente',
				'name' => 'pagina_sorgente',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53d68c6590688',
				'label' => 'Immagine principale (url) img1',
				'name' => 'img1',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53ed316e66cef',
				'label' => 'Immagine principale source (img1_url)',
				'name' => 'img1_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53ed31bc66cf0',
				'label' => 'Autore immagine',
				'name' => 'autore_immagine',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53e8adb985698',
				'label' => 'url (deprecated)',
				'name' => 'url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53e8adf2ba541',
				'label' => 'img_main (deprecated)',
				'name' => 'img_main',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5412d3b1ca458',
				'label' => 'picture1',
				'name' => 'picture1',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5412d3b7ca459',
				'label' => 'picture2',
				'name' => 'picture2',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5412d3beca45a',
				'label' => 'picture3',
				'name' => 'picture3',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5412d3c3ca45b',
				'label' => 'picture4',
				'name' => 'picture4',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '8',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 20,
	));
}




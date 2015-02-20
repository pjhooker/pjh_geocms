<?php
/**
 * Template Name: Tabella POI
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>



    <div class="container">

      <div class="row">
        <div class="col-sm-8 blog-main">

          <div class="blog-post">
<table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Titolo</th>
                <th>Tipo</th>
              </tr>
            </thead>
            <tbody>
			<?php

$the_query = new WP_Query(array('posts_per_page' => -1));
$count_poi=0;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

$count_poi++;

// TITOLO
$title=get_the_title();
$plink=get_permalink();
$postid = get_the_ID();
$tipo = get_field('tipo_poi');

// prende le coordinate dal meta 'map'
$location = get_field('map');
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng']; 
endif; // lat lng

foreach((get_the_category()) as $category) { 
    $term=$category->cat_ID; 
} 

$procedi=0;


if ($term==6){$procedi=0;}//comune
else if ($term==5){$procedi=0;}//evento
else if ($term==4){$procedi=0;}//percorso
else if ($term==2){$procedi=1;}//poi
else if ($term==8){$procedi=1;}//natural tree
else{$procedi=0;}

if ($procedi==1){
echo"
              <tr>
                <td>$count_poi</td>
                <td><a href='$plink'>$title</a></td>
                <td>$tipo</td>
              </tr>
";
}
else{}

endwhile;
// Reset Post Data
wp_reset_postdata();
			?>
            </tbody>
          </table>			
         </div><!-- /.blog-post -->


        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">

<?php get_sidebar();?>

        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->
<?php
get_footer();

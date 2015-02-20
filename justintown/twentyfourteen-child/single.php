<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
$layout=0;
?>
<?php
// Start the Loop.
while ( have_posts() ) : the_post();

	$template = get_field('template');
	if ($template=='poi'){
		get_header('poi-osm');
	}
	else if ($template=='percorso'){
		get_header('poi-osm');
	}
	else if ($template=='evento'){
		get_header('poi-osm');
	}
	else if ($template=='comune'){
		get_header('poi-osm');
	}	
	else if ($template=='bootleaf'){
	    $template=get_field('custom_bootleaf');
	    get_header('bootleaf');
	    $layout=1;
    } 	
	else{
		get_header();
	}


if($layout==0){
?>
    <div class="container">
      <div class="row">
        <div class="col-sm-8 blog-main">
          <div class="blog-post">
<?php				
					
					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					if ($template=='default'){
					    get_template_part( 'content', get_post_format() );
					}
					else{
						get_template_part( 'content-'.$template, get_post_format() );
					}

					

					// Previous/next post navigation.
					twentyfourteen_post_nav_mod();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					} else{}
				
			?>
         </div><!-- /.blog-post -->

        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">

<?php get_sidebar();?>

        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

<?php
//get_sidebar( 'content' );
//get_sidebar();
get_footer();

}

else{

get_template_part( 'content-'.$template, get_post_format() );

}

endwhile;

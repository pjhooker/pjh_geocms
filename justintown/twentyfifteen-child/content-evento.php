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
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			// Restituisce informazioni luogoevento
			$poi_id = get_field('poi_id');
			$title_luogoevento=get_the_title($poi_id);

			$location = get_field('map',$poi_id);
			if( !empty($location) ):
				$lat= $location['lat'];
				$lng=$location['lng']; 
				$address=$location['address'];
			endif; // lat lng

			echo "Questo evento si terra in: $title_luogoevento (<a href='http://www.openstreetmap.org/#map=18/$lat/$lng'>visualizza mappa</a>)";

			//visualizza date evento
			$date_start = get_field('date_start');
			$date_stop = get_field('date_stop');


			//for uman
			$data_inizio = DateTime::createFromFormat('Ymd',$date_start);
			$data_inizio=$data_inizio->format( 'l j F' );
			$data_fine = DateTime::createFromFormat('Ymd',$date_stop);
			$data_fine=$data_fine->format( 'l j F' );			

			$format_in = 'Ymd'; // the format your value is saved in (set in the field options)
			$format_out = 'Y-m-d'; // the format you want to end up with			

			$date = DateTime::createFromFormat($format_in,$date_start);
			$date=$date->format( $format_out );

			date_default_timezone_set('Europe/Berlin');

			// birthdate format is YYYY-MM-DD
			$birth = new DateTime($date);
			$today = new DateTime();
			$diff = $birth->diff($today);
			$dateday=$diff->format('%d'); // will output giorni
			$datemonth=($diff->format('%m'))*30; // will output giorni da mesi 
			$dateyear=($diff->format('%y'))*365; // will output giorni da anni
			$dday=$dateday+$datemonth+$dateyear;

			if($date_start==NULL){echo "<br>L'evento non è ancora stato programmato.";}
			else{
				if($birth<$today){
					echo"<p>Evento concluso ";
					if ($date_stop==NULL){echo "il $data_inizio.";}
					else{echo "il $data_fine.";}
					echo"</p>";
				}
				else {
					if ($date_stop==NULL){echo "<br>il $data_inizio";}
					else{echo "<br>dal $data_inizio al $data_fine.";}
					if($dday<7){echo"<p><span style='color:red;'>Mancano $dday giorni all'evento</span></p>";}
					else if ($dday<20){echo"<p>Mancano $dday giorni all'evento</p>";}
					else{echo"<p><span class='attivo'>Mancano $dday giorni all'evento</span></p>";}
				}
			}

			

			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'twentyfifteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

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

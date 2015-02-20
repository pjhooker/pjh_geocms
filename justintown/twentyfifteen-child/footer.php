<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

	</div><!-- .site-content -->
	
<div style='position:fixed;bottom: 20px;right: 20px;float:right;'><h2><a data-toggle='modal' data-target='#myModalfoo' class="label label-info">Iscriviti!</a></h2></div>
	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php
				/**
				 * Fires before the Twenty Fifteen footer text for footer customization.
				 *
				 * @since Twenty Fifteen 1.0
				 */
				do_action( 'twentyfifteen_credits' );
			?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentyfifteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentyfifteen' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php
echo"
<div class='modal fade' id='myModalfoo' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog' style='  width: 100%;max-width: 1040px; height: auto;'>
		<div class='modal-content'>
";
//modal header
echo"		
			<div class='modal-header' style='text-align:center;'>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<h4  style='text-align:center;' class='modal-title' id='myModalLabel'>Benvenuto!</h4>
			</div>
";
//modal body
?>
<style type="text/css">
	td {text-align:left;}
</style>
<?php
echo"			
			<div class='modal-body' style='text-align:center;'>
			    <div class='row' style='padding-top:15px;'>
";
?>
					<div class='col-sm-12'>

		<p style='text-align:left;'>Se desideri pubblicare contenuti, aggiungere commenti o semplicemente ricevere le nostre notizie, ti invitiamo ad iscriverti.<br>
		<i>JIT team</i></p>
		<style type="text/css">.label{text-align:left;}</style>

					<?php /* The loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php acf_form(array(
							'post_id'	=> 'new',
							'field_groups'	=> array( 'acf_comment' ),
							'submit_value'	=> 'Iscriviti',
							'return' => 'http://cityplanner.name/justintime/registrazione-avvenuta-con-successo/'
						)); ?>

					<?php endwhile; ?>
		        <a href='http://cityplanner.name/justintime/privacy-e-regolamento/'>Privacy e regolamento</a>
					</div>
				</div>		
<?php			
echo"
			</div>
";
//modal footer
echo"
			<div class='modal-footer'>
			</div>
";
//END modal
echo"			
		</div>
	</div>
</div>
";
?>

<?php wp_footer(); ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>



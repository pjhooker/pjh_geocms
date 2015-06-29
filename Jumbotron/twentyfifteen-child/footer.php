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

<?php wp_footer(); ?>
<footer class="footer">
	<p><?php $site_description = get_bloginfo( 'description' ); echo $site_description; ?></p>
</footer>
	    </div> <!-- /container -->


	    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
	  </body>
	</html>

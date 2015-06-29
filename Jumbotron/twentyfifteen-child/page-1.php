<?php
/**
 * Template Name: Page1 >>
 */
get_header();

// Start the loop.
while ( have_posts() ) : the_post();
?>

      <div class="jumbotron">
        <h1><?php the_title(); ?></h1>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <?php the_content(); ?>
        </div>
      </div>

<?php
// End the loop.
endwhile;
get_footer(); ?>

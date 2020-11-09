<?php
/*
* Template Name: Template page Documentation 
* Template Post Type: page
*/

get_header();
get_sidebar();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

      get_template_part( 'template-parts/content', 'documentation' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<script>
		usersMap();
	</script>

<?php
get_footer();
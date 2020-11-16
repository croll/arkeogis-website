<?php
/*
* Template Name: Page Documentation 
*/

get_header();
?>

<div class="documentation-wrapper">
<?php
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
</div>

<?php
get_footer();
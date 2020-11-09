<?php
/* Template Name: Template page Utilisateurs */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

      get_template_part( 'template-parts/content', 'users' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<script>
		window.onload = function() {
			Beve.usersMap('#usersMap', '<?php echo pll_current_language();?>');
		};
	</script>

<?php
get_footer();
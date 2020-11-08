<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beve
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="landing-block">
			<h1><?php pll_e("Cartographier,  conserver,  étudier, gérer…");?></h1>
			<h2><?php pll_e("ArkeoGIS, partage et utilisation de données spatialisées sur le passé");?></h2>
			<div class="button-container">
				<a href="" target="_blank"><?php pll_e("Ouvrir l’application");?></a>
				<a href="" target="_blank"><?php pll_e("Créer un compte");?></a>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
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
			<div class="main-container">
				<h1><?php pll_e("Cartographier,  conserver,  étudier, gérer…");?></h1>
				<h2><?php pll_e("ArkeoGIS, partage et utilisation de données spatialisées sur le passé");?></h2>
				<div class="button-container">
					<a href="" target="_blank"><?php pll_e("Ouvrir l’application");?></a>
					<a href="" target="_blank"><?php pll_e("Créer un compte");?></a>
				</div>
			</div>
			<div class="logos-container">
				<img class="strasbourg" src="<?php echo get_template_directory_uri().'/assets/images/logos/Universite_de_Strasbourg.jpg';?>" alt="Université de Strasbourg"/>
				<img class="archimede" src="<?php echo get_template_directory_uri().'/assets/images/logos/Archimed.jpg';?>" alt="Archimede"/>
				<img class="misha" src="<?php echo get_template_directory_uri().'/assets/images/logos/Misha.jpg';?>" alt="Misha"/>
				<img class="masa" src="<?php echo get_template_directory_uri().'/assets/images/logos/Masa.jpg';?>" alt="Masa"/>
				<img class="humanum" src="<?php echo get_template_directory_uri().'/assets/images/logos/Humanum.png';?>" alt="Humanum"/>
			</div>
		</div>

		<div class="platform-block">
			<div class="background"></div>
			<div class="gradient"></div>
			<h2><?php pll_e("Plateforme de publication <b>de données scientifiques unifiées</b>");?></h2>
			<div class="video-container">
				<div class="dots-container">
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>
			<div class="specs-container">
				<div class="spec">
					<h3>
						<?php pll_e("Importation  Qualifiée");?>
						<div class="num">01</div>
					</h3>
					<div class="text"><?php pll_e("Importer vos données guidé par l’assistance à la correction en ligne, ajouter les méta-données (DublinCore) et obtenir des données inter-opérable.");?>
					</div>
					<a href="<?php the_permalink(pll_get_post(10));?>" title="<?php pll_e("Importation  Qualifiée");?>"></a>
				</div>
				<div class="spec">
					<h3>
						<?php pll_e("Cartographie Interactive");?>
						<div class="num">02</div>
					</h3>
					<div class="text"><?php pll_e("Quoi ? où ? quand ? par qui ? Découvrir et interroger des datasets spatialisés pluridiciplinaires, pour un état de l’art de la recherche des données partagés...");?></div>
					<a href="<?php the_permalink(pll_get_post(10));?>" title="<?php pll_e("Cartographie Interactive");?>"></a>
				</div>
				<div class="spec">
					<h3>
						<?php pll_e("Exportation Normalisée");?>
						<div class="num">03</div>
					</h3>
					<div class="text"><?php pll_e("Exporter le résultat de votre recherche dans un format normalisé (CSV) pour le ré-utiliser directement dans les outils de votre choix tableur, QGIS, R...");?></div>
					<a href="<?php the_permalink(pll_get_post(10));?>" title="<?php pll_e("Exportation Normalisée");?>"></a>
				</div>
				<div class="spec">
					<h3>
						<?php pll_e("Personnaliser");?>
						<div class="num">04</div>
					</h3>
					<div class="text"><?php pll_e("Un espace personnalisé, pour choisir dans l’ensemble des données mises en commun en 4 langues vos aire, chronologie, langue, bases de données et vos termes de travail");?></div>
					<a href="<?php the_permalink(pll_get_post(10));?>" title="<?php pll_e("Personnaliser");?>"></a>
				</div>
				<div class="spec">
					<h3>
						<?php pll_e("Diffuser");?>
						<div class="num">05</div>
					</h3>
					<div class="text"><?php pll_e("Diffuser le niveau d’information de votre choix, et rendez le accessible dans la communautée d’utilisateurs qualifiés en indiquant comment vous citer");?></div>
					<a href="<?php the_permalink(pll_get_post(10));?>" title="<?php pll_e("Diffuser");?>"></a>
				</div>
				<div class="spec">
					<h3>
						<?php pll_e("Pérenniser");?>
						<div class="num">06</div>
					</h3>
					<div class="text"><?php pll_e("Des identifiants pérennes DOI pour le stokage, des ARK (Archival Resource Key) pour les termes utilisés, un hébergement sécurisé et dupliqué pour une conservation à long terme");?></div>
					<a href="<?php the_permalink(pll_get_post(10));?>" title="<?php pll_e("Pérenniser");?>"></a>
				</div>
			</div>
		</div>
		
	</main><!-- #main -->

<?php
get_footer();
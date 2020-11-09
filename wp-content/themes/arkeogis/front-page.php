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
				<video muted controls>
					<source src="/wp-content/uploads/2020/11/arkeogis_demo.mp4" type="video/mp4">
				</video>
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

		<div class="stats-block">
			<h2><?php pll_e("Arkeogis en quelques chiffres");?></h2>
			<div class="stats-container">
				<div class="stat">
					<svg width="41" height="47" viewBox="0 0 41 47" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M20.0745 0.156738C10.0983 0.156738 0 2.61946 0 7.32621V38.8719C0 43.5787 10.0983 46.0413 20.0745 46.0413C30.0507 46.0413 40.149 43.5786 40.149 38.8719V7.32621C40.149 2.61936 30.0507 0.156738 20.0745 0.156738ZM37.2812 28.8346C37.2812 30.351 30.7482 33.1363 20.0745 33.1363C9.40084 33.1363 2.86779 30.351 2.86779 28.8346V21.2403C6.5726 23.4126 13.3497 24.5328 20.0745 24.5328C26.7994 24.5328 33.5765 23.4126 37.2812 21.2403V28.8346ZM37.2812 17.3635C37.2812 18.8798 30.7482 21.6651 20.0745 21.6651C9.40084 21.6651 2.86779 18.8798 2.86779 17.3635V11.203C6.5726 13.3754 13.3497 14.4956 20.0745 14.4956C26.7994 14.4956 33.5765 13.3754 37.2812 11.203V17.3635ZM20.0745 3.02453C30.7482 3.02453 37.2812 5.80986 37.2812 7.32621C37.2812 8.84256 30.7482 11.6279 20.0745 11.6279C9.40084 11.6279 2.86779 8.84256 2.86779 7.32621C2.86779 5.80986 9.40084 3.02453 20.0745 3.02453ZM20.0745 43.1735C9.40084 43.1735 2.86779 40.3882 2.86779 38.8719V32.7114C6.5726 34.8838 13.3497 36.004 20.0745 36.004C26.7994 36.004 33.5765 34.8838 37.2812 32.7114V38.8719C37.2812 40.3882 30.7482 43.1735 20.0745 43.1735Z" fill="#F4B511"/>
					</svg>
					<div class="num">
						<?php pll_e("Nombre de bases de données");?>
					</div>
					<div class="label">
						<?php pll_e("Bases de données");?>
					</div>
				</div>
				<div class="stat">
					<svg width="55" height="47" viewBox="0 0 55 47" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M54.1234 44.7194L51.2175 22.0487C51.1597 21.5369 50.7614 21.0229 50.2497 20.8516L45.3502 19.0849C44.8941 19.9393 44.4379 20.8516 43.9841 21.706L48.3695 23.3013L50.8749 42.8392L40.4506 39.4795L39.7096 27.9741C39.1979 28.2011 38.6283 28.3168 38.0008 28.3168C37.6026 28.3168 37.1464 28.2589 36.8038 28.1454L37.5447 39.5375L28.4311 42.8416L28.4333 23.1881L32.0778 21.7062L30.7117 19.0851L27.0672 20.6248L17.041 16.4663C16.6984 16.3528 16.3001 16.2949 15.9597 16.4084L3.88471 20.8518C3.37073 21.0231 3.0303 21.4792 2.91684 22.0488L0.0109563 44.7196C-0.0468925 45.2313 0.124432 45.6874 0.522709 46.0301C0.920987 46.3728 1.43498 46.4284 1.88884 46.3149L14.9316 42.1008L26.5503 46.3149C26.893 46.4284 27.2334 46.4284 27.5182 46.3149L39.1369 42.1008L52.1797 46.3149C52.351 46.3728 52.4645 46.3728 52.6358 46.3728C52.9785 46.3728 53.3189 46.2593 53.5481 46.0301C53.9508 45.6875 54.18 45.2314 54.1221 44.7196L54.1234 44.7194ZM13.6236 39.4795L3.20158 42.8392L5.70691 23.3013L14.8786 19.9972L13.6236 39.4795ZM25.5852 42.8392L16.4716 39.5351L17.7243 19.9419L25.5853 23.1882L25.5852 42.8392Z" fill="#F4B511"/>
						<path d="M36.9773 24.7252C37.4334 25.6375 38.744 25.6375 39.1978 24.7252C39.1978 24.7252 44.3821 14.5857 45.5768 12.194C46.7739 9.80209 46.8295 7.12542 45.5768 4.61769C43.5275 0.461364 38.459 -1.19168 34.3004 0.915279C30.1418 3.02235 28.5463 8.20675 30.598 12.194C32.6494 16.1812 36.9769 24.7252 36.9769 24.7252H36.9773ZM38.1165 4.56244C40.337 4.56244 42.1037 6.32912 42.1037 8.54965C42.1037 10.7702 40.337 12.5369 38.1165 12.5369C35.896 12.5369 34.1293 10.7702 34.1293 8.54965C34.1293 6.38471 35.896 4.56244 38.1165 4.56244Z" fill="#F4B511"/>
					</svg>
					<div class="num">
						<?php pll_e("Nombre de fonds cartographiques");?>
					</div>
					<div class="label">
						<?php pll_e("Fonds cartographiques communs");?>
					</div>
				</div>
				<div class="stat">
					<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M3.83425 17.1035C3.85916 17.1246 3.88215 17.1457 3.90514 17.1686L7.56081 20.8243L10.2834 19.736C10.544 19.6306 10.8276 19.6057 11.1035 19.6594L14.7094 20.3817C15.2459 20.489 15.675 20.8895 15.8187 21.4164L17.7788 28.605L21.375 29.8044C22.0552 30.0305 22.4653 30.7241 22.3368 31.4311L20.896 39.3652C20.8347 39.6986 20.6584 39.9994 20.3998 40.2159L17.4799 42.6473C19.2598 43.1608 21.1394 43.4348 23.0822 43.4348C24.9235 43.4348 26.7303 43.1895 28.4698 42.7086C29.2362 42.4978 30.0313 42.9481 30.244 43.7164C30.4548 44.4847 30.0045 45.2779 29.2362 45.4906C27.2474 46.0386 25.1839 46.3202 23.082 46.3202C10.3351 46.3202 0 35.9856 0 23.2382C0 10.4914 10.3346 0.15625 23.082 0.15625C34.8288 0.15625 44.6655 8.97527 46.0085 20.5499C46.1005 21.3412 45.5333 22.0577 44.7421 22.1497C43.9508 22.2417 43.2342 21.6745 43.1422 20.8813C42.508 15.4148 39.7069 10.6502 35.6451 7.42326L35.2695 8.54604C35.1488 8.91008 34.8883 9.20899 34.5472 9.3814L30.8954 11.2073L30.3589 14.9626L32.9378 18.831C33.3803 19.4939 33.2002 20.3906 32.5373 20.8313L29.4104 22.9158L31.495 26.0446C31.7422 26.4144 31.8054 26.8781 31.6636 27.3015L30.9432 29.4647C30.6903 30.2196 29.8741 30.6296 29.1172 30.3767C28.3623 30.1257 27.9523 29.3076 28.2052 28.5527L28.7034 27.0582L26.2088 23.3163C25.7681 22.6533 25.9463 21.7586 26.6092 21.316L29.738 19.2314L27.6515 16.1045C27.4561 15.8076 27.3737 15.4512 27.4235 15.0987L28.1459 10.05C28.2129 9.58254 28.5061 9.17637 28.9295 8.96369L32.7213 7.06687L33.1658 5.7372C30.1903 4.02048 26.7413 3.04141 23.0818 3.04141C14.067 3.04141 6.43207 8.94839 3.83394 17.1028L3.83425 17.1035ZM3.07933 20.4239C2.95096 21.3435 2.88582 22.2843 2.88582 23.2385C2.88582 31.2801 7.58379 38.2215 14.3854 41.471L18.1503 38.3345L19.275 32.146L16.1347 31.0999C15.6768 30.9466 15.3262 30.5749 15.1978 30.1093L13.2684 23.0355L10.9577 22.5737L7.74845 23.8575C7.21391 24.072 6.6008 23.9456 6.19266 23.5375L3.07933 20.4239ZM42.6806 28.2869L41.5367 27.1431C40.9735 26.5798 40.9735 25.6678 41.5367 25.1045C42.1 24.5393 43.014 24.5393 43.5773 25.1045L47.1851 28.7104C47.7484 29.2737 47.7484 30.1876 47.1851 30.751L43.5773 34.3568C43.014 34.9201 42.1001 34.9201 41.5367 34.3568C40.9735 33.7936 40.9735 32.8796 41.5367 32.3163L42.6806 31.1725H40.3929C37.2066 31.1725 34.6237 33.7571 34.6237 36.9436C34.6237 37.7406 33.9761 38.3863 33.181 38.3863C32.3839 38.3863 31.7383 37.7406 31.7383 36.9436C31.7383 32.1632 35.6124 28.2874 40.393 28.2874L42.6806 28.2869ZM38.1052 45.5998L39.249 46.7436C39.8123 47.3069 39.8123 48.2189 39.249 48.7822C38.6858 49.3474 37.7737 49.3474 37.2105 48.7822L33.6027 45.1763C33.0394 44.613 33.0394 43.6991 33.6027 43.1357L37.2105 39.5299C37.7737 38.9666 38.6858 38.9666 39.249 39.5299C39.8123 40.0931 39.8123 41.0071 39.249 41.5704L38.1052 42.7142H40.3929C43.5811 42.7142 46.164 40.1296 46.164 36.9431C46.164 36.1461 46.8097 35.5004 47.6068 35.5004C48.4038 35.5004 49.0495 36.1461 49.0495 36.9431C49.0495 41.7235 45.1735 45.5993 40.3933 45.5993L38.1052 45.5998Z" fill="#F4B511"/>
					</svg>
					<div class="num">
						<?php pll_e("Nombre de sites");?>
					</div>
					<div class="label">
						<?php pll_e("Sites");?>
					</div>
				</div>
				<div class="stat">
					<svg width="37" height="47" viewBox="0 0 37 47" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M5.19773 36.4368H5.59743V3.4481H4.79803C3.49858 3.4481 2.49843 4.44824 2.49843 5.7477V37.2378C3.29783 36.7378 4.19758 36.4384 5.19773 36.4384L5.19773 36.4368ZM8.19639 36.4368H34.3882V3.4481H8.19639V36.4368ZM36.9871 37.7363C36.9871 38.0356 36.8868 38.3367 36.5874 38.5357C35.0872 40.7349 35.3883 42.7334 36.6878 44.9325C37.2883 45.7319 36.6878 46.8324 35.6877 46.8324H5.19781C2.29955 46.8324 0 44.5328 0 41.6345V5.74591C0 3.14696 2.19925 0.947754 4.79815 0.947754H35.5876C36.387 0.947754 36.9875 1.4478 36.9875 2.24721L36.9871 37.7363ZM33.4884 39.0357H5.19783C3.69763 39.0357 2.49853 40.2348 2.49853 41.6347C2.49853 43.1349 3.69763 44.334 5.19783 44.334H33.5889C32.8899 42.5344 32.7895 40.7349 33.4886 39.0357L33.4884 39.0357Z" fill="#F4B511"/>
						<path d="M12.7958 9.94533C12.0968 9.94533 11.4963 9.34489 11.4963 8.64588C11.4963 7.94687 12.0968 7.44678 12.7958 7.44678H26.3909C27.0899 7.44678 27.59 7.94683 27.59 8.64588C27.59 9.34489 27.09 9.94533 26.3909 9.94533H12.7958Z" fill="#F4B511"/>
						<path d="M12.7958 16.1435C12.0968 16.1435 11.4963 15.543 11.4963 14.844C11.4963 14.145 12.0968 13.5446 12.7958 13.5446H29.7891C30.4881 13.5446 30.9882 14.145 30.9882 14.844C30.9882 15.543 30.4882 16.1435 29.7891 16.1435H12.7958Z" fill="#F4B511"/>
					</svg>
					<div class="num">
						<?php pll_e("Nombre de termes de thesorus");?>
					</div>
					<div class="label">
						<?php pll_e("Termes de thesorus");?>
					</div>
				</div>
				<div class="stat">
					<svg width="48" height="47" viewBox="0 0 48 47" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M29.5006 5.86856C29.5027 3.66374 28.2443 1.65273 26.2597 0.692058C24.2752 -0.268566 21.9174 -0.0074984 20.1899 1.36102C18.4624 2.72959 17.671 4.96699 18.1524 7.1186C18.6358 9.26834 20.3062 10.9551 22.4518 11.4548V17.5126C19.8657 18.1286 18.0402 20.4394 18.0402 23.0989C18.0402 25.7584 19.8657 28.0694 22.4518 28.6852V34.743C19.6107 35.4059 17.718 38.0941 18.0504 40.9925C18.3849 43.8907 20.8385 46.0792 23.7573 46.0792C26.6762 46.0792 29.1296 43.8907 29.4643 40.9925C29.7967 38.0942 27.904 35.4062 25.0628 34.743V28.6852C27.649 28.0693 29.4745 25.7584 29.4745 23.0989C29.4745 20.4394 27.649 18.1284 25.0628 17.5126V11.4548C27.6593 10.849 29.4989 8.53615 29.501 5.86845L29.5006 5.86856ZM26.8899 40.3295C26.8899 41.5961 26.1272 42.7382 24.9564 43.2237C23.7857 43.7091 22.4375 43.4399 21.5421 42.5445C20.6468 41.6491 20.3775 40.3009 20.8629 39.1302C21.3484 37.9594 22.4905 37.1967 23.7571 37.1967C25.4867 37.1967 26.8899 38.5999 26.8899 40.3295ZM26.8899 23.099C26.8899 24.3656 26.1272 25.5078 24.9564 25.9932C23.7857 26.4786 22.4375 26.2094 21.5421 25.314C20.6468 24.4187 20.3775 23.0705 20.8629 21.8997C21.3484 20.729 22.4905 19.9662 23.7571 19.9662C25.4867 19.9662 26.8899 21.3694 26.8899 23.099ZM23.7571 9.00137C22.4905 9.00137 21.3484 8.23858 20.8629 7.06785C20.3775 5.89712 20.6467 4.54897 21.5421 3.65356C22.4375 2.7582 23.7857 2.48893 24.9564 2.97436C26.1272 3.45979 26.8899 4.60196 26.8899 5.86856C26.8899 7.59813 25.4867 9.00137 23.7571 9.00137Z" fill="#F4B511"/>
						<path d="M33.1556 4.56319H39.4212C40.1412 4.56319 40.7265 3.97782 40.7265 3.25785C40.7265 2.53788 40.1412 1.95251 39.4212 1.95251H33.1556C32.4356 1.95251 31.8503 2.53788 31.8503 3.25785C31.8503 3.97782 32.4356 4.56319 33.1556 4.56319Z" fill="#F4B511"/>
						<path d="M33.1556 9.26241H46.209C46.9289 9.26241 47.5143 8.67704 47.5143 7.95707C47.5143 7.2371 46.9289 6.65173 46.209 6.65173H33.1556C32.4356 6.65173 31.8503 7.2371 31.8503 7.95707C31.8503 8.67704 32.4356 9.26241 33.1556 9.26241Z" fill="#F4B511"/>
						<path d="M33.1556 39.5462H39.4212C40.1412 39.5462 40.7265 38.9609 40.7265 38.2409C40.7265 37.5209 40.1412 36.9355 39.4212 36.9355H33.1556C32.4356 36.9355 31.8503 37.5209 31.8503 38.2409C31.8503 38.9609 32.4356 39.5462 33.1556 39.5462Z" fill="#F4B511"/>
						<path d="M46.209 41.6348H33.1556C32.4356 41.6348 31.8503 42.2201 31.8503 42.9401C31.8503 43.6601 32.4356 44.2454 33.1556 44.2454H46.209C46.9289 44.2454 47.5143 43.6601 47.5143 42.9401C47.5143 42.2201 46.9289 41.6348 46.209 41.6348Z" fill="#F4B511"/>
						<path d="M14.3587 18.6609H8.09309C7.37312 18.6609 6.78775 19.2463 6.78775 19.9662C6.78775 20.6862 7.37312 21.2716 8.09309 21.2716H14.3587C15.0787 21.2716 15.664 20.6862 15.664 19.9662C15.664 19.2463 15.0787 18.6609 14.3587 18.6609Z" fill="#F4B511"/>
						<path d="M14.3587 23.3601H1.30534C0.585366 23.3601 0 23.9455 0 24.6654C0 25.3854 0.585366 25.9708 1.30534 25.9708H14.3587C15.0787 25.9708 15.6641 25.3854 15.6641 24.6654C15.6641 23.9455 15.0787 23.3601 14.3587 23.3601Z" fill="#F4B511"/>
					</svg>
					<div class="num">
						<?php pll_e("Nombre de chronologies");?>
					</div>
					<div class="label">
						<?php pll_e("Chronologies");?>
					</div>
				</div>
				<div class="stat">
					<svg width="45" height="50" viewBox="0 0 45 50" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M41.1277 28.595C40.7801 28.3967 40.4134 28.2325 40.036 28.1046V21.3025C41.778 20.7119 43.1641 19.3727 43.8123 17.652C44.4605 15.9313 44.3048 14.01 43.3837 12.4172C42.4647 10.8223 40.8804 9.72626 39.0658 9.42772C37.249 9.12707 35.396 9.65801 34.0143 10.8713L28.108 7.47024C28.4663 5.66844 27.9972 3.7984 26.8308 2.37832C25.6645 0.958192 23.9224 0.135132 22.0843 0.135132C20.2463 0.135132 18.5042 0.958192 17.3378 2.37832C16.1715 3.79845 15.7024 5.66844 16.0606 7.47024L10.1925 10.8713C8.80865 9.65584 6.95357 9.12706 5.13686 9.42772C3.32229 9.72838 1.73583 10.8286 0.818933 12.4236C-0.100091 14.0186 -0.25359 15.9419 0.39887 17.6648C1.05135 19.3856 2.44375 20.7226 4.18796 21.3089V28.1044C2.44375 28.6908 1.0556 30.0278 0.400999 31.7464C-0.251478 33.4672 -0.100092 35.3884 0.814664 36.9855C1.62495 38.3992 2.96828 39.4291 4.54191 39.8449C5.06432 39.9857 5.60166 40.0582 6.14327 40.0582C7.62093 40.0539 9.04958 39.5166 10.1648 38.5464L16.0989 41.9474C15.745 43.7492 16.2162 45.6128 17.3847 47.0308C18.5511 48.4488 20.2889 49.2697 22.1248 49.2697C23.9607 49.2697 25.7007 48.4488 26.8671 47.0308C28.0334 45.6128 28.5047 43.7492 28.1507 41.9474L34.0466 38.5464C34.3473 38.8065 34.6693 39.0368 35.0126 39.2351C35.9444 39.7746 36.9998 40.0582 38.0767 40.0582C38.6162 40.0582 39.1535 39.9857 39.6759 39.8449C42.0747 39.2031 43.8488 37.1774 44.1729 34.7146C44.4971 32.2518 43.3051 29.8381 41.1536 28.5949L41.1277 28.595ZM36.5198 12.8309C37.7885 12.0973 39.4005 12.3617 40.3686 13.462C41.3345 14.5644 41.39 16.1956 40.4987 17.3598C39.6074 18.524 38.0167 18.8951 36.7011 18.249C35.3854 17.6008 34.7117 16.1145 35.0891 14.6987C35.3002 13.9098 35.814 13.2381 36.5198 12.8308L36.5198 12.8309ZM32.2787 13.4087C32.2211 13.5686 32.1699 13.7328 32.1251 13.8991V13.9013C31.6752 15.5624 31.946 17.3364 32.8672 18.7885C33.7884 20.2427 35.2789 21.2406 36.9719 21.5434V27.87C36.8013 27.8999 36.6307 27.9383 36.4644 27.9852C35.4025 28.2688 34.4366 28.8339 33.6711 29.6228L28.0202 26.3412C28.4637 24.7548 28.2505 23.0575 27.4296 21.6288C26.6065 20.2023 25.2482 19.1639 23.6533 18.7481V12.1977C24.8836 11.8778 25.9839 11.187 26.8027 10.2168L32.2787 13.4087ZM19.0304 24.7033C19.0304 23.4602 19.7789 22.3407 20.9261 21.8631C22.0754 21.3876 23.3974 21.652 24.2759 22.5305C25.1544 23.409 25.4189 24.731 24.9433 25.8803C24.4657 27.0275 23.3462 27.776 22.1031 27.776C21.2886 27.776 20.506 27.4519 19.9303 26.8762C19.3546 26.3004 19.0305 25.5179 19.0305 24.7033L19.0304 24.7033ZM22.1031 3.21189C23.3462 3.20975 24.4699 3.9582 24.9454 5.10539C25.4231 6.25472 25.1629 7.57671 24.2844 8.45736C23.4059 9.33801 22.0817 9.60029 20.9346 9.12479C19.7853 8.64929 19.0347 7.52982 19.0347 6.28671C19.0347 4.59151 20.4079 3.2162 22.1031 3.21194V3.21189ZM20.5636 12.2253V18.7757C18.9707 19.1915 17.6103 20.2278 16.7894 21.6564C15.9663 23.085 15.7531 24.7824 16.1966 26.3688L10.5311 29.6163C9.76346 28.8294 8.79749 28.2622 7.73561 27.9786C7.56716 27.936 7.39871 27.8976 7.22812 27.8635V21.5369C7.39657 21.5049 7.56715 21.4708 7.73561 21.4217C9.39456 20.9782 10.7912 19.8609 11.5887 18.3385C12.384 16.816 12.5056 15.0313 11.9234 13.415L17.4143 10.2443C18.2353 11.2123 19.3355 11.9053 20.5637 12.2252L20.5636 12.2253ZM3.48826 13.9546C4.10662 12.8777 5.31135 12.2765 6.54387 12.4342C7.77633 12.5899 8.79345 13.4748 9.12184 14.6732C9.44809 15.8715 9.02163 17.1488 8.04075 17.91C7.05775 18.6712 5.71442 18.7672 4.63546 18.1531C3.92539 17.7501 3.40725 17.0806 3.19191 16.2916C2.97655 15.5047 3.08316 14.6646 3.4883 13.9546L3.48826 13.9546ZM7.68037 36.5699C6.85518 37.0497 5.85084 37.1179 4.96593 36.7533C4.08315 36.3887 3.42003 35.6338 3.17051 34.7105C2.92317 33.7851 3.11934 32.8 3.70146 32.0409C4.28357 31.2818 5.18556 30.8383 6.14296 30.8383C6.41376 30.8383 6.68243 30.8724 6.94473 30.9428C8.14095 31.2669 9.02586 32.2776 9.18793 33.5079C9.34998 34.7361 8.7572 35.9409 7.68679 36.5657L7.68037 36.5699ZM22.1033 46.1996C20.8602 46.1996 19.7386 45.4511 19.2631 44.3018C18.7876 43.1525 19.052 41.8305 19.9327 40.952C20.8133 40.0735 22.1353 39.8112 23.2825 40.2889C24.4318 40.7665 25.1781 41.8881 25.176 43.1333C25.1739 44.8285 23.7986 46.1996 22.1034 46.1996H22.1033ZM22.1033 36.9859C20.293 36.9837 18.5744 37.7833 17.408 39.1693L11.9171 36.0029C12.3521 34.8045 12.4032 33.4996 12.0642 32.2692L17.7254 28.994C18.8769 30.1646 20.4505 30.8214 22.0923 30.8214C23.7342 30.8214 25.3078 30.1647 26.4593 28.994L32.1139 32.2692C31.824 33.3268 31.824 34.4442 32.1139 35.5018C32.1609 35.6724 32.2142 35.8408 32.2717 36.005L26.8131 39.1715V39.1694C25.6446 37.7791 23.9195 36.9795 22.1028 36.9859L22.1033 36.9859ZM40.7185 35.4527C40.2046 36.3419 39.2813 36.9176 38.2578 36.9837C37.2322 37.052 36.2407 36.6042 35.616 35.7896C34.9912 34.973 34.8142 33.9004 35.1447 32.9281C35.4752 31.9557 36.2706 31.2137 37.2621 30.9493C37.5244 30.879 37.793 30.8448 38.0639 30.8448C39.1599 30.8491 40.1706 31.4355 40.7186 32.3843C41.2644 33.3332 41.2644 34.5017 40.7186 35.4527L40.7185 35.4527Z" fill="#F4B511"/>
					</svg>
					<div class="num">
						<?php pll_e("Nombre d'institutions");?>
					</div>
					<div class="label">
						<?php pll_e("Institutions pluridisciplinaires");?>
					</div>
				</div>
			</div>
		</div>

		<div class="databases-block">
			<h2><?php pll_e("Visualiser les <b>données partagées</b>");?></h2>
			<div class="app">
				<div class="toolbar">
					<div class="button all" data-set="all"><?php pll_e("Toutes les données");?></div>
					<div class="button search" data-set="search"><?php pll_e("Recherche");?></div>
					<div class="button inventory" data-set="inventory"><?php pll_e("Inventaire");?></div>
					<div class="button work" data-set="work"><?php pll_e("Ouvrage");?></div>
				</div>
			</div>
		</div>

		<?php
			$news = get_arkeogis_news(pll_current_language(), true);
			if (is_array($news) && sizeof($news) > 0):
		?>
		<script>
			window.onload = function() {
				Beve.newsSlider('.news-block .swiper-container');
			}
		</script>
		<div class="news-block">
			<h2><?php pll_e("Dernières <b>actualités</b>");?></h2>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php
						foreach($news as $n):
					?>
						<div class="slide swiper-slide">
							<div class="container">
								<a href="<?php echo $n->url;?>" title="<?php echo $n->title;?>" data-id="<?php echo $n->id;?>">
									<!-- <div class="img-container"> -->
									<img src="<?php echo $n->image;?>" alt="<?php echo $n->title;?>" />
									<!-- </div> -->
									<div class="title"><?php echo $n->title;?></div>
									<div class="date"><?php echo $n->date;?></div>
								</a>
							</div>
						</div>
					<?php
						endforeach;
					?>
				</div>
			</div>
		</div>
		<?php endif;?>

	</main><!-- #main -->

<?php
get_footer();
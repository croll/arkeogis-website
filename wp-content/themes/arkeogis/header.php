<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beve
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
  <script>
    // document.write('<script src="http://' + 'localhost'.split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')
  </script> 
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'Beve' ); ?></a>

	<header id="masthead" class="site-header">
			<div class="logo">
				<a href="/<?php if (pll_current_language() != 'fr') {echo pll_current_language().'/';} ?>">
					<?php
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
					if ( has_custom_logo() ) {
						echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo( 'name' ) . '">';
					}
					?>
				</a>
			</div>
			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'Beve' ); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
			?>
			</nav><!-- #site-navigation -->
			<div class="language-switcher">
				<button><?php
					echo pll_current_language();
				?></button>
				<ul>
					<?php pll_the_languages(array('display_names_as' => 'slug', 'hide_current' => 1, 'hide_if_no_translation' => 0)); ?>
				</ul>
				<svg class="arrow" width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 0.5L4 3.5L7 0.5" stroke="black" stroke-width="1.5" />
				</svg>
			</div>
			<a class="burger-icon">
				<svg viewBox="0 0 32 32" width="32" height="32"><path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z"/></svg>
			</a>
	</header><!-- #masthead -->

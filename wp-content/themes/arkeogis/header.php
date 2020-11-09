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
					<svg width="163" height="30" viewBox="0 0 163 30" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M11.7966 1.8475H15.0687L26.5209 29.2962H22.3877L19.7184 22.522H6.88854L4.21923 29.2962H0L11.7966 1.8475ZM18.3407 19.2669L13.3465 6.68621H13.2604L8.18014 19.2669H18.3407Z" fill="white"/>
					<path d="M43.2256 0H46.6699V18.915L54.4195 10.9971H59.1553L50.803 19.3548L59.9303 29.3842H55.1083L46.756 19.8827V29.3842H43.3117V0H43.2256Z" fill="white"/>
					<path d="M65.4411 21.3783C65.4411 22.1701 65.6133 22.8739 65.9578 23.5777C66.3022 24.2815 66.7327 24.8094 67.3355 25.2493C67.8521 25.6892 68.541 26.0411 69.2298 26.305C70.0048 26.5689 70.6936 26.6569 71.4686 26.6569C72.5019 26.6569 73.449 26.393 74.224 25.8651C74.999 25.3372 75.6878 24.7214 76.3767 23.8416L78.9599 25.8651C77.0655 28.3284 74.3962 29.6481 71.0381 29.6481C69.6604 29.6481 68.3688 29.3842 67.1633 28.9443C66.0439 28.4164 65.0106 27.8006 64.2356 26.9208C63.4607 26.0411 62.8579 25.0733 62.4274 23.8416C61.9969 22.6979 61.8246 21.3783 61.8246 20.0587C61.8246 18.739 62.083 17.4194 62.5135 16.2757C62.944 15.132 63.6329 14.0762 64.4078 13.1965C65.2689 12.3167 66.2161 11.6129 67.3355 11.173C68.4549 10.6452 69.7465 10.4692 71.0381 10.4692C72.588 10.4692 73.9657 10.7331 75.0851 11.349C76.2045 11.8768 77.0655 12.6686 77.7544 13.5484C78.4432 14.4282 78.9599 15.4839 79.3043 16.6276C79.6487 17.7713 79.8209 18.915 79.8209 20.1466V21.3783H65.4411ZM76.2045 18.5631C76.2045 17.7713 76.0323 17.0674 75.86 16.4516C75.6878 15.8358 75.3434 15.2199 74.9129 14.7801C74.4823 14.3402 73.9657 13.9003 73.2768 13.6364C72.588 13.3724 71.8991 13.1965 71.0381 13.1965C70.177 13.1965 69.402 13.3724 68.7132 13.6364C68.0243 13.9883 67.4216 14.3402 66.991 14.868C66.4744 15.3959 66.13 15.9238 65.8717 16.6276C65.6133 17.2434 65.4411 17.8592 65.4411 18.4751H76.2045V18.5631Z" fill="white"/>
					<path d="M83.093 20.0586C83.093 18.739 83.3513 17.5073 83.8679 16.2756C84.3846 15.132 85.0734 14.0762 85.9345 13.1965C86.7955 12.3167 87.8288 11.6129 88.9482 11.085C90.0676 10.5572 91.3592 10.2932 92.7369 10.2932C94.1146 10.2932 95.3201 10.5572 96.5256 11.085C97.645 11.6129 98.6783 12.3167 99.5393 13.1965C100.4 14.0762 101.089 15.132 101.606 16.2756C102.123 17.4193 102.381 18.651 102.381 20.0586C102.381 21.4663 102.123 22.6979 101.606 23.8416C101.089 24.9853 100.4 26.041 99.5393 26.9208C98.6783 27.8006 97.645 28.5044 96.5256 28.9443C95.4062 29.4721 94.1146 29.7361 92.7369 29.7361C91.3592 29.7361 90.1537 29.4721 88.9482 28.9443C87.8288 28.4164 86.7955 27.8006 85.9345 26.9208C85.0734 26.041 84.3846 25.0733 83.8679 23.8416C83.3513 22.6979 83.093 21.4663 83.093 20.0586ZM86.7094 20.0586C86.7094 21.0264 86.8817 21.8182 87.14 22.61C87.3983 23.4017 87.8288 24.1056 88.3455 24.6334C88.8621 25.1613 89.4649 25.6012 90.2398 25.9531C91.0148 26.305 91.7897 26.393 92.7369 26.393C93.6841 26.393 94.459 26.217 95.234 25.9531C96.009 25.6012 96.6117 25.1613 97.1284 24.6334C97.645 24.1056 97.9894 23.4017 98.3338 22.61C98.5922 21.8182 98.7644 20.9384 98.7644 20.0586C98.7644 19.0909 98.5922 18.2991 98.3338 17.5073C98.0755 16.7155 97.645 16.0117 97.1284 15.4839C96.6117 14.956 96.009 14.5161 95.234 14.1642C94.459 13.8123 93.6841 13.6364 92.7369 13.6364C91.7897 13.6364 91.0148 13.8123 90.2398 14.1642C89.4649 14.5161 88.8621 14.956 88.3455 15.4839C87.8288 16.0117 87.4844 16.7155 87.14 17.5073C86.8817 18.2991 86.7094 19.1789 86.7094 20.0586Z" fill="white"/>
					<path d="M130.193 13.9003V27.4487C129.505 27.8886 128.816 28.2405 127.955 28.5044C127.094 28.8563 126.232 29.1202 125.371 29.2962C124.51 29.4721 123.563 29.6481 122.616 29.7361C121.669 29.8241 120.808 29.912 120.033 29.912C117.794 29.912 115.727 29.5601 113.919 28.7683C112.111 27.9765 110.647 26.9208 109.442 25.6012C108.236 24.2815 107.289 22.7859 106.6 21.0264C105.997 19.2669 105.653 17.4194 105.653 15.4839C105.653 13.4604 105.997 11.5249 106.686 9.7654C107.375 8.00587 108.322 6.51027 109.528 5.19062C110.733 3.87097 112.197 2.90323 113.919 2.11144C115.641 1.40763 117.536 0.967743 119.602 0.967743C122.099 0.967743 124.08 1.31965 125.63 1.93548C127.18 2.55132 128.471 3.43109 129.591 4.57478L127.007 7.39003C125.888 6.33431 124.683 5.54252 123.477 5.10264C122.272 4.66276 120.98 4.4868 119.602 4.4868C118.052 4.4868 116.675 4.75073 115.469 5.36657C114.264 5.98241 113.144 6.68622 112.283 7.74194C111.422 8.70968 110.733 9.85337 110.217 11.173C109.7 12.4927 109.528 13.9003 109.528 15.3959C109.528 16.9795 109.786 18.3871 110.303 19.7067C110.819 21.0264 111.594 22.1701 112.541 23.1378C113.489 24.1056 114.608 24.8974 115.814 25.4252C117.105 25.9531 118.483 26.217 119.947 26.217C121.238 26.217 122.444 26.129 123.563 25.8651C124.683 25.6012 125.716 25.2493 126.491 24.8094V17.1554H120.549V13.6364H130.193V13.9003Z" fill="white"/>
					<path d="M136.824 1.8475H140.44V29.2962H136.824V1.8475Z" fill="white"/>
					<path d="M148.104 23.5777C148.792 24.5454 149.567 25.3372 150.601 25.7771C151.634 26.217 152.667 26.4809 153.787 26.4809C154.389 26.4809 154.992 26.3929 155.681 26.217C156.37 26.041 156.886 25.7771 157.403 25.3372C157.92 24.9853 158.35 24.4575 158.695 23.9296C159.039 23.4017 159.211 22.6979 159.211 21.9941C159.211 20.9384 158.867 20.1466 158.264 19.5308C157.575 19.0029 156.8 18.4751 155.853 18.1232C154.906 17.7712 153.787 17.4193 152.667 17.0674C151.548 16.7155 150.428 16.2756 149.481 15.5718C148.534 14.956 147.673 14.1642 147.07 13.1085C146.381 12.0528 146.123 10.6451 146.123 8.88562C146.123 8.09383 146.295 7.21406 146.64 6.3343C146.984 5.45453 147.501 4.57477 148.276 3.87095C149.051 3.07917 149.912 2.46333 151.117 2.02345C152.237 1.49559 153.614 1.23166 155.25 1.23166C156.714 1.23166 158.092 1.40761 159.47 1.84749C160.847 2.28738 161.967 3.07917 163 4.39881L159.814 7.03811C159.383 6.3343 158.695 5.71846 157.92 5.27858C157.059 4.8387 156.111 4.66274 155.078 4.66274C154.045 4.66274 153.27 4.8387 152.581 5.10263C151.892 5.36656 151.376 5.71846 150.945 6.15835C150.514 6.59823 150.256 7.03811 150.084 7.56597C149.912 7.91788 149.826 8.44574 149.826 8.79764C149.826 9.94134 150.17 10.8211 150.773 11.4369C151.376 12.0528 152.237 12.5806 153.184 12.9325C154.131 13.2844 155.25 13.6364 156.37 13.9883C157.489 14.3402 158.609 14.6921 159.556 15.3079C160.503 15.8358 161.364 16.6276 161.967 17.5953C162.656 18.563 162.914 19.7947 162.914 21.4663C162.914 22.7859 162.656 23.9296 162.139 24.9853C161.622 26.041 161.02 26.9208 160.158 27.6246C159.297 28.3284 158.35 28.9443 157.231 29.2962C156.111 29.6481 154.906 29.912 153.614 29.912C151.892 29.912 150.256 29.5601 148.706 28.9443C147.156 28.3284 145.951 27.3607 145.004 26.041L148.104 23.5777Z" fill="white"/>
					<path d="M32.6345 29.2082H29.1041V19.3548C29.1041 19.2669 29.018 15.4839 31.6012 12.7566C33.4094 10.8211 35.9926 9.85336 39.1786 9.85336V13.4604C36.9398 13.4604 35.2177 14.0762 34.0983 15.2199C32.5484 16.8915 32.5484 19.2669 32.5484 19.3548L32.6345 29.2082Z" fill="white"/>
					</svg>
				</a>
			</div>
			<nav id="site-navigation" class="main-navigation">
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
			</div>
			<a class="burger-icon">
				<svg viewBox="0 0 32 32" width="32" height="32"><path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z"/></svg>
			</a>
	</header><!-- #masthead -->
	<?php if (!is_home()): ?>
		<div class="header-background"></div>
	<?php endif;?>
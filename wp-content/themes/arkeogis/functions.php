<?php
/**
 * Beve functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Beve
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.1.0' );
}

if ( ! function_exists( 'beve_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function beve_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on beve, use a find and replace
		 * to change 'beve' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'beve', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'beve' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'beve_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function beve_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'beve_content_width', 640 );
}
add_action( 'after_setup_theme', 'beve_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function beve_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'beve' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'beve' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'beve_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function beve_scripts() {
	wp_enqueue_style( 'bundle-style', get_template_directory_uri() . '/assets/bundle.css', array(), _S_VERSION);
	wp_enqueue_style( 'css-style', get_template_directory_uri() . '/assets/style.css', array(), _S_VERSION);
	wp_style_add_data( 'beve-style', 'rtl', 'replace' );

	wp_enqueue_script( 'beve-main', get_template_directory_uri() . '/assets/bundle.js', array(), _S_VERSION, false );

}
add_action( 'wp_enqueue_scripts', 'beve_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom post types.
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Translations.
 */
require get_template_directory() . '/inc/translations.php';

/**
 * Utils.
 */
require get_template_directory() . '/inc/utils.php';

/**
 * Shortcodes.
 */
require get_template_directory() . '/inc/shortcodes.php';

add_action( 'tablepress_event_saved_table', 'tablepress_update_auto_export' );

/**
 * Update the exported CSV file of a table when it is saved.
 *
 * The CSV file is saved to http://example.com/wp-content/tables/<table-name>.csv
 *
 * @since 1.0.0
 *
 * @param string $table_id Table ID.
 */
function tablepress_update_auto_export( $table_id ) {

	// Seulement la table users

	if ($table_id != 83) {
		return;
	}
	$exporter = TablePress::load_class( 'TablePress_Export', 'class-export.php', 'classes' );

	// Load table, with table data, options, and visibility settings.
	$table = TablePress::$model_table->load( $table_id, true, true );
	// Skip tables that could not be loaded or that are corrupted.
	if ( is_wp_error( $table ) || ( isset( $table['is_corrupted'] ) && $table['is_corrupted'] ) ) {
		return;
	}

	// Export the table.
	$export_format = 'csv'; // Allowed values: 'csv', html', 'json'.
	$csv_delimiter = ';';
	$exported_table = $exporter->export_table( $table, $export_format, $csv_delimiter );

	// Generate a file name.
	$path = trailingslashit( WP_CONTENT_DIR ) . '/themes/arkeogis/datas/';
	//$filename = sprintf( '%1$s.csv', sanitize_title_with_dashes( $table['name'] ) );
	$filename = sprintf( 'users.csv', sanitize_title_with_dashes( $table['name'] ) );
	$filename = $path . sanitize_file_name( $filename );

	// Create the folder (/wp-content/tables/), if it does not exist.
	if ( ! is_dir( $path) ) {
		mkdir( $path );
	}
	// Save the exported data to the file.
	file_put_contents( $filename, $exported_table );
}

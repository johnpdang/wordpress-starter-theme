<?php
/**
 * %Theme_name_sentence_case% functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package %Theme_name_sentence_case%
 */

if ( ! function_exists( '%theme_name_underscored%_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function %theme_name_underscored%_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on %Theme_name_sentence_case%, use a find and replace
		 * to change '%theme-name-dashed%' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( '%theme-name-dashed%', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', '%theme-name-dashed%' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( '%theme_name_underscored%_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', '%theme_name_underscored%_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function %theme_name_underscored%_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( '%theme_name_underscored%_content_width', 640 );
}
add_action( 'after_setup_theme', '%theme_name_underscored%_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function %theme_name_underscored%_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', '%theme-name-dashed%' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', '%theme-name-dashed%' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', '%theme_name_underscored%_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function %theme_name_underscored%_scripts() {
	// Add custom fonts, used in the main stylesheet.
	//wp_enqueue_style( '%theme-name-dashed%-fonts', td_fonts_url(), array(), null );

	// Bootstrap styling
	wp_enqueue_style('%theme-name-dashed%-flexbox', get_theme_file_uri('/assets/css/vendor/flexboxgrid.css') );

	wp_enqueue_style('slick-css', get_theme_file_uri('/assets/css/slick.min.css'));

	// Theme stylesheet.
	wp_enqueue_style( '%theme-name-dashed%-style', get_stylesheet_uri() );
	// Traina Styles
	wp_enqueue_style( '%theme-name-dashed%-style-local', get_theme_file_uri('/assets/build/main.min.css'), array(), filemtime(get_theme_file_path('/assets/build/main.min.css')) );

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'brooklyn-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( '%theme-name-dashed%-style' ), '1.0' );
		wp_style_add_data( '%theme-name-dashed%-ie9', 'conditional', 'IE 9' );
	}
	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( '%theme-name-dashed%-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( '%theme-name-dashed%-style' ), '1.0' );
	wp_style_add_data( '%theme-name-dashed%-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( '%theme-name-dashed%-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_enqueue_script( 'object-fit-polyfill', get_theme_file_uri( '/assets/js/vendor/ofi.min.js' ));
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js');
	wp_enqueue_script('%theme-name-dashed%-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js');
	wp_enqueue_script( '%theme-name-dashed%-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );
	wp_enqueue_script( 'modernizr.js', get_template_directory_uri() . '/assets/js/vendor/modernizr.min.js', array(), '', true );
	wp_enqueue_script( 'enquire.js', get_template_directory_uri() . '/assets/js/vendor/enquire.min.js', array(), '', true );
	wp_enqueue_script( '%theme-name-dashed%-slick', get_theme_file_uri( '/assets/js/vendor/slick.min.js' ), array( 'jquery' ), '1.0', false  );
	wp_enqueue_script( '%theme-name-dashed%-iframeres', get_theme_file_uri( '/assets/js/vendor/iframeResizer.min.js' ), array( 'jquery' ), '1.0', false  );
	wp_enqueue_script( '%theme-name-dashed%-iframeres-cw', get_theme_file_uri( '/assets/js/vendor/iframeResizer.contentWindow.min.js' ), array( 'jquery' ), '1.0', false  );
	wp_enqueue_script( '%theme-name-dashed%-preloadimg', get_theme_file_uri( '/assets/js/vendor/imagesloaded.pkgd.min.js' ), array( 'jquery' ), '1.0', false  );

	wp_enqueue_script('%theme-name-dashed%-script', get_theme_file_uri('/assets/build/main.min.js'), array(), filemtime(get_theme_file_path('/assets/build/main.min.js')), true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '%theme_name_underscored%_scripts' );

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
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * traina theme includes
 */
require get_parent_theme_file_path( '/inc/td-utils.php' );

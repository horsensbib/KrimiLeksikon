<?php
/**
 * KrimiLeksikon functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KrimiLeksikon
 */

if ( ! function_exists( 'krimileksikon_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function krimileksikon_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on KrimiLeksikon, use a find and replace
		 * to change 'krimileksikon' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'krimileksikon', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'krimileksikon' ),
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
		add_theme_support( 'custom-background', apply_filters( 'krimileksikon_custom_background_args', array(
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
add_action( 'after_setup_theme', 'krimileksikon_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function krimileksikon_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'krimileksikon_content_width', 640 );
}
add_action( 'after_setup_theme', 'krimileksikon_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function krimileksikon_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'krimileksikon' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'krimileksikon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'krimileksikon_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function krimileksikon_scripts() {
	wp_enqueue_style( 'krimileksikon-style', get_stylesheet_uri() );

	wp_enqueue_script( 'krimileksikon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'krimileksikon-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/bower_components/slick-carousel/slick/slick.min.js', array( 'jquery' ), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'krimileksikon_scripts' );

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
 * Shortcode for displaying the number of published posts
 */
function krimileksikon_PostCount_shortcode() {
	$count_posts = wp_count_posts('post');
	$published_posts = $count_posts->publish;
	return $published_posts;
}
add_shortcode( 'antal', 'krimileksikon_PostCount_shortcode' );

/**
 * Add Excerpt Metabox to Pages
 * http://wpquicktips.wordpress.com/2010/05/05/add-the-excerpt-meta-box-to-edit-page/
 */
function krimileksikon_pageexcerpt() {
	add_meta_box('postexcerpt', __('Excerpt'), 'post_excerpt_meta_box', 'page', 'normal', 'core');
}
add_action( 'admin_menu', 'krimileksikon_pageexcerpt' );

/**
 * Limit the number of words in excerpts
 * To do: Possibly replace with wp_trim_words: https://codex.wordpress.org/Function_Reference/wp_trim_words
 */
function string_limit_words($string, $word_limit)
{
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

/**
* Get the image for posts with no thumbnails
*/
function get_img($size) {
	$attachments = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order'));
	if ( ! is_array($attachments) ) continue;
	$count = count($attachments);
	$first_attachment = array_shift($attachments);
	echo wp_get_attachment_image($first_attachment->ID, $size);
}

/**
 * Add schema.org itemprop attribute to comments_popup_link
 */
function add_itemprop_to_comments_popup_link(){
	return ' itemprop="discussionUrl" ';}
add_filter( 'comments_popup_link_attributes', 'add_itemprop_to_comments_popup_link' );

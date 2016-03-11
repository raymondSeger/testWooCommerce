<?php

if ( ! function_exists( 'setup_the_theme' ) ) :

function setup_the_theme() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title. */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
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

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'setup_the_theme' );

/**
 * Registers a widget area.
 */
function setup_widgets() {
	register_sidebar( array(
		'name'          => __( 'Raymond SideBar', 'raymond' ),
		'id'            => 'raymond_side_bar',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'raymond' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'setup_widgets' );


/**
 * Enqueues scripts and styles.
 */
function add_scripts_and_styles() {

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'main-css', get_template_directory_uri() . '/css/main.css', array(), '3.4.1' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '20151204', true );
}
add_action( 'wp_enqueue_scripts', 'add_scripts_and_styles' );

// This theme supports WooCommerce
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// register custom Foo_Widget Widget
require_once(dirname(__FILE__) . '\widgets\raymondCustomWidget.php');
function register_foo_widget() {
    register_widget( 'Foo_Widget' );
}
add_action( 'widgets_init', 'register_foo_widget' );
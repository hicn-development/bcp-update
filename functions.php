<?php
/**
 * BCP_BLOG functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BCP_BLOG
 */

if ( ! function_exists( 'bcp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bcp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on BCP_BLOG, use a find and replace
		 * to change 'bcp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bcp', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'bcp' ),
			'menu-2' => esc_html__( 'Footer', 'bcp' ),
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
		add_theme_support( 'custom-background', apply_filters( 'bcp_custom_background_args', array(
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
add_action( 'after_setup_theme', 'bcp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bcp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bcp_content_width', 640 );
}
add_action( 'after_setup_theme', 'bcp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bcp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bcp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bcp' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	// Footer widget 1
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget 1', 'bcp' ),
		'id'            => 'sidebar-footer-widget-1',
		'description'   => esc_html__( 'Add widgets here.', 'bcp' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	// Footer widget 2
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget 2', 'bcp' ),
		'id'            => 'sidebar-footer-widget-2',
		'description'   => esc_html__( 'Add widgets here.', 'bcp' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	// Footer widget 3
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget 3', 'bcp' ),
		'id'            => 'sidebar-footer-widget-3',
		'description'   => esc_html__( 'Add widgets here.', 'bcp' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'bcp_widgets_init' );

function bcp_get_thumbnail_default(){
	return get_template_directory_uri().'/img/default.png';
}

class Bcp_Walker_Nav_Menu extends Walker_Nav_Menu {
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "\t\n$indent\t<ul id=\"menu-footer-menu\" class=\"nav container group\">\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "$indent\t</ul>\n";
    }
    function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth+1 ) : '';
        $class_names = $value = '';
        $classes = empty( $object->classes ) ? array() : (array) $object->classes;
        $classes = in_array( 'current-menu-item', $classes ) ? array( 'current-menu-item' ) : $classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object, $args ) );

        $class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', '', $object, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= "\n$indent\t" .'<li' . $id . $value . $class_names .'>'."\n\t$indent\t";
        $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';
        if(isset($args->before)):
        $object_output = $args->before;
        $object_output .= '<a'. $attributes .'>';
        $object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after;

        $object_output .= "</a>\n$indent\t";
        $object_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
        endif;
    }
    function end_el(&$output, $object, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }
}

/**
 * Enqueue scripts and styles.
 */
function bcp_scripts() {

	// wp_enqueue_style( 'bcp-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );

	wp_enqueue_style( 'bcp-font-awesome', get_template_directory_uri() . '/font_awesome/css/font-awesome.min.css' );

	wp_enqueue_style( 'bcp-style', get_stylesheet_uri() );


	wp_enqueue_script( 'bcp-jquery-slim-script', '//code.jquery.com/jquery-3.2.1.min.js', array(), '4.0.0', true );

	wp_enqueue_script( 'bcp-popper-script', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js', array(), '4.0.0', true );

	// wp_enqueue_script( 'bcp-bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '4.0.0', true );

	wp_enqueue_script( 'bcp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'bcp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), '4.2.0', true );

	wp_enqueue_script( 'bcp-main-script', get_template_directory_uri() . '/js/script.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bcp_scripts' );
 
 
/**
 * Implement load more on post.
 */
require get_template_directory() . '/inc/lms.php';
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


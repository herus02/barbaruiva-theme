<?php
/**
 * Roots initial setup and constants
 */
function roots_setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/roots-translations
  load_theme_textdomain('roots', get_template_directory() . '/lang');

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Add post formats
  // http://codex.wordpress.org/Post_Formatsww
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', array('caption', 'comment-form', 'comment-list'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('/assets/css/editor-style.css');

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus(array('primary_navigation' => __('Primary Navigation', 'roots')));
  register_nav_menu( 'social', __( 'Menu Social Media', 'roots' ) );
  register_nav_menu( 'footer', __( 'Menu Footer', 'roots' ) );

  /*
   * This theme uses a custom image size for featured images, displayed on
   * "standard" posts and pages.
   */
  if ( function_exists( 'add_theme_support' ) ) {
      add_theme_support( 'post-thumbnails' );

    add_image_size('home_banner-thumb', 154, 101, array( 'center', 'center' ), 1);
    add_image_size('album-thumb', 350, 200, array( 'center', 'center' ), 1);
    add_image_size('post-thumb', 350, 200, array( 'center', 'center' ), 1);

    add_image_size('post-image', 428, 428, array( 'left', 'top' ), 1);
    add_image_size('album-image', 428, 428, array( 'left', 'top' ), 1);
    add_image_size('home_banner-image', 1600, 700, array( 'center', 'center' ), 1);
  }

    add_post_type_support('post', 'excerpt');
    add_post_type_support('page', 'excerpt');
    add_post_type_support('page', 'page-attributes');  
}
add_action('after_setup_theme', 'roots_setup');

/**
 * Register sidebars
 */
function roots_widgets_init() {
 
  register_sidebar(array(
    'name'          => __('Footer 1', 'roots'),
    'id'            => 'sidebar-footer-1',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));

  register_sidebar(array(
    'name'          => __('Footer 2', 'roots'),
    'id'            => 'sidebar-footer-2',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));
}
add_action('widgets_init', 'roots_widgets_init');


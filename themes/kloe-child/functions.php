<?php


/*-----------------------------------------------------------------------------------*/
/* 01. CONSTANTS */
/*-----------------------------------------------------------------------------------*/
define('MNB_VERSION', 1.0);
define('MNB_PARENT_PATH', get_template_directory());
define('MNB_PARENT_URL', get_template_directory_uri());
define('MNB_THEME_PATH', get_stylesheet_directory());
define('MNB_THEME_URL', get_stylesheet_directory_uri());

define('MNB_LANG', MNB_THEME_PATH . '/languages');
define('MNB_TEXDOMAIN', 'kloe');

define('MNB_INCLUDES', MNB_THEME_PATH . '/includes');
define('MNB_VIEWS', MNB_THEME_PATH . '/views');

define('MNB_ASSETS', MNB_THEME_URL . '/assets');
define('MNB_CSS', MNB_ASSETS . '/css');
define('MNB_JS', MNB_ASSETS . '/js');
define('MNB_FONTS', MNB_ASSETS . '/fonts');
define('MNB_IMG', MNB_ASSETS . '/img');
define('MNB_VENDORS', MNB_ASSETS . '/vendors');

/*-----------------------------------------------------------------------------------*/
/* 02. INCLUDES */
/*-----------------------------------------------------------------------------------*/
include('includes/class-shortcodes.php');
include('includes/class-vendors-settings.php');

add_action( 'after_setup_theme', 'kloe_child_theme_setup' );
function kloe_child_theme_setup(){
	load_child_theme_textdomain( MNB_TEXDOMAIN, MNB_LANG );
}

/*** Child Theme Function  ***/

function kloe_qodef_child_theme_enqueue_scripts() {
	wp_register_style('main', get_stylesheet_directory_uri() . '/assets/css/main.css');
	wp_enqueue_style('main');
	wp_register_style('childstyle', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style('childstyle');

	wp_register_script('script', MNB_JS . '/main.js', array(), MNB_VENDORS, true);
	wp_enqueue_script('script');
}
add_action('wp_enqueue_scripts', 'kloe_qodef_child_theme_enqueue_scripts', 11);



remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');

require_once ('includes/woo.php');

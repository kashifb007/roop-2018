<?php
/**
 * Roop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Roop
 * @since 1.0
 */
/**
 * Enqueue scripts and styles.
 */
function roop_scripts() {	

	$var = 1.0;

	wp_enqueue_style( 'grid', get_theme_file_uri( '/css/grid.css?ver=' . $var ), array(), null );
	wp_enqueue_style( 'style', get_theme_file_uri( '/style.css?ver=' . $var ), array(), null );	
	wp_enqueue_style( 'camera', get_theme_file_uri( '/css/camera.css?ver=' . $var ), array(), null );
	wp_enqueue_style( 'jquery.fancybox', get_theme_file_uri( '/css/jquery.fancybox.css?ver=' . $var ), array(), null );
	wp_enqueue_style( 'contact-form', get_theme_file_uri( '/css/contact-form.css?ver=' . $var ), array(), null );
	wp_enqueue_style( 'google-map', get_theme_file_uri( '/css/google-map.css?ver=' . $var ), array(), null );
	wp_enqueue_style( 'custom-css', get_theme_file_uri( '/css/style.php' ), array(), null );
	wp_enqueue_style( 'jquery-ui', get_theme_file_uri( '/css/jquery-ui.css?ver=' . $var ), array(), null );
	
	wp_enqueue_script( 'jquery1', get_theme_file_uri( '/js/jquery.js' ), array(), '1.0');
	wp_enqueue_script( 'emailhide', get_theme_file_uri( '/js/jquery.emailHide.js' ), array(), '1.0');
	wp_enqueue_script( 'jquery-migrate-1', get_theme_file_uri( '/js/jquery-migrate-1.2.1.js' ), array(), '1.0');
	wp_enqueue_script( 'device.min', get_theme_file_uri( '/js/device.min.js' ), array(), null);
	wp_enqueue_script( 'jquery-ui', '//code.jquery.com/ui/1.12.1/jquery-ui.js', array(), '1.12.1');

}
add_action( 'wp_enqueue_scripts', 'roop_scripts' );


//--------------custom meta boxes-------------------------
//--------------custom meta boxes-------------------------

define('MY_WORDPRESS_FOLDER',$_SERVER['DOCUMENT_ROOT']);
define('MY_THEME_FOLDER',str_replace('\\','/',dirname(__FILE__)));
define('MY_THEME_PATH','/' . substr(MY_THEME_FOLDER,stripos(MY_THEME_FOLDER,'wp-content')));

add_action('admin_init','my_meta_init');

function my_meta_init()
{
	// review the function reference for parameter details
	// http://codex.wordpress.org/Function_Reference/wp_enqueue_script
	// http://codex.wordpress.org/Function_Reference/wp_enqueue_style

	wp_enqueue_style('my_meta_css', MY_THEME_PATH . '/custom/meta.css');

	// review the function reference for parameter details
	// http://codex.wordpress.org/Function_Reference/add_meta_box

	foreach (array('post','page') as $type) 
	{
		add_meta_box('my_all_meta', 'Header Text', 'my_meta_setup', $type, 'normal', 'high');
	}
	
	add_action('save_post','my_meta_save');
}

function my_meta_setup()
{
	global $post;
 
	// using an underscore, prevents the meta variable
	// from showing up in the custom fields section
	$meta = get_post_meta($post->ID,'_my_meta',TRUE);
 
	// instead of writing HTML here, lets do an include
	include(MY_THEME_FOLDER . '/custom/meta.php');
 
	// create a custom nonce for submit verification later
	echo '<input type="hidden" name="my_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}
 
function my_meta_save($post_id) 
{
	// authentication checks

	// make sure data came from our meta box
	if (!wp_verify_nonce($_POST['my_meta_noncename'],__FILE__)) return $post_id;

	// check user permissions
	if ($_POST['post_type'] == 'page') 
	{
		if (!current_user_can('edit_page', $post_id)) return $post_id;
	}
	else 
	{
		if (!current_user_can('edit_post', $post_id)) return $post_id;
	}

	// authentication passed, save data

	// var types
	// single: _my_meta[var]
	// array: _my_meta[var][]
	// grouped array: _my_meta[var_group][0][var_1], _my_meta[var_group][0][var_2]

	$current_data = get_post_meta($post_id, '_my_meta', TRUE);	
 
	$new_data = $_POST['_my_meta'];

	my_meta_clean($new_data);
	
	if ($current_data) 
	{
		if (is_null($new_data)) delete_post_meta($post_id,'_my_meta');
		else update_post_meta($post_id,'_my_meta',$new_data);
	}
	elseif (!is_null($new_data))
	{
		add_post_meta($post_id,'_my_meta',$new_data,TRUE);
	}

	return $post_id;
}

function my_meta_clean(&$arr)
{
	if (is_array($arr))
	{
		foreach ($arr as $i => $v)
		{
			if (is_array($arr[$i])) 
			{
				my_meta_clean($arr[$i]);

				if (!count($arr[$i])) 
				{
					unset($arr[$i]);
				}
			}
			else 
			{
				if (trim($arr[$i]) == '') 
				{
					unset($arr[$i]);
				}
			}
		}

		if (!count($arr)) 
		{
			$arr = NULL;
		}
	}
}
//--------------custom meta boxes------------------------- end
//--------------custom meta boxes------------------------- end

//add custom post type services
add_action( 'init', 'create_post_type_services' );
function create_post_type_services() {
	register_post_type( 'services',
		array(
			'labels' => array(
				'name' => __( 'Services' ),
				'singular_name' => __( 'Services' )
			),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'services'),
		'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'revisions' , 'post-templates'),
		'taxonomies' => array('category', 'post_tag')
		)
	);
}

//add custom post type products
add_action( 'init', 'create_post_type_products' );
function create_post_type_products() {
	register_post_type( 'products',
		array(
			'labels' => array(
				'name' => __( 'Products' ),
				'singular_name' => __( 'Products' )
			),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'products'),
		'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'revisions' , 'post-templates'),
		'taxonomies' => array('category', 'post_tag')
		)
	);
}

//add custom post type home-page-images
add_action( 'init', 'create_post_type_home_page_images' );
function create_post_type_home_page_images() {
	register_post_type( 'home-page-images',
		array(
			'labels' => array(
				'name' => __( 'Home Images' ),
				'singular_name' => __( 'Home Images' )
			),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'home-page-images'),
		'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'revisions', 'post-templates'),
		'taxonomies' => array('category', 'post_tag')
		)
	);
}

//add sort order for all post types on right side
add_action('add_meta_boxes', 'sortorder_meta_box_init');
// meta box functions for adding the meta box and saving the data
function sortorder_meta_box_init() {
// create our custom meta box
$post_types = get_post_types();
    foreach ( $post_types as $post_type ) {
        add_meta_box( 'sortorder_all_meta', 'Sort Order', 'sortorder_meta_box', $post_type, 'side', 'default' );
    }
}

function sortorder_meta_box($post, $box)
{
	$sort_order = get_post_meta($post->ID, '_sort_order', true);
	//nonce for security
	wp_nonce_field( plugin_basename( __FILE__ ), 'sortorder_save_meta_box' );

	echo '<p>Sort Order: <input type="text" name="sort_order" value="'.esc_attr($sort_order).'" size="5" /></p>';
}

// hook to save our meta box data when the post is saved
add_action('save_post', 'sortorder_save_meta_box' );

function sortorder_save_meta_box( $post_id ) {
// process form data if $_POST is set
	if( isset( $_POST['sort_order'] ) ) {
	// if auto saving skip saving our meta box data
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	return;
	//check nonce for security
	wp_verify_nonce( plugin_basename( __FILE__ ), 'sortorder_save_meta_box' );
	// save the meta box data as post meta using the post ID as a unique prefix
	update_post_meta( $post_id, '_sort_order',
	sanitize_text_field( $_POST['sort_order'] ) );

	}
}

//Extra information meta box
add_action( 'add_meta_boxes', 'tgm_custom_meta_box' );
function tgm_custom_meta_box() {
    $post_types = get_post_types();
    foreach ( $post_types as $post_type ) {
        add_meta_box( 'my_all_meta', 'Extra Information', 'my_meta_setup', $post_type, 'normal', 'high' );
    }
}

// set up featured images on custom posts
add_theme_support('post-thumbnails');
<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentyfifteen', get_template_directory() . '/languages' );

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
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	/*
	 * Enable support for custom logo.
	 *
	 * @since Twenty Fifteen 1.5
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Fifteen 1.1
 */
function twentyfifteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}
//add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );


/*
* Madico Theme Functions
*/

/**
 * Function name : Madico Scripts
 *
 * @package     : WordPress
 * @subpackage  : Twenty_Fifteen
 * @Description : Madico Theme  style and scripts
 * @Created At  : 15 June 2016
 * @Modified At : 21 July 2016
 * @Created By  : Mahendra Prasath.D
 * @Modified By : Sathiyaraj
 */
function madico_scripts() {
	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'madic-style', get_template_directory_uri() . '/css/stylesheet.css');
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css');
    wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
    wp_enqueue_script( 'jquery-lib', get_template_directory_uri() . '/js/jquery-1.11.3.min.js' );
    wp_enqueue_script( 'jquery-validation-lib', get_template_directory_uri() . '/js/jquery.validate.min.js' );
    wp_enqueue_script( 'block-ui', 'http://malsup.github.io/jquery.blockUI.js' );
    wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.min.js' );
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js' );
    wp_enqueue_script( 'input-mask-js', get_template_directory_uri() . '/js/inputmask.js');
    wp_enqueue_script( 'Custom-Js', get_template_directory_uri() . '/js/custom.js' );


}
add_action( 'wp_enqueue_scripts', 'madico_scripts' );


// ┌────────────────────────────────────────────────────────────────────┐ \\
// │To Modify the admin side styles / Script by using this functions    |\\
// ├────────────────────────────────────────────────────────────────────┤ \\
// │ FUN NAME :                                                         | \\
// │ USAGE    :  Following code use to the comparess the html and css   |
// |and javaript.   													| \\
// ├────────────────────────────────────────────────────────────────────┤ \\
// │ Created Date : July 05 2016  										| \\
// │ Updated Date : July 05 2016                                        | \\
// │ Created By   : Mahendra Prasath                                    | \\
// │ Updated By   :                                                     | \\
// └────────────────────────────────────────────────────────────────────┘ \\


function admin_style() {
   wp_enqueue_style( 'adminstyle', get_template_directory_uri() . '/css/admincss.css');
   wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css');
}
add_action('admin_enqueue_scripts', 'admin_style');

function media_script_enqueue() {
   wp_enqueue_script( 'input-mask-js', get_template_directory_uri() . '/js/inputmask.js');
   wp_enqueue_script( 'admin-panel-js', get_template_directory_uri() . '/js/adminjs.js');
}
//add_action( 'wp_enqueue_scripts', 'media_script_enqueue' ); // Front-end
add_action( 'admin_enqueue_scripts', 'media_script_enqueue' ); // Back-end


/**
 * Function name : Bs_Post_Types
 * @Description  : To Create the custom post type to handle the dealer list on admmin interface.
 * @Created At   : 11 July 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */

/****************************************************
 * Module Name    : Declaring the global variable for states for USA and Canada
 * Created Date   : 16-08-2016
 * Modified Date  :
 * Created By     : Balasuresh A
 * Modified By    :
 * *************************************************/
function statesList(){
    global $countryState;
    $countryState = array(
    'AL'=>'Alabama',
    'AK'=>'Alaska',
    'AZ'=>'Arizona',
    'AR'=>'Arkansas',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DE'=>'Delaware',
    'DC'=>'District of Columbia',
    'FL'=>'Florida',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'IA'=>'Iowa',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'ME'=>'Maine',
    'MD'=>'Maryland',
    'MA'=>'Massachusetts',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MS'=>'Mississippi',
    'MO'=>'Missouri',
    'MT'=>'Montana',
    'NE'=>'Nebraska',
    'NV'=>'Nevada',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NY'=>'New York',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VT'=>'Vermont',
    'VA'=>'Virginia',
    'WA'=>'Washington',
    'WV'=>'West Virginia',
    'WI'=>'Wisconsin',
    'WY'=>'Wyoming',
    'AB'=>'Alberta',
    'BC'=>'British Columbia',
    'MB'=>'Manitoba',
    'NB'=>'New Brunswick',
    'NL'=>'Newfoundland and Labrador',
    'NT'=>'Northwest Territories',
    'NS'=>'Nova Scotia',
    'NU'=>'Nunavut',
    'ON'=>'Ontario',
    'PE'=>'Prince Edward Island',
    'QC'=>'Quebec',
    'SK'=>'Saskatchewan',
    'YT'=>'YT',
);
}

add_action('after_setup_theme','statesList');


add_action( 'init', 'bs_post_types' );
function bs_post_types() {

  $labels = array(
    'name'                => __( 'Dealers', THEMENAME ),
    'singular_name'       => __( 'Dealer', THEMENAME ),
    'add_new'             => __( 'Add New', THEMENAME ),
    'add_new_item'        => __( 'Add New Dealer', THEMENAME ),
    'edit_item'           => __( 'Edit Dealer', THEMENAME ),
    'new_item'            => __( 'New Dealer', THEMENAME ),
    'all_items'           => __( 'All Dealer', THEMENAME ),
    'view_item'           => __( 'View Dealer', THEMENAME ),
    'search_items'        => __( 'Search Dealers', THEMENAME ),
    'not_found'           => __( 'No dealers found', THEMENAME ),
    'not_found_in_trash'  => __( 'No dealers found in Trash', THEMENAME ),
    'menu_name'           => __( 'Dealers', THEMENAME ),
  );

  $supports = array( 'title', 'editor' );
  $slug = get_theme_mod( 'dealer_permalink' );
  $slug = ( empty( $slug ) ) ? 'dealer' : $slug;

  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'query_var'           => true,
    'rewrite'             => array( 'slug' => $slug ),
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => null,
    'supports'            => $supports,
  );
  register_post_type( 'dealer', $args );
}

/**
 * Function name : my_rem_editor_from_post_type
 * @Description  : To remove the Text-Editor from the Add/Edit dealer page.
 * @Created At   : 11 July 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */

add_action('init', 'my_rem_editor_from_post_type');
function my_rem_editor_from_post_type() {
    remove_post_type_support( dealer, 'editor');
    //remove_post_type_support( dealer, 'title');
}

/**
 * Function name : bs_dealer_table_head
 * @Description  : Showing list of header in dealer list table on admin interface.
 * @Created At   : 11 July 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */

add_filter('manage_dealer_posts_columns', 'bs_dealer_table_head');
function bs_dealer_table_head( $defaults ) {
	if ( 'dealer' == get_post_type()){
    $defaults['Dealer_ID']='Dealer ID';
    $defaults['dealer_name']  = 'Dealer Name';
    $defaults['category']    = 'Category';
    $defaults['post_modified']   = 'Date Modifield';
    $defaults['Delete'] = 'Delete';
    $defaults['Edit'] = 'Edit';
    $defaults['Enable'] = 'Enable';
	}
    return $defaults;
}

/**
 * Function name : bs_dealer_table_content
 * @Description  : Showing list of header in dealer list table on admin interface.
 * @Created At   : 11 July 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */

add_action( 'manage_dealer_posts_custom_column', 'bs_dealer_table_content', 10, 2 );
function bs_dealer_table_content( $column_name, $post_id ) {
    if ($column_name == 'event_date') {
    $event_date = get_post_meta( $post_id, '_bs_meta_event_date', true );
      //echo  date( _x( 'F d, Y', 'Event date format', 'textdomain' ), strtotime( $event_date ) );
    }

    if ($column_name == 'Dealer_ID') {
    	echo $dealer_id = get_post_meta( $post_id, 'dealer_id', true );
    }
    if($column_name == 'dealer_name'){
    	echo $dealer_name = get_post_meta( $post_id, 'company_name', true );
    }
    if($column_name == 'post_modified'){
    	$customDate = get_the_modified_date( $postid);
        $newDate = date("m/d/Y", strtotime($customDate));
        echo $newDate;
    }
    if ($column_name == 'category') {
   	$cat_1 = get_post_meta( $post_id, 'automotive', true );
   	$cat_2 = get_post_meta( $post_id, 'architectural', true );
   	$cat_3 = get_post_meta( $post_id, 'safety_and_security', true );
   	echo ($cat_1[0]==1 ? 'Automotive '.'</br>':'');
   	echo ($cat_2[0]==1 ? 'Architectural '.'</br>':'');
   	echo ($cat_3[0]==1 ? 'Safety and Security':'');
   	}
        
    $post_Type=$_GET['post_type']; 
    $post_Status=$_GET['post_status'];
    if(($post_Type=='dealer')&&($post_Status=='trash')){
    if ($column_name == 'Delete') {
    ?>
    <a id="font-size" onclick="return confirm('Are you sure that you want to delete this dealer entry from the database ?')" href="<?php echo get_delete_post_link($id, $deprecated,true ) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
    <?php
    }
    }
    else { 
    if ($column_name == 'Delete') {    
        
        ?>
       <a id="font-size" onclick="return confirm('Are you sure that you want to delete this dealer entry from the database ?')" href="<?php echo get_delete_post_link( $id, $deprecated ) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
    <?php  } } 
    
    if ($column_name == 'Edit') {
    echo edit_post_link('<i id="font-size" class="fa fa-pencil-square-o" aria-hidden="true"></i>');

    }

    if($column_name=='Enable'){
    $status = get_post_meta( $post_id, '_enable_dealer', true );
    ?>
    <input type="hidden"  class="postid" value="<?php echo $post_id; ?>">
    <?php
    	echo (!empty($status)?'<input class="enable_dealer" type="checkbox" checked="checked" name="checkbox_value" value="1">':'<input type="checkbox" class="enable_dealer"  name="checkbox_value" value="0">');
    }
}


/**
 * Function name : bs_dealer_bulk_actions
 * @Description  : Hide the bulk edit from the dealer list page.
 * @Created At   : 12 July 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */

add_filter( 'bulk_actions-edit-dealer', 'bs_dealer_bulk_actions' );
    function bs_dealer_bulk_actions( $actions ){
    	if ( 'dealer' == get_post_type()){
        	unset( $actions[ 'edit' ] );
    	}
        return $actions;
 }

/**
 * Function name : bs_dealer_table_sorting
 * @Description  : Added the Sorting option for ID,Date  and Post Title.
 * @Created At   : 12 July 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */


add_filter( 'manage_edit-dealer_sortable_columns', 'bs_dealer_table_sorting' );
function bs_dealer_table_sorting( $columns ) {
	if ( 'dealer' == get_post_type()){
  		$columns['post_modified'] = 'post_modified';
  		$columns['Dealer_ID'] = 'Dealer_ID';
  		$columns['dealer_name'] = 'dealer_name';
  		$columns['category'] = 'category';
  	}
  return $columns;
}

/**
 * Function name : remove_post_columns
 * @Description  : Removed the tilte and date Coloums from the dealer list page.
 * @Created At   : 12 July 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */

function remove_post_columns($defaults) {
  if ( 'dealer' == get_post_type()){
  	unset($defaults['title']);
  	unset($defaults['date']);
	}
  return $defaults;
}
add_filter('manage_posts_columns', 'remove_post_columns');

/**
 * Function name : myplugin_add_custom_box
 * @Description  : Enable the Meta Box on add dealer page to save the value in database.
 * @Created At   : 13 July 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */

add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );
function myplugin_add_custom_box() {
    $screens = array( 'dealer', 'my_cpt' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'Enable_button_box',             // Unique ID
            'Enable Button Box',            // Box title
            'enable_button_custom_box',   // Content callback
             $screen                      // post type
        );
    }
}

/* Prints the box content */
function enable_button_custom_box( $post , $post_id ) {
$post_Type=$_GET['post_type'];
if(!empty($post_Type)&&($post_Type=='dealer')):
?>
<input type="text" name="myplugin_field" id="myplugin_field" class="postbox" value="1">
<style type="text/css">
#titlediv {
    display:none;
}
</style>
<?php
endif;
}
add_action( 'save_post', 'myplugin_save_postdata' );
function myplugin_save_postdata( $post_id ) {
    if ( array_key_exists('myplugin_field', $_POST ) ) {
        update_post_meta( $post_id,
           '_enable_dealer',
            $_POST['myplugin_field']
        );
    }
}

/**
 * Function name : myplugin_add_custom_box
 * @Description  : Rename the Button on the Add dealer page.
 * @Created At   : 14 July 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */

add_filter( 'gettext', 'change_publish_button', 10, 2 );
function change_publish_button( $translation, $text ) {
if ( 'dealer' == get_post_type()){
		if ( $text == 'Publish' ){
    	return 'Add Dealer';
		}
	}
	return $translation;
}

/**
 * Function name : enable_button
 * @Description  : Enable and disable dealer button on dealer list page.
 * @Created At   : 14 July 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */

function enable_button(){

	$post_id   = $_POST['postID'];
	$check_val = $_POST['cVal'];
		if($check_val=='1'){
			$enable_val='1';
			update_post_meta($post_id,'_enable_dealer',$enable_val);
			echo 1;
		}
		else{
			$enable_val='0';
			update_post_meta($post_id,'_enable_dealer',$enable_val);
			echo 0;
		}
	exit();
}
add_action( 'wp_ajax_enable_button', 'enable_button' ); // For logged-in user
add_action( 'wp_ajax_nopriv_enable_button', 'enable_button' );  // For non


/**
 * Function name : sliderPopup()
 * @Description  : To show the pop-up on the home page.
 * @Created At   : 02 July 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */


add_action( 'wp_ajax_sliderPopup', 'sliderPopup' ); // For logged-in user
add_action( 'wp_ajax_nopriv_sliderPopup', 'sliderPopup' );  // For non

function sliderPopup(){
$data = get_template_part('popup','slider');
$data;
exit;
}

/****************************************************
 * Module Name : Checking the unique validation for dealers id in Add Dealers page
 * Created Date : 30-07-2016
 * Modified Date :
 * Created By : Balasuresh A
 * Modified By :
 * *************************************************/

function check_DealerID(){
    global $wpdb;
    $tpl_postmeta=$wpdb->prefix."postmeta";
    if (isset($_REQUEST)) {
        $dealerID = $_REQUEST['username'];
        $results = $wpdb->get_results( "SELECT * FROM $tpl_postmeta WHERE meta_key = 'dealer_id' AND meta_value = '$dealerID' " );
        if(empty($results)) {
            echo '0';
        } else {
            echo '1';
        }
        wp_die();
    }
}
add_action('wp_ajax_check_DealerID', 'check_DealerID');
add_action('wp_ajax_nopriv_check_DealerID', 'check_DealerID');


/************************************************************************
 * Module Name   : Setting custom post type as post title to avoid 'Auto Draft'
 * Created Date  : 10-08-2016
 * Modified Date :
 * Created By    : Balasuresh A
 * Modified By   :
 * *********************************************************************/

//function custom_post_title( $data )
//{
//  global $post;
//  $id = $post->ID;
//
//  if('dealer' == $data['post_type'] && isset($data['post_type']))
//    if($id) {
//        $title = $_POST['fields']['field_578f5776649c4'];
//        $data['post_title'] = $title;
//    }
//  return $data;
//}
//
//add_filter( 'wp_insert_post_data' , 'custom_post_title' , '99', 1 );

/**
 * Function name : add_appearance_menu
 * @Description  : Add the menu to handle the theme options.
 * @Created At   : 27 July 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */


function madico_theme_menu()
{
  add_theme_page( 'Theme Option', 'Theme Options', 'manage_options', 'madico_options.php', 'madico_option_page');
}
add_action('admin_menu', 'madico_theme_menu');


function madico_option_page()
{
?>
    <div class="section panel">
      <h1>Custom Theme Options</h1>

    </div>
    <?php
}
/*********************************************************************
 * Module Name   : Checking the States with respect to the film type in home page
 * Created Date  : 16-08-2016
 * Modified Date :
 * Created By    : Balasuresh A
 * Modified By   :
 * ******************************************************************/

function filmtype_checkStates(){

    global $countryState;
    global $wpdb;
    $tpl_postmeta=$wpdb->prefix."postmeta";
    if (isset($_REQUEST)) {
        $filmSearch = $_REQUEST['filmType'];
        $results = $wpdb->get_results( "SELECT meta_id,meta_value FROM $tpl_postmeta WHERE meta_key = '$filmSearch'", ARRAY_A );
        foreach ($results as $result){
            $filmValue = unserialize($result['meta_value']) ;
             if($filmValue[0] == 1){
             $filmId[] =  $result['meta_id'] ;
             }
           }
        $filmIds = join("','",$filmId);
	$queryResults = $wpdb->get_results("SELECT * FROM $tpl_postmeta WHERE meta_id IN ('$filmIds') ",ARRAY_A);
        foreach($queryResults as $queryResult){
          $filmPostID[]=$queryResult['post_id'];
        }

        $filmStates = join("','",$filmPostID);
        $queryStates=$wpdb->get_results("SELECT * FROM $tpl_postmeta WHERE post_id IN ('$filmStates') ",ARRAY_A);
        foreach($queryStates as $queryState){
           if($queryState['meta_key'] == 'state') {
               $country[]= $queryState['meta_value'];
           }
        }

        $filmStatesProv = array_intersect_key($countryState, array_flip($country));
        echo json_encode($filmStatesProv);
        wp_die();
    }
}
add_action('wp_ajax_filmtype_checkStates', 'filmtype_checkStates');
add_action('wp_ajax_nopriv_filmtype_checkStates', 'filmtype_checkStates');


/*********************************************************************
 * Module Name   : Checking the cities with respect to the states in home page
 * Created Date  : 16-08-2016
 * Modified Date :
 * Created By    : Balasuresh A
 * Modified By   :
 * ******************************************************************/
function filmtype_checkCities(){
    global $wpdb;
    if (isset($_REQUEST)) {
        $tpl_postmeta=$wpdb->prefix."postmeta";
        $filmCitySearch = $_REQUEST['filmCitie'];
        $filmTypeSearch = $_REQUEST['filmType'];

        $results = $wpdb->get_results( "SELECT post_id,meta_value FROM $tpl_postmeta WHERE meta_key = '$filmTypeSearch' ", ARRAY_A );
        foreach ($results as $result){
             $filmValue = unserialize($result['meta_value']) ;
             if($filmValue[0] == 1){
             $filmId[] =  $result['post_id'] ;
             }
        }

        $filmIds = join("','",$filmId);
	$queryResults = $wpdb->get_results("SELECT * FROM $tpl_postmeta WHERE post_id IN ('$filmIds') AND meta_key='state' AND meta_value ='$filmCitySearch' ",ARRAY_A);
        foreach($queryResults as $queryResult){
          $filmPostID[]=$queryResult['post_id'];
        }
        $citiesPost_ids = join("','",$filmPostID);

	$query=$wpdb->get_results("SELECT * FROM $tpl_postmeta WHERE post_id IN ('$citiesPost_ids') ",ARRAY_A);
        foreach($query as $quer){
           if($quer['meta_key'] == 'city') {
               $citiesResults[]= $quer['meta_value'];
           }
        }
        $citiesResultsDis = array_unique($citiesResults, SORT_REGULAR);// distinct array values
        sort($citiesResultsDis); // sorting the array values
        $clength = count($citiesResultsDis);
        for($x = 0; $x < $clength; $x++) {
            $finalValue[] =$citiesResultsDis[$x];
        }
        echo json_encode($finalValue);
        wp_die();
    }
}
add_action('wp_ajax_filmtype_checkCities','filmtype_checkCities');
add_action('wp_ajax_nopriv_filmtype_checkCities','filmtype_checkCities');


/**
 * Function name : showall_dealers
 * @Description  : Show all dealer list which based on the specific fliters values
 * @Created At   : 18 Aug 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */

function showall_dealers(){
// Created the custom template for result page to displayed the dealer list details
global $post;
$data = get_template_part('content','result');

exit;
}
add_action( 'wp_ajax_showall_dealers','showall_dealers');
add_action( 'wp_ajax_nopriv_showall_dealers','showall_dealers');


/**
 * Function name : Loadmore_dealers
 * @Description  : Show all dealer list which based on the specific fliters values
 * @Created At   : 19 Aug 2016
 * @Modified At  :
 * @Created By   : Mahendra Prasath.D
 * @Modified By  :
 */

function loadmore_dealers(){
// Created the custom template for result page to displayed the dealer list details
global $post;
$data = get_template_part('content','result');

exit;
}
add_action( 'wp_ajax_loadmore_dealers','loadmore_dealers');
add_action( 'wp_ajax_nopriv_loadmore_dealers','loadmore_dealers');

/*********************************************************************
 * Module Name   : Checking the city status exists in our database
 * Created Date  : 01-08-2016
 * Modified Date :
 * Created By    : Balasuresh A
 * Modified By   :
 * ******************************************************************/

function check_States(){
    global $countryState;
    global $wpdb;
    $tpl_postmeta=$wpdb->prefix."postmeta";
    if (isset($_REQUEST)) {
        $stateSearch = $_REQUEST['country'];
        $results = $wpdb->get_results( "SELECT * FROM $tpl_postmeta WHERE meta_key = 'country' AND meta_value = '$stateSearch' " );
        foreach($results as $result) {
           $post_id[] = $result->post_id;
        }
        $ids = join("','",$post_id);
        $query=$wpdb->get_results("SELECT * FROM $tpl_postmeta WHERE post_id IN ('$ids') ",ARRAY_A);
        foreach($query as $quer){
           if($quer['meta_key'] == 'state') {
               $country[]= $quer['meta_value'];
           }
        }

        $sample = array_intersect_key($countryState, array_flip($country));
        echo json_encode($sample);
        wp_die();
    }
}
add_action('wp_ajax_check_States', 'check_States');
add_action('wp_ajax_nopriv_check_States', 'check_States');

/*******************************************************************
 * Module Name   : Checking the city status exists in our database
 * Created Date  : 01-08-2016
 * Modified Date :
 * Created By    : Balasuresh A
 * Modified By   :
 * ****************************************************************/

function check_Cities(){
    global $wpdb;
    $tpl_postmeta=$wpdb->prefix."postmeta";
    if (isset($_REQUEST)) {
        $citySearch = $_REQUEST['city'];
        $results = $wpdb->get_results( "SELECT * FROM $tpl_postmeta WHERE meta_key = 'state' AND meta_value = '$citySearch' " );
        foreach($results as $result) {
           $post_id[] = $result->post_id;
        }
        $ids = join("','",$post_id);
	$query=$wpdb->get_results("SELECT * FROM $tpl_postmeta WHERE post_id IN ('$ids') ",ARRAY_A);
        foreach($query as $quer){
           if($quer['meta_key'] == 'city') {
               $contactCity[]= $quer['meta_value'];
           }
        }
        $citiesResultsDis = array_unique($contactCity, SORT_REGULAR);// distinct array values
        sort($citiesResultsDis); // sorting the array values
        $clength = count($citiesResultsDis);
        for($x = 0; $x < $clength; $x++) {
            $sortedCities[] =$citiesResultsDis[$x];
        }

        echo json_encode($sortedCities);
       wp_die();
    }
}
add_action('wp_ajax_check_Cities', 'check_Cities');
add_action('wp_ajax_nopriv_check_Cities', 'check_Cities');


/************************************************************************
 * Module Name   : Sending email to the dealer with visitor information in contact dealer page
 * Created Date  : 17-08-2016
 * Modified Date :
 * Created By    : Balasuresh A
 * Modified By   :
 * *********************************************************************/

add_filter( 'wp_mail_content_type', 'set_content_type' );
function set_content_type( $content_type ) {
    return 'text/html';
}

//function attachInlineImage() {
//  global $phpmailer;
//  $file = 'http://www.gstatic.com/webp/gallery/1.jpg'; //phpmailer will load this file
//  $uid = 'my-cool-picture-uid'; //will map it to this UID
//  $name = '1.jpg'; //this will be the file name for the attachment
//  if (is_file($file)) {
//    $phpmailer->AddEmbeddedImage($file, $uid, $name);
//  }
//}

//add_action('phpmailer_init','attachInlineImage');


/************************************************************************
 * Module Name   : Email Letter Template
 * Created Date  : 23-08-2016
 * Modified Date :
 * Created By    : Balasuresh A
 * Modified By   :
 * *********************************************************************/

function contactDealer(){
    if (isset($_REQUEST)) {
    $to = $_REQUEST['dealerEmail'];
    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $email = $_REQUEST['email'];
    $question = $_POST['message'];
    $subject = 'Consumer Window Film Inquiry from Madico, Inc.';

    $message = "<html><head></head>"
            . "<body style='background:#5D5D5D; font-size:10px; margin:0; color:#000000; padding:0; font-family: 'Helvetica', arial, sans-serif;'>"
            . "<div style='background:#ffffff; width:600px; margin:0 auto;'>"
            . "<div><img src='".get_template_directory_uri()."/images/email-header.jpg' alt='Madico Logo' style='border: 0;vertical-align: middle;'></div>"
            . "<div style='padding-top:25px; padding-bottom:25px; padding-left:25px; padding-right:25px;background:#f4f4f4;'>"
            . "<h2 style='text-align:center; font-size:22px; color:#010204; font-weight:normal;'><b>Consumer Information</b></h2>"
            . "<table style='width: 100%;margin: 20px auto;border: 0;border-spacing: 3px;border-collapse: separate;'>"
            . "<tbody>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>First Name</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$firstName."</td>"
            . "</tr>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>Last Name</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$lastName."</td>"
            . "</tr>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>Email</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$email."</td>"
            . "</tr>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>Question</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$question."</td>"
            . "</tr>"
            . "</tbody>"
            . "</table>"
            . "<div>"
            . "<table style='width: 100%;margin: 20px auto;border: 0;border-spacing: 3px;border-collapse: separate;'>"
            . "<tbody>"
            . "<tr>"
            . "<td style='text-align:center; background:#5f5f5f;'><p style='color:#ffffff; font-size:13px;'>&copy; Madico Inc. All rights reserved</p></td>"
            . "</tr>"
            . "</tbody>"
            . "</table>"
            . "</div>"
            . "</div>"
            . "</div>"
            . "</body>"
            . "</html>";

    $headers = array('Content-Type: text/html; charset=UTF-8\r\n');
    $mailSend = wp_mail($to, $subject, $message,$headers);
    if($mailSend == 1) {
        echo 1; //for success message
    } else {
        echo 0; // for failure message
    }
    }
    wp_die();
}
add_action('wp_ajax_contactDealer', 'contactDealer');
add_action('wp_ajax_nopriv_contactDealer', 'contactDealer');

/************************************************************************
 * Module Name   : Customizing the auto suggest plug-in
 * Created Date  : 23-08-2016
 * Modified Date :
 * Created By    : Balasuresh A
 * Modified By   :
 * *********************************************************************/

add_action( 'wp_ajax_auto_suggest', 'auto_suggest_custom_function' );

function auto_suggest_custom_function() {
    ob_flush();
    global $wpdb,$current_screen; // this is how you get access to the database
    $post_type = get_option('auto_post_type');
    $whatever =  $_POST['whatever'];
    $post_type =  $_POST['post_type'];
    if(isset($whatever) && $whatever!='') {
    $sql = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts WHERE post_title LIKE  '%".$whatever."%' and post_status='publish' and post_type='$post_type'");
    //$whatever += 10;

    if(count($sql)>0){
         $name = array();
         foreach($sql as $res_name)
         {       //Debugbreak();
             $name[] = $res_name->post_title;
         }
         $name = implode('###',$name);
         /* decoding the HTML special characters for deaers title*/
         echo wp_specialchars_decode($name);
    }
  else
  {
      echo "No records found";
  }

    }
    die(); // this is required to terminate immediately and return a proper response
}

/************************************************************************
 * Module Name   : Changing the from email name in wp mail function
 * Created Date  : 19-09-2016
 * Modified Date :
 * Created By    : Balasuresh A
 * Modified By   :
 * *********************************************************************/
add_filter( 'wp_mail_from_name', 'custom_wp_mail_from_name' );
function custom_wp_mail_from_name( $original_email_from ) {
    return 'Madico Dealer Directory';
}

add_filter( 'wp_mail_from', 'custom_wp_mail_from' );
function custom_wp_mail_from( $original_email_address ) {
	return 'Admin <admin@dealerdirectory.madico.com>';
}

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';

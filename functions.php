<?php
/**
 * clarity functions and definitions
 *
 * @package clarity
 * @since clarity 1.0
 */


/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/theme-options/' );
	require_once dirname( __FILE__ ) . '/inc/theme-options/options-framework.php';
}



/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since clarity 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 700; /* pixels */

if ( ! function_exists( 'clarity_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since clarity 1.0
 */
function clarity_setup() {

	// Set-Up Theme
	require( get_template_directory() . '/inc/theme-setup.php' );
	
	// Time Ago Function (TY ThemeBlvd)
	require( get_template_directory() . '/inc/timeago.php' );
	
	// Zilla Likes
	require( get_template_directory() . '/inc/zilla-likes.php' );
	
	// Options CSS
	require( get_template_directory() . '/inc/css/options-css.php' );

	/**
	 * Make theme available for translation:
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'clarity', get_template_directory() . '/languages/' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails & Set Array of Image Sizes
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'singlepost', 550, 400, false );
	add_image_size( 'logo', 500, 100, false );
	add_image_size( 'retina_logo', 1000, 200, false );

	// Add Logo Size to Media Upload Dialog
	add_filter( 'image_size_names_choose', 'clarity_image_size_names_choose' );
	function clarity_image_size_names_choose( $sizes ) {
		$custom_sizes = array(
			'logo'			=> 'Site Logo Size',
			'retina_logo' 	=> 'Retina Site Logo Size'
		);
		return array_merge( $sizes, $custom_sizes );
	}
     
    /**
     * Add theme support for custom background
     */
    $background_args = array(
		'default-color'          => '#222',
		'default-image'          => get_template_directory_uri() . '/images/vertical_cloth.png',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
	add_theme_support( 'custom-background', $background_args );  
    
    /**
     * Add theme support for custom header
     */
    $header_args = array(
		'width'         => 600,
		'height'        => 200,
		'flex-height'	=> true,
		'default-image' => get_template_directory_uri() . '/images/clean_textile.png',
		'uploads'       => true,
	);
	add_theme_support( 'custom-header', $header_args );
    
    /**
     * Enable support for all the awesome Post Formats.
     */
    $post_formats = 	array(
	    				'aside',
	    				'gallery',
	    				'link',
	    				'image',
	    				'quote',
	    				'status',
	    				'video',
	    				'audio'
    				); 
    add_theme_support( 'post-formats', $post_formats );
    
}
endif; // clarity_setup
add_action( 'after_setup_theme', 'clarity_setup' );


/**
 * Enqueue scripts and styles
 */
function clarity_scripts() {
	
	wp_enqueue_script( 'jquery' );

	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'foundation', get_template_directory_uri() .  '/js/lib/foundation.min.js', array( 'jquery' ), false, true );
	
	wp_enqueue_script( 'theme', get_template_directory_uri() . '/js/theme.js', array( 'infinite_scroll' ), false, true, 12 );
	
	wp_enqueue_script( 'infinite_scroll', get_template_directory_uri() . '/js/lib/jquery.infinitescroll.min.js', array('jquery'), false, true );
	
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	
}
add_action( 'wp_enqueue_scripts', 'clarity_scripts' );


/**
 * Infinite Scroll
 */
function clarity_infinite_scroll_js() {
    if( ! is_singular() ) { ?>
    <script>
    var infinite_scroll = {
        loading: {
            img: "<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif",
            msgText: "<?php _e( 'Loading the next set of posts...', 'clarity' ); ?>",
            finishedMsg: "<?php _e( 'All posts loaded.', 'clarity' ); ?>"
        },
        "nextSelector":".nav a",
        "navSelector":".nav",
        "itemSelector":"article",
        "contentSelector":"#articles"
    };
    jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll );
    </script>
    <?php
    }
}
add_action( 'wp_footer', 'clarity_infinite_scroll_js',100 );



// version number function
function clarity_theme_version() {
    $clarity_theme = wp_get_theme();
    return $clarity_theme->Version;
}


// show admin notice after theme activation
function clarity_admin_notices() {
	global $pagenow;
	if( isset( $_GET['activated'] ) && 'themes.php' == $pagenow ) {
    // show notice
	ob_start(); ?>
	<div class="updated">
		<p>Thank you for using <strong>Clarity</strong>! You should play around with the <a href="<?php echo site_url(); ?>/wp-admin/themes.php?page=options-framework">Theme Options</a> - Have fun! Love, <strong>Captain Theme</strong>.</p>
	</div>
	<?php
	echo ob_get_clean();
	}
	else {
	}
}
add_action('admin_notices', 'clarity_admin_notices');


// Remove unneeded Wordpress menu items to enhance the 'tumblr-like' experience of simplicity
function remove_menus () {
global $menu;
	$restricted = array( __('Pages', 'clarity'), __('Links', 'clarity') );
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_menus');

// omit closing PHP tag
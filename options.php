<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 * @package Digigit
 * @since Digigit 1.0
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

	
/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Color Schemes
	$color_bar = array(
		'blue' => __('Blue', 'options_framework_theme'),
		'red' => __('Red', 'options_framework_theme'),
		'green' => __('Green', 'options_framework_theme'),
		'black' => __('Black', 'options_framework_theme'),
		'light' => __('Light', 'options_framework_theme'),
		'orange' => __('Orange', 'options_framework_theme'),
	);
	
	// Slider Animation Types
	$slider_types = array(
		'horizontal-push' => __('Horizontal Push', 'options_framework_theme'),
		'fade' => __('Fade', 'options_framework_theme'),
		'horizontal-slide' => __('Horizontal Slide', 'options_framework_theme'),
		'vertical-slide' => __('Vertical Slide', 'options_framework_theme')
	);
		
	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Defaults
	$headertype_defaults = array(
		'size' => '44px',
		'face' => 'Helvetica Neue',
		'style' => 'Bold',
		'color' => '#fff' );
		
	// Typography Options
	$headertype_options = array(
		'sizes' => array( '30','35','40','44','50','55','60' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('Layout', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Welcome to Clarity!', 'options_framework_theme'),
		'desc' => __('<p>Firstly, thank you for using <a href="http://captaintheme.com/themes/clarity/">Clartiy</a>!</p><p>If you ever are in need of support, please post in the <a href="http://wordpress.org/tags/clarity?forum_id=5#postform">Clarity Wordpress.org Support Forum</a>.</p>', 'options_framework_theme'),
		'type' => 'info');
	
	$options[] = array(
		'name' => __('Credits', 'options_framework_theme'),
		'desc' => __('<p>This theme is built upon a modified version of <a href="http://foundation.zurb.com/">Foundation</a> by ZURB.</p><p>The "likes" functionaity of the theme is made possible through a slightly modified version of <a href="http://www.themezilla.com/plugins/zillalikes/">ZillaLikes</a> by ThemeZilla.</p>'),
		'type' => 'info' );	

	$options[] = array( 
		"name" 	=> __("Footer Text", 'options_framework_theme'),
		"desc" 	=> __("If you enter some text here, it will replace the default footer text.", 'options_framework_theme'),
		"id"	=> "clarity_footer",
		"type" 	=> "textarea",
		"std" 	=> "");		
	
	$options[] = array(
		'name' => __('', 'options_framework_theme'),
		'desc' => 'You are running <strong>Version ' . clarity_theme_version() . '</strong> of Clarity. See <a href="http://captaintheme.com/clarity-live-changelog.txt" target="_blank">Live Changlog</a>.',
		'type' => 'info');	

	
	/* STYLE SETTINGS */
	
	$options[] = array(
		'name' => __('Style / Design', 'options_framework_theme'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Primary Theme Color/Accent', 'options_framework_theme'),
		'desc' => __('This color will determine the color of elements such as Menu Links and Title Links.', 'options_framework_theme'),
		'id' => 'clarity_primary_color',
		'std' => '#6AA0FB',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Secondary Theme Color/Accent', 'options_framework_theme'),
		'desc' => __('This color will compliment the primary theme color chosen above, so should be quite similar and probably a little darker.', 'options_framework_theme'),
		'id' => 'clarity_secondary_color',
		'std' => '#3b83ff',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('', 'options_framework_theme'),
		'desc' => __('<p>The site logo will appear centered in the site\'s header. If you don\'t upload an image directly below, it will display the site\'s title.', 'options_framework_theme'),
		'type' => 'info');
	
	$options[] = array(
		'name' => __('Site Logo', 'options_framework_theme'),
		'desc' => __('Either upload your site\'s logo or paste the URL for it here. You should use an image that has a transparent background and is a PNG, or match the background color of the image to the header background color. Insert the <em>Site Logo Size</em> image.', 'options_framework_theme'),
		'id' => 'clarity_logo',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Retina Site Logo', 'options_framework_theme'),
		'desc' => __('If you\'d like to upload a <a href="http://coding.smashingmagazine.com/2012/08/20/towards-retina-web/">Retina</a> site logo, either upload it here or paste the URL. It should be double the width/height of your standard logo. This is not necessary and just leave it if you are confused. Insert the <em>Retina Logo Size</em> image.', 'options_framework_theme'),
		'id' => 'clarity_logo_retina',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Custom CSS', 'options_framework_theme'),
		'desc' => __('Put any custom CSS you want in here. Please make sure it\'s all valid as it may break the theme otherwise.', 'options_framework_theme'),
		'id' => 'clarity_css',
		'type' => 'textarea');
	
		
	/* SOCIAL MEDIA SETTINGS */
	
	$options[] = array(
		'name' => __('Social Media', 'options_framework_theme'),
		'type' => 'heading');
		
	$options[] = array(
		'desc' => __('<p>To activate social media icons in the header, just add the corresponding links below.</p><p><strong>Only</strong> those that have been filled in will be displayed.</p><p>Icons courtesy of <a href="http://www.webdesignerdepot.com/">Webdesigner Depot</a>.</p>', 'options_framework_theme'),
		'type' => 'info');
	
	$options[] = array( 
		"name" => __("Facebook Page/Profile URL", 'options_framework_theme'),
		"desc" => __("Enter the link for your Facebook Page/Profile.", 'options_framework_theme'),
		"id" => "sm_facebook",
		"type" => "text",
		"std" => "");
	
	$options[] = array( 
		"name" => __("Twitter URL", 'options_framework_theme'),
		"desc" => __("Enter the link for your Twiiter.", 'options_framework_theme'),
		"id" => "sm_twitter",
		"type" => "text",
		"std" => "");

	$options[] = array( 
		"name" => __("Tumblr URL", 'options_framework_theme'),
		"desc" => __("Enter the link for your Tumblr.", 'options_framework_theme'),
		"id" => "sm_tumblr",
		"type" => "text",
		"std" => "");
	
	$options[] = array( 
		"name" => __("Pinterest URL", 'options_framework_theme'),
		"desc" => __("Enter the link for your Pinterest Profile.", 'options_framework_theme'),
		"id" => "sm_pinterest",
		"type" => "text",
		"std" => "");

	$options[] = array( 
		"name" => __("YouTube URL", 'options_framework_theme'),
		"desc" => __("Enter the link for your YouTube.", 'options_framework_theme'),
		"id" => "sm_youtube",
		"type" => "text",
		"std" => "");

	$options[] = array( 
		"name" => __("Vimeo URL", 'options_framework_theme'),
		"desc" => __("Enter the link for your Vimeo.", 'options_framework_theme'),
		"id" => "sm_vimeo",
		"type" => "text",
		"std" => "");

	$options[] = array( 
		"name" => __("Flickr URL", 'options_framework_theme'),
		"desc" => __("Enter the link for your Flickr.", 'options_framework_theme'),
		"id" => "sm_flickr",
		"type" => "text",
		"std" => "");
	
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

});
</script>

<?php
}
<?php

/* For Sidebar Default */
register_sidebar( array(
    'name' => __( 'Sidebar', 'spiritualized' ),
    'id' => 'sidebar',
	'description' => __( 'Place widgets here to be displayed in the footer sidebar.', 'clarity' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
));

// Remove the <p> from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

/** Fix for social media icons turned off in theme options **/
function clarity_sm_head() {
	$twitter = of_get_option('sm_twitter');
	$facebook = of_get_option('sm_facebook');
	$pinterest = of_get_optioN('sm_pinterest');
	$tumblr = of_get_option('sm_tumblr');
	$youtube = of_get_option('sm_youtube');
	$vimeo = of_get_option('sm_vimeo');
	$flickr = of_get_option('sm_flickr');
	 
	if  ( $twitter == '' ) {
		echo 'li.twitter {display:none !important;}';
		}
		else {
		}
	if  ( $facebook == '' ) {
		echo 'li.facebook {display:none !important;}';
		}
		else {
		}
	if  ( $pinterest == '' ) {
		echo 'li.pinterest {display:none !important;}';
		}
		else {
		}
	if  ( $tumblr == '' ) {
		echo 'li.tumblr {display:none !important;}';
		}
		else {
		}
	if  ( $youtube == '' ) {
		echo 'li.youtube {display:none !important;}';
		}
		else {
		}
	if  ( $vimeo == '' ) {
		echo 'li.vimeo {display:none !important;}';
		}
		else {
		}
	if  ( $flickr == '' ) {
		echo 'li.flickr {display:none !important;}';
		}
		else {
		}
}


// COMMENT STUFF
/**
 * ${Description}
 *
 * @package  WP Unframework
 * @subpackage comments.php
 *
 */

add_action( 'comment_form_top', 'wpu_insert_comment_form' );
add_filter( 'comment_form_defaults', 'wpu_comment_defaults' );
 

/**
 * Template for displaying comments
 * Used as a callback by wp_list_comments for displaying the comments in comments.php
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="commentbox">
      <div class="authorpart">
<div class="avatar">
<?php echo get_avatar( $comment, 32 ); ?>
</div>
<div class="name">
<?php comment_author_link(); ?> <span class="timeago">(<?php echo human_time_diff(get_comment_time('U'), current_time('timestamp')) . ' ago'; ?>)</span>
</div>
</div>

<hr/>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', 'clarity') ?></em>
         <br />
      <?php endif; ?>
	
	<div class="commenttext">
      <?php comment_text() ?>
	</div>
	
      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
         <?php edit_comment_link(__('Edit', 'clarity'),'  ','') ?>
      </div>
     </div>
<?php
        }


/**
 * Template for Trackbacks
 * Used as a callback by wp_list_comments() for displaying the comments in comments.php.
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function wpu_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
    		<li><?php comment_author_link() ?></li>
<?php }

/**
 * Filter the default comment form
 *
 * @param $defaults
 * @return array
 */
function wpu_comment_defaults( $defaults ) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$required_text = sprintf( ' ' . __( 'Required fields are marked %s', 'clarity' ), '<span class="required">*</span>' );
	$fields = array (
		'author'  => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'clarity' ) . '<span class="required"> *</span></label> ' .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" title="Your Name" size="30" required /></p>',
		'email'   => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'clarity' ) . '<span class="required"> *</span></label> ' .
				'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" title="Your E-mail" size="30" required /></p>',
		'url'     => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'clarity' ) . '</label>' .
				'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" title="Your Website (optional)" size="30" /></p>',
		'comment' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'clarity' ) . '<span class="required"> *</span></label><textarea id="comment" name="comment" cols="45" rows="8" title="Your Comment" aria-required="true" required></textarea></p>',
	);

	$defaults['title_reply'] = __( 'Add Your Comment', 'startbox' ) . ' <a href="http://gravatar.com" class="h3-link">(Get a Gravatar)</a>';
	$defaults['fields'] = apply_filters( 'comment_form_default_fields', $fields );
	$defaults['comment_field'] = '';
	$defaults['comment_notes_before'] = '';
	$defaults['comment_notes_after'] = '<p class="comment-notes">' . __( 'Your email address will <strong>not</strong> be published.', 'clarity' ) . ( $req ? $required_text : '' ) . '.</p>';
	$defaults['label_submit'] = 'Post Your Comment';
	$defaults['id_submit'] = 'mc_button';

	return $defaults;


}


function wpu_insert_comment_form() {
		?>
	<?php if ( is_user_logged_in() ) {
		echo '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'clarity' ) . '<span class="required"> *</span></label><textarea id="comment" name="comment" cols="45" rows="8" title="Your Comment" aria-required="true" required></textarea></p>';
		} else { }
	}


	
// Omit closing php tag for safety
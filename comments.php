<?php
/**
 * @package clarity
 * @since clarity 1.0
 */
?>

<?php
// do not delete these lines
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

if (!empty($post->post_password)) { // if there's a password
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
		?>
		
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'clarity'); ?><p>
		
		<?php
		return;
	}
}

?>

<a name="comments" /></a>
<div class="replies"><?php comments_number('No Comments', 'One Comment', '% Comments'); ?></div>
<ul class="commentlist">
<?php wp_list_comments('type=all&callback=mytheme_comment'); ?>
</ul>

<div class="navigation">
  <?php paginate_comments_links(); ?> 
</div>



<?php comment_form( array(
	'title_reply'          =>  __('Have something to say?', 'clarity' ),
	'comment_notes_before' => '',
	'comment_notes_after'  => '',
	) );

	?>
	
	<hr />
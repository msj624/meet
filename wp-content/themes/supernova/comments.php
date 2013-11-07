<?php
/**
 * The template for generating comment system
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */

global $supernova_options;
function supernova_comment($comment, $args, $depth) {
		   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID( ); ?>">
	<div id="comment-<?php comment_ID( ); ?>" class="supernova_comment_body">
       <div class="supernova_avtar">
            <?php if ($args['avatar_size'] && $args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
       </div>
           <div class="comment_stuff">
			<span class="supernova_author"><?php comment_author_link() ?> <span class="says"><?php _e('says', 'Supernova'); ?></span>
            </span>
			<?php if ($comment->comment_approved == '0') : ?><br /><br />
				<em><?php _e('Your comment is awaiting moderation.', 'Supernova'); ?></em>
			<?php endif; ?>
		<br />
	<small class="commentmetadata">
	<?php if(comment_date('l, F jS Y')){comment_date('l, F jS Y');} ?><?php _e(' at ', 'Supernova'); ?><?php if(comment_time()){comment_time();} ?>
	</small>
    	
		<div class="comment_text"><?php comment_text() ?></div>
	
	<span class="replyback"><?php echo comment_reply_link(array('before' => '<div class="reply">', 'after' => '</div>', 'reply_text' => 'Reply <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ));  ?></span>
	</div>
    	</div><!--comment_stuff -->
    <div class="clearfix"></div>
<?php } ?>


<?php $args = array(
	'walker'            => null,
	'max_depth'         => '',
	'style'             => 'ul',
	'callback'          => 'supernova_comment',
	'end-callback'      => null,
	'type'              => 'all',
	'reply_text'        => __('Reply', 'Supernova'),
	'page'              => '',
	'per_page'          => '',
	'avatar_size'       => 80,
	'reverse_top_level' => true,
	'reverse_children'  => true
); ?>

<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<?php _e('This post is password protected. Enter the password to view comments.', 'Supernova'); ?>
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	
	<h2 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?></h2>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist">
		<?php wp_list_comments($args); ?>
	</ol>
	<div class="clearfix"></div>
	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>

	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div id="respond">

	<h2><?php comment_form_title( 'POST A COMMENT', 'Leave a Reply to %s' ); ?></h2>

	<div class="cancel-comment-reply">
		<?php cancel_comment_reply_link(); ?>
	</div>
	<?php function sup_comment_form(){comment_form();} ?>
	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p><?php _e('You must be ', 'Supernova'); ?><a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in', 'Supernova'); ?></a> <?php _e('to post a comment.', 'Supernova'); ?></p>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( is_user_logged_in() ) : ?>

			<p class="loggedinas"><?php _e('Logged in as', 'Supernova') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out &raquo;', 'Supernova') ?></a></p>

		<?php else : ?>

			<div class="supernova_comments">
				<input placeholder="<?php _e('Name', 'Supernova') ?><?php if ($req) echo "(required)"; ?>" type="text" name="author" id="author" class="supernova-input" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />						
			

				<input type="text" placeholder="<?php _e('Email', 'Supernova') ?> <?php if ($req) echo "(required)"; ?>" name="email" id="email" class="supernova-input" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
										
				<input type="text" placeholder="<?php _e('Website', 'Supernova') ?>" name="url" id="url" class="supernova-input" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" /><br />
				
			</div><!--supernova_comment ENDS -->

		<?php endif; ?>
		
		<div class="supernova_comments_textarea">
			<textarea name="comment" id="comment" rows="10" tabindex="4" class="supernova-input"></textarea>
		
        </div>
		<div>
			<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'Supernova') ?>" class="supernova-button s345" />
			<?php comment_id_fields(); ?>
		</div>
					<!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->
		<?php do_action('comment_form', $post->ID); ?>

	</form>

	<?php endif; // If registration required and not logged in ?>
	
</div>

<?php endif;

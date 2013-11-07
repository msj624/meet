<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = ' commentlist-alt';
?>

<!-- You can start editing here. -->

<?php if ($comments) : ?>
	<div id="comments">
		<h2><?php comments_number('No Comments', 'One Comment', '% Comments' );?></h2>
		<!-- <p>There <?php comments_number('are no comments', 'is one comment', 'are % comments'); ?>  for this post.</p> -->
	</div>

<ol class="commentlist">
<?php foreach ($comments as $comment) : ?>
	<li class="commentlist<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
		<cite>
			<?php if (function_exists('get_avatar')) { echo get_avatar($comment->comment_author_email, '36', $avatar); } ?>
			<span class="author"><?php comment_author_link() ?></span> 
			<span class="on">on</span>
			<span class="date"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F j, Y g:i a') ?></a> <?php edit_comment_link('Edit','|',''); ?></span>
		</cite>
		<div class="commenttext">
			<?php if ($comment->comment_approved == '0') : ?>
			<em>Your comment is awaiting moderation.</em>
			<?php else :  ?>
			<?php comment_text() ?>
			<?php endif; ?>
		</div>
	</li>
	<?php $oddcomment = ( empty( $oddcomment ) ) ? ' commentlist-alt' : '';?>
<?php endforeach; /* end for each comment */ ?>
</ol>

<?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>

<div id="postcomment">
	<h2>Write a Comment</h2>
	<!-- <p>Let me know what you think?</p> -->
</div>

<?php if ('open' == $post->comment_status) : ?>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></p>

<?php else : ?>

<p class="input">
	<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label>
	<span><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" /></span>
</p>
<p class="input">
	<label for="email"><small>Mail (will not be published<?php if ($req) echo ", required"; ?>)</small></label>
	<span><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" /></span>
</p>
<p class="input">
	<label for="url"><small>Website</small></label>
	<span><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /></span>
</p>

<?php endif; ?>

<p class="textarea">
	<label for="comment"><small>Message</small> <!-- <small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small> --></label>
	<span><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></span>
</p>

<p class="button">
	<button class="button" type="submit" id="submit" tabindex="5"><span>Submit Comment</span></button>
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>
</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

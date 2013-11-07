<?php

if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Side Bar',
		'before_widget' => '<div class="box box-%2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h2>',
		'after_title' => '</h2><div class="interior">',
	));
}

function themefunction_alterlinks($string) {
	$pattern = array('/<a[^<>]*>/','/<\/a[^<>]*>/');
	$replace = array('$0<span>','</span>$0');
	$string = preg_replace($pattern,$replace,$string);
	return $string;
}

function themefunction_altercategories($string) {
	$string = trim($string);
	$string = str_replace("\n","",$string);
	$string = str_replace("\r","",$string);
	$string = str_replace("\t","",$string);
	$string = str_replace("</li>","</li>\n",$string);
	$string = trim($string);
	$array = explode("\n",$string);
	$string = '';
	foreach ($array as $elem) {
		$elem = str_replace("</a>","",$elem);
		$string .= str_replace("</li>","</a></li>",$elem);
	}
	return $string;
}

function themefunction_cleanup($str) {
	global $akpc, $post;
	$show = true;
	$show = apply_filters('akpc_display_popularity', $show, $post);
	if (is_feed() || is_admin_page() || get_post_meta($post->ID, 'hide_popularity', true) || !$show) {
		return $str;
	}
	return $str.'';
}

function themefunction_recentcomments() {
	echo '<ul>';
	themefunction_format_recentcomments();
	echo '</ul>';
}

function themefunction_format_recentcomments (
	$no_comments = 5,
	$show_pass_post = false,
	$title_length = 35, 	// shortens the title if it is longer than this number of chars
	$author_length = 15,	// shortens the author if it is longer than this number of chars
	$wordwrap_length = 35, // adds a blank if word is longer than this number of chars
	$comment_length = 80,
	$type = 'all', 	// Comments, trackbacks, or both?
	$format = '<li><a href="%permalink%" title="%title%">%title%</a></li>',
	$date_format = 'd.m.y, H:i',
	$none_found = '<li>No comments.</li>',	// None found
	$type_text_pingback = 'Pingback by',
	$type_text_trackback = 'Trackback by',
	$type_text_comment = 'By'

	) {

	//Language...
	$mwlang_anonymous = 'Anonymous'; // Anonymous
	$mwlang_authorurl_title_before = 'Webseite von &lsaquo;';
	$mwlang_authorurl_title_after = '&rsaquo; besuchen';

	global $wpdb;

	$request = "SELECT ID, comment_ID, comment_content, comment_author, comment_author_url, comment_date, post_title, comment_type
				FROM $wpdb->comments LEFT JOIN $wpdb->posts ON $wpdb->posts.ID=$wpdb->comments.comment_post_ID
				WHERE post_status IN ('publish','static')";

	switch($type) {
		case 'all':
			// add nothing
			break;
		case 'comment_only':
			//
			$request .= "AND $wpdb->comments.comment_type='' ";
			break;
		case 'trackback_only':
			$request .= "AND ( $wpdb->comments.comment_type='trackback' OR $wpdb->comments.comment_type='pingback' ) ";
			break;
	 default:
 		//
			break;

	}

	if (!$show_pass_post) $request .= "AND post_password ='' ";

	$request .= "AND comment_approved = '1' ORDER BY comment_ID DESC LIMIT $no_comments";

	$comments = $wpdb->get_results($request);
    $output = '';
	if ($comments) {
    	foreach ($comments as $comment) {

			// Permalink to post/comment
			$loop_res['permalink'] = get_permalink($comment->ID). '#comment-' . $comment->comment_ID;

			// Title of the post
			$loop_res['post_title'] = stripslashes($comment->post_title);
			$loop_res['post_title'] = wordwrap($loop_res['post_title'], $wordwrap_length, ' ' , 1);

			if (strlen($loop_res['post_title']) >= $title_length) {
				$loop_res['post_title'] = substr($loop_res['post_title'], 0, $title_length) . '&#8230;';
			}

			// Author's name only
        	$loop_res['author_name'] = stripslashes($comment->comment_author);
			$loop_res['author_name'] = wordwrap($loop_res['author_name'], $wordwrap_length, ' ' , 1);

			if ($loop_res['author_name'] == '') $loop_res['author_name'] = $mwlang_anonymous;
			if (strlen($loop_res['author_name']) >= $author_length) {
				$loop_res['author_name'] = substr($loop_res['author_name'], 0, $author_length) . '&#8230;';
			}

			// Full author (link, name)
			$author_url = $comment->comment_author_url;
			if (empty($author_url)) {
				$loop_res['author_full'] = $loop_res['author_name'];
			} else {
				$loop_res['author_full'] = '<a href="' . $author_url . '" title="' . $mwlang_authorurl_title_before . $loop_res['author_name'] . $mwlang_authorurl_title_after . '">' . $loop_res['author_name'] . '</a>';
			}


			// Comment excerpt
			$comment_excerpt = strip_tags($comment->comment_content);
			$comment_excerpt = stripslashes($comment_excerpt);
			if (strlen($comment_excerpt) >= $comment_length) {
				$comment_excerpt = substr($comment_excerpt, 0, $comment_length) . '...';
			}

			// Comment type
			if ( $comment->comment_type == 'pingback' ) {
				$loop_res['comment_type'] = $type_text_pingback;
			} elseif ( $comment->comment_type == 'trackback' ) {
				$loop_res['comment_type'] = $type_text_trackback;
			} else {
				$loop_res['comment_type'] = $type_text_comment;
			}

			// Date of comment
			$loop_res['comment_date'] = mysql2date($date_format, $comment->comment_date);

			// Output element
			$element_loop = str_replace('%permalink%', $loop_res['permalink'], $format);
			$element_loop = str_replace('%title%', $loop_res['post_title'], $element_loop);
			$element_loop = str_replace('%author_name%', $loop_res['author_name'], $element_loop);
			$element_loop = str_replace('%author_full%', $loop_res['author_full'], $element_loop);
			$element_loop = str_replace('%date%', $loop_res['comment_date'], $element_loop);
			$element_loop = str_replace('%type%', $loop_res['comment_type'], $element_loop);
			$element_loop = str_replace('%excerpt%', $comment_excerpt, $element_loop);


			$output .= $element_loop . "\n";


		} //foreach

		$output = convert_smilies($output);

	} else {
		$output .= $none_found;
    }

    echo $output;
}

?>

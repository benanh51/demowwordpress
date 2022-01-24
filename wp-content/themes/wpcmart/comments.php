<?php

use wpcmart\Comments;

if ( post_password_required() ) {
	return;
}

echo '<div id="comments" class="comments-area">';
if ( have_comments() ) :
	echo '<h3 class="comments-title mb-4">';
	Comments::title();
	echo '</h3>';
	Comments::nav();
	echo '<ol class="comment-list">';
	wp_list_comments();
	echo '</ol>';
	Comments::nav();
endif;
Comments::closed();
comment_form();
echo '</div>';

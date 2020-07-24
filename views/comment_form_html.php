<?php

// this form allows users to comment on blog entries
$blogIdIsFound = isset( $blog_entry_id);

if ($blogIdIsFound === false) {
    trigger_error('views/comments_html.php needs an $blog_entry_id');
}

return"
    <form id='comment_form' action='index.php?page=blog&amp;blog_id=$blog_entry_id' method='post'>
        <input type='hidden' name='blog_id' value='$blog_entry_id' />
        <label for='user_name'>Your Name:</label>
        <input type='text' name='user_name' />
        <label for='new_comment'>Your Comment:</label>
        <textarea name='new_comment'></textarea>
        <input type='submit' value='post!'>
    </form>
";
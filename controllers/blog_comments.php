<?php

// this controller serves to display the comment form

// Include the class definition
include_once "models/Comment_Table.class.php";

// Create new object and pass in the PDO object for database connection
$commentTable = new Comment_Table( $database );

// Inserting new comments from users
$newCommentSubmitted = isset($_POST['new_comment']);
if ($newCommentSubmitted) {
    $whichBlogEntry = $_POST['blog_id'];
    $user = $_POST['user_name'];
    $comment = $_POST['new_comment'];
    $commentTable->saveComment($whichBlogEntry, $user, $comment);
}

// Load the comment form
$blog_comments = include_once "views/comment_form_html.php";

// Hooking up view to display comments
$allComments = $commentTable->getAllByBlogId( $blog_entry_id );
$blog_comments .= include_once "views/comments_html.php";

return $blog_comments;
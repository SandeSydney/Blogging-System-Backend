<?php

// View for displaying all comments

$commentsFound = isset( $allComments);
if ($commentsFound === false) {
    trigger_error('views/comments_html.php needs $allComments');
}

$allCommentsHTML = "<ul id='comments'>";
// iterate through all the rows from the database
while ($commentData = $allComments->fetchObject()) {
    // .= adds <li> elements to the <ul>
    $allCommentsHTML .= "<li>
        $commentData->comment_author wrote: 
        <p>$commentData->comment_text</p>
    </li>";
}

// close the ul
$allCommentsHTML .= "</ul>";
return $allCommentsHTML;
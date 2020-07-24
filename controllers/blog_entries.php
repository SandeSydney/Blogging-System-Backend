<?php

// include the model
include_once "models/Blog_Entry_Table.class.php";
$blog_entry_table = new Blog_Entry_Table( $database );

// displaying the whole content of a blog when the Read More... is clicked
$isBlogEntryClicked = isset( $_GET['blog_id'] );
if ($isBlogEntryClicked) {
    // show one entry...soon
    $blog_entry_id = $_GET['blog_id'];

    $blog_entry_data = $blog_entry_table->getBlogEntry( $blog_entry_id );
    $blog_output = include_once "views/blog_entry_html.php";

    // combining views: this is to display the comments on the selected blog entry
    $blog_output .= include_once "controllers/blog_comments.php";
} else {
    // PDO statement returned from getAllBlogEntries(): to list all entries
    $blog_entries = $blog_entry_table->getAllBlogEntries();

    // Hookup the model and the view: load the view
    $blog_output = include_once "views/list_blog_entries_html.php";
}


return $blog_output;
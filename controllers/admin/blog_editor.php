<?php

// importing Blog_Entry_Table class and creating an object
include_once "models/Blog_Entry_Table.class.php";
$blogEntryTable = new Blog_Entry_Table( $database );

// confirm submission of form
$blogEditorSubmitted = isset( $_POST['action'] );
if ($blogEditorSubmitted) {
    $buttonClicked = $_POST['action'];

    $save = ($buttonClicked=='save');
    $blog_id = $_POST['blog_id'];
    // if the blog_id == 0; the user is saving new entry
    $insertNewBlogEntry = ( $save and $blog_id === '0');

    $deleteBlogEntry = ( $buttonClicked === 'delete');

    // if $insertNewBlogEntry is false, then the user was updating existing data
    $updateBlogEntry = ( $save and $insertNewBlogEntry === false);

    // capture title and entry data from the form
    $blog_title = $_POST['blog_title'];
    $blog_entry = $_POST['blog_entry'];

    if ($insertNewBlogEntry) {
        // variable to hold the blog_id of the inserted data
        $savedBlogEntryId = $blogEntryTable->saveBlogEntry($blog_title, $blog_entry);
    } elseif ($updateBlogEntry) {
        $blogEntryTable->updateBlogEntry( $blog_id, $blog_title, $blog_entry);

        // Incase of an update, overwrite above variable ($savedBlogEntryId)
        // with the blog_id of updated entry
        $savedBlogEntryId = $blog_id;
    }
     elseif ($deleteBlogEntry) {
        // delete the selected entry
        $blogEntryTable->deleteBlogEntry( $blog_id );
    }
}

/**
 * Whenever the admin clicks a blog entry title, the following code is used to
 * populate the editor form with existing data for it to be edited, or deleted
 */
$blog_entry_requested = isset ($_GET['blog_id']);
if ($blog_entry_requested) {
    $blog_id = $_GET['blog_id'];
    // load the model of an existing entry
    $blog_entry_data = $blogEntryTable->getBlogEntry($blog_id);
    $blog_entry_data->blog_id = $blog_id;

    // display no message when the entry is loaded initially
    $blog_entry_data->message = "";
}

// If a blog entry was saved or updated, display messages to indicate the action
$blogEntrySaved = isset( $savedBlogEntryId );
if ($blogEntrySaved) {
    $blog_entry_data = $blogEntryTable->getBlogEntry($savedBlogEntryId);
    // show a confirmation message
    $blog_entry_data->message = "Blog Entry was saved";
}

// hook up this controller to display the view when controller is loaded
$blog_editorOutput = include_once "views/admin_module/blog_editor_html.php";
return $blog_editorOutput;
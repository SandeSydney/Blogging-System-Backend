<?php

// include the rightful model and object
include_once "models/Blog_Entry_Table.class.php";
$blog_entry_table = new Blog_Entry_Table( $database );

// create PDO object to access all entries
$all_blog_entries = $blog_entry_table->getAllBlogEntries();

// hook up the view
$blog_entries_as_html = include_once "views/admin_module/blog_entry_html.php";
return $blog_entries_as_html;
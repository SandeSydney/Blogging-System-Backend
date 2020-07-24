<?php

// Search controller

// load the model
include_once "models/Blog_Entry_Table.class.php";
$blogEntryTable = new Blog_Entry_Table( $database );

$searchOutput = "";
if ( isset($_POST['search_term'])) {
    $searchTerm = $_POST['search_term'];
    $searchData = $blogEntryTable->searchBlogEntry( $searchTerm );
    $searchOutput = include_once "views/search_results_html.php";
}

return $searchOutput;
<?php

// reporting errors
error_reporting( E_ALL);
ini_set ("display_errors", 1);

// include the model 
include_once "models/Display_Data.class.php";
$displayData = new Display_Data();
$displayData->title = "Blogging Demo";
$displayData->addCSS("css/blog_css.css");

// PDO object
$databaseInformation = "mysql:host=localhost;dbname=personal_blog";
$databaseUser = "root";
$databasePassword = "";
$database = new PDO($databaseInformation, $databaseUser, $databasePassword);
$database->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

// Responding to user searches by displaying the search page;
// if not, just display the blog entries
$pageRequested = isset($_GET['page']);
// default controller is blog entries
$controller = "blog_entries";
if ($pageRequested) {
    // submission of the user form
    if ($_GET['page'] === "search") {
        // load search controller by overwriting default controller
        $controller = "search";
    }
}

// Including the search view in order to be displayed on all pages regardless
$displayData->content .= include_once "views/search_form_html.php";

// load the page requested
$displayData->content .= include_once "controllers/$controller.php";

// Include the default view
$viewPage = include_once "views/viewPage.php";
echo $viewPage;
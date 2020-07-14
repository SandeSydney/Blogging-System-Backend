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

// load the blog_entries controller
$displayData->content .= include_once "controllers/blog_entries.php";

// Include the default view
$viewPage = include_once "views/viewPage.php";
echo $viewPage;
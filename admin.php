<?php
//checking errors and displaying them
error_reporting (E_ALL);
ini_set ("display_errors", 1);

//import Display_Data class from the model
include_once "models/Display_Data.class.php";
$displayData = new Display_Data();
$displayData->title = "Personal Blog in PHP/MySQL";
$displayData->addCSS("css/blog_css.css");

// controlling the admin_navigation from admin.php
$displayData->content = include_once "views/admin_module/admin_navigation.php";

// create a PDO object to connect with the database
// here in order to share with other controllers
$databaseInformation = "mysql:host=localhost;dbname=personal_blog";
$databaseUser = "root";
$databasePassword = "";
$database = new PDO($databaseInformation, $databaseUser, $databasePassword);
$database->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

// load the admin controllers from here. respond to user clicks on the nav 
$navigationLinkIsClicked = isset($_GET['page']);
if ($navigationLinkIsClicked) {
    // load selected controller
    $loadedController = $_GET['page'];
} else {
    // load default controller
    $loadedController = "blog_entries";
}

// display the loaded controller
$displayData->content .= include_once "controllers/admin/$loadedController.php";

//introduce the views
$viewPage = include_once "views/viewPage.php";
echo $viewPage;
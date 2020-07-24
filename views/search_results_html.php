<?php

$searchDataFound = isset ( $searchData );
if ($searchDataFound === false) {
    trigger_error('views/search_results_html.php needs $searchData');
}

$searchHTML = "
    <section id='search'>
        <p>Your searched for <em>$searchTerm</em></p><ul>
";

while ( $searchRow = $searchData->fetchObject()) {
    $href = "index.php?page=blog&amp;blog_id=$searchRow->blog_id";
    $searchHTML .= "<li><a href='$href'>$searchRow->blog_title</a></li>";
}

$searchHTML .= "</ul></section>";
return $searchHTML;
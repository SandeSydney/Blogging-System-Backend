<?php

// View to display entry blogs in the database

$blog_entries_found = isset( $blog_entries);
if ($blog_entries_found === false) {
    trigger_error( 'views/list_blog_entries_html.php needs $blogEntries' );
}

// <ul> element to display the blog entries
$blog_entries_HTML = "<ul id='blog_entries'>";

// loop through entries in the database
while ($blog_entry = $blog_entries->fetchObject()) {
    $href = "index.php?page=blog&amp;blog_id=$blog_entry->blog_id";

    // <li> for each of the entries in the database
    $blog_entries_HTML .= "
        <li>
            <h2>$blog_entry->blog_title</h2>
            <div>$blog_entry->intro
                <p><a href='$href'>Read more...</a></p>
            </div>
        </li>
    ";
}

// end <ul>
$blog_entries_HTML .= "</ul>";
return $blog_entries_HTML;
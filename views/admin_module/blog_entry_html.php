<?php

if (isset($all_blog_entries) === false) {
    trigger_error('views/admin_module/blog_entry_html.php needs $all_blog_entries');
}

$blog_entries_as_html = "<ul>";
while ($blog_entry = $all_blog_entries->fetchObject()) {
    $href = "admin.php?page=blog_editor&amp;blog_id=$blog_entry->blog_id";
    $blog_entries_as_html .= "<li><a href='$href'>$blog_entry->blog_title</a></li>";
}

$blog_entries_as_html .= "</ul>";
return $blog_entries_as_html;
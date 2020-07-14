<?php
//complete source code for views/entry-html.php
//check if required data is available
$entryDataFound = isset( $blog_entry_data );
if ( $entryDataFound === false ) {
    trigger_error('views/entry-html.php needs an $blog_entry_data object');
    }
    //properties available in $entry: entry_id, title, entry_text, date_created
return "
    <article>
        <h1>$blog_entry_data->blog_title</h1>
        <div class='date'>$blog_entry_data->creation_date</div>
        $blog_entry_data->blog_text
    </article>
";
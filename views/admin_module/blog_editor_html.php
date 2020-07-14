<?php 

/* 
* for this part, the editor checks to see if a particular row in the database
* has been selected for editing. if none has been selected, the editor displays
* blank fields. else if it has been selected, the editor shall populate the
* form fields with corresponding data from the database.
*/
$blog_entry_data_found = isset( $blog_entry_data );
if ($blog_entry_data_found === false) {
    // default values for an empty editor
    $blog_entry_data = new StdClass();
    $blog_entry_data->blog_id = 0;
    $blog_entry_data->blog_title = "";
    $blog_entry_data->blog_text = "";
    $blog_entry_data->message = "";
}

// object properties are used in both the <input> and <textarea> below as content
return "
    <form method='post' action='admin.php?page=blog_editor' id='blog_editor'>
        <input type='hidden' name='blog_id' value='$blog_entry_data->blog_id'>
        <fieldset>
            <legend>New Blog Entry</legend>
            <label for='blog_title'>Title of the blog</label>
            <input type='text' name='blog_title' maxlength='150' value='$blog_entry_data->blog_title' required />
            <label for='blog_entry'>Blog Entry</label>
            <textarea name='blog_entry'>$blog_entry_data->blog_text</textarea>

            <fieldset id='blog_editor_buttons'>
                <input type='submit' name='action' value='save' />
                <input type='submit' name='action' value='delete' />
                <p id='editor_message'>$blog_entry_data->message</p>
            </fieldset>
        </fieldset>
    </form>
";
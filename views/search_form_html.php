<?php

// the view for the search form
return "
    <aside id='search_bar'>
        <form method='post' action='index.php?page=search'>
            <input type='search' name='search_term'>
            <input type='submit' value='search'>
        </form>
    </aside>
";
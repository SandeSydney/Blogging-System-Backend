<?php

// this is a table data gateway for the blog_entry_table table in the database

class Blog_Entry_Table{

    private $database;

    // constructor takes PDO created in admin.php as
    // argument and stored in the above class property
    public function __construct( $database ){
        $this->database = $database;
    }

    // method to save the blog entries
    public function saveBlogEntry ( $blog_title, $blog_entry ){
        // using placeholders to beef up form security
        $blogEntrySQL = "INSERT INTO blog_entry_table (blog_title, blog_text)
         VALUES( ?, ?)";
        $blogEntryStatement = $this->database->prepare( $blogEntrySQL);

        // create an array with dynamic data: follow the order above
        $blogFormData = array($blog_title, $blog_entry);

        try {
            // pass the $blogFormData to be executed as argument
            $blogEntryStatement->execute($blogFormData);
        } catch (Exception $e) {
            $msg = "<p>You tried running this sql: $blogEntrySQL</p>
                    <p>Exception: $e</p>";
            trigger_error($msg);        
        }     
        
        // return the blog_id of the last saved blog_entry
        return $this->database->lastInsertId();
    }

    // method to view the data inside the blog_entry_table
    public function getAllBlogEntries(){
        $blogViewingSQL = "SELECT blog_id, blog_title,
            SUBSTRING(blog_text, 1, 150) AS intro
            FROM blog_entry_table";
        $blogViewingStatement = $this->database->prepare( $blogViewingSQL );  
        
        try {
            $blogViewingStatement->execute();
        } catch (Exception $e) {
            $exceptionMessage = "<p>You ran this sql: $blogViewingSQL</p>
                                <p>Exception: $e</p>";
            trigger_error($exceptionMessage);
        }

        // return a PDOStatement; thru which access to all blog entries are obtained at a time
        return $blogViewingStatement; 
    }

    // method to retrieve the contents of a blog entry... 
    // blog_id taken as argument
    public function getBlogEntry( $blog_id) {
        $getBlogEntrySQL = "SELECT blog_id, blog_title, blog_text, creation_date FROM blog_entry_table WHERE blog_id = ?";
        $getBlogEntryStatement = $this->database->prepare( $getBlogEntrySQL );

        $blog_data = array( $blog_id );
        try {
            $getBlogEntryStatement->execute( $blog_data);
        } catch (Exception $e) {
            $exceptionMessage = "<p>You ran this sql: $blogViewingSQL</p>
                <p>Exception: $e</p>";
            trigger_error($exceptionMessage);
        }

        $model = $getBlogEntryStatement->fetchObject();
        return $model;
    }

    // Method to delete a blog entry from the database
    public function deleteBlogEntry( $blog_id ){
        $deleteBlogSQL = "DELETE FROM blog_entry_table WHERE blog_id = ?";
        $deleteBlogStatement = $this->database->prepare( $deleteBlogSQL );

        $blog_data = array( $blog_id );

        try {
            $deleteBlogStatement->execute( $blog_data );
        } catch (Exception $e) {
            $exceptionMessage = "<p>You ran this sql: $blogViewingSQL</p>
                <p>Exception: $e</p>";
            trigger_error($exceptionMessage);
        }
    }

    // Method to update blog entries in the database
    public function updateBlogEntry( $blog_id, $blog_title, $blog_entry ){
        $updateBlogSQL = "UPDATE blog_entry_table 
            SET blog_title = ?, blog_text = ? WHERE blog_id = ?";
        $updateBlogStatement = $this->database->prepare( $updateBlogSQL );
        
        $blog_data = array($blog_title, $blog_entry, $blog_id);

        try {
            $updateBlogStatement->execute( $blog_data );
        } catch (Exception $e) {
            $exceptionMessage = "<p>You ran this sql: $blogViewingSQL</p>
                <p>Exception: $e</p>";
            trigger_error($exceptionMessage);
        }

        return $updateBlogStatement;
    }
}
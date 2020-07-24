<?php

// this is a table data gateway for the blog_entry_table table in the database

// Include parent class definition in order to inherit
include_once "models/General_Table.class.php";

// extend class from the parent class
class Blog_Entry_Table extends General_Table {

    // method to save the blog entries
    public function saveBlogEntry ( $blog_title, $blog_entry ){
        // using placeholders to beef up form security
        $sql = "INSERT INTO blog_entry_table (blog_title, blog_text)
         VALUES( ?, ?)";
        // create an array with dynamic data: follow the order above
        $data = array($blog_title, $blog_entry);
        $statement = $this->makeStatement( $sql, $data );     
        
        // return the blog_id of the last saved blog_entry
        return $this->database->lastInsertId();
    }

    // method to view the data inside the blog_entry_table
    public function getAllBlogEntries(){
        $sql = "SELECT blog_id, blog_title,
            SUBSTRING(blog_text, 1, 150) AS intro
            FROM blog_entry_table";
        $data = null;
        $statement = $this->makeStatement( $sql, $data);
        // return a PDOStatement; thru which access to all blog entries are obtained at a time
        return $statement; 
    }

    // method to retrieve the contents of a blog entry... 
    // blog_id taken as argument
    public function getBlogEntry( $blog_id) {
        $sql = "SELECT blog_id, blog_title, blog_text, creation_date FROM blog_entry_table WHERE blog_id = ?";
        $data = array( $blog_id );
        $statement = $this->makeStatement( $sql, $data);
        $model = $statement->fetchObject();
        return $model;
    }

    // Method to delete a blog entry from the database
    // call method to delete comments before deleting the blog entry
    public function deleteBlogEntry( $blog_id ){
        $this->deleteCommentsById ( $blog_id );
        $sql = "DELETE FROM blog_entry_table WHERE blog_id = ?";
        $data = array( $blog_id );
        $statement = $this->makeStatement( $sql, $data );
    }

    // Method to update blog entries in the database
    public function updateBlogEntry( $blog_id, $blog_title, $blog_entry ){
        $sql = "UPDATE blog_entry_table 
            SET blog_title = ?, blog_text = ? WHERE blog_id = ?";
        $data = array($blog_title, $blog_entry, $blog_id);
        $statement = $this->makeStatement( $sql, $data );
        return $statement;
    }

    // method to perform a search when the user has searched for an item
    public function searchBlogEntry( $searchTerm ){
        $sql = "SELECT blog_id, blog_title FROM blog_entry_table
                WHERE blog_title LIKE ? 
                or blog_text LIKE ?";
        $data = array ("%$searchTerm%", "%$searchTerm%");
        $statement = $this->makeStatement( $sql, $data );
        return $statement;
    }

    // private method to delete comments by id
    private function deleteCommentsById( $blog_id ){
        include_once "models/Comment_Table.class.php";
        // create a comment table object
        $comments = new Comment_Table( $this->database );
        // delete comments before deleting the blog entry
        $comments->deleteByBlogEntryId( $blog_id );
    }
}
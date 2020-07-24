<?php

// table data gateway for the comment_table in the database

// Include parent class definition
include_once "models/General_Table.class.php";

// extend class from the parent class
class Comment_Table extends General_Table{
    // method to insert new comments into the database
    public function saveComment($blog_id, $comment_author, $comment_text){
        $sql = "INSERT INTO comment_table( blog_id, comment_author, comment_text)
         VALUES(?,?,?)";
        $data = array( $blog_id, $comment_author, $comment_text );
        $statement = $this->makeStatement( $sql, $data );
        return $statement;
    }

    // method to get all blog entries for a particular blog_id
    public function getAllByBlogId( $blog_entry_id ){
        $sql = " SELECT comment_author, comment_text, comment_date FROM comment_table
                WHERE blog_id = ?
                ORDER BY  comment_id DESC";
        $data = array( $blog_entry_id );
        $statement = $this->makeStatement( $sql, $data );
        return $statement;
    }

    // method to delete the blog entry comments before finally
    // deleting the blog entries from the database
    // should be called before the blog entry is deleted
    public function deleteByBlogEntryId( $blog_entry_id ){
        $sql = "DELETE FROM comment_table WHERE blog_id = ?";
        $data = array ( $blog_entry_id );
        $statement = $this->makeStatement( $sql, $data );
    } 
}
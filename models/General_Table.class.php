<?php

/**
 * This is a parent table class: 
 * for subclasses to access various tables of the database through inheritance
 */

 class General_Table {
    protected $database;

    // constructor takes PDO created in the front-page controller as
    // argument and stored in the above class property
    public function __construct( $database ){
        $this->database = $database;
    }

    // function to make sql statements: DRY purposes
    protected function makeStatement ($sql, $data = null){
        $statement = $this->database->prepare($sql);
        try {
            $statement->execute($data);
        } catch (Exception $e) {
            $exceptionMessage = "<p>You tried running this sql: $sql</p>
            <p>Exception: $e</p>";
            trigger_error($exceptionMessage);
        }
        return $statement;
    }
 }
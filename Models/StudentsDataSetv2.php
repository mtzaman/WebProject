<?php

require_once ('Models/Database.php');
require_once ('Models/StudentData.php');

class StudentsDataSet {
    protected $_dbHandle, $_dbInstance;
        
    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }
    
    public function createStudent($firstName,$lastName, $international, $courseID){
        $sqlQuery = 'INSERT INTO tim_students (first_name, last_name, international, courseID) VALUES (' . "'$firstName'" . ', ' . "'$lastName'" . ', ' . "'$international'" . ', '. "'$courseID'" . ')';
        //echo $sqlQuery;
           $password  = 'foo';
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement -> execute();
    }
    
    public function fetchAllStudents() {
        $sqlQuery = 'SELECT * FROM tim_students';
                
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new StudentData($row);
        }
        return $dataSet;
    }

    /**
     * @param $id
     * @return array
     */
    public function fetchStudentByID($id) {
        $sqlQuery = 'SELECT * FROM tim_students WHERE (id = :id)';
        $placeholderMappings =   [':id' => "$id"]; 
                
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute($placeholderMappings); // execute the PDO statement
        
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new StudentData($row);
        }
        return $dataSet;
    }
  
    public function fetchStudentByCourseID($courseID) {
        $sqlQuery = 'SELECT * FROM tim_students WHERE (courseID = :courseID)';
        $placeholderMappings= [':courseID' => "$courseID"];
        
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute($placeholderMappings); // execute the PDO statement
        
        $dataSet = [];
        while ($row = $statement->fetch()) {
           $dataSet[] = new StudentData($row);
        }
        
        return $dataSet;
    }
 
/*    public function fetchStudentByLastName($lastName) {
        $sqlQuery = 'SELECT * FROM tim_students WHERE (last_name = :last_name)';
        $placeholderMappings =   [':last_name' => "$lastName"]; 
                
        //$statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute($placeholderMappings); //[':last_name' => "$lastName"]); // execute the PDO statement
        
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new StudentData($row);
        }
        return $dataSet;
    }
*/    
    public function updateStudent($id, $firstName, $lastName, $international, $courseID, $photoName) {
        $sqlQuery = 'UPDATE tim_students SET first_name = :first_name, last_name = :last_name, international = :international, courseID = :courseID, photo_name = :photo_name WHERE (id = :id)';
        $placeholderMappings =   [':id' => "$id", ':first_name' => "$firstName", ':last_name' => "$lastName", ':international' => "$international", ':courseID' => "$courseID", ':photo_name' => "$photoName"]; 
        //echo $sqlQuery;      
        
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute($placeholderMappings); // execute the PDO statement
    }
   
    public function updateStudentPhoto($id, $photoName) {
        $sqlQuery = 'UPDATE tim_students SET photo_name = :photoName WHERE (id = :id)';
        $placeholderMappings = [':id' => "$id", ':photoName' => "$photoName"];      
        
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute($placeholderMappings ); // execute the PDO statement
    }
  
    public function deleteStudent($id) {
        $sqlQuery = 'DELETE FROM tim_students WHERE (id = :id)';
        $placeholderMappings =   [':id' => "$id", ];
        
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute($placeholderMappings); // execute the PDO statement
    }
    
    /*
    public function fetchStudentByID($id) {
        $sqlQuery = 'SELECT * FROM tim_students WHERE (id = ' . "'$id'" . ')';
        
        //echo $sqlQuery;
        
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new StudentData($row);
        }
        return $dataSet;
    }
  
    public function fetchStudentByCourseID($courseID) {
        $sqlQuery = 'SELECT * FROM tim_students WHERE (courseID = ' . "'$courseID'" . ')';
        
        echo $sqlQuery;
        
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        
        $dataSet = [];
        while ($row = $statement->fetch()) {
           $dataSet[] = new StudentData($row);
        }
        
        return $dataSet;
    }
*/        
    public function fetchStudentByLastName($lastName) {
        $sqlQuery = 'SELECT * FROM tim_students WHERE (last_name = ' . "'$lastName'" . ')';
        
        echo $sqlQuery;
        
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new StudentData($row);
        }
        return $dataSet;
    }
/*    
    public function updateStudent($id, $firstName,$lastName, $international, $courseID) {
        $sqlQuery = 'UPDATE tim_students SET first_name = ' . "'$firstName'" . ', last_name = ' . "'$lastName'" . ', international = ' . "'$international'" . ', courseID = ' . "'$courseID'" . ' WHERE (id = ' . "'$id'" . ')';
        
        echo $sqlQuery;      
        
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
    }
     
    public function deleteStudent($id) {
        $sqlQuery = 'DELETE FROM tim_students WHERE (id = ' . "'$id'" . ')';
        
        //echo $sqlQuery;
        
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
    }
   
*/
 
}


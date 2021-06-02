<?php

require_once ('Models/Database.php');
require_once ('Models/RegisterData.php');

class StudentsDataSet {
    protected $_dbHandle, $_dbInstance;
        
    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }
    
    public function createUser($firstName,$lastName, $email, $password){
        $sqlQuery = 'INSERT INTO register (first_name, last_name, email, password) VALUES (' . "'$firstName'" . ', ' . "'$lastName'" . ', ' . "'$email'" . ', '. "'$password'" . ')';
        //echo $sqlQuery;
        #$password  = 'foo';
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement -> execute();
    }
    
    public function fetchAllUsers() {
        $sqlQuery = 'SELECT * FROM register';
                
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new RegisterData($row);
        }
        return $dataSet;
    }
}


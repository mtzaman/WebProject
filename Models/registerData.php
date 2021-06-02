<?php

class StudentData {
    
    protected $_userid, $_firstName, $_lastName, $_email, $_password;
    
    public function __construct($dbRow) {
        $this->_userid = $dbRow['userid'];
        $this->_firstName = $dbRow['first_name'];
        $this->_lastName = $dbRow['last_name'];
        $this->_email    = $dbRow['email'];
        $this->password = $dbRow['password'];
    }

    public function getUserID() {
        return $this->_userid;
    }
   
    public function getFirstName() {
       return $this->_firstName;
    }
    
    public function getLastName() {
       return $this->_lastName;
    }

    public function getEmail() {
        return $this->_email;
     }
     
     public function getPassword() {
        return $this->_password;
     }
    



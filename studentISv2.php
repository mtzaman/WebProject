<?php

require_once('Models/StudentsDataSetv2.php');

$view = new stdClass();
$view->pageTitle = 'Student Database';
$view->studentsDataSet = null;

//require_once 'autoload.php');
if(isset($_POST['submit'])) {
    if (isset($_POST['op'])) {
        
        switch ($_POST['op']) {
            case 'cdbase':
                $studentsDataSet = new StudentsDataSet();
                $studentsDataSet->createStudent($_POST['first_name'], $_POST['last_name'], $_POST['international'], $_POST['courseID']);
                $view->studentsDataSet = $studentsDataSet->fetchAllStudents();
                break;
            
            case 'rdbase':
               if (($_POST['id'] == "") && ($_POST['last_name'] == "") && ($_POST['last_name'] == '') && ($_POST['international'] == '') && ($_POST['courseID'] == '') ){
                    $studentsDataSet = new StudentsDataSet();
                    $view->studentsDataSet = $studentsDataSet->fetchAllStudents();
               } elseif ($_POST['id'] != "") {
                    $studentsDataSet = new StudentsDataSet();
                    $view->studentsDataSet = $studentsDataSet->fetchStudentByID($_POST['id']);
               } elseif ($_POST['last_name'] != "") {
                    $studentsDataSet = new StudentsDataSet();
                    $view->studentsDataSet = $studentsDataSet->fetchStudentByLastName($_POST['last_name']);   
               } elseif (isset($_POST['courseID'])) {
                    $studentsDataSet = new StudentsDataSet();
                    $view->studentsDataSet = $studentsDataSet->fetchStudentByCourseID($_POST['courseID']);
               } 
               
               break;
            
               case 'udbase':
                $studentsDataSet = new StudentsDataSet();
                $studentsDataSet->updateStudent($_POST['id'], $_POST['first_name'], $_POST['last_name'], $_POST['international'], $_POST['courseID']);
                $view->studentsDataSet = $studentsDataSet->fetchAllStudents();
                break;
            
            case 'ddbase':
                $studentsDataSet = new StudentsDataSet();
                $studentsDataSet->deleteStudent($_POST['id']);
                $view->studentsDataSet = $studentsDataSet->fetchAllStudents();
                break;
            
            case 'adbase':
                if (is_numeric($_POST['id'])) { //should be "" if not set
                  if ( ($_FILES['photo']['type']=='image/png') || ($_FILES['photo']['type']=='image/jpeg')){

                    move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $_FILES['photo']['name']);

                    $studentsDataSet = new StudentsDataSet();
                    $studentsDataSet->updateStudentPhoto($_POST['id'], $_FILES['photo']['name']);
                  }
                    
                }   
                
                $studentsDataSet = new StudentsDataSet();                               
                $view->studentsDataSet = $studentsDataSet->fetchAllStudents();
                break;                    
        }
       
    
    }
    
} else {
    $studentsDataSet = new StudentsDataSet();
    $view->studentsDataSet = $studentsDataSet->fetchAllStudents(); 
}

require_once('Views/studentISv2.phtml');

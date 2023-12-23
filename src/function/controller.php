<?php
require_once('index.php');
use Biometric\Controller\ControllerManager;



if(isset($_GET['action'])){




    $action = $_GET['action'];




  

  $controller = new ControllerManager();




  switch($action){

    case 'login':

      $user_data = json_decode($_POST["data"]);


      $controller->login($user_data->usernameAccount,$user_data->passwordAccount);

    break;


    // !!!!!!!! Year Level !!!!!!!///////
    case 'addYrLevel':
      $user_data = json_decode($_POST["data"]);

      $controller->addYearLevel($user_data->yrName,$user_data->type,$user_data->qualifyAge);

      break;
    case 'updateYrLevel':

      $user_data = json_decode($_POST["data"]);

      $controller->updateYearLevel($user_data->yrId,$user_data->yrName, $user_data->type,$user_data->qualifyAge);

      break;

    case 'deleteYrLevel':

      $user_data = json_decode($_POST["data"]);

      $controller->deleteYearLevel($user_data->yrId);

      break;

    // !!!!!!!! end Year Level !!!!!!!///////

    // !!!!!!!! section Level !!!!!!!///////

    case 'addSection':
      
      $controller->createSection($_POST);

      break;
    case 'modifySection':

      $controller->updateSection($_POST);
      break;
    case 'deleteSection':

      $user_data = json_decode($_POST['data']);

      $controller->deleteSection($user_data->section_id);
      break;
    // !!!!!!!! end section !!!!!!!///////
    // Student record ///
    case 'getYrType':

      $user_data = json_decode($_POST["data"]);

      $controller->getYearType($user_data->type);
    break;
  
    case 'getNextYearLevel':

      $user_data = json_decode($_POST["data"]);

      $controller->getNextYearLevel($user_data->type);

    break;

    case 'enrollStudent':
    
      $controller->enrollStudent($_FILES,$_POST);
     
      break;
    case 'enrollRegularStudents':
   
      $controller->enrollRegularStudents($_POST);
     
      break;
    case 'reEvaluteStudent':

      $controller->reEvaluteStudent($_FILES, $_POST);

      break;
    case 'findUserLrn':

      $user_data = json_decode($_POST['data']);

      $controller->getUserLrn($user_data->lrn);
      break;

    case 'getEnrollmentRec':

      $user_data = json_decode($_POST['data']);

      $controller->getEnrollmentRec($user_data->lrn);
      break;

    
    case 'updateSchoolYear':
      $controller->updateSchoolYear($_POST);
      break;

    case 'deleteStudentRec':
      $user_data = json_decode($_POST['data']);

      $controller->deleteStudentRecord($user_data->enrollmentId);
      break;
   
    ///END student record//
    // credeintials

    case 'addUserCredentials':
      $controller->createUserCredentials($_POST);
    break;

    case 'modifyUserCredentials':
      $controller->modifyUserCredentials($_POST);
      break;

    case 'deleteUserCredentials':
       $user_data = json_decode($_POST['data']);

       $controller->deleteUserCredentials($user_data->credential_id);
     
      break;
    // end credentials

    // subject
    case 'addSubject':

      $controller->createSubject($_POST);

      break;
    case 'modifySubject':

      $controller->updateSubject($_POST);
      break;
    case 'deleteSubject':

      $user_data = json_decode($_POST['data']);

      $controller->deleteSubject($user_data->subject_id);


      break;


    // end subject

    // teacher
      case 'addTeacher':
      $controller->addTeacher($_FILES, $_POST);

      break;
      case 'deleteTeacher':
      $user_data = json_decode($_POST['data']);

      $controller->deleteTeacher($user_data->teacher_id);

      break;

      case 'editTeacher':
      $controller->updateTeacher($_FILES, $_POST);
      break;
    // end teacher


    // classes
      case 'addClass':
        $controller->addClass($_POST);
      break;

      case 'deleteClass':
        $user_data = json_decode($_POST['data']);

        $controller->deleteClass($user_data->class_id);
      break;

      case 'editClass':
        
        $controller->editClass($_POST);

        break;
    // end te
    // end classes

    default:
    echo 'action not defined';
    break;




    }



}



?>
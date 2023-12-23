<?php
// include('config.php');
namespace Biometric\Database;
require_once('config.php');
use PDO;
use PDOException;
use Biometric\Config;
class DatabaseManager{
  protected $pdo = null;


  public function __construct(){
    // define database connection
    $dns = 'mysql:host='.SERVER.';dbname='.DATABASE.';charset='.CHARSET.'';
    $this->pdo = new PDO($dns, ROOT, '');

    // set error mode
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    

  }


  public function fetchQueries($query, $params = array())
  {
    try {
      $stmt = $this->pdo->prepare($query);
      $stmt->execute($params);
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }


  public function fetchQuery($query, $params = array())
  {
    try {
      $stmt = $this->pdo->prepare($query);
      $stmt->execute($params);
      return $stmt->fetch();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }




  public function sanitizeInput($input)
  {
    $input = trim($input); // remove extra white space(s)
    $input = stripslashes($input); // remove forward and back slashes
    $input = htmlspecialchars($input); // remove special characters
    return $input;
  }


  public function executeQuery($query, $params = array())
  {
    try {
      $stmt = $this->pdo->prepare($query);
      $stmt->execute($params);
      return true;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }




  public function listItems($cb, $record = [])
  {
    $field = '';
    $last_index = count($record) - 1;

    foreach ($record as $index => $value) {
      $field .= $cb($value,$index);
    }
    return rtrim($field, ', AND');
  }


  public function isConditional($where=[], $columnFields=[],$desc=[],$asc=[])
  {
 

    $forWhereParams = $this->listItems(function ($item,$index) {
      return $index . ' = ' . ':' .  $index . ' AND ';
    }, $where);
  
    $forcolumns = $this->listItems(function ($item) {
      return $item.' , ';
    }, $columnFields);

    // forSet
    $forSet = $this->listItems(function ($item,$index) {
      return $index . ' = \'' . $item . '\'' . ' ,';

    }, $columnFields);


    $forWhere = $this->listItems(function ($item,$index) {
      return $index . ' = \'' . $item . '\'' . 'AND ';
    }, $where);


    $sortByDescending = $this->listItems(function ($item) {
      return $item . ' DESC ';
    }, $desc);

    $sortByAscending = $this->listItems(function ($item) {
      return $item . ' ASC ';
    }, $asc);

    if (count($where) > 0) {
      $forWhere = 'WHERE ' . $forWhere;
      $forWhereParams = 'WHERE ' . $forWhereParams;

    } 

    if (count($asc) > 0 && count($desc) <= 0) {
      $sortByAscending = 'ORDER BY' . $sortByAscending;
    }


    if (count($desc) > 0 && count($asc) <= 0) {
      $sortByDescending = 'ORDER BY' . $sortByDescending;
    }

    if (count($desc) > 0 && count($asc) > 0) {
      $sortByDescending = 'ORDER BY' . $sortByDescending;
    }

    if (count($columnFields) <= 0) {
      $forcolumns = '* ';
    }



    return array($forWhere, $forcolumns, $forSet,$forWhereParams,$sortByDescending, $sortByAscending);
  }




  public function getSpecifiQuery($tableName, $columnFields=[], $where=[], $params=[],$multiple = 0,$desc=[],$asc=[]){
    try {


      $conditionalQuery = $this->isConditional($where, $columnFields,$desc,$asc);



     
      $query = "SELECT $conditionalQuery[1] FROM $tableName  $conditionalQuery[3] $conditionalQuery[4] $conditionalQuery[5]";

      // echo $query;
      // var_dump($params);
     
      $stmt = $this->pdo->prepare($query);
      $stmt->execute($params);

      //  var_dump($stmt);

      if ($multiple == 0) {
        return $stmt->fetch();
      } else {
        return $stmt->fetchAll();
      }
      

  
    } catch (PDOException $e) {
      echo $e->getMessage().'errror';
    }
   
  }


  public function validateQueryExisted($tableName, $columnFields, $where, $params){

    $result = $this->getSpecifiQuery($tableName, $columnFields, $where, $params);
    
   if($result){
      return true;
    }
    else{
      return false;
   }
   
  }


  public function insertQuery($tableName,$selectFied,$insertColumnField,$where=[],$params=[],$insertWhere=[]){
    // validate date if exist 
    
    $validate = $this->validateQueryExisted($tableName,$selectFied,$where,$params);

    if($validate){
      return false;
    }
    else{

      $conditionalQuery = $this->isConditional($insertWhere, $insertColumnField);

      $query = "INSERT INTO $tableName SET $conditionalQuery[2] $conditionalQuery[0]";

      // echo "Insert Query: $query<br>";
     
      // return $query;
      $stmt = $this->pdo->prepare($query);
      $result = $stmt->execute();
      if($result){
         $lastInserId = $this->pdo->lastInsertId();

        return $lastInserId;
      }
      else{
        return false;
      }
    }
  }

  public function insertQueryValid($tableName,$insertColumnField,  $insertWhere = [])
  {

      $conditionalQuery = $this->isConditional($insertWhere, $insertColumnField);

      $query = "INSERT INTO $tableName SET $conditionalQuery[2] $conditionalQuery[0]";

      // echo "Insert Query: $query<br>";

      // return $query;
      $stmt = $this->pdo->prepare($query);
      $result = $stmt->execute();
      $lastInserId = $this->pdo->lastInsertId();
      if ($result) {
        return $lastInserId;
      } else {
        return false;
      }
    
  }


  public function updateQuery($tableName, $selectFied, $updateColumnField, $where = [], $params = [], $updateWhere = [])
  {
    // validate date if exist 
    $validate = $this->validateQueryExisted($tableName, $selectFied, $where, $params);
    if ($validate) {
      $conditionalQuery = $this->isConditional($updateWhere, $updateColumnField);

      $query = "UPDATE $tableName SET $conditionalQuery[2] $conditionalQuery[0]";


      //  echo $query;

      $stmt = $this->pdo->prepare($query);
      $result = $stmt->execute();
      if ($result) {
        return true;
      } else {
        return false;
      }

    } else {
      return false;
    }
  }

  public function updateQueryValid($tableName, $updateColumnField, $updateWhere = [])
  {

    $conditionalQuery = $this->isConditional($updateWhere, $updateColumnField);
    $query = "UPDATE $tableName SET $conditionalQuery[2] $conditionalQuery[0]";

      // echo $query . '<br/>';


    $stmt = $this->pdo->prepare($query);


  

    $result = $stmt->execute();
  

    if ($result) {
      return true;
    } else {
      return false;
    }

  }


  public function deleteQuery($tableName, $selectFied, $where = [], $params = [], $delWhere = []){
    // validate date if exist 
    $validate = $this->validateQueryExisted($tableName, $selectFied, $where, $params);
    if ($validate) {
      $conditionalQuery = $this->isConditional($where);

      $stmt = $this->pdo->prepare("DELETE FROM $tableName $conditionalQuery[0]");

      $result = $stmt->execute();
      if ($result) {
        return true;
      } else {
        return false;
      }

    } else {
      return false;
    }
  }


  public function deleteQueryValid($tableName, $deleteWhere = [])
  {

    $conditionalQuery = $this->isConditional($deleteWhere);

    $stmt = $this->pdo->prepare("DELETE FROM $tableName $conditionalQuery[0]");
    
    $result = $stmt->execute();
    if ($result) {
      return true;
    } else {
      return false;
    }


  }



}

?>
<?php
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);
  $exists = 0;
  $strength = 0;
  $params = array(   
                 array(&$exists, SQLSRV_PARAM_OUT), 
                 array($username, SQLSRV_PARAM_IN),  
               ); 
  $sql = "EXEC ?=checkUsername(?)";
  #$stmt = sqlsrv_query($conn, $sql, $params);
  if(!$stmt)  
  { 
     die( print_r( sqlsrv_errors(), true));  
  }
  sqlsrv_free_stmt( $stmt);
  if($exists)
  {
    echo "This user name is taken";
  }
  else
  {
    echo "This user name is not taken";
  }
  $params = array(   
                 array(&$strength, SQLSRV_PARAM_OUT), 
                 array($password, SQLSRV_PARAM_IN), 
               );
  $sql = "EXEC ?=checkPassword(?)}";
  $stmt = sqlsrv_query($conn, $sql, $params);
  if(!$stmt)  
  {  
     die( print_r( sqlsrv_errors(), true));  
  }
  sqlsrv_free_stmt( $stmt);
  echo $stength;
?>
 

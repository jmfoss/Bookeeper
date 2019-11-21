
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div id="title" align="center"> <img src="logo.png" style ="margin-top: 50px"> </div>
    <div class="topnav" id="myTopnav">
      <a href="dbm_main.html" class="active"> Home </a>
      <a href="dbm_searchbooks.html"> Search Books </a>
      <a href="dbm_addbooks.html"> Add Books </a>
      <a href="dbm_library.html"> My Library </a>
      <!-- <a href="uploadDoc.html"> Upload Documents </a> -->
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"> </i>
      </a>
    </div>
    
   <body> 
    
<?php
  require_once "config.php";
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);
  $exists = 0;
  $strength = " ";
  $usernameMSG = "";
  $passwordMSG = "";
  $passwordValid = false;
  $usernameValid = false;
  $params = array(   
                 array(&$exists, SQLSRV_PARAM_OUT), 
                 array($username, SQLSRV_PARAM_IN),  
               ); 
  $sql = "EXEC ?=checkUsername @username = ?";
  $stmt = sqlsrv_query($conn, $sql, $params);
  if(!$stmt)  
  { 
     die( print_r( sqlsrv_errors(), true));  
  }
  sqlsrv_free_stmt( $stmt);
  if($exists)
  {
    $usernameValid = false;
    $usernameMSG == "This user name is taken";
  }
  else
  {
    $usernameValid = true;
  }
  $params = array(   
                  array($password, SQLSRV_PARAM_IN),
                  array(&$strength, SQLSRV_PARAM_OUT),
               );
  $sql = "EXEC checkPassword @password = ?, @OutString = ?";
  $stmt = sqlsrv_query($conn, $sql, $params);
  if(!$stmt)  
  {  
    die( print_r( sqlsrv_errors(), true));  
  }
  sqlsrv_free_stmt( $stmt);
  If ($strength == "STRONG")
  {
    $passwordValid = true;
    $passwordMSG = "This is a strong password";
  }
  else if ($strength == "MEDIUM")
  {
    $passwordValid = true;
    $passwordMSG = "This is a medium password";
  }
  else if ($strength == "WEAK")
  {
    $passwordValid = false;
    $passwordMSG = "This is password is too weak";
  }
  else
  {
    $passwordValid = false;
    $passwordMSG = "Passwords cannot contain spaces";
  }
  
  if ($passwordValid && $usernameValid)
  {
    $params = array(   
                  array($username, SQLSRV_PARAM_IN),
                  array($password, SQLSRV_PARAM_IN),
               );
    $sql = "EXEC addUser @username = ?, @password = ?";
    $stmt = sqlsrv_query($conn, $sql, $params);
    echo "User added";
  }
  
?>
     
    </body>
 
</html>

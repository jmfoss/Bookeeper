<!-- Joseph Santucci, Joshua FOss
     Database Management
     28 October 2019 -->

<!-- Main page -->
<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
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
    $homepage = file_get_contents('dbm_main.php');
    echo $homepage;
  }
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="title" align="center"> <img src="logo.png" style ="margin-top: 50px; margin-bottom: 100px"> </div>
        
        <form action = "" method = "post">
            <table align = "center" style = "margin-bottom: 40px; border: 1px " >
                <tr>
                    <td> New? Sign up!</td>
                </tr>
                <tr>
                    <td> <label style = "margin:10px; padding:10px"> Username: </label> <input id="ip2" type="text" name="username" style = "margin:10px; padding:2px"> </td>
                    <td> <label style = "margin:10px; padding:10px"> Password: </label> <input id="ip2" type="text" name="password" style = "margin:10px; padding:2px"> </td>
                    <td> <input type = "submit" value = "Sign Up" style = "margin:20px;margin-top:10px"/> </td>
                </tr>
            </table>
        </form>
        <hr class ="striped-border">
        <br>
        <form action = "" method = "post">
            <table align = "center">
                <tr>
                    <td> Already have an account? Log In!</td>
                </tr>
                <tr>
                    <td> <label style = "margin:10px; padding:10px"> Username: </label> <input id="ip2" type="text" name="username" style = "margin:10px; padding:2px"> </td>
                    <td> <label style = "margin:10px; padding:10px"> Password: </label> <input id="ip2" type="text" name="password" style = "margin:10px; padding:2px"> </td>
                    <td> <input type = "submit"  value = "Log In" style = "margin:20px;margin-top:10px"/> </td>
                </tr>
            </table>
         </form>
    </body>
</html>

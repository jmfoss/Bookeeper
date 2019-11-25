<!-- Joseph Santucci, Joshua FOss
     Database Management
     28 October 2019 -->

<!-- Main page -->
<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: dbm_main.php");
    exit;
}

// Include config file
require_once "config.php";
$list = $book = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
     //Options: read, reading, future
     $list = trim($_POST["list"]);
     $book = trim($_POST["book"]);
     &sql = "EXEC addToList @userID = ?, @listName = ?, @title = ?";
     $params = array(   
                     array($_SESSION["userID"], SQLSRV_PARAM_IN), 
                     array($list, SQLSRV_PARAM_IN),
                     array($book, SQLSRV_PARAM_IN),
                     ); 
     $stmt = sqlsrv_query($conn, $sql, $params);
     if($stmt != false)
        {              
          
        } 
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }                   
?>


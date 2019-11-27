<?php
// Initialize the session
session_start();
require_once "config.php";
$sql = "DELETE FROM users WHERE userID = ?";
$stmt = sqlsrv_query($conn, $sql, array($_SESSION["userID"]));
if(!$stmt)
{  
  echo "Whoa, something went wrong!";
}
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: dbm_login.php");
exit;
?>

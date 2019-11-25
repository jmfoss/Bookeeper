<!-- Joseph Santucci, Joshua FOss
     Database Management
     28 October 2019 -->

<!-- Main page -->
<?php
// Initialize the session
session_start();
require_once "config.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: dbm_login.php");
    exit;
}
$title = $list = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
     if(empty(trim($_POST["title"])))
     {
      $title_err = "Please enter a title.";
     } 
     else
     {
      $title = trim($_POST["title"]);
     }
     $list = trim($_POST["list"]);
     if (empty($title_err))
     {
	  $params = array(
                          array($_SESSION["userID"], SQLSRV_PARAM_IN),
                          array($title, SQLSRV_PARAM_IN),
                          array($list, SQLSRV_PARAM_IN)
                         );
          $sql = "EXEC addToList @userID = ?, @title = ?, @list = ?";
          $stmt = sqlsrv_query($conn, $sql, $params);
          if($stmt == false)
          {
               echo "This book is already in the your list.";
          }
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
    <div id="title" align="center"> <img src="logo.png" style ="margin-top: 50px"> </div>
    <div class="topnav" id="myTopnav">
      <a href="dbm_main.php"> Home </a>
      <a href="dbm_searchbooks.html"> Search Books </a>
      <a href="dbm_addbooks.html"> Add Books </a>
      <a href="dbm_library.html" class="active"> My Library </a>
      <!-- <a href="uploadDoc.html"> Upload Documents </a> -->
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"> </i>
      </a>
    </div>
        <form action = "" method = "post">

        </div>
              <div class = "wrapper" id="questions">
                <table>
                    <tr>
 	
            			<select name="list" style = "margin:20px; padding:10px">
                			<option value="read"> Read </option>
                			<option value="wanttoread"> Want to Read </option>
                			<option value="currentlyreading"> Currently Reading </option>
				</select>
                        <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
			  <td> <label style = "margin:10px; padding:10px"> Title </label> </td>
                          <td> <input id="ip2" type="text" name="title" value="<?php echo $title; ?>" style = "margin:10px; padding:2px"> </td>
			  <span class="help-block"><?php echo $title_err; ?></span>
		        </div>  
                </table>
        	</div>
          <input type = "reset"  value = "Reset Form" style = "margin:20px;margin-top:10px"/>
	      <input type = "submit"  value = "Submit" style = "margin:20px;margin-top:10px"/>
	      <span class="help-block"><?php echo $msg; ?></span>
      </form>

    
  </body>

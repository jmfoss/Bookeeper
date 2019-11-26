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
$array = array();
$query = $_REQUEST['query'];
$sql = "SELECT title FROM books WHERE title LIKE '{$query}%'";
$stmt = sqlsrv_query($conn, $sql);
if(!$stmt)
{
    print_r(sqlsrv_errors());
}
while ($row = sqlsrv_fetch_array($stmt)) 
{
	$array[] = $row['title'];
}
echo json_encode($array);
$title = $list = $msg = "";
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
               $msg = "This book is already in the your list.";
          }
	  else
	  {
		$msg = "$title was added to $list";
	  }
     }
}



?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}

body {
  font: 16px Arial;  
}

/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>
</head>     
<body>


</body>
  </head>
  <body>
    <div id="title" align="center"> <img src="logo.png" style ="margin-top: 50px"> </div>
    <div class="topnav" id="myTopnav">
      <a href="dbm_main.php"> Home </a>
      <a href="dbm_searchbooks.html"> Search Books </a>
      <a href="dbm_addbooks.html"> Add Books </a>
      <a href="dbm_addLibrary.php" class="active"> My Library </a>
      </a>
    </div>
        <form autocomplete="off" action = "" method = "post">

        </div>
              <div class = "autocomplete" id="questions">
                <table>
                    <tr>
 	
			<select name="list" style = "margin:20px; padding:10px">
				<option value="read"> Read </option>
				<option value="wanttoread"> Want to Read </option>
				<option value="currentlyreading"> Currently Reading </option>
			</select>
			  <div class="autocomplete" style="width:300px;">
			    <input id="title" type="text" name="title" placeholder="title">
			  </div>
			</form>

                </table>
        	</div>
          <input type = "reset"  value = "Reset Form" style = "margin:20px;margin-top:10px"/>
	      <input type = "submit"  value = "Submit" style = "margin:20px;margin-top:10px"/>
	      <span class="help-block"><?php echo $msg; ?></span>
	      <span class="help-block"><?php echo $title_err; ?></span>
      </form>
    <script>
    $(document).ready(function () {
        $('#title').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "dbm_addLibrary.php",
		    data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
			  result($.map(data, function (item) {
			return item;
                        }));
                    }
                });
            }
        });
    });
</script>
  </body>
</html>

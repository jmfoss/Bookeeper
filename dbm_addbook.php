<?php
    require_once "config.php";;
    $msg = $title = $author = $published = $publisher = $language = "";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
               
            $title = trim($_POST["title"]);
	    $author = trim($_POST["author"]);
	    $published = trim($_POST["published"]);
	    $publisher = trim($_POST["publisher"]);
	    $language = trim($_POST["language"]);
	    $result = "";
	    $params = array(   
			array(&$result, SQLSRV_PARAM_OUT), 
			array($title, SQLSRV_PARAM_IN),  
			array($author, SQLSRV_PARAM_IN),
			array($published, SQLSRV_PARAM_IN),
			array($publisher, SQLSRV_PARAM_IN),
			array($language, SQLSRV_PARAM_IN),
           );
        $sql = "EXEC addBook @result = ?, @title = ?, @author = ?, @published = ?, @publisher = ?, @language = ?";
        $stmt = sqlsrv_query($conn, $sql, $params);
        if($stmt != false)
        {
	    if($result == "ADDED")
            {
		$msg = "$title has been added to library.";
            }
            else if ($result == "ERROR")
            {
		$msg = "$title is already in the library.";
            }
	    else
	    {
		echo $result;
	    }
        }
        else
        {
		echo "Oops! Something went wrong.";
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
      <a href="dbm_addbook.php" class="active"> Add Books </a>
      <a href="dbm_library.html"> My Library </a>
      <!-- <a href="uploadDoc.html"> Upload Documents </a> -->
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"> </i>
      </a>
      </div>
      </br>
    </br>
    <form action = "dbm_addbook.php" method = "post">
		<div class="custom-select" style="width:200px;">  	
            <select style = "margin:20px; padding:10px">
                <option value="read"> Read </option>
                <option value="wanttoread"> Want to Read </option>
                <option value="currentlyreading"> Currently Reading </option>
			</select>
        </div>
        	<div id="questions">
                <table>
                    <tr>
                        <td> <label style = "margin:10px; padding:10px"> Title </label> </td>
                        <td> <input id="ip2" type="text" name="title" style = "margin:10px; padding:2px"> </td> 
                    </tr>
                    <tr>
                        <td> <label style = "margin:10px; padding:10px"> Author </label> </td>
                        <td> <input id="ip2" type="text" name="author" style = "margin:10px; padding:2px"> </td> 
                    </tr>
                    <tr>
                        <td> <label style = "margin:10px; padding:10px"> Published </label> </td>
                        <td> <input id="ip2" type="text" name="published" style = "margin:10px; padding:2px"> </td> 
                    </tr>
                    <tr>
                        <td> <label style = "margin:10px; padding:10px"> Publisher </label> </td>
                        <td> <input id="ip2" type="text" name="publisher" style = "margin:10px; padding:2px"> </td> 
                    </tr>
                    <tr>
                        <td> <label style = "margin:10px; padding:10px"> Language </label> </td>
                        <td> <input id="ip2" type="text" name="language" style = "margin:10px; padding:2px"> </td> 
                    </tr>
                </table>
        	</div>
          <input type = "reset"  value = "Reset Form" style = "margin:20px;margin-top:10px"/>
	      <input type = "submit"  value = "Submit" style = "margin:20px;margin-top:10px"/>
	      <span class="help-block"><?php echo $msg; ?></span>
      </form>
      
  </body>
</html>

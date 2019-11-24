<?php
    require_once "config.php";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $msg = "";       
        $params = array(   
                        array(&$error, SQLSRV_PARAM_OUT), 
                        array(trim($_POST["title"]), SQLSRV_PARAM_IN),  
                        array(trim($_POST["author"]), SQLSRV_PARAM_IN),
                        array(trim($_POST["published"]), SQLSRV_PARAM_IN),
                        array(trim($_POST["publisher"]), SQLSRV_PARAM_IN),
                        array(trim($_POST["language"]), SQLSRV_PARAM_IN),
           );
        $sql = "EXEC ? = addbook @title = ?, @author = ?, @published = ?, @publisher = ?, @language = ?";
        $stmt = sqlsrv_query($conn, $stmt, $params);
        if($stmt)
        {
            if($error != null)
            {
                $msg = $title + " added to library.";
            }
            else
            {
                $msg =$title + " is already in the library.";
            }
        }
        else
        {
            echo "Oops! Something went wrong.";
        }
    }
        
?>

<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div id="title" align="center"> <img src="logo.png" style ="margin-top: 50px"> </div>
    <!-- <div id="title"> <h1 align="center"> B O O K E E P E R </h1> </div> -->
    <div class="topnav" id="myTopnav">
      <a href="dbm_main.php"> Home </a>
      <a href="dbm_searchbooks.html"> Search Books </a>
      <a href="dbm_addbooks.html" class="active"> Add Books </a>
      <a href="dbm_library.html"> My Library </a>
      <!-- <a href="uploadDoc.html"> Upload Documents </a> -->
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"> </i>
      </a>
    </div>
    <br>
    <br>
<body>
</body>
</html>

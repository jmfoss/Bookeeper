<!-- Joseph Santucci, Joshua FOss
     Database Management
     28 October 2019 -->

<!-- Main page -->
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: dbm_login.php");
    exit;
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
      <a href="dbm_main.php" class="active"> Home </a>
      <a href="dbm_searchbooks.php"> Search Books </a>
      <a href="dbm_addbook.php"> Add Books </a>
      <a href="dbm_addLibrary.php"> My Library </a>
      <!-- <a href="uploadDoc.html"> Upload Documents </a> -->
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"> </i>
      </a>
    </div>

    <!-- Intro to application -->
    <h2 align = "center" style = "margin:20px; margin-bottom:10px"> Welcome to Bookeeper!</h2>
    <h4 align ="center" style="margin-bottom:50px"> Joey Santucci and Josh Foss </h4>

    <!-- Table with links to ppt, tech doc and progress report -->
    <table align = "center">
      <tr>
        <td style = "margin:20px; padding:20px; color:#2b3770; background-color:#b1bfcc"> <a href="isptechdoc.pdf"> Presentation </a> </td>
        <td style = "margin:20px; padding:20px; color:#2b3770; background-color:#b1bfcc"> <a href="ppt.pdf"> Final Report </a> </td>
      </tr>
    </table>
       
    <p align = "center" style = "margin-bottom:75px; margin-top:50px"> Bookeeper is a web application that stores each user’s library of books. <br>
        Add books to any of your lists, including previously read, books you want to read, <br> books you are currently reading.
        Single sign on allows you to manage and edit <br> your lists without repeatedly entering your credentials. <br>
    </p>
       
    <table align = "center">
        <tr>
          <form action="dbm_logout.php" method="post">
                <td> <label style = "margin:10px; padding:10px"> <input type="submit" name="submit" value="Log out" style = "margin:10px; padding:2px"/> </td>
          </form>
          <form action="dbm_delete.php" method="post">
                <td> <label style = "margin:10px; padding:10px"> <input type="submit" name="submit" value="Delete Account" style = "margin:10px; padding:2px"/> </td>
          </form>
        </tr>
    </table>
  </body>
</html>


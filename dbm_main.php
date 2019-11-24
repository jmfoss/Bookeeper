<!-- Joseph Santucci, Joshua FOss
     Database Management
     28 October 2019 -->

<!-- Main page -->
<?php
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
      <a href="dbm_searchbooks.html"> Search Books </a>
      <a href="dbm_addbooks.html"> Add Books </a>
      <a href="dbm_library.html"> My Library </a>
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
        <td style = "margin:20px; padding:20px; color:#edeff7; background-color:#2b3370"> <a href="isptechdoc.pdf"> shortcut </a> </td>
        <td style = "margin:20px; padding:20px; color:#edeff7; background-color:#2b3370"> <a href="ppt.pdf"> shortcut </a> </td>
        <td style = "margin:20px; padding:20px; color:#edeff7; background-color:#2b3370"> <a href="isp_progressreport.pdf"> shortcut </a> </td>
      </tr>
    </table>

    <p align = "center" style = "margin-bottom:75px; margin-top:50px"> Navigate the website using the above tool bar. <br>
        (Plan to add better website description)<br>
    </p>
    <table align = "center">
        <tr>
          <form action="signup.php" method="post">
              <td> <label style = "margin:10px; padding:10px"> Username: </label> <input id="ip2" type="text" name="username" style = "margin:10px; padding:2px"> </td>
              <td> <label style = "margin:10px; padding:10px"> Password: </label> <input id="ip2" type="text" name="password" style = "margin:10px; padding:2px"> </td>
              <td> <label style = "margin:10px; padding:10px"> <input type="submit" name="submit" value="Sign Up" style = "margin:10px; padding:2px"/> </td>
          </form>
        </tr>
    </table>
  </body>
</html>


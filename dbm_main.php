<!-- Joseph Santucci, Joshua FOss
     Database Management
     28 October 2019 -->

<!-- Main page -->
<?php   
session_start();
     $serverName = "bookeeper.database.windows.net";
     $connectionOptions = array( "Bookeeper", "jmfoss", "Mikito98" );
     if ( isset( $_POST['submit'] )
         {
              $conn = sqlsrv_connect($serverName, $connectionOptions);
              $username = $_REQUEST['username'];
              $password = $_REQUEST['password'];
              if (empty($username))
                   echo "PLease input a username";
              $sqlQuery= "SELECT userID FROM users WHERE username = $username";
              $getResults= sqlsrv_query($conn, $sqlQuery);
              if ($getResults == FALSE)
                  echo (sqlsrv_errors());
              if(sqlsrv_num_rows($getResults) == 1)
                  echo "This username is taken";
              sqlsrv_free_stmt($getResults);
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
    <!-- <div id="title"> <h1 align="center"> B O O K E E P E R </h1> </div> -->
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
          <form action="" method="post">
              <td> <label style = "margin:10px; padding:10px"> Username: </label> <input id="ip2" type="text" name="username" value=<?php echo $username; ?> style = "margin:10px; padding:2px"> </td>
              <td> <label style = "margin:10px; padding:10px"> Password: </label> <input id="ip2" type="text" name="password" value=<?php echo $password; ?> style = "margin:10px; padding:2px"> </td>
              <td> <label style = "margin:10px; padding:10px"> <input type="submit" name="submit" /> </td>
          </form>
        </tr>
    </table>
  </body>
</html>


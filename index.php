<!DOCTYPE html>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title> ISP Term Project </title>
  </head>
  <body>
    <div id="title"> <h1 align="center"> Create a Test </h1> </div>
    <div class="topnav" id="myTopnav">
      <a href="prj.html"> Home </a>
      <a href="main.html" class="active"> Create a Test </a>
      <a href="selectTest.jsp"> Take Test </a>
      <a href="viewGrades.html"> View Grades </a>
      <!-- <a href="uploadDoc.html"> Upload Documents </a> -->
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"> </i>
      </a>
    </div>

    <div style="padding-left:16px">
      <h2>Create a Test</h2>
      <!-- Description on how to create a test -->
      <p> To create a new test, begin by naming the test in the "Test Name" field provided. </br>
          Do not add any spaces to the test name. For example "Quiz 1" will not work, but </br>
          "Quiz1" will work. </br>
          Then, type in the question in the "Question" field, and the series of answers</br>
          in the list of answer fields (up to 4 answers can be inputed). Then, in</br>
          the final box, list the corresponding letter to the correct question. If</br>
          the question is True or False, use "T" and "F" in the "Correct Answer" field </br>
          </br>
          To add questions to a previously made test, simply type the exact name of</br>
          the test into the "Test Name" field (capitalization matters), and input</br>
          the questions and answers as previously stated. </br>
          </br>
          To save the question to the test, press the "Submit" button. </br>
          This will add the question to the test bank. Once this button is pressed,</br>
          you will see all the questions and answers currently in that test. </br>
          To clear the form, press the reset button. </br>
          </br>
      </p>
      </br>

      <form action = "db-createTest.jsp" method = "post">
        	<label style = "margin:10px; padding:10px"> Test Name: </label> <input type="text" name="testName"> <br><br>
        	<div id="questions">
        	   <label style = "margin:10px; padding:10px"> Question: </label> <input type="text" name="question" style = "margin:10px; padding:2px"> <br>
        	   <label style = "margin:10px; padding:10px"> Answer Option A </label> <input type="text" name="qA" style = "margin:10px; padding:2px"> <br>
        	   <label style = "margin:10px; padding:10px"> Answer Option B </label> <input type="text" name="qB" style = "margin:10px; padding:2px"> <br>
        	   <label style = "margin:10px; padding:10px"> Answer Option C </label> <input type="text" name="qC" style = "margin:10px; padding:2px"> <br>
        	   <label style = "margin:10px; padding:10px"> Answer Option D </label> <input type="text" name="qD" style = "margin:10px; padding:2px"> <br>
        	   <label style = "margin:10px; padding:10px"> Correct Answer (Enter Letter) </label> <input type="text" name="answer" size = "1" style = "margin:10px; padding:2px"> <br><br>
        	</div>
          <input type = "reset"  value = "Reset Form" style = "margin:20px;margin-top:10px"/>
	        <input type = "submit"  value = "Submit" style = "margin:20px;margin-top:10px"/>
      </form>
    </div>
  </body>
</html>


<?php
    $serverName = "bookeeper.database.windows.net";
    $connectionOptions = array(
        "Database" => "Bookeeper",
        "Uid" => "jmfoss",
        "PWD" => "Mikito98"
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    $tsql= "SELECT * FROM users";
    $getResults= sqlsrv_query($conn, $tsql);
    echo ("Reading data from table<br>" . PHP_EOL);
    if ($getResults == FALSE)
        echo (sqlsrv_errors());
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) 
    {       
       echo $row['userID'] . " " . $row['username'] . " " . $row['password'] . " " . date_format($row['join_date'],"Y/m/d H:i:s") . "\n";
    }
    sqlsrv_free_stmt($getResults);
?>

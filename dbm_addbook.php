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

<?php
    
    /*echo "<textarea name='mydata'>\n";
    echo htmlspecialchars($data)."\n";
    echo "</textarea>";*/
    
    require_once "config.php";
    
    $title = $_POST["title"];
    $author = $_POST["author"];
    $published_date = $_POST["published"];
    
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    $tsql= "INSERT INTO books values('$title', '$author')";
    $getResults= sqlsrv_query($conn, $tsql);
    /*$tsql= "SEARCH * FROM books";
    $getResults= sqlsrv_query($conn, $tsql);
    echo ("Reading data from table<br>" . PHP_EOL);
    if ($getResults == FALSE)
        echo (sqlsrv_errors());
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) 
    {       
       echo $row['title'] . " " . $row['author'] . " " . $row['published_date'] . " " . date_format($row['join_date'],"Y/m/d H:i:s") . "\n";
    }
    sqlsrv_free_stmt($getResults);*/
  /*  
// Get input data
    $id = $_POST["id"];
    $type = $_POST["type"];
    $miles = $_POST["miles"];
    $year = $_POST["year"];
    $state = $_POST["state"];
    $action = $_POST["action"];
    $statement = $_POST["statement"];
    
    // If any of numerical values are blank, set them to zero
    if ($id == "") $id = 0;
    if ($miles == "") $miles = 0.0;
    if ($year == "") $year = 0;
    if ($state == "") $state = 0;

// Connect to MySQL
//$db = mysql_connect("db1.cs.uakron.edu:3306", "xiaotest", "wpdb");
$db = mysqli_connect("db1.cs.uakron.edu:3306", "xiaotest", "wpdb");
//$db = mysqli_connect("db1.cs.uakron.edu:3306", "xiaotest", "wpdb","xiaotest");
if (!$db) {
     print "Error - Could not connect to MySQL";
     exit;
}

// Select the database
$er = mysqli_select_db($db,"xiaotest");
if (!$er) {
    print "Error - Could not select the database";
    exit;
}

// print "<b> The action is: </b> $action <br />";

if($action == "display")
    $query = "";
else if ($action == "insert")
    $query = "insert into Corvettes values($id, '$type', $miles, $year, $state)";
else if ($action == "update")
    $query = "update Corvettes set Body_style = '$type', Miles = $miles, Year = $year, State = $state where Vette_id = $id";
else if ($action == "delete")
    $query = "delete from Corvettes where Vette_id = $id";
else if ($action == "user")
    $query = $statement;


if($query != ""){
    trim($query);
    $query_html = htmlspecialchars($query);
    print "<b> The query is: </b> " . $query_html . "<br />";
    
    // Don't remove or comment out the line below untill you switched to your own database. VIOLATORS WILL BE SEVERELY PUNISHED!!! :-).
    //$query = "SELECT * FROM Corvettes";
    
    $result = mysqli_query($db,$query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error();
        print "<p>" . $error . "</p>";
    }
}
    
// Final Display of All Entries
$query = "SELECT * FROM Corvettes";
$result = mysqli_query($db,$query);
if (!$result) {
    print "Error - the query could not be executed";
    $error = mysqli_error();
    print "<p>" . $error . "</p>";
    exit;
}

// Get the number of rows in the result, as well as the first row
//  and the number of fields in the rows
$num_rows = mysqli_num_rows($result);
//print "Number of rows = $num_rows <br />";

print "<table><caption> <h2> Cars ($num_rows) </h2> </caption>";
print "<tr align = 'center'>";

$row = mysqli_fetch_array($result);
$num_fields = mysqli_num_fields($result);

// Produce the column labels
$keys = array_keys($row);
for ($index = 0; $index < $num_fields; $index++) 
    print "<th>" . $keys[2 * $index + 1] . "</th>";
print "</tr>";
    
// Output the values of the fields in the rows
for ($row_num = 0; $row_num < $num_rows; $row_num++) {
    print "<tr align = 'center'>";
    $values = array_values($row);
    for ($index = 0; $index < $num_fields; $index++){
        $value = htmlspecialchars($values[2 * $index + 1]);
        print "<th>" . $value . "</th> ";
    }
    print "</tr>";
    $row = mysqli_fetch_array($result);
}
print "</table>";

    */
?>

</body>
</html>

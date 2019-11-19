<?php
    echo "<textarea name='mydata'>\n";
    echo htmlspecialchars($data)."\n";
    echo "</textarea>";

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
public bool DOMDocument::loadHTMLFile ( string $filename [, int $options = 0 ] )
$doc = new DOMDocument();
$doc->loadHTMLFile("dbm_main.html");
echo $doc->saveHTML();

?>

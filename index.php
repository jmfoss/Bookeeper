<?php
    $serverName = "bookeeper.database.windows.net"; // update me
    $connectionOptions = array(
        "Database" => "Bookeeper", // update me
        "Uid" => "jmfoss", // update me
        "PWD" => "Mikito98" // update me
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    $tsql= "SELECT * FROM users";
    $getResults= sqlsrv_query($conn, $tsql);
    echo ("Reading data from table" . PHP_EOL);
    if ($getResults == FALSE)
        echo (sqlsrv_errors());
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) 
    {       
       echo ($row['userID']. "hi);
       echo ($row['username']);
       echo ($row['password']);
       echo ($row['join_date']);
       echo ($row['userID'] . " " . $row['username'] . " " . $row['password']);
    }
    sqlsrv_free_stmt($getResults);
?>

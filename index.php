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
    echo ("Reading data from table" . PHP_EOL);
    if ($getResults == FALSE)
        echo (sqlsrv_errors());
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) 
    {       
       echo ($row['userID']);
       echo ($row['username']);
       echo ($row['password']);
       echo ($row['join_date']);
       echo 'This ' , 'string ' , 'was ' , 'made ' , 'with concatenation.' , "\n";
       echo ($row['userID'] . " " . $row['username'] . " " . $row['password']);
    }
    sqlsrv_free_stmt($getResults);
?>

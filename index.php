<?php

echo "We can do this!";

// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:bookeeper.database.windows.net,1433; Database = Bookeeper", "jmfoss", "Mikito98");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "jmfoss", "pwd" => "{your_password_here}", "Database" => "Bookeeper", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:bookeeper.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

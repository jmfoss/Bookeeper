<?php

$serverName = "bookeeper.database.windows.net"; //serverName\instanceName
$connectionInfo = array( "Database"=>"bookeeper", "UID"=>"jmfoss", "PWD"=>"Mikito98");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
 
if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>

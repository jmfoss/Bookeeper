<?php

$config = array(
    'endpoint' => array(
        'localhost' => array(
            'host' => '104.230.35.171',
            'port' => 8983,
            'path' => '/',
            'core' => 'bookeeper',
            // For Solr Cloud you need to provide a collection instead of core:
            // 'collection' => 'techproducts',
        )
    )
);
require(__DIR__.'/init.php');

$serverName = "bookeeper.database.windows.net"; //serverName\instanceName
$connectionInfo = array( "Database"=>"bookeeper", "UID"=>"jmfoss", "PWD"=>"Mikito98");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
 
if( !$conn ) {
     die( print_r( sqlsrv_errors(), true));
}
?>

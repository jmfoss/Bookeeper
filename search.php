<?php 
$config = array(
    'endpoint' => array(
        'localhost' => array(
            'host' => '104.230.35.171',
            'port' => 8983,
            'path' => '/',
            'core' => 'bookeeper',
        )
    )
);
require(__DIR__.'/init.php');
$client = new Solarium\Client($config);
$userQuery = "";
$results = array();
if(!empty($_POST["query"]))
{
	$userQuery = trim($_POST["query"]);	     
} 
$query = $client->createQuery($client::QUERY_SELECT);

// this executes the query and returns the result
$resultset = $client->execute("title:{$userQuery}");
echo json_encode($resultset);
?>

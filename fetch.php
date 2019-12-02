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
$suggestions = array();
if(isset($_POST["query"]))
{
	$userQuery = trim($_POST["query"]);	     
} 

// create a client instance
// get a suggester query instance
$query = $client->createSuggester();
$query->setQuery($userQuery);

// this executes the query and returns the result
$resultset = $client->suggester($query);
 foreach ($resultset as $dictionary => $terms) {
    foreach ($terms as $term => $termResult) {
        foreach ($termResult as $result) {
            $suggestions[] = $result['term'];
        }
    }
}
echo json_encode($suggestions);
?>

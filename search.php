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
//if(!empty($_POST["query"]))
{
	//$userQuery = trim($_POST["query"]);	     
} 
// get a select query instance
$query = $client->createSelect();
// get the dismax component and set a boost query
$edismax = $query->getEDisMax();
$query->setQuery('harry');

$resultset = $client->select($query);

echo 'NumFound: '.$resultset->getNumFound();
// show documents using the resultset iterator
foreach ($resultset as $document) {
    echo '<hr/><table>';
    // the documents are also iterable, to get all fields
    foreach ($document as $field => $value) {
        // this converts multivalue fields to a comma-separated string
        if (is_array($value)) {
            $value = implode(', ', $value);
        }
        echo '<tr><th>' . $field . '</th><td>' . $value . '</td></tr>';
    }
    echo '</table>';
}
?>

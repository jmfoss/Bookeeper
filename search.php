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
// get a select query instance
$query = $client->createSelect();
// get the facetset component
$facetSet = $query->getFacetSet();
// create a facet query instance and set options
$facetSet->createFacetQuery('titles')->setQuery('title:harry');
// this executes the query and returns the result
$resultset = $client->select($query);
// display the total number of documents found by solr
echo 'NumFound: '.$resultset->getNumFound();
// display facet query count
$count = $resultset->getFacetSet()->getFacet('titles')->getValue();
echo '<hr/>Facet query count : ' . $count;
// show documents using the resultset iterator
foreach ($resultset as $document) {
    echo '<hr/><table>';
    echo '<tr><th>title</th><td>' . $document->title . '</td></tr>';
    echo '</table>';
}
?>

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
// create a facet query instance and set options
$query->setQuery('title:Harry');
$query->setStart(2)->setRows(20);
$query->setFields(array('title', 'number_of_pages', 'isbn_10'));
// this executes the query and returns the result
$resultset = $client->select($query);
// display the total number of documents found by solr
echo 'NumFound: '.$resultset->getNumFound();
// display facet query count
// show documents using the resultset iterator
foreach ($resultset as $document) {
    echo '<hr/><table>';
    echo '<tr><th>title</th><td>' . $document->title . '</td></tr>';
    echo '<tr><th>pages</th><td>' . $document->number_of_pages . '</td></tr>';
    echo '<tr><th>isbn_10</th><td>' . $document->isbn_10[0] . '</td></tr>';
    echo '</table>';
}
?>

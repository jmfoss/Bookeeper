<!-- Joseph Santucci, Joshua FOss
     Database Management
     28 October 2019 -->

<!-- Main page -->


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

// create a client instance
$client = new Solarium\Client($config);
// get a suggester query instance
$query = $client->createSuggester();
$query->setQuery('c');
$query->setDictionary('mySuggester');
$query->setBuild(true);
$query->setCount(10);
// this executes the query and returns the result
$resultset = $client->suggester($query);
echo '<b>Query:</b> '.$query->getQuery().'<hr/>';
// display results for each term
foreach ($resultset as $dictionary => $terms) {
    echo '<h3>' . $dictionary . '</h3>';
    foreach ($terms as $term => $termResult) {
        echo '<h4>' . $term . '</h4>';
        echo 'NumFound: '.$termResult->getNumFound().'<br/>';
        foreach ($termResult as $result) {
            echo '- '.$result['term'].'<br/>';
        }
    }
    echo '<hr/>';
}
?>

<!DOCTYPE html>



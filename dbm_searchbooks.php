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
$query->setQuery('h'); //multiple terms
$query->setDictionary('mySuggester');
$query->setCount(10);

// this executes the query and returns the result
$resultset = $client->suggester($query);

echo '<b>Query:</b> '.$query->getQuery().'<hr/>';

// display results for each term
foreach ($resultset as $term => $termResult) {
    echo '<h3>' . $term . '</h3>';
    echo 'NumFound: '.$termResult->getNumFound().'<br/>';
    echo 'StartOffset: '.$termResult->getStartOffset().'<br/>';
    echo 'EndOffset: '.$termResult->getEndOffset().'<br/>';
    echo 'Suggestions:<br/>';
    foreach ($termResult as $result) {
        echo '- '.$result.'<br/>';
    }

    echo '<hr/>';
}

// display collation
echo 'Collation: '.$resultset->getCollation();
?>

<!DOCTYPE html>



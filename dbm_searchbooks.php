<!-- Joseph Santucci, Joshua FOss
     Database Management
     28 October 2019 -->

<!-- Main page -->


<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
require'vendor/autoload.php';
$config = array(
    'endpoint' => array(
        'localhost' => array(
            'host' => '104.230.35.171',
            'port' => 8983,
            'path' => '/#/',
            'core' => 'bookeeper',
        )
    )
);
// check solarium version available
//echo 'Solarium library version: ' . Solarium\Client::VERSION . ' - ';
$client = new Solarium\Client($config);
// get a select query instance
$query = $client->createSelect();
// set a query (all prices starting from 12)
$query->setQuery('title:Harry*');
// set start and rows param (comparable to SQL limit) using fluent interface
$query->setStart(2)->setRows(20);
// set fields to fetch (this overrides the default setting 'all fields')
$query->setFields(array('title'));
// sort the results by price ascending
$query->addSort('price', $query::SORT_ASC);
// this executes the query and returns the result
$resultset = $client->select($query);
// display the total number of documents found by solr
echo 'NumFound: '.$resultset->getNumFound();
// display the max score
echo '<br>MaxScore: '.$resultset->getMaxScore();
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
          

?>

<!DOCTYPE html>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div id="title" align="center"> <img src="logo.png" style ="margin-top: 50px"> </div>
    <div class="topnav" id="myTopnav">
      <a href="dbm_main.php"> Home </a>
      <a href="dbm_searchbooks.php" class="active"> Search Books </a>
      <a href="dbm_addbook.php"> Add Books </a>
      <a href="dbm_addLibrary.php"> My Library </a>
      <!-- <a href="uploadDoc.html"> Upload Documents </a> -->
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"> </i>
      </a>
    </div>

    
  </body>
</html>

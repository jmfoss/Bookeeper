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
            // For Solr Cloud you need to provide a collection instead of core:
            // 'collection' => 'techproducts',
        )
    )
);

require(__DIR__.'/init.php');
htmlHeader();
// check solarium version available
echo 'Solarium library version: ' . Solarium\Client::VERSION . ' - ';

// create a client instance
$client = new Solarium\Client($config);

// create a ping query
$ping = $client->createPing();

// execute the ping query
try {
    $result = $client->ping($ping);
    echo 'Ping query successful';
    echo '<br/><pre>';
    var_dump($result->getData());
    echo '</pre>';
} catch (Solarium\Exception $e) {
    echo 'Ping query failed';
}        

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

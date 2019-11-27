<!-- Joseph Santucci, Joshua FOss
     Database Management
     28 October 2019 -->

<!-- Main page -->


<?php

$options = array (
    'host' => "localhost",
    'port' => 8983, 
    'path' => '/solr/#/bookeeper',
);

$client = new SolrClient($options);

$query = new SolrQuery();

$query->setQuery('title:Black');

$query->setStart(0);

$query->setRows(50);

$query->addField('title')->addField('number_of_pages')->addField('publish_date')->addField('publishers');

$query_response = $client->query($query);

$response = $query_response->getResponse();


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

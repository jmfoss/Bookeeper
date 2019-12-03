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
$client = new Solarium\Client($config);
// get a select query instance
$query = $client->createSelect();
// create a facet query instance and set options
if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(!empty(trim($_POST["search"])))
    {
         
          $userQuery = trim($_POST["search"]); 
          $query->setQuery('title:{$userQuery}');
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
    }
}
?>

<!DOCTYPE html>
<html>
 <head>
  <title>Webslesson Tutorial | Autocomplete Textbox using Bootstrap Typehead with Ajax PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" type="text/css" href="style.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <div id="title" align="center"> <img src="logo.png" style ="margin-top: 50px"> </div>
    <div class="topnav" id="myTopnav">
      <a href="dbm_main.php"> Home </a>
      <a href="dbm_searchbooks.php" class="active"> Search Books </a>
      <a href="dbm_addbook.php"> Add Books </a>
      <a href="dbm_addLibrary.php"> My Library </a>
         </div>
  </head>
 <body>
<form action = "" method = "post">
  <br /><br />
  <div class="container" style="width:600px;">


   <br /><br />
   <label>Search a Book</label>
   <input type="text" name="search" id="search" class="form-control input-lg" autocomplete="off" placeholder="Type Book Title" />
  </div>
      </form>
 </body>
</html>

<script>
$(document).ready(function(){
 
 $('#search').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
 
});



</script>

<!-- Joseph Santucci, Joshua FOss
     Database Management
     28 October 2019 -->

<!-- Main page -->

<!DOCTYPE html>
<html>
 <head>
  <title>Bookeeper</title>
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
   <input type="text" name="search" id="search" class="form-control input-lg" value="<?php echo $userQuery; ?>" autocomplete="off" placeholder="Type Book Title" />
  </div>
     <br>
     <div class="container" style="width:600px;">
          <table> 
               <tr>
                    <td style = "padding: 15px"> <input type="radio" name="sort" value="nosort" id="nosort"> No Sort</td>   
                    <td style = "padding: 15px"> <input type="radio" name="sort" value="pagecount" id="pagecount"> Sort by Page Count</td>
                    <td style = "padding: 15px"> <input type="radio" name="sort" value="published" id="published"> Sort by Published Date </td>
               </tr>
          </table> 
          
     </div>
      </form>
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
               $userQuery = "";
               if($_SERVER["REQUEST_METHOD"] == "POST")
                 {
                   if(!empty(trim($_POST["search"])))
                   {

                         $userQuery = trim($_POST["search"]);
                         $query->setQuery('title:'.$userQuery.'*');
                         $query->setStart(2)->setRows(20);
                         $query->setFields(array('title', 'number_of_pages', 'isbn_10', 'publish_date'));
                         $query->addSort('number_of_pages', $query::SORT_ASC);
                         $query->createFilterQuery('Pages')->setQuery('number_of_pages:[* TO *]');
                         $query->createFilterQuery('ISBNS')->setQuery('isbn_10:[* TO *]');
                         // this executes the query and returns the result
                         $resultset = $client->select($query);
                         // display the total number of documents found by solr
                         echo 'Retrieve Count: '.$resultset->getNumFound();
                         // display facet query count
                         // show documents using the resultset iterator
                                   foreach ($resultset as $document) {
                                  echo '<hr/><table align = "center" width="500" style = "border-radius: 25px; background: #99bdf7; padding: 50px; width: 1000px; height: 200px;">';
                                  echo '<tr><th>title</th><td>' . $document->title . '</td>';
                                  echo '<td><img src= "http://covers.openlibrary.org/b/isbn/'.$document->isbn_10[0].'-M.jpg"></td></tr>';
                                  echo '<tr><th>pages</th><td>' . $document->number_of_pages . '</td></tr>';
                                  echo '<tr><th>Date published</th><td>' . $document->publish_date . '</td></tr>';
                                  
                                  echo '</table>';
                              }
                   }
               }
          ?>
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

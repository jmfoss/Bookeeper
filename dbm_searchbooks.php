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
$userQuery = "";
$userQuery = trim($_GET['query']);
// create a client instance


// get a suggester query instance
$query = $client->createSuggester();
$query->setQuery($userQuery);
$suggestions = $resultset;
// this executes the query and returns the result
$resultset = $client->suggester($query);

echo '<b>Query:</b> '.$query->getQuery().'<hr/>';

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

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}
body {
  font: 16px Arial;  
}
/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}
input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}
input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}
input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}
/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}
/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
tr {
     background-color: #fff;
}
tr:nth-child(even) {background-color: #f2f2f2;}
	
td {
  padding: 15px;
  text-align: left;
}
th {
  padding: 15px;
  text-align: left;
  background-color: #285ac7;
  color: white;
}
	
/* Split the screen in half */
.split {
  height: 100%;
  width: 50%;
  position: fixed;
  z-index: 1;
  top: 0;
  overflow-x: hidden;
  padding-top: 20px;
}
/* Control the left side */
.left {
  left: 0;
  background-color: #111;
}
/* Control the right side */
.right {
  right: 0;
  margin-top: 250px;
  background-color: #8e9cad;
}
/* If you want the content centered horizontally and vertically */
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}
	
</style>
</head>     
  </head>
  <body>
    <div id="title" align="center"> <img src="logo.png" style ="margin-top: 50px"> </div>
    <div class="topnav" id="myTopnav">
      <a href="dbm_main.php"> Home </a>
      <a href="dbm_searchbooks.php" class="active"> Search Books </a>
      <a href="dbm_addbook.php"> Add Books </a>
      <a href="dbm_addLibrary.php" > My Library </a>
      </a>
    </div>
        <form autocomplete="off" action = "" method = "post">

        </div>
              <body>
    	<h2>The form</h2>
		    <form>
			<input type="text" name="name" id="input" list="huge_list">Name
			<datalist id="huge_list">
			</datalist>
			<br/>
			<input type="submit">
		    </form>
		</body>
          </form>
<script>
window.addEventListener("load", function(){

    // Add a keyup event listener to our input element
    var name_input = document.getElementById('input');
    name_input.addEventListener("keyup", function(event){hinter(event)});

    // create one global XHR object 
    // so we can abort old requests when a new one is make
    window.hinterXHR = new XMLHttpRequest();
});

// Autocomplete for form
function hinter(event) {

    // retireve the input element
    var input = event.target;

    // retrieve the datalist element
    var huge_list = document.getElementById('huge_list');

    // minimum number of characters before we start to generate suggestions
    var min_characters = 0;

    if (input.value.length < min_characters ) { 
        return;
    } else { 

        // abort any pending requests
        window.hinterXHR.abort();

        window.hinterXHR.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                // We're expecting a json response so we convert it to an object
                var response = JSON.parse( this.responseText ); 

                // clear any previously loaded options in the datalist
                huge_list.innerHTML = "";

                response.forEach(function(item) {
                    // Create a new <option> element.
                    var option = document.createElement('option');
                    option.value = item;

                    // attach the option to the datalist element
                    huge_list.appendChild(option);
                });
            }
        };

        window.hinterXHR.open("GET", "/query.php?query=" + input.value, true);
        window.hinterXHR.send()
    }
}
</script>
</html>



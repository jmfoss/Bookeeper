<!-- Joseph Santucci, Joshua FOss
     Database Management
     28 October 2019 -->

<!-- Main page -->
<?php
// Initialize the session
session_start();
require_once "config.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: dbm_login.php");
    exit;
}
if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql = "SELECT title FROM books WHERE title LIKE ?";
    $stmt = sqlsrv_query($conn, $sql, array($query));
	$array = array();
    while ($row = sqlsrv_fetch_array($stmt)) {
        $array[] = array (
            'label' => $row['title'],
            'value' => $row['title'],
        );
    }
    //RETURN JSON ARRAY
    print_r($array);
}
$title = $list = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
     if(empty(trim($_POST["title"])))
     {
      $title_err = "Please enter a title.";
     } 
     else
     {
      $title = trim($_POST["title"]);
     }
     $list = trim($_POST["list"]);
     if (empty($title_err))
     {
	  $params = array(
                          array($_SESSION["userID"], SQLSRV_PARAM_IN),
                          array($title, SQLSRV_PARAM_IN),
                          array($list, SQLSRV_PARAM_IN)
                         );
          $sql = "EXEC addToList @userID = ?, @title = ?, @list = ?";
          $stmt = sqlsrv_query($conn, $sql, $params);
          if($stmt == false)
          {
               echo "This book is already in the your list.";
          }
	  else
	  {
		echo "$title was added to $list";
	  }
     }
}



?>

<!DOCTYPE html>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script  type="text/javascript" src="/examples/js/typeahead/0.11.1/typeahead.bundle.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
	    // Sonstructs the suggestion engine
	    var titles = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.whitespace,
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		// The url points to a json file that contains an array of country names
		prefetch: '/examples/data/countries.json'
	    });

	    // Initializing the typeahead with remote dataset
	    $('.typeahead').typeahead(null, {
		name: 'title',
		source: titles,
		limit: 10 /* Specify maximum number of suggestions to be displayed */
	    });
	});  
	</script>
	<style type="text/css">
	.bs-example {
		font-family: sans-serif;
		position: relative;
		margin: 100px;
	}
	.typeahead, .tt-query, .tt-hint {
		border: 2px solid #CCCCCC;
		border-radius: 8px;
		font-size: 22px; /* Set input font size */
		height: 30px;
		line-height: 30px;
		outline: medium none;
		padding: 8px 12px;
		width: 396px;
	}
	.typeahead {
		background-color: #FFFFFF;
	}
	.typeahead:focus {
		border: 2px solid #0097CF;
	}
	.tt-query {
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
	}
	.tt-hint {
		color: #999999;
	}
	.tt-menu {
		background-color: #FFFFFF;
		border: 1px solid rgba(0, 0, 0, 0.2);
		border-radius: 8px;
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		margin-top: 12px;
		padding: 8px 0;
		width: 422px;
	}
	.tt-suggestion {
		font-size: 22px;  /* Set suggestion dropdown font size */
		padding: 3px 20px;
	}
	.tt-suggestion:hover {
		cursor: pointer;
		background-color: #0097CF;
		color: #FFFFFF;
	}
	.tt-suggestion p {
		margin: 0;
	}
</style>
  </head>
  <body>
    <div id="title" align="center"> <img src="logo.png" style ="margin-top: 50px"> </div>
    <div class="topnav" id="myTopnav">
      <a href="dbm_main.php"> Home </a>
      <a href="dbm_searchbooks.html"> Search Books </a>
      <a href="dbm_addbooks.html"> Add Books </a>
      <a href="dbm_library.html" class="active"> My Library </a>
        <i class="fa fa-bars"> </i>
      </a>
<script>
$(document).ready(function(){
    // Sonstructs the suggestion engine
    var titles = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        // The url points to a json file that contains an array of country names
        prefetch: 'dbm_addLibrary.php?query=%QUERY'
    });
    
    // Initializing the typeahead with remote dataset without highlighting
    $('.typeahead').typeahead(null, {
        name: 'title',
        source: titles,
        limit: 10 /* Specify max number of suggestions to be displayed */
    });
});
</script>
    </div>
        <form action = "" method = "post">

        </div>
              <div class = "wrapper" id="questions">
                <table>
                    <tr>
 	
            			<select name="list" style = "margin:20px; padding:10px">
                			<option value="read"> Read </option>
                			<option value="wanttoread"> Want to Read </option>
                			<option value="currentlyreading"> Currently Reading </option>
				</select>
                        <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
			  <td> <label style = "margin:10px; padding:10px"> Title </label> </td>
                          <td> <input id="ip2" type="text" class="typeahead tt-query" autocomplete="off" spellcheck="false" name="title" value="<?php echo $title; ?>" style = "margin:10px; padding:2px"> </td>
			  <span class="help-block"><?php echo $title_err; ?></span>
		        </div>  
                </table>
        	</div>
          <input type = "reset"  value = "Reset Form" style = "margin:20px;margin-top:10px"/>
	      <input type = "submit"  value = "Submit" style = "margin:20px;margin-top:10px"/>
	      <span class="help-block"><?php echo $msg; ?></span>
      </form>

    
  </body>

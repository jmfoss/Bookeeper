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


$array = array();
$query = $_REQUEST['query'];
$sql = "SELECT title FROM books WHERE title LIKE '{$query}%'";
$stmt = sqlsrv_query($conn, $sql);
if(!$stmt)
{
    print_r(sqlsrv_errors());
}
while ($row = sqlsrv_fetch_array($stmt)) 
{
	$array[] = $row['title'];
}
sqlsrv_free_stmt( $stmt);
$title = $list = $msg = $displaylist = $move_msg = "";	
if (isset($_POST['move']))
{
	if(empty(trim($_POST["titlemove"])))
	     {
	      $move_msg = "Please enter a title.";
	     } 
	     else
	     {
	      $title = trim($_POST["titlemove"]);
	     }
     	$list = trim($_POST["listmove"]);
	$sqlmove = "EXEC moveBook @userID = ?, @title = ?, @list = ?";
	$paramsmove = array(
			  array($_SESSION["userID"], SQLSRV_PARAM_IN),
			  array($title, SQLSRV_PARAM_IN),
			  array($list, SQLSRV_PARAM_IN)
			 );
	$stmtMove = sqlsrv_query($conn, $sqlmove, $paramsmove);
	if (!$stmtMove)
	{
			echo sqlsrv_errors();
	}
	else
	{
		$move_msg = "$title has been moved.";
	}
	
}
else if (isset($_POST['add']))
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
               $msg = "This book is already in the your list.";
          }
	  else
	  {
		$msg = "$title was added to $list";
	  }
	  sqlsrv_free_stmt( $stmt);
     }
}
else if (isset($_POST['displayList'])) 
{
	$displaylist = trim($_POST["display"]);
	$sqlbook = "EXEC displayList @userID = ?, @list = ?";
	$paramsbook = array(
			array($_SESSION["userID"], SQLSRV_PARAM_IN),
                        array($displaylist, SQLSRV_PARAM_IN)	
			);
	$bookList = sqlsrv_query($conn, $sqlbook, $paramsbook);
	if(!$bookList)
	{
	    print_r(sqlsrv_errors());
	}
}
?>

<!DOCTYPE html>

<html>
  <head>
    <title>Bookeeper</title>
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
<body>


</body>
  </head>
  <body>
    <div id="title" align="center"> <img src="logo.png" style ="margin-top: 50px"> </div>
    <div class="topnav" id="myTopnav">
      <a href="dbm_main.php"> Home </a>
      <a href="dbm_searchbooks.php"> Search Books </a>
      <a href="dbm_addbook.php"> Add Books </a>
      <a href="dbm_addLibrary.php" class="active"> My Library </a>
      </a>
    </div>
        <form autocomplete="off" action = "" method = "post">

        </div>
              <div class = "autocomplete" id="questions">
		<h1 style = "margin-left: 25px"> Add to List </h1>
                <table>
                    <tr>
 	
			<select name="list" style = "margin:20px; padding:10px">
				<option value="read"> Read </option>
				<option value="wanttoread"> Want to Read </option>
				<option value="currentlyreading"> Currently Reading </option>
			</select>
			  <div class="autocomplete" style="width:300px;">
			    <input id="myInput" type="text" name="title" placeholder="title">
			  </div>
			</form>

                </table>
        	</div>
          <input type = "reset"  value = "Reset Form" style = "margin:20px;margin-top:10px"/>
	      <input type = "submit"  value = "Submit" name ="add" style = "margin:20px;margin-top:10px"/>
	      <span class="help-block"><?php echo $msg; ?></span>
	      <span class="help-block"><?php echo $title_err; ?></span>
      </form>
        <form autocomplete="off" action = "" method = "post">

        </div>
              <div class = "autocomplete" id="questions">
		<h1 style = "margin-left: 25px"> Move book</h1>
                <table>
                    <tr>
			 <select name="listmove" style = "margin:20px; padding:10px">
				<option value="read"> Read </option>
				<option value="wanttoread"> Want to Read </option>
				<option value="currentlyreading"> Currently Reading </option>
			</select>
 			<div class="autocomplete" style="width:300px;">
			 <input id="moveInput" type="text" name="titlemove" placeholder="title">
			 </div>
			</form>

                </table>
        	</div>
          <input type = "reset"  value = "Reset Form" style = "margin:20px;margin-top:10px"/>
	      <input type = "submit"  value = "Submit" name = "move" style = "margin:20px;margin-top:10px"/>
	      <span class="help-block"><?php echo $move_msg; ?></span>
      </form>
   	

        </div>

		<head>
			<title>Selected List</title>
		</head>
		<body>
		<div>
			<h1 style = "margin-left: 25px"> View Lists </h1>
                	<table>
 		        	<form  action = "" method = "post">
					<select name="display" style = "margin:20px; padding:10px">
						<option <?php if ($displaylist == 'read' ) echo 'selected' ; ?> value="read"> Read </option>
						<option <?php if ($displaylist == 'wanttoread' ) echo 'selected' ; ?> value="wanttoread"> Want to Read </option>
						<option <?php if ($displaylist == 'currentlyreading' ) echo 'selected' ; ?> value="currentlyreading"> Currently Reading </option>
					</select>
					<input type="submit" name="displayList" value="Display" />
				</form>
			</table>
			<hr>
			<table style = "margin-left: 20px; margin-bottom: 100px">
			<?php
			if ($displaylist == 'read') echo " <th> Read </th> ";
			if ($displaylist == 'wanttoread') echo " <th> Want to Read </th>";
			if ($displaylist == 'currentlyreading') echo " <th> Currently Reading </th> ";
				
			while ($row = sqlsrv_fetch_array($bookList)) 
			{
			    echo "<tr>";
			    echo "<td>" . $row['title'] ."</td>";
			    echo "</tr>";
			}
			?>
			</table>
			</body>
        	</div>
      </form>
<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}
var titles = <?php echo json_encode($array);?>;
autocomplete(document.getElementById("myInput"), titles);
autocomplete(document.getElementById("moveInput"), titles);
</script>
  </body>
</html>

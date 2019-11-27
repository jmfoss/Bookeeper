<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: dbm_main.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Check if username is empty
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter your username.";
    } 
    else
    {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter your password.";
    } 
    else
    {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err))
    {
        // Prepare a select statement
        $sql = "SELECT userID, username, password FROM users WHERE username = ?";
        $stmt = sqlsrv_query($conn, $sql, array($username));
        if($stmt != false)
        {              
            $row = sqlsrv_fetch_array($stmt);
            // Check if username exists, if yes then verify password
            if(!empty($row))
            {                    
                
                $hash = password_hash($password, PASSWORD_DEFAULT);
                echo $hash;
                echo "\n";
                if (password_verify($password, $hash))
                {
                    echo "verified\n";
                }
                {
                    echo $row["password"];
                    echo "\n";
                }
                if(password_verify($password, $row["password"]))
                {
                    // Password is correct, so start a new session
                    session_start();

                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["userID"] = $row["userID"];
                    $_SESSION["username"] = $row["username"];                            

                    // Redirect user to welcome page
                    header("location: dbm_main.php");
                }
                else
                {
                    $password_err = "The password you entered was not valid.";
                }
            } 
            else
            {
                // Display an error message if username doesn't exist
                $username_err = "No account found with that username.";
            }
        } 
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }

    }

}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        
        
        #test {
            animation: fadein 3s;
            -moz-animation: fadein 3s; /* Firefox */
            -webkit-animation: fadein 3s; /* Safari and Chrome */
            -o-animation: fadein 3s; /* Opera */
        }
        @keyframes fadein {
            from {
               opacity:0;
            }
            to {
               opacity:1;
            }
         }
        
        @-moz-keyframes fadein { /* Firefox */
            from {
                opacity:0;
            }
            to {
                opacity:1;
            }
         }
         @-webkit-keyframes fadein { /* Safari and Chrome */
            from {
                opacity:0;
            }
            to {
                 opacity:1;
            }
         }
         
        @-o-keyframes fadein { /* Opera */
            from {
                opacity:0;
            }
            to {
              opacity: 1;
            }
        }    
    </style>
</head>
<body>
    <div id = "test" align="center"> <img src="logo.png" style ="margin-top: 50px"> </div>
    <div class="wrapper" style = "margin: auto; width: 40%; padding: 10px">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="dbm_signup.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>

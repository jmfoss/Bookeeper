<?php
session_start();
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter a username.";
    } 
    else
    {         
       $exists = 0; 
       $params = array(   
                        array(&$exists, SQLSRV_PARAM_OUT), 
                        array(trim($_POST["username"]), SQLSRV_PARAM_IN),  
                        ); 
        $sql = "EXEC ?=CheckUsername @username = ?";
        $stmt = sqlsrv_query($conn, $sql, $params);
        if(!$stmt)
        {
            $username_err = "Oops! Something went wrong.";
            die( print_r( sqlsrv_errors(), true));
        }    
        elseif($exists == 1)
        {
            $username_err = "This username is already taken.";
        } 
        else
        {
            $username = trim($_POST["username"]); 
        }
        sqlsrv_free_stmt( $stmt);
    }
    
    $strength = "";
    $params = array(   
                    array(trim($_POST["password"]), SQLSRV_PARAM_IN),
                    array(&$strength, SQLSRV_PARAM_OUT),
                    );
    $sql = "EXEC checkPassword @password = ?, @OutString = ?";
    $stmt = sqlsrv_query($conn, $sql, $params);
    // Validate password
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter a password.";     
    } 
    elseif($strength == "WEAK")
    {
        $password_err = "Your password is too weak.";
    } 
    elseif($strength == "SPACE")
    {
        $password_err = "Your password cannot contain a space.";
    }
    else
    {
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Please confirm password.";     
    } 
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password))
        {
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
    {
        $params = array(   
                        array($username, SQLSRV_PARAM_IN),
                        array(password_hash($password, PASSWORD_DEFAULT), SQLSRV_PARAM_IN),
                        );
        $sql = "EXEC addUser @username = ?, @password = ?";
        $stmt = sqlsrv_query($conn, $sql, $params);
        if($stmt != False)
        {
            // Redirect to login page
            header("location: dbm_main.php");
        }
        else
        {
            echo "Something went wrong. Please try again later.";
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div id="title" align="center"> <img src="logo.png" style ="margin-top: 40px"> </div>
 
    <div class="wrapper" style = "margin: auto; width: 40%; padding: 10px">
      <h2>Sign Up</h2>
        <br>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="dbm_login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>

<!-- Joseph Santucci, Joshua FOss
     Database Management
     28 October 2019 -->

<!-- Main page -->

<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="title" align="center"> <img src="logo.png" style ="margin-top: 50px; margin-bottom: 100px"> </div>
        
        <form action = "signup.php" method = "post">
            <table align = "center" style = "margin-bottom: 40px; border: 1px " >
                <tr>
                    <td> New? Sign up!</td>
                </tr>
                <tr>
                    <td> <label style = "margin:10px; padding:10px"> Username: </label> <input id="ip2" type="text" name="username" style = "margin:10px; padding:2px"> </td>
                    <td> <label style = "margin:10px; padding:10px"> Password: </label> <input id="ip2" type="text" name="password" style = "margin:10px; padding:2px"> </td>
                    <td> <input type = "submit"  value = "Sign Up" style = "margin:20px;margin-top:10px"/> </td>
                </tr>
            </table>
        </form>
        <hr class ="striped-border">
        <br>
        <form action = "signup.php" method = "post">
            <table align = "center">
                <tr>
                    <td> Already have an account? Log In!</td>
                </tr>
                <tr>
                    <td> <label style = "margin:10px; padding:10px"> Username: </label> <input id="ip2" type="text" name="username" style = "margin:10px; padding:2px"> </td>
                    <td> <label style = "margin:10px; padding:10px"> Password: </label> <input id="ip2" type="text" name="password" style = "margin:10px; padding:2px"> </td>
                    <td> <input type = "submit"  value = "Log In" style = "margin:20px;margin-top:10px"/> </td>
                </tr>
            </table>
        </form>
    </body>
</html>
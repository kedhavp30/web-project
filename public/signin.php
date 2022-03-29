<?php 
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
            
        switch($_GET["referer"]) {
            case "checkout":
                $_SESSION["redirect"] = "checkout";
                break;
            default:
                $_SESSION["redirect"] = "index";                
                break;
        }       
    }

    if (isset($_SESSION["username"])) {
        header("Location: {$_SESSION["redirect"]}.php");
        die();
    }    

    $usernameErr = $passwordErr  = "";
    $username = $userpassword  = "";

    // Form submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $usernameErr = "Username is required.";
        } else {
            $username = $_POST["username"];  
        }
        if (empty($_POST["password"])) {
            $userpasswordErr = "Password is required.";
        } else {
            $userpassword = $_POST["password"];
        }

        // Form valid
        if ($usernameErr == "" && $passwordErr == ""){

            require_once "includes/db_connect.php";
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sQuery = ("SELECT * FROM account WHERE username = {$conn->quote($username)};");

            $result = $conn->query($sQuery);

            $userResults = $result->fetch(PDO::FETCH_ASSOC);
            if ($userResults['username']) // user exists
            {
                $hashedpassword = $userResults['password'];
                if(password_verify($userpassword, $hashedpassword))
                {
                    $_SESSION['username'] = $username;
                    echo $_SESSION['username'];
                    header("Location: {$_SESSION["redirect"]}.php?referer=signin");
                    die();
                } else {
                    echo "Incorrect password";
                }
            } else {
                echo "Incorrect username";
            }
             
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothing : Create Account</title>

    <link rel = "stylesheet" href="css/signup.css">
</head>
<body>
    <div class="alert-box">
        <img src = "img/error.png" class="alert-img" alt="">
        <p class = "alert-msg">Error Message</p>

   </div>

    <img src = "img/loader.gif" class="loader" alt="">

    <div class="container">
        <a href="index.html"><img src="img/logo.jpeg" class="logo" alt=""></a>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type="text" autocomplete ="off" id ="username" name="username" placeholder ="username">
            <input type="password" autocomplete ="off" id ="password" name="password" placeholder ="password">
            <input type="submit" class ="submit-btn" value="Sign in"></input>
        </form>

            <p>Don't have an account? Register<a href="signup.php?referer=<?php echo $_SESSION["redirect"] ?>" class="link"> here</a></p>
     </div>

</body>
</html>
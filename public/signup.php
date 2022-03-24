<?php 
    session_start();

    if (isset($_SESSION["username"])) {
        echo "Already logged in. Redirecting to home page.";
        header("Location: index.html");
        die();
    }

    $usernameErr = $passwordErr = $emailErr = "";
    $username = $userpassword = $useremail = "";

    // Form submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $usernameErr = "Username is required.";
        } else {
            $username = $_POST["username"];  
        }
        if (empty($_POST["useremail"])) {
            $useremailErr = "Email is required.";
        } else {
            $useremail = $_POST["useremail"];            
        }
        if (empty($_POST["password"])) {
            $userpasswordErr = "Password is required.";
        } else {
            $userpassword = $_POST["password"];
        }

        // Form valid
        if ($usernameErr == "" && $passwordErr == "" && $emailErr == ""){
            $hashedpassword = password_hash($userpassword, PASSWORD_DEFAULT);
            require_once "includes/db_connect.php";

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $insert = "INSERT INTO account (username, password, email) VALUES ({$conn->quote($username)}, {$conn->quote($hashedpassword)}, {$conn->quote($useremail)})";
            
            $result = $conn->exec($insert);

            if ($result){
                echo "Account has been successfully created.";
                $_SESSION["username"] = $username;
                header("Location: index.html");
                die();
            } else{
                echo "Account cannot be created.";
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

        <img src="img/loader.gif" class="loader" alt="">

        <div class="container">
            <a href="index.html"><img src="img/logo.jpeg" class="logo" alt=""></a>

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <input type ="text" autocomplete ="off" id="username" name="username" placeholder ="username">
                <input type ="email" autocomplete ="off" id="email" name="useremail" placeholder ="email">
                <input type ="password" autocomplete ="off" id="password" name="password" placeholder ="password">
                
                <input type ="checkbox" checked class="checkbox" id ="terms-and-cond">
                <label for="terms-and-cond">agree to our <a href="">terms and conditions</a></label> 
                <br>
                <input type ="checkbox" class="checkbox" id ="notification">
                <label for="notification">receive upcoming offers and events mails</label> 
                <input type="submit" class ="submit-btn" value="Create Account"></input>
            </form>
            
            <p>Already have an account? Log in<a href="signin.php" class="link"> here</a></p>
        </div>

    </body>
</html>
<?php

session_start();

// define variables and set to empty string values

$usernameErr = $passwordErr = "";
$username = $userpassword =  "";

if ($_SERVER["REQUEST METHOD"] == "POST"){
    if (empty($_POST["txt_username"])) {
        $usernameErr = "Username is required";

    } else {
        $username = $_POST["txt_username"];
    }
    if (empty($_POST["txt_password"])){
        $passwordErr = "Password is required";
   
    } else {
        $userpassword = $_POST["txt_password"];
    }
}

if ($usernameErr == "" && $passwordErr = ""){
    require_once "includes/db_connect.php";
  	$sQuery = "SELECT * FROM account WHERE username = '$username' AND account_type = 'admin' ";
  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $Result = $conn->query($sQuery) ;
    $userResults = $Result->fetch(PDO::FETCH_ASSOC);

    if($userResults['username']){
        if(password_verify($userpassword,$hashed_password)){
            $_SESSION['username'] = $username;
    		$_SESSION['admin'] = true;

            header("Location: home.html? referer=login");
        }
        else {
            echo "Wrong username. Please enter correct username";
        }
    } else{
        echo "Wrong password. Please enter correct password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel = "stylesheet" href="css/login.css">
    <?php require_once "includes/metatags.php"?>

</head>
<body>
    <div class="alert-box">
        <img src = "../public/img/error.png" class="alert-img" alt="">
        <p class = "alert-msg">Error Message</p>

   </div>

    <img src = "../public/img/loader.gif" class="loader" alt="">

    <div class="container">
        <a href="index.html"><img src="../public/img/logo.jpeg" class="logo" alt=""></a>
        <div>
          <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type ="text" autocomplete ="off" id ="username" name="txt_username" placeholder ="username">
            <input type ="password" autocomplete ="off" id ="password" name="txt_password" placeholder ="password">
            <button class ="submit-btn">Login</button>
          </form>
        </div>
     </div>

</body>
</html>
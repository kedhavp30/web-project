<?php
  session_start();
  if (!isset($_SESSION["username"])) {
    header("Location: signin.php?referer=aboutus");
    die();
  }
  $username=	$_SESSION['username'] ;
 
    // define variables and set to empty string values

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

      $usernameErr = $emailErr = $commentErr = "";
      $username = $email = $comment =  "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
          $nameErr = "Username is required";
        } else {
          $name = test_input($_POST["username"]);
        }
        if (empty($_POST["email"])) {
          $nameErr = "Email is required";
        } else {
          $name = test_input($_POST["email"]);
        }
        if (empty($_POST["comment"])) {
          $nameErr = "Message is required";
        } else {
          $name = test_input($_POST["comment"]);
        }

        if ($usernameErr="" && $emailErr="" && $messageErr=""){
          require_once "includes/db_connect.php";
          $sInsert = "INSERT INTO Feedback (username,postedOn,email,comment)
          VALUES (".$conn->quote($username).",".$conn->quote($email).",".$conn->quote($comment).",".$conn->quote($postedOn).")";
          echo $sInsert;
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $addResult = $conn->exec($sInsert) ;
          if($addResult )
          {	
              $Msg = "Record Saved!";
              //echo $Msg;
          }else{
              $Msg = "ERROR: Record could not be Saved!";
          //echo $Msg;
        }
    }//end else
   }	


    $sQuery = "SELECT * FROM Feedback WHERE account.username= " . $conn->quote($_SESSION['username']); 
    #echo $sQuery;
    $Result = $conn->query($sQuery) ;
    $numrows = $Result->rowCount();
    echo $numrows;
    if ($numrows ==0)
    {
   	 echo "You have not made a comment yet.";
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/aboutus.css">
</head>
<body>

  <nav class="mynavbar"></nav>


  <div class="main-content">
    <div class="about-us">
      <img src="img/aboutus.png" alt="about us">

      <div class="about-us-desc">
        <h2>About STYLISHWEAR</h2>
        <br>
        <p>Based In | Port Louis, Mauritius</p>
        <br>
        <p> Sustainable Practices | Sustainable & organic materials, eco-friendly & ethical production, plastic-free & 
          recyclable packaging, recycling & donation campaign program</p>
        <br>
        <p>Product Range | Adult apparel, Shoes, Shirts, Tees, Trousers, Sportswear, Jeans, Sweatshirts/Hoodies, Joggers
           and Dresses & Skirts</p>
        <br>
        <p>STYLISHWEAR, a newly launched online clothing website, knows the fashion industry can be a dirty place, 
        thereby supporting eco-friendly standards. The brand wants the customers to look and feel as clean as 
        possible with its high-quality apparel for both men and women including hoodies & sweatshirts, dresses, 
        trousers and the comfiest tees among others. The clothes are made from organic and sustainably grown cotton, 
        biodegradable modal and alpaca fibre and they are all crafted from non-toxic dyes. So, the categories of 
        clothes are A+ quality, hence, our customers may not necessarily wash their clothes after one wear.</p>
      </div>
    </div>

    <div class="contact-us">
      <h1 >Get in touch</h1>
      <p class="wlc-message">We are here to help and answer any query you might have.</p>
      <p class="wlc-message"> We look forward to hearing from you.</p>
   

     <!------------------------------ Contact-Us Form------------------------------>
    <div class="contact-us-form">
      <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" >
          <legend>Personal Information</legend>
          <label>Username<span> * </span></label>
          <input type ="text" value="" name= "username" title="Username should be alpha-numeric" required  style="margin-top:5px" />
          
          <br/><br/>
          <label>Email<span> * </span></label> 
          <input type ="text" value="" name= "email" title="email should contains the @ and . sign" required />
          <br/><br/><br/>
          <label>Message<span> * </span></label><br/>
          <textarea  rows="10" cols="60" name="comment" title="should leave a comment" required></textarea><br/><br/>
          <br/>	
          <input type ="submit" value="Send Message" >
      </form>
    </div>
 </div>
  

  <footer></footer>

  <script src="js/nav.js"></script>
  <script src="js/footer.js"></script>
  
</body>
</html>
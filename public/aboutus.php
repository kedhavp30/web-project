<?php
  session_start();
  if (!isset($_SESSION["username"])) {
    header("Location: signin.php?referer=aboutus");
    die();
  }

  $commentErr = "";
  $username = $comment =  "";

  $username=	$_SESSION['username'];
 
  function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["comment"])) {
      $commentErr = "Message is required";
    } else {
      $comment = test_input($_POST["comment"]);
    }

    if ($commentErr == ""){
      require_once "includes/db_connect.php";
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sInsert = "INSERT INTO feedback (username, postedOn, comment)
      VALUES ({$conn->quote($username)}, {$conn->quote(date("Y-m-d"))}, {$conn->quote($comment)});";

      $addResult = $conn->exec($sInsert) ;  
      if($addResult) {	
        $Msg = "Record Saved!";
      } else {
        $Msg = "ERROR: Record could not be Saved!";
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
      <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ;?>" >
          <label>Message<span> * <?php echo $commentErr; ?></span></label><br/>
          <textarea  rows="10" cols="60" name="comment" title="should leave a comment" required><?php echo $comment; ?></textarea><br/><br/>
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
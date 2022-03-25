<?php
session_start();

if(!isset($_SESSION['username']))
{
  header("Location: viewproduct.html referer=review");
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Review</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/review.css">
</head>
<body>

    <nav class="mynavbar"></nav>

    <?php  
  
    $usernameErr  = $genderErr = $starratingErr =  $commentErr = "";
    $username  = $gender = $starrating = $comment  = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["txt_name"])) {
          $nameErr = "Username is required";
      } else {
          $name = test_input($_POST["txt_name"]);
      }
      if (empty($_POST["txt_gender"])) {
        $genderErr = "Gender is required";
      } else {
        $gender = test_input($_POST["txt_gender"]);
      }
      if (empty($_POST["rate"])) {
        $genderErr = "Rate is required";
      } else {
        $gender = test_input($_POST["rate"]);
      }
      if (empty($_POST["txt_comment"])) {
        $genderErr = "Comment is required";
      } else {
        $gender = test_input($_POST["txt_comment"]);
      }

      if($usernameErr == "" && $clean_ratingErr == "" && $genderErr == "" && $commentErr == "" ){
        require_once "includes/db_connect.php";

        $sInsert = "INSERT INTO review(productId, postedOn, reviewDesc, flag, rating, customerid)
        VALUES ".$conn->quote($username) .",".$conn->quote($gender) .",".$conn->quote($rating).
        ",".$conn->quote($comment) .",'$product_id', '$postedOn', '$reviewDesc', '$flag', '$customerid' .")";

        //Set PDO to exception Mode
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $addResult = $conn->exec($sInsert);
        if($addResult)
        {
          echo "Record Saved";
        }
        else{
          echo "Record has not been saved.";
        }
    }
  ?>

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }  


    <div class="review-form">
        <h3 style = "color: black; background-color: beige;">Please review your product</h3>

        <?php
        require_once "includes/db_connect.php";
        $sQuery = "SELECT product.productId, review.postedOn, review.reviewDesc, review.flag, review.rating, customer.customerid
                   FROM review INNER JOIN product.productid = review.productid
                   INNER JOIN product ON product.productid = review.productid
                   INNER JOIN product ON customer.customerid = customer.productid
                   WHERE account.username = " .$conn->quote($_SESSION['username']);

        $Result = $conn->query($sQuery);
        $numrows = $Result->rowCount();
        if ($numrows ==0)
      {
   	     echo "You have not make a review";
      }
      ?>


       <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>"  >
        <fieldset class="personal-details">
          <legend>Personal Details:</legend>
          Username :
          <input type="text" value="" name="txt_name" title="Name should consist of one or more words, starting with an uppercase letter followed by lowercase characters, and separated by spaces" maxlength="16" size="50" pattern="[A-Z][a-z]+( [A-Z][a-z]+)*$" required /><br>
          Gender:
          <input type="radio" name="txt_gender" value="male" required/> Male
          <input type="radio" name="txt_gender" value="female" /> Female
        </fieldset>
        
        <fieldset class="product-details">
          <legend>Product Details:</legend>
          <h5>Please give us feedback on your appreciation of the product<h5>
          <div class="star-rating">
            <input type="radio" id="star5" name="rate" value="5" />
            <label for="star5" title="text"></label>
            <input type="radio" id="star4" name="rate" value="4" />
            <label for="star4" title="text"></label>
            <input type="radio" id="star3" name="rate" value="3" />
            <label for="star3" title="text"></label>
            <input type="radio" id="star2" name="rate" value="2" />
            <label for="star2" title="text"></label>
            <input type="radio" id="star1" name="rate" value="1" />
            <label for="star1" title="text"></label>
          </div>

          Comment: </br>
          <textarea  rows="10" cols="60" name="txt_comment"></textarea><br/><br/>
          
          <input type ="submit" style="color:white; background: #00ACEE;  width: 20%; height:30px; text-align: center; " value="  Submit Review" >
          
          
        </fieldset> 
        </form>
      
         
        </p>
        </div>


    <footer></footer>

    <script src="js/nav.js"></script>
    <script src="js/footer.js"></script>
    <script src="js/home.js"></script>
    <script src="js/product.js"></script>
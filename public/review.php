<?php
  session_start();

  if (!isset($_SESSION["username"])) {
    header("Location: signin.php?referer=review");
    die();
  }

  $username = $rate = $comment = "";
  $rate = $commentErr = "";

  $username = $_SESSION["username"];

  require_once "includes/db_connect.php";
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // From viewproduct page
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $_SESSION["productid"] = $_GET["productid"];
    $_SESSION["size"] = $_GET["size"];
    $_SESSION["colour"] = $_GET["colour"];

    $productQuery = "SELECT * FROM orders 
                    INNER JOIN orderitems ON orders.orderid = orderitems.orderid
                    WHERE orders.username = {$conn->quote($username)}
                    AND orderitems.productid = {$conn->quote($_SESSION["productid"])}
                    AND orderitems.size = {$conn->quote($_SESSION["size"])}
                    AND orderitems.colour = {$conn->quote($_SESSION["colour"])}
                    AND orderitems.reviewed = 0;";

    $productQueryResult = $conn->query($productQuery);
    // User didn't buy that product or already reviewed
    if ( !$productQueryResult->fetchColumn() ) {
      header("Location: viewproduct.html?productid={$_SESSION["productid"]}&size={$_SESSION["size"]}&colour={$_SESSION["colour"]}");
      die();
    }
  }

  // Form submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["comment"])) {
      $commentErr = "Required comment";
    } else {
      $comment = $_POST["comment"];
    }    
    if (empty($_POST["rate"])) {
      $rateErr = "Required rating";
    } else {
      $rate = $_POST["rate"];
    }
    
    
    // Form valid
    if ($rateErr == "" && $commentErr == "") {

      $customerid = $conn->query("SELECT customerid FROM customer WHERE username = {$conn->quote($username)}")
                    ->fetch(PDO::FETCH_ASSOC)["customerid"];

      $reviewQuery = "INSERT INTO review(productId, postedOn, reviewDesc, flag, rating, customerid)
                      VALUES ({$conn->quote($_SESSION["productid"])}, {$conn->quote(date("Y-m-d"))}, {$conn->quote($comment)}, 0, {$rate}, {$customerid})";

      $updateOrderItemQuery = "UPDATE orderitems
                              SET reviewed = 1
                              WHERE orderid IN (SELECT orderid
                                                FROM orders
                                                WHERE username = {$conn->quote($username)}
                                                AND orders.status = 'Delivered')
                              AND productid = {$conn->quote($_SESSION["productid"])}
                              AND size = {$conn->quote($_SESSION["size"])}
                              AND colour = {$conn->quote($_SESSION["colour"])}
                              AND reviewed = 0";

      $conn->beginTransaction();

      $reviewQueryResult = $conn->exec($reviewQuery);
      if (!$reviewQueryResult) {
        // echo "Couldn't submit review.";
        $conn->rollBack();
        die();
      } else {
        $updateOrderItemQueryResult = $conn->exec($updateOrderItemQuery);
        if (!$updateOrderItemQueryResult) {
          // echo "Review submission failed.";
          $conn->rollBack();
          die();
        }
      }

      $conn->commit();
      $conn = null;

      header("Location: viewproduct.html?productid={$_SESSION["productid"]}&size={$_SESSION["size"]}&colour={$_SESSION["colour"]}");
    }
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

    <div class="review-form">
        <h3 style = "color: black; background-color: beige;">Please review your product</h3>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <fieldset class="product-details">
            <legend>Review:</legend>
            <h5>Please give us feedback on your appreciation of the product<h5>
              <div class="star-rating">
                <input type="radio" id="star5" name="rate" value="5" <?php if ($rate == 5) echo "checked"; ?>/>
                <label for="star5" title="text"></label>
                <input type="radio" id="star4" name="rate" value="4" <?php if ($rate == 4) echo "checked"; ?>/>
                <label for="star4" title="text"></label>
                <input type="radio" id="star3" name="rate" value="3" <?php if ($rate == 3) echo "checked"; ?>/>
                <label for="star3" title="text"></label>
                <input type="radio" id="star2" name="rate" value="2" <?php if ($rate == 2) echo "checked"; ?>/>
                <label for="star2" title="text"></label>
                <input type="radio" id="star1" name="rate" value="1" <?php if ($rate == 1) echo "checked"; ?>/>
                <label for="star1" title="text"></label>
              </div>
            Comment: </br>
            <textarea  rows="10" cols="60" name="comment"><?php echo $comment; ?></textarea><br/><br/>
            <input type ="submit" style="color:white; background: #00ACEE;  width: 20%; height:30px; text-align: center;" value="Submit Review" ></input>
          </fieldset> 
        </form>
      </div>


    <footer></footer>

    <script src="js/nav.js"></script>
    <script src="js/footer.js"></script>
    <script src="js/home.js"></script>
    <script src="js/product.js"></script>

</body>
</html>
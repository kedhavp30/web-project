<?php
  session_start();

  require_once "includes/db_connect.php";
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Initialize empty array if it doesn't exist yet
  if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
  }

	// Registered users; retrieve cart items from db if not yet and cart session empty
	if (isset($_SESSION["username"]) && !$_SESSION["cart"]) {
		$cartQuery = "SELECT cart.productId, size, colour, quantity, cart.unitPrice, cart.discount, prodName, picture
									FROM cart INNER JOIN product ON cart.productId = product.productId
									WHERE username = {$conn->quote($_SESSION["username"])};";

		$cartQueryResult = $conn->query($cartQuery);
		if ($cartQueryResult->rowCount()) {

			// Session variable cart contains productId as key and product info as value
			forEach($cartQueryResult->fetchAll(PDO::FETCH_ASSOC) as $product) {
				$_SESSION["cart"]["{$product["productId"]}"] = array("size"=>"{$product["size"]}",
																															"colour"=>"{$product["colour"]}",
																															"quantity"=>"{$product["quantity"]}",
																															"unitPrice"=>"{$product["unitPrice"]}",
																															"discount"=>"{$product["discount"]}",
																															"prodName"=>"{$product["prodName"]}",
																															"picture"=>"{$product["picture"]}");
			}
		}
	}

  // GET request for productId
  if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $productId = $_GET["productid"];
    // productId info not yet retrieved from db
    if (!isset($_SESSION["{$productId}"])) {

      $productQuery = "SELECT prodName, prodDesc, unitPrice, discount, picture, categoryName
                       FROM product INNER JOIN category ON product.categoryId = category.categoryId
                       WHERE productId = {$conn->quote($_GET["productid"])}";

      $productQueryResult = $conn->query($productQuery);
      if ($productQueryResult->rowCount()) {
        $product = $productQueryResult->fetch(PDO::FETCH_ASSOC);
        
        // Session variable $productId contains productId as key and product info as value
        $_SESSION["{$productId}"] = array("size"=>"{$_GET["size"]}",
                                          "colour"=>"{$_GET["colour"]}",
                                          "unitPrice"=>"{$product["unitPrice"]}",
                                          "discount"=>"{$product["discount"]}",
                                          "prodName"=>"{$product["prodName"]}",
                                          "prodDesc"=>"{$product["prodDesc"]}",
                                          "categoryName"=>"{$product["categoryName"]}",
                                          "picture"=>"{$product["picture"]}");

        $_SESSION["{$productId}"]["discountedPrice"] = ((100 - $product["discount"]) / 100) * $product["unitPrice"];                                       
      }

      // Retrieving reviews for productId
      $_SESSION["{$productId}"]["reviews"] = $conn->query("SELECT reviewDesc, rating, firstName, lastName, username
                                                           FROM review INNER JOIN customer ON review.customerId = customer.customerId
                                                           WHERE productId = {$conn->quote($productId)};")
                                                  ->fetchAll(PDO::FETCH_ASSOC);

      $_SESSION["{$productId}"]["avgRating"] = number_format($conn->query("SELECT AVG(rating) AS avgRating
                                                                           FROM review
                                                                           WHERE productId = {$conn->quote($productId)}")
                                                                  ->fetch(PDO::FETCH_ASSOC)["avgRating"], 1);
      $_SESSION["{$productId}"]["totalReviews"] = count($_SESSION["{$productId}"]["reviews"]);                                                 
    }
  }


  // Retrieving suggestions from db if not yet
  if (!isset($_SESSION["suggestions"])) {

  }





?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&family=Roboto:wght@100&display=swap" rel="stylesheet"> 

   	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/viewproduct.css">
</head>
<body>

  <nav class="mynavbar"></nav>

  <section class="product-details">
    <div class="image-slider">
      <div class="product-images">
        <img src = "img/product image 1.png" class="active" alt="">
        <img src = "img/product image 2.png" alt="">
        <img src = "img/product image 3.png" alt="">
        <img src = "img/product image 4.png" alt="">
      </div>
    </div>
    <div class="details">
      <h2 class="product-name"><?php echo $_SESSION["{$productId}"]["prodName"]; ?></h2>
      <p class="category-short-des"><?php echo $_SESSION["{$productId}"]["categoryName"]; ?></p>
      <p class="divider"></p>
      <span class="product-rating">Rating: <?php echo $_SESSION["{$productId}"]["totalReviews"] ? "{$_SESSION["{$productId}"]["avgRating"]}/5 ({$_SESSION["{$productId}"]["totalReviews"]} review/s)" : "No reviews yet"; ?></span> <br/><br/>
      <span class="product-price" <?php if (!$_SESSION["{$productId}"]["discount"]) echo "hidden"; ?>>Rs <?php echo $_SESSION["{$productId}"]["discountedPrice"]; ?></span>
      <span class="product-actual-price" <?php if (!$_SESSION["{$productId}"]["discount"]) echo "style='text-decoration: none; margin-left: 0px;'"; ?>>
        Rs <?php echo $_SESSION["{$productId}"]["unitPrice"]; ?>
      </span>
      <span class="product-discount" <?php if (!$_SESSION["{$productId}"]["discount"]) echo "hidden"; ?>>(<?php echo $_SESSION["{$productId}"]["discount"]; ?>% off)</span>
      
      <p class="product-sub-heading">select size</p>
      <div class="sizes">
        <input type="radio" name="size" value="s" checked hidden id="s-size"> 
        <label for = "s-size" class="size-radio-btn check">s</label>
        <input type="radio" name="size" value="m" hidden id="m-size"> 
        <label for = "m-size" class="size-radio-btn">m</label>
        <input type="radio" name="size" value="l" hidden id="l-size"> 
        <label for = "l-size" class="size-radio-btn">l</label>
      </div>
      <button class="btn cart-btn">Add To Cart</button>
    </div>
  </section>

<section class="detail-des">
    <h2 class="heading">Description</h2>
    <p class="des"><?php echo $_SESSION["{$productId}"]["prodDesc"]; ?></p>

</section>
<!--reviews------------------->
<section id="reviews">
  <!--heading--->
  <div class="review-heading">
    <span>Reviews</span>
    <span id="review-link">Please review our <a href="review.php?<?php echo "productid={$productId}"; ?>">product</a></span>
  </div>
  <!--reviews-box-container------>
  <div class="review-box-container">

    <?php    
      forEach($_SESSION["{$productId}"]["reviews"] as $review) {
        // <!--BOX--------------->
        echo "<div class='review-box'>";
        // <!--top------------------------->
        echo "<div class='box-top'>";
        // <!--profile----->
        echo "<div class='profile'>";
        // <!--img---->
        echo "<div class='profile-img'>";
        echo "<img src='img/Kai.webp' />";
        echo "</div>";
        // <!--name-and-username-->
        echo "<div class='name-user'>";
        echo "<strong>{$review["firstName"]} {$review["lastName"]}</strong>";
        echo "<span>@{$review["username"]}</span>";
        echo "</div>";
        echo "</div>";
        // <!--reviews------>
        echo "<div class='reviews'>";
        echo "<i class='fa fa-star'></i>";
        echo "<i class='fa fa-star'></i>";
        echo "<i class='fa fa-star'></i>";
        echo "<i class='fa fa-star'></i>";
        echo "<i class='fa fa-star'></i>";
        echo "</div>";
        echo "</div>";
        // <!--Comments---------------------------------------->
        echo "<div class='client-comment'>";
        echo "<p>{$review["reviewDesc"]}</p>";
        echo "</div>";
        echo "</div>";
      }
    ?>
    
  </div>
</section>

    

     


<!-- cards-container-->
<section class="product">
  <h2 class="product-category">Shirts | Blouses</h2>
  <button class = "pre-btn"><img src = "img/arrow.png" alt=""></button>
  <button class = "nxt-btn"><img src = "img/arrow.png" alt=""></button>

  <div class="product-container">
    <div class = "product-card">
      <div class = "product-image">
        <span class = "discount-tag">50% off</span>
        <img src ="img/Men/Shoes/62.png" class="product-thumb" alt="">;
        <button class="card-btn">Add To Cart</button>
      </div>
      <div class = "product-info">
        <h2 class="product-name">brand</h2>
        <p class= "product-category-desc">a short line about the cloth</p>
        <span class="price">$20</span><span class="actual-price">$40</span>
      </div>
    </div>
  </div>
</section> 

<!-- cards-container-->
<section class="product">
  <h2 class="product-category">Shoes</h2>
  <button class = "pre-btn"><img src = "img/arrow.png" alt=""></button>
  <button class = "nxt-btn"><img src = "img/arrow.png" alt=""></button>

  <div class="product-container">
    <div class = "product-card">
      <div class = "product-image">
        <span class = "discount-tag">50% off</span>
        <img src ="img/Men/Shoes/62.png" class="product-thumb" alt="">;
        <button class="card-btn">Add To Cart</button>
      </div>
      <div class = "product-info">
        <h2 class="product-name">brand</h2>
        <p class= "product-category-desc">a short line about the cloth</p>
        <span class="price">$20</span><span class="actual-price">$40</span>
      </div>
    </div>
  </div>
</section> 

<footer></footer>

  <script src="js/nav.js"></script>
  <script src="js/footer.js"></script>
  <script src="js/home.js"></script>
  <script src="js/product.js"></script>


    
</body>
</html>
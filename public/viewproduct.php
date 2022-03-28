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

				if (isset($_SESSION["cart"]["{$product["productId"]}"])) {
					$_SESSION["cart"]["{$product["productId"]}"]["quantity"] += $product["quantity"];
					$_SESSION["cart"]["{$product["productId"]}"]["size_colour_qty"]["{$product["size"]}_{$product["colour"]}"] = $product["quantity"];
					continue;
				}

				$size_colour_qty = array("{$product["size"]}_{$product["colour"]}"=>"{$product["quantity"]}");
				$_SESSION["cart"]["{$product["productId"]}"] = array( "size_colour_qty"=>$size_colour_qty,
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

    $productQuery = "SELECT prodName, prodDesc, unitPrice, discount, picture, categoryName
                      FROM product INNER JOIN category ON product.categoryId = category.categoryId
                      WHERE productId = {$conn->quote($_GET["productid"])}";

    $productQueryResult = $conn->query($productQuery);
    if ($productQueryResult->rowCount()) {
      $product = $productQueryResult->fetch(PDO::FETCH_ASSOC);
      
      // Session variable $productId contains productId as key and product info as value
      $_SESSION["viewedproduct"] = array("unitPrice"=>"{$product["unitPrice"]}",
                                          "discount"=>"{$product["discount"]}",
                                          "prodName"=>"{$product["prodName"]}",
                                          "prodDesc"=>"{$product["prodDesc"]}",
                                          "categoryName"=>"{$product["categoryName"]}",
                                          "picture"=>"{$product["picture"]}");

      $_SESSION["viewedproduct"]["discountedPrice"] = ((100 - $product["discount"]) / 100) * $product["unitPrice"];                                       
    }

    // Retrieving reviews for productId
    $_SESSION["viewedproduct"]["reviews"] = $conn->query("SELECT reviewDesc, rating, firstName, lastName, username
                                                          FROM review INNER JOIN customer ON review.customerId = customer.customerId
                                                          WHERE productId = {$conn->quote($_GET["productid"])};")
                                                  ->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION["viewedproduct"]["avgRating"] = number_format($conn->query("SELECT AVG(rating) AS avgRating
                                                                          FROM review
                                                                          WHERE productId = {$conn->quote($_GET["productid"])}")
                                                                  ->fetch(PDO::FETCH_ASSOC)["avgRating"], 1);
    $_SESSION["viewedproduct"]["totalReviews"] = count($_SESSION["viewedproduct"]["reviews"]);   
    $_SESSION["viewedproduct"]["productId"] = $_GET["productid"];                                               
  }

  // POST request for Add to cart
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $size = isset($_POST["size"]) ? $_POST["size"] : "M"; // default size
    $colour = isset($_POST["colour"]) ? $_POST["colour"] : "Blue"; // default colour

    // Cart empty or product not in cart
    if (!$_SESSION["cart"] || !isset($_SESSION["cart"]["{$_POST["productId"]}"])) {
      $size_colour_qty = array("{$size}_{$colour}"=>"1");
      $_SESSION["cart"]["{$_POST["productId"]}"] = array( "size_colour_qty"=>$size_colour_qty,
                                                          "quantity"=>"1",
                                                          "unitPrice"=>"{$_POST["unitPrice"]}",
                                                          "discount"=>"{$_POST["discount"]}",
                                                          "prodName"=>"{$_POST["prodName"]}",
                                                          "picture"=>"{$_POST["picture"]}");

    } else { // product in cart
      $_SESSION["cart"]["{$_POST["productId"]}"]["quantity"]++;

      if (isset($_SESSION["cart"]["{$_POST["productId"]}"]["size_colour_qty"]["{$size}_{$colour}"])) {
        $_SESSION["cart"]["{$_POST["productId"]}"]["size_colour_qty"]["{$size}_{$colour}"]++;
      } else {
        $_SESSION["cart"]["{$_POST["productId"]}"]["size_colour_qty"]["{$size}_{$colour}"] = 1;        
      }
    }
  }


  // Suggestions
  $shirtsQuery = "SELECT productId, prodName, prodDesc, unitPrice, discount, picture
                  FROM product INNER JOIN category ON product.categoryId = category.categoryId
                  WHERE categoryName = 'Shirt';";

  // $blousesQuery = "SELECT productId, prodName, prodDesc, unitPrice, discount, picture
  //                  FROM product INNER JOIN category ON product.categoryId = category.categoryId
  //                  WHERE categoryName = 'Blouse';";    
                    
  $shoesQuery = "SELECT productId, prodName, prodDesc, unitPrice, discount, picture
                  FROM product INNER JOIN category ON product.categoryId = category.categoryId
                  WHERE categoryName = 'Shoes';";
                    
                    
  if (!isset($_SESSION["suggestions"]["shirts"])) {
    $_SESSION["suggestions"]["shirts"] = $conn->query($shirtsQuery)->fetchAll(PDO::FETCH_ASSOC);
  }

  // if (!isset($_SESSION["suggestions"]["blouses"])) {
  //   $_SESSION["suggestions"]["blouses"] = $conn->query($blousesQuery)->fetchAll(PDO::FETCH_ASSOC);
  // }

  if (!isset($_SESSION["suggestions"]["shoes"])) {
    $_SESSION["suggestions"]["shoes"] = $conn->query($shoesQuery)->fetchAll(PDO::FETCH_ASSOC);
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
    <div class="image-slider" style="background-image: url('img/<?php echo $_SESSION["viewedproduct"]["picture"]; ?>');">
    </div>
    <div class="details">
      <h2 class="product-name"><?php echo $_SESSION["viewedproduct"]["prodName"]; ?></h2>
      <p class="category-short-des"><?php echo $_SESSION["{$_SESSION["viewedproductid"]}"]["categoryName"]; ?></p>
      <p class="divider"></p>
      <span class="product-rating">Rating: <?php echo $_SESSION["viewedproduct"]["totalReviews"] ? "{$_SESSION["viewedproduct"]["avgRating"]}/5 ({$_SESSION["viewedproduct"]["totalReviews"]} review/s)" : "No reviews yet"; ?></span> <br/><br/>
      <span class="product-price" <?php if (!$_SESSION["viewedproduct"]["discount"]) echo "hidden"; ?>>Rs <?php echo $_SESSION["viewedproduct"]["discountedPrice"]; ?></span>
      <span class="product-actual-price" <?php if (!$_SESSION["viewedproduct"]["discount"]) echo "style='text-decoration: none; margin-left: 0px;'"; ?>>
        Rs <?php echo $_SESSION["viewedproduct"]["unitPrice"]; ?>
      </span>
      <span class="product-discount" <?php if (!$_SESSION["viewedproduct"]["discount"]) echo "hidden"; ?>>(<?php echo $_SESSION["viewedproduct"]["discount"]; ?>% off)</span>
      
      <form action="" method="POST">      
        <p class="product-sub-heading">select size</p>
        <div class="sizes">
          <input type="radio" name="size" value="S" checked hidden id="s-size"> 
          <label for = "s-size" class="size-radio-btn check">s</label>
          <input type="radio" name="size" value="M" hidden id="m-size"> 
          <label for = "m-size" class="size-radio-btn">m</label>
          <input type="radio" name="size" value="L" hidden id="l-size"> 
          <label for = "l-size" class="size-radio-btn">l</label>
        </div>
      
        <input type="text" hidden name="productId" value="<?php echo $_SESSION["viewedproduct"]["productId"]; ?>">
        <input type="text" hidden name="prodName" value="<?php echo $_SESSION["viewedproduct"]["prodName"]; ?>">
        <input type="text" hidden name="picture" value="<?php echo $_SESSION["viewedproduct"]["picture"]; ?>">
        <input type="text" hidden name="unitPrice" value="<?php echo $_SESSION["viewedproduct"]["unitPrice"]; ?>">
        <input type="text" hidden name="discount" value="<?php echo $_SESSION["viewedproduct"]["discount"]; ?>">
        <button class="btn cart-btn">Add To Cart</button>
      </form>
    </div>
  </section>

  <section class="detail-des">
      <h2 class="heading">Description</h2>
      <p class="des"><?php echo $_SESSION["viewedproduct"]["prodDesc"]; ?></p>
  </section>

  <!--reviews------------------->
  <section id="reviews">
    <!--heading--->
    <div class="review-heading">
      <span>Reviews</span>
      <span id="review-link">Please review our <a href="review.php?<?php echo "productid={$_SESSION["viewedproduct"]["productId"]}"; ?>">product</a></span>
    </div>
    <!--reviews-box-container------>
    <div class="review-box-container">

      <?php    
        forEach($_SESSION["viewedproduct"]["reviews"] as $review) {
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
          
              for ($star = 0, $full = $review['rating']; $star < 5; $star++, $full--) {
                if ($full > 0) {
                  echo "<i class='fa fa-star'></i>";
                  continue;
                }
                echo "<i class='fa fa-star-o'></i>";
              }

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

      <?php
        foreach($_SESSION["suggestions"]["shirts"] as $shirt) {
          $discountedPrice = 0;
          $normalPriceClass = "no-discount";

          echo "<div class='product-card'>";
            echo "<div class='product-image'>";
              if ($shirt["discount"]) {
                echo "<span class='discount-tag'>{$shirt["discount"]}% off</span>";
                $discountedPrice = number_format( ((100 - $shirt["discount"]) / 100) * $shirt["unitPrice"], 2 );
                $normalPriceClass = "actual-price";
              }
              echo "<img src='img/{$shirt["picture"]}' class='product-thumb' alt=''>";
              echo "<form action='{$_SERVER["PHP_SELF"]}' method='POST'>";
                echo "<input type='text' hidden name='productId' value='{$shirt["productId"]}'>";
                echo "<input type='text' hidden name='prodName' value='{$shirt["prodName"]}'>";
                echo "<input type='text' hidden name='picture' value='{$shirt["picture"]}'>";
                echo "<input type='text' hidden name='unitPrice' value='{$shirt["unitPrice"]}'>";
                echo "<input type='text' hidden name='discount' value='{$shirt["discount"]}'>";
                echo "<button class='card-btn'>Add To Cart</button>";
              echo "</form>";  
            echo "</div>";
            echo "<div class='product-info'>";
              echo "<h2 class='product-name'>{$shirt["prodName"]}</h2>";
              echo "<p class='product-short-des'>{$shirt["prodDesc"]}</p>";
              if ($discountedPrice) echo "<span class='price'>Rs {$discountedPrice}</span>";
              echo "<span class='{$normalPriceClass}'>{$shirt["unitPrice"]}</span>";
            echo "</div>";
          echo "</div>";
        }
      ?>

    </div>
  </section> 

  <!-- cards-container-->
  <section class="product">
    <h2 class="product-category">Shoes</h2>
    <button class = "pre-btn"><img src = "img/arrow.png" alt=""></button>
    <button class = "nxt-btn"><img src = "img/arrow.png" alt=""></button>

    <div class="product-container">

      <?php
        foreach($_SESSION["suggestions"]["shoes"] as $shoes) {
          $discountedPrice = 0;
          $normalPriceClass = "no-discount";

          echo "<div class='product-card'>";
            echo "<div class='product-image'>";
              if ($shoes["discount"]) {
                echo "<span class='discount-tag'>{$shoes["discount"]}% off</span>";
                $discountedPrice = number_format( ((100 - $shoes["discount"]) / 100) * $shoes["unitPrice"], 2 );
                $normalPriceClass = "actual-price";
              }            
              echo "<img src='img/{$shoes["picture"]}' class='product-thumb' alt=''>";
              echo "<form action='{$_SERVER["PHP_SELF"]}' method='POST'>";
                echo "<input type='text' hidden name='productId' value='{$shoes["productId"]}'>";
                echo "<input type='text' hidden name='prodName' value='{$shoes["prodName"]}'>";
                echo "<input type='text' hidden name='picture' value='{$shoes["picture"]}'>";
                echo "<input type='text' hidden name='unitPrice' value='{$shoes["unitPrice"]}'>";
                echo "<input type='text' hidden name='discount' value='{$shoes["discount"]}'>";
                echo "<button class='card-btn'>Add To Cart</button>";
              echo "</form>";             
            echo "</div>";
            echo "<div class='product-info'>";
              echo "<h2 class='product-name'>{$shoes["prodName"]}</h2>";
              echo "<p class='product-short-des'>{$shoes["prodDesc"]}</p>";
              if ($discountedPrice) echo "<span class='price'>Rs {$discountedPrice}</span>";
              echo "<span class='{$normalPriceClass}'>{$shoes["unitPrice"]}</span>";
            echo "</div>";
          echo "</div>";
        }
      ?>

    </div>
  </section> 

  <footer></footer>

  <script src="js/nav.js"></script>
  <script src="js/footer.js"></script>
  <script src="js/home.js"></script>
  <script src="js/product.js"></script>


    
</body>
</html>
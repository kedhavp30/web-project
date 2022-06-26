<?php
  session_start();

  require_once "includes/db_connect.php";
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $shirtsQuery = "SELECT productId, prodName, prodDesc, unitPrice, discount, picture
                  FROM product INNER JOIN category ON product.categoryId = category.categoryId
                  WHERE categoryName = 'Shirt';";

  $jeansQuery = "SELECT productId, prodName, prodDesc, unitPrice, discount, picture
                 FROM product INNER JOIN category ON product.categoryId = category.categoryId
                 WHERE categoryName = 'Jean';";    
                    
  $dressesQuery = "SELECT productId, prodName, prodDesc, unitPrice, discount, picture
                   FROM product INNER JOIN category ON product.categoryId = category.categoryId
                   WHERE categoryName = 'Dress';";   
                   
  $trendingQuery = "SELECT product.productId, prodName, prodDesc, product.unitPrice, product.discount, picture, COUNT(orderitems.productId)
                    FROM product INNER JOIN orderitems ON product.productId = orderitems.productId
                    GROUP BY product.productId, prodName, prodDesc, product.unitPrice, product.discount, picture
                    ORDER BY COUNT(orderitems.productId) DESC
                    LIMIT 10;";                   
                    
                    
  if (!isset($_SESSION["suggestions"]["shirts"])) {
    $_SESSION["suggestions"]["shirts"] = $conn->query($shirtsQuery)->fetchAll(PDO::FETCH_ASSOC);
  }

  if (!isset($_SESSION["suggestions"]["jeans"])) {
    $_SESSION["suggestions"]["jeans"] = $conn->query($jeansQuery)->fetchAll(PDO::FETCH_ASSOC);
  }

  if (!isset($_SESSION["suggestions"]["dresses"])) {
    $_SESSION["suggestions"]["dresses"] = $conn->query($dressesQuery)->fetchAll(PDO::FETCH_ASSOC);
  }  

  if (!isset($_SESSION["suggestions"]["trending"])) {
    $_SESSION["suggestions"]["trending"] = $conn->query($trendingQuery)->fetchAll(PDO::FETCH_ASSOC);
  }  

  include "includes/addToCart.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/home.css">
</head>
<body>
  
  <nav class="mynavbar"></nav>

  <!-- hero section -->
  <header class = "hero-section">
      <div class="content">
        <p class="heading">STYLISHWEAR</p>
        <p class="sub-heading">best fashion collection of all time</p>
      </div>

 </header>
   <!-- cards-container-->
   <section class="product">
       <h2 class="product-category">TRENDING</h2>
       <button class = "pre-btn"><img src = "img/arrow.png" alt=""></button>
       <button class = "nxt-btn"><img src = "img/arrow.png" alt=""></button>

       <div class="product-container">
        <?php
          foreach($_SESSION["suggestions"]["trending"] as $trending) {
            $discountedPrice = 0;
            $normalPriceClass = "no-discount";

            echo "<div class='product-card'>";
              echo "<div class='product-image'>";
                if ($trending["discount"]) {
                  echo "<span class='discount-tag'>{$trending["discount"]}% off</span>";
                  $discountedPrice = number_format( ((100 - $trending["discount"]) / 100) * $trending["unitPrice"], 2 );
                  $normalPriceClass = "actual-price";
                }
                echo "<a href='viewproduct.php?productid={$trending["productId"]}'><img src='img/{$trending["picture"]}' class='product-thumb' alt=''></a>";
                echo "<form action='{$_SERVER["PHP_SELF"]}' method='POST'>";
                  echo "<input type='text' hidden name='productId' value='{$trending["productId"]}'>";
                  echo "<input type='text' hidden name='prodName' value='{$trending["prodName"]}'>";
                  echo "<input type='text' hidden name='picture' value='{$trending["picture"]}'>";
                  echo "<input type='text' hidden name='unitPrice' value='{$trending["unitPrice"]}'>";
                  echo "<input type='text' hidden name='discount' value='{$trending["discount"]}'>";
                  echo "<button class='card-btn'>Add To Cart</button>";
                echo "</form>";  
              echo "</div>";
              echo "<div class='product-info'>";
                echo "<h2 class='product-name'>{$trending["prodName"]}</h2>";
                echo "<p class='product-short-desc'>{$trending["prodDesc"]}</p>";
                if ($discountedPrice) echo "<span class='price'>Rs {$discountedPrice}</span>";
                echo "<span class='{$normalPriceClass}'>{$trending["unitPrice"]}</span>";
              echo "</div>";
            echo "</div>";
          }
        ?> 
       </div>
   </section> 

   <!--collections-->
   <section class="collection-container">
       <a href="searchproduct.php?gender=Women" class="collection">
           <img src="img/women-collection.png" alt="">
           <p class="collection-title">Women<br>Apparels</p>
       </a>
       <a href="searchproduct.php?gender=Men" class="collection">
        <img src="img/men-collection.png" alt="">
        <p class="collection-title">Men<br>Apparels</p>
    </a>

   </section>

   <!-- cards-container-->
   <section class="product">
    <h2 class="product-category">SHIRTS</h2>
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
              echo "<a href='viewproduct.php?productid={$shirt["productId"]}'><img src='img/{$shirt["picture"]}' class='product-thumb' alt=''></a>";
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
              echo "<p class='product-short-desc'>{$shirt["prodDesc"]}</p>";
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
    <h2 class="product-category">JEANS</h2>
    <button class = "pre-btn"><img src = "img/arrow.png" alt=""></button>
    <button class = "nxt-btn"><img src = "img/arrow.png" alt=""></button>

    <div class="product-container">
      <?php
        foreach($_SESSION["suggestions"]["jeans"] as $jean) {
          $discountedPrice = 0;
          $normalPriceClass = "no-discount";

          echo "<div class='product-card'>";
            echo "<div class='product-image'>";
              if ($jean["discount"]) {
                echo "<span class='discount-tag'>{$jean["discount"]}% off</span>";
                $discountedPrice = number_format( ((100 - $jean["discount"]) / 100) * $jean["unitPrice"], 2 );
                $normalPriceClass = "actual-price";
              }
              echo "<a href='viewproduct.php?productid={$jean["productId"]}'><img src='img/{$jean["picture"]}' class='product-thumb' alt=''></a>";
              echo "<form action='{$_SERVER["PHP_SELF"]}' method='POST'>";
                echo "<input type='text' hidden name='productId' value='{$jean["productId"]}'>";
                echo "<input type='text' hidden name='prodName' value='{$jean["prodName"]}'>";
                echo "<input type='text' hidden name='picture' value='{$jean["picture"]}'>";
                echo "<input type='text' hidden name='unitPrice' value='{$jean["unitPrice"]}'>";
                echo "<input type='text' hidden name='discount' value='{$jean["discount"]}'>";
                echo "<button class='card-btn'>Add To Cart</button>";
              echo "</form>";  
            echo "</div>";
            echo "<div class='product-info'>";
              echo "<h2 class='product-name'>{$jean["prodName"]}</h2>";
              echo "<p class='product-short-desc'>{$jean["prodDesc"]}</p>";
              if ($discountedPrice) echo "<span class='price'>Rs {$discountedPrice}</span>";
              echo "<span class='{$normalPriceClass}'>{$jean["unitPrice"]}</span>";
            echo "</div>";
          echo "</div>";
        }
      ?>  
    </div>
</section>

<!-- cards-container-->
<section class="product">
    <h2 class="product-category">DRESSES | SKIRTS</h2>
    <button class = "pre-btn"><img src = "img/arrow.png" alt=""></button>
    <button class = "nxt-btn"><img src = "img/arrow.png" alt=""></button>

    <div class="product-container">
      <?php
        foreach($_SESSION["suggestions"]["dresses"] as $dress) {
          $discountedPrice = 0;
          $normalPriceClass = "no-discount";

          echo "<div class='product-card'>";
            echo "<div class='product-image'>";
              if ($dress["discount"]) {
                echo "<span class='discount-tag'>{$dress["discount"]}% off</span>";
                $discountedPrice = number_format( ((100 - $dress["discount"]) / 100) * $dress["unitPrice"], 2 );
                $normalPriceClass = "actual-price";
              }
              echo "<a href='viewproduct.php?productid={$dress["productId"]}'><img src='img/{$dress["picture"]}' class='product-thumb' alt=''></a>";
              echo "<form action='{$_SERVER["PHP_SELF"]}' method='POST'>";
                echo "<input type='text' hidden name='productId' value='{$dress["productId"]}'>";
                echo "<input type='text' hidden name='prodName' value='{$dress["prodName"]}'>";
                echo "<input type='text' hidden name='picture' value='{$dress["picture"]}'>";
                echo "<input type='text' hidden name='unitPrice' value='{$dress["unitPrice"]}'>";
                echo "<input type='text' hidden name='discount' value='{$dress["discount"]}'>";
                echo "<button class='card-btn'>Add To Cart</button>";
              echo "</form>";  
            echo "</div>";
            echo "<div class='product-info'>";
              echo "<h2 class='product-name'>{$dress["prodName"]}</h2>";
              echo "<p class='product-short-desc'>{$dress["prodDesc"]}</p>";
              if ($discountedPrice) echo "<span class='price'>Rs {$discountedPrice}</span>";
              echo "<span class='{$normalPriceClass}'>{$dress["unitPrice"]}</span>";
            echo "</div>";
          echo "</div>";
        }
      ?> 
    </div>
</section> 

<footer></footer>



  <script src="js/nav.js"></script>
  <script src="js/home.js"></script>
  <script src="js/footer.js"></script>

</body>
</html>
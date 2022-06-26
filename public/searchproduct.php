<?php
  session_start();

  require_once "includes/db_connect.php";
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // GET method
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $_SESSION["search-category"] = $_GET["category"] ?: "";
    $_SESSION["gender"] = $_GET["gender"] ?: "%";

    $_SESSION["search-category-Query"] = "SELECT * 
                                          FROM product
                                          WHERE prodName 
                                          LIKE '{$_SESSION["gender"]}-{$_SESSION["search-category"]}%'";      
  
  } else {
    // POST method to filter products
    if (isset($_POST['filter'])) {
      $_SESSION["search-category-Query"] = "SELECT * FROM product
                                            WHERE prodName 
                                            LIKE '{$_SESSION["gender"]}-{$_SESSION["search-category"]}%'
                                            AND unitPrice>={$_POST['minrange']} 
                                            AND unitPrice<={$_POST['maxrange']}";
      
    }

    // POST method to search products
    if (isset($_POST['search'])) {
      $_SESSION["search-category"] = $_POST["searchbox"];
      $_SESSION["search-category-Query"] = "SELECT * FROM product 
                                            WHERE prodName 
                                            LIKE '%-{$_SESSION["search-category"]}%'";
    }

    include "includes/addToCart.php";
  }

  $searchCategoryResult = $conn->query($_SESSION["search-category-Query"]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results for</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&family=Roboto:wght@100&display=swap" rel="stylesheet"> 

   	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/searchproduct.css">
</head>
<body>

    <nav class="mynavbar"></nav> 

    <div class="main-content">
      <div class="category-menu">
        <div class="wrapper">
          <header>
            <h2>Price Range</h2>
            <p>Use slider or enter min and max price</p>
          </header>
          <div class="price-input">
            <div class="field">
              <span>Min</span>
              <input type="number" class="input-min" value="0">
            </div>
            <div class="separator">-</div>
            <div class="field">
              <span>Max</span>
              <input type="number" class="input-max" value="3000">
            </div>
          </div>
          <div class="slider">
            <div class="progress"></div>
          </div>
          <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" >
            <div class="range-input">
              <input type="range" class="range-min" name="minrange" min="0" max="3000" value="0" step="20">
              <input type="range" class="range-max" name="maxrange" min="0" max="3000" value="3000" step="20">
            </div>
            <div class="filter-btn">
              <input type="submit" name="filter" value="filter">
            </div>
          </form>
                
        </div>

        <div class="choose-category">
          <div class="radio-male-female">
            <a <?php if ($_SESSION["gender"] == "men") echo "class='active'"; ?> href="searchproduct.php?category=<?php echo $_SESSION["search-category"]; ?>&gender=men">Men</a>
            <a <?php if ($_SESSION["gender"] == "women") echo "class='active'"; ?> href="searchproduct.php?category=<?php echo $_SESSION["search-category"]; ?>&gender=women">Women</a>
          </div>
          <p>BROWSE BY CATEGORIES</p>
          <ul class="category-list">
            <li><a href="searchproduct.php?category=TShirt&gender=<?php echo $_SESSION["gender"]; ?>">T-shirts</a></li>
            <li><a href="searchproduct.php?category=Shirt&gender=<?php echo $_SESSION["gender"]; ?>">Shirts</a></li>
            <li><a href="searchproduct.php?category=Sweatshirt&gender=<?php echo $_SESSION["gender"]; ?>">Sweatshirts</a></li>
            <li><a href="searchproduct.php?category=Blouse&gender=<?php echo $_SESSION["gender"]; ?>">Blouses</a></li>
            <li><a href="searchproduct.php?category=Trousers&gender=<?php echo $_SESSION["gender"]; ?>">Trousers</a></li>
            <li><a href="searchproduct.php?category=Sportswear&gender=<?php echo $_SESSION["gender"]; ?>">Sportswear</a></li>
            <li><a href="searchproduct.php?category=Hoodie&gender=<?php echo $_SESSION["gender"]; ?>">Hoodies</a></li>
            <li><a href="searchproduct.php?category=Jean&gender=<?php echo $_SESSION["gender"]; ?>">Jeans</a></li>
            <li><a href="searchproduct.php?category=Shoes&gender=<?php echo $_SESSION["gender"]; ?>">Shoes</a></li>
            <li><a href="searchproduct.php?category=Jogger&gender=<?php echo $_SESSION["gender"]; ?>">Joggers</a></li>
            <li><a href="searchproduct.php?category=Dress&gender=<?php echo $_SESSION["gender"]; ?>">Dresses</a></li>
            <li><a href="searchproduct.php?category=Skirt&gender=<?php echo $_SESSION["gender"]; ?>">Skirts</a></li>
          </ul>
        </div>
      </div>

      <section class="search-results">
        <h2 class="heading">
          <?php  echo $searchCategoryResult->rowCount() ? "Search Results" : "No Results Found"; ?> For 
          <?php echo ($_SESSION["gender"] != "%") ? "{$_SESSION["gender"]}" : "All"; ?>
          <?php echo $_SESSION["search-category"]; ?>
        </h2>
        <div class="product-container">

          <?php foreach ($searchCategoryResult->fetchAll(PDO::FETCH_ASSOC) as $product): ?>
          <div class="product-card">
            <div class="product-image">
              <span class="discount-tag"><?php echo $product["discount"] ?: ""; ?></span>
              <a href="viewproduct.php?productid=<?php echo $product["productId"]; ?>">
                <img src ="img/<?php echo $product["picture"]; ?>" class="product-thumb" alt="">
              </a>  
              <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method='POST'>";
                <input type="text" hidden name="productId" value="<?php echo $product["productId"]; ?>">
                <input type="text" hidden name="prodName" value="<?php echo $product["prodName"]; ?>">
                <input type="text" hidden name="picture" value="<?php echo $product["picture"]; ?>">
                <input type="text" hidden name="unitPrice" value="<?php echo $product["unitPrice"]; ?>">
                <input type="text" hidden name="discount" value="<?php echo $product["discount"]; ?>">
                <button class="card-btn" name="add-to-cart" value="add-to-cart">Add To Cart</button>";
              </form>";             
            </div>
            <div class="product-info">
              <h2 class="product-brand"><?php echo $product["prodName"]; ?></h2>
              <p class="product-short-desc"><?php echo $product["prodDesc"]; ?></p>
              <span class="price"><?php echo $product["unitPrice"]; ?></span>
            </div>
          </div>
          <?php endforeach; ?>

        </div>
      </section>
    </div>

    <footer></footer>


    <script src="js/nav.js"></script>
    <script src="js/footer.js"></script>
    <script src="js/searchproduct.js"></script>
    
    
</body>
</html>
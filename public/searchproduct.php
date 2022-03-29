<?php


require_once "includes/db_connect.php";
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$searchbox = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $category = $_GET["category"];
        $query = "SELECT * FROM product
        INNER JOIN category ON category.categoryId = product.categoryId
        WHERE categoryName = {$conn->quote($category)}"; 
        $result = $conn->query($query) ;
} else {
  if (isset($_POST['filter'])) {
    $squery = "SELECT * FROM product WHERE unitPrice>={$_POST['minrange']} AND unitPrice<={$_POST['maxrange']}";
    $result = $conn->query($squery);
  }
  else if (isset($_POST['searchbox'])){
    $sqlquery = "SELECT * FROM product WHERE prodName = '{$_POST['searchbox']}' ";
    $result = $conn->query($sqlquery);
 }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results for</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
              <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ;?>" >
                <div class="range-input">
                  <input type="range" class="range-min" name="minrange" min="0" max="3000" value="0" step="20">
                  <input type="range" class="range-max" name="maxrange" min="0" max="3000" value="3000" step="20">
                </div>
              
                <div class="filter-btn">
                    <input type="submit" name="filter" value="Filter">
                </div>
              </form>
                    
            </div>

            <div class="choose-category">
                    <h2>Choose</h2>
                    <div class="radio-male-female">
                        <input type="radio" id="male" name="gender" value="man" checked/>
                        <label for="male">Man</label>
                        <input type="radio" id="female" name="gender" value="woman"/>
                        <label for="female">Woman</label>
                    </div>
                    
                    <p>BROWSE BY CATEGORIES</p>
        
                    <ul class="category-list">
                        <li><a href="searchproduct.php?category=T-shirt">T-shirts</a></li>
                        <li><a href="searchproduct.php?category=Shirt">Shirts</a></li>
                        <li><a href="searchproduct.php?category=Trousers">Trousers</a></li>
                        <li><a href="searchproduct.php?category=Sportswear">Sportswear</a></li>
                        <li><a href="searchproduct.php?category=Hoodie">Hoodies</a></li>
                        <li><a href="searchproduct.php?category=Jean">Jeans</a></li>
                        <li><a href="searchproduct.php?category=Shoes">Shoes</a></li>
                        <li><a href="searchproduct.php?category=Jogger">Joggers</a></li>
                        <li><a href="">Dresses</a></li>
                    </ul>
            </div>
        </div>

        <section class="search-results">
            <h2 class="heading">Search Results For <span> Product</span></h2>

            <div class="product-container">
                <?php

                

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                //Database Values Fetched stored in variables
                 $unitPrice = $row['unitPrice'];
                 $picture = $row['picture'];
                 $discount = $row['discount'];
                 $prodDesc = $row['prodDesc'];
                 $prodName = $row['prodName'];

                
                ?>
                  <div class = "product-card">
                    <div class = "product-image">
                        <span class = "discount-tag"><?php echo $discount; ?></span>
                        <img src ="img/<?php echo $picture; ?>" class="product-thumb" alt="">
                        <button class="card-btn">Add To Cart</button>
                    </div>
                    <div class = "product-info">
                        <h2 class="product-brand"><?php echo $prodName; ?></h2>
                        <p class= "product-short-desc"><?php echo $prodDesc; ?></p>
                        <span class="price"><?php echo $unitPrice; ?></span>
                    </div>
                  </div>
                
            <?php
            }
            ?>
            </div>
        </section>

    </div>

    
    <footer></footer>


    <script src="js/nav.js"></script>
    <script src="js/footer.js"></script>
    <script src="js/searchproduct.js"></script>
    
    
</body>
</html>
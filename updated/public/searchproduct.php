<?php

  include_once "../config/Database.php";
  include_once "../models/Product.php";

  $database = new Database();
  $db = $database->connect();

  $productModel = new Product($db);

  $productGridContent = "";
  $searchCategory = $_GET['category'] ?? "%";
  $searchGender = $_GET['gender'] ?? "%";

  // Search Results
  $products = $productModel->read($searchCategory, $searchGender)->fetchAll(PDO::FETCH_ASSOC); 

  foreach ($products as $product) {
    $discountTag = !empty($product['discount']) ? "<span class='discount-tag'>{$product['discount']}% off</span>" : "";

    $productGridContent .= <<<HTML
      <!-- Product Card -->
      <div class="col">
        <div class="product-card d-flex flex-column">
          <div class="product-image">
            {$discountTag}
            <a href="viewproduct.php?productId={$product['productId']}">
              <img src="img/{$product['imgUrl']}" alt="" class="card-img-top">
            </a>
          </div>
          <div class="card-body">
            <h5>{$product['prodName']}</h5>
            <p class="product-short-desc">{$product['prodDesc']}</p>
            <span class="price">Rs {$product['unitPrice']}</span>
          </div>
        </div>
      </div>
    HTML;
  }

  $searchCategory = ($searchCategory == "%") ? (($searchGender != "%") ? $searchGender : "All Products") : $searchCategory;
  $searchResult = !empty($searchCategory) ? "Search results for <span>{$searchCategory}</span>" : "No Product Found";
  $products = json_encode($products);
  
  include_once "templates/_searchproduct.php";
  
?>
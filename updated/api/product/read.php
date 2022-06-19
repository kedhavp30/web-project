<?php
  // Headers
  header('Allow-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once('../../config/Database.php');
  include_once('../../models/Product.php');

  // Set db connection
  $database = new Database();
  $db = $database->connect();

  // Instantiate product model
  $productModel = new Product($db);

  $category = $_GET['category'] ?? ""; 
  $gender = $_GET['gender'] ?? ""; 

  // Query product
  $result = $productModel->read($category, $gender);

  if ($result->rowCount() > 0) { // product found
    $productArr = array();
    $productArr['data'] = array();

    $products = $result->fetchAll(PDO::FETCH_ASSOC);

    forEach($products as $productRow) {
      // Assign field value to variable named after field name
      extract($productRow);

      $product = array(
        'productId' => $productId,
        'prodDesc' => $prodDesc,
        'prodName' => $prodName,
        'unitPrice' => $unitPrice,
        'discount' => $discount,
        'imgUrl' => $imgUrl,
        'categoryName' => $categoryName
      );

      array_push($productArr['data'], $product);
    }

    $productArr['status'] = 'success';
    echo json_encode($productArr);

  } else {
    // No Products
    echo json_encode( array('message' => 'No Product Found', 'status' => 'fail') );
  }
  
?>
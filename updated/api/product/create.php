<?php
  // Headers
  header('Allow-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,
                                        Authorization, x-Requested-with, Content-Type');

  include_once('../../config/Database.php');
  include_once('../../models/Product.php');

  // Set db connection
  $database = new Database();
  $db = $database->connect();

  // Instantiate product model
  $productModel = new Product($db);

  $newProductData = json_decode( file_get_contents('php://input') );

  // Set New Product details
  $productModel->prodName = $newProductData->prodName;
  $productModel->prodDesc = $newProductData->prodDesc;
  $productModel->unitPrice = $newProductData->unitPrice;
  $productModel->discount = $newProductData->discount;
  $productModel->imgUrl = $newProductData->imgUrl;
  $productModel->categoryId = $newProductData->categoryId;

  if ($productModel->create()) {
    echo json_encode( array('message' => 'Product created', 'status' => 'success') );
  } else {
    echo json_encode( array('message' => 'Product cannot be created', 'status' => 'fail') );
  }

?>
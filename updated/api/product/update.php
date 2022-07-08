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
  $productModel->productId = $newProductData->productId;
  $productModel->prodName = $newProductData->prodName;
  $productModel->prodDesc = $newProductData->prodDesc;
  $productModel->unitPrice = $newProductData->unitPrice;
  $productModel->discount = $newProductData->discount;
  $productModel->imgUrl = $newProductData->imgUrl;
  $productModel->categoryId = $newProductData->categoryId;
  $productModel->colour = $newProductData->colour;
  $productModel->size = $newProductData->size;
  $productModel->stockLevel = $newProductData->stockLevel;

  if ($productModel->update()) {
    echo json_encode( array('message' => 'Product updated', 'status' => 'success') );
  } else {
    echo json_encode( array('message' => 'Product cannot be updated', 'status' => 'fail') );
  }

?>
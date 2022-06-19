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

  // ProductId to read; else die()
  $productModel->productId = $_GET['productId'] ?? die("Product Not Found");
  $productModel->readSingle();

  $productArr['data'] = array(
  'productId' => $productModel->productId,
  'prodDesc' => $productModel->prodDesc,
  'prodName' => $productModel->prodName,
  'unitPrice' => $productModel->unitPrice,
  'discount' => $productModel->discount,
  'imgUrl' => $productModel->imgUrl,
  'categoryName' => $productModel->categoryName
  );

  $productArr['status'] = 'success';
  echo json_encode($productArr);

?>
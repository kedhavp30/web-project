<?php
  // Headers
  header('Allow-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,
                                        Authorization, x-Requested-with, Content-Type');

  include_once('/home/headrick/web-project/config/Database.php');
  include_once('/home/headrick/web-project/models/Product.php');

  // Set db connection
  $database = new Database();
  $db = $database->connect();

  // Instantiate product model
  $productModel = new Product($db);

  $productData = json_decode( file_get_contents('php://input') );

  // Set New Product details
  $productModel->productId = $productData->productId;

  if ($productModel->delete()) {
    echo json_encode( array('message' => 'Product deleted', 'status' => 'success') );
  } else {
    echo json_encode( array('message' => 'Product cannot be deleted', 'status' => 'fail') );
  }

?>
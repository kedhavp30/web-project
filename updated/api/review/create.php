<?php
  // Headers
  header('Allow-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,
                                        Authorization, x-Requested-with, Content-Type');

  include_once('../../config/Database.php');
  include_once('../../models/Review.php');

  // Set db connection
  $database = new Database();
  $db = $database->connect();

  // Instantiate review model
  $reviewModel = new Review($db);

  $newReviewData = json_decode( file_get_contents('php://input') );

  // Set New Product details
  $reviewModel->productId = $newReviewData->productId;
  $reviewModel->postedOn = date("Y-m-d");
  $reviewModel->reviewDesc = $newReviewData->reviewDesc;
  $reviewModel->customerId = $newReviewData->customerId;
  $reviewModel->rating = $newReviewData->rating;
  $reviewModel->flag = 0;

  if ($reviewModel->create()) {
    echo json_encode( array('message' => 'Review created', 'status' => 'success') );
  } else {
    echo json_encode( array('message' => 'Review cannot be created', 'status' => 'fail') );
  }

?>
<?php
  // Headers
  header('Allow-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,
                                        Authorization, x-Requested-with, Content-Type');

  include_once('../../config/Database.php');
  include_once('../../models/Review.php');

  // Set db connection
  $database = new Database();
  $db = $database->connect();

  // Instantiate Review model
  $ReviewModel = new Review($db);

  $newReviewData = json_decode( file_get_contents('php://input') );

  // Set New Review details
  $ReviewModel->productId = $newReviewData->productId;
  $ReviewModel->postedOn = $newReviewData->postedOn;
  $ReviewModel->flag = $newReviewData->flag;

  if ($ReviewModel->update()) {
    echo json_encode( array('message' => 'Review flag updated', 'status' => 'success') );
  } else {
    echo json_encode( array('message' => 'Review flag cannot be updated', 'status' => 'fail') );
  }

?>
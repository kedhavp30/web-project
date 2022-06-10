<?php
  // Headers
  header('Allow-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,
                                        Authorization, x-Requested-with, Content-Type');

  include_once('/home/headrick/web-project/config/Database.php');
  include_once('/home/headrick/web-project/models/Review.php');

  // Set db connection
  $database = new Database();
  $db = $database->connect();

  // Instantiate Review model
  $ReviewModel = new Review($db);

  $ReviewData = json_decode( file_get_contents('php://input') );

  // Set New Review details
  $ReviewModel->ReviewId = $ReviewData->ReviewId;
  $ReviewModel->postedOn = $ReviewData->postedOn;

  if ($ReviewModel->delete()) {
    echo json_encode( array('message' => 'Review banned', 'status' => 'success') );
  } else {
    echo json_encode( array('message' => 'Review cannot be banned', 'status' => 'fail') );
  }

?>
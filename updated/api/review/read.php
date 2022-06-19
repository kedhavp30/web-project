<?php
  // Headers
  header('Allow-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once('../../config/Database.php');
  include_once('../../models/Review.php');

  // Set db connection
  $database = new Database();
  $db = $database->connect();

  // Instantiate review model
  $reviewModel = new Review($db);

  $productId = $_GET['productId'] ?? ""; 
  $flag = $_GET['flag'] ?? ""; 

  // Query review
  $result = $reviewModel->read($productId, $flag);

  if ($result->rowCount() > 0) { // review found
    $reviewArr = array();
    $reviewArr['data'] = array();

    $reviews = $result->fetchAll(PDO::FETCH_ASSOC);

    forEach($reviews as $reviewRow) {
      // Assign field value to variable named after field name
      extract($reviewRow);

      $review = array(
        'productId' => $productId,
        'postedOn' => $postedOn,
        'reviewDesc' => $reviewDesc,
        'customerId' => $customerId,
        'rating' => $rating,
      );

      array_push($reviewArr['data'], $review);
    }

    $reviewArr['status'] = 'success';
    echo json_encode($reviewArr);

  } else {
    // No Reviews
    echo json_encode( array('message' => 'No Reviews Found', 'status' => 'fail') );
  }
  
?>
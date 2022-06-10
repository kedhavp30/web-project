<?php

  class Review {
    // db
    private $conn;
    private $table = 'review';

    // params
    public $productId;
    public $postedOn;
    public $reviewDesc;
    public $customerId;
    public $rating;
    public $flag;

    public function __construct($db) {
      $this->conn = $db;
    }

    // READ reviews
    public function read($productId = "%", $flag = "%") {
      $query = "SELECT
            r.productId,
            r.postedOn,
            r.reviewDesc,
            r.customerId,
            r.rating,
            c.username,
            c.firstName
          FROM {$this->table} r INNER JOIN customer c
          ON r.customerId = c.customerId
          WHERE r.productId LIKE '$productId'
          AND r.flag LIKE '$flag';";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    // CREATE review
    public function create() {
      $query = "INSERT INTO $this->table (productId, postedOn, reviewDesc, customerId, rating, flag)
            VALUES (
              :productId,
              :postedOn,
              :reviewDesc,
              :customerId,
              :rating,
              :flag
            );";
      
      $stmt = $this->conn->prepare($query);
      // Clean user input
      $stmt->bindParam(':productId', $this->productId);
      $stmt->bindParam(':postedOn', $this->postedOn);
      $stmt->bindParam(':reviewDesc', $this->reviewDesc);
      $stmt->bindParam(':customerId', $this->customerId);
      $stmt->bindParam(':rating', $this->rating);
      $stmt->bindParam(':flag', $this->flag);

      if ($stmt->execute()) {
        return true;
      }

      printf("Error: %s.\n", $stmt->error);
      return false;
    }

    // UPDATE review (flag)
    public function update() {
      $query = "UPDATE $this->table
            SET
              flag = :flag
            WHERE productId = :productId
            AND postedOn = :postedOn;";
      
      $stmt = $this->conn->prepare($query);
      // Clean user input
      $stmt->bindParam(':productId', $this->productId);
      $stmt->bindParam(':postedOn', $this->postedOn);
      $stmt->bindParam(':flag', $this->flag);

      if ($stmt->execute()) {
        return true;
      }

      printf("Error: %s.\n", $stmt->error);
      return false;
    }


    /*
      TODO: Add banned field to review table
    */

    // DELETE review (ban)
    public function delete() {
      $query = "UPDATE $this->table
            SET
              banned = 1
            WHERE productId = :productId
            AND postedOn = :postedOn;";
      
      $stmt = $this->conn->prepare($query);
      // Clean user input
      $stmt->bindParam(':productId', $this->productId);
      $stmt->bindParam(':postedOn', $this->postedOn);

      if ($stmt->execute()) {
        return true;
      }

      printf("Error: %s.\n", $stmt->error);
      return false;
    }    
  }

?>
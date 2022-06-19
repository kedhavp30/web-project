<?php

  class Product {
    // db
    private $conn;
    private $table = 'product';

    // params
    public $productId;
    public $prodDesc;
    public $prodName;
    public $unitPrice;
    public $discount;
    public $imgUrl;
    public $categoryName;
    public $available;

    public function __construct($db) {
      $this->conn = $db;
    }

    // READ products
    public function read($categoryName = "%", $gender = "%") {
      $query = "SELECT
            c.categoryName,
            p.productId,
            p.prodDesc,
            p.prodName,
            p.unitPrice,
            p.discount,
            p.picture AS imgUrl
          FROM {$this->table} p INNER JOIN category c
          ON p.categoryId = c.categoryId
          WHERE c.categoryName LIKE '$categoryName'
          AND p.prodName LIKE '$gender-%'
          AND p.available = 1;";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    // READ single product
    public function readSingle() {
      $query = "SELECT
            c.categoryName,
            p.prodDesc,
            p.prodName,
            p.unitPrice,
            p.discount,
            p.picture AS imgUrl
          FROM {$this->table} p INNER JOIN category c
          ON p.categoryId = c.categoryId
          WHERE productId = ?
          AND p.available = 1;";

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->productId);
      $stmt->execute();

      $product = $stmt->fetch(PDO::FETCH_ASSOC);

      // Set product info
      $this->prodName = $product['prodName'];
      $this->prodDesc = $product['prodDesc'];
      $this->unitPrice = $product['unitPrice'];
      $this->discount = $product['discount'];
      $this->imgUrl = $product['imgUrl'];
      $this->categoryName = $product['categoryName'];
    }

    // CREATE product
    public function create() {
      $query = "INSERT INTO $this->table (prodDesc, prodName, unitPrice, discount, picture, categoryId)
            VALUES (
              :prodDesc,
              :prodName,
              :unitPrice,
              :discount,
              :imgUrl,
              :categoryId
            );";
      
      $stmt = $this->conn->prepare($query);
      // Clean user input
      $stmt->bindParam(':prodDesc', $this->prodDesc);
      $stmt->bindParam(':prodName', $this->prodName);
      $stmt->bindParam(':unitPrice', $this->unitPrice);
      $stmt->bindParam(':discount', $this->discount);
      $stmt->bindParam(':imgUrl', $this->imgUrl);
      $stmt->bindParam(':categoryId', $this->categoryId);

      if ($stmt->execute()) {
        return true;
      }

      printf("Error: %s.\n", $stmt->error);
      return false;
    }

    // UPDATE product
    public function update() {
      $query = "UPDATE $this->table
            SET
              prodDesc = :prodDesc,
              prodName = :prodName,
              unitPrice = :unitPrice,
              discount = :discount,
              picture = :imgUrl,
              categoryId = :categoryId
              available = :available
            WHERE productId = :productId;";
      
      $stmt = $this->conn->prepare($query);
      // Clean user input
      $stmt->bindParam(':prodDesc', $this->prodDesc);
      $stmt->bindParam(':prodName', $this->prodName);
      $stmt->bindParam(':unitPrice', $this->unitPrice);
      $stmt->bindParam(':discount', $this->discount);
      $stmt->bindParam(':imgUrl', $this->imgUrl);
      $stmt->bindParam(':categoryId', $this->categoryId);
      $stmt->bindParam(':productId', $this->productId);
      $stmt->bindParam(':available', $this->available);

      if ($stmt->execute()) {
        return true;
      }

      printf("Error: %s.\n", $stmt->error);
      return false;
    }

    // DELETE product
    public function delete() {
      $query = "UPDATE $this->table
            SET
              available = 0
            WHERE productId = :productId;";
      
      $stmt = $this->conn->prepare($query);
      // Clean user input
      $stmt->bindParam(':productId', $this->productId);

      if ($stmt->execute()) {
        return true;
      }

      printf("Error: %s.\n", $stmt->error);
      return false;
    }    
  }

?>
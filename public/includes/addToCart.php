<?php
  session_start();

 // POST request for Add to cart
  if (isset($_POST["add-to-cart"])) {
    $size = isset($_POST["size"]) ? $_POST["size"] : "M"; // default size
    $colour = isset($_POST["colour"]) ? $_POST["colour"] : "Blue"; // default colour

    // Cart empty or product not in cart
    if (!$_SESSION["cart"] || !isset($_SESSION["cart"]["{$_POST["productId"]}"])) {
      $size_colour_qty = array("{$size}_{$colour}"=>"1");
      $_SESSION["cart"]["{$_POST["productId"]}"] = array( "size_colour_qty"=>$size_colour_qty,
                                                          "quantity"=>"1",
                                                          "unitPrice"=>"{$_POST["unitPrice"]}",
                                                          "discount"=>"{$_POST["discount"]}",
                                                          "prodName"=>"{$_POST["prodName"]}",
                                                          "picture"=>"{$_POST["picture"]}");

    } else { // product in cart
      $_SESSION["cart"]["{$_POST["productId"]}"]["quantity"]++;

      if (isset($_SESSION["cart"]["{$_POST["productId"]}"]["size_colour_qty"]["{$size}_{$colour}"])) {
        $_SESSION["cart"]["{$_POST["productId"]}"]["size_colour_qty"]["{$size}_{$colour}"]++;
      } else {
        $_SESSION["cart"]["{$_POST["productId"]}"]["size_colour_qty"]["{$size}_{$colour}"] = 1;        
      }
    }

    // Updating cart table if user is registered
    if (isset($_SESSION["username"])) {
      $cartQueryResult = $conn->query("SELECT * FROM cart 
                                       WHERE username = {$conn->quote($_SESSION["username"])}
                                       AND productId = {$_POST["productId"]}
                                       AND size = {$conn->quote($size)}
                                       AND colour = {$conn->quote($colour)}");
                                   
      // Product in cart table
      if ($cartQueryResult->rowCount()) {
        $conn->exec("UPDATE cart
                     SET quantity = quantity + 1
                     WHERE username = {$conn->quote($_SESSION["username"])}
                     AND productId = {$_POST["productId"]}
                     AND size = {$conn->quote($size)}
                     AND colour = {$conn->quote($colour)}");
      } else {
        $conn->exec("INSERT INTO cart(productId, size, colour, quantity, unitPrice, discount, username)
                     VALUES({$_POST["productId"]}, {$conn->quote($size)}, {$conn->quote($colour)}, 1, {$_POST["unitPrice"]}, 
                            {$_POST["discount"]}, {$conn->quote($_SESSION["username"])})");
      }
    }
  }
  


?>
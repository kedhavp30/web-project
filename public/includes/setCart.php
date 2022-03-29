<?php 
  session_start();

	// Initialize empty array if it doens't exist yet
	if (!isset($_SESSION["cart"])) {
		$_SESSION["cart"] = array();
	}

	require_once "includes/db_connect.php";
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// Registered users; retrieve cart items from db if not yet and cart session empty
	if (!$_SESSION["cart"] && $referer != "signup") {
		$cartQuery = "SELECT cart.productId, size, colour, quantity, cart.unitPrice, cart.discount, prodName, picture
									FROM cart INNER JOIN product ON cart.productId = product.productId
									WHERE username = {$conn->quote($_SESSION["username"])};";

		$cartQueryResult = $conn->query($cartQuery);

		if ($cartQueryResult->rowCount()) {

			// Session variable cart contains productId as key and product info as value
			forEach($cartQueryResult->fetchAll(PDO::FETCH_ASSOC) as $product) {

				if (isset($_SESSION["cart"]["{$product["productId"]}"])) {
					$_SESSION["cart"]["{$product["productId"]}"]["quantity"] += $product["quantity"];
					$_SESSION["cart"]["{$product["productId"]}"]["size_colour_qty"]["{$product["size"]}_{$product["colour"]}"] = $product["quantity"];
					continue;
				}

				$size_colour_qty = array("{$product["size"]}_{$product["colour"]}"=>"{$product["quantity"]}");
				$_SESSION["cart"]["{$product["productId"]}"] = array( "size_colour_qty"=>$size_colour_qty,
																															"quantity"=>"{$product["quantity"]}",
																															"unitPrice"=>"{$product["unitPrice"]}",
																															"discount"=>"{$product["discount"]}",
																															"prodName"=>"{$product["prodName"]}",
																															"picture"=>"{$product["picture"]}");

			}
		}

	} else if ($referer == "signin" || $referer == "signup") { // Cart not empty; replace cart table with session cart

		// Empty cart table for username
		$conn->exec("DELETE FROM cart WHERE username = {$conn->quote($_SESSION["username"])}");

		// Insert session cart into cart table for username
		foreach ($_SESSION["cart"] as $productId => $product) {

			foreach($product["size_colour_qty"] as $size_colour => $qty) {
				list($size, $colour) = explode("_", $size_colour);
				
				$cartQuery = "INSERT INTO cart (productId, size, colour, quantity, unitprice, discount, username)
											VALUES ( {$productId}, {$conn->quote($size)},
															 {$conn->quote($colour)}, {$qty}, {$product["unitPrice"]}, 
															 {$product["discount"]}, {$conn->quote($_SESSION["username"])} );";

				$conn->exec($cartQuery);
			}
		}		
	}
?>
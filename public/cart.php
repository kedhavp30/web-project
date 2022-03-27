<?php
	session_start();

	require_once "includes/db_connect.php";
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Initialize empty array if it doesn't exist yet
	if (!isset($_SESSION["cart"])) {
		$_SESSION["cart"] = array();
	}

	// Removing a product from cart
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$conn->query("DELETE FROM cart 
									WHERE productId = {$_POST["productId"]}
									AND size = {$conn->quote($_SESSION["cart"]["{$_POST["productId"]}"]["size"])}
									AND colour = {$conn->quote($_SESSION["cart"]["{$_POST["productId"]}"]["colour"])}");
									
		unset($_SESSION["cart"]["{$_POST["productId"]}"]);
	}	

	// Registered users; retrieve cart items from db if not yet and cart session empty
	if (isset($_SESSION["username"]) && !isset($_SESSION["cart"])) {
		$cartQuery = "SELECT cart.productId, size, colour, quantity, cart.unitPrice, cart.discount, prodName, picture
									FROM cart INNER JOIN product ON cart.productId = product.productId
									WHERE username = {$conn->quote($_SESSION["username"])};";

		$cartQueryResult = $conn->query($cartQuery);

		if ($cartQueryResult->rowCount()) {

			// Session variable cart contains productId as key and product info as value
			forEach($cartQueryResult->fetchAll(PDO::FETCH_ASSOC) as $product) {
				$_SESSION["cart"]["{$product["productId"]}"] = array("size"=>"{$product["size"]}",
																															"colour"=>"{$product["colour"]}",
																															"quantity"=>"{$product["quantity"]}",
																															"unitPrice"=>"{$product["unitPrice"]}",
																															"discount"=>"{$product["discount"]}",
																															"prodName"=>"{$product["prodName"]}",
																															"picture"=>"{$product["picture"]}");
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="UTF-8">
			<title>Shopping Cart</title>

   	 	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

			<link rel="stylesheet" href="css/cart.css">
	</head>
	<body>

			<nav class="mynavbar"></nav>

			<div class="wrapper">
			<h1>Shopping Cart</h1>
			<div class="project">
				<div class="shop">

					<?php
						$subTotal = 0;

						// Display cart items
						foreach($_SESSION["cart"] as $productId => $product) {
							$subTotal += ($product["unitPrice"] * $product["quantity"]);

							echo "<div class='box'>";
							echo "<img src='img/{$product["picture"]}'>";
							echo "<div class='content'>";
							echo "<h3>{$product["prodName"]}</h3>";
							echo "<h4><span class='product-colour'>Colour: {$product["colour"]}</span><span class='product-size'>Size: {$product["size"]}</span>Price: Rs {$product["unitPrice"]}</h4>";
							echo "<p class='unit'>Quantity: <input type='number' name='quantity' value='{$product["quantity"]}' max='100' min='1'></p>";
							echo "<form action='{$_SERVER["PHP_SELF"]}' method='POST'>
										<input type='text' hidden name='productId' value='{$productId}'>
										<button class='btn-area'><i class='fa fa-trash'></i>Remove</button>
										</form>";
							echo "</div>";
							echo "</div>";	
						}

						$tax = $subTotal * 0.05;
						$total = $subTotal + $tax;

						// Cart empty
						if (!$_SESSION["cart"]) {
							echo "<div class='box'>";
							echo "<div class='content'>";
							echo "<h3 style='text-align: center;'>Cart Empty</h3>";
							echo "</div>";						
							echo "</div>";						
						}
					?>

				</div>
				<div class="right-bar">
					<div <?php if (!$_SESSION["cart"]) echo "hidden"; ?>>
						<p><span>Subtotal</span> <span class="subtotal">Rs <?php echo $subTotal; ?></span></p>
						<hr>
						<p><span>Tax (5%)</span> <span class="tax">Rs <?php echo $tax; ?></span></p>
						<hr>
						<p><span>Total</span> <span class="total">Rs <?php echo $total; ?></span></p>
						<a href="checkout.php" class="checkout-link"><i class="fa fa-shopping-cart"></i>Checkout</a>
					</div>
					<a href="searchproduct.php" class="shop-link">Continue Shopping</a>
				</div>
			</div>
		</div>

		<footer></footer>

		<script src="js/nav.js"></script>
		<script src="js/footer.js"></script>
		
	</body>
</html>
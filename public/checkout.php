<?php
	session_start();

	if (!isset($_SESSION["username"])) {
		header("Location: signin.php?referer=checkout");
		die();
	}

	// Initialize empty array if it doens't exist yet
	if (!isset($_SESSION["cart"])) {
		$_SESSION["cart"] = array();
	}

	$username = $creditcardnum = $creditcardpin = "";
	$creditcardnumErr = $creditcardpinErr = "";

	$username = $_SESSION["username"];

	require_once "includes/db_connect.php";
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// Registered users; retrieve cart items from db if not yet
	if (!$_SESSION["cart"]) {

		$cartQuery = "SELECT cart.productId, size, colour, quantity, cart.unitPrice, cart.discount, prodName, picture
									FROM cart INNER JOIN product ON cart.productId = product.productId
									WHERE username = {$conn->quote($username)};";

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

	// Checking if user is already a customer
  $isCustomer = $conn->query("SELECT * FROM customer WHERE username = {$conn->quote($username)}");

  // Form submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    if (empty($_POST["creditcardnum"])) {
      $creditcardnumErr = "Credit card num is required.";
    } else {
      $creditcardnum = $_POST["creditcardnum"];
    }
    if (empty($_POST["creditcardpin"])) {
      $creditcardnumErr = "Credit card pin is required.";
		} else {
			$creditcardpin = $_POST["creditcardpin"];
		}

		// Form valid: Insert Into Order and Order Details, Update inventory
		if($creditcardnumErr  == "" && $creditcardpinErr == "") {

			// $creditCardId = $conn->query("SELECT creditCardId 
			// 													 		FROM paymentinfo 
			// 													 		WHERE  creditCardNo =  $creditcardnum ")
			// 											->fetch(PDO::FETCH_ASSOC)['creditCardId'];
		
			$conn->exec("INSERT INTO orders (status, orderDate, creditCardNo, username )
									 VALUES ( 'Pending', {$conn->quote(date("Y-m-d"))}, 1, {$conn->quote($username)} );");

			$orderId = $conn->query("SELECT MAX(orderId) AS orderId 
															 FROM orders 
															 WHERE  username = {$conn->quote($username)}")
                      ->fetch(PDO::FETCH_ASSOC)['orderId'];

			foreach($_SESSION["cart"] as $productId => $product) {

				$orderItemsQuery = "INSERT INTO orderitems (orderId, productId, size, colour, quantity, unitprice, discount)
														VALUES ( {$orderId}, {$productId}, {$conn->quote($product["size"])},
														 			 {$conn->quote($product["colour"])}, {$product["quantity"]}, {$product["unitPrice"]}, 
														 			 {$product["discount"]} );";

				$conn->exec($orderItemsQuery);

				$updateInventory = "UPDATE inventory
														SET stockLevel  = stockLevel - {$product["quantity"]}
														WHERE productId = {$productId}
														AND  size = {$conn->quote($product["size"])}
														AND colour = {$conn->quote($product["colour"])};";
				$conn->exec($updateInventory);
		  }
			// Checkout complete; Empty user cart in db
			$conn->exec("DELETE FROM cart WHERE username = {$conn->quote($username)}");
			unset($_SESSION["cart"]);

			header("Location: index.html");
			die();
		}	
	}
	$conn = null;    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="css/cart.css">
</head>

<body>

	<nav class="mynavbar"></nav>

	<div class="main-content">
	
		<div class="wrapper order-summary">
			<h1>Order Summary</h1>
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
					</div>
					<a href="cart.php" class="checkout-link"><i class="fa fa-shopping-cart"></i>Back to cart</a>						
				</div>
			</div>				
		</div>

		<div class="wrapper payment-form" <?php if (!$_SESSION["cart"]) echo "hidden"; ?>>
			<h2>Payment Form</h2>
			<form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ;?>">
				<!--Account Information Start-->
				<div <?php if ($isCustomer) echo "hidden"; ?>>

					<h4>Account</h4>
					<div class="input_group">
						<div class="input_box">
							<input type="text" placeholder="First Name" <?php if ($isCustomer) echo "disabled"; ?> required class="name">
							<i class="fa fa-user icon"></i>
						</div>
						<div class="input_box">
							<input type="text" placeholder="Last Name" <?php if ($isCustomer) echo "disabled"; ?> required class="name">
							<i class="fa fa-user icon"></i>
						</div>
					</div>
					<div class="input_group">
						<div class="input_box">
							<input type="email" placeholder="Email Address" <?php if ($isCustomer) echo "disabled"; ?> required class="name">
							<i class="fa fa-envelope icon"></i>
						</div>
					</div>
					<div class="input_group">
						<div class="input_box">
							<input type="text" placeholder="Telephone number" <?php if ($isCustomer) echo "disabled"; ?> required class="name">
							<i class="fa fa-phone icon"></i>
						</div>
					</div>
					<div class="input_group">
						<div class="input_box">
							<input type="text" placeholder="Address" <?php if ($isCustomer) echo "disabled"; ?> required class="name">
							<i class="fa fa-map-marker icon" aria-hidden="true"></i>
						</div>
					</div>
					
					<!--DOB & Gender Start-->
					<div class="input_group">
						<div class="input_box">
							<h4>Date Of Birth</h4>
							<input type="text" placeholder="DD" <?php if ($isCustomer) echo "disabled"; ?> required class="dob">
							<input type="text" placeholder="MM" <?php if ($isCustomer) echo "disabled"; ?> required class="dob">
							<input type="text" placeholder="YYYY" <?php if ($isCustomer) echo "disabled"; ?> required class="dob">
						</div>
						<div class="input_box">
							<h4>Gender</h4>
							<input type="radio" name="gender" <?php if ($isCustomer) echo "disabled"; ?> class="radio" id="b1" checked>
							<label for="b1">Male</label>
							<input type="radio" name="gender" <?php if ($isCustomer) echo "disabled"; ?> class="radio" id="b2">
							<label for="b2">Female</label>
						</div>
					</div>
				</div>
				<!--DOB & Gender End-->
				<!--Account Information End-->
				
				<!--Payment Details Start-->
				<div class="input_group">
					<div class="input_box">
						<h4>Payment Details</h4>
					</div>
				</div>
				<div class="input_group">
					<div class="input_box">
						<input type="tel" type="number" name="creditcardnum" class="name" placeholder="Card Number 1111-2222-3333-4444" required>
						<i class="fa fa-credit-card icon"></i>
					</div>
				</div>
				<div class="input_group">
					<div class="input_box">
						<input type="text" name="creditcardpin" placeholder="Credit PIN" required class="name">
						<i class="fa fa-lock icon" aria-hidden="true"></i>
					</div>
				</div>	
				<!--Payment Details End-->
				
				<div class="input_group">
					<div class="input_box">
						<button type="submit" id="submit-btn" value="submit">Place Order</button>
					</div>
				</div>    
			</form>
		</div>			    
	</div>

	<footer></footer>

	<script src="js/nav.js"></script>
	<script src="js/footer.js"></script>

</body>
</html>
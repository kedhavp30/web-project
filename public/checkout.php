<?php
session_start();

if (!isset($_SESSION["username"])) {
  header("Location: signin.php?referer=checkout");
  die();
}

   $username = $paymentmethod = $creditcardnum = $creditcardpin = "";
   $paymentmethodErr = $creditcardnumErr = $creditcardpinErr = "";

   $username = $_SESSION["username"];
  
   require_once "includes/db_connect.php";
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Retrive From Cart Table
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    

    $cartQuery = "SELECT * FROM cart 
    WHERE username  = {$conn->quote($_SESSION["username"])}";



    $cartQueryResult = $conn->query($cartQuery);
    $_SESSION["cartinfo"] = $cartQueryResult->fetchAll(PDO::FETCH_ASSOC);

    
}

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

      //Insert Into Order and Order Details

      if( $creditcardnumErr  == "" && $creditcardpinErr == "")
      {
        require_once "includes/db_connect.php";

        $paymentId = $conn->query("SELECT paymentId FROM paymentinfo WHERE  creditCardNo =  $creditcardnum ")->fetch(PDO::FETCH_ASSOC)['paymentId'];
      
        $sInsert = "INSERT INTO order(status,orderDate,paymentId, username )
             VALUES ( {$conn->quote($status)}, {$conn->quote(date("Y-m-d"))} ,
             {$conn->quote($paymentId)}, {$conn->quote($username)});";
        #echo $sInsert;

        $orderId = $conn->query("SELECT MAX (orderId FROM orders WHERE  username =  {$conn->quote($username)} ")->fetch(PDO::FETCH_ASSOC)['orderId'];

        foreach($_SESSION["cartinfo"] as $product) {
          $sInsert = "INSERT INTO orderitems(orderId,productId,size,colour, quantity,unitprice,discount )
          VALUES ( {$conn->quote($orderId)}, {$conn->quote($product["productId"])}, {$conn->quote($product["size"])} ,
          {$conn->quote($product["colour"])}, {$conn->quote($product["quantity"])} , {$conn->quote($product["unitprice"])} , {$conn->quote($product["discount"])});";
          $conn->exec($sInsert);

         $updateinventory =  "UPDATE inventory
           SET stockLevel  = stockLevel - {$product["quantity"]}
           WHERE productId = {$product["productId"]}
           AND  size = {$product["size"]}
           AND colour = {$product["colour"]};";
           $conn->exec($updateinventory);
      }


        
      $conn=null;    
      }//end if	
    }//end if


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
                    <div class="box">
                        <img src="img/Men/Sportswear/68.png">
                        <div class="content">
                            <h3>Men's Sportswear</h3>
                            <h4><span class="product-colour">Colour: Red</span><span class="product-size">Size: S</span>Price: Rs 500</h4>
                            <p class="unit">Quantity: <input type="number" name="" value="2"></p>
                        </div>
                    </div>
                    <div class="box">
                        <img src="img/Women/Dress/79.png">
                        <div class="content">
                            <h3>Woman's Dress</h3>
	                        <h4><span class="product-colour">Colour: Blue</span><span class="product-size">Size: L</span>Price: Rs 400</h4>
                            <p class="unit">Quantity: <input type="number" name="" value="1"></p>
                        </div>
                    </div>
                    <div class="box">
                        <img src="img/Women/Shirts_Blouse/4.png">
                        <div class="content">
                            <h3>Woman's Blouse</h3>
							<h4><span class="product-colour">Colour: Yellow</span><span class="product-size">Size: M</span>Price: Rs 300</h4>
                            <p class="unit">Quantity: <input type="number" name="" value="0"></p>
                        </div>
                    </div>
                </div>
                <div class="right-bar">
				    <p><span>Subtotal</span> <span class="subtotal">Rs 1200</span></p>
					<hr>
					<p><span>Tax (5%)</span> <span class="tax">Rs 60</span></p>
					<hr>
					<p><span>Total</span> <span class="total">Rs 1260</span></p>
                    <a href="cart.html" class="checkout-link"><i class="fa fa-shopping-cart"></i>Back to cart</a>
                </div>
            </div>
        </div>

         <div class="wrapper payment-form">
            <h2>Payment Form</h2>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ;?>" >
                <!--Account Information Start-->
                <h4>Account</h4>
                <div class="input_group">
                    <div class="input_box">
                        <input type="text" placeholder="First Name" required class="name">
                        <i class="fa fa-user icon"></i>
                    </div>
                    <div class="input_box">
                        <input type="text" placeholder="Last Name" required class="name">
                        <i class="fa fa-user icon"></i>
                    </div>
                </div>
                <div class="input_group">
                    <div class="input_box">
                        <input type="email" placeholder="Email Address" required class="name">
                        <i class="fa fa-envelope icon"></i>
                    </div>
                </div>
                <div class="input_group">
                    <div class="input_box">
                        <input type="text" placeholder="Telephone number" required class="name">
                        <i class="fa fa-phone icon"></i>
                    </div>
                </div>
                <div class="input_group">
                    <div class="input_box">
                        <input type="text" placeholder="Address" required class="name">
                        <i class="fa fa-map-marker icon" aria-hidden="true"></i>
                    </div>
                </div>
                
                <!--Account Information End-->
                
                
                <!--DOB & Gender Start-->
                <div class="input_group">
                    <div class="input_box">
                        <h4>Date Of Birth</h4>
                        <input type="text" placeholder="DD" required class="dob">
                        <input type="text" placeholder="MM" required class="dob">
                        <input type="text" placeholder="YYYY" required class="dob">
                    </div>
                    <div class="input_box">
                        <h4>Gender</h4>
                        <input type="radio" name="gender" class="radio" id="b1" checked>
                        <label for="b1">Male</label>
                        <input type="radio" name="gender" class="radio" id="b2">
                        <label for="b2">Female</label>
                    </div>
                </div>
                <!--DOB & Gender End-->
                
                
                <!--Payment Details Start-->
                <div class="input_group">
                    <div class="input_box">
                        <h4>Payment Details</h4>
                        <input type="radio" name="pay" class="radio" id="bc1" checked>
                        <label for="bc1"><span>
                            <i class="fa fa-cc-visa"></i>Credit Card</span></label>
                            <input type="radio" name="pay" class="radio" id="bc2">
                            <label for="bc2"><span>
                                <i class="fa fa-cc-paypal"></i>Paypal</span></label>
                    </div>
                </div>
                <div class="input_group">
                    <div class="input_box">
                        <input type="tel" type="number" name="creditcardnum" class="name" placeholder="Card Number 1111-2222-3333-4444" required>
                        <i class="fa fa-credit-card icon"></i>
                    </div>
                </div>
                <div class="input_box">
                    <input type="text" name="creditcardpin" placeholder="Credit PIN" required class="name">
                    <i class="fa fa-lock icon" aria-hidden="true"></i>
                </div>
                <!--Payment Details End-->
                
                <div class="input_group">
                    <div class="input_box">
                        <input type="submit" value = "PAY NOW"></input>
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
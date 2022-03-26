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
    $_SESSION["productid"] = $_GET["productid"];
    $_SESSION["size"] = $_GET["size"];
    $_SESSION["colour"] = $_GET["colour"];
    $_SESSION["customerid"] = $_GET["customerid"];

    $cartQuery = "SELECT * FROM cart 
    WHERE customerid  = {$conn->quote($_SESSION["customerid"])}
    AND productid = {$conn->quote($_SESSION["productid"])}
    AND size = {$conn->quote($_SESSION["size"])}
    AND colour = {$conn->quote($_SESSION["colour"])};


    $cartQueryResult = $conn->query($cartQuery);

    $iscart = false;
    if ($cartQueryResult->rowCount()) {
    $iscart = true;
    $cartInfo = $cartQueryResult->fetch(PDO::FETCH_ASSOC);

    }
}

  // Form submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["pay"])) {
      $paymentmethodErr = "Payment Method is required.";
    } else {
      $paymentmethod = $_POST["pay"];
    }    
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

      if( $paymentmethodErr == "" && $creditcardnumErr  == "" && $creditcardpinErr == "" )
      {
        require_once "includes/db_connect.php";
      
        $sInsert = "INSERT INTO order(orderId,status,orderDate,paymentId, username )
             VALUES ( {$conn->quote($orderId)}, {$conn->quote($status)}, {$conn->quote($orderDate)} ,
             {$conn->quote($paymentId)}, {$conn->quote($username)} )
        #echo $sInsert;

        $Insert = "INSERT INTO orderitems(orderId,productId,size,colour, quantity,unitprice,discount )
        VALUES ( {$conn->quote($orderId)}, {$conn->quote($productId)}, {$conn->quote($size)} ,
        {$conn->quote($colour)}, {$conn->quote($quantity)} , {$conn->quote($unitprice)} , {$conn->quote($discount)} )
        #echo $Insert;

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $addResult = $conn->exec($sInsert) ;
        if($addResult )
        {	
            $Msg = "Record Saved!";
            //echo $Msg;
        }else{
           $Msg = "ERROR: Record could not be Saved!";
           //echo $Msg;
           
        }//end else
        $conn==null;    
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
            <form action="" method="post">
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
                        <button type="submit">PAY NOW</button>
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
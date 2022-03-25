<?php
  session_start();

  if (!isset($_SESSION["username"])) {
    header("Location: signup.php");
    die();
  }

  // Is page loaded to view or edit profile
  $viewProfile = !($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["profile"] == "edit");

  $username = $fname = $lname = $email = $phone = $address = "";
  $usernameErr = $fnameErr = $lnameErr = $emailErr = $phoneErr = $addressErr = "";

  $username = $_SESSION["username"];

  require_once "includes/db_connect.php";
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Retrieve email for customers and non-customers (registered users only)
  $accountQuery = "SELECT email FROM account WHERE username = {$conn->quote($username)}";
  $_SESSION["email"] = $conn->query($accountQuery)->fetch(PDO::FETCH_ASSOC)["email"];
  // echo "email retrieved.";

  // Retrieving customer details (registered users only)
  $customerQuery = "SELECT firstname, lastname, dob, gender, phone, address FROM customer WHERE username = {$conn->quote($username)}";
  $customerQueryResult = $conn->query($customerQuery);

  $isCustomer = false;
  if ($customerQueryResult->rowCount()) {
    $isCustomer = true;
    $customerInfo = $customerQueryResult->fetch(PDO::FETCH_ASSOC);
    // echo "customer info retrieved.";

    $_SESSION["fname"] = $customerInfo["firstname"];
    $_SESSION["lname"] = $customerInfo["lastname"];
    $_SESSION["dob"] = $customerInfo["dob"];
    $_SESSION["gender"] = ($customerInfo["gender"] == "m" ? "male" : "female");
    $_SESSION["phone"] = $customerInfo["phone"];
    $_SESSION["address"] = $customerInfo["address"];
  }

  // Form submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fname"])) {
      $fnameErr = "First name is required.";
    } else {
      $fname = $_POST["fname"];
    }
    if (empty($_POST["lname"])) {
      $lnameErr = "Last name is required.";
    } else {
      $lname = $_POST["lname"];
    }
    if (empty($_POST["email"])) {
      $emailErr = "Email is required.";
    } else {
      $email = $_POST["email"];
    }    
    if (empty($_POST["phone"])) {
      $phoneErr = "Phone is required.";
    } else {
      $phone = $_POST["phone"];
    }
    if (empty($_POST["address"])) {
      $addressErr = "Address is required.";
    } else {
      $address = $_POST["address"];
    } 

    // Form valid
    if ($fnameErr == "" && $lnameErr == "" && $emailErr == "" && $phoneErr == "" && $addressErr == "") {

      $updateAccountQuery = "UPDATE account SET email = {$conn->quote($email)} WHERE username = {$conn->quote($username)};";

      $conn->beginTransaction();

      // Update account only if email edited
      if ($_SESSION["email"] != $email) {
        $updateAccount = $conn->exec($updateAccountQuery);
        $_SESSION["email"] = $email;

        if (!$updateAccount) {
          // echo "Couldn't update email.";
          $conn->rollBack();
        }
      }   

      if ($isCustomer == "Customer" && $updateAccount) {

        // Update only edited values in customer table
        if ($_SESSION["fname"] != $fname) {
          $_SESSION["fname"] = $customerInfoArr["firstname"] = $fname;
        }
        if ($_SESSION["lname"] != $lname) {
          $_SESSION["lname"] = $customerInfoArr["lastname"] = $lname;
        }  
        if ($_SESSION["email"] != $email) {
          $_SESSION["email"] = $customerInfoArr["email"] = $email;
        }
        if ($_SESSION["phone"] != $phone) {
          $_SESSION["phone"] = $customerInfoArr["phone"] = $phone;
        }  
        if ($_SESSION["address"] != $address) {
          $_SESSION["address"] = $customerInfoArr["address"] = $address;
        }  

        $customerParams = "";
        $lastKey = array_key_last($customerInfoArr);
        foreach($customerInfoArr as $key => $value) {
          if (key($customerInfoArr) != $lastKey) {
            $customerParams .= ($key . "=" . $conn->quote($value) . ",");
            continue;
          }
          $customerParams .= ($key . "=" . $conn->quote($value));
        }

        $updateCustomerQuery = "UPDATE customer SET {$customerParams} WHERE username = {$conn->quote($username)}";
        // Execute only if customer details edited
        if ($customerParams != "") {
          $updateCustomer = $conn->exec($updateCustomerQuery);

          if (!$updateCustomer) {
            // echo "Couldn't update customer.";
            $conn->rollBack();
          }
        }
      }

      $conn->commit();
      $conn = null;

    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>

    <link href="css/editprofile.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

    <body>

      <nav class="mynavbar"></nav> 
        
      <div class="main-content">
        <div class="row gutters-sm">
          <div class="col-md-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <img src="img/david-de-gea-7.jpg" alt="Admin" class="rounded-circle" width="70%">
                  <div class="mt-3">
                    <h4><?php echo "{$fname} {$lname}"; ?></h4>
                    <p class="text-secondary mb-1"><?php echo $isCustomer ? "Customer" : "User"; ?></p>
                    <p class="text-muted font-size-sm"><?php echo "{$_SESSION["address"]}"; ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card mb-3">

              <!-- View Profile -->
              <div class="card-body" <?php if (!$viewProfile) echo "hidden"; ?>>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Username</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php echo "{$_SESSION["username"]}"; ?>
                  </div>                  
                </div>
                <hr>
                <div class="row" <?php if (!$isCustomer) echo "hidden"; ?>>
                  <div class="col-sm-3">
                    <h6 class="mb-0">First Name</h6>
                  </div>
                  <div class="col-sm-3 text-secondary">
                    <?php echo "{$_SESSION["fname"]}"; ?>
                  </div> 
                  <div class="col-sm-3">
                    <h6 class="mb-0">Last Name</h6>
                  </div>
                  <div class="col-sm-3 text-secondary">
                    <?php echo "{$_SESSION["lname"]}"; ?>
                  </div>                  
                  <hr>                
                </div>
                <div class="row" <?php if (!$isCustomer) echo "hidden"; ?>>
                  <div class="col-sm-3">
                    <h6 class="mb-0">DOB</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php echo "{$_SESSION["dob"]}"; ?>
                  </div>
                  <hr>
                </div>                 
                <div class="row" <?php if (!$isCustomer) echo "hidden"; ?>>
                  <div class="col-sm-3">
                    <h6 class="mb-0">Gender</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php echo "{$_SESSION["gender"]}"; ?>
                  </div>
                  <hr> 
                </div>             
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php echo "{$_SESSION["email"]}"; ?>
                  </div>
                </div>
                <hr>
                <div class="row" <?php if (!$isCustomer) echo "hidden"; ?>>
                  <div class="col-sm-3">
                    <h6 class="mb-0">Phone</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php echo "{$_SESSION["phone"]}"; ?>
                  </div>
                  <hr>
                </div>
                <div class="row" <?php if (!$isCustomer) echo "hidden"; ?>>
                  <div class="col-sm-3">
                    <h6 class="mb-0">Address</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php echo "{$_SESSION["address"]}"; ?>
                  </div>
                </div>
                <br/>
                <div class="row">
                  <div class="col-sm-12">
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
                      <input type="text" name="profile" value="edit" hidden></input>
                      <input type="submit" class="btn btn-info" value="Edit"></input>
                    </form>
                  </div>
                </div>
                <hr>
              </div>  
              
              <!-- Edit Profile -->
              <div class="card-body" <?php if ($viewProfile) echo "hidden"; ?>>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

                  <div class="row">
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Username</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo "{$_SESSION["username"]}"; ?>
                      </div>                       
                      <hr>
                    </div>                   
                    <div class="row" <?php if (!$isCustomer) echo "hidden"; ?>>
                      <label for="fname" class="col-sm-3">First Name</label>
                      <input type="text" name="fname" class="col-sm-3 text-secondary" value="<?php echo "{$_SESSION["fname"]}"; ?>"></input>
                      <label for="lname" class="col-sm-3">Last Name</label>
                      <input type="text" name="lname" class="col-sm-3 text-secondary" value="<?php echo "{$_SESSION["lname"]}"; ?>"></input>
                      <hr>
                    </div>
                    <div class="row" <?php if (!$isCustomer) echo "hidden"; ?>>
                      <div class="col-sm-3">
                        <h6 class="mb-0">DOB</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo "{$_SESSION["dob"]}"; ?>
                      </div>
                      <hr>                      
                    </div>                 
                    <div class="row" <?php if (!$isCustomer) echo "hidden"; ?>>
                      <div class="col-sm-3">
                        <h6 class="mb-0">Gender</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo "{$_SESSION["gender"]}"; ?>
                      </div>
                      <hr>
                    </div>              
                    <div class="row">
                      <label for="email" class="col-sm-3">Email</label>
                      <input type="email" name="email" class="col-sm-9 text-secondary" value="<?php echo "{$_SESSION["email"]}"; ?>"></input>
                    </div>
                    <hr>
                    <div class="row" <?php if (!$isCustomer) echo "hidden"; ?>>
                      <label for="phone" class="col-sm-3">Phone</label>
                      <input type="text" name="phone" class="col-sm-9 text-secondary" value="<?php echo "{$_SESSION["phone"]}"; ?>"></input>
                      <hr>
                    </div>
                    <div class="row" <?php if (!$isCustomer) echo "hidden"; ?>>
                      <label for="address" class="col-sm-3">Address</label>
                      <input type="text" name="address" class="col-sm-9 text-secondary" value="<?php echo "{$_SESSION["address"]}"; ?>"></input>
                      <hr>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <input type="submit" class="btn btn-info" value="Save"></input>
                      </div>
                    </div>
                  </div>
                </form>
              </div>                

            </div>
          </div>
        </div>
      </div>
    <footer></footer>

    <script src="js/nav.js"></script>
    <script src="js/footer.js"></script>

  </body>
</html>
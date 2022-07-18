<?php 

  require_once "../updated/config/Database.php";
  require_once "../updated/models/Product.php";

  $database = new Database();
  $db = $database->connect();

  if (isset($_GET['productId'])) { //Edit product; fetch product info
    // Product to edit
    $productModel = new Product($db);
    $productModel->productId = $_GET['productId'];
    $productModel->readSingle();

    // Get inventory
    $inventoryResults = $db->query("SELECT * FROM inventory WHERE productId = {$_GET['productId']};")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($inventoryResults as $inventoryResult) {
      $inventory["{$inventoryResult['size']}-{$inventoryResult['colour']}"] = $inventoryResult['stockLevel'];
    }

    // Encode to store in localstorage in js
    $inventoryJSON = json_encode($inventory);
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Add | Edit Product</title>

    <!-- JQuery Cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/addeditproduct.css">

    <script>
      let inventory = <?= $inventoryJSON ?? "null"; ?>;
      (inventory != null) && localStorage.setItem("inventory", JSON.stringify(inventory));
    </script>

  </head>

  <body>

    <div class="mysidebar"></div>

    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class='bx bx-menu sidebarBtn'></i>
          <span class="dashboard">Dashboard</span>
        </div>
      </nav>
      <div class="main-content">
        <div class="row">
          <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
            <div class="tm-bg-primary-light tm-block tm-block-h-auto">
              <div class="row">
                <div class="col-12">
                  <h2 class="tm-block-title d-inline-block">Add Product</h2>
                </div>
              </div>
              <div class="row tm-edit-product-row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                  <form action="" class="tm-edit-product-form">
                    <div class="form-group mb-3">
                      <label for="name">Product Name</label>
                      <input id="name" name="name" type="text" class="form-control validate" value="<?= $productModel->prodName; ?>" required/>
                    </div>
                    <div class="form-group mb-3">
                      <label for="description" >Description</label>
                      <textarea id="desc" class="form-control validate" rows="3" required><?= $productModel->prodDesc; ?></textarea>
                    </div>
                    <div class="form-group mb-3">
                      <label for="category" >Category</label>
                      <select class="custom-select tm-select-accounts" id="category">
                        <option selected>Select category</option>

                        <?php
                          $query = "SELECT * FROM category;";
                          $categories = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

                          foreach ($categories as $category) {
                            // Select category if page loaded for edit
                            $selected = (isset($_GET['productId']) && ($category['categoryName'] == $productModel->categoryName)) ? "selected" : "";
                            echo "<option {$selected} value='{$category['categoryId']}'>{$category['categoryName']}</option>";
                          }
                        ?>

                      </select>
                    </div>
                    <div class="row">
                      <div class="form-group mb-3 col-xs-12 col-sm-6">
                        <div>
                          <h5>Select Colour</h5>  
                          <input type="radio" class="btn-check" name="colour" id="Red" value="Red" autocomplete="off" checked>
                          <label for="Red" class="btn btn-outline-danger">red</label>
                          
                          <input type="radio" class="btn-check" name="colour" id="Blue" value="Blue" autocomplete="off">
                          <label for="Blue" class="btn btn-outline-primary">blue</label>

                          <h5 class="mt-3">Select Size</h5>
                          <select name="size" id="size">
                            <option value="S">Small</option>
                            <option value="M">Medium</option>
                            <option value="L">Large</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group mb-3 col-xs-12 col-sm-6">
                        <label for="stock" >Units In Stock</label>
                        <input id="stock" name="stock" type="number" class="form-control validate" required/>
                        <label for="unitPrice" >Unit Price</label>
                        <input id="unitPrice" name="unitPrice" type="number" class="form-control validate" value="<?= $productModel->unitPrice; ?>" required/>
                        <label for="discount" >Discount</label>
                        <input id="discount" name="discount" type="number" class="form-control validate" value="<?= $productModel->discount; ?>" required/>
                        <label for="imgUrl" >Image Path</label>
                        <input id="imgUrl" name="imgUrl" type="text" class="form-control validate" value="<?= $productModel->imgUrl; ?>" required/>
                      </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button type="button" class="btn-save btn btn-primary btn-block text-uppercase" data-updateId="<?= $_GET['productId'] ?? -1; ?>" data-action="<?php echo (isset($_GET['referer'])) ? "create" : "update" ?>">Save Product</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </section>
   
    <script src="js/nav.js"></script>
    <script src="js/addeditproduct.js"></script>

  </body>
</html>

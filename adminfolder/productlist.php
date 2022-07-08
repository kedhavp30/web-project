<?php 

  include_once "../updated/config/Database.php";
  include_once "../updated/models/Product.php";

  $database = new Database();
  $db = $database->connect();

  $productModel = new Product($db);

  $allProducts = "";
  $products = $productModel->read()->fetchAll(PDO::FETCH_ASSOC);
  foreach($products as $product) {

    $allProducts .= <<<HTML
      <tr id="{$product['productId']}">
        <td class="pl-4">{$product['productId']}</td>
        <td>
          <div class="profile">
            <!--img---->
            <div class="profile-img">
                <img src="images/{$product['imgUrl']}">
            </div>
            <h5 class="font-medium mb-0">{$product['prodName']}</h5>
          </div>
        </td>
        <td>
          <span class="text-muted">Rs {$product['unitPrice']}</span><br>
        </td>
        <td>
          <span class="text-muted">{$product['prodDesc']}</span><br>
        </td>
        <td>
          <button type="button" class="edit-product btn btn-outline-info btn-circle btn-lg btn-circle"><a href="addeditproduct.php?productId={$product['productId']}"><i class="fa fa-edit"></i></a></button>
          <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal-{$product['productId']}" class="btn btn-ban btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-trash"></i></button>
          <!-- confirm delete Modal -->
          <div class="modal fade" id="deleteModal-{$product['productId']}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Are you sure you want to delete product with id: {$product['productId']}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="delete-product btn btn-primary" data-id="{$product['productId']}" data-bs-dismiss="modal">Delete</button>
                </div>
              </div>
            </div>
          </div>          
        </td>
      </tr>    
    HTML;
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Product</title>

    <!-- JQuery Cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/productlist.css" rel="stylesheet" />
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title text-uppercase mb-0">Manage Product</h5>
                <a class="add-product-link" href="addeditproduct.php?referer=create">Add New Product</a>
              </div>
              <div class="table-responsive table">
                <table class="table no-wrap user-table mb-0">
                  <thead>
                    <tr>
                      <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Name</th>
                      <th scope="col" class="border-0 text-uppercase font-medium" style="width:15%;">Price</th>
                      <th scope="col" class="border-0 text-uppercase font-medium" style="text-align:center;width:30%;">Description</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?= $allProducts; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="js/nav.js"></script>
    <script src="js/productlist.js"></script>

  </body>  
</html>
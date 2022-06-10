<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Product</title>

  <!-- JQuery Cdn -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  
  <!-- Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
  <!-- CSS only -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- custom css -->
  <link rel="stylesheet" href="css/viewproduct.css">
  <link rel="stylesheet" href="css/productCard.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/marquee.css">

</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white"></nav>

  <!-- Main Content -->
  <main>
    <div class="container my-0 mx-auto">
      <!-- Product Details -->
      <section class="product-detail-container">
        <?= $productDetails; ?>
      </section>
      <!-- Reviews -->
      <section class="reviews d-flex flex-column justify-content-center align-items-center">
        <div class="review-heading d-flex flex-column justify-content-center align-items-center">
          <span>Reviews</span>
          <span id="review-link">Please review our <a href="">product</a></span>
        </div>
        <!-- Reviews Box Container -->
        <div class="d-flex justify-content-center align-items-center flex-wrap w-100">
          <?= $productReviews; ?>
        </div>
      </section>
      <!-- Suggestions -->
      <h2>You may also like</h2>
      <?= $suggestionsMarquee; ?>   
    </div>
  </main>

  <!-- Footer -->
  <footer class="container-fluid footer-container d-flex flex-column align-items-center justify-content-center"></footer>
  
  
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- FA Icons -->
  <script src="https://kit.fontawesome.com/6df1b567fb.js" crossorigin="anonymous"></script>
  <!-- custom js -->
  <script src="js/nav.js"></script>
  <script src="js/footer.js"></script> 
  <script src="js/cart.js"></script>
  <script src="js/viewproduct.js"></script>
</body>
</html>
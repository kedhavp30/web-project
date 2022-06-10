<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Product</title>

  <!-- JQuery Cdn -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
  <!-- CSS only -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- custom css -->
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/searchproduct.css">
  <link rel="stylesheet" href="css/productCard.css">

</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white"></nav>

  <!-- Main Content -->
  <main>
    <div class="container my-0 mx-auto">
      <div class="row row-cols-1 row-cols-lg-2 g-4 mt-2 mb-4">
        <!-- Filters -->
        <div class="col-lg-3">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-1 g-2">
            <!-- Range Slider -->
            <div class="col">
              <div class="price-filter-wrapper">
                <header>
                  <h2>Price Range</h2>
                  <p>Use slider or enter min and max price</p>
                </header>
                <div class="price-input d-flex w-100">
                  <div class="field d-flex w-100 align-items-center">
                    <span>Min</span>
                    <input type="number" class="input-min w-100 h-100" value="0">
                  </div>
                  <div class="separator d-flex justify-content-center align-items-center">-</div>
                  <div class="field d-flex w-100 align-items-center">
                    <span>Max</span>
                    <input type="number" class="input-max w-100 h-100" value="3000">
                  </div>
                </div>
                <div class="slider">
                  <div class="progress"></div>
                </div>
                <div class="range-input">
                  <input type="range" class="range-min" name="minrange" min="0" max="3000" value="0" step="20">
                  <input type="range" class="range-max" name="maxrange" min="0" max="3000" value="3000" step="20">
                </div>
                <div class="filter-btn">
                  <input type="submit" name="filter" value="filter">
                </div>
              </div>
            </div>
            <!-- Category List -->
            <div class="col">
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      Men
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <ul class="list-group category-list">
                        <li class="list-group-item list-group-item-action" data-id="T-shirt:men">T-Shirts</li>
                        <li class="list-group-item list-group-item-action" data-id="Hoodie:men">Hoodies</li>
                        <li class="list-group-item list-group-item-action" data-id="Shirt:men">Shirts</li>
                        <li class="list-group-item list-group-item-action" data-id="Jean:men">Jeans</li>
                        <li class="list-group-item list-group-item-action" data-id="Trousers:men">Trousers</li>
                        <li class="list-group-item list-group-item-action" data-id="Shoes:men">Shoes</li>
                        <li class="list-group-item list-group-item-action" data-id="Sportswear:men">Sportswear</li>
                        <li class="list-group-item list-group-item-action" data-id="Jogger:men">Joggers</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Women
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <ul class="list-group category-list">
                        <li class="list-group-item list-group-item-action" data-id="Blouse:women">Blouses</li>
                        <li class="list-group-item list-group-item-action" data-id="Sweatshirt:women">Sweatshirts</li>
                        <li class="list-group-item list-group-item-action" data-id="Jean:women">Jeans</li>
                        <li class="list-group-item list-group-item-action" data-id="Trousers:women">Trousers</li>
                        <li class="list-group-item list-group-item-action" data-id="Shoes:women">Shoes</li>
                        <li class="list-group-item list-group-item-action" data-id="Sportswear:women">Sportswear</li>
                        <li class="list-group-item list-group-item-action" data-id="Jogger:women">Joggers</li>
                        <li class="list-group-item list-group-item-action" data-id="Dress:women">Dresses</li>
                        <li class="list-group-item list-group-item-action" data-id="Skirt:women">Skirts</li>
                      </ul>                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product Grid -->
        <div class="col-lg-9">
          <h4 class="search-results p-4 pt-0"><?= $searchResult ?></h4>
          <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-lg-3 gy-5">
            <?= $productGridContent; ?>
          </div>          
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="container-fluid footer-container d-flex flex-column align-items-center justify-content-center"></footer>

  <script>
    const searchResults = <?= $products; ?>;
    searchResults.length && localStorage.setItem("searchResults", JSON.stringify(searchResults));
  </script>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- FA Icons -->
  <script src="https://kit.fontawesome.com/6df1b567fb.js" crossorigin="anonymous"></script>
  <!-- custom js -->
  <script src="js/nav.js"></script>
  <script src="js/footer.js"></script>
  <script src="js/cart.js"></script>
  <script src="js/searchproduct.js"></script>
</body>
</html>
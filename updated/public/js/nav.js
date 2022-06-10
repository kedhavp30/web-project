const createNav = () => {
  let nav = document.querySelector('nav');

  nav.innerHTML = /* html */ `
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="img/logo.jpeg" alt="Logo" width="300" height="90">
      </a>
      <div class="offcanvas offcanvas-end" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">StylishWear</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div class="navbar-nav container justify-content-around align-items-center">
            <a class="blue-link py-2 py-lg-0" aria-current="page" href="index.php">Home</a>
            <a class="blue-link py-2 py-lg-0" href="searchproduct.php?gender=women">Women</a>
            <a class="blue-link py-2 py-lg-0" href="searchproduct.php?gender=men">Men</a>
            <a class="blue-link py-2 py-lg-0" href="searchproduct.php">All Products</a>
            <a class="blue-link py-2 py-lg-0" href="#">About Us</a>
            <form class="d-flex" method="" action="#">
              <input class="form-control me-2" type="search" name="searchbox" placeholder="Search Products" aria-label="Search">
              <button class="btn btn-custom" type="submit" value="search" name="search">Search</button>
            </form>
          </div>
        </div>
      </div>
      <div class="d-flex align-items-center gap-3">
        <button class="cart-icon">
          <i class="fa-solid fa-cart-shopping" type="button"></i>
          <span class="cart-item-qty">0</span>
        </button>
        <!-- Cart -->
        <div class="backdrop"></div>
        <div class="cart-wrapper">
          <div class="cart-container">
            <!-- Cart Heading -->
            <button class="cart-heading d-flex align-items-center">
              <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 0 0 0 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z"></path>
              </svg>
              <span class="heading">Your Cart</span>
              <span class="cart-num-items">(<span>0</span> items)</span>
            </button>
            <!-- Product Container -->
          </div>
        </div>
        <a href="#"><i class="fa-solid fa-user"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div>
  `;
};

createNav();
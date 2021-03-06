const createNav = () => {
    let nav = document.querySelector(".mynavbar");
  
    nav.innerHTML = /* html */`
      <div class="mynav">
        <img src="img/logo.jpeg " alt="logo" class="mybrand-logo">
        <div class="mynav-items">
          <form method="POST" action="searchproduct.php">
            <div class="mysearch">
              <input type="text" class="mysearch-box" name="searchbox" placeholder="Search products">
              <button class="mysearch-btn" value="search" name="search">search</button>
            </div>
          </form>
          <a href="editprofile.php" ><i class="fa fa-user" ></i></a>
          <a href="cart.php"><i class="fa fa-shopping-cart" ></i></a>
        </div>
      </div>
      <ul class="mylinks-container">
        <li class="mylink-item"><a href="index.php" class="mylink">Home</a></li>
        <li class="mylink-item"><a href="searchproduct.php?gender=women" class="mylink">Women</a></li>
        <li class="mylink-item"><a href="searchproduct.php?gender=men" class="mylink">Men</a></li>
        <li class="mylink-item"><a href="searchproduct.php" class="mylink">All Products</a></li>
        <li class="mylink-item"><a href="aboutus.php" class="mylink">About Us</a></li>
      </ul>
    `;
  }
  
  createNav();
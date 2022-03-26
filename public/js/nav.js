const createNav = () => {
    let nav = document.querySelector(".mynavbar");
  
    nav.innerHTML = `
      <div class="mynav">
      <img src="img/logo.jpeg " alt="logo" class="mybrand-logo">
      <div class="mynav-items">
        <div class="mysearch">
          <input type="text" class="mysearch-box" placeholder="Search products">
          <button class="mysearch-btn">search</button>
        </div>
        <a href="editprofile.php"><i class="fa fa-user" ></i></a>
        <a href="cart.php"><i class="fa fa-shopping-cart" ></i></a>
      </div>
      </div>
      <ul class="mylinks-container">
        <li class="mylink-item"><a href="index.html" class="mylink">Home</a></li>
        <li class="mylink-item"><a href="searchproduct.html?gender=female" class="mylink">Women</a></li>
        <li class="mylink-item"><a href="searchproduct.html?gender=male" class="mylink">Men</a></li>
        <li class="mylink-item"><a href="searchproduct.html" class="mylink">Category</a></li>
        <li class="mylink-item"><a href="aboutus.html" class="mylink">About Us</a></li>
      </ul>
    `;
  }
  
  createNav();
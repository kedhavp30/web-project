const createNav = () => {
  let nav = document.querySelector(".mysidebar");

  nav.innerHTML =`
    <div class="logo-details">
      <i class='bx bxl-a-plus-plus'></i>
      <span class="logo_name">ADMIN</span>
    </div>
    <ul class="mynav-links">
      <li>
        <a href="home.php" class="myactive">
          <i class='bx bx-grid-alt' ></i>
          <span class="mylinks_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="productlist.php>
          <i class='bx bx-box' ></i>
          <span class="mylinks_name">Product</span>
        </a>
      </li>
      <li>
        <a href="order.html">
          <i class='bx bx-list-ul' ></i>
          <span class="mylinks_name">Order list</span>
        </a>
      </li>
      <li>
        <a href="review2.php">
          <i class="bx bx-comment-detail"></i>
          <span class="mylinks_name">Reviews</span>
        </a>
      </li>
      <li>
        <a href="support.php">
          <i class='bx bx-message' ></i>
          <span class="mylinks_name">Feedbacks</span>
        </a>
      </li>
      <li>
        <a href="registeredusers1.php">
          <i class='bx bx-user' ></i>
          <span class="mylinks_name">Registered Users</span>
        </a>
      </li>
      <li class="log_out">
        <a href="#">
          <i class='bx bx-log-out'></i>
          <span class="mylinks_name">Log out</span>
        </a>
      </li>
    </ul>
`;

  let sidebar = document.querySelector(".mysidebar");
  let sidebarBtn = document.querySelector(".sidebarBtn");
  sidebarBtn.onclick = function () {
    sidebar.classList.toggle("myactive");
    if (sidebar.classList.contains("myactive")) {
      sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
  };
}

createNav();
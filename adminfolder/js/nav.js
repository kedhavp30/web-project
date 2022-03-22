const createNav = () => {
  let nav = document.querySelector(".sidebar");

  nav.innerHTML =`
    <div class="logo-details">
      <i class='bx bxl-a-plus-plus'></i>
      <span class="logo_name">ADMIN</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="#" class="active">
          <i class='bx bx-grid-alt' ></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-box' ></i>
          <span class="links_name">Product</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-list-ul' ></i>
          <span class="links_name">Order list</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class="bx bx-comment-detail"></i>
          <span class="links_name">Reviews</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-message' ></i>
          <span class="links_name">Messages</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-user' ></i>
          <span class="links_name">Registered Users</span>
        </a>
      </li>
      <li class="log_out">
        <a href="#">
          <i class='bx bx-log-out'></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
`;
}

createNav();
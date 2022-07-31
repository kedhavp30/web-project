<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="css/home.css">
    <!-- Boxicons CDN Link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-a-plus-plus'></i>
      <span class="logo_name">ADMIN</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="home.php" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="productlist.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Product</span>
          </a>
        </li>
        <li>
          <a href="order.html">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Order list</span>
          </a>
        </li>
        <li>
          <a href="review2.php">
            <i class="bx bx-comment-detail"></i>
            <span class="links_name">Reviews</span>
          </a>
        </li>
        <li>
          <a href="support.php">
            <i class='bx bx-message' ></i>
            <span class="links_name">Messages</span>
          </a>
        </li>
        <li>
          <a href="registeredusers1.php">
            <i class='bx bx-user' ></i>
            <span class="links_name">Registered Users</span>
          </a>
        </li>
        <li class="log_out">
          <a href="login.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>

  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Order</div>
            <?php
                require_once "includes/db_connect.php";
                $sQuery = "SELECT * FROM orders";
                $countorders = 0;
                #echo $sQuery."<br/>";
                $Result = $conn->query($sQuery);
                $numrows = $Result->rowCount();
                while ($row = $Result->fetch()) {
                    $countorders = $countorders + 1;
               }
               echo "
            <div class= number >$countorders</div>
            <div class= indicator >
              <i class='bx bx-up-arrow-alt'></i>
              <span class= text >Up from yesterday</span> 
            </div> 
          </div> " 
          ?>
          <i class='bx bx-cart-alt cart'></i>
        </div>

        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Sales</div>
            <?php
                require_once "includes/db_connect.php";
                $sQuery = "SELECT * FROM orders WHERE status = 'Delivered' ";
                $countsales = 0;
                #echo $sQuery."<br/>";
                $Result = $conn->query($sQuery);
                $numrows = $Result->rowCount();
                while ($row = $Result->fetch()) {
                    $countsales = $countsales + 1;
               }
               echo "
            
            <div class= number > $countsales </div>
            <div class= indicator>
              <i class='bx bx-up-arrow-alt'></i>
              <span class= text >Up from yesterday</span> "
              ?>
            </div>
          </div>
          <i class='bx bxs-cart-add cart two' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Reviews</div>
            <?php
                require_once "includes/db_connect.php";
                $sQuery = "SELECT * FROM review";
                $countreviews = 0;
                #echo $sQuery."<br/>";
                $Result = $conn->query($sQuery);
                $numrows = $Result->rowCount();
                while ($row = $Result->fetch()) {
                    $countreviews = $countreviews + 1;
               }
               echo"
            <div class= number >$countreviews</div>
            <div class= indicator >
              <i class='bx bx-block banned'></i>
              <span class= text style= margin-right: 5px; >Banned</span>
              <i class='bx bx-flag flagged'></i>
              <span class= text >Flagged</span>
            </div>" 
            ?>
          </div>
          <i class='bx bx-comment-detail review three' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Registered Users</div>

            <?php
                require_once "includes/db_connect.php";
                $sQuery = "SELECT * FROM account";
                $countregisteredusers = 0;
                #echo $sQuery."<br/>";
                $Result = $conn->query($sQuery);
                $numrows = $Result->rowCount();
                while ($row = $Result->fetch()) {
                    $countregisteredusers = $countregisteredusers + 1;
               }
               
            echo "
            <div class= number> $countregisteredusers </div>
            <div class= indicator > 
              <i class='bx bx-down-arrow-alt down'></i>
              <span class= text>Down From Today</span>
            </div>"
            ?>
          </div>
          <i class='bx bx-user usericon four' ></i>
        </div> 
      </div>
      
       

      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Recent Sales</div>
          <?php
                require_once "includes/db_connect.php";
                echo "
                <div class = sales-details>
                  <ul class= details>
                    <li class= topic >Date</li>
            
                  </ul>
                  <ul class= details >
                  <li class= topic >Customer</li>
                 
                 </ul>
                <ul class= details >
                  <li class = topic >Sales</li>
                 
                </ul>
                <ul class= details >
                 <li class= topic >Total</li>
                </div>
                ";
                $sQuery = "SELECT orderDate, status, firstName, lastName, unitPrice FROM orders 
                INNER JOIN orderitems ON orders.orderId = orderitems.orderId 
                INNER JOIN customer ON orders.customerId = customer.customerId
                WHERE status = 'Pending' OR status = 'Delivered'";
                #echo $sQuery."<br/>";
                $Result = $conn->query($sQuery);
                $numrows = $Result->rowCount();
                while ($row = $Result->fetch()) {
                echo "
                 <div class = sales-details>
                   <ul class= details>
                     <li><a href= # >" . $row['orderDate'] . "</a></li>
                   </ul>
                   <ul class= details >
                     <li><a href= # > " . $row['firstName']."" . " " . $row['lastName']."</a></li>
                   </ul>       
                   <ul class= details >
         
           
            <li><a href= # >" . $row['status'] . "</a></li>
          </ul>
          <ul class= details >
            <li><a href= # > ". $row['unitPrice'] ."</a></li>
          </div>
          ";
        }
         ?>
               
      </div>

        <div class="top-sales box"> 
          <div class="title">Top Selling Product</div>

         <?php
          
          $squery1 = "SELECT prodName, unitPrice, picture from product 
          WHERE productId='1' OR productId='16' OR productId='14' OR productId='12' OR productId='7' 
          OR productId='40' OR productId='20' OR productId='68' OR productId='75' OR productId='56'
          OR productId='47' OR productId='32' OR productId='80' "; 
          $Result = $conn->query($squery1);
          while ($row = $Result->fetch()) {
          echo "

              <ul class= top-sales-details >
                <li>
                <a href= # >
                 <img src= images/{$row['picture']} alt=''>
                  <span class= product > ". $row['prodName']. "</span>
               </a>
                <span class= price >". $row['unitPrice']. "</span>
             </li>
          </ul> ";
          }
          ?>
        </div>
      </div>
    </div> 
  
    

    <!--Graphs-->
    <div class="main-container">
      <div class="barchart">
        Sales
        <div class="year-stats">
          <div class="month-group">
            <div class="bar h-100"></div>
            <p class="month">Jan</p>
          </div>
          <div class="month-group">
            <div class="bar h-50"></div>
            <p class="month">Feb</p>
          </div>
          <div class="month-group">
            <div class="bar h-75"></div>
            <p class="month">Mar</p>
          </div>
          <div class="month-group">
            <div class="bar h-25"></div>
            <p class="month">Apr</p>
          </div>
          <div class="month-group selected">
            <div class="bar h-100"></div>
            <p class="month">May</p>
          </div>
        </div>
      </div>
  
      <div class="piechart">
        <span>Reviews</span>
        <div class="stats-info">
          <div class="graph-container">
            <div class="percent">
              <svg viewBox="0 0 36 36" class="circular-chart">
                <path class="circle" stroke-dasharray="100, 100" d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831" />
                <path class="circle" stroke-dasharray="85, 100" d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831" />
                <path class="circle" stroke-dasharray="60, 100" d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831" />
                
              </svg>
            </div>
            
            <p>Total: <?php echo $countreviews ?></p>
          </div>
          
          <div id="legenda">
            <div class="entry">
              <div id="color-brown" class="entry-color"></div>
              <div class="entry-text">Flagged</div>
            </div>
            <div class="entry">
              <div id="color-black" class="entry-color"></div>
              <div class="entry-text">Banned</div>
            </div>
            <div class="entry">
              <div id="color-blue" class="entry-color"></div>
              <div class="entry-text">Normal</div>
            </div>
        </div>
      </div>
    </div>
  </section>
      
  <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
    sidebar.classList.toggle("active");
    if(sidebar.classList.contains("active")){
    sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
    }else
    sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
  </script>

</body>
</html>
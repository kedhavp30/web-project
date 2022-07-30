

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Feedbacks</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/template/bootstrap.min.css">
  
    <link href="css/support.css" rel="stylesheet" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>

  <?php require_once "includes/metatags.php";
  ?>

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
            <div class="col-sm-5 col-md-6 col-12 pb-4">
                <h1>Feedbacks</h1>

                <?php
                require_once "includes/db_connect.php";
                $sQuery = "SELECT * FROM feedback";
                #echo $sQuery."<br/>";
                $Result = $conn->query($sQuery);
                $numrows = $Result->rowCount();
              
                while ($row = $Result->fetch()) {
                $sQuery2 = "SELECT * FROM feedback";
                $Result2 = $conn->query($sQuery2);
                $row2=$Result2->fetch();

                echo "
                <div class= comment mt-4 text-justify float-left > <img src= images/Rudi.jpg   class= rounded-circle  width= 40  height= 40 >
                    <h4>". $row2['username']. "</h4> <span " . $row2['postedOn'] . "</span><br>
                    <p>".$row2['comment']."</p>
                </div>";
               }
               ?>  
               
            </div>
            <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4 reply-form ">
                <form id="algin-form">
                    <div class="form-group">
                        <h4>Reply</h4> <label for="message">Message</label> <textarea name="msg" id="" msg cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group"> <label for="name">Name</label> <input type="text" name="name" id="fullname" class="form-control"> </div>
                    <div class="form-group"> <label for="email">Email</label> <input type="text" name="email" id="email" class="form-control"> </div>
                    <div class="form-group"> <button type="button" id="post" class="btn">Send email</button> </div>
                </form>
            </div>
        </div>
      </div>

    </section>

    <script src="js/nav.js"></script>

  </body>  
</html>
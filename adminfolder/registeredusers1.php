<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Registered Users</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/template/bootstrap.min.css">
  
    <link href="css/registeredusers.css" rel="stylesheet" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <?php require_once "includes/metatags.php";
  ?>

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
                <h5 class="card-title text-uppercase mb-0">Manage Users</h5>
              </div>
              <div class="table-responsive">
                <table class="table no-wrap user-table mb-0">
                  <thead>
                    <tr>
                      <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Name</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Phone</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">DOB</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Username</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Manage <form id="manage-user-form"><input type="submit" value="Apply"></input></form></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    require_once "includes/db_connect.php";
                    $sQuery = "SELECT * FROM customer";
                    
                    #echo $sQuery."<br/>";
                    $Result = $conn->query($sQuery);
                    $numrows = $Result->rowCount();
              
                    while ($row = $Result->fetch()) {
                    $sQuery2 = "SELECT * FROM customer ";
                    $Result2 = $conn->query($sQuery2);
                    $row2=$Result2->fetch();
                  
                    echo "
                    <tr>
                      <td class= pl-4 >" . $row['customerid']."</td> 
                      <td>
                        <h5 class= font-medium mb-0 >" . $row['firstName']."" . " " . $row['lastName']."</h5>
                        <span class= text-muted >" . $row['address']."</span>
                      </td>
                      
                      <td>
                        <span class= text-muted >" . $row['phone']."</span>
                      </td>
                      <td>
                        <span class= text-muted >". $row['dob']."</span><br>
                      </td>
                      <td>
                        <span class= text-muted >" . $row['username']."</span>
                      </td>
                      <td>
                        <input type= radio  form= manage-user-form  id= ban-kai  name= status-kai  value= ban ></input>
                        <label for= ban-kai class= btn btn-ban btn-outline-info btn-circle btn-lg btn-circle ml-2 ><i class= fa fa-ban ></i></label>
                        <input type= radio  form= manage-user-form  id= unban-kai  name= status-kai  value= unban ></input>
                        <label for= unban-kai  class= btn btn-active btn-outline-info btn-circle btn-lg btn-circle ml-2 ><i class= fa fa-check-circle ></i></label>
                        <button type= button class= btn btn-outline-info btn-circle btn-lg btn-circle><i class= fa fa-eye ></i> </button>
                      </td>
                    </tr> ";
                  }
                  ?>

                  </tbody> 
                </table>
              </div> 
            </div> 
          </div> 
        </div> 
      </div> 
   

    </section>

    <script src="js/nav.js"></script>

  </body>  
</html>
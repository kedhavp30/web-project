<?php
session_start();
?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
	$("#ban").click(function(){
      var product_id = $("#id").val();
      var custid=$("#cid").val();
      var postedOn=$("#postedOn").val();

      $.ajax({
                type: "POST",
                url: "ajaxreview.php",
                data: {"pid": product_id,
               "postedOn":postedOn,
            "cid":custid},
                success: function(result){
                alert(result);
               //   $("p#q").html(result);
                }
            })
               
      });
   })
  </script>
<?php require_once "includes/metatags.php";
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Manage Reviews</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/template/bootstrap.min.css">
  
    <link href="css/review.css" rel="stylesheet" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

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
                <h5 class="card-title text-uppercase mb-0">Manage Reviews</h5>
              </div>

              <?php
                require_once "includes/db_connect.php";
                $sQuery = "SELECT * FROM review WHERE flag = 1";
               #echo $sQuery."<br/>";
               $Result = $conn->query($sQuery);
               $numrows = $Result->rowCount();
              
               while ($row = $Result->fetch()) {
                #require_once "include/db_connect.php";
                $sQuery2 = "SELECT picture FROM product WHERE productId= " ."'" .$row['productId'] ."'". "";
                $Result2 = $conn->query($sQuery2);
                $row2=$Result2->fetch();

                echo "
                <div class=table-responsive>
                <table class=table no-wrap user-table mb-0>
                  <thead>
                    <tr>
                    <th scope=col class= border-0 text-uppercase font-medium>Product</th>
                    <th scope=col class= border-0 text-uppercase font-medium style= width:10%; >ProductId</th>
                    <th scope= col  class= border-0 text-uppercase font-medium >Reviews</th>
                    <th scope= col class= border-0 text-uppercase font-medium >PostedOn </th>
                    <th scope= col class= border-0 text-uppercase font-medium >Rating </th>
                    <th scope= col class= border-0 text-uppercase font-medium >  <button type = button id = ban class=button>Ban</button></th>
                    </tr>
                  </thead>

            
                  <tbody>
                  
                    <tr>
                     
                      <td>
                          <div class=profile>
                            <div class=profile-img>
                              <img src = images/{$row2['picture']}>
                            </div>
                          </div> 
                      </td>  
                
                      <td>
                      <span class=text-muted>" . $row['productId'] . "</span><br>
                      </td>
                      
                      <td>
                        <span class=text-muted>" . $row['reviewDesc'] . "</span><br>
                      </td>
                    
                      <td>
                       <span class=text-muted>" . $row['postedOn'] . "</span><br>
                      </td> 

                      <td>
                      <span class=text-muted>" . $row['rating'] . "</span><br>
                    </td>
                    </tr>
                  </tr>
                  </tbody>

                   
              </table> 
            </div>";
            }
            ?>    
                   
            </div>
          </div>
        </div>
      </div>
               
    </section>

  <script src="js/nav.js"></script>

  </body>  
</html>

<!--<td><input type =button id=ban value=ban> </td>; line 95 -->
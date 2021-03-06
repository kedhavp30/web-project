
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
              <div class="table-responsive">
                <table class="table no-wrap user-table mb-0">
                  <thead>
                    <tr>
                      <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Name</th>
                      <th scope="col" class="border-0 text-uppercase font-medium" style="width:10%;">Username</th>
                      <th scope="col" class="border-0 text-uppercase font-medium" style="text-align:center;width:40%;">Reviews</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Manage <form id="manage-review-form"><input type="submit" value="Apply"></input></form></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="pl-4"></td>
                      <td>
                        <div class="profile">
                          <!--img---->
                          <div class="profile-img">
                              <img src="images/Kai.webp" />
                          </div>
                          <h5 class="font-medium mb-0">Kai Havertz</h5>
                        </div>
                      </td>
                      <td>
                        <span class="text-muted">@kaihavertz29</span><br>
                      </td>
                      <td>
                        <span class="text-muted">Amazing T-Shirt.Very happy with the item. Absolutely love STYLISHWEAR. Comfortable Tees. </span><br>
                      </td>
                      <td>
                        <input type="radio" form="manage-review-form" id="ban-1" name="status-1" value="ban"></input>
                        <label for="ban-1" class="btn btn-ban btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-ban"></i></label>
                        <input type="radio" form="manage-review-form" id="unban-1" name="status-1" value="unban"></input>
                        <label for="unban-1" class="btn btn-active btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-check-circle"></i></label>
                      </td>
                    </tr>
                    <tr>
                      <td class="pl-4">2</td>
                      <td>
                        <div class="profile">
                          <!--img---->
                          <div class="profile-img">
                              <img src="images/reece.png">
                          </div>
                          <h5 class="font-medium mb-0">Reece James</h5>
                        </div>
                      </td>
                      <td>
                        <span class="text-muted">rjames24</span><br>
                      </td>
                      <td>
                        <span class="text-muted">This t shirt is well made; the fabric is so soft. Keeps its shape after washing. I now have several in different colors. I am so happy to have found this website. </span><br>
                      </td>
                      <td>
                        <input type="radio" form="manage-review-form" id="ban-2" name="status-2" value="ban"></input>
                        <label for="ban-2" class="btn btn-ban btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-ban"></i></label>
                        <input type="radio" form="manage-review-form" id="unban-2" name="status-2" value="unban"></input>
                        <label for="unban-2" class="btn btn-active btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-check-circle"></i></label>
                      </td>
                    </tr>
                    <tr>
                      <td class="pl-4">3</td>
                      <td>
                        <div class="profile">
                          <!--img---->
                          <div class="profile-img">
                              <img src="images/Rudi.jpg">
                          </div>
                          <h5 class="font-medium mb-0">Antonio Rudiger</h5>
                        </div>
                      </td>
                      <td>
                        <span class="text-muted">@tonirudiger2</span><br>
                      </td>
                      <td>
                        <span class="text-muted">Top quality and nice colour.</span><br>
                      </td>
                      <td>
                        <input type="radio" form="manage-review-form" id="ban-3" name="status-3" value="ban"></input>
                        <label for="ban-3" class="btn btn-ban btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-ban"></i></label>
                        <input type="radio" form="manage-review-form" id="unban-3" name="status-3" value="unban"></input>
                        <label for="unban-3" class="btn btn-active btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-check-circle"></i></label>
                      </td>
                    </tr>
                    <tr>
                      <td class="pl-4">4</td>
                      <td>
                        <div class="profile">
                          <!--img---->
                          <div class="profile-img">
                              <img src="images/Pulisic.jpg">
                          </div>
                          <h5 class="font-medium mb-0">Mark C Pulisic</h5>
                        </div>
                      </td>
                      <td>
                        <span class="text-muted">@cmpulsic10</span><br>
                      </td>
                      <td>
                        <span class="text-muted">Love it! Love how it fits!</span><br>
                      </td>
                      <td>
                        <input type="radio" form="manage-review-form" id="ban-4" name="status-4" value="ban"></input>
                        <label for="ban-4" class="btn btn-ban btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-ban"></i></label>
                        <input type="radio" form="manage-review-form" id="unban-4" name="status-4" value="unban"></input>
                        <label for="unban-4" class="btn btn-active btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-check-circle"></i></label>
                      </td>
                    </tr>
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


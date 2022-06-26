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
   <title>Review Admin</title>
</head>

<body>

<?php
 echo"<p id=q></p>";
  require_once "includes/db_connect.php";
  $sQuery = "SELECT * FROM review WHERE flag = 1";
 #echo $sQuery."<br/>";
 $Result = $conn->query($sQuery);
 $numrows = $Result->rowCount();
 
 echo"<h1>Flagged review</h1><br/><br/>";
 if($numrows ==0){
    echo "There is no flagged review";
 }else{
    echo "<table class='productId'><tr><th>postedOn</th><th>reviewDesc</th><th>rating</th><th>flag</th><th>rating</th><th>customerid</th><th>ban</th></th></tr>";
    while ($row = $Result->fetch()) {
       #require_once "include/db_connect.php";
       $sQuery2 = "SELECT picture FROM product WHERE productId= " ."'" .$row['productId'] ."'". "";
       $Result2 = $conn->query($sQuery2);
       $row2=$Result2->fetch();
    #   echo "<tr class='ad_reviews'>";		
       echo "<td>" . $row['reviewDesc'] . "</td>";
       echo "<td>" . $row['postedOn'] . "</td>";
       echo "<td>" . $row['productId'] . "</td>";
       echo "<td><img src='images/{$row2['picture']}' </td>";
       echo "<td><input type =button id=ban value=ban> </td>";
       echo "<td> <input id='id'type='hidden' name ='rv_name' value=".$row['productId']."></td>";
       echo "<td> <input id='cid'type='hidden' name ='cid' value=".$row['customerid']."></td>";
       echo "<td> <input id='postedOn'type='hidden' name ='posted' value=".$row['postedOn']."></td>";

      
       echo "</tr>";
    }
    echo "</table>";
    }
 
    echo "<br/> <br/>";
 
    /*$reviewid=1; 
    echo "UPDATE review_table SET flagged = 0, banned= 1 WHERE review_id=$reviewid";*/
    
    $sQuery = "SELECT * FROM review WHERE flag = 0";
    #echo $sQuery."<br/>";
    $Result = $conn->query($sQuery);
    $numrows = $Result->rowCount();
    
    echo"<h1>Flagged review</h1><br/><br/>";
    if($numrows ==0){
       echo "There is no flagged review";
    }else{
       echo "<table class='productId'><tr><th>postedOn</th><th>reviewDesc</th><th>rating</th><th>flag</th><th>rating</th><th>customerid</th><th>ban</th></th></tr>";
       while ($row = $Result->fetch()) {
          #require_once "include/db_connect.php";
          $sQuery2 = "SELECT picture FROM product WHERE productId= " ."'" .$row['productId'] ."'". "";
          $Result2 = $conn->query($sQuery2);
          $row2=$Result2->fetch();
       #   echo "<tr class='ad_reviews'>";		
          echo "<td>" . $row['reviewDesc'] . "</td>";
          echo "<td>" . $row['postedOn'] . "</td>";
          echo "<td>" . $row['productId'] . "</td>";
          echo "<td><img src='images/{$row2['picture']}' </td>";
          echo "<td><input type =button id=ban value=ban> </td>";
          echo "<td> <input id='id'type='hidden' name ='rv_name' value=".$row['productId']."></td>";
         
          echo "</tr>";
       }
       echo "</table>";
       }
 ?>
 </body>
 </html>
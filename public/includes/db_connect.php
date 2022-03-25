<?php

   $server_name = "localhost";
   $user_name = "hdsmathew";
   $password = "mathewrcpl";
   $db_name = "onlineclothing";

   try {
      $conn = new PDO("mysql:host=$server_name;dbname=$db_name", $user_name, $password);
   } catch(PDOException $e) {
      echo  $e->getMessage();
   }

?>
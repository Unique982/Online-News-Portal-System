<?php 
 $servername = "localhost:3307";
 $username = "root";
 $password = "";
   $dbname = "news_website";

   $conn = mysqli_connect($servername,$username,$password,$dbname);
   
   if(!$conn){
    die("Could not connect: " . mysqli_connect_error());

   }

 ?>
<?php

session_start();

 if(!isset($_SESSION['username'])){
  header("location:index.php");
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
      <!-- CSS LINK ADMIN -->
      <link rel="stylesheet" href="../Css/style.css"> 
    

     <!-- Link font -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
</head>
<body>
<header>
    <nav class="navbar">
        <a href="#index.html" class="logo">Unique<span> Online Update.</span></a>

     <ul class="menu-item">
        <span class="fa-solid fa-xmark" id="close-menu-btn"></span>
        <li><a href="dashboard.php" class="active">Home</a></li>
        
        <li><a href="Post.php">Post</a></li>
    <!-- check user role and open normol user login only post section and admin login open all section -->
     <?php 
     if($_SESSION["user_role"] == '1'){
     ?>
    <li><a href="Category.php">Category</a></li>
    <li><a href="User.php">User</a></li>
    <li><a href="setting.php">Setting</a></li>
  <?php }?>
    <li><a href="logout.php">Logout</a></li>
</ul>

           

     <span class="fa-solid fa-bars" id="menu-btn"></span>
   
    </nav>
 </header>
 <!--EndMenu Code  -->
 <!-- Script code -->
 <script src="../js/script.js"></script>


             

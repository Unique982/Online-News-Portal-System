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
<link rel="stylesheet" href="../admincss/style.css">

     <!-- Link font -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
</head>
<body>
     <!-- Header Section -->
 <div class="header-admin" id="header-admin">
  
<!-- container -->
<div class="admin-container">
  <div class="logo">
    <img src="" alt="">

  </div>
</div>

    <!-- Menu Section Start Here -->
    <ul class="admin-menu">
    <li><a href="Post.php">Post</a></li>
    <!-- check user role and open normol user login only post section and admin login open all section -->
     <?php 
     if($_SESSION["user_role"] == '1'){
     ?>
    <li><a href="Category.php">Category</a></li>
    <li><a href="User.php">User</a></li>
  <?php }?>
    <li><a href="logout.php">   Logout</a></li>
</ul>

<h1 class="show-name">Hello Mr:<?php echo $_SESSION['username'];?></h1>

</div>
</div>
             <!--EndMenu Code  -->

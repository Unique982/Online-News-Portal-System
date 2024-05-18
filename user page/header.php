<?php 
include '..\database\database.php';
 // page title code start
 $page = basename($_SERVER['PHP_SELF']);
 switch($page){
 case 'Category.php':
 if(isset($_GET['category_id'])){
   $sql = "SELECT * from post_category where category_id = {$_GET['category_id']}";
   $result = mysqli_query($conn,$sql) or die("Query failed");
   $row = mysqli_fetch_assoc($result);
   $page_name = $row['category_name'];
 }
 else{
 $page_name ="No found Category Name";
 }
 break;
 case 'author.php':
    if(isset($_GET['aid'])){
        $sql = "SELECT * from add_user where user_id = {$_GET['aid']}";
        $result = mysqli_query($conn,$sql) or die("Query failed");
        $row = mysqli_fetch_assoc($result);
        $page_name = $row['username'].""."-"."Unique News KBR";
        
      }
      else{
      $page_name ="No found Username";
      }
 break;
 case 'search.php':
    if(isset($_GET['search'])){
      $page_name =$_GET['search'];
      }
      else{
      $page_name ="Not found ";
      }
    break;
   
    case 'single.php':
        if(isset($_GET['id'])){
            $sql = "SELECT * from news_post where post_id = {$_GET['id']}";
            $result = mysqli_query($conn,$sql) or die("Query failed");
            $row = mysqli_fetch_assoc($result);
            $page_name = $row['post_title'];
          }
          else{
          $page_name ="No found Category Name";
          }
        break;
     default:
       
        $sql = "SELECT * FROM setting1 ";
        $result = mysqli_query($conn,$sql) or die("Query failed");
        $row = mysqli_fetch_assoc($result);
        $page_name = $row['website_name'];
      
     break;
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_name ;?></title>
    <!-- Css Link -->
  <link rel="stylesheet" href="../Css/style.css">
    <!-- Link font -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel ="icon" href="../image/index.jpeg">
<link rel="stylesheet" href="../Css/font.css">
<script src="https://kit.fontawesome.com/3088fde6ae.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
<?php
 include ("../database/database.php");
$sql1= "select * from setting1";
$result1= mysqli_query($conn, $sql1) or die("Query failed");
if(mysqli_num_rows($result1)>0){
    while ($row =mysqli_fetch_array($result1)){

?>    
<style>
    header{
      position: fixed!important; ;
      top: 0;
      left: 0;
      width: 100%;
      padding: 8px;
      background-color:<?php echo $row['color'];?>;
  }
</style>
    <nav class="navbar">
        <a href="index.php" class="logo"><?php echo $row['logo'];?></a>
<?php }} ?>
     <ul class="menu-item">
        <span class="fa-solid fa-xmark" id="close-menu-btn"></span>
        <?php
         
            
            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
            }
                   /* Select query  code  */
            $sql = "SELECT * FROM post_category WHERE  status <1";
            $result = mysqli_query($conn, $sql) or die("Query Failed.: Category");
            if (mysqli_num_rows($result) > 0) {
                $active = "";

            ?>       
             <li><a href="index.php" class="active">Home</a></li>
        <?php while ($row = mysqli_fetch_array($result)) {
                        if (isset($_GET['category_id'])) {


                            if ($row['category_id'] == $category_id) {
                                $active = "active";
                             } else {
                                $active = "";
                            }
                        }
                        echo "<li><a class='{$active}' href='Category.php?category_id={$row['category_id']}'>{$row['category_name']}</a></li>";
                  
                    } ?>
             
            
            <?php } ?> <!--if condition close  -->
            <?php
            session_start();
         
            
            if ( isset($_SESSION['v_id']) && $_SESSION['loggedin'] = true) { 
               
                echo "<li><a href='logout.php'>Logout</a></li>";
            } else{
                echo "<li><a href='login.php'>Login</a></li>";
            }
            ?>
            



         </ul>
        
     

     <span class="fa-solid fa-bars" id="menu-btn"></span>
   
    </nav>
 </header>

<!-- end Header Code -->
<script src="../js/script.js"></script>

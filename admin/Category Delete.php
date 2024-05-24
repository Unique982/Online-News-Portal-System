<?php
include "database.php";
 
session_start();
if($_SESSION['user_role'] == '0'){
   header("Location:Post.php");
  }
$id = $_GET["id"];
$sql="DELETE FROM post_category WHERE category_id='$id'";
$result = mysqli_query($conn,$sql);
if($result){
    header("Location: Category.php?msg=Deleted Successfully");
  
    
}
else{
    echo "failed:". mysqli_error($conn);
}
?>

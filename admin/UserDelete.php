<?php
include "database.php";

if($_SESSION['user_role'] == '0'){
   header("Location:Post.php");
  }
$id = $_GET["id"];
$sql="DELETE FROM add_user WHERE user_id='$id'";
$result = mysqli_query($conn,$sql);
if($result){
    header("Location: User.php?msg= Deleted Successfully");
   
    
}
else{
    echo "failed:". mysqli_error($conn);
}
?>

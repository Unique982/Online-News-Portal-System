<?php
// delete comment post code 
include("../database/database.php");
$cid = $_GET["cid"];
$sql="DELETE FROM post_comment WHERE comment_id='$cid'";
$result = mysqli_query($conn,$sql);
if($result){
    header("Location: comment_view.php?msg=Delete Successfully");
   
    
}
else{
    echo "failed:". mysqli_error($conn);
}

?>
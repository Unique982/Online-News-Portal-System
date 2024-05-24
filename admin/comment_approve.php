<?php
// Include the database connection file
include("../database/database.php");
if(isset($_POST['approve'])){
    $cid = $_POST['cid'];
    $sql = "UPDATE post_comment SET status = 0 WHERE comment_id = $cid";
    $result = mysqli_query($conn,$sql);
    header("Location:comment_view.php? msg= Approve Successfully");
}
// unapprove code
if(isset($_POST['unapprove'])){
    $cid = $_POST['cid'];
    $sql = "UPDATE post_comment SET status = 1 WHERE comment_id = $cid";
    $result = mysqli_query($conn,$sql);
    header("Location:comment_view.php? msg= Unapprove Successfully");
}

?>

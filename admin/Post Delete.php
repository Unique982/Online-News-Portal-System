<?php
include 'database.php';
$post_id = $_GET['id'];
$category_id = $_GET['category_id'];


// Delete Image Folder code
$sql1 = "SELECT * FROM news_post WHERE post_id = {$post_id};";
$result = mysqli_query($conn, $sql1) or die("Query Failed :SELECt");
$row = mysqli_fetch_array($result);
unlink("Post UploadImg/".$row['post_Uploadimg']);

// Delete end code
$sql = "DELETE FROM news_post WHERE post_id = {$post_id};";
$sql  .= "UPDATE post_category SET category_post = category_post -1  WHERE category_id={$category_id}";
 
if(mysqli_multi_query($conn, $sql)){
   header("location:Post.php ?msg=Deleted Successfully");
}
else{
   echo "Failed";
}

?>

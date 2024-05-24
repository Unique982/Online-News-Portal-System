<?php
 include ("../database/database.php");

// upload file 
if(isset($_FILES['UploadImg']['name'])){
  
    $errors= array();

    $file_name = $_FILES['UploadImg']['name'];
   $file_size = $_FILES['UploadImg']['size'];
   $file_tmp = $_FILES['UploadImg']['tmp_name'];
   $file_type = $_FILES['UploadImg']['type'];
   $file_ext = end(explode(".",$file_name));
   $extensions = array("jpeg","jpg","png");


// check if size
if(in_array($file_ext, $extensions) === false){
    $errors[] = "plseae choose file a jpg or png or jpeg file ";
}
 if($file_size > 5242880 ){//check file mb (1024*1024=1mb)
    $errors[] = "file size must be 5mb or lower.";
}

$new_name =  time(). "--".basename($file_name);
$target = "Post UploadImg/".$new_name;

if(empty($errors) == true){
    
    move_uploaded_file($file_tmp,$target);
}
else{
    print_r($errors);
 die();
}
}
session_start();

$title = mysqli_real_escape_string($conn, $_POST['title']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$author =   $_SESSION['user_id'];
$date = date("Y-D-M");


$sql ="INSERT INTO news_post (post_title, post_description, category, author, date, post_Uploadimg) VALUES ('{$title}', '{$description}', '{$category}', {$author}, '{$date}', '{$new_name}');";
$sql .="UPDATE post_category SET category_post = category_post + 1 WHERE category_id = {$category}";
  if(mysqli_multi_query($conn, $sql)){
    header("location: Post.php?msg=Update successfully");
}
else{
    echo "Update Failed";
}


?>

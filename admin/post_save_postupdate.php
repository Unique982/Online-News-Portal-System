<?php 

include 'database.php';
if(empty($_FILES['new-image']['name'])){
   $new_name = $_POST['old_image'];
}else{
    // upload file 

    $errors= array();

    $file_name = $_FILES['new-image']['name'];
   $file_size = $_FILES['new-image']['size'];
   $file_tmp = $_FILES['new-image']['tmp_name'];
   $file_type = $_FILES['new-image']['type'];
   $tmp = explode('.',$file_name);
   $file_extension = end($tmp);
   $extensions = array("jpeg","jpg","png");


// check if size
if(in_array( $file_extension, $extensions) === false){
    $errors[] = "plseae choose file a jpg or png or jpeg file ";
}
 if($file_size > 5242880 ){//check file mb (1024*1024=1mb)
    $errors[] = "file size must be 5mb or lower.";
}

$new_name =  time(). "/--/".basename($file_name);
$target = "Post UploadImg/".$new_name;
$image_name = $new_name;

if(empty($errors) == true){
    
    move_uploaded_file($file_tmp,$target);
}
else{
    print_r($errors);
 die();
}

}

$sql = "UPDATE news_post SET post_title='{$_POST["title"]}', post_description ='{$_POST["description"]}', category={$_POST["category"]},post_Uploadimg='{$image_name}' WHERE post_id = {$_POST["post_id"]};";
if($_POST['old_category'] != $_POST["category"]){
   $sql  .= "UPDATE post_category SET category_post = category_post -1  WHERE category_id={$_POST['old_category']};";
   $sql  .= "UPDATE post_category SET category_post = category_post +1  WHERE category_id={$_POST['category']};";
  
}

 $result = mysqli_multi_query($conn, $sql);
 if($result){
    header("location:Post.php");

 }
 else{
    echo "Query Failed";
 }

?>
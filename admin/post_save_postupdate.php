<?php 
 include ("../database/database.php");
if(empty($_FILES['new-image']['name'])){
   $new_name = $_POST['old_image'];
}else{
    // upload file 

    $errors= array();

    $file_name = $_FILES['new-image']['name'];
   $file_size = $_FILES['new-image']['size'];
   $file_temp = $_FILES['new-image']['tmp_name'];
   $file_type = $_FILES['new-image']['type'];
   $tmp = explode('.',$file_name);
   $file_extension = end($tmp);
   $extensions = array("jpeg","jpg","png");



if(in_array( $file_extension, $extensions) === false){
    $errors[] = "plseae choose file a jpg or png or jpeg file ";
}
// check if size
 if($file_size > 5242880 ){//check file mb (1024*1024=1mb)
    $errors[] = "file size must be 5mb or lower.";
}

$new_name =  time(). "--".basename($file_name);
$target = "Post UploadImg/".$new_name;
$image_name = $new_name;

if(empty($errors) == true){
    
    move_uploaded_file($file_temp,$target);
}
else{
    print_r($errors);
 die();
}

}

$title = mysqli_real_escape_string($conn, $_POST["title"]);
$description = mysqli_real_escape_string($conn, $_POST["description"]);
$category = mysqli_real_escape_string($conn, $_POST["category"]);
$post_id = mysqli_real_escape_string($conn, $_POST["post_id"]);
$old_category = mysqli_real_escape_string($conn, $_POST["old_category"]);

$query = "UPDATE news_post SET `post_title`='{$title}', `post_description`='{$description}', `category`={$category}, `post_Uploadimg`='{$new_name}' WHERE post_id ={$post_id};";
if($old_category != $category){
   $query .= "UPDATE post_category SET category_post = category_post -1  WHERE category_id={$old_category};";
   $query  .= "UPDATE post_category SET category_post = category_post +1  WHERE category_id={$category}";
}
 $result =mysqli_multi_query($conn, $query);
 if($result){
    header("location:Post.php");

 }
 else{
    echo "Query Failed";
 }

?>

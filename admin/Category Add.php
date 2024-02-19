
<?php 
include 'database.php';
include "header.php";
 if($_SESSION['user_role'] == '0'){
    header("Location:Post.php");
   }
if(isset($_POST['Save'])){
$category = mysqli_real_escape_string($conn, $_POST['caterogy']);


$sql = "SELECT category_name FROM `post_category`  WHERE category_name='$category'";
$result = mysqli_query($conn, $sql) or die("Query Failed");

if(mysqli_num_rows($result) > 0){
    echo "Category is aleardy exit";

}
else{
    $sql1 ="INSERT INTO post_category(category_name) VALUES('$category')";
    if(mysqli_query($conn,$sql1)){
        header("location:Category.php");
        echo "<script>alert('New Category Add');</script>";
    }
}
}
?>


      <!-- Html Code in from Start here -->
      <div class="add_container">
            <h1 class="head">Category Add</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST" autocomplete="off">
        <div class="input-box">
                <label>Category Name: <span style="color:red">*</span></label>
                <input type="text" name="caterogy" id="category" placeholder="Enter Category Name" required/>
                <small>Error Message</small>    
            </div>
               
            <input type="submit" class="btn" name="Save" value="Add">
        </form>
    </div>

<!-- End Code Here -->
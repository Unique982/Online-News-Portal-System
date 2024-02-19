<?php
include "database.php";

include "header.php";

if ($_SESSION['user_role'] == '0') {
    header("Location:Post.php");
}
if (isset($_POST['Edit'])) {
    $id = $_POST['id'];
    $category = $_POST['category'];

    $sql1 = "UPDATE post_category SET `category_name`= '$category' WHERE category_id='$id'";
    // $result =mysqli_query($conn, $sql);
    if (mysqli_query($conn, $sql1)) {
        header("Location:Category.php? msg=data Update Successfully");
        exit();
    } else {
        echo "Failed:" . mysqli_error($conn);
    }
}
?>

<!-- Html Code Start Here -->
<div class="add_container">
            <h1 class="head">Update Category</h1>
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM post_category  WHERE  category_id ='$id'";
        $result = mysqli_query($conn, $sql) or die("failed");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

        ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <input type="hidden" name="id" value="<?php echo $row["category_id"]; ?>">
                    <div class="input-box">
                        <label>Category Name:</label>
                        <input type="text" name="category" value="<?php echo $row['category_name']; ?>" id="category" placeholder="Enter Category Name">
                        <small>Error Message</small>
                    </div>
                    <input type="submit" name="Edit" value="Save" class="btn">

                    <a href="Category.php" class="cancel"class="btn">Cancel</a>
                </form>


    </div>
    </form>
    
<?php }
        } ?>
</div>
</div>
    <!-- End Html Code Here -->
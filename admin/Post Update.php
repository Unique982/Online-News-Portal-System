<?php
include 'database.php';
include "header.php";
if ($_SESSION['user_role'] == '0') {

  $post_id = $_GET['id'];

  $sql2 = "SELECT author FROM news_post WHERE post_id = {$post_id}";
  $result2 = mysqli_query($conn, $sql2) or die("Query Failed");
  $row2 = mysqli_fetch_assoc($result2);
  if ($row2['author'] != $_SESSION['user_id']) {
    header("location:Post.php");
  }
}
?>
<?php
include 'database.php';
$post_id = $_GET['id'];

$sql = "SELECT news_post.post_id, news_post.post_title, news_post.post_description,news_post.category, news_post.post_Uploadimg,post_category.category_name, news_post.category FROM news_post
LEFT JOIN post_category ON news_post.category =post_category.category_id
LEFT JOIN add_user on news_post.author = add_user.user_id 
WHERE news_post.post_id = {$post_id}";

$result = mysqli_query($conn, $sql) or die("Query Failed");
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {


?>
              <!-- Update Html Code Start.. -->
                 <div class="add_container">
            <h1 class="head">Update Post</h1>

            <!-- Start Form code -->
            <form action="post_save_postupdate.php" method="POST" enctype="multipart/form-data">
            <div class="input-box">
            <input type="hidden" name='post_id' value="<?php echo $row['post_id']; ?>">
          </div>  
            <!--Title filed  -->
            <div class="input-box">
                <label>Title <span style="color:red;">*</span></label>
                <input type="text" name="title" value="<?php echo $row["post_title"]; ?>">
             <small>Error Message</small>
            </div> 
                 <!-- Description filed -->
            <div class="input-box">
                <label>Description <span style="color:red;">*</span></label>
                <textarea name="description" id="description" cols="20" rows="10"><?php echo $row["post_description"]; ?></textarea>
             <small>Error Message</small>
            </div>
                 <!-- Category filed -->
            <div class="input-box">
                <label>Category <span style="color:red;">*</span></label>
                <select name="category" id="category">
                <option disabled selected> Select </option>
              <?php
              include 'database.php';
              $sql1 = "SELECT * FROM post_category";
              $result1 = mysqli_query($conn, $sql1) or die("query failed");
              if (mysqli_num_rows($result1) > 0) {
                while ($row1 = mysqli_fetch_array($result1)) {



                  if ($row['category'] == $row1['category_id']) {
                    $selected = "selected";
                  } else {
                    $selected = "";
                  }

                  echo "<option  value='{$row1['category_id']}'$selected>{$row1['category_name']}</option>";
                }
              }

              ?>
                </select>
                <input type="hidden" name="old_category" value="<?php echo $row['category']; ?>">
             <small>Error Message</small>
            </div>
                   <!-- Image filed -->
            <div class="input-box">
                <label>Image <span style="color:red;">*</span></label>
                <input type="file" name="new-image">
            <img src="Post UploadImg/<?php echo $row['post_Uploadimg']; ?>" width="200px" height="200px">
            <input type="hidden" name="old_image" vlaue="<?php echo $row['post_Uploadimg']; ?>">
             <small>Error Message</small>
            </div> 
            <input type="submit" name="Post" value="Update" class="btn">
            </form>
            <?php }
} else {
  echo "Not Found";
}?>
        </div>
<?php
include 'database.php';
include "header.php";
if ($_SESSION['user_role'] == '0') {

  $post_id = $_GET['id'];

  $sql2 = "SELECT author FROM news_post WHERE post_id = {$post_id}";
  $result2 = mysqli_query($conn, $sql2) or die("Query Failed");
  $row2 = mysqli_fetch_assoc($result);
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

           <!--Html Code Start Here Form  -->
    <div class="container">
      <div class="Form-content">
        <h2>Update Post</h2>
        <form action="post_save_postupdate.php" method="POST" enctype="multipart/form-data">


          <div class="input-box">
            <input type="hidden" name='post_id' value="<?php echo $row['post_id']; ?>">
          </div>

          <div class="input-box">
            <label>Title</label>
            <input type="text" name="title" value="<?php echo $row["post_title"]; ?>" placeholder="Enter Title">
          </div>
          <div class="input-box">
            <label>Description</label>
            <textarea name="description" id="" cols="20" rows="5"><?php echo $row["post_description"]; ?></textarea>
          </div>

          <div class="input-box">
            <label>category</label>
            <select name="category">
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
          </div>

          <div class="input-box">
            <label for="">Image</label>

            <input type="file" name="new-image">
            <img src="Post UploadImg/<?php echo $row['post_Uploadimg']; ?>" height="100vh">
            <input type="hidden" name="old_image" vlaue="<?php echo $row['post_Uploadimg']; ?>">
          </div>


          <input type="submit" name="Post" value="Update" class="btn">
        </form>

    <?php }
} else {
  echo "Not Found";
}

    ?>
      </div>
    </div>

                 <!--ENd Html Code  -->
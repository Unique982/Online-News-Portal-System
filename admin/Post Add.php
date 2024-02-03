<?php
include "header.php";
?>

      <!-- Start Html Code Here -->
<div class="container">
  <div class="Form-content">
    <form action="Post Save.php" method="POST" enctype="multipart/form-data" id="form">
      <h2>Add Post</h2>
      <div class="input-box">
        <label>Title</label>
        <input type="text" name="title" id="title" placeholder="Enter Title">
      
      </div>
      <div class="input-box">
        <label>Description</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
      </div>
      <div class="input-box">
        <label>category</label>
        <select name="category" id="category">
          <option disabled selected>Select</option>
        
          <?php
          include 'database.php';
          $sql = "SELECT * FROM post_category";
          $result = mysqli_query($conn, $sql) or die("query failed");
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
              echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
            }
          }
          ?>

        </select>
       
      </div>

      <div class="input-box">
        <label for="">Image</label>
        <input type="file" name="UploadImg">
        
      </div>


      <input type="submit" name="Post" value="Post" class="btn">
    </form>
  </div>
</div>

                <!--End Html Code Here-->
<?php
include "header.php";
include ("../database/database.php");
?>

      <!-- Start Html Code Here -->
                <div class="add_container">
            <h1 class="head">Add Post</h1>

            <!-- Start Form code -->
            <form action="Post Save.php" method="POST" enctype="multipart/form-data" id="form" name="post" onsubmit="return validationPost()">
              <!--Title filed  -->
            <div class="input-box">
                <label>Title <span style="color:red;">*</span></label>
                <input type="text" name="title" id="title">
             <small>Error Message</small>
            </div> 
                 <!-- Description filed -->
            <div class="input-box">
                <label>Description <span style="color:red;">*</span></label>
                <textarea name="description" id="description" cols="20" rows="10"></textarea>
             <small>Error Message</small>
            </div>
                 <!-- Category filed -->
            <div class="input-box">
                <label>Category <span style="color:red;">*</span></label>
                <select name="category" id="category">
          <option disabled selected>Select</option>
          <?php
       
          $sql = "SELECT * FROM post_category WHERE  status < 1";
          $result = mysqli_query($conn, $sql) or die("query failed");
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
              echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
            }
          }
          ?>
                </select>
             <small>Error Message</small>
            </div>
                   <!-- Image filed -->
            <div class="input-box">
                <label>Image <span style="color:red;">*</span></label>
                <input type="file" name="UploadImg"  id="image">
             <small>Error Message</small>
            </div> 
            
            <input type="submit" name="POST" value="Post" class="btn">
          
            </form>
        </div>
         <!--End Html Code Here-->
         
      

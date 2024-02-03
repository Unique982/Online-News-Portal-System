<?php


include 'header.php';

//redirect the file and not open normal user


?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Post Page </title>
</head>
<body>
    <h1>
    <h1>All Post </h1>
    <a class="add-new"href="Post Add.php">New Post Add</a>
    </button> -->
<a class="add-new" href="Post Add.php" style="justify-content: flex-end;">+ Add Post</a>
<?php
include 'database.php';
$limit = 10;

// pagination code
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
$offset  = ($page - 1) * $limit;
// end of pagination code
/* post table for Admin  */
if ($_SESSION['user_role'] == '1') {

  $sql = "SELECT news_post.post_id, news_post.post_title, news_post.post_description, news_post.category, news_post.date, post_category.category_name, add_user.username, news_post.category FROM news_post 
    LEFT JOIN post_category ON news_post.category =post_category.category_id
    LEFT JOIN add_user ON news_post.author = add_user.user_id
     ORDER BY news_post.post_id DESC  LIMIT {$offset},{$limit}";
}







/* post table for normal user */ elseif ($_SESSION['user_role'] == '0') {
  $sql = "SELECT news_post.post_id, news_post.post_title, news_post.post_description, news_post.category, news_post.date, post_category.category_name, add_user.username, news_post.category FROM news_post 
    LEFT JOIN post_category ON news_post.category =post_category.category_id
    LEFT JOIN add_user ON news_post.author = add_user.user_id
     
  WHERE news_post.author= {$_SESSION['user_id']} 
  ORDER BY news_post.post_id DESC  LIMIT {$offset},{$limit}";
}
$result = mysqli_query($conn, $sql) or die("Query Failed");
$count = mysqli_num_rows($result);
if ($count > 0) {




?>
              <!--Table Content Start Here  -->

  <div class="table">
    <div class="table-head">
      <p>Post Page</p>
      <a class="add-new" href="Post Add.php">+ Add Post</a>
    </div>
    <div class="table_content">
      <table>
        <thead>

          <th>S.N</th>
          <th>Post Title</th>
          <th>Category</th>
          <th>Author</th>
          <th>Date</th>
          <th>Action</th>
   </thead>
        <tbody>
          <?php

          $serial_number =    $offset + 1;
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
       <td class="id"><?php echo $serial_number ?></td>
              <td><?php echo $row['post_title'] ?></td>

              <td><?php echo $row['category_name'] ?></td>
              <td><?php echo $row['username'] ?></td>
              <td><?php echo $row['date'] ?></td> 
              <td>
                <a href="Post Update.php?id=<?php echo $row["post_id"] ?>"><i class="fa-solid fa-pen-to-square" style="color: #2c6609;"></i></a>
                <a href="Post Delete.php?id=<?php echo $row['post_id']; ?>&category_id=<?php echo $row['category']; ?>"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
              </td>

              <?php
              $serial_number++;
              ?>
            </tr>
          <?php }  ?>
        </tbody>
      <?php }  ?>
      </table>


         <!--End  Table Content Here  -->

      <div class="pagination">
        <?php

        // pagination code heres
        include "database.php";
        $sql1 = "SELECT *FROM  news_post";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result1)) {
          $total = mysqli_num_rows($result1);

          $total_page = ceil($total / $limit);



          if ($page > 1) {
            echo '<li><a href="Post.php?page=' . ($page - 1) . '">Prev</a></li>';
          }
          for ($i = 1; $i <= $total_page; $i++) {
            if ($i == $page) {
              $active = "active";
            } else {
              $active = "";
            }
            echo '  <li class="" ' . $active . '"><a href="Post.php?page=' . $i . '">' . $i . '</a></li>';
          }
          if ($total_page > $page) {
            echo '<li><a href="Post.php?page=' . ($page + 1) . '">Next</a></li>';
          }


          echo '</ul>';
        }



        //pagination end

        ?>

      </div>
    </div>
  </div>
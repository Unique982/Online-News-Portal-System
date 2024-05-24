<?php


include 'header.php';

//redirect the file and not open normal user


?>

    <?php
include 'database.php';
$limit = 3;

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
    <div class="table_container">
        <div class="table_content">
            <p>Post Page</p>
             <?php if(isset($_GET['msg'])){
       $msg = $_GET['msg'];
        echo "<p style='color:green;font-weight:bold;font-size:20px; align-text:center'>$msg</p>";
            }?>
            <div>
              
            <button class="add_new"><a class="add_new"href="Post Add.php">+ ADD</a></button>
            </div>
        </div>
     <div class="table_data">
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
                  <button><a href="Post Update.php?id=<?php echo $row["post_id"];?>" class="btn"><i class="fa-solid fa-pen-to-square"></i></a></button> 
                  <button>  <a href="Post Delete.php?id=<?php echo $row['post_id']; ?>&category_id=<?php echo $row['category']; ?>"clas="btn"><i class="fa-solid fa-trash"></i></a></button> 
                </td>
                <?php
              $serial_number++;
              ?>
                </tr>
                <?php }  ?>
            </tbody>
            <?php }  ?>
        </table>
     </div>

     <!-- pagination caode here -->
     <div class="pagination_container">
     <?php

// pagination code heres
include "database.php";
$sql1 = "SELECT *FROM  news_post";
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1)) {
  $total = mysqli_num_rows($result1);

  $total_page = ceil($total / $limit);



  if ($page > 1) {
   echo'<li><a href="Post.php?page=' . ($page - 1) . '"><i class="fa-solid fa-angles-left"></i></a></li>';
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
    echo' <li><a href="Post.php?page=' . ($page + 1) . '"><i class="fa-solid fa-angles-right"></i></a></li>';
   }?>
    </div>
<?php }?>
    <?php
    include 'footer.php';
    ?>

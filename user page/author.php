<?php 
include "header.php"
?>

<div class="post-contaniner" id="post-contaniner">

    <?php 
     include "database.php";
 
    if(isset($_GET['aid'])){
                $auth_id = $_GET['aid'];
             
               // pagination code
             $sql1 = "SELECT *FROM news_post JOIN add_user
             ON news_post.author =add_user.user_id
              WHERE news_post.author={$auth_id}";
             $result1 = mysqli_query($conn, $sql1) or die("Query failed");
             $row1 = mysqli_fetch_assoc($result1);
            

   ?>
   <h1><?php echo $row1['username']; ?></h1>
   <?php
     $limit = 3;
          if(isset($_GET['page'])){
          $page = $_GET['page'];
     
          }else{
           $page = 1;
          }
          $offset  = ($page - 1) * $limit;
          $sql = "SELECT news_post.post_id, news_post.post_title, news_post.post_description, news_post.category, news_post.author, news_post.date, post_category.category_name, add_user.username, news_post.category ,news_post.post_Uploadimg FROM news_post 
    LEFT JOIN post_category ON news_post.category =post_category.category_id
    LEFT JOIN add_user ON news_post.author = add_user.user_id
   WHERE news_post.author={$auth_id}
    ORDER BY news_post.post_id DESC  LIMIT {$offset}, {$limit}";
     $result =mysqli_query($conn, $sql) or die("Query Failed");
     
     if(mysqli_num_rows($result)>0){
        while($row= mysqli_fetch_assoc($result)){

    ?>


     <!-- Post Content Code Start Here -->
    <div class="post-box">
        <div class="post-img">
            <img src="../admin/Post UploadImg/<?php  echo $row['post_Uploadimg'];?>" alt="">

        </div>
        <div class="date">
                    <span>
                        <i class="fa-solid fa-tag"></i><a href='Category.php?category_id=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                    </span>
                    <span>
                        <i class="fa-solid fa-user"></i><a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                    </span>
                    <span>
                        <i class="fa-solid fa-calendar-days"></i><a href="#time"><?php echo $row['date']; ?></a>
                    </span>
                    <a href="single.php?id=<?php echo $row['post_id'] ?>" class="post-title"><?php echo $row['post_title'] ?></a></h2>
                    <p class="description"><?php echo substr($row['post_description'], 0, 100) . "..."; ?></p>
                    <a href='single.php?id=<?php echo $row['post_id']; ?>'>Read More</a>
                </div>
            </div>

          


   <!-- Pagenatio Code Baki xa -->


 <?php } }
 else{
    echo "No Record Found.";
 } 
 //     <!--Pagaination code Here  -->
  
  if (mysqli_num_rows($result1)) {
    $total = mysqli_num_rows($result1);
 
    $total_page = ceil($total / $limit);
 
 // echo '<ul class="pagination" id="pagination">';
 
    if ($page > 1) {
      echo '<li><a href="author.php?aid='.$auth_id.'&page=' .($page - 1) .'">Prev</a></li>';
    }
    for ($i = 1; $i <= $total_page; $i++) {
 
      if ($i == $page) {
        $active = "active";
      } else {
        $active = "";
      }
      echo '<li class='.$active .'><a href="author.php?aid='.$auth_id.'&page='.$i .'">'. $i .'</a></li>';
    }
    if ($total_page > $page) {
      echo '<li><a href="author.php?aid='.$auth_id.'&page=' . ($page + 1) . '">Next</a></li>';
    }
 
 
    echo '</ul>';
  } } else{
    echo "Not Found";
  }
  ?>
 
    </div> <!--End Content   -->

    
<?php 
include "footer.php";

?>
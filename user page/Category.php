<?php 
include "header.php"
?>


<div class="post-contaniner" id="post-contaniner">

    <?php 
     include "database.php";
   
    if(isset($_GET['category_id'])){
                $category_id = $_GET['category_id'];
             
             
     // pagination code/     <!--Pagaination code Here  -->
     
     $sql1 = "SELECT * FROM post_category WHERE category_id={$category_id}";
     $result1 = mysqli_query($conn, $sql1);
     $row1 = mysqli_fetch_assoc($result1);
?>

<h1><?php echo $row1['category_name']; ?></h1>
<?php

     $limit = 5;
          if(isset($_GET['page'])){
          $page = $_GET['page'];
     
          }else{
           $page = 1;
          }
          $offset  = ($page - 1) * $limit;
          //  Query
          $sql = "SELECT news_post.post_id, news_post.post_title, news_post.post_description, news_post.category,news_post.author, news_post.date, post_category.category_name, add_user.username, news_post.category ,news_post.post_Uploadimg FROM news_post 
    LEFT JOIN post_category ON news_post.category =post_category.category_id
    LEFT JOIN add_user ON news_post.author = add_user.user_id
   WHERE news_post.category={$category_id}
    ORDER BY news_post.post_id DESC LIMIT {$offset}, {$limit}";
     $result =mysqli_query($conn,$sql) or die("Query Failed");
     
     if(mysqli_num_rows($result)>0){
        while($row= mysqli_fetch_assoc($result)){

    ?>

             <!--Content Code Start Here  -->
    <div class="post-box">
        <div class="post-img">
            <img src="../admin/Post UploadImg/<?php  echo $row['post_Uploadimg'];?>" alt="">

        </div>
        <div class="date">
        <span>
            <i class="fa-solid fa-tag"></i><a href='Category.php?category_id=<?php  echo $row['category'];?>'><?php  echo $row['category_name'];?></a>
            </span>
            
            <span>
            <i class="fa-solid fa-user"></i><a href='author.php?aid=<?php  echo $row['author'];?>'><?php  echo $row['username'];?></a>
            </span>
            <span>
            <i class="fa-solid fa-calendar-days"></i><a href="#time"><?php  echo $row['date'];?></a>
            </span>
           <h2> <a href="single.php" class="post-title"><?php  echo $row['post_title']?></a></h2>
 <p class="description"><?php  echo substr($row['post_description'],0,100) ."...";?></p>
 <a href='single.php?id=<?php  echo $row['post_id'];?>'>Read More</a>
        </div>
    </div>
   
        
           <!--Pagaination code Here  -->
 <?php } }
 else{
    echo "<h2>No Record Found. </h2>";
 } 

 if (mysqli_num_rows($result1)) {
   $total = mysqli_num_rows($result1);

   $total_page = ceil($total / $limit);

// echo '<ul class="pagination" id="pagination">';

   if ($page > 1) {
     echo '<li><a href="Category.php?category_id='.$category_id.'&page=' .($page - 1) .'">Prev</a></li>';
   }
   for ($i = 1; $i <= $total_page; $i++) {

     if ($i == $page) {
       $active = "active";
     } else {
       $active = "";
     }
     echo '<li class='.$active .'><a href="Category.php?category_id='.$category_id.'&page='.$i .'">'. $i .'</a></li>';
   }
   if ($total_page > $page) {
     echo '<li><a href="Category.php?category_id='.$category_id.'&page=' . ($page + 1) . '">Next</a></li>';
   }


   echo '</ul>';
 }
}
 ?>




    </div>   <!--End Contect Code   -->

    
<?php 
include "footer.php";

?>
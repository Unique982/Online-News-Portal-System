<?php 
include "header.php";

?>
<section class="post-container" id ="post-container">
<?php 
     include "../database/database.php";
 
    if(isset($_GET['search'])){
                $search_team =mysqli_real_escape_string ($conn,$_GET['search']);

    ?>
<div class="post">


<?php 
  $limit = 5;

  if(isset($_GET['page'])){
  $page = $_GET['page'];

  }else{
   $page = 1;
  }
  $offset  = ($page - 1) * $limit;

    $sql = "SELECT news_post.post_id, news_post.post_title, news_post.post_description, news_post.category, news_post.author, news_post.date, post_category.category_name, add_user.username, news_post.category ,news_post.post_Uploadimg FROM news_post 
    LEFT JOIN post_category ON news_post.category =post_category.category_id
    LEFT JOIN add_user ON news_post.author = add_user.user_id
   WHERE news_post.post_title LIKE '%{$search_team}%' OR news_post.post_description LIKE '%{$search_team}%'
    ORDER BY news_post.post_id DESC  LIMIT {$offset}, {$limit}";
     $result =mysqli_query($conn, $sql) or die("Query Failed");
    
   
     if(mysqli_num_rows($result)>0){
        while($row= mysqli_fetch_assoc($result)){

    ?>
  <div class="post-content">
            <a href="../pages/single.php?id=<?php echo $row['post_id']; ?>"> <img src="../admin/Post UploadImg/<?php echo $row['post_Uploadimg']; ?>" alt="">
                        </a>
                        <div class="date">
                        <span>
                            <i class="fa-solid fa-tag"></i><a href='Category.php?category_id=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                        </span>
                        &nbsp;&nbsp;
                        <span>
                            <i class="fa-solid fa-user"></i><a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                        </span>
                        &nbsp;&nbsp;
                        <span>
                            <i class="fa-solid fa-calendar-days"></i><a href="#time"><?php echo $row['date']; ?></a>
                        </span>
                        &nbsp;&nbsp;
                        </div>
                        <h3><a href="single.php?id=<?php echo $row['post_id'] ?>" class="post-title"><?php echo $row['post_title'] ?></a></h3>
                        <p class="description"><?php echo substr($row['post_description'], 0, 300) . "..."; ?></p>
                        <a href='single.php?id=<?php echo $row['post_id']; ?>' class="red">Read More >></a>
                    </div>
         
            <?php } //<-- While loop end -->
        } //<-- if condition end -->
      
      else {
        echo "<h2 style='margin-bottom:120px';>No Record Found. </h2>";
    }
     }   ?>
       
        </div>
        <?php include 'sidebar.php'; ?>
   </section>

  
   <!--Pagaination code Here  -->
   <div class="pagination_container">
 <?php 
   $sql1 = "SELECT *FROM news_post WHERE news_post.post_title LIKE '%{$search_team}%'OR news_post.post_description LIKE '%{$search_team}%'";
   $result1 = mysqli_query($conn, $sql1) or die("Query failed");
   $row1 = mysqli_fetch_assoc($result1);
 if (mysqli_num_rows($result1)) {
   $total = mysqli_num_rows($result1);

   $total_page = ceil($total / $limit);


if ($page > 1) {
  echo '<li><a href="sidebar.php?search='. $search_team.'&page=' .($page - 1) .'"><<</a></li>';
}
for ($i = 1; $i <= $total_page; $i++) {

  if ($i == $page) {
    $active = "active";
  } else {
    $active = "";
  }
  echo '<li class='.$active .'><a href="search.php?search='. $search_team.'&page='.$i .'">'. $i .'</a></li>';
}
if ($total_page > $page) {
  echo '<li><a href="search.php?search='. $search_team.'&page=' . ($page + 1) . '">>></a></li>';
}


echo '</ul>';
 }
 
  ?>
           </div>

  <?php 
include "footer.php";

?>
 

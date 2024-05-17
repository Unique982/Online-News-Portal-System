<?php
include "header.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
</head>
<style>
   
    .blog-container{
display: flex;
align-items: flex-start;
justify-content: space-between;
padding: 8vw;
    }
    .blog-container .blogs {
  width: 80%;
  margin: 0 auto;
    }
    
    .blog-container .blogs img{
        width: 100%;
        border-radius: 19px;
    }
    .blog-container .blogs .post{
        padding-bottom: 60px;
    }
    .blog-container .blogs .post h3{
        color:red;
        padding: 15px 0 10px 0;
    }
    .blog-container .blogs p{
 text-align: justify;
 padding-bottom: 60px;
    }
    @media (max-width: 769px) {
            .blog-container {
                padding: 8vw 4vw;
                flex-direction: column;
            }
            
            .blog-container .blogs {
                width: 100%;
                margin-top: 30px;
            }
            .blog-container .blogs img {
                width: 100%;
                height: 50vh;
              border-radius: 19px;
              object-fit: cover;
            }
        }
        @media (max-width: 469px) {
            .blog-container {
                padding: 8vw 4vw;
                flex-direction: column;
            }
            
            .blog-container .blogs {
                width: 100%;
                margin-top: 70px;
            }
            .blog-container .blogs img {
                width: 100%;
                height: 50vh;
              border-radius: 19px;
              object-fit: cover;
            }
        }
</style>
<body>
        <section class="blog-container">
            <div class="blogs">
            <?php 
     include ("../database/database.php");
     if(isset($_GET['id'])){
    $post_id = $_GET['id'];
    $sql = "SELECT news_post.post_id, news_post.post_title, news_post.post_description, news_post.category,news_post.author, news_post.date, post_category.category_name, add_user.username, news_post.category ,news_post.post_Uploadimg FROM news_post 
    LEFT JOIN post_category ON news_post.category =post_category.category_id
    LEFT JOIN add_user ON news_post.author = add_user.user_id 
    WHERE news_post.post_id = {$post_id}";

     $result =mysqli_query($conn,$sql) or die("Query Failed");
     if(mysqli_num_rows($result)>0){
        while($row= mysqli_fetch_assoc($result)){
        // inde x 
        
    ?>
                <div class="post">
                <img src="../admin/Post UploadImg/<?php  echo $row['post_Uploadimg'];?>" alt="">
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
                        </div>    
                <h3><?php  echo $row['post_title']?></h3>
                       <p>
                       <?php  echo $row['post_description'];?>
                       </p>
                    
                    
                </div>
                
                <?php } } }?>
                <hr>
               
               
    <?php 
    include 'comment.php';
               ?>
    </section>
   
    
    
    <?php
  
   include 'footer.php';
   
   ?>
</body>
</html>
